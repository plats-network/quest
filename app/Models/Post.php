<?php

namespace App\Models;

use App\Helpers\TimeHelper;
use App\Models\Presenters\PostPresenter;
use Carbon\Carbon;
use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Rennokki\QueryCache\Traits\QueryCacheable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $intro
 * @property string $content
 * @property string $type
 * @property integer $category_id
 * @property string $category_name
 * @property integer $is_featured
 * @property string $featured_image
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $meta_og_image
 * @property string $meta_og_url
 * @property integer $hits
 * @property integer $order
 * @property boolean $status
 * @property integer $moderated_by
 * @property string $moderated_at
 * @property integer $created_by
 * @property string $created_by_name
 * @property string $created_by_alias
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property integer $start_at
 * @property integer $end_at
 * @property string $published_at
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Post extends BaseModel
{
    use HasFactory;
    use LogsActivity;
    use SoftDeletes;
    use PostPresenter;
    use Notifiable;

    protected $table = 'posts';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'intro',
        'content',
        'type',
        'category_id',
        'category_name',
        'is_featured',
        'featured_image',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'meta_og_image',
        'meta_og_url',
        'hits',
        'order',
        'status',
        'start_at',
        'end_at',
        'moderated_by',
        'moderated_at', 'created_by',
        'created_by_name',
        'created_by_alias',
        'updated_by',
        'deleted_by',
        'published_at',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

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
    public $cacheTags = ['posts'];

    /**
     * A cache prefix string that will be prefixed
     * on each cache key generation.
     *
     * @var string
     */
    public $cachePrefix = 'posts_';

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
            'custom_company_tag',
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
            "post:{$this->id}",
            'posts',
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
        static::created(function (Post $post) {
            // ...
            $post::flushQueryCache(['test']);
        });
        //Update
        static::saved(function (Post $post) {
            // ...
            $post::flushQueryCache(['test']);
        });

        //Delete
        static::deleted(function (Post $post) {
            // ...
            $post::flushQueryCache(['test']);
        });
    }

    //flushQueryCacheItem
    public function flushQueryCacheItem()
    {
        $cacheKeyAgent = 'post_cache_for';
        //Delete cache
        cache()->forget($cacheKeyAgent);

        return true;
    }

    protected function getCacheForKey()
    {
        return 'post_cache_for';
    }

    /**
     * The tags for the query cache. Can be useful
     * if flushing cache for specific tags only.
     *
     * @return null|array
     */
    protected function cacheTagsValue()
    {
        return ['posts'];
    }


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logUnguarded()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName($this->table);
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function tags()
    {
        return $this->morphToMany('App\Models\Tag', 'taggable');
    }

    /**
     * Get all of the post's comments.
     */
    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable')->where('status', '=', 1);
    }

    /**
     * All the Published and Unpublished Comments.
     */
    public function comments_all()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function setCategoryIdAttribute($value)
    {
        $this->attributes['category_id'] = $value;

        try {
            $category = Category::findOrFail($value);
            $this->attributes['category_name'] = $category->name;
        } catch (\Exception $e) {
            $this->attributes['category_name'] = null;
        }
    }

    public function setCreatedByNameAttribute($value)
    {
        $this->attributes['created_by_name'] = trim(label_case($value));

        if (empty($value)) {
            $this->attributes['created_by_name'] = auth()->user()->name;
        }
    }

    /**
     * Set the 'meta title'.
     * If no value submitted use the 'Title'.
     *
     * @param [type]
     */
    public function setMetaTitleAttribute($value)
    {
        $this->attributes['meta_title'] = trim(ucwords($value));

        if (empty($value)) {
            $this->attributes['meta_title'] = trim(ucwords($this->attributes['name']));
        }
    }

    /**
     * Set the 'meta description'
     * If no value submitted use the default 'meta_description'.
     *
     * @param [type]
     */
    public function setMetaDescriptionAttribute($value)
    {
        $this->attributes['meta_description'] = $value;

        if (empty($value)) {
            $this->attributes['meta_description'] = setting('meta_description');
        }
    }

    /**
     * Set the meta meta_og_image
     * If no value submitted use the 'Title'.
     *
     * @param [type]
     */
    public function setMetaOgImageAttribute($value)
    {
        $this->attributes['meta_og_image'] = $value;

        if (empty($value)) {
            if (isset($this->attributes['featured_image'])) {
                $this->attributes['meta_og_image'] = $this->attributes['featured_image'];
            } else {
                $this->attributes['meta_og_image'] = setting('meta_image');
            }
        }
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

    //Scope Name
    public function scopeName($query, $name)
    {
        return $query->where('name', 'LIKE', "%{$name}%");
    }
    //Scope Start
    public function scopeStart($query, $start_at)
    {
        return $query->where('start_at', '>=', $start_at);
    }
    //Scope End
    public function scopeEnd($query, $end_at)
    {
        return $query->where('end_at', '<=', $end_at);
    }
    /**
     * Get the list of Published Articles.
     *
     * @param [type] $query [description]
     * @return [type] [description]
     */
    public function scopePublished($query)
    {
        return $query->where('status', '=', '1')
            ->where('published_at', '<=', Carbon::now());
    }

    public function scopePublishedAndScheduled($query)
    {
        return $query->where('status', '=', '1');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', '=', 'Yes')
            ->where('status', '=', '1')
            ->where('published_at', '<=', Carbon::now());
    }

    /**
     * Get the list of Recently Published Articles.
     *
     * @param [type] $query [description]
     * @return [type] [description]
     */
    public function scopeRecentlyPublished($query)
    {
        return $query->where('status', '=', '1')
            ->whereDate('published_at', '<=', Carbon::today()->toDateString())
            ->orderBy('published_at', 'desc');
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return PostFactory::new();
    }

    /*
     * $publishedPosts = Post::published()->get();
     * */
    public function scopePublishedItem($query)
    {
        return $query->where('is_draft', false);
    }
}
