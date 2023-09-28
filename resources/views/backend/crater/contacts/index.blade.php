@extends('sale.layouts.appkit')

@section("pageTitle","Contacts")

@section('content')
    <div class="container-fluid p-0">
        <div class="row mb-2 mb-xl-3">
            <div class="col-auto d-none d-sm-block">
                <h3>Liên hệ với chúng tôi</h3>
            </div>

            <div class="col-auto ms-auto text-end mt-n1">
                <a href="{{route('admin.contacts.create')}}" class="btn btn-primary">New Contact</a>
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
                                    <th class="border-0">{{__('crater.items.name')}}</th>
                                    <th class="border-0">{{__('crater.customers.email')}}</th>
                                    <th class="border-0">Job Title</th>
                                    <th class="border-0">{{__('base.City')}}</th>
                                    <th class="border-0">Country</th>
                                    <th colspan=2>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($contacts as $contact)
                                    <tr>
                                        <td>{{$contact->id}}</td>
                                        <td>{{$contact->first_name}} {{$contact->last_name}}</td>
                                        <td>{{$contact->email}}</td>
                                        <td>{{$contact->job_title}}</td>
                                        <td>{{$contact->city}}</td>
                                        <td>{{$contact->country}}</td>
                                        <td>
                                            <a href="{{route('admin.contacts.edit', $contact->id)}}"
                                               class="btn btn-primary btn-sm">Edit</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.contacts.destroy', $contact->id)}}"
                                                  method="post">
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
                                        {!! $contacts->appends(request()->input())->links('vendor.pagination.bootstrap-4') !!}
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
