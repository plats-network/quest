@extends('admin.layouts.horizontal')
@section("pageTitle","Add a contact")

@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <style>
        .CodeMirror, .CodeMirror-scroll {
            min-height: 200px;
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
                <h1 class="h4 mt-3">{{__('crater.invoices.title')}}</h1>
            </div>
        </div>
    </div>
    <div class="container-fluid p-0">

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="searchBoxInvoic p-2">
                                    <form class="row gx-3 gy-2 align-items-center">
                                        <div class="col-sm-6">
                                            <label class="visually-hidden" for="iname">Name</label>
                                            <input type="text" class="form-control @error('evaluate_quality') is-invalid @enderror" id="iname" name="name"
                                                   placeholder="{{__('crater.general.search')}}">
                                        </div>
                                    </form>
                                </div>
                                <br>
                                <div class="list-group">

                                    <a href="{{route('admin.homeAdmin')}}" class="list-group-item list-group-item-action">
                                        <div class="d-flex justify-content-between bd-highlight">
                                            <div class="bd-highlight">Mr Vương</div>
                                            <div class="bd-highlight">
                                                <h4 class="h4">200000đ</h4>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between bd-highlight">
                                            <div class="bd-highlight">INV-00009</div>
                                            <div class="bd-highlight">
                                                <p>23/7/2021</p>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between bd-highlight">
                                            <div class="bd-highlight"><span class="badge bg-primary">Draft</span></div>
                                        </div>
                                    </a>

                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="d-flex justify-content-between bd-highlight mb-3">
                                    <div class="p-2 bd-highlight">
                                        <h3 class="h4"> {{$invoice->invoice_number}}</h3>
                                    </div>
                                    <div class="p-2 bd-highlight">

                                    </div>
                                    <div class="p-2 bd-highlight">
                                        @if($invoice->status =='DRAFT')
                                            <button class="btn btn-primary" id="btnMarksend">{{__('crater.invoices.mark_as_sent')}}</button>
                                            <button class="btn btn-info" id="btnsendInvoice">{{__('crater.invoices.send_invoice')}}</button>
                                        @else
                                            <button class="btn btn-info" id="btnRecordPayment"> {{__('crater.invoices.record_payment')}}</button>
                                        @endif
                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">{{__('crater.general.actions')}}
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="{{route('admin.homeAdmin')}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="dropdown-icon text-gray-400 me-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                                    </svg>
                                                    {{__('crater.general.copy_pdf_url')}}
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{route('admin.invoices.edit', $invoice)}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="dropdown-icon text-gray-400 me-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                    {{__('crater.general.edit')}}
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{route('admin.invoices.edit', $invoice)}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="dropdown-icon text-gray-400 me-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    {{__('crater.general.delete')}}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="invoicePdf">
                                    <div class="ratio ratio-16x9">
                                        <iframe src="{{$invoice->invoicePdfUrl}}" title="YouTube video"
                                                allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Content -->
    <div class="modal fade" id="modalSendEmail" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card p-3 p-lg-4">
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="text-center text-md-center mb-4 mt-md-0">
                            <h1 class="mb-0 h4">{{__('crater.invoices.send_invoice')}}</h1>
                        </div>
                        <form method="post" action="{{route('admin.sendInvoiceToCustomer', $invoice)}}" class="mt-4">
                        @csrf
                            <!-- Form -->
                            <div class="form-group mb-4">
                                <label for="email">{{__('crater.general.from')}}</label>
                                <input type="text" class="form-control @error('evaluate_quality') is-invalid @enderror" placeholder="Từ" name="from" id="from"  required>
                            </div>
                            <div class="form-group mb-4">
                                <label for="email">{{__('crater.general.to')}}</label>
                                <input type="text" class="form-control @error('evaluate_quality') is-invalid @enderror" placeholder="" id="to" name="to" value="{{$invoiceCustomer->email}}"  required>
                            </div>
                            <div class="form-group mb-4">
                                <label for="email">{{__('crater.general.subject')}}</label>
                                <input type="text" class="form-control @error('evaluate_quality') is-invalid @enderror" placeholder="" id="subject" name="subject" value="New Invoice"  required>
                            </div>

                            <div class="form-group mb-4">
                                <label for="email">{{__('crater.general.body')}}</label>
                                <textarea class="form-control @error('evaluate_quality') is-invalid @enderror" name="body" id="exampleFormControlTextarea1"
                                          rows="3"></textarea>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">{{__('crater.general.send')}}</button>
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
    <script>
        var _token = $('meta[name="csrf-token"]').attr('content');
        var spinText = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ';
        var hasPage = {{Request::get('page', 0)}};
        var simplemde = new SimpleMDE();
        jQuery(document).ready(function ($) {
            // display a modal (small modal)
            var modalSendInvoice = $('#modalSendEmail');
            $(document).on('click', '#btnsendInvoice', function (event) {
                event.preventDefault();
                modalSendInvoice.modal("show");
            });
        });
    </script>
@endsection
