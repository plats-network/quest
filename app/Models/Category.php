<?php

namespace App\Models;

use App\Helpers\TimeHelper;
use Carbon\Carbon;
//Cloudinary
use App\Traits\MediaAlly;
use Database\Factories\CategoryFactory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Rennokki\QueryCache\Traits\QueryCacheable;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property string $order
 * @property string $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Category extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    //Cloudinary
    use MediaAlly;

    protected $table = 'categories';

    public static $rules = [
        'name' => 'required|unique:product_categories',
        'image' => 'image|mimes:jpg,jpeg,png',
    ];
    //
    //Status Active
    const STATUS_ACTIVE = 'Active';
    //Status Inactive
    const STATUS_INACTIVE = 'Inactive';
    //Status Draft
    const STATUS_DRAFT = 'Draft';

    //get all status
    public static function getStatus()
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_INACTIVE => 'Inactive',
            self::STATUS_DRAFT => 'Draft',
        ];
    }

    use QueryCacheable;

    /**
     * Specify the amount of time to cache queries.
     * Do not specify or set it to null to disable caching.
     *
     * @var int|\DateTime
     */
    protected $cacheFor = TimeHelper::SECONDS_IN_A_WEEK; // 1 week

    /**
     * The tags for the query cache. Can be useful
     * if flushing cache for specific tags only.
     *
     * @var null|array
     */
    public $cacheTags = ['categorys'];

    /**
     * A cache prefix string that will be prefixed
     * on each cache key generation.
     *
     * @var string
     */
    public $cachePrefix = 'categorys_';

    /**
     * The cache driver to be used.
     *
     * @var string
     */
    //public $cacheDriver = 'dynamodb';

    /**
     * Set the base cache tags that will be present
     * on all queries.
     */
    protected function getCacheBaseTags(): array
    {
        return [
            'custom_category_tag',
        ];
    }

    /**
     * When invalidating automatically on update, you can specify
     * which tags to invalidate.
     *
     * @param  string|null  $relation
     * @param  \Illuminate\Database\Eloquent\Collection|null  $pivotedModels
     */
    public function getCacheTagsToInvalidateOnUpdate($relation = null, $pivotedModels = null): array
    {
        return [
            "category:{$this->id}",
            'categorys',
        ];
    }

    /**
     * Specify the amount of time to cache queries.
     * Set it to null to disable caching.
     *
     * @return int|\DateTime
     */
    protected function cacheForValue()
    {
        //is local
        if (app()->environment('local')) {
             return null;
        }

        return $this->cacheFor;
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::created(function (Category $agent) {
            // ...
            $agent::flushQueryCache(['test']);
        });
        //Update
        static::saved(function (Category $agent) {
            // ...
            $agent::flushQueryCache(['test']);
        });

        //Delete
        static::deleted(function (Category $agent) {
            // ...
            $agent::flushQueryCache(['test']);
        });
    }

    //flushQueryCacheItem
    public function flushQueryCacheItem()
    {
        $cacheKeyAgent = 'category_cache_for';
        //Delete cache
        cache()->forget($cacheKeyAgent);

        return true;
    }

    protected function getCacheForKey()
    {
        return 'category_cache_for';
    }

    /**
     * The tags for the query cache. Can be useful
     * if flushing cache for specific tags only.
     *
     * @return null|array
     */
    protected function cacheTagsValue()
    {
        return ['categorys'];
    }

    /**
     * Caegories has Many posts.
     */
    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }

    /**
     * Set the published at
     * If no value submitted use the 'Title'.
     *
     * @param [type]
     */
    public function setPublishedAtAttribute($value)
    {
        $this->attributes['published_at'] = $value;

        if (empty($value) && $this->attributes['status'] == 1) {
            $this->attributes['published_at'] = Carbon::now();
        }
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return CategoryFactory::new();
    }

    /**
     * image_url attribute.
     * Get the image url.
     * @return string
     */
    public function getImageUrlAttribute(): string
    {
        /** @var MediaCloudinary $media */
        $media = $this->fetchFirstMedia();
        if (! empty($media)) {
            return $media->getSecurePath();
        }

        return '';
    }

    public function getImageUrlAttribute2(): string
    {
        /** @var Media $media */
        $media = $this->getMedia(ProductCategory::PATH)->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return '';
    }
    //status_color
    public function getStatusColorAttribute()
    {
        //Draft
        if ($this->status == 'Draft') {
            return 'warning';
        }
        //Active
        if ($this->status == 'Active') {
            return 'success';
        }

        return 'danger';
    }

    /**
     * @return array
     */
    public function prepareLinks(): array
    {
        return [
            'self' => route('frontend.categories.show', $this->id),
        ];
    }

    /**
     * @return array
     */
    public function prepareAttributes(): array
    {
        $fields = [
            'name' => $this->name,
            'image' => $this->image_url,
            'products_count' => $this->products()->count(),
        ];

        return $fields;
    }

    /**
     * @return array
     */
    public function prepareProductCategory(): array
    {
        $fields = [
            'id' => $this->id,
            'name' => $this->name,
        ];

        return $fields;
    }

    //Total Post Attribute
    public function getTotalPostAttribute()
    {
        return $this->posts()->count();
    }

    /**
     * @param $input
     * @return LengthAwarePaginator|Collection|mixed
     */
    public function storeProductCategory($input)
    {
        try {
            DB::beginTransaction();

            $productCategory = $this->create($input);
            if (isset($input['image']) && $input['image']) {
                //Todo upload image to cloudinary
                // $product['image_url'] = $this->uploadImage($image, Product::PATH);
                $productCategory->attachMedia($input['image']);  // Example of $file is $request->file('file');
                $media = $productCategory->addMedia($input['image'])->toMediaCollection(productCategory::PATH,
                    config('app.media_disc'));
            }
            DB::commit();

            return $productCategory;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }


    /**
     * @param $input
     * @param $id
     * @return LengthAwarePaginator|Collection|mixed
     */
    public function updateProductCategory($input, $id)
    {
        try {
            DB::beginTransaction();
            $productCategory = $this->withCount('products');
            $productCategory = $productCategory->update($input, $id);
            if (isset($input['image']) && $input['image']) {
                //Todo upload image to cloudinary
                // $product['image_url'] = $this->uploadImage($image, Product::PATH);
                $productCategory->attachMedia($input['image']);  // Example of $file is $request->file('file');
                $productCategory->clearMediaCollection(productCategory::PATH);
                $productCategory['image_url'] = $productCategory->addMedia($input['image'])->toMediaCollection(productCategory::PATH,
                    config('app.media_disc'));

            }
            DB::commit();

            return $productCategory;
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
