@extends('admin.layouts.horizontal')

@section("pageTitle","Contacts")

@section('content')
    <div class="container-fluid p-0">
        <div class="row mb-2 mb-xl-3">
            <div class="col-auto d-none d-sm-block">
                <h3>{{__('crater.payments.title')}}</h3>
            </div>

            <div class="col-auto ms-auto text-end mt-n1">
                <a href="{{route('admin.payments.create')}}"
                   class="btn btn-primary">{{__('crater.payments.new_payment')}}</a>
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
                                    <th class="border-0">{{__('crater.payments.date')}}</th>
                                    <th class="border-0">{{__('crater.payments.payment_number')}}</th>
                                    <th class="border-0">{{__('crater.payments.customer')}}</th>
                                    <th class="border-0">{{__('crater.payments.payment_mode')}}</th>
                                    <th class="border-0">{{__('crater.payments.invoice')}}</th>
                                    <th class="border-0">{{__('crater.payments.amount')}}</th>
                                    <th colspan=2></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($payments as $payment)
                                    <tr>
                                        <td>{{$payment->id}}</td>
                                        <td>{{$payment->payment_date}}</td>
                                        <td><a href="{{route('admin.payments.edit', $payment)}}"
                                               class="text-decoration-none">{{$payment->payment_number}}</a></td>
                                        <td>{{$payment->name}}</td>
                                        <td>{{$payment->payment_mode}}</td>
                                        <td>{{$payment->invoice_number}}</td>
                                        <td>{{format_money($payment->amount)}}</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                       id="flexSwitchCheckChecked{{$payment->id}}" checked>
                                                <label class="form-check-label"
                                                       for="flexSwitchCheckChecked{{$payment->id}}">Kích hoạt</label>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{route('admin.payments.edit', $payment)}}"
                                               class="btn btn-primary btn-sm">{{__('crater.general.edit')}}</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.payments.destroy', $payment->id)}}"
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
                                        {!! $payments->appends(request()->input())->links('vendor.pagination.bootstrap-4') !!}
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
