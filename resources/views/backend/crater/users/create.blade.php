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

        <h1 class="h3 mb-3">{{__('crater.users.add_new_user')}}</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <div class="card-body">
                            <div class="col-sm-8 offset-sm-2">
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
                                          action="{{ $type == 1 ? route('admin.users.store'): route('admin.users.update', $user) }}">
                                        @if($type ==2)
                                            @method('PUT')
                                        @endif
                                        @csrf
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="first_name"><b>{{__('crater.users.name')}}
                                                    :</b></label>
                                            <input type="text" class="form-control @error('evaluate_quality') is-invalid @enderror" name="name"
                                                   value="{{$user->name}}"/>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label" for="email"><b>{{__('crater.users.email')}}
                                                    :</b></label>
                                            <input type="text" class="form-control @error('evaluate_quality') is-invalid @enderror" name="email"
                                                   value="{{$user->email}}"/>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="email"><b>{{__('crater.users.password')}}
                                                    :</b></label>
                                            <input type="text" class="form-control @error('evaluate_quality') is-invalid @enderror" name="password"
                                                   value=""/>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="email"><b>{{__('crater.users.phone')}}
                                                    :</b></label>
                                            <input type="text" class="form-control @error('evaluate_quality') is-invalid @enderror" name="phone"
                                                   value="{{$user->phone}}"/>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label" for="email"><b>{{__('crater.users.website')}}:</b></label>
                                            <input type="text" class="form-control @error('evaluate_quality') is-invalid @enderror" name="website"
                                                   value="{{$user->website}}"/>
                                        </div>


                                        <div class="d-flex justify-content-center bd-highlight mb-3">
                                            <div class="p-2 bd-highlight">
                                                <button type="submit" class="btn btn-primary">Add User</button>
                                            </div>
                                            <div class="p-2 bd-highlight"><a class="btn btn-light"
                                                                             href="{{route('admin.users.index')}}"
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
        //var simplemde = new SimpleMDE();
    </script>
@endsection
