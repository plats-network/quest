<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $post_id
 * @property integer $user_id
 * @property integer $task_id
 * @property string $status
 * @property boolean $is_confirm
 * @property string $date_open
 * @property string $date_completed
 * @property integer $total_point
 * @property string $date_transfered
 * @property integer $url
 */
class UserTaskStatus extends Model
{
    //Status Open, Completed, Failed
    const STATUS_OPEN = 'Open';
    const STATUS_COMPLETED = 'Completed';
    const STATUS_FAILED = 'Failed';

    //get status
    public static function getStatus(){
        return [
            self::STATUS_OPEN => self::STATUS_OPEN,
            self::STATUS_COMPLETED => self::STATUS_COMPLETED,
            self::STATUS_FAILED => self::STATUS_FAILED,
        ];
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_task_status';

    /**
     * @var array
     */
    protected $fillable = [
        'created_at',
        'updated_at', 'post_id',
        'user_id', 'task_id', 'status',
        'is_confirm', 'date_open',
        'date_completed',
        'total_point',
        'date_transfered',
        'url'
    ];

    //Set completed status
    public function setCompleted(){
        $this->status = self::STATUS_COMPLETED;
        $this->date_completed = now();
        $this->save();
    }
    //Set Open status
    public function setOpen(){
        $this->status = self::STATUS_OPEN;
        $this->date_completed = null;
        $this->date_open = now();
        $this->save();
    }
    //Join Task
    public function task(){
        return $this->belongsTo('App\Models\Task');
    }

    //User
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    //Get User Name
    public function getUserName(){
        return $this->user->name;
    }

    //Get total post user task
    public function getTotalPostUserTask(){
        $total = 0;
        $userTask = UserTaskStatus::where('user_id', $this->user_id)
            ->where('post_id', $this->post_id)
            ->get();
        foreach($userTask as $task){
            //$total += $task->total_point;
            $total += 1;
        }
        return $total;
    }


}
