@extends('sale.layouts.base')
@section('style')
    <style>
        .col-img {
            /* background: scroll center url('https://source.unsplash.com/-4kwrnRrk-E/800x800'); */
            background: scroll center url('https://images.unsplash.com/photo-1587613757703-eea60bd69e66?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=800&h=800&fit=crop&ixid=eyJhcHBfaWQiOjF9');
            background-size: cover;
            min-height: 100vh;
        }

        .btn {
            border-radius: 5em;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-6 align-self-center">
                <div class="m-3 m-lg-5">
                    <div class="card">
                        <div class="card-body">

                            <div class="text-center mt-4">
                                <h1 class="h3">Đăng ký tài khoản</h1>
                                <p class="lead">
                                    Start creating the best possible user experience for your customers.
                                </p>
                            </div>

                            <form>
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input class="form-control @error('evaluate_quality') is-invalid @enderror" type="text" name="name" placeholder="Nhập  your name"/>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">{{__('crater.users.email')}}</label>
                                    <input class="form-control @error('evaluate_quality') is-invalid @enderror" type="email" name="email"
                                           placeholder="Nhập địa chỉ email"/>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">{{__('crater.users.password')}}</label>
                                    <input class="form-control @error('evaluate_quality') is-invalid @enderror" type="password" name="password"
                                           placeholder="Mật khẩu"/>
                                </div>
                                <div class="text-center mt-4">
                                    <button type="submit"
                                            class="btn btn-block btn-success">{{__('crater.login.register')}}</button>
                                </div>

                                <div class="text-center text-muted mt-2">
                                    Already have an account? <a
                                        href="{{route('saleLogin')}}">{{__('crater.login.login')}}</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 d-none d-lg-flex col-img">
            </div>
        </div>
    </div>

    <!-- Modal Confirm -->
    @include('admin.layouts.data.modal_confirm_delete')

@endsection
