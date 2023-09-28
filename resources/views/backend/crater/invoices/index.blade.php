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
                <li class="breadcrumb-item active" aria-current="page">{{__('crater.invoices.title')}}</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <ul class="nav nav-tabs navbar-expand-sm">
                    <li class="nav-item">
                        <a class="nav-link navLinkTab {{Request::get('type') ==0 ? 'active': ''}}" aria-current="page"
                           href="{{route('admin.invoices.index')}}">{{__('crater.general.all')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navLinkTab {{Request::get('type') ==3 ? 'active': ''}}"
                           href="{{route('admin.invoices.index', ['type'=> 3])}}">Hôm nay</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navLinkTab {{Request::get('type') ==1 ? 'active': ''}}"
                           href="{{route('admin.invoices.index', ['type'=> 1])}}">Trong tuần</a>
                    </li>
                </ul>

                <h1 class="h4 mt-3">{{__('crater.invoices.title')}}</h1>
                <h2 class="h5 mt-1">{{__('crater.pdf_total')}}: <b>{{$invoices->total()}}</b></h2>
            </div>
            <div>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="{{route('admin.invoices.create', ['key_param' => 1])}}" class="btn btn-sm btn-primary d-inline-flex align-items-center">
                        <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        {{__('crater.items.add_item')}}</a><div class="btn-group ms-2 ms-lg-3">
                        <button type="button" class="btn btn-sm btn-outline-gray-600">Share</button>
                        <button type="button" class="btn btn-sm btn-outline-gray-600">Export</button></div></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-xl-12">
            <div class="card card-body border-0 shadow mb-4">
                <form action="{{route('admin.invoices.index')}}" method="GET" id="formSearch">
                    <div class="row">
                        <div class="col-sm-3 mb-3">
                            <div class="form-group field-name">
                                <label for="address">ID</label>
                                <input class="form-control @error('evaluate_quality') is-invalid @enderror" id="idSearch" name="invoice_number" type="text"
                                       value="{{Request::get('invoice_number')}}"   placeholder="ID">
                            </div>
                        </div>
                        <div class="col-sm-3 mb-3">
                            <div class="form-group field-name">
                                <label for="city">{{__('crater.invoices.customer')}}</label>
                                <select class="form-select w-100 mb-0" id="customerInvoice" name="customer_id"
                                        aria-label="Customer">
                                    <option value="">{{__('crater.general.all')}}</option>
                                    @foreach($customers as $key=> $customerItem)
                                        <option
                                            value="{{$customerItem->id}}" {!! ($customerItem->id == Request::get('customer_id')) ? ' selected="selected"' : '' !!} >{{$customerItem->name}}</option>
                                    @endforeach
                                </select>
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
                                <select class="form-select w-100 mb-0" id="inputDomainType" name="status"
                                        aria-label="Category">
                                    <option value="">{{__('crater.general.all')}}</option>
                                    @foreach($dataInvoiceStatus as $key=> $itemStatus)
                                        <option
                                            value="{{$key}}" {!! (($key == Request::get('status'))) ? ' selected="selected"' : '' !!} >{{$itemStatus}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-3 mb-3">
                            <div class="form-group field-name">
                                <label for="from_dateSearch">Từ ngày</label>
                                <input class="form-control @error('evaluate_quality') is-invalid @enderror" value="{{Request::get('from_date')? Request::get('from_date'):$startDateRange}}" id="from_dateSearch" name="from_date" type="text" placeholder="">
                            </div>
                        </div>
                        <div class="col-sm-3 mb-3">
                            <div class="form-group field-name">
                                <label for="to_dateSearch">Đến ngày</label>
                                <input class="form-control @error('evaluate_quality') is-invalid @enderror"  value="{{Request::get('to_date') ? Request::get('to_date'):$endDateRange}}" id="to_dateSearch" name="to_date" type="text" placeholder="">
                            </div>
                        </div>

                        <div class="col-sm-3 mb-3">
                            <div class="form-group field-name">
                                <label for="due_dateSearch">Ngày đáo hạn</label>
                                <input class="form-control @error('evaluate_quality') is-invalid @enderror"  value="{{Request::get('due_date')}}" id="due_dateSearch" name="due_date" type="text" placeholder="">
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

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs mb-3">
                        <li class="nav-item">
                            <a class="nav-link navLinkTab {{Request::get('status') == '' ? 'active': ''}}"
                               href="{{route('admin.invoices.index', ['status'=> ''])}}">{{__('crater.invoices.all')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link navLinkTab {{Request::get('status') == 'DRAFT' ? 'active': ''}}"
                               href="{{route('admin.invoices.index', ['status'=> 'DRAFT'])}}">{{__('crater.general.draft')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link navLinkTab {{Request::get('status') == 'SENT' ? 'active': ''}}" aria-current="page"
                               href="{{route('admin.invoices.index', ['status'=> 'SENT'])}}">{{__('crater.general.send')}}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link navLinkTab {{Request::get('status') == 'COMPLETED' ? 'active': ''}}" aria-current="page"
                               href="{{route('admin.invoices.index', ['status'=> 'COMPLETED'])}}">{{__('crater.invoices.completed')}}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link navLinkTab {{Request::get('status') == 'DUE' ? 'active': ''}}" aria-current="page"
                               href="{{route('admin.invoices.index', ['status'=> 'DUE'])}}">{{__('crater.invoices.overdue')}}</a>
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
                                <th class="border-0">{{__('crater.general.domain')}}</th>
                                <th class="border-0">{{__('crater.invoices.number')}}</th>
                                <th class="border-0">{{__('crater.invoices.customer')}}</th>
                                <th class="border-0">{{__('crater.invoices.status')}}</th>
                                <th class="border-0">{{__('crater.invoices.amount_due')}}</th>
                                <th class="border-0">{{__('crater.invoices.paid_status')}}</th>
                                <th class="border-0">TỔNG</th>
                                <th class="border-0">Ngày tạo</th>
                                <th class="border-0">{{__('crater.general.actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($invoices as $invoice)
                                <tr>
                                    <td>{{$invoice->id}}</td>
                                    <td class="fw-normal">Domain: <b>{{$invoice->getDomainName()}}</b></td>
                                    <td>
                                        <a href="{{route('admin.invoices.show', $invoice)}}"
                                           class="text-decoration-none">{{$invoice->invoice_number}}</a>
                                        <div>{{$invoice->invoice_date}}</div>

                                    </td>
                                    <td><a href="{{route('admin.users.edit', ['user' => $invoice->user?  $invoice->user->id:''])}}" class="text-decoration-none">{{$invoice->name}}</a>
                                    </td>
                                    <td><span class="badge bg-primary">{{$invoice->status}}</span></td>
                                    <td>{{format_money_vnd($invoice->sub_total)}}</td>
                                    <td><span class="badge bg-{{$invoice->paid_status =='PAID'? 'success':'warning'}}">{{$invoice->paid_status}}</span></td>
                                    <td>{{format_money_vnd($invoice->total)}}</td>
                                    <td>{{$invoice->created_at}}</td>
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
                                                <a class="dropdown-item d-flex align-items-center"
                                                   href="{{route('admin.invoices.create', ['id' => $invoice->id,'post_id' => $invoice->id, 'copy'=>1, 'key_param' => 1])}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="dropdown-icon text-gray-400 me-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                                    </svg>
                                                    {{__('crater.invoices.clone_invoice')}} </a>
                                                <a class="dropdown-item d-flex align-items-center" href="{{route('admin.invoices.edit', $invoice)}}">
                                                    <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor"
                                                         viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                                        <path fill-rule="evenodd"
                                                              d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                              clip-rule="evenodd"></path>
                                                    </svg>
                                                    {{__('crater.general.edit')}} </a>

                                                <a class="dropdown-item d-flex align-items-center" href="{{route('admin.invoices.show', $invoice)}}">
                                                    <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg>
                                                    {{__('crater.general.view')}} </a>

                                                <a class="dropdown-item d-flex align-items-center" href="{{route('admin.invoices.edit', $invoice)}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="dropdown-icon text-gray-400 me-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                                    </svg>
                                                    {{__('crater.invoices.resend_invoice')}} </a>

                                                <a class="dropdown-item d-flex align-items-center" href="{{route('admin.invoices.edit', $invoice)}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="dropdown-icon text-gray-400 me-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                                    </svg>
                                                    {{__('crater.invoices.record_payment')}} </a>
                                                <a class="dropdown-item d-flex align-items-center"
                                                   href="{{route('admin.invoices.edit', $invoice)}}">
                                                    <svg class="dropdown-icon text-danger me-2" fill="currentColor"
                                                         viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M11 6a3 3 0 11-6 0 3 3 0 016 0zM14 17a6 6 0 00-12 0h12zM13 8a1 1 0 100 2h4a1 1 0 100-2h-4z"></path>
                                                    </svg>
                                                    Xóa</a></div>
                                        </div>
                                        <svg data-url="{{ route('admin.invoices.destroy', ['invoice' => $invoice->id ? $invoice->id: 0, 'type' => 1])}}"  class=" btnDeleteRow icon icon-xs text-danger ms-1" data-bs-toggle="tooltip"
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
                    <div class="col-sm-12 mt-4">
                        <div class="row">
                            <div class="col-6">
                            </div>
                            <div class="col-6">
                                <div class="d-flex flex-row-reverse">
                                    {!! $invoices->appends(request()->input())->links('vendor.pagination.bootstrap-4') !!}
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
            var modalDelete = $('#modalDelete');

            $(document).on('click', '.btnDeleteRow', function (event) {
                event.preventDefault();
                let urlDelete = $(this).attr('data-url');
                let id = $(this).attr('data-id');
                $('#formDeleteItem').attr('action',urlDelete);
                modalDelete.modal("show");
            });

            $(document).on('click', '#hideModalDelete', function (event) {
                modalDelete.modal("hide");
            });
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

            $("#due_dateSearch").flatpickr({
                "locale": "vn",
                "maxDate": new Date().fp_incr(100)
            });

            $("#inputDomainType").depdrop({
                depends: ['postDomain'],
                url: '{{route('admin.ajax-domain-type')}}',
                idParam: 'id'
            });
        });
    </script>
@endsection
