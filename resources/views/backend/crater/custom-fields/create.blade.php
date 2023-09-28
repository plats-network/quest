@extends('admin.layouts.horizontal' , ['hide_footer' => true])

@section("pageTitle","Edit contact")
@section('style')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/10.32.0/css/jquery.fileupload.css">
    <link rel="stylesheet" href="{{asset_cdn('plugins/filekit/assets/css/upload-kit.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.1.1/dist/select2-bootstrap-5-theme.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        .hidden {
            display: none !important;
        }

        .product-add {
            color: var(--white);
            background: var(--primary);
        }

    </style>
@endsection
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
                    <li class="breadcrumb-item"><a href="{{route('admin.homeAdmin')}}">{{__('crater.general.home')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Custom Field</li>
                </ol>
            </nav>
            <h2 class="h4">{{$type ==1 ? __('crater.general.create'):  __('crater.general.update')}} Custom Field</h2>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{route('admin.custom-fields.index')}}" class="btn btn-info"><i
                    class="fas fa-angle-left"></i> {{__('admin.button.back')}} danh sách</a>

        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-10 offset-sm-1">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <br/>
                    @endif

                    <form method="post" id="post_form"
                          action="{{ $type ==1? route('admin.custom-fields.store') :route('admin.custom-fields.update',['custom_field' => $customField->id, 'id' => $customField->id] ) }}">
                        @if($type ==2)
                            @method('PATCH')
                        @endif
                        @csrf
                        <input type="hidden" name="contact_id"
                               value="{{ $customField->id }}{{ old('contact_id') }}">

                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group mb-3 field-first_name">
                                    <label class="form-label" for="first_name"><b>Tên:</b></label>
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                          id="first_name" name="first_name" required
                                           value="{{ old('first_name') ? old('first_name') :$customField->first_name }}"/>

                                    <div class="invalid-feedback">

                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label" for="last_name"><b>Model:</b></label>
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                           name="last_name"
                                           value="{{ old('last_name') ? old('last_name') :$customField->last_name }}"/>
                                </div>

                                <div class="form-group mb-3 field-email">
                                    <label class="form-label" for="email"><b>Required:</b></label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                                         id="email"  name="email" id="emailInput" required
                                           value="{{ old('email') ? old('email') :$customField->email }}"/>

                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label" for="last_name"><b>Type :</b></label>
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                           name="last_name"
                                           value="{{ old('last_name') ? old('last_name') :$customField->last_name }}"/>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label" for="last_name"><b>Label  :</b></label>
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                           name="last_name"
                                           value="{{ old('last_name') ? old('last_name') :$customField->last_name }}"/>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label" for="last_name"><b>Default Value :</b></label>
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                           name="last_name"
                                           value="{{ old('last_name') ? old('last_name') :$customField->last_name }}"/>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" for="last_name"><b>Placeholder  :</b></label>
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                           name="last_name"
                                           value="{{ old('last_name') ? old('last_name') :$customField->last_name }}"/>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" for="order"><b>Order   :</b></label>
                                    <input type="text" class="form-control @error('order') is-invalid @enderror"
                                           name="order"
                                           value="{{ old('order') ? old('order') :$customField->order }}"/>
                                </div>

                            </div>
                            <div class="col-md-3">
                                <div class="form-group field-article-thumbnail">
                                    <label for="article-thumbnail" class="mb-3"><b>Ảnh Thumbnail</b></label>
                                    <div>
                                        <input type="hidden" id="article-thumbnail" class="empty-value"
                                               name="thumbnail">
                                        <input type="file" id="w0" name="_fileinput_w0"></div>
                                    <div class="invalid-feedback">

                                    </div>
                                </div>
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
                                                    <div class="p-2 bd-highlight">
                                                        <a id="btnCancelForm" href="{{route('admin.custom-fields.index')}}"
                                                           class="btn btn-danger btn-md mt-1 animate-up-2"><i
                                                                class="fas fa-arrow-circle-left"></i>
                                                            {{__('crater.general.cancel')}}
                                                        </a>
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

    <!-- Modal Content -->
    <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="modal-default"
         aria-hidden="true">
        <div class="modal-dialog modal-primary modal-dialog-centered" role="document">
            <div class="modal-content bg-gradient-secondary">
                <form action="{{ route('admin.custom-fields.destroy', ['custom_field' => $customField->id ? $customField->id: 0, 'type' => 1])}}"
                      id="formDeleteItem" method="post">
                    <div class="modal-body">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body bottom-0 text-white">
                            <div class="py-0 text-center">
                                 <span class="modal-icon">
                                     <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm iconAlarm text-warning"
                                          fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
</svg>
                                 </span>
                                <h2 class="h4 modal-title my-3">{{__('crater.general.confirm_delete')}}</h2>
                                <p>{{__('crater.general.text_confirm_delete')}}</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="d-grid gap-2 col-6 mx-auto">
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-danger btn-block">Xác nhận</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-secondary btn-block" id="hideModalDelete"
                                                data-bs-dismiss="modal">Hủy bỏ
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- End of Modal Content -->

@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-load-image/5.14.0/load-image.all.min.js"
            referrerpolicy="origin"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/10.32.0/js/vendor/jquery.ui.widget.js"
            referrerpolicy="origin"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/10.32.0/js/jquery.iframe-transport.js"
            referrerpolicy="origin"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/10.32.0/js/jquery.fileupload.js"
            referrerpolicy="origin"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/10.32.0/js/jquery.fileupload-process.js"
            referrerpolicy="origin"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/10.32.0/js/jquery.fileupload-image.js"
            referrerpolicy="origin"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/10.32.0/js/jquery.fileupload-validate.js"
            referrerpolicy="origin"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    {{--JA VN KO--}}
    <script src="https://npmcdn.com/flatpickr@4.6.13/dist/l10n/vn.js"></script>
    <script src="https://npmcdn.com/flatpickr@4.6.13/dist/l10n/ja.js"></script>
    <script src="https://npmcdn.com/flatpickr@4.6.13/dist/l10n/ko.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dependent-dropdown/1.4.9/js/dependent-dropdown.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{asset_cdn('plugins/filekit/assets/js/upload-kit.js')}}" referrerpolicy="origin"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <script src="{{asset_cdn('assets/yii2-assets/yii.js')}}"></script>
    <script src="{{asset_cdn('assets/yii2-assets/yii.activeForm.js')}}"></script>
    <script src="{{asset_cdn('assets/yii2-assets/yii.validation.js')}}"></script>

    <script>
        var _token = $('meta[name="csrf-token"]').attr('content');
        var spinText = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ';
        var fileAvatarInit = null;
        var flag_check = 1;

        jQuery(document).ready(function ($) {
            $('#phoneInput').mask('00000000000', {reverse: true});

            //Modal delete item
            $(document).on('click', '#btnDelete', function (event) {
                event.preventDefault();
                let href = $(this).attr('data-attr');
                $('#modalDelete').modal("show");
            });

            $(document).on('click', '#hideModalDelete', function (event) {
                $('#modalDelete').modal("hide");
            });

            $("#from_dateSearch").flatpickr({
                "locale": "{{str_replace('vi', 'vn', App::getLocale())}}",
                "maxDate": new Date().fp_incr(0)
            });

            $("#to_dateSearch").flatpickr({
                "locale": "{{str_replace('vi', 'vn', App::getLocale())}}"
            });

            $("#inputDistrict").depdrop({
                depends: ['cityInput'],
                url: '{{route('admin.ajax-district')}}',
                idParam: 'id'
            });

            $("#inputWard").depdrop({
                depends: ['inputDistrict'],
                url: '{{route('admin.ajax-ward')}}',
                idParam: 'id'
            });

            var formProfile = $("#formProfile");
            //Scroll in new page
            @if($customField->image_base_path)
                fileAvatarInit = [{
                "path": "{{$customField->image_base_path}}",
                "base_url": "{{$customField->image_base_url}}",
                "type": null,
                "size": null,
                "name": null,
                "order": null
            }];
            @endif

            //Update init image
            jQuery('#w0').yiiUploadKit({
                "url": "{{get_upload_url()}}",
                "multiple": false,
                "sortable": false,
                "maxNumberOfFiles": 1,
                "maxFileSize": 5000000,
                "minFileSize": null,
                "acceptFileTypes": /(\.|\/)(gif|jpe?g|png|webp)$/i,
                "files": fileAvatarInit,
                "previewImage": true,
                "showPreviewFilename": false,
                "errorHandler": "popover",
                "pathAttribute": "path",
                "baseUrlAttribute": "base_url",
                "pathAttributeName": "path",
                "baseUrlAttributeName": "base_url",
                "messages": {
                    "maxNumberOfFiles": "Số lượng tối đa của tệp vượt quá",
                    "acceptFileTypes": "Loại tệp không được phép",
                    "maxFileSize": "Tập tin quá lớn",
                    "minFileSize": "Tập tin quá nhỏ"
                },
                "name": "thumbnail"
            });
            //scrollTopAnimated();
            /*
            * Scroll
            * */
            function scrollTopAnimated() {
                $('html, body').animate({
                    scrollTop: $(".about-area").offset().top - 120
                });
            }

            /* $('#postDomain').select2({
                 theme: "bootstrap-5",
             });*/
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
                        yii.validation.required(value, messages, {"message": "Chưa nhập tên công ty."});
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
                {
                    "id": "accountVaType",
                    "name": "accountVaType",
                    "container": ".field-accountVaType",
                    "input": "#accountVaType",
                    "error": ".valid-feedbackaccountVaType",
                    "validate": function (attribute, value, messages, deferred, $form) {
                        yii.validation.required(value, messages, {"message": "Chưa chọn loại tài khoản."});
                    }
                },
            ], []);
        });
    </script>
@endsection
