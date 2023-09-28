@extends('admin.layouts.horizontal')
@section("pageTitle","Settings")

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Thiết lập</h1>

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

                                <h5 class="card-title mb-0">Mail Configuration</h5>
                            </div>
                            <div class="card-body">
                                <form method="post" action="{{ route('admin.saveMailConfig') }}">

                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="inputUsername"><b>Mail Driver
                                                                *</b></label>

                                                        <select class="form-select" aria-label="" name="mail_driver">
                                                            @foreach($config_driver as $key => $driver)
                                                                <option
                                                                    value="{{$driver}}" {!! ( $driver == $mail_driver) ? ' selected="selected"' : '' !!}>{{$driver}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="inputPasswordNew"><b>From Mail
                                                                Address *</b></label>
                                                        <input type="text" name="from_mail" class="form-control @error('evaluate_quality') is-invalid @enderror"
                                                               id="inputPasswordNew" value="{{$from_mail}}">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="mb-3">
                                                <label class="form-label" for="inputPasswordNew2"><b>From Mail Name
                                                        *</b></label>
                                                <input type="text" name="from_name" class="form-control @error('evaluate_quality') is-invalid @enderror"
                                                       id="inputPasswordNew2" value="{{$from_name}}">
                                            </div>

                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                    <button type="button" class="btn btn-secondary">Test Mail Configuration</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
