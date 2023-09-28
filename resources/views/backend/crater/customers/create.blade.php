@extends('admin.layouts.horizontal')
@section("pageTitle","Add a contact")

@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <style>
        .CodeMirror, .CodeMirror-scroll {
            min-height: 200px;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">{{__('crater.customers.add_customer')}}</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <div class="card-body">

                            <div class="col-sm-12">
                                <div>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div><br/>
                                    @endif
                                    <form method="post"
                                          action="{{ $type == 1 ? route('admin.customers.store'): route('admin.customers.update', $customer) }}">
                                        @if($type ==2)
                                            @method('PATCH')
                                        @endif
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-3">
                                                <h3>Thông tin cơ bản</h3>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label class="form-label" for="first_name"><b>Display Name
                                                                    *:</b></label>
                                                            <input type="text" class="form-control @error('evaluate_quality') is-invalid @enderror" name="name"
                                                                   value="{{$customer->name}}"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label class="form-label" for="first_name"><b>Primary
                                                                    Contact Name:</b></label>
                                                            <input type="text" class="form-control @error('evaluate_quality') is-invalid @enderror" name="contact_name"
                                                                   value="{{$customer->name}}"/>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label class="form-label"
                                                                   for="first_name"><b>{{__('crater.customers.email')}}:</b></label>
                                                            <input type="text" class="form-control @error('evaluate_quality') is-invalid @enderror" name="email"
                                                                   value="{{$customer->email}}"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label class="form-label"
                                                                   for="first_name"><b>Số điện thoại:</b></label>
                                                            <input type="text" class="form-control @error('evaluate_quality') is-invalid @enderror" name="phone"
                                                                   value="{{$customer->phone}}"/>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label class="form-label" for="first_name"><b>Primary
                                                                    Currency :</b></label>
                                                            <input type="text" class="form-control @error('evaluate_quality') is-invalid @enderror" name="currency_id"
                                                                   value="{{$customer->currency_id}}"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label class="form-label"
                                                                   for="first_name"><b>Website:</b></label>
                                                            <input type="text" class="form-control @error('evaluate_quality') is-invalid @enderror" name="website"
                                                                   value="{{$customer->website}}"/>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <h3>Billing Address</h3>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label class="form-label"
                                                                   for="first_name"><b>Name:</b></label>
                                                            <input type="text" class="form-control @error('evaluate_quality') is-invalid @enderror"
                                                                   name="addresses[0][name]"
                                                                   value="{{$customer->name}}"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label class="form-label"
                                                                   for="first_name"><b>Country:</b></label>
                                                            <input type="text" class="form-control @error('evaluate_quality') is-invalid @enderror"
                                                                   name="addresses[0][country_id]"
                                                                   value="{{$customer->name}}"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label class="form-label"
                                                                   for="first_name"><b>State:</b></label>
                                                            <input type="text" class="form-control @error('evaluate_quality') is-invalid @enderror"
                                                                   name="addresses[0][state]"
                                                                   value="{{$customer->name}}"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label class="form-label"
                                                                   for="first_name"><b>City:</b></label>
                                                            <input type="text" class="form-control @error('evaluate_quality') is-invalid @enderror"
                                                                   name="addresses[0][city]"
                                                                   value="{{$customer->name}}"/>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>


                                        <div class="d-flex justify-content-center bd-highlight mb-3">
                                            <div class="p-2 bd-highlight">
                                                <button type="submit" class="btn btn-primary">Add Customer</button>
                                            </div>
                                            <div class="p-2 bd-highlight"><a class="btn btn-light"
                                                                             href="{{route('admin.customers.index')}}"
                                                                             role="button">{{__('crater.general.go_back')}}</a>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Confirm -->
    @include('admin.layouts.data.modal_confirm_delete')

@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    <script>
    </script>
@endsection
