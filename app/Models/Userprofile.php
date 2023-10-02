<?php

namespace App\Models;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $first_name
 * @property string $last_name
 * @property string $username
 * @property string $email
 * @property string $mobile
 * @property string $gender
 * @property string $url_website
 * @property string $url_facebook
 * @property string $url_twitter
 * @property string $url_instagram
 * @property string $url_linkedin
 * @property string $date_of_birth
 * @property string $address
 * @property string $bio
 * @property string $avatar
 * @property string $user_metadata
 * @property string $last_ip
 * @property integer $login_count
 * @property string $last_login
 * @property string $email_verified_at
 * @property boolean $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Userprofile extends BaseModel
{
    protected $casts = [
        'date_of_birth' => 'datetime',
        'last_login' => 'datetime',
        'email_verified_at' => 'datetime',
    ];

    protected $fillable = [
        'user_id', 'name',
        'first_name',
        'last_name',
        'username',
        'email',
        'mobile',
        'gender',
        'url_website',
        'url_facebook',
        'url_twitter',
        'url_instagram',
        'url_linkedin',
        'date_of_birth',
        'address',
        'bio',
        'avatar',
        'user_metadata',
        'last_ip',
        'login_count',
        'last_login',
        'email_verified_at',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
