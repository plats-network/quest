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
                <li class="breadcrumb-item active" aria-current="page">{{__('crater.customers.title')}}</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <ul class="nav nav-tabs navbar-expand-sm">
                    <li class="nav-item">
                        <a class="nav-link navLinkTab {{Request::get('type') ==0 ? 'active': ''}}" aria-current="page"
                           href="{{route('admin.customers.index')}}">{{__('crater.general.all')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navLinkTab {{Request::get('type') ==3 ? 'active': ''}}"
                           href="{{route('admin.customers.index', ['type'=> 3])}}">Hôm nay</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navLinkTab {{Request::get('type') ==1 ? 'active': ''}}"
                           href="{{route('admin.customers.index', ['type'=> 1])}}">Trong tuần</a>
                    </li>
                </ul>

                <h1 class="h4 mt-3">{{__('crater.customers.title')}}</h1>
                <h2 class="h5 mt-1">{{__('crater.pdf_total')}}: <b>{{$customers->total()}}</b></h2>
            </div>
            <div>
                <a href="{{route('admin.customers.create', ['key_param' => 1])}}"
                   class="btn btn-info d-inline-flex align-items-center">
                    <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    {{__('crater.customers.new_customer')}}
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-sm-12">
                            <table class="table table-centered table-hover table-striped table-nowrap mb-0 rounded">
                                <caption>Danh sách</caption>
                                <thead class="thead-light">
                                <tr>
                                    <th class="border-0">ID</th>
                                    <th class="border-0">{{__('crater.customers.title')}}</th>
                                    <th class="border-0">{{__('crater.customers.phone')}}</th>
                                    <th class="border-0">{{__('crater.customers.amount_due')}}</th>
                                    <th class="border-0">{{__('crater.customers.added_on')}}</th>
                                    <th class="border-0">Trạng thái</th>
                                    <th colspan=2></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($customers as $customer)
                                    <tr>
                                        <td>{{$customer->id}}</td>
                                        <td class="pleft0">
                                            <a href="{{route('admin.customers.edit', $customer)}}"
                                               class="d-flex align-items-center colorName">
                                                @if($customer->thumbnail_path)
                                                    <img  src="{{$customer->getAvatarUrl(3)}}" class="avatar lazyload rounded-circle me-3" alt="Avatar">
                                                @else
                                                    <div
                                                        class="avatar d-flex align-items-center justify-content-center fw-bold rounded bg-purple text-white me-3">
                                                        <span>{{$customer->getShortNameShow()}}</span>
                                                    </div>
                                                @endif
                                                <div class="d-block">
                                                    <span class="fw-bold">{{$customer->first_name? $customer->first_name: $customer->name}}</span>
                                                    <div class="small text-gray" title="{{$customer->email}}">{{Str::mask($customer->email, '*',-15, 3)}}</div>

                                                </div>
                                            </a>
                                        </td>

                                        <td>
                                            <div>{{__('crater.customers.contact_name')}}: {{$customer->contact_name}}</div>
                                        <div>{{$customer->phone}}</div>
                                        </td>
                                        <td>{{format_money($customer->due_amount)}}</td>
                                        <td>{{$customer->last_invoice_date}}</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                       id="flexSwitchCheckChecked{{$customer->id}}" checked>
                                                <label class="form-check-label"
                                                       for="flexSwitchCheckChecked{{$customer->id}}">Kích hoạt</label>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{route('admin.customers.edit', $customer)}}"
                                               class="btn btn-primary btn-sm">{{__('crater.general.edit')}}</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.customers.destroy', $customer->id)}}"
                                                  method="post">
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
                        <div class="col-sm-12 mt-3">
                            <div class="row">
                                <div class="col-6">
                                </div>
                                <div class="col-6">
                                    <div class="d-flex flex-row-reverse">
                                        {!! $customers->appends(request()->input())->links('vendor.pagination.bootstrap-4') !!}
                                    </div>
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
