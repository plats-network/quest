<?php

namespace App\Http\Controllers\FrontendQuest;

use App\Events\Backend\Article\PostViewed;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Models\Task;
use App\Models\UserReward;
use App\Models\UserTaskStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use App\Models\Task as QuestTask;

class PostsController extends Controller
{
    public $module_title;

    public $module_name;

    public $module_path;

    public $module_icon;

    public $module_model;

    public function __construct()
    {
        // Page Title
        $this->module_title = __('posts.title');

        // module name
        $this->module_name = 'posts';

        // directory path of the module
        $this->module_path = 'posts';

        // module icon
        $this->module_icon = 'fas fa-file-alt';

        // module model name, path
        $this->module_model = "App\Models\Post";
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        $$module_name = Post::query()
            ->published()
            ->with(['category', 'tags', 'comments'])
            ->orderBy('id', 'desc')
            ->paginate(8);

        return view(
            "quest.posts.index",
            compact('module_title', 'module_name', "$module_name", 'module_icon', 'module_action', 'module_name_singular')
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Request $request, $hashid)
    {
        $id = decode_id($hashid);
        /** @var User $questUser */
        $questUser = auth()->guard('quest')->user();

        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = __('Show');

        $meta_page_type = 'article';

        $$module_name_singular = Post::findOrFail($id);

        //Check post is open
        //List active tasks
        $tasks = $$module_name_singular->tasks_active()
            ->latest()->get();

        event(new PostViewed($$module_name_singular));

        //Kiểm tra còn được play task ko
        $isShowReward = false;
        //UserReward
        $userRewards = UserReward::query()
            ->where('post_id', '=', $id)
            ->get();

        if ($userRewards){
            $isShowReward = true;
        }
        //Get list Task User đã Play


        //$user->hasFavorited($post);
        $hasFavorited = false;
        $listTaskUserHasPlay = null;
        $arrTaskUserHasPlay = [];
        //Check has $questUser
        if ($questUser){
            $hasFavorited = $questUser->hasFavorited($$module_name_singular);
            $listTaskUserHasPlay = UserTaskStatus::query()
                ->where('user_id', '=', $questUser->id)
                ->where('post_id', '=', $id)
                ->get();
            //Get id of task user has play
            foreach ($listTaskUserHasPlay as $taskUserHasPlay){
                $arrTaskUserHasPlay[] = $taskUserHasPlay->task_id;
            }
        }


        //Check user has followed
        //$questUser->hasTwitterFollowed('Scroll_ZKP');

        return view(
            "quest.posts.show",
            compact('module_title',  'arrTaskUserHasPlay', 'hasFavorited','tasks','module_name', 'module_icon', 'module_action', 'module_name_singular', "$module_name_singular", 'meta_page_type')
        );
    }

    //Ajax Task checkStatus
    //Params: $id
    public function checkStatus(Request $request)
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: *');
        header('Access-Control-Allow-Headers: *');

        /** @var User $questUser */
        $questUser = auth()->guard('quest')->user();

        //Check $questUser is login
        if (!$questUser){
            return response()->json([
                'status' => 0,
                'success'=>'User is not login'
            ]);
        }

        $task_id = $request->task_id;

        /** @var QuestTask $task */
        $task = QuestTask::query()
            ->where('id', $task_id)
            ->first();

        //Check model exists
        if (!$task){
            return response()->json(['success'=>'Task not found']);
        }

        //Check if task is not active
        if ($task->status != Task::STATUS_ACTIVE){
            return response()->json(['success'=>'Task is not active']);
        }

        //$task->save();
        //User Task
        //Get User Task
        $userTaskStatus = UserTaskStatus::query()
            ->where('user_id', $questUser->id)
            ->where('task_id', $task_id)
            ->first();
        //Check if user task exists
        if (!$userTaskStatus){
            //Create new user task
            $userTaskStatus = new UserTaskStatus();
            $userTaskStatus->user_id = auth()->guard('quest')->user()->id;
            $userTaskStatus->task_id = $task_id;
            $userTaskStatus->post_id = $task->post_id;
            $userTaskStatus->status = UserTaskStatus::STATUS_OPEN;

            $userTaskStatus->setOpen();

            $userTaskStatus->save();
        }

        switch ($task->entry_type){
            case Task::TYPE_TWITTER_FOLLOW:
                //$userTaskStatus->url = 'https://twitter.com/'.$task->twitter_username;
                //Check if user has followed
                if ($questUser->hasTwitterFollowed($task->twitter_username)){
                    //Set completed
                    $userTaskStatus->setCompleted();
                    return response()->json(['success'=>'Task is completed']);
                }
                break;
            case Task::TYPE_TWITTER_RETWEET:
                //Check if user has retweeted
                if ($questUser->hasTwitterRetweeted($task->twitter_id)){
                    //Set completed
                    $userTaskStatus->setCompleted();
                    return response()->json(['success'=>'Task is completed']);
                }
                break;
            case Task::TYPE_TWITTER_LIKE:
                //Check if user has liked
                if ($questUser->hasTwitterLiked($task->twitter_id)){
                    //Set completed
                    $userTaskStatus->setCompleted();
                    return response()->json(['success'=>'Task is completed']);
                }
                break;

            case Task::TRANSFER_TYPE_HOLDERS:
                $wallet_address = $questUser->wallet_address;
                $networkName = $task->block_chain_network;
                $totalToken = $task->total_token;

                if ($questUser->hasTokenHolder($networkName, $totalToken )){
                    //Set completed
                    $userTaskStatus->setCompleted();
                    return response()->json([
                        'status' => 1,
                        'success'=>'Task is completed'
                    ]);
                }else{
                    //Check if user has token holder
                    $userTaskStatus->setOpen();
                    return response()->json([
                        'status' => 0,
                        'success'=>'Task is not completed'
                    ]);
                }
                break;
            case Task::TRANSFER_TYPE_ACTIVITY:
                $wallet_address = $questUser->wallet_address;
                $networkName = $task->block_chain_network;
                $totalToken = $task->total_token;
                if ($questUser->hasTransactionActivity($networkName, $totalToken )){
                    //Set completed
                    $userTaskStatus->setCompleted();
                    return response()->json([
                        'status' => 1,
                        'success'=>'Task is completed'
                    ]);
                }else{
                    //Check if user has token holder
                    $userTaskStatus->setOpen();
                    return response()->json([
                        'status' => 0,
                        'success'=>'Task is not completed'
                    ]);
                }
                break;
        }



        //Delay 2s
        sleep(1);

        return response()->json(['success'=>'Data is successfully added']);
    }

    //Fake Status

    //favoritePost
    public function favoritePost(Request $request, Post $post)
    {
        $questUser = auth()->guard('quest')->user();

        if ($questUser->hasFavorited($post)) {
            $questUser->unfavorite($post);
            return response()->json(['success'=>'Post unfavorited']);
        } else {
            $questUser->favorite($post);
            return response()->json(['success'=>'Post favorited']);
        }
    }

}
