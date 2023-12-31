@extends ('layouts.backend')

@section('title') {{ __($module_action) }} {{ __($module_title) }} @endsection

@section('breadcrumbs')
<x-backend-breadcrumbs>
    <x-backend-breadcrumb-item route='{{route("backend.$module_name.index")}}' icon='{{ $module_icon }}'>
        {{ __($module_title) }}
    </x-backend-breadcrumb-item>

    <x-backend-breadcrumb-item type="active">Profile</x-backend-breadcrumb-item>
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
            <a href="{{route('backend.categories.create')}}" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
                <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                New Plan
            </a>
            <div class="btn-group ms-2 ms-lg-3">
                <button type="button" class="btn btn-sm btn-outline-gray-600">@lang('Share')</button>
                <button type="button" class="btn btn-sm btn-outline-gray-600">@lang('Export')</button>
            </div>
        </div>
    </div>
    <div class="table-settings mb-4">
        <div class="row align-items-center justify-content-between">
            <div class="col col-md-6 col-lg-3 col-xl-4">
                <div class="input-group me-2 me-lg-3 fmxw-400">
                            <span class="input-group-text">
                                <svg class="icon icon-xs" x-description="Heroicon name: solid/search" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                                </svg>
                            </span>
                    <input type="text" class="form-control" placeholder="Search orders">
                </div>
            </div>
            <div class="col-4 col-md-2 col-xl-1 ps-md-0 text-end">
                <div class="dropdown">
                    <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path></svg>
                        <span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-xs dropdown-menu-end pb-0">
                        <span class="small ps-3 fw-bold text-dark">@lang('Show')</span>
                        <a class="dropdown-item d-flex align-items-center fw-bold" href="#">10 <svg class="icon icon-xxs ms-auto" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg></a>
                        <a class="dropdown-item fw-bold" href="#">20</a>
                        <a class="dropdown-item fw-bold rounded-bottom" href="#">30</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="card">
    <div class="card-body">
        <x-backend.section-header>
            <i class="{{ $module_icon }}"></i> {{ __('Profile') }} <small class="text-muted">{{ __($module_action) }}</small>

            <x-slot name="subtitle">
                @lang(":module_name Management Dashboard", ['module_name'=>Str::title($module_name)])
            </x-slot>
            <x-slot name="toolbar">
                <x-backend.buttons.return-back />
                <x-buttons.edit route='{!!route("backend.$module_name.profileEdit", $$module_name_singular)!!}' title="{{__('Edit')}}" class="ms-1" />
            </x-slot>
        </x-backend.section-header>


        <div class="row mt-4 mb-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th>{{ __('labels.backend.users.fields.avatar') }}</th>
                            <td><img src="{{asset($user->avatar)}}" class="user-profile-image img-fluid img-thumbnail" style="max-height:200px; max-width:200px;" /></td>
                        </tr>

                        <?php $fields_array = [
                            ['name' => 'name'],
                            ['name' => 'email'],
                            ['name' => 'mobile'],
                            ['name' => 'gender'],
                            ['name' => 'date_of_birth', 'type' => 'date'],
                            ['name' => 'url_website', 'type' => 'url'],
                            ['name' => 'url_facebook', 'type' => 'url'],
                            ['name' => 'url_twitter', 'type' => 'url'],
                            ['name' => 'url_linkedin', 'type' => 'url'],
                            ['name' => 'profile_privecy'],
                            ['name' => 'address'],
                            ['name' => 'bio'],
                            ['name' => 'login_count'],
                            ['name' => 'last_login', 'type' => 'datetime'],
                            ['name' => 'last_ip'],
                        ]; ?>
                        @foreach ($fields_array as $field)
                        <tr>
                            @php
                            $field_name = $field['name'];
                            $field_type = isset($field['type'])? $field['type'] : '';
                            @endphp

                            <th>{{ __("labels.backend.users.fields.".$field_name) }}</th>

                            @if ($field_name == 'date_of_birth' && $userprofile->$field_name != '')
                            <td>
                                @if(auth()->user()->id == $userprofile->user_id)
                                {{ $userprofile->$field_name->isoFormat('LL') }}
                                @else
                                {{ $userprofile->$field_name->format('jS \\of F') }}
                                @endif
                            </td>
                            @elseif ($field_type == 'date' && $userprofile->$field_name != '')
                            <td>
                                {{ $userprofile->$field_name->isoFormat('LL') }}
                            </td>
                            @elseif ($field_type == 'datetime' && $userprofile->$field_name != '')
                            <td>
                                {{ $userprofile->$field_name->isoFormat('llll') }}
                            </td>
                            @elseif ($field_type == 'url')
                            <td>
                                <a href="{{ $userprofile->$field_name }}" target="_blank">{{ $userprofile->$field_name }}</a>
                            </td>
                            @else
                            <td>{{ $userprofile->$field_name }}</td>
                            @endif
                        </tr>
                        @endforeach

                        <tr>
                            <th>{{ __('labels.backend.users.fields.password') }}</th>
                            <td>
                                <a href="{{ route('backend.users.changeProfilePassword', $user->id) }}" class="btn btn-outline-primary btn-sm">Change password</a>
                            </td>
                        </tr>

                        <tr>
                            <th>{{ __('labels.backend.users.fields.social') }}</th>
                            <td>
                                <ul class="list-unstyled">
                                    @foreach ($user->providers as $provider)
                                    <li>
                                        <i class="fab fa-{{ $provider->provider }}"></i> {{ label_case($provider->provider) }}
                                    </li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                        {{--Language --}}
                        <tr>
                            <th>{{ __('labels.backend.users.fields.language') }}</th>
                            <td>
                                @if($user->language)
                                <span class="badge badge-success">{{ $user->language->name }}</span>
                                @else
                                <span class="badge badge-danger">No Language</span>
                                @endif
                            </td>

                        <tr>
                            <th>{{ __('labels.backend.users.fields.status') }}</th>
                            <td>{!! $user->status_label !!}</td>
                        </tr>

                        <tr>
                            <th>{{ __('labels.backend.users.fields.confirmed') }}</th>
                            <td>{!! $user->confirmed_label !!}</td>
                        </tr>
                        <tr>
                            <th>{{ __('labels.backend.users.fields.roles') }}</th>
                            <td>
                                @if($user->roles()->count() > 0)
                                <ul>
                                    @foreach ($user->roles() as $role)
                                    <li>{{ ucwords($role) }}</li>
                                    @endforeach
                                </ul>
                                @endif
                            </td>

                        </tr>
                        <tr>
                            <th>{{ __('labels.backend.users.fields.permissions') }}</th>
                            <td>
                                @if($user->permissions()->count() > 0)
                                <ul>
                                    @foreach ($user->permissions() as $permission)
                                    <li>{{ $permission['name'] }}</li>
                                    @endforeach
                                </ul>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th>{{ __('labels.backend.users.fields.created_at') }}</th>
                            <td>{{ $user->created_at->isoFormat('llll') }}<br><small>({{ $user->created_at->diffForHumans() }})</small></td>
                        </tr>

                        <tr>
                            <th>{{ __('labels.backend.users.fields.updated_at') }}</th>
                            <td>{{ $user->updated_at->isoFormat('llll') }}<br /><small>({{ $user->updated_at->diffForHumans() }})</small></td>
                        </tr>

                    </table>
                </div>
                <!--table-responsive-->
            </div>
            <!--/.col-->
        </div>
        <!--/.row-->
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col">
                <small class="float-end text-muted">
                    Updated: {{$user->updated_at->diffForHumans()}},
                    Created at: {{$user->created_at->isoFormat('LLLL')}}
                </small>
            </div>
        </div>
    </div>
</div>
@endsection
