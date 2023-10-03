<?php

namespace App\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Backend\BackendBaseController;
use App\Http\Requests\Backend\CategoriesRequest;
use App\Models\Post;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;
use App\Http\Requests\Backend\TasksRequest;
class TasksController extends Controller
{
    //use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Tasks';

        // module name
        $this->module_name = 'tasks';

        // directory path of the module
        $this->module_path = 'Task::backend';

        // module icon
        $this->module_icon = 'fas fa-sitemap';

        // module model name, path
        $this->module_model = "App\Models\Task";
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
        //Get quest param
        $post_id = $request->get('post_id');
        //Model Post
        $post = Post::query()
            ->where('id', $post_id)->first();

        $$module_name = Task::latest()
            ->where('post_id', $post_id)
            ->paginate();

        Log::info(label_case($module_title.' '.$module_action).' | User:'.auth()->user()->name.'(ID:'.auth()->user()->id.')');

        return view(
            "backend.tasks.index_datatable",
            compact('module_title',  'post','module_name', "$module_name", 'module_icon', 'module_name_singular', 'module_action')
        );
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

        $query_data = Task::where('name', 'LIKE', "%$term%")->orWhere('slug', 'LIKE', "%$term%")->limit(7)->get();

        $$module_name = [];

        foreach ($query_data as $row) {
            $$module_name[] = [
                'id' => $row->id,
                'text' => $row->name.' (Slug: '.$row->slug.')',
            ];
        }

        return response()->json($$module_name);
    }

    public function index_data(Request $request)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';
        //Post id
        $post_id = $request->get('post_id');

        //Filter task by post id
        $$module_name = Task::select('id', 'name', 'status', 'slug', 'entry_type',  'updated_at')
        ->where('post_id', $post_id);


        $data = $$module_name;

        return Datatables::of($$module_name)
            ->addColumn('action', function ($data) {
                $module_name = $this->module_name;
                //Data is Model Item

                return view('backend.includes.action_column', compact('module_name', 'data'));
            })
            //->editColumn('name', '<strong>{{$name}}</strong>')
            ->editColumn('name', function ($data) {
                //$is_featured = ($data->is_featured) ? '<span class="badge bg-primary">Featured</span>' : '';

                return $data->name.' '.$data->status_formatted;
            })
            //Status
            ->editColumn('status', function ($data) {
                $status = $data->status;
                $status_formatted = $data->status_formatted;
                $status_color = $data->status_color;
                return '<span class="badge bg-'.$status_color.'">'.$status.'</span>';
            })
            ->editColumn('slug', function ($data) {
                return '<span class="badge badge-secondary">'.$data->slug.'</span>';
            })
            ->editColumn('type', function ($data) {
                $allType = Task::getTaskType();
                $type = $data->entry_type?? 1;
                return '<button class="btn text-bg-success btn-sm"> <svg class="icon icon-xs me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
    <path fill="currentColor" d="M12.186 8.672 18.743.947h-2.927l-5.005 5.9-4.44-5.9H0l7.434 9.876-6.986 8.23h2.927l5.434-6.4 4.82 6.4H20L12.186 8.672Zm-2.267 2.671L8.544 9.515 3.2 2.42h2.2l4.312 5.719 1.375 1.828 5.731 7.613h-2.2l-4.699-6.237Z"/>
  </svg>
   '.$allType[$type] .'</button>';
            })

            ->editColumn('updated_at', function ($data) {
                $module_name = $this->module_name;

                $diff = Carbon::now()->diffInHours($data->updated_at);

                if ($diff < 25) {
                    return $data->updated_at. ' '. $data->updated_at->diffForHumans();
                } else {
                    return $data->updated_at->isoFormat('LLLL');
                }
            })
            ->rawColumns(['name', 'action', 'type', 'status'])
            ->orderColumns(['id'], '-:column $1')
            ->make(true);
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
        $isCopy = $request->get('copy');
        $post_id = $request->get('post_id');

        //Check owner post

        //Get id from param task/create?1 will get 1
        //Get id value
        $idModel = $request->get('idModel');
        //Check has id then copy model
        if ($isCopy) {
            $post  = Task::findOrFail($idModel);
            //Set post id
            $post_id = $post->post_id;
            $$module_name_singular = $post->replicate();
            //Add Title copy
            $$module_name_singular->name = $post->name.' Copy' . $post->id;
            //update slug
            $$module_name_singular->slug = $post->slug.'-copy' . $post->id;
        } else {
            $$module_name_singular = new $module_model();
            //Set post id
            $$module_name_singular->post_id = $post_id;
        }
        //Get post model
        $post = Post::query()
            ->where('id', $post_id)
            ->first();

        $all_task_type = Task::getTaskType();

        Log::info(label_case($module_title.' '.$module_action).' | User:'.auth()->user()->name.'(ID:'.auth()->user()->id.')');

        return view(
            "backend.tasks.create",
            compact('module_title', 'all_task_type', 'post_id','module_name', 'module_path', 'module_icon', 'module_name_singular', 'module_action', "$module_name_singular")
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(TasksRequest $request)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = __('Store');

        $validatedData = $request->validate([
            'name' => 'required|max:191',
        ]);

        $$module_name_singular = Task::create($request->except('image'));

        if ($request->image) {
            $media = $$module_name_singular->addMedia($request->file('image'))->toMediaCollection($module_name);
            $$module_name_singular->image = $media->getUrl();
            $$module_name_singular->save();
        }

        flash(icon()."New '".Str::singular($module_title)."' Added")->success()->important();

        logUserAccess($module_title.' '.$module_action.' | Id: '.$$module_name_singular->id);

        return redirect(route('backend.tasks.index', ['post_id' => $request->post_id] ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Show';

        $$module_name_singular = Task::findOrFail($id);

        $post = Post::query()
            ->where('id', $$module_name_singular->post_id)->first();

        logUserAccess($module_title.' '.$module_action.' | Id: '.$$module_name_singular->id);

        return view(
            "backend.tasks.show",
            compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_name_singular', 'module_action', "$module_name_singular", 'post')
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

        $$module_name_singular = Task::findOrFail($id);
        $all_task_type = Task::getTaskType();
        $post_id = $$module_name_singular->post_id;
        Log::info(label_case($module_title.' '.$module_action)." | '".$$module_name_singular->name.'(ID:'.$$module_name_singular->id.") ' by User:".auth()->user()->name.'(ID:'.auth()->user()->id.')');

        return view(
            "backend.tasks.edit",
            compact('module_title',  'post_id','all_task_type', 'module_name', 'module_path', 'module_icon', 'module_name_singular', 'module_action', "$module_name_singular")
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Update';

        $validatedData = $request->validate([
            'name' => 'required|max:191|unique:'.$module_model.',name,'.$id,
            'slug' => 'nullable|max:191|unique:'.$module_model.',slug,'.$id,
        ]);

        $$module_name_singular = $module_model::findOrFail($id);

        $$module_name_singular->update($request->except('image', 'image_remove'));

        // Image
        if ($request->hasFile('image')) {
            if ($$module_name_singular->getMedia($module_name)->first()) {
                $$module_name_singular->getMedia($module_name)->first()->delete();
            }
            $media = $$module_name_singular->addMedia($request->file('image'))->toMediaCollection($module_name);

            $$module_name_singular->image = $media->getUrl();

            $$module_name_singular->save();
        }
        if ($request->image_remove == 'image_remove') {
            if ($$module_name_singular->getMedia($module_name)->first()) {
                $$module_name_singular->getMedia($module_name)->first()->delete();

                $$module_name_singular->image = '';

                $$module_name_singular->save();
            }
        }

        flash(icon().' '.Str::singular($module_title)."' Updated Successfully")->success()->important();

        logUserAccess($module_title.' '.$module_action.' | Id: '.$$module_name_singular->id);

        return redirect()->route("backend.$module_name.show", $$module_name_singular->id);
    }
}
