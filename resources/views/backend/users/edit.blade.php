@extends ('layouts.backend')

@section('title') {{ __($module_action) }} {{ __($module_title) }} @endsection

@section('breadcrumbs')
<x-backend-breadcrumbs>
    <x-backend-breadcrumb-item route='{{route("backend.$module_name.index")}}' icon='{{ $module_icon }}'>
        {{ __($module_title) }}
    </x-backend-breadcrumb-item>

    <x-backend-breadcrumb-item type="active">{{ __($module_action) }}</x-backend-breadcrumb-item>
</x-backend-breadcrumbs>
@endsection

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                    <li class="breadcrumb-item">
                        <a href="#">
                            <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Transactions</li>
                </ol>
            </nav>
            <h2 class="h4">All Orders</h2>
            <p class="mb-0">Your web analytics dashboard template.</p>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{route('backend.users.create')}}" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
                <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                New Plan
            </a>
            <div class="btn-group ms-2 ms-lg-3">
                <button type="button" class="btn btn-sm btn-outline-gray-600">@lang('Share')</button>
                <button type="button" class="btn btn-sm btn-outline-gray-600">@lang('Export')</button>
            </div>
        </div>
    </div>


<div class="card">
    <div class="card-body">
        <x-backend.section-header>
            <i class="{{ $module_icon }}"></i> {{ __($module_title) }} <small class="text-muted">{{ __($module_action) }}</small>

            <x-slot name="subtitle">
                @lang(":module_name Management Dashboard", ['module_name'=>Str::title($module_name)])
            </x-slot>
            <x-slot name="toolbar">
                <x-backend.buttons.return-back />
                <x-buttons.show route='{!!route("backend.$module_name.show", $$module_name_singular)!!}' title="{{__('Show')}} {{ ucwords(Str::singular($module_name)) }}" class="ms-1" />
            </x-slot>
        </x-backend.section-header>
        <hr>

        <div class="row mt-4">
            <div class="col">
                {{ html()->modelForm($user, 'PATCH', route('backend.users.update', $user->id))->class('form-horizontal')->open() }}

                <div class="row mb-3">
                    <?php
                    $field_name = 'email';
                    $field_lable = __('labels.backend.users.fields.email');
                    $field_placeholder = $field_lable;
                    $required = "required";
                    ?>
                    <div class="col-12 col-sm-2">
                        <div class="form-group">
                            {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
                        </div>
                    </div>
                    <div class="col-12 col-sm-10">
                        <div class="form-group">
                            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <?php
                    $field_name = 'password';
                    $field_lable = __('labels.backend.users.fields.password');
                    $field_placeholder = $field_lable;
                    $required = "required";
                    ?>
                    <div class="col-12 col-sm-2">
                        <div class="form-group">
                            {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
                        </div>
                    </div>
                    <div class="col-12 col-sm-10">
                        <div class="form-group">
                            <a href="{{ route('backend.users.changePassword', $user->id) }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-key"></i> Change password</a>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <?php
                    $field_name = 'profile';
                    $field_lable = __('Profile');
                    $field_placeholder = $field_lable;
                    $required = "";
                    ?>
                    <div class="col-12 col-sm-2">
                        <div class="form-group">
                            {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
                        </div>
                    </div>
                    <div class="col-12 col-sm-10">
                        <div class="form-group">
                            <a href="{{ route('backend.users.profileEdit', $user->id) }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-user"></i> Update Profile</a>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <?php
                    $field_name = 'confirmed';
                    $field_lable = __('labels.backend.users.fields.confirmed');
                    $field_placeholder = $field_lable;
                    $required = "";
                    ?>
                    <div class="col-12 col-sm-2">
                        <div class="form-group">
                            {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
                        </div>
                    </div>
                    <div class="col-12 col-sm-10">
                        <div class="form-group">
                            @if ($user->email_verified_at == null)
                            <a href="{{route('backend.users.emailConfirmationResend', $user->id)}}" class="btn btn-outline-primary btn-sm " data-toggle="tooltip" title="Send Confirmation Email"><i class="fas fa-envelope"></i> Send Confirmation Email</a>
                            @else
                            {!! $user->confirmed_label !!}
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <?php
                    $field_name = 'social';
                    $field_lable = __('labels.backend.users.fields.social');
                    $field_placeholder = $field_lable;
                    $required = "";
                    ?>
                    <div class="col-12 col-sm-2">
                        <div class="form-group">
                            {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
                        </div>
                    </div>
                    <div class="col-12 col-sm-10">
                        <div class="form-group">
                            @forelse ($user->providers as $provider)
                            <li>
                                <i class="fab fa-{{ $provider->provider }}"></i> {{ label_case($provider->provider) }}
                            </li>
                            @empty
                            {{ __("No social profile added!") }}
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-3">
                    {{ html()->label(__('Abilities'))->class('col-sm-2 form-control-label') }}
                    <div class="col">
                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <div class="card card-accent-primary">
                                    <div class="card-header">
                                        @lang('Roles')
                                    </div>
                                    <div class="card-body">
                                        @if ($roles->count())
                                        @foreach($roles as $role)
                                        <div class="card mb-3">
                                            <div class="card-header">
                                                <div class="checkbox">
                                                    {{ html()->label(html()->checkbox('roles[]', in_array($role->name, $userRoles), $role->name)->id('role-'.$role->id) . "&nbsp;". ucwords($role->name) . "&nbsp;(".$role->name.")")->for('role-'.$role->id) }}
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                @if ($role->id != 1)
                                                @if ($role->permissions->count())
                                                @foreach ($role->permissions as $permission)
                                                <i class="far fa-check-circle mr-1"></i>&nbsp;{{ $permission->name }}&nbsp;
                                                @endforeach
                                                @else
                                                @lang('None')
                                                @endif
                                                @else
                                                @lang('All Permissions')
                                                @endif
                                            </div>
                                        </div>
                                        <!--card-->
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card card-accent-info">
                                    <div class="card-header">
                                        @lang('Permissions')
                                    </div>
                                    <div class="card-body">
                                        @if ($permissions->count())
                                        @foreach($permissions as $permission)
                                        <div class="checkbox">
                                            {{ html()->label(html()->checkbox('permissions[]', in_array($permission->name, $userPermissions), $permission->name)->id('permission-'.$permission->id) . ' ' . $permission->name)->for('permission-'.$permission->id) }}
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <x-backend.buttons.save />
                        </div>
                    </div>

                    <div class="col-sm-8">
                        <div class="float-end">
                            @if ($$module_name_singular->status != 2 && $$module_name_singular->id != 1)
                            <a href="{{route('backend.users.block', $$module_name_singular)}}" class="btn btn-danger" data-method="PATCH" data-token="{{csrf_token()}}" data-toggle="tooltip" title="{{__('labels.backend.block')}}" data-confirm="Are you sure?"><i class="fas fa-ban"></i></a>
                            @endif
                            @if ($$module_name_singular->status == 2)
                            <a href="{{route('backend.users.unblock', $$module_name_singular)}}" class="btn btn-info" data-method="PATCH" data-token="{{csrf_token()}}" data-toggle="tooltip" title="{{__('labels.backend.unblock')}}" data-confirm="Are you sure?"><i class="fas fa-check"></i> Unblock</a>
                            @endif
                            @if ($$module_name_singular->email_verified_at == null)
                            <a href="{{route('backend.users.emailConfirmationResend', $$module_name_singular->id)}}" class="btn btn-primary" data-toggle="tooltip" title="Send Confirmation Email"><i class="fas fa-envelope"></i></a>
                            @endif
                            @if($$module_name_singular->id != 1)
                            <a href="{{route("backend.$module_name.destroy", $$module_name_singular)}}" class="btn btn-danger" data-method="DELETE" data-token="{{csrf_token()}}" data-toggle="tooltip" title="{{__('labels.backend.delete')}}"><i class="fas fa-trash-alt"></i> Delete</a>
                            @endif
                            <x-backend.buttons.return-back>@lang('Cancel')</x-backend.buttons.return-back>
                        </div>
                    </div>
                </div>
                {{ html()->closeModelForm() }}
            </div>
            <!--/.col-->
        </div>
        <!--/.row-->
    </div>
    <div class="card-footer">
        <div class="row mb-3">
            <div class="col">
                <small class="float-end text-muted">
                    @lang('Updated') {{$user->updated_at->diffForHumans()}},
                    @lang('Created at') {{$user->created_at->isoFormat('LLLL')}}
                </small>
            </div>
        </div>
    </div>
</div>

@endsection
