@extends('admin.layouts.horizontal')

@section("pageTitle","Contacts")

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

                <h1 class="h4 mt-3">Sản phẩm</h1>
                <h2 class="h5 mt-1">{{__('crater.pdf_total')}}: <b>{{$items->total()}}</b></h2>
            </div>
            <div>
                <a href="{{route('admin.items.create', ['key_param' => 1])}}"
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
                                <th class="border-0 rounded-start">ID</th>
                                <th class="border-0">{{__('crater.items.name')}}</th>
                                <th class="border-0">Đơn vị</th>
                                <th class="border-0">Giá bán</th>
                                <th class="border-0">{{__('crater.items.date_of_creation')}}</th>
                                <th class="border-0">Trạng thái</th>
                                <th class="border-0 rounded-end"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td><a href="{{route('admin.items.edit', $item)}}"
                                           class="text-decoration-none">{{$item->name}}</a></td>
                                    <td>{{$item->unit_name}}</td>
                                    <td>{{format_money($item->price)}}</td>
                                    <td>{{date('d/m/Y', strtotime($item->created_at))}}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox"
                                                   id="flexSwitchCheckChecked{{$item->id}}" checked>
                                            <label class="form-check-label"
                                                   for="flexSwitchCheckChecked{{$item->id}}">Kích hoạt</label>
                                        </div>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.items.destroy', $item->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm"
                                                    type="submit">{{__('crater.general.delete')}}</button>
                                        </form>
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
                                    {!! $items->appends(request()->input())->links('vendor.pagination.bootstrap-4') !!}
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


