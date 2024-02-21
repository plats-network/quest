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

        //Filter end date
        $end_date = '2023-12-1 0:00:00';

         $query = Post::query()
            ->published()
            ->with(['category', 'tags', 'comments'])
            ->where('created_at', '>=', $end_date)
            ->orderBy('id', 'desc');

         //Filter by created_by
        $created_by = $request->created_by?? null;
        if ($created_by){
            $query->where('created_by', '=', $created_by);
        }

        $$module_name = $query->fastPaginate(8);

        return view(
            "quest.posts.index",
            compact('module_title', 'module_name', "$module_name", 'module_icon', 'module_action', 'module_name_singular')
        );
    }

    public function connectTwitter(Request $request)
    {
        /** @var User $questUser */
        $questUser = auth()->guard('quest')->user();
        //Check user has login twitter
        if ($questUser) {
            $userTwitterID = $questUser->twitter_id;
            //dd($userTwitterID);
            return redirect()->route('quest.social.login', ['provider' => 'twitter'])
                ->with('error', 'Please login twitter to play task');
        }

    }
        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Request $request, $hashid)
    {
        $id = ($hashid);
        /** @var User $questUser */
        $questUser = auth()->guard('quest')->user();
        //Check user has login twitter
        if ($questUser){
            $userTwitterID = $questUser->twitter_id;
            //dd($userTwitterID);
            if (!$userTwitterID){
                //Check is local then fake data
                if (config('app.env') == 'local'){
                    $questUser->twitter_id = '1588364698239397888';
                    $questUser->twitter_username = 'Scroll_ZKP';

                    $questUser->save();
                }else{
                    return redirect()->route('quest.social.login', ['provider' => 'twitter'])
                        ->with('error', 'Please login twitter to play task');
                }

            }
        }


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
        //Check user has favorited the post
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
                //status completed
                ->where('status', '=', UserTaskStatus::STATUS_COMPLETED)
                ->get();
            //Get id of task user has play
            foreach ($listTaskUserHasPlay as $taskUserHasPlay){
                //Check if task is completed.   $this->status = self::STATUS_COMPLETED;
                if ($taskUserHasPlay->status == UserTaskStatus::STATUS_COMPLETED){
                    //$isShowReward = true;
                    $arrTaskUserHasPlay[] = $taskUserHasPlay->task_id;
                }

            }
        }
        //Add new for check telegram
        $isUserConnectTelegram = false;
        if ($questUser && $questUser->telegram_id){
            $isUserConnectTelegram = true;
        }
        //$isUserConnectTelegram = false;

        //Check user has followed
        //$Value = $questUser->hasTwitterFollowed('Scroll_ZKP');
        //$Value = $questUser->hasTwitterFollowed2('Scroll_ZKP');
        //dd($Value);
        //$questUser->hasTwitterFollowed2('Scroll_ZKP');

        return view(
            "quest.posts.show",
            compact('module_title',  'arrTaskUserHasPlay', 'hasFavorited','tasks','module_name', 'module_icon',
                'isUserConnectTelegram', 'questUser',
                'module_action', 'module_name_singular', "$module_name_singular", 'meta_page_type')
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

        //Check user task status is done, return true
        if ($userTaskStatus->status == UserTaskStatus::STATUS_COMPLETED && $task->entry_type != Task::TYPE_TELEGRAM_JOIN){
            return response()->json(['success'=>'Task is completed']);
        }

        switch ($task->entry_type){
            case Task::TYPE_TWITTER_FOLLOW:
                //$userTaskStatus->url = 'https://twitter.com/'.$task->twitter_username;
                //Check if user has followed
                $idTweet = $task->getTwitterFollowIdAttribute();

                if ($questUser->hasTwitterFollowed($idTweet)){
                    //Set completed
                    $userTaskStatus->setCompleted();
                    return response()->json(['success'=>'Task is completed']);
                }
                break;
            case Task::TYPE_TWITTER_RETWEET:
                //Sample Url Action https://twitter.com/intent/retweet?tweet_id=1712857718367695177
                $idTweet = $task->getTwitterRetweetIdAttribute();

                //Check if user has retweeted
                if ($questUser->hasTwitterRetweeted($idTweet)){
                    //Set completed
                    $userTaskStatus->setCompleted();
                    return response()->json(['success'=>'Task is completed']);
                }
                break;

            case Task::TYPE_TWITTER_HASHTAG:
                //Sample Url Action https://twitter.com/intent/retweet?tweet_id=1712857718367695177
                $idTweet = $task->getTwitterRetweetIdAttribute();
                $keyHashTag = $task->getTwitterHashtagAttribute(); //WorldCup
                //$userTweetId, $keyHashTag

                //Check if user has retw eeted
                if ($questUser->hasTwitterHashtag($keyHashTag)){
                    //Set completed
                    $userTaskStatus->setCompleted();
                    return response()->json(['success'=>'Task is completed']);
                }
                break;
            case Task::TYPE_TWITTER_LIKE:
                //Check if user has liked
                $idLike = $task->getTwitterLikeIdAttribute();
                //dd($idLike);

                if ($idLike && $questUser->hasTwitterLiked($idLike)){
                    //Set completed
                    $userTaskStatus->setCompleted();

                    return response()->json(['success'=>'Task is completed']);
                }else{
                    return response()->json([
                        'status' => 0,
                        'success'=>'Task is not completed'
                    ]);
                }
                break;

            case Task::TYPE_TELEGRAM_JOIN:
                //Check if user has join group or channel
                $idTelegramUser =  $questUser->telegram_id;

                //Get telegram group, channel id
                $idGroup = $task->telegram_id;

                if ($idTelegramUser && $questUser->hasTelegramJoined($idTelegramUser, $idGroup)){
                    //Set completed
                    $userTaskStatus->setCompleted();

                    return response()->json(['success'=>'Task is completed']);
                }else{
                    return response()->json([
                        'status' => 0,
                        'success'=>'Task is not completed'
                    ]);
                }
                break;

            case Task::TRANSFER_TYPE_HOLDERS:
                $wallet_address = $questUser->wallet_address;
                $networkName = $task->block_chain_network;
                $totalToken = $task->total_token;
                $dataCheck = $questUser->hasTokenHolder($networkName, $totalToken );

                if ($dataCheck['status'] == true){
                    //Set completed
                    $userTaskStatus->setCompleted();
                    return response()->json([
                        'status' => 1,
                        'success'=>'Task is completed',
                        'check' => $dataCheck,
                        'task' => $task->toArray()
                    ]);
                }else{
                    //Check if user has token holder
                    $userTaskStatus->setOpen();
                    return response()->json([
                        'status' => 0,
                        'success'=>'Task is not completed',
                        'check' => $dataCheck,
                        'task' => $task->toArray()
                    ]);
                }
                break;
            case Task::TRANSFER_TYPE_ACTIVITY:
                $wallet_address = $questUser->wallet_address;
                $networkName = $task->block_chain_network;
                $totalToken = $task->total_token;
                $dataCheck = $questUser->hasTransactionActivity($networkName, $totalToken );
                if ($dataCheck['status'] == true){
                    //Set completed
                    $userTaskStatus->setCompleted();
                    return response()->json([
                        'status' => 1,
                        'success'=>'Task is completed',
                        'check' => $dataCheck,
                        'task' => $task->toArray()
                    ]);
                }else{
                    //Check if user has token holder
                    $userTaskStatus->setOpen();
                    return response()->json([
                        'status' => 0,
                        'success'=>'Task is not completed',
                        'check' => $dataCheck,
                        'task' => $task->toArray()
                    ]);
                }
                break;
        }


        //Delay 2s
        //sleep(1);
        $userTaskStatus->setOpen();

        return response()->json([
            'status' => 0,
            'success'=>'Task is not completed'
        ]);
    }

    //Fake Status

    //favoritePost
    public function favoritePost(Request $request, $post_id)
    {
        $quest_id = $request->quest_id;

        $post = Post::findOrFail($post_id);
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
