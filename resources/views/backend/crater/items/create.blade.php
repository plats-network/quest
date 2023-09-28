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
                <li class="breadcrumb-item active" aria-current="page">Sản phẩm</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">

                <h1 class="h4 mt-3">{{__('crater.items.add_item')}}</h1>
            </div>
            <div>
                <a href="{{route('admin.items.index', ['key_param' => 1])}}"
                   class="btn btn-info d-inline-flex align-items-center">
                    <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Danh sách
                </a>
            </div>
        </div>
    </div>

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
                                <form method="post" id="post_form"
                                      action="{{ $type == 1 ? route('admin.items.store'): route('admin.items.update', $item) }}">
                                    @if($type ==2)
                                        @method('PUT')
                                    @endif
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="first_name"><b>{{__('crater.items.name')}}
                                                :</b></label>
                                        <input type="text" class="form-control @error('evaluate_quality') is-invalid @enderror" name="name" value="{{$item->name}}"/>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label" for="last_name"><b>{{__('crater.items.unit')}}
                                                :</b></label>
                                        <select class="form-select" aria-label="" name="unit_id">
                                            @foreach($units as $key => $unit)
                                                <option
                                                    value="{{$unit->id}}" {!! ($unit->id == Request::get('unit_id') or $unit->id == $item->unit_id) ? ' selected="selected"' : '' !!}>{{$unit->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="last_name"><b>{{__('crater.items.taxes')}}
                                                :</b></label>
                                        <select class="form-select" aria-label="" name="tax_id">
                                            @foreach($taxTypes as $key => $tax)
                                                <option
                                                    value="{{$tax->id}}" {!! ($tax->id == Request::get('unit_id') or $unit->id == $item->unit_id) ? ' selected="selected"' : '' !!}>{{$tax->name . '('.$tax->percent. '%)'}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label" for="email"><b>{{__('crater.items.price')}}
                                                :</b></label>
                                        <input type="text" class="form-control @error('evaluate_quality') is-invalid @enderror" id="price" name="price"
                                               value="{{$item->price}}"/>
                                    </div>

                                    <div class="form-group mb-1">
                                        <label class="form-label" for="job_title"><b>{{__('crater.items.description')}}
                                                :</b></label>
                                        <textarea name="description">{{$item->description}}</textarea>
                                    </div>

                                    <div class="mt-5"></div>
                                    <br>
                                    <div class="c-conversionArea">
                                        <div class="c-conversionArea__container">
                                            <div class="row justify-content-between align-items-center">
                                                <div class="mt-0 mb-5 buttonAction">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div
                                                                class="d-flex justify-content-center bd-highlight mb-3">
                                                                <div class="p-2 bd-highlight">
                                                                    <button id="btnSubmitForm"
                                                                            class="btn btn-info btn-md mt-1 animate-up-2"
                                                                            type="submit"><i
                                                                            class="fas fa-check"></i>
                                                                        {{$type ==2 ?  __('crater.general.update'): __('crater.items.add_item')}}
                                                                    </button>
                                                                </div>
                                                                <div class="p-2 bd-highlight">
                                                                    @if($type ==2)
                                                                        <div class="p-2 bd-highlight">
                                                                            <button type="button" data-toggle="modal"
                                                                                    id="btnDelete"
                                                                                    data-target="#modalDelete"
                                                                                    title="Delete User"
                                                                                    class="btn btn-danger">
                                                                                <i class="fas fa-trash"></i>
                                                                                {{__('crater.general.delete')}}
                                                                            </button>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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

@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        var simplemde = new SimpleMDE();
        jQuery(document).ready(function ($) {
            //$('#price').mask('#,##0,00', {reverse: true});
            // display a modal (small modal)
            $(document).on('click', '#btnDelete', function (event) {
                event.preventDefault();
                let href = $(this).attr('data-attr');
                $('#modalDelete').modal("show");
            });

            $(document).on('click', '#hideModalDelete', function (event) {
                $('#modalDelete').modal("hide");
            });
        });
    </script>
@endsection

