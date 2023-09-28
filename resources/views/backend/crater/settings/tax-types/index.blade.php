@extends('admin.layouts.horizontal')

@section("pageTitle","Contacts")

@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.1.1/dist/select2-bootstrap-5-theme.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <style>
        .nav-tabs{
            border-bottom: none !important;
        }
        .navLinkTab{
            padding: 0.2rem 1rem !important;
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
                    <li class="breadcrumb-item active" aria-current="page">{{__('crater.items.taxes')}}</li>
                </ol>
            </nav>
            <h2 class="h4">{{__('crater.items.taxes')}}</h2>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{route('admin.tax-types.create')}}" class="btn btn-sm btn-primary d-inline-flex align-items-center">
                <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Thêm mới
            </a>

        </div>
    </div>

    <div class="row">
        <div class="col-12 col-xl-12">
            <div class="card card-body border-0 shadow mb-4">
                <form action="{{route('admin.tax-types.index')}}" method="GET" id="formSearch">
                    <div class="row">
                        <div class="col-sm-3 mb-3">
                            <div class="form-group field-id">
                                <label for="idSearch">ID</label>
                                <input class="form-control @error('evaluate_quality') is-invalid @enderror" id="idSearch" name="id" type="text"
                                       placeholder="ID">
                            </div>
                        </div>
                        <div class="col-sm-3 mb-3">
                            <div class="form-group field-name">
                                <label for="nameSearch">{{__('crater.items.name')}}</label>
                                <input class="form-control @error('evaluate_quality') is-invalid @enderror" id="nameSearch" name="name" type="text"
                                       value="{{Request::get('name')}}" placeholder="{{__('crater.items.name')}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 mb-3">
                            <div class="form-group field-name">
                                <label for="city">Dịch Vụ</label>
                                <input class="form-control @error('evaluate_quality') is-invalid @enderror" id="zip" type="tel" placeholder="">
                            </div>
                        </div>
                        <div class="col-sm-3 mb-3">
                            <div class="form-group field-name">
                                <label for="from_dateSearch">{{__('crater.general.from_date')}}</label>
                                <div class="input-group">
                                    <input class="form-control @error('evaluate_quality') is-invalid @enderror" id="from_dateSearch" name="from_date" type="text"
                                           value="{{Request::get('from_date')? Request::get('from_date'):$startDateRange}}" placeholder="">
                                    <span class="input-group-text" id="basic-addon1">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-xs text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
  <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
</svg>
                                                            </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 mb-3">
                            <div class="form-group field-name">
                                <label for="to_dateSearch">{{__('crater.general.to_date')}}</label>
                                <div class="input-group">
                                    <input class="form-control @error('evaluate_quality') is-invalid @enderror" id="to_dateSearch" name="to_date" type="text"
                                           value="{{Request::get('to_date') ? Request::get('to_date'):$endDateRange}}" placeholder="">
                                    <span class="input-group-text" id="basic-addon1">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-xs text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
  <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
</svg>
                                                            </span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-3 mb-3">
                            <div class="form-group field-name">
                                <label for="city">{{__('crater.general.domain')}}</label>
                                <select class="form-select w-100 mb-0" id="postDomain" name="domain_id"
                                        aria-label="Category">
                                    <option value="">{{__('crater.general.all')}}</option>
                                    @foreach($appDomain as $key=> $domainItem)
                                        <option
                                            value="{{$key}}" {!! (($key == Request::get('domain_id'))) ? ' selected="selected"' : '' !!} >{{$domainItem}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3 mb-3">
                            <label for="state">Loại</label>
                            <select class="form-select w-100 mb-0" id="inputDomainType" name="category_type"
                                    aria-label="Category">
                                <option value="">{{__('crater.general.all')}}</option>
                                @foreach($appCategoryType as $key=> $categoryType)
                                    <option
                                        value="{{$key}}" {!! (($key == Request::get('category_type'))) ? ' selected="selected"' : '' !!} >{{$categoryType}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group field-name">
                                <label for="zip">{{__('crater.items.status')}}</label>
                                <select class="form-select" aria-label="Default select example" name="status"
                                        id="status">
                                    <option selected>{{__('crater.general.choose')}}</option>
                                    <option value="1">Hiển thị</option>
                                    <option value="2">Ẩn</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group field-name">
                                <label for="zip">&nbsp;</label>
                                <div>
                                    <button class="btn btn-primary mt-0 animate-up-2 form-control" type="submit" style="width: 140px">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-xs ms-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                        {{__('crater.general.search')}}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body"><div class="table-settings mb-0">
                <div class="row justify-content-between align-items-center">
                    <div class="col-9 col-lg-8 d-md-flex">
                        <div class="d-flex mb-3">
                            <select class="form-select fmxw-200" aria-label="Message select example">
                                <option selected="selected">Bulk Action</option>
                                <option value="1">Gởi Email</option>
                                <option value="2">Thay đổi Group</option>
                                <option value="3">Xoá User</option>
                            </select>
                            <button class="btn btn-sm px-3 btn-secondary ms-3" id="apply_selected_items_btn">Apply</button>
                        </div>
                    </div>
                    <div class="col-3 col-lg-4 d-flex justify-content-end">
                        <div class="btn-group">
                            <div class="dropdown me-1"><button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z"></path></svg> <span class="visually-hidden">Toggle Dropdown</span></button><div class="dropdown-menu dropdown-menu-end pb-0" style=""><span class="small ps-3 fw-bold text-dark">Hiển thị</span> <a class="dropdown-item d-flex align-items-center fw-bold" href="#">10 <svg class="icon icon-xxs ms-auto" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg></a><a class="dropdown-item fw-bold" href="#">20</a> <a class="dropdown-item fw-bold rounded-bottom" href="#">30</a></div>
                            </div>
                            <div class="dropdown"><button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path></svg> <span class="visually-hidden">Toggle Dropdown</span></button><div class="dropdown-menu dropdown-menu-xs dropdown-menu-end pb-0" style=""><span class="small ps-3 fw-bold text-dark">Hiển thị</span> <a class="dropdown-item d-flex align-items-center fw-bold" href="#">10 <svg class="icon icon-xxs ms-auto" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg></a><a class="dropdown-item fw-bold" href="#">20</a> <a class="dropdown-item fw-bold rounded-bottom" href="#">30</a></div></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12" id="w0">
                <table class="table  table-centered table-hover table-nowrap mb-0 rounded">
                    <caption>Danh sách thành viên</caption><thead class="thead-light">
                    <tr><th class="border-0 rounded-start">
                            <div class="form-check dashboard-check">
                                <input class="form-check-input" type="checkbox" value="1" name="selection_all" id="userCheckAll">
                                <label class="form-check-label" for="userCheckAll"></label>
                            </div>
                        </th>
                        <th class="border-0">ID</th>
                        <th class="border-0">{{__('crater.tax_types.name')}}</th>
                        <th class="border-0">{{__('crater.tax_types.percent')}}</th>
                        <th class="border-0">{{__('crater.tax_types.compound_tax')}}</th>
                        <th class="border-0">{{__('crater.tax_types.description')}}</th>
                        <th class="border-0 rounded-end">{{__('crater.general.actions')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($taxTypes as $taxType)
                        <tr data-key="{{$taxType->id}}" >
                            <td>
                                <div class="form-check dashboard-check">
                                    <input class="form-check-input" type="checkbox" value="" id="userCheck{{$taxType->id}}">
                                    <label class="form-check-label" for="userCheck{{$taxType->id}}"></label>
                                </div>
                            </td>
                            <td>{{$taxType->id}}</td>
                            <td>
                                <a href="{{route('admin.tax-types.edit', $taxType->id)}}">{{$taxType->name}}</a></td>
                            <td>{{$taxType->percent}}%</td>
                            <td>{{$taxType->compound_tax}}</td>
                            <td>{{$taxType->desription}}</td>
                            <td>
                                <form action="{{ route('admin.tags.destroy', $taxType->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" type="submit">{{__('crater.general.delete')}}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div>
                </div>
            </div>
            <div class="col-sm-12 mt-3">
                <div class="row">
                    <div class="col-6">
                    </div>
                    <div class="col-6">
                        <div class="d-flex flex-row-reverse">
                            {!! $taxTypes->appends(request()->input())->links('vendor.pagination.bootstrap-4') !!}
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    {{--JA VN KO--}}
    <script src="https://npmcdn.com/flatpickr@4.6.13/dist/l10n/vn.js"></script>
    <script src="https://npmcdn.com/flatpickr@4.6.13/dist/l10n/ja.js"></script>
    <script src="https://npmcdn.com/flatpickr@4.6.13/dist/l10n/ko.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dependent-dropdown/1.4.9/js/dependent-dropdown.min.js"></script>

    <script>
        var _token = $('meta[name="csrf-token"]').attr('content');
        var spinText = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ';
        var urlUpdate = '{{route('customer.ajax-districtC')}}';
        var hasPage = {{Request::get('page', 0)}};

        jQuery(document).ready(function ($) {

            var formsearch = $("#formSearch");
            //Scroll in new page
            if (hasPage) {
                scrollTopAnimated();
            }

            /*
            * Scroll
            * */
            function scrollTopAnimated() {
                $('html, body').animate({
                    scrollTop: $("#listPost").offset().top - 40
                });
            }

            /* $('#postDomain').select2({
                 theme: "bootstrap-5",
             });*/
            $("#from_dateSearch").flatpickr({
                "locale": "{{str_replace('vi', 'vn', App::getLocale())}}",
                "maxDate": new Date().fp_incr(0)
            });
            $("#to_dateSearch").flatpickr({
                "locale": "{{str_replace('vi', 'vn', App::getLocale())}}"
            });



            $("#inputDomainType").depdrop({
                depends: ['postDomain'],
                url: '{{route('admin.ajax-domain-type')}}',
                idParam: 'id'
            });
        });
    </script>
@endsection
