@extends('admin.layouts.horizontal', ['hide_footer' => true])
@section("pageTitle","Add a contact")

@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.1.1/dist/select2-bootstrap-5-theme.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <style>
        .CodeMirror, .CodeMirror-scroll {
            min-height: 200px;
        }
        .textSummary{
            text-transform:capitalize
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
                <li class="breadcrumb-item" ><a href="{{route('admin.invoices.index')}}">{{__('crater.invoices.title')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{__('crater.items.add_item')}}</li>
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

                <h1 class="h4 mt-3">{{$type ==1 ? __('crater.general.create'):  __('crater.general.update')}}</h1>
            </div>
            <div>
                <a href="{{route('admin.invoices.index', ['key_param' => 1])}}"
                   class="btn btn-info d-inline-flex align-items-center">

                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-xs me-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                    </svg>
                    Danh sách
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">
                    <div class="card-body">
                        <div class="col-sm-12">
                            <div>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div><br/>
                                @endif
                                <form method="post" id="post_form"
                                      action="{{ $type == 1 ? route('admin.invoices.store'): route('admin.invoices.update', $invoice) }}">
                                    @if($type ==2)
                                        @method('PATCH')
                                    @endif
                                    @csrf

                                        <h2 class="h5 my-4">Thông tin khách hàng</h2>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-group field-name">
                                                    <label for="city">{{__('crater.invoices.customer')}}</label>
                                                    <select class="form-select w-100 mb-0" id="customerInvoice" name="customer_id"
                                                            aria-label="Customer">
                                                        <option value="">{{__('crater.general.all')}}</option>
                                                        @foreach($customers as $key=> $customerItem)
                                                            <option
                                                                value="{{$customerItem->id}}" {!! (($customerItem->id == Request::get('customer_id') || ($customer->id == $customerItem->id))) ? ' selected="selected"' : '' !!} >{{$customerItem->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label"
                                                           for="first_name"><b>Mã KH :</b></label>
                                                    <input type="text" class="form-control @error('evaluate_quality') is-invalid @enderror" name="customer_id" id="customer_id"
                                                           value="{{$customer->id}}"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label"
                                                           for="first_name"><b>Số điện thoại :</b></label>
                                                    <input type="text" class="form-control @error('evaluate_quality') is-invalid @enderror" name="customer_phone"
                                                           id="customer_phone" value="{{$customer->phone}}"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label"
                                                           for="first_name"><b>Email KH :</b></label>
                                                    <input type="text" class="form-control @error('evaluate_quality') is-invalid @enderror" name="customer_email"
                                                        id="customer_email"   value="{{$customer->email}}"/>
                                                </div>
                                            </div>
                                        </div>
                                        <h2 class="h5 my-4">{{__('crater.invoices.title')}}</h2>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label"
                                                           for="first_name"><b>{{__('crater.invoices.status')}}
                                                            :</b></label>
                                                    <select class="form-select w-100 mb-0" id="inputDomainType" name="status"
                                                            aria-label="Category">
                                                        <option value="">{{__('crater.general.all')}}</option>
                                                        @foreach($dataInvoiceStatus as $key=> $itemStatus)
                                                            <option
                                                                value="{{$key}}" {!! (($key == $invoice->status)) ? ' selected="selected"' : '' !!} >{{$itemStatus}}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>
                                        </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label"
                                                       for="invoice_date"><b>{{__('crater.invoices.date')}}
                                                        :</b></label>
                                                <input type="text" class="form-control @error('evaluate_quality') is-invalid @enderror" id="invoice_date" name="invoice_date"
                                                       value="{{$invoice->invoice_date}}"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label"
                                                       for="due_date"><b>{{__('crater.invoices.due_date')}}
                                                        :</b></label>
                                                <input type="text" class="form-control @error('evaluate_quality') is-invalid @enderror" id="due_date" name="due_date"
                                                       value="{{$invoice->due_date}}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label"
                                                       for="first_name"><b>{{__('crater.invoices.number')}}
                                                        :</b></label>
                                                <input type="text" class="form-control @error('evaluate_quality') is-invalid @enderror" name="invoice_number"
                                                       value="{{$invoice->invoice_number}}"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label"
                                                       for="first_name"><b>{{__('crater.invoices.ref_number')}}
                                                        :</b></label>
                                                <input type="text" class="form-control @error('evaluate_quality') is-invalid @enderror" name="reference_number"
                                                       value="{{$invoice->reference_number}}"/>
                                            </div>
                                        </div>
                                    </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                    <table class="table">
                                        <thead class="thead-light">
                                        <tr>
                                            <th scope="col" class="border-bottom">#</th>
                                            <th scope="col" class="border-bottom">{{__('crater.invoices.item.title')}}</th>
                                            <th scope="col" class="border-bottom">{{__('crater.invoices.item.quantity')}}</th>
                                            <th scope="col" class="border-bottom">{{__('crater.invoices.item.price')}}</th>
                                            <th scope="col" class="border-bottom">{{__('crater.invoices.item.tax')}}</th>
                                            <th scope="col" class="border-bottom">{{__('crater.invoices.item.amount')}}</th>
                                            <th scope="col" class="text-center border-bottom">{{__('crater.general.actions')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody id="loadListProduct">
                                        @foreach($invoiceItem as $key=> $item)
                                        <tr>
                                            <input type="hidden" class="form-control @error('evaluate_quality') is-invalid @enderror"   name="product[{{$item->id}}][item_id]" value="{{ $item->id }}">
                                            <input type="hidden" class="form-control @error('evaluate_quality') is-invalid @enderror"  name="product[{{$item->id}}][name]" value="{{ $item->name }}">

                                            <th scope="row">{{$key +1}}</th>
                                            <td>
                                                <div class="d-block">
                                                    <span class="fw-bold">{{$item->name}}</span>
                                                    <div class="small text-gray">{{$item->description}}</div>
                                                </div>
                                            </td>
                                            <td style="width: 12%">
                                                <input type="number" name="product[{{$item->id}}][quantity]"  min="1" max="100" value="{{$item->quantity}}" class="form-control itemQuantity" id="inputQuantity{{$item->id}}">
                                            </td>
                                            <td style="width: 22%">
                                                <input type="number"  name="product[{{$item->id}}][price]" min="0" max="100000000" value="{{($item->price)}}" class="form-control itemQuantity" id="inputPrice{{$item->id}}">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control js-change-money" min="0" max="100"  placeholder="Thuế" name="product[{{$item->id}}][tax]" value="0">
                                            </td>
                                            <td>
                                                {{format_money_vnd($item->total)}}
                                                <input type="hidden" class="form-control js-change-money js-total"  name="product[{{$item->id}}][total]" value="{{$item->total}}">
                                            </td>
                                            <td class="text-center">
                                                    <button class="btn btn-danger btn-sm btnDeleteTr" type="button"
                                                            data-item_id="{{$item->id}}"
                                                            data-invoice_id="{{$invoice->id}}">{{__('crater.general.delete')}}</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                     </div>

                                    <div class="d-flex justify-content-center bd-highlight mb-3">
                                        <div class="p-2 bd-highlight">
                                            <button type="button" id="btnAddItem" class="btn btn-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-xs me-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                                </svg>
                                                {{__('crater.invoices.add_item')}}
                                            </button>
                                        </div>
                                    </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group mb-3">
                                                <label class="form-label"
                                                       for="first_name"><b>{{__('crater.invoices.notes')}}:</b></label>
                                                <textarea class="form-control @error('evaluate_quality') is-invalid @enderror" name="notes" id="exampleFormControlTextarea1"
                                                          rows="3">{{$invoice->notes}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between bd-highlight mb-3">
                                                        <div
                                                            class="p-2 bd-highlight textSummary">{{__('crater.invoices.sub_total')}}</div>
                                                        <div class="p-2 bd-highlight"></div>
                                                        <div class="p-2 bd-highlight ">{{format_money_vnd($invoice->sub_total)}}</div>
                                                    </div>
                                                    <div class="d-flex justify-content-between bd-highlight mb-3">
                                                        <div
                                                            class="p-2 bd-highlight textSummary">{{__('crater.invoices.discount')}}</div>
                                                        <div class="p-2 bd-highlight"></div>
                                                        <div class="p-2 bd-highlight ">

                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-between bd-highlight mb-3">
                                                        <div
                                                            class="p-2 bd-highlight textSummary">{{__('crater.invoices.total')}}</div>
                                                        <div class="p-2 bd-highlight"></div>
                                                        <div class="p-2 bd-highlight ">{{format_money_vnd($invoice->total)}}</div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="disabledSelect" class="form-label">{{__('crater.invoices.template')}}</label>
                                                    <select id="disabledSelect" class="form-select" name="template_name">
                                                        <option value="invoice2">Template 1</option>
                                                        <option value="invoice2">Template 2</option>
                                                        <option value="invoice3">Template 3</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    <div class="mt-5"></div>
                                    <br>
                                    <div class="c-conversionArea">
                                        <div class="c-conversionArea__container">
                                            <div class="row justify-content-between align-items-center">
                                                <div class="mt-0 mb-5 buttonAction">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div
                                                                class="d-flex justify-content-center bd-highlight mb-3">
                                                                <div class="p-2 bd-highlight">
                                                                    <button id="btnSubmitForm"
                                                                            class="btn btn-info btn-md mt-1 animate-up-2"
                                                                            type="submit"><i
                                                                            class="fas fa-check"></i>
                                                                        {{$type ==2 ?  __('crater.general.update'): __('crater.general.add_new_item')}}
                                                                    </button>
                                                                </div>
                                                                <div class="p-2 bd-highlight">
                                                                    @if($type ==2)
                                                                        <div class="p-2 bd-highlight">
                                                                            <button type="button" data-toggle="modal"
                                                                                    id="btnDelete"
                                                                                    data-target="#modalDelete"
                                                                                    title="Delete User"
                                                                                    class="btn btn-danger">
                                                                                <i class="fas fa-trash"></i>
                                                                                {{__('crater.general.delete')}}
                                                                            </button>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Content -->
    @if($type ==2)
    <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="modal-default"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">

            <div class="modal-content">
                <form action="{{ route('admin.invoices.destroy', $invoice)}}"
                      method="delete">
                    <div class="modal-body">
                        @csrf
                        @method('DELETE')
                        <div class="modal-header">
                            <h2 class="h6 modal-title">{{__('crater.general.confirm_delete')}}?</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="hideModalDelete"
                                    data-bs-dismiss="modal">{{__('crater.general.cancel')}}
                            </button>
                            <button type="submit" class="btn btn-danger">{{__('crater.general.delete')}}</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    @endif
    <!-- End of Modal Content -->
    <!-- Modal Content -->
    <div class="modal fade" id="modal_add_item" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card p-3 p-lg-4">
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="text-center text-md-center mb-4 mt-md-0">
                            <h1 class="mb-0 h4">{{__('crater.invoices.add_item')}}</h1>
                        </div>
                        <form method="POST" action="{{route('admin.postInvoiceAddItem', $invoice)}}" class="mt-4">
                        @csrf
                            <!-- Form -->
                            <input type="hidden" id="urlDetailItem" value="">
                            <input type="hidden" id="idIemSelect" value="">
                            <div class="form-group mb-4">
                                <label for="email">{{__('crater.invoices.item.title')}}</label>
                                <select class="form-select w-100 mb-0" id="itemSelect" name="item_id"
                                        aria-label="Category">
                                    <option value="">Chọn sản phẩm</option>
                                    @foreach($items as $key=> $item)
                                        <option value="{{$item->id}}" {!! (($key == $item->id)) ? ' selected="selected"' : '' !!} >{{$item->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group field-name">
                                        <!-- Form -->
                                        <div class="form-group mb-4">
                                            <label for="password">Số lượng</label>
                                            <input type="number" name="quantity_value" placeholder="Số lượng" min="1" max="100" value="1" class="form-control @error('evaluate_quality') is-invalid @enderror" id="input_item_quantity" required>
                                        </div>
                                        <!-- End of Form -->
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group field-name">
                                        <!-- Form -->
                                        <div class="form-group mb-4">
                                            <label for="password">Giá bán</label>
                                            <input type="text" placeholder="Giá bán" value="" class="form-control @error('evaluate_quality') is-invalid @enderror" id="input_item_price" required>
                                        </div>
                                        <!-- End of Form -->
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group field-name">
                                        <!-- Form -->
                                        <div class="form-group mb-4">
                                            <label for="password">Ghi chú</label>
                                            <input type="text" placeholder="Ghi chú" min="1" max="100" value="1" class="form-control @error('evaluate_quality') is-invalid @enderror" id="input_item_note" required>
                                        </div>
                                        <!-- End of Form -->
                                    </div>
                                </div>
                            <!-- End of Form -->
                            </div>

                            <div class="d-grid">
                                <button type="button" id="btnAddInvoiceItem" class="btn btn-primary">{{__('crater.general.add_new_item')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Modal Content -->
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    {{--JA VN KO--}}
    <script src="https://npmcdn.com/flatpickr@4.6.13/dist/l10n/vn.js"></script>
    <script src="https://npmcdn.com/flatpickr@4.6.13/dist/l10n/ja.js"></script>
    <script src="https://npmcdn.com/flatpickr@4.6.13/dist/l10n/ko.js"></script>

    <script>
        var simplemde = new SimpleMDE();
        var _token = $('meta[name="csrf-token"]').attr('content');
        var spinText = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ';
        var hasPage = {{Request::get('page', 0)}};
        $("#invoice_date").flatpickr({
            "locale": "vn"
        });
        $("#due_date").flatpickr({
            "locale": "vn"
        });

        jQuery(document).ready(function ($) {
            // display a modal (small modal)
            var modalDelete = $('#modalDelete');
            var modalAddItem = $('#modal_add_item');
            var uploadUrl = '{{get_upload_url()}}';

            var fileAvatarInit = null;

            $(document).on('click', '#btnDelete', function (event) {
                event.preventDefault();
                let href = $(this).attr('data-attr');
                modalDelete.modal("show");
            });

            /*
            * Update infor
            * */
            $( "#customerInvoice" ).change(function() {
                let item_id = $(this).val();
                dataSend = {id: item_id, _token: _token};

                $.ajax({
                    url: '{{ route('admin.ajaxGetCustomerDetail') }}',
                    type: "GET",
                    data: dataSend,
                    success: function (response) {
                        data = response.customer;
                        $("#customer_id").val(data.id);
                        $("#customer_phone").val(data.phone);
                        $("#customer_email").val(data.email);
                        return true;
                    },
                    error: function (xhr, error) {
                        return false;
                    },
                });
            });
            $( "#itemSelect" ).change(function() {

                let item_id = $(this).val();

                dataSend = {id: item_id, _token: _token};

                $.ajax({
                    url: '{{ route('admin.ajaxGetItemDetail') }}',
                    type: "GET",
                    data: dataSend,
                    success: function (response) {
                        data = response.item;
                        console.log(data)
                        $("#input_item_price").val(data.price);
                        $("#idIemSelect").val(data.id);
                        $("#urlDetailItem").val(data.url);
                        return true;
                    },
                    error: function (xhr, error) {
                        return false;
                    },
                });
            });

            $(document).on('click', '#btnAddItem', function (event) {
                event.preventDefault();
                let href = $(this).attr('data-attr');
                modalAddItem.modal("show");
            });

            $(document).on('click', '#btnAddInvoiceItem', function (event) {
                event.preventDefault();
                addItemProduct();
                modalAddItem.modal("hide");
            });

            $(document).on('click', '#hideModalDelete', function (event) {
                modalDelete.modal("hide");
            });

            $("#customerInvoice").select2({
                tags: false,
                theme: "bootstrap-5",
                containerCssClass: "select2--medium", // For Select2 v4.0
                selectionCssClass: "select2--medium", // For Select2 v4.1
                dropdownCssClass: "select2--medium",
            });
            /*Add Item Invoice*/

            $('.btnAddItem').on('click', function () {

                let row_id = $(this).data('post_id');
                let invoice_id = {{$invoice->id? $invoice->id: 1}};
                let week_key =2;
                let type = 4
                let value = 2;

                dataSend = {id: row_id, invoice:invoice_id, type: type, value: value, _token: _token};
                index = '' + row_id + week_key + type;
                console.log(index)

                $.ajax({
                    url: '{{ route('FruitStore.ajaxAddCartItem') }}',
                    type: "POST",
                    data: dataSend,
                    success: function (response) {
                        data = response.item;
                        console.log(data)
                        $("#input_item_price").val(data.price);
                        //updateCartGlobal();
                        //toast.show();
                        return true;
                    },
                    error: function (xhr, error) {
                        return false;
                    },
                });

            });

            function addItemProduct(){
                event.preventDefault();
                let itemId = $('#idIemSelect').val();
                let urlRequest = $('#urlDetailItem').val();
                $.ajax({
                    type: "GET",
                    url: urlRequest,
                    dataType: "json",
                    success: function (response) {
                        if (response.code == 200) {
                            $("#loadListProduct").append(response.html);
                            //
                            addInfoMsg('Thêm sản phẩm thành công.')
                        }
                    },
                });
            }

            $(document).on('click', '.btnDeleteTr', function () {
                $(this).parents('tr').remove();
            })
        });
    </script>
@endsection
