<?php

namespace App\Models;

use App\Helpers\TimeHelper;
use Carbon\Carbon;

//Cloudinary
use App\Traits\MediaAlly;
use Database\Factories\CategoryFactory;
use Database\Factories\TaskFactory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Rennokki\QueryCache\Traits\QueryCacheable;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * @property integer $id
 * @property integer $post_id
 * @property string $name
 * @property string $slug
 * @property string $value
 * @property string $description
 * @property string $order
 * @property string $status
 * @property string $entry_type
 * @property string $type_value
 * @property string $transfer_type
 * @property string $total_token
 * @property string $block_chain_network
 * @property string $category_token
 * @property integer $is_deposit
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Task extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    //Cloudinary
    use MediaAlly;

    //Constant
    //Task Type Twitter Like
    const TYPE_TWITTER_FOLLOW = 'TWITTER_FOLLOW';
    //Task Type Twitter Retweet
    const TYPE_TWITTER_RETWEET = 'TWITTER_RETWEET';
    //Task Type Twitter Follow
    const TYPE_TWITTER_LIKE = 'TWITTER_LIKE';
    //Task Type Twitter Hashtag
    const TYPE_TWITTER_HASHTAG = 'TWITTER_HASHTAG';
    //TWITTER QUOTE
    const TYPE_TWITTER_QUOTE = 'TWITTER_QUOTE';

    //Task Type Twitter TWEET
    const TYPE_TWITTER_TWEET = 'TWITTER_TWEET';
    //Task Type Discord Join
    const TYPE_DISCORD_JOIN = 'DISCORD_JOIN';

    //Telegram Join
    const TYPE_TELEGRAM_JOIN = 'TELEGRAM_JOIN';
    //Network Type Phala
    const NETWORK_TYPE_PHALA = 'phala';
    //Network Type PHALA_ZERO
    const NETWORK_TYPE_PHALA_ZERO = 'aleph';
    //Astar
    const NETWORK_TYPE_ASTAR = 'astar';


    //Get all network name
    public static function getAllNetworkName()
    {
        return [
            self::NETWORK_TYPE_PHALA => 'Phala',
            self::NETWORK_TYPE_PHALA_ZERO => 'Phala Zero',
            self::NETWORK_TYPE_ASTAR => 'Astar',
        ];
    }
    //Status Active
    const STATUS_ACTIVE = 'Active';
    //Status Inactive
    const STATUS_INACTIVE = 'Inactive';
    //Status Draft
    const STATUS_DRAFT = 'Draft';

    //get all status
    //Task transfered type Token Holder, Transaction Activity
    const TRANSFER_TYPE_HOLDERS = 'TOKEN_HOLDERS';
    const TRANSFER_TYPE_ACTIVITY = 'TRANSFER_ACTIVITY';

    //Get all task type
    public static function getAllTaskType()
    {
        return [
            self::TRANSFER_TYPE_HOLDERS => 'Token Holder',
            self::TRANSFER_TYPE_ACTIVITY => 'Transaction Activity',
        ];
    }

    public static function getStatus()
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_INACTIVE => 'Inactive',
            self::STATUS_DRAFT => 'Draft',
        ];
    }

    //Get all task type
    public static function getTaskType()
    {
        return [
            self::TYPE_TWITTER_FOLLOW => 'Twitter Follow',
            self::TYPE_TWITTER_TWEET => 'Twitter Tweet',
            self::TYPE_TWITTER_RETWEET => 'Twitter Retweet',
            self::TYPE_TWITTER_QUOTE => 'Twitter Quote',

            self::TRANSFER_TYPE_HOLDERS => 'Token Holder',
            self::TRANSFER_TYPE_ACTIVITY => 'Transaction Activity',
            self::TYPE_TWITTER_LIKE => 'Twitter Like',
            self::TYPE_TWITTER_HASHTAG => 'Twitter Hashtag',
            //self::TYPE_DISCORD_JOIN => 'Discord Join',
        ];
    }

    //Get task action name, example 1 is FOLLOW, 2 is RETWEET
    public function getTypeValueAttribute()
    {
        $taskType = self::getTaskType();

        $entryType = $this->entry_type;

        switch ($entryType) {
            case self::TYPE_TWITTER_FOLLOW:
                return 'FOLLOW';
                break;
            case self::TYPE_TWITTER_RETWEET:
                return 'RETWEET';
                break;
            case self::TYPE_TWITTER_QUOTE:
                return 'RETWEET';
                break;
            case self::TYPE_TWITTER_LIKE:
                return 'LIKE';
                break;
            case self::TYPE_TWITTER_HASHTAG:
                return 'HASHTAG';
                break;
            case self::TYPE_DISCORD_JOIN:
                return 'DISCORD_JOIN';
                break;
            case self::TYPE_TELEGRAM_JOIN:
                return 'TELEGRAM_JOIN';
                break;
            case self::TRANSFER_TYPE_HOLDERS:
                return 'TOKEN_HOLDER';
                break;
            case self::TRANSFER_TYPE_ACTIVITY:
                return 'TRANSACTION_ACTIVITY'; //TO UPPER CASE is TRANSACTION_ACTIVITY
                break;
            default:
                return '';
        }

        return self::TYPE_TWITTER_RETWEET;
    }


    protected $table = 'tasks';

    public static $rules = [
        'name' => 'required|unique:product_categories',
        'image' => 'image|mimes:jpg,jpeg,png',
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
     * @param string|null $relation
     * @param \Illuminate\Database\Eloquent\Collection|null $pivotedModels
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
        static::created(function (Task $agent) {
            // ...
            $agent::flushQueryCache(['test']);
        });
        //Update
        static::saved(function (Task $agent) {
            // ...
            $agent::flushQueryCache(['test']);
        });

        //Delete
        static::deleted(function (Task $agent) {
            // ...
            $agent::flushQueryCache(['test']);
        });
    }

    //flushQueryCacheItem
    public function flushQueryCacheItem()
    {
        $cacheKeyAgent = 'task_cache_for';
        //Delete cache
        cache()->forget($cacheKeyAgent);

        return true;
    }

    protected function getCacheForKey()
    {
        return 'task_cache_for';
    }

    /**
     * The tags for the query cache. Can be useful
     * if flushing cache for specific tags only.
     *
     * @return null|array
     */
    protected function cacheTagsValue()
    {
        return ['tasks'];
    }

    /**
     * Task belongs to post
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
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
        return TaskFactory::new();
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
        if (!empty($media)) {
            return $media->getSecurePath();
        }

        return '';
    }

    //Get Name Attribute
    public function getNameTextAttribute()
    {
        $name = $this->name;
        //Check type is TRANSFER_TYPE_ACTIVITY and name contain Token Holder then rename to Transaction Activity
        if ($this->entry_type == self::TRANSFER_TYPE_ACTIVITY){
            //check name contain text Token Holder
            if (strpos($name, 'Token Holder') !== false) {
                $name = str_replace('Token Holder', 'Transaction Activity', $name);
            }

        }

        return ucfirst($name);
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

    public function getImageUrlAttribute2(): string
    {
        /** @var Media $media */
        $media = $this->getMedia(ProductCategory::PATH)->first();
        if (!empty($media)) {
            return $media->getFullUrl();
        }

        return '';
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
        } catch (Exception $e) {
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

    //Get Twitter Follow Url
    public function getTwitterFollowUrlAttribute()
    {
        return 'https://twitter.com/intent/user?user_id=' . $this->value;
    }

    //Get Twitter Retweet Url
    public function getTwitterRetweetUrlAttribute()
    {
        return 'https://twitter.com/intent/retweet?tweet_id=' . $this->value;
    }

    //Get Twitter Like Url
    public function getTwitterLikeUrlAttribute()
    {
        return 'https://twitter.com/intent/like?tweet_id=' . $this->value;
    }

    //Get Twitter Hashtag Url
    public function getTwitterHashtagUrlAttribute()
    {
        return 'https://twitter.com/hashtag/' . $this->value;
    }

    //Get Twitter Tweet User Name
    // https://twitter.com/intent/follow?screen_name=BreederDodo => Get BreederDodo
    public function getTwitterUserNameAttribute()
    {
        //Url Example https://twitter.com/intent/follow?screen_name=BreederDodo
        $url = $this->value;
        $username = str_replace('https://twitter.com/intent/follow?screen_name=', '', $url);

        return $username;
    }

    //Twitter Follow: https://twitter.com/intent/follow?screen_name=BlackPanther_Fi
    //Twitter Like: https://twitter.com/intent/like?tweet_id=1708838132697973156
    //Twitter Retweet: https://twitter.com/intent/retweet?tweet_id=1708838132697973156

    //Get Twitter like id from value url
    public function getTwitterLikeIdAttribute()
    {
        //Url Example https://twitter.com/intent/like?tweet_id=1708838132697973156
        $url = $this->value;
        //Check url have string tweet_id
        if (strpos($url, 'tweet_id') !== false) {
            $tweetId = str_replace('https://twitter.com/intent/like?tweet_id=', '', $url);
        } else {
            //Case url is https://twitter.com/Aleph__Zero/status/1706317615654641668?s=20
            //Case https://x.com/Aleph__Zero/status/1706317615654641668

            //Get id
            $tweetId = $this->getTweetIdFromUrl($url);
        }



        return $tweetId;
    }

    //Get twitter retweet id from value url
    public function getTwitterRetweetIdAttribute()
    {
        //Url Example https://twitter.com/intent/retweet?tweet_id=1708779829368357330
        $url = $this->value;
        //check have string tweet_id
        if (strpos($url, 'tweet_id') !== false) {
            $tweetId = str_replace('https://twitter.com/intent/retweet?tweet_id=', '', $url);
        } else {
            //Case url is https://twitter.com/Aleph__Zero/status/1706317615654641668?s=20
            //Case https://x.com/Aleph__Zero/status/1706317615654641668

            //Get id
            $tweetId = $this->getTweetIdFromUrl($url);
        }



        return $tweetId;
    }
    //getTwitterFollowIdAttribute
    public function getTwitterFollowIdAttribute()
    {
        //Url Example https://twitter.com/intent/follow?screen_name=BlackPanther_Fi
        $url = $this->value;
        //check have string screen_name
        if (strpos($url, 'screen_name') !== false) {
            $screenName = str_replace('https://twitter.com/intent/follow?screen_name=', '', $url);
        } else {
            $screenName = $url;
        }
        //Check is string https://twitter.com/Aleph__Zero
        if (strpos($url, 'https://twitter.com/') !== false) {
            $screenName = str_replace('https://twitter.com/', '', $url);
        }


        return $screenName;
    }

    //Private function get tweet id from url
    private function getTweetIdFromUrl($url)
    {
        $valueID ='';
        //Check is https://twitter.com/taylorotwell/status/1718996388107669914
        //Case https://x.com/Aleph__Zero/status/1706317615654641668
        //Get id,. example 1718996388107669914
        //check contain twitter.com
        if (strpos($url, 'twitter.com') !== false) {
            $regex  = '#https?://twitter\.com/(?:\#!/)?(\w+)/status(es)?/(\d+)#is';
            if (preg_match($regex, $url, $match)) {
                $valueID = $match[3];
            }
        }

        //Case url https://x.com/Aleph__Zero/status/1706317615654641668?s=20
        //Get id
        if (strpos($url, 'x.com') !== false) {
            $regex  = '#https?://x\.com/(?:\#!/)?(\w+)/status(es)?/(\d+)#is';
            if (preg_match($regex, $url, $match)) {
                $valueID = $match[3];
            }
        }

        return $valueID;
    }
}
