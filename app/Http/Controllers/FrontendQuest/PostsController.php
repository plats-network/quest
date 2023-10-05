<?php

namespace App\Http\Controllers\FrontendQuest;

use App\Events\Backend\Article\PostViewed;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Task;
use Illuminate\Http\Request;
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
    public function index()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        $$module_name = Post::latest()->with(['category', 'tags', 'comments'])->paginate();

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
    public function show($hashid)
    {
        $id = decode_id($hashid);

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
        //List active tasks
        $tasks = $$module_name_singular->tasks_active()->latest()->get();

        event(new PostViewed($$module_name_singular));

        //$user->hasFavorited($post);
        $hasFavorited = false;
        //Check has $questUser
        if ($questUser){
            $hasFavorited = $questUser->hasFavorited($$module_name_singular);

        }

        return view(
            "quest.posts.show",
            compact('module_title', 'hasFavorited','tasks','module_name', 'module_icon', 'module_action', 'module_name_singular', "$module_name_singular", 'meta_page_type')
        );
    }

    //Ajax Task checkStatus
    //Params: $id
    public function checkStatus(Request $request)
    {
        $task_id = $request->task_id;

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

        $task->status = 1;
        //$task->save();
        //Delay 2s
        sleep(1);

        return response()->json(['success'=>'Data is successfully added']);
    }

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
