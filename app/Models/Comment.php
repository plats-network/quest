<?php

namespace App\Models;

use App\Helpers\TimeHelper;
use App\Models\Presenters\CommentPresenter;
use Carbon\Carbon;
use Database\Factories\CommentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rennokki\QueryCache\Traits\QueryCacheable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $comment
 * @property integer $parent_id
 * @property integer $commentable_id
 * @property string $commentable_type
 * @property integer $user_id
 * @property string $user_name
 * @property string $order
 * @property boolean $status
 * @property integer $moderated_by
 * @property string $moderated_at
 * @property string $published_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Comment extends BaseModel
{
    use HasFactory;
    use LogsActivity;
    use CommentPresenter;
    use SoftDeletes;
    use QueryCacheable;

    protected $table = 'comments';

    protected $casts = [
        'deleted_at' => 'datetime',
        'published_at' => 'datetime',
        'moderated_at' => 'datetime',
    ];

    //Status Pending
    const STATUS_PENDING = 0;
    //Status Published
    const STATUS_PUBLISHED = 1;
    //Status Rejected
    const STATUS_REJECTED = 2;
    //Get all status
    public static function getStatus()
    {
        return [
            self::STATUS_PENDING => 'Pending',
            self::STATUS_PUBLISHED => 'Published',
            self::STATUS_REJECTED => 'Rejected',
        ];
    }


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
    public $cacheTags = ['comments'];

    /**
     * A cache prefix string that will be prefixed
     * on each cache key generation.
     *
     * @var string
     */
    public $cachePrefix = 'comments_';

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
            'custom_comment_tag',
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
            "comment:{$this->id}",
            'comments',
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
            // return null;
        }

        return $this->cacheFor;
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::created(function (Comment $agent) {
            // ...
            $agent::flushQueryCache(['test']);
        });
        //Update
        static::saved(function (Comment $agent) {
            // ...
            $agent::flushQueryCache(['test']);
        });

        //Delete
        static::deleted(function (Comment $agent) {
            // ...
            $agent::flushQueryCache(['test']);
        });
    }

    //flushQueryCacheItem
    public function flushQueryCacheItem()
    {
        $cacheKeyAgent = 'comment_cache_for';
        //Delete cache
        cache()->forget($cacheKeyAgent);

        return true;
    }

    protected function getCacheForKey()
    {
        return 'comment_cache_for';
    }

    /**
     * The tags for the query cache. Can be useful
     * if flushing cache for specific tags only.
     *
     * @return null|array
     */
    protected function cacheTagsValue()
    {
        return ['comments'];
    }


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logUnguarded()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName($this->table);
    }

    /**
     * Get the owning commentable model.
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function getPostAttribute()
    {
        if ($this->commentable_type == 'App\Models\Post') {
            return $this->commentable;
        } else {
            return [];
        }
    }

    public function getModuleNameAttribute()
    {
        if ($this->commentable_type == 'App\Models\Post') {
            return 'posts';
        } else {
            return '';
        }
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Comment', 'parent_id');
    }

    /**
     * Purifiy Comment field value.
     */
    // public function setCommentAttribute($value)
    // {
    //     $this->attributes['comment'] = clean($value);
    // }

    public function setUserIdAttribute($value)
    {
        $this->attributes['user_id'] = $value;

        if ($value) {
            $this->attributes['user_name'] = User::findOrFail($value)->name;
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

    public function setModeratedAtAttribute($value)
    {
        $this->attributes['moderated_at'] = $value;

        if (empty($value)) {
            $this->attributes['moderated_at'] = Carbon::now();
        }
    }

    /**
     * Get the list of Published Articles.
     *
     * @param [type] $query [description]
     * @return [type] [description]
     */
    public function scopePublished($query)
    {
        return $query->where('status', '=', 'Active')
            ->whereDate('published_at', '<=', Carbon::today()
                ->toDateString());
    }

    /**
     * Get the list of Recently Published Articles.
     *
     * @param [type] $query [description]
     * @return [type] [description]
     */
    public function scopeRecentlyPublished($query)
    {
        return $query->where('status', '=', 'Active')
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
        return CommentFactory::new();
    }
}
