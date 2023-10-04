<?php

namespace App\Models;

use App\Models\Presenters\UserPresenter;
use App\Models\Traits\HasHashedMediaTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Permission\Traits\HasRoles;
use Overtrue\LaravelFavorite\Traits\Favoriter;

/**
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $gender
 * @property string $email
 * @property string $password
 * @property string $pin
 * @property boolean $default_pin
 * @property string $address
 * @property string $number
 * @property string $city
 * @property string $ZIP
 * @property string $email_verified_at
 * @property string $phone
 * @property string $role
 * @property string $social_id
 * @property string $social_type
 * @property string $facebook_id
 * @property string $google_id
 * @property string $github_id
 * @property string $twitter_id
 * @property string $contact_name
 * @property string $company_name
 * @property string $website
 * @property boolean $enable_portal
 * @property integer $currency_id
 * @property string $name
 * @property string $username
 * @property string $mobile
 * @property string $date_of_birth
 * @property string $avatar
 * @property boolean $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property integer $creator_id
 * @property string $guard_name
 * @property string $remember_token
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property string $stripe_id
 * @property string $pm_type
 * @property string $pm_last_four
 * @property string $trial_ends_at
 * @property OldPin[] $oldPins
 * @property RequirePin[] $requirePins
 */
class User extends Authenticatable implements HasMedia, MustVerifyEmail,JWTSubject
{
    use HasFactory;
    use HasHashedMediaTrait;
    use HasRoles;
    use Notifiable;
    use SoftDeletes;
    use UserPresenter;

    use Favoriter;

    //Type gender Female
    const GENDER_MALE = 'Male';
    //Female
    const GENDER_FEMALE = 'Female';
    const GENDER_OTHER = 'Other';

    protected $guarded = [
        'id',
        'updated_at',
        '_token',
        '_method',
        'password_confirmation',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
        'date_of_birth' => 'datetime',
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $fillable = [
        'name',
        'email',
        'password',
        'social_id',
        'social_type'
    ];

    protected static function boot()
    {
        parent::boot();

        // create a event to happen on creating
        static::creating(function ($table) {
            $table->created_by = auth()->id();
        });

        // create a event to happen on updating
        static::updating(function ($table) {
            $table->updated_by = auth()->id();
        });

        // create a event to happen on saving
        static::saving(function ($table) {
            $table->updated_by = auth()->id();
        });

        // create a event to happen on deleting
        static::deleting(function ($table) {
            $table->deleted_by = auth()->id();
            $table->save();
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function providers()
    {
        return $this->hasMany(UserProvider::class);
    }

    //Twiter Infor
    //Get twitter id from user provider
    public function getTwitterIdAttribute()
    {
        return $this->providers()->where('provider', 'twitter')->first()->provider_id ?? null;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function profile()
    {
        return $this->hasOne(Userprofile::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userprofile()
    {
        return $this->hasOne(Userprofile::class);
    }

    /**
     * Get the list of users related to the current User.
     *
     * @return [array] roels
     */
    public function getRolesListAttribute()
    {
        return array_map('intval', $this->roles->pluck('id')->toArray());
    }

    /**
     * Route notifications for the Slack channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForSlack($notification)
    {
        return env('SLACK_NOTIFICATION_WEBHOOK');
    }


    //https://fajarwz.com/blog/laravel-rest-api-authentication-using-jwt-tutorial/

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }


}
