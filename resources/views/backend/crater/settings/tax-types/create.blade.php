@extends('admin.layouts.horizontal', ['hide_footer' => true])
@section("pageTitle","Add a contact")

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
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
                    <li class="breadcrumb-item"><a href="{{route('admin.homeAdmin')}}">{{__('crater.general.home')}}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{__('crater.items.taxes')}}</li>
                </ol>
            </nav>
            <h2 class="h4">{{$type ==1 ? __('crater.general.create'):  __('crater.general.update')}}</h2>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{route('admin.tax-types.index')}}"
               class="btn btn-sm btn-primary d-inline-flex align-items-center">
                <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Danh sách
            </a>

        </div>
    </div>

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
                        <form method="post" id="post_form" action="{{ $type ==1? route('admin.tax-types.store') :route('admin.tax-types.update', $taxType->id) }}">
                            @if($type ==2)
                                @method('PATCH')
                            @endif
                            @csrf
                            <div class="form-group mb-3 field-name">
                                <label class="form-label" for="first_name"><b>{{__('crater.tax_types.name')}}:</b></label>
                                <input type="text" class="form-control @error('evaluate_quality') is-invalid @enderror" value="{{old('name') ? old('name'): $taxType->name }}" id="name" name="name"/>
                                <div class="valid-feedback">
                                </div>
                            </div>

                            <div class="form-group mb-3 field-percent">
                                <label class="form-label" for="last_name"><b>{{__('crater.tax_types.percent')}}:</b></label>
                                <input type="text" class="form-control @error('evaluate_quality') is-invalid @enderror" value="{{old('percent') ? old('percent'): $taxType->percent }}" id="percent"  name="percent"/>
                                <div class="valid-feedback">
                                </div>
                            </div>

                            <div class="form-group mb-3 field-company_id">
                                <label class="form-label" for="last_name"><b>Company:</b></label>
                                <input type="text" class="form-control @error('evaluate_quality') is-invalid @enderror" id="company_id" name="company_id"/>
                                <div class="valid-feedback">
                                </div>
                            </div>

                            <div class="form-group mb-3 field-compound_tax">
                                <label class="form-label" for="last_name"><b>{{__('crater.tax_types.compound_tax')}}:</b></label>
                                <input type="text" class="form-control @error('evaluate_quality') is-invalid @enderror"  value="{{$taxType->compound_tax}}" id="compound_tax" name="compound_tax"/>
                                <div class="valid-feedback">
                                </div>
                            </div>

                            <div class="form-group mb-3 field-collective_tax">
                                <label class="form-label" for="last_name"><b>Collective tax:</b></label>
                                <input type="text" class="form-control @error('evaluate_quality') is-invalid @enderror" value="{{$taxType->collective_tax}}" id="collective_tax"  name="collective_tax"/>
                                <div class="valid-feedback">
                                </div>
                            </div>

                            <div class="form-group mb-3 field-desription">
                                <label class="form-label" for="email"><b>{{__('crater.tax_types.description')}}:</b></label>
                                <textarea
                                id="desription"    name="desription">{{$taxType->desription}}</textarea>
                                <div class="valid-feedback">
                                </div>
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
                                                                    <button type="button"
                                                                            data-toggle="modal"
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

@endsection

@section('script2')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.7.1/tinymce.min.js" referrerpolicy="origin"></script>
    {{--JA VN KO--}}
    <script src="https://npmcdn.com/flatpickr@4.6.13/dist/l10n/vn.js"></script>
    <script src="https://npmcdn.com/flatpickr@4.6.13/dist/l10n/ja.js"></script>
    <script src="https://npmcdn.com/flatpickr@4.6.13/dist/l10n/ko.js"></script>

    <script src="{{asset_cdn('assets/langs/vi.js')}}" referrerpolicy="origin"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: "textarea",
            height: 360,
            language: 'vi',
            plugins: ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste"],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            images_upload_url: '{{route('uploadTinyMce')}}',
            image_advtab: true,
        });
    </script>
    <script>
        jQuery(function ($) {

            jQuery('#post_form').yiiActiveForm([

                {
                    "id": "name",
                    "name": "name",
                    "container": ".field-name",
                    "input": "#name",
                    "error": ".valid-feedback",
                    "validate": function (attribute, value, messages, deferred, $form) {
                        yii.validation.required(value, messages, {"message": "Chưa nhập tên."});
                    }
                },

                {
                    "id": "percent",
                    "name": "percent",
                    "container": ".field-percent",
                    "input": "#percent",
                    "error": ".valid-feedback",
                    "validate": function (attribute, value, messages, deferred, $form) {
                        yii.validation.required(value, messages, {"message": "Chưa nhập phần trăm."});
                    }
                },
                {
                    "id": "key",
                    "name": "key",
                    "container": ".field-key",
                    "input": "#key",
                    "error": ".valid-feedback",
                    "validate": function (attribute, value, messages, deferred, $form) {
                        yii.validation.required(value, messages, {"message": "Chưa nhập khoá widget."});
                    }
                },
                {
                    "id": "position",
                    "name": "position",
                    "container": ".field-position",
                    "input": "#position",
                    "error": ".valid-feedback",
                    "validate": function (attribute, value, messages, deferred, $form) {
                        yii.validation.required(value, messages, {"message": "Chưa chọn vị trí widget."});
                    }
                },
                {
                    "id": "domain_id",
                    "name": "domain_id",
                    "container": ".field-domain_id",
                    "input": "#domain_id",
                    "error": ".valid-feedback",
                    "validate": function (attribute, value, messages, deferred, $form) {
                        yii.validation.required(value, messages, {"message": "Chưa chọn domain."});
                    }
                },

            ], []);
        });
    </script>
@endsection
