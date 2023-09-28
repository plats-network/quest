@extends('admin.layouts.horizontal')

@section("pageTitle","Contacts")

@section('content')
    <div class="container-fluid p-0">
        <div class="row mb-2 mb-xl-3">
            <div class="col-auto d-none d-sm-block">
                <h3>{{__('crater.users.title')}}</h3>
            </div>

            <div class="col-auto ms-auto text-end mt-n1">
                <a href="{{route('admin.users.create')}}" class="btn btn-primary">{{__('crater.users.new_user')}}</a>
            </div>
        </div>

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
                                    <th class="border-0">{{__('crater.users.name')}}</th>
                                    <th class="border-0">{{__('crater.users.email')}}</th>
                                    <th class="border-0">{{__('crater.users.phone')}}</th>
                                    <th class="border-0">{{__('crater.users.added_on')}}</th>
                                    <th class="border-0">Trạng thái</th>
                                    <th colspan=2></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td><a href="{{route('admin.users.edit', $item)}}"
                                               class="text-decoration-none">{{$item->name}}</a></td>
                                        <td>{{$item->email}}</td>
                                        <td>{{$item->phone}}</td>
                                        <td>{{$item->created_at}}</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                       id="flexSwitchCheckChecked{{$item->id}}" checked>
                                                <label class="form-check-label"
                                                       for="flexSwitchCheckChecked{{$item->id}}">Kích hoạt</label>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{route('admin.users.edit', $item)}}"
                                               class="btn btn-primary btn-sm">{{__('crater.general.edit')}}</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.users.destroy', $item->id)}}" method="post">
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
                                        {!! $users->appends(request()->input())->links('vendor.pagination.bootstrap-4') !!}
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
