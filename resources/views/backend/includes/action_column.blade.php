<div class="text-end">
    @can('edit_'.$module_name)
        <x-backend.buttons.edit route='{!!route("backend.$module_name.edit", $data)!!}'
                                title="{{__('Edit')}} {{ ucwords(Str::singular($module_name)) }}" small="true"/>
    @endcan
    <x-backend.buttons.copy route='{!!route("backend.$module_name.create", $data)!!}' idModel="{{$data->id}}"
                            title="{{__('Copy')}} {{ ucwords(Str::singular($module_name)) }}" small="true"/>

    <x-backend.buttons.show route='{!!route("backend.$module_name.show", $data)!!}'
                            title="{{__('Show')}} {{ ucwords(Str::singular($module_name)) }}" small="true" />
</div>
