<?php

namespace App\Http\Controllers\FrontendQuest;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CommentsRequest;
use App\Models\Post;
use App\Notifications\NewCommentAdded;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Comment;

class CommentsController extends Controller
{
    public $module_title;

    public $module_name;

    public $module_path;

    public $module_icon;

    public $module_model;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Comments';

        // module name
        $this->module_name = 'comments';

        // module icon
        $this->module_icon = 'fas fa-comments';

        // module model name, path
        $this->module_model = "App\Models\Comment";
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
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        $$module_name = Comment::latest()->published()->paginate();

        return view(
            "quest.comments.index",
            compact('module_title', 'module_name', "$module_name", 'module_icon', 'module_action', 'module_name_singular')
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $id = decode_id($id);

        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = __('Show');

        $$module_name_singular = Comment::whereId($id)->published()->first();

        if (! $$module_name_singular) {
            abort(404);
        }

        return view(
            "quest.comments.show",
            compact('module_title', 'module_name', 'module_icon', 'module_action', 'module_name_singular', "$module_name_singular")
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(CommentsRequest $request)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = __('Store');

        $data = [
            'name' => $request->name,
            'comment' => $request->comment,
            'user_id' => (isset($request->user_id)) ? decode_id($request->user_id) : null,
            'parent_id' => (isset($request->parent_id)) ? decode_id($request->parent_id) : null,
        ];

        if (isset($request->post_id)) {
            $commentable_id = decode_id($request->post_id);

            $commentable_type = "App\Models\Post";

            $row = Post::findOrFail($commentable_id);

            $$module_name_singular = $row->comments()->create($data);
        }

        if (isset($$module_name_singular)) {
            auth()->guard('quest')->user()->notify(new NewCommentAdded($$module_name_singular));
        }

        Flash::success("<i class='fas fa-check'></i> New '".Str::singular($module_title)."' Added")->important();

        Log::info(label_case($module_title.' '.$module_action)." | '".$$module_name_singular->name.'(ID:'.$$module_name_singular->id.") ' by User:".auth()->guard('quest')->user()->name.'(ID:'.auth()->guard('quest')->user()->id.')');

        return redirect()->back();
    }
}
