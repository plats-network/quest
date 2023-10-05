<div class="row mb-3">
    <div class="col-12 col-sm-4">
        <div class="form-group">
            <?php
            $field_name = 'name';
            $field_lable = label_case($field_name);
            $field_placeholder = $field_lable;
            $required = "required";
            ?>
            {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>
    <div class="col-12 col-sm-4">
        <div class="form-group">
            <?php
            $field_name = 'slug';
            $field_lable = label_case($field_name);
            $field_placeholder = $field_lable;
            $required = "";
            ?>
            {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>
    <div class="col-12 col-sm-4">
        <div class="form-group">
            <?php
            $field_name = 'group_name';
            $field_lable = label_case($field_name);
            $field_placeholder = $field_lable;
            $required = "";
            ?>
            {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>
</div>
<div class="row mb-3">
    <div class="col-8">
        <div class="form-group">
            <?php
            $field_name = 'image';
            $field_lable = label_case($field_name);
            $field_placeholder = $field_lable;
            $required = "";
            ?>
            {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
            {{ html()->input("file", $field_name)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>

    @if(false)
    <div class="col-4">
        <div class="float-end">
            <figure class="figure">
                <a href="{{ asset($data->$field_name) }}" data-lightbox="image-set" data-title="Path: {{ asset($data->$field_name) }}">
                    <img src="{{ asset($data->getMedia($module_name)->first()->getUrl('thumb300')) }}" class="figure-img img-fluid rounded img-thumbnail" alt="">
                </a>
                <!-- <figcaption class="figure-caption">Path: </figcaption> -->
            </figure>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="image_remove" id="image_remove" name="image_remove">
                <label class="form-check-label" for="image_remove">
                    Remove this image
                </label>
            </div>
        </div>
    </div>
    <x-library.lightbox />
    @endif
</div>
<div class="row mb-3">
    <div class="col-12">
        <div class="form-group">
            <?php
            $field_name = 'description';
            $field_lable = label_case($field_name);
            $field_placeholder = $field_lable;
            $required = "";
            ?>
            {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
            {{ html()->textarea($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"])->rows(5) }}
        </div>
    </div>
</div>
<hr>
<div class="row mb-3">
    <div class="col-12 col-sm-4">
        <div class="form-group">
            <?php
            $field_name = 'meta_title';
            $field_lable = label_case($field_name);
            $field_placeholder = $field_lable;
            $required = "";
            ?>
            {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>
    <div class="col-12 col-sm-4">
        <div class="form-group">
            <?php
            $field_name = 'meta_keyword';
            $field_lable = label_case($field_name);
            $field_placeholder = $field_lable;
            $required = "";
            ?>
            {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>
    <div class="col-12 col-sm-4">
        <div class="form-group">
            <?php
            $field_name = 'meta_description';
            $field_lable = label_case($field_name);
            $field_placeholder = $field_lable;
            $required = "";
            ?>
            {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="col-12 col-sm-4">
        <div class="form-group">
            <?php
            $field_name = 'status';
            $field_lable = label_case($field_name);
            $field_placeholder = "-- Select an option --";
            $required = "required";
            $select_options = [
                'Active' => 'Active',
                'Inactive' => 'Inactive',
                'Draft' => 'Draft'
            ];
            ?>
            {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
            {{ html()->select($field_name, $select_options)->placeholder($field_placeholder)->class('form-select')->attributes(["$required"]) }}
        </div>
    </div>
</div>

@push('after-styles')
    <!-- File Manager -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/10.32.0/css/jquery.fileupload.css">
    <link rel="stylesheet" href="{{asset('plugins/filekit/assets/css/upload-kit.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.1.1/dist/select2-bootstrap-5-theme.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        .note-editor.note-frame :after {
            display: none;
        }

        .note-editor .note-toolbar .note-dropdown-menu,
        .note-popover .popover-content .note-dropdown-menu {
            min-width: 180px;
        }
    </style>
@endpush

@push ('after-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dependent-dropdown/1.4.9/js/dependent-dropdown.min.js"></script>
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

    <script src="{{asset('plugins/filekit/assets/js/upload-kit.js')}}" referrerpolicy="origin"></script>

    <script type="text/javascript">
        var _token = $('meta[name="csrf-token"]').attr('content');
        var spinText = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ';
        var fileAvatarInit = null;
        var flag_check = 1;

        jQuery(document).ready(function ($) {
            @if($data->image_base_path)
                fileAvatarInit = [{
                "path": "{{$data->image_base_path}}",
                "base_url": "{{$data->image_base_url}}",
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
                "acceptFileTypes": /(\.|\/)(gif|jpe?g|png)$/i,
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
        });

    </script>
@endpush
