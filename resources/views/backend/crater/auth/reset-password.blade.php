@extends('sale.layouts.base')

@section('content')
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">

                        <div class="text-center mt-4">
                            <h1 class="h2">Reset password</h1>
                            <p class="lead">
                                Enter your email to reset your password.
                            </p>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-4">
                                    @if(session()->get('warning'))
                                        <div class="container-fluid p-0">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                                aria-label="Close"></button>
                                                        <div class="alert-message">
                                                            {{ session()->get('warning') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($errors->any())
                                        <div class="container-fluid p-0">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                                aria-label="Close"></button>
                                                        <div class="alert-message">
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <form method="POST" action="{{route('salePostLogin')}}">
                                        {{ csrf_field() }}

                                        <div class="mb-3">
                                            <label class="form-label">{{__('crater.customers.email')}}</label>
                                            <input class="form-control form-control-lg" type="text" name="name" required
                                                   value="{{ old('name') }}"
                                                   {{$errors->has('name') ? 'is-invalid' : ''}}
                                                   placeholder="Nhập địa chỉ email"/>
                                            @if ($errors->has('name'))
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ $errors->first('name') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="text-center mt-3">
                                            <button type="submit" class="btn btn-lg btn-primary">Reset password</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
