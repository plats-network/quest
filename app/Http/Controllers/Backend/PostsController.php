<?php

namespace App\Http\Controllers\Backend;

use App\Authorizable;
use App\Events\Backend\Article\PostCreated;
use App\Events\Backend\Article\PostUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\PostsRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\UserReward;
use App\Models\UserTaskStatus;
use Carbon\Carbon;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\DataTables;

class PostsController extends Controller
{
    use Authorizable;

    public $module_title;

    public $module_name;

    public $module_path;

    public $module_icon;

    public $module_model;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Quest';

        // module name
        $this->module_name = 'posts';

        // directory path of the module
        $this->module_path = 'posts';

        // module icon
        $this->module_icon = 'fas fa-file-alt';

        // module model name, path
        $this->module_model = "App\Models\Post";
    }

    //login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials, true)) {
            // Authentication passed...
            return redirect()->intended(route('tasks'));
        } else {
            return redirect()->back()->with('error', 'Invalid Credentials');
        }
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

        $module_action = __('List');

        $$module_name = Post::latest()->fastPaginate();
        Log::info(label_case('Posts'.' '.'List').' | User:'.auth()->user()->name.'(ID:'.auth()->user()->id.')');

        return view(
            'backend.posts.index_datatable',
            compact('module_title', 'module_name', "$module_name", 'module_icon', 'module_name_singular', 'module_action')
        );
    }

    public function index_data()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        $$module_name = Post::select('id', 'name', 'created_by', 'category_name', 'status', 'updated_at', 'published_at', 'is_featured');

        $data = $$module_name;

        return Datatables::of($$module_name)
            ->addColumn('action', function ($data) {
                $module_name = $this->module_name;

                return view('backend.includes.action_column', compact('module_name', 'data'));
            })
            ->editColumn('name', function ($data) {
                $is_featured = ($data->is_featured) ? '<span class="badge bg-primary">Featured</span>' : '';
                $postDetailUrl = route('backend.posts.edit', $data);
                return '<a href="'.$postDetailUrl.'" class="">'.$data->name.' '.$data->status_formatted.' '.$is_featured.'</a></h5>';
            })
            //Task
            ->editColumn('task', function ($data) {
                $module_name = $this->module_name;
                $postTaskUrl = route('backend.tasks.index', ['post_id' => $data->id]);
                $totalTask = $data->tasks()->count();
                $textLink = '<h5><a href="'.$postTaskUrl.'" class="badge bg-primary">'.$totalTask.'</a></h5>';

                return $textLink;
            })
            ->editColumn('category_name', function ($data) {
                $module_name = $this->module_name;

                return $data->category_name;
            })
            //created_by
            ->editColumn('created_by', function ($data) {
                $module_name = $this->module_name;
                $user = User::query()
                    ->where('id', '=', $data->created_by)
                    ->first();
                if ($user) {
                    return $user->name;
                } else {
                    return '';
                }
            })
            ->editColumn('updated_at', function ($data) {
                $module_name = $this->module_name;

                $diff = Carbon::now()->diffInHours($data->updated_at);

                if ($diff < 25) {
                    return $data->updated_at->diffForHumans();
                } else {
                    return $data->updated_at->isoFormat('LLLL');
                }
            })
            ->rawColumns(['name', 'status', 'action', 'task'])
            ->orderColumns(['id'], '-:column $1')
            ->make(true);
    }

    /**
     * Select Options for Select 2 Request/ Response.
     *
     * @return Response
     */
    public function index_list(Request $request)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        $term = trim($request->q);

        if (empty($term)) {
            return response()->json([]);
        }

        $query_data = Post::where('name', 'LIKE', "%$term%")->published()->limit(10)->get();

        $$module_name = [];

        foreach ($query_data as $row) {
            $$module_name[] = [
                'id' => $row->id,
                'text' => $row->name,
            ];
        }

        return response()->json($$module_name);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = __('Create');

        $categories = Category::pluck('name', 'id');

        $isCopy = $request->get('copy');
        //Get id from param categories/create?1 will get 1
        //Get id value
        $idModel = $request->get('idModel');
        //Check has id then copy model
        if ($isCopy) {
            $post  = Post::findOrFail($idModel);
            $$module_name_singular = $post->replicate();
            //Add Post name Copy text
            $$module_name_singular->name = $post->name.' - Copy' . $post->id;
            //Update Slug
            $$module_name_singular->slug = $post->slug.'-copy' . $post->id;
        } else {
            $$module_name_singular = new Post();
            $$module_name_singular->type = 'Article';
            $$module_name_singular->is_featured = 0;
        }


        Log::info(label_case('Posts'.' '.$module_action).' | User:'.auth()->user()->name.'(ID:'.auth()->user()->id.')');

        return view(
            'backend.posts.create',
            compact('module_title', 'module_name', 'module_icon', 'module_action', 'module_name_singular', "$module_name_singular", 'categories')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(PostsRequest $request)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = __('Store');

        $data = $request->except('tags_list');
        $data['created_by_name'] = auth()->user()->name;

        $$module_name_singular = Post::create($data);
        $$module_name_singular->tags()->attach($request->input('tags_list'));

        event(new PostCreated($$module_name_singular));

        Flash::success("<i class='fas fa-check'></i> New '".Str::singular($module_title)."' Added")->important();

        Log::info(label_case('Posts'.' '.$module_action)." | '".$$module_name_singular->name.'(ID:'.$$module_name_singular->id.") ' by User:".auth()->user()->name.'(ID:'.auth()->user()->id.')');

        //return redirect(route('backend.posts.index'));
        return redirect(route('backend.tasks.create', ['post_id' => $$module_name_singular->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $questUser = Auth::guard('quest')->user();

        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = __('Show');
        $isShowReward = false;

        $$module_name_singular = Post::findOrFail($id);

        $activities = Activity::where('subject_type', '=', $module_model)
            ->where('log_name', '=', $module_name)
            ->where('subject_id', '=', $id)
            ->latest()
            ->fastPaginate();
        //List user Post
        $listTasks = $$module_name_singular->tasks()->fastPaginate();
        //List user play
        $listUserID = UserTaskStatus::query()
            ->where('post_id', '=', $id)
            ->get()
            ->pluck('user_id')
            //->unique('user_id')
            ->toArray();

        //Unique value in array
        $listUserID = array_unique($listUserID);

        //Get list user in $listUserID
        $userPlayTasks = User::query()
            ->whereIn('id', $listUserID)
            ->get();

        //UserReward
        $userRewards = UserReward::query()
            ->where('post_id', '=', $id)
            ->get();

        if ($userRewards){
            $isShowReward = true;
        }

        Log::info(label_case('Posts'.' '.$module_action).' | User:'.auth()->user()->name.'(ID:'.auth()->user()->id.')');

        return view(
            'backend.posts.show',
            compact('module_title', 'userRewards', 'isShowReward',  'userPlayTasks', 'module_name', 'module_icon', 'module_name_singular', 'module_action', "$module_name_singular", 'activities')
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = __('Edit');

        $$module_name_singular = Post::findOrFail($id);

        $categories = Category::pluck('name', 'id');

        Log::info(label_case('Posts'.' '.$module_action)." | '".$$module_name_singular->name.'(ID:'.$$module_name_singular->id.") ' by User:".auth()->user()->name.'(ID:'.auth()->user()->id.')');

        return view(
            'backend.posts.edit',
            compact('categories', 'module_title', 'module_name', 'module_icon', 'module_name_singular', 'module_action', "$module_name_singular")
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(PostsRequest $request, $id)
    {
        //dd($request->all());
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Update';

        $$module_name_singular = Post::findOrFail($id);

        $$module_name_singular->update($request->except('tags_list'));

        if ($request->input('tags_list') == null) {
            $tags_list = [];
        } else {
            $tags_list = $request->input('tags_list');
        }
        $$module_name_singular->tags()->sync($tags_list);

        event(new PostUpdated($$module_name_singular));

        Flash::success("<i class='fas fa-check'></i> '".Str::singular($module_title)."' Updated Successfully")->important();

        Log::info(label_case('Posts'.' '.$module_action)." | '".$$module_name_singular->name.'(ID:'.$$module_name_singular->id.") ' by User:".auth()->user()->name.'(ID:'.auth()->user()->id.')');

        return redirect(route('backend.posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'destroy';

        $$module_name_singular = Post::findOrFail($id);

        $$module_name_singular->delete();

        Flash::success('<i class="fas fa-check"></i> '.label_case($module_name_singular).' Deleted Successfully!')->important();

        Log::info(label_case('Posts'.' '.$module_action)." | '".$$module_name_singular->name.', ID:'.$$module_name_singular->id." ' by User:".auth()->user()->name.'(ID:'.auth()->user()->id.')');

        return redirect(route('backend.posts.index'));
    }

    /**
     * List of trashed ertries
     * works if the softdelete is enabled.
     *
     * @return Response
     */
    public function trashed()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Trash List';

        $$module_name = Post::onlyTrashed()->orderBy('deleted_at', 'desc')->fastPaginate();

        Log::info(label_case('Posts'.' '.$module_action).' | User:'.auth()->user()->name);

        return view(
            'backend.posts.trash',
            compact('module_title', 'module_name', "$module_name", 'module_icon', 'module_name_singular', 'module_action')
        );
    }

    /**
     * Restore a soft deleted entry.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function restore($id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Restore';

        $$module_name_singular = Post::withTrashed()->find($id);
        $$module_name_singular->restore();

        Flash::success('<i class="fas fa-check"></i> '.label_case($module_name_singular).' Data Restoreded Successfully!')->important();

        Log::info(label_case($module_action)." '$module_name': '".$$module_name_singular->name.', ID:'.$$module_name_singular->id." ' by User:".auth()->user()->name.'(ID:'.auth()->user()->id.')');

        return redirect(route('backend.posts.index'));
    }

    //ajaxStartLuckyDraw - Start Lucky Draw

    //deleteItem
    public function deleteItem(Request $request)
    {
        $id = $request->get('id');
        $post = Post::query()
            ->where('id', '=', $id)
            ->first();
        if (!$post) {
            return response()->json([
                'success' => false,
                'status' => 1,
                'message' => 'Post not found'
            ]);
        }
        //Delete Post Task
        $post->tasks()->delete();

        //Delete Post
        $post->forceDelete();

        return redirect(route('backend.posts.index'));
    }
    public function ajaxStartLuckyDraw(Request $request)
    {
        $post_id = $request->get('post_id');

        //Model Post
        $post = Post::query()
            ->where('id', '=', $post_id)
            ->first();
        //Check post
        if (!$post) {
            return response()->json([
                'success' => false,
                'status' => 1,
            ]);
        }
        //$total_point = $post->total_point;
        $total_token = $post->total_token;

        //Create Reward For Random 5 user has play task
        UserReward::createReward($post_id, $total_token);
        //Delay 2s
        sleep(2);

        return response()->json([
            'success' => true,
            'status' => 1,
        ]);
    }

}
