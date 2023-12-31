@extends('quest.layouts.app')

@section('title') {{$$module_name_singular->name}}'s Profile @endsection

@section('content')

<section class="section-header bg-primary text-white pb-7 pb-lg-11">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 text-center">
                <h1 class="display-2 mb-4">
                    {{$$module_name_singular->name}}
                    @auth
                    @if(auth()->guard('quest')->user()->id == $$module_name_singular->id)
                    <small>
                        <a href="{{ route('quest.users.profileEdit', encode_id($$module_name_singular->id)) }}" class="btn btn-primary btn-sm">@lang('Show')</a>
                    </small>
                    @endif
                    @endauth
                </h1>
                <p class="lead">
                    Username:{{$$module_name_singular->username}}
                </p>
                @if ($$module_name_singular->email_verified_at == null)
                <p class="lead">
                    <a href="{{route('quest.users.emailConfirmationResend', encode_id($$module_name_singular->id))}}">Confirm Email</a>
                </p>
                @endif

                @include('quest.includes.messages')
            </div>
        </div>
    </div>
    <div class="pattern bottom"></div>
</section>
<section class="section section-lg line-bottom-light">
    <div class="container mt-n7 mt-lg-n12 z-2">
        <div class="row">
            <div class="col-lg-12 mb-5">
                <div class="card bg-white border-light shadow-soft flex-md-row no-gutters p-4">
                    <div class="card-body d-flex flex-column justify-content-between col-auto py-4 p-lg-5">
                        <div class="row mt-4 mb-4">
                            <div class="col">
                                {{ html()->form('PATCH', route('quest.users.changePasswordUpdate', auth()->guard('quest')->user()->username))->class('form-horizontal')->open() }}

                                <div class="form-group row">
                                    {{ html()->label(__('labels.backend.users.fields.password'))->class('col-md-3 form-control-label')->for('password') }}

                                    <div class="col-md-9">
                                        {{ html()->password('password')
                                            ->class('form-control')
                                            ->placeholder(__('labels.backend.users.fields.password'))
                                            ->required() }}
                                    </div>
                                </div><!--form-group-->

                                <div class="form-group row">
                                    {{ html()->label(__('labels.backend.users.fields.password_confirmation'))->class('col-md-3 form-control-label')->for('password_confirmation') }}

                                    <div class="col-md-9">
                                        {{ html()->password('password_confirmation')
                                            ->class('form-control')
                                            ->placeholder(__('labels.backend.users.fields.password_confirmation'))
                                            ->required() }}
                                    </div>
                                </div><!--form-group-->

                                <div class="row">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    {{ html()->button($text = "<i class='fas fa-save'></i>&nbsp;Save", $type = 'submit')->class('btn btn-success') }}

                                                    <a href="{{ route("quest.$module_name.profile", auth()->guard('quest')->user()->username) }}" class="btn btn-warning" data-toggle="tooltip" title="{{__('labels.backend.cancel')}}"><i class="fas fa-reply"></i>&nbsp;Back</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{ html()->closeModelForm() }}
                            </div>
                            <!--/.col-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
