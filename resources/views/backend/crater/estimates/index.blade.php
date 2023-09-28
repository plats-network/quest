@extends('admin.layouts.horizontal')

@section("pageTitle","Contacts")
@section('style')
    <style>
        .nav-tabs{
            border-bottom: none !important;
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
                <li class="breadcrumb-item active" aria-current="page">{{__('crater.estimates.title')}}</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <ul class="nav nav-tabs navbar-expand-sm">
                    <li class="nav-item">
                        <a class="nav-link navLinkTab {{Request::get('type') ==0 ? 'active': ''}}" aria-current="page"
                           href="{{route('admin.contacts.index')}}">{{__('crater.general.all')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navLinkTab {{Request::get('type') ==3 ? 'active': ''}}"
                           href="{{route('admin.contacts.index', ['type'=> 3])}}">Hôm nay</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navLinkTab {{Request::get('type') ==1 ? 'active': ''}}"
                           href="{{route('admin.contacts.index', ['type'=> 1])}}">Trong tuần</a>
                    </li>
                </ul>

                <h1 class="h4 mt-3">{{__('crater.estimates.title')}}</h1>
                <h2 class="h5 mt-1">{{__('crater.pdf_total')}}: <b>{{$estimates->total()}}</b></h2>
            </div>
            <div>
                <a href="{{route('admin.estimates.create', ['key_param' => 1])}}"
                   class="btn btn-info d-inline-flex align-items-center">
                    <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    {{__('crater.items.add_item')}}
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs mb-3">

                        <li class="nav-item">
                            <a class="nav-link {{Request::get('status') == 'DRAFT' ? 'active': ''}}"
                               href="{{route('admin.estimates.index', ['status'=> 'DRAFT'])}}">{{__('crater.general.draft')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{Request::get('status') == 'SENT' ? 'active': ''}}" aria-current="page"
                               href="{{route('admin.estimates.index', ['status'=> 'SENT'])}}">{{__('crater.estimates.sent')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{Request::get('status') == '' ? 'active': ''}}"
                               href="{{route('admin.estimates.index', ['status'=> ''])}}">{{__('crater.estimates.all')}}</a>
                        </li>
                    </ul>

                    <div class="table-settings mb-0">
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
                        <table class="table table-centered table-hover table-striped table-nowrap mb-0 rounded">
                            <thead class="thead-light">
                            <tr>
                                <th class="border-0">ID</th>
                                <th class="border-0">{{__('crater.estimates.date')}}</th>
                                <th class="border-0">{{__('crater.estimates.title')}}</th>
                                <th class="border-0">{{__('crater.estimates.customer')}}</th>
                                <th class="border-0">{{__('crater.estimates.status')}}</th>
                                <th class="border-0">{{__('crater.estimates.amount_due')}}</th>
                                <th class="border-0">{{__('crater.general.actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($estimates as $estimate)
                                <tr>
                                    <td>{{$estimate->id}}</td>

                                    <td>{{$estimate->estimate_date}}</td>
                                    <td><a href="{{route('admin.estimates.show', $estimate)}}"
                                           class="text-decoration-none">{{$estimate->estimate_number}}</a></td>
                                    <td>{{$estimate->name}}</td>
                                    <td><span class="badge bg-primary">{{$estimate->status}}</span></td>
                                    <td>{{format_money($estimate->due_amount)}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0"
                                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                                </svg>
                                                <span class="visually-hidden">Toggle Dropdown</span></button>
                                            <div class="dropdown-menu dashboard-dropdown dropdown-menu-start mt-2 py-1">
                                                <a class="dropdown-item d-flex align-items-center" href="{{route('admin.estimates.edit', $estimate)}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="dropdown-icon text-gray-400 me-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                    {{__('crater.general.edit')}} </a>

                                                <a class="dropdown-item d-flex align-items-center"
                                                   href="{{route('admin.estimates.edit', $estimate)}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="dropdown-icon text-gray-400 me-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    Xóa</a>

                                                <a class="dropdown-item d-flex align-items-center" href="{{route('admin.estimates.show', $estimate)}}">
                                                    <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg>
                                                    {{__('crater.general.view')}} </a>

                                                <a class="dropdown-item d-flex align-items-center" href="{{route('admin.estimates.edit', $estimate)}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="dropdown-icon text-gray-400 me-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                                    </svg>
                                                    {{__('crater.estimates.convert_to_invoice')}} </a>
                                                <a class="dropdown-item d-flex align-items-center" href="{{route('admin.estimates.edit', $estimate)}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="dropdown-icon text-gray-400 me-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    {{__('crater.estimates.mark_as_sent')}} </a>
                                                <a class="dropdown-item d-flex align-items-center" href="{{route('admin.estimates.edit', $estimate)}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="dropdown-icon text-gray-400 me-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                                    </svg>
                                                    {{__('crater.estimates.mark_as_accepted')}} </a>
                                                <a class="dropdown-item d-flex align-items-center" href="{{route('admin.estimates.edit', $estimate)}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="dropdown-icon text-gray-400 me-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    {{__('crater.estimates.mark_as_rejected')}} </a>

                                                <a class="dropdown-item d-flex align-items-center" href="{{route('admin.estimates.edit', $estimate)}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="dropdown-icon text-gray-400 me-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                                    </svg>
                                                    {{__('crater.estimates.record_payment')}} </a>
                                                <a class="dropdown-item d-flex align-items-center"
                                                   href="{{route('admin.estimates.edit', $estimate)}}">
                                                    <svg class="dropdown-icon text-danger me-2" fill="currentColor"
                                                         viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M11 6a3 3 0 11-6 0 3 3 0 016 0zM14 17a6 6 0 00-12 0h12zM13 8a1 1 0 100 2h4a1 1 0 100-2h-4z"></path>
                                                    </svg>
                                                    Xóa</a>
                                            </div>
                                        </div>
                                        <svg class="icon icon-xs text-danger ms-1" data-bs-toggle="tooltip"
                                             fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                                             data-bs-original-title="{{__('crater.general.delete')}}" aria-label="{{__('crater.general.delete')}}">
                                            <path fill-rule="evenodd"
                                                  d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                  clip-rule="evenodd"></path>
                                        </svg>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-6">
                            </div>
                            <div class="col-6">
                                <div class="d-flex flex-row-reverse">
                                    {!! $estimates->appends(request()->input())->links('vendor.pagination.bootstrap-4') !!}
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
