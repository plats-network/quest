@extends('admin.layouts.horizontal')

@section("pageTitle","Contacts")

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
                    <li class="breadcrumb-item active" aria-current="page">{{__('crater.items.unit')}}</li>
                </ol>
            </nav>
            <h2 class="h4">{{__('crater.items.unit')}}</h2>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{route('admin.units.create')}}" class="btn btn-sm btn-primary d-inline-flex align-items-center">
                <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                {{__('crater.items.add_item')}}
            </a>

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
                    <caption>Danh sách</caption>
                    <thead class="thead-light">
                    <tr>
                        <th class="border-bottom rounded-start">
                            <div class="form-check dashboard-check"><input class="form-check-input"
                                                                           type="checkbox" value=""
                                                                           id="userCheck55"> <label
                                    class="form-check-label" for="userCheck55"></label></div>
                        </th>
                        <th class="border-0 rounded-start">ID</th>
                        <th class="border-0">{{__('crater.items.name')}}</th>
                        <th class="border-0">Slug</th>
                        <th class="border-0">Mô tả</th>
                        <th class="border-0 rounded-end">{{__('crater.general.actions')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($units as $unit)
                        <tr>
                            <td>
                                <div class="form-check dashboard-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                           id="userCheck1">
                                    <label class="form-check-label" for="userCheck1"></label></div>
                            </td>
                            <td>{{$unit->id}}</td>
                            <td>
                                <a href="{{route('admin.units.edit', ['unit' => $unit])}}">{{$unit->name}}</a></td>
                            <td>{{$unit->slug}}</td>
                            <td>{{$unit->desription}}</td>
                            <td>
                                <div class="btn-group">
                                    <button
                                        class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0"
                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                        </svg>
                                        <span class="visually-hidden">Toggle Dropdown</span></button>
                                    <div
                                        class="dropdown-menu dashboard-dropdown dropdown-menu-start mt-2 py-1">
                                        <a class="dropdown-item d-flex align-items-center" href="{{route('admin.units.edit', ['unit', $unit])}}">
                                            <svg class="dropdown-icon text-gray-400 me-2"
                                                 fill="currentColor" viewBox="0 0 20 20"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                                <path fill-rule="evenodd"
                                                      d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                      clip-rule="evenodd"></path>
                                            </svg>
                                            {{__('crater.general.edit')}} </a>
                                        <a
                                            class="dropdown-item d-flex align-items-center" href="{{route('admin.homeAdmin')}}">
                                            <svg class="dropdown-icon text-danger me-2" fill="currentColor"
                                                 viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M11 6a3 3 0 11-6 0 3 3 0 016 0zM14 17a6 6 0 00-12 0h12zM13 8a1 1 0 100 2h4a1 1 0 100-2h-4z"></path>
                                            </svg>
                                            {{__('crater.general.delete')}}</a></div>
                                </div>
                                <svg class="icon icon-xs text-danger ms-1" data-bs-toggle="tooltip"
                                     fill="currentColor" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg" data-bs-original-title="{{__('crater.general.delete')}}"
                                     aria-label="{{__('crater.general.delete')}}">
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
        </div>
        <div
            class="card-footer px-3 border-0 d-flex flex-column flex-lg-row align-items-center justify-content-between">
            {!! $units->appends(request()->input())->links('vendor.pagination.bootstrap-4') !!}

        </div>
    </div>

@endsection
