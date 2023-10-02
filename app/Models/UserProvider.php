<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $provider
 * @property string $provider_id
 * @property string $avatar
 * @property string $created_at
 * @property string $updated_at
 */
/**
 * User Provider Model.
 */
class UserProvider extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_providers';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get the user of a UserProvider.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
