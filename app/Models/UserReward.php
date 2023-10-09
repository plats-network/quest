<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $post_id
 * @property integer $user_id
 * @property string $type
 * @property string $status
 * @property string $date_transfered
 * @property string $date_created
 * @property integer $total_point
 * @property integer $total_token
 */
class UserReward extends Model
{
    //Status is pending
    const STATUS_PENDING = 'pending';
    //Done
    const STATUS_DONE = 'done';
    //Cancel
    const STATUS_CANCEL = 'cancel';


    /**
     * @var array
     */
    protected $fillable = [
        'created_at',
        'updated_at',
        'post_id',
        'user_id',
        'type',
        'status',
        'date_transfered',
        'date_created',
        'total_point',
        'total_token'
    ];

    //Get post
    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }

    //Get user
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    //Get user Full Name
    public function getFullNameAttribute()
    {
        return $this->user->first_name . ' ' . $this->user->last_name;
    }
    //Get total token


    //Create Reward For Random 5 user has play task
    public static function createReward($post_id, $total_token)
    {
        //List user play
        $listUserID = UserTaskStatus::query()
            ->where('post_id', '=', $post_id)
            ->get()
            ->pluck('user_id')
            ->unique('user_id')
            ->toArray();

        //Get list user in $listUserID
        $userPlayTasks = User::query()
            ->whereIn('id', $listUserID)
            ->inRandomOrder()->limit(5)
            ->get();

        foreach ($userPlayTasks as $user) {
            //Get user reward
            $modelReward = UserReward::query()
                ->where('post_id', '=', $post_id)
                ->where('user_id', '=', $user->id)
                ->first();
            //check if user reward is null
            if($modelReward){
                continue;
            }

            $user_reward = new UserReward();
            $user_reward->post_id = $post_id;
            $user_reward->user_id = $user->id;
            $user_reward->type = 'play';
            $user_reward->status = 'pending';
            $user_reward->date_transfered = null;
            $user_reward->date_created = date('Y-m-d H:i:s');
            $user_reward->total_token = $total_token;

            $user_reward->save();
        }
    }
}
