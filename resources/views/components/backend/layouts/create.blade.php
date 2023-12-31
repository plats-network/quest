@props(["data"=>"", "module_name", "post_id", "all_task_type", "module_path", "module_title"=>"", "module_icon"=>"", "module_action"=>""])
<div class="card">
    @if ($slot != "")
    <div class="card-body">
        {{ $slot }}
    </div>
    @else
    <div class="card-body">

        <x-backend.section-header :module_name="$module_name" :module_title="$module_title" :module_icon="$module_icon" :module_action="$module_action" />

        <div class="row mt-4">
            <div class="col">
                {{ html()->modelForm($data, 'POST', route("backend.$module_name.store", $data))->class('form')->acceptsFiles()->open() }}


                @include ("backend.$module_name.form")

                <div class="row">
                    <div class="col-6">
                        <x-backend.buttons.create>Create</x-backend.buttons.create>
                    </div>
                    <div class="col-6">
                        <div class="float-end">
                            <x-backend.buttons.cancel />
                        </div>
                    </div>
                </div>

                {{ html()->form()->close() }}
            </div>
        </div>
    </div>
    @endif

    <div class="card-footer">
        <div class="row">
            <div class="col">
                @if ($data != "" && $data->id != "")
                <small class="float-end text-muted">
                    @lang('Updated at'): {{$data->updated_at->diffForHumans()}},
                    @lang('Created at'): {{$data->created_at->isoFormat('LLLL')}}
                </small>
                @endif
            </div>
        </div>
    </div>
</div>
