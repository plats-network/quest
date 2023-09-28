@extends('admin.layouts.horizontal')
@section("pageTitle","Settings")

@section('content')
    <div class="py-4">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item">
                    <a href="{{route('admin.homeAdmin')}}">
                        <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="{{route('admin.homeAdmin')}}">{{__('crater.general.home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thiết lập</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4 mt-3">Thiết lập</h1>
            </div>
        </div>
    </div>

    <div class="container-fluid p-0">


        <div class="row">
            <div class="col-md-4 col-xl-3">

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Profile Settings</h5>
                    </div>

                    @include('admin.crater.settings.partials._menuSetting')
                </div>
            </div>

            <div class="col-md-8 col-xl-9">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="account" role="tabpanel">

                        <div class="card">
                            <div class="card-header">

                                <h5 class="card-title mb-0">Account Setting</h5>
                            </div>
                            <div class="card-body">
                                <form method="post" action="{{ route('admin.saveMailConfig') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="mb-3">
                                                <label class="form-label" for="inputUsername">Username</label>
                                                <input type="text" class="form-control @error('evaluate_quality') is-invalid @enderror" id="inputUsername"
                                                       placeholder="Username">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="inputPasswordNew">Mật khẩu</label>
                                                <input type="password" class="form-control @error('evaluate_quality') is-invalid @enderror" id="inputPasswordNew">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="inputPasswordNew2">Verify
                                                    password</label>
                                                <input type="password" class="form-control @error('evaluate_quality') is-invalid @enderror" id="inputPasswordNew2">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="inputPasswordNew2">Language</label>
                                                <input type="password" class="form-control @error('evaluate_quality') is-invalid @enderror" id="inputPasswordNew2">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="inputUsername">Biography</label>
                                                <textarea rows="2" class="form-control @error('evaluate_quality') is-invalid @enderror" id="inputBio"
                                                          placeholder="Tell something about yourself"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="text-center">
                                                <img alt="Charles Hall"
                                                     src="{{ asset_cdn('adminkit/static/img/avatars/avatar.jpg') }}"
                                                     class="rounded-circle lazyload img-responsive mt-2" width="128"
                                                     height="128"/>
                                                <div class="mt-2">
                                                    <span class="btn btn-primary">Upload</span>
                                                </div>
                                                <small>For best results, use an image at least 128px by 128px in .jpg
                                                    format</small>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
