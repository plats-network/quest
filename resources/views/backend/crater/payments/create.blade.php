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

        <h1 class="h3 mb-3">{{__('crater.payments.add_new_payment')}}</h1>

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
                                          action="{{ $type == 1 ? route('admin.payments.store'): route('admin.payments.update', $payment) }}">
                                        @if($type ==2)
                                            @method('PATCH')
                                        @endif
                                        @csrf
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="first_name"><b>{{__('crater.items.name')}}
                                                    :</b></label>
                                            <input type="text" class="form-control @error('evaluate_quality') is-invalid @enderror" name="name"
                                                   value="{{$payment->name}}"/>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label" for="last_name"><b>{{__('crater.items.unit')}}
                                                    :</b></label>
                                            <select class="form-select" aria-label="" name="unit_id">
                                                @foreach($units as $key => $unit)
                                                    <option
                                                        value="{{$unit->id}}" {!! ($unit->id == Request::get('unit_id') or $unit->id == $payment->unit_id) ? ' selected="selected"' : '' !!}>{{$unit->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label" for="email"><b>{{__('crater.items.price')}}
                                                    :</b></label>
                                            <input type="text" class="form-control @error('evaluate_quality') is-invalid @enderror" name="price"
                                                   value="{{$payment->price}}"/>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label"
                                                   for="job_title"><b>{{__('crater.items.description')}}:</b></label>
                                            <textarea name="description">{{$payment->description}}</textarea>
                                            <br>
                                        </div>

                                        <div class="d-flex justify-content-center bd-highlight mb-3">
                                            <div class="p-2 bd-highlight">
                                                <button type="submit"
                                                        class="btn btn-primary">{{__('crater.payments.new_payment')}}</button>
                                            </div>
                                            <div class="p-2 bd-highlight"><a class="btn btn-light"
                                                                             href="{{route('admin.payments.index')}}"
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
        var simplemde = new SimpleMDE();
    </script>
@endsection
