@extends ('layouts.backend')

<?php
$module_icon = "fa-solid fa-list-check";
?>

@section('title') {{ __('Log Viewer Dashboard') }} @endsection

@section('breadcrumbs')
<x-backend-breadcrumbs>
    <x-backend-breadcrumb-item route="{{ route('log-viewer::dashboard') }}" icon='{{ $module_icon }}'>
        {{ __('Log Viewer Dashboard') }}
    </x-backend-breadcrumb-item>
    <x-backend-breadcrumb-item route="{{ route('log-viewer::logs.list') }}">{{ __('Logs by Date') }}</x-backend-breadcrumb-item>
    <x-backend-breadcrumb-item type="active">@lang('Log') [{{ $log->date }}]</x-backend-breadcrumb-item>
</x-backend-breadcrumbs>
@endsection

@section('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                    <li class="breadcrumb-item">
                        <a href="#">
                            <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Transactions</li>
                </ol>
            </nav>
            <h2 class="h4">All Orders</h2>
            <p class="mb-0">Your web analytics dashboard template.</p>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="#" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
                <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                New Plan
            </a>
            <div class="btn-group ms-2 ms-lg-3">
                <button type="button" class="btn btn-sm btn-outline-gray-600">@lang('Share')</button>
                <button type="button" class="btn btn-sm btn-outline-gray-600">@lang('Export')</button>
            </div>
        </div>
    </div>
    <div class="table-settings mb-4">
        <div class="row align-items-center justify-content-between">
            <div class="col col-md-6 col-lg-3 col-xl-4">
                <div class="input-group me-2 me-lg-3 fmxw-400">
                            <span class="input-group-text">
                                <svg class="icon icon-xs" x-description="Heroicon name: solid/search" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                                </svg>
                            </span>
                    <input type="text" class="form-control" placeholder="Search orders">
                </div>
            </div>
            <div class="col-4 col-md-2 col-xl-1 ps-md-0 text-end">
                <div class="dropdown">
                    <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path></svg>
                        <span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-xs dropdown-menu-end pb-0">
                        <span class="small ps-3 fw-bold text-dark">@lang('Show')</span>
                        <a class="dropdown-item d-flex align-items-center fw-bold" href="#">10 <svg class="icon icon-xxs ms-auto" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg></a>
                        <a class="dropdown-item fw-bold" href="#">20</a>
                        <a class="dropdown-item fw-bold rounded-bottom" href="#">30</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-8">
                <h4 class="card-title mb-0">
                    <i class="{{$module_icon}}"></i> @lang('Log') [{{ $log->date }}]
                    <small class="text-muted"> @lang('Details') </small>
                </h4>
                <div class="small text-muted">
                    @lang('Log Viewer Module')
                </div>
            </div>

            <div class="col-4">
                <div class="btn-toolbar float-end" role="toolbar" aria-label="Toolbar with button groups">
                    <x-backend.buttons.return-back />
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col">

                <div class="row">
                    <div class="col-lg-2">
                        {{-- Log Menu --}}
                        <div class="card mb-4">
                            <div class="card-header"><i class="fa fa-fw fa-flag"></i> @lang('Levels')</div>
                            <div class="list-group list-group-flush log-menu">
                                @foreach($log->menu() as $levelKey => $item)
                                @if ($item['count'] === 0)
                                <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center disabled">
                                    <span class="level-name">{!! $item['icon'] !!} {{ $item['name'] }}</span>
                                    <span class="badge empty">{{ $item['count'] }}</span>
                                </a>
                                @else
                                <a href="{{ $item['url'] }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center level-{{ $levelKey }}{{ $level === $levelKey ? ' active' : ''}}">
                                    <span class="level-name">{!! $item['icon'] !!} {{ $item['name'] }}</span>
                                    <span class="badge badge-level-{{ $levelKey }}">{{ $item['count'] }}</span>
                                </a>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10">
                        {{-- Log Details --}}
                        <div class="card mb-4">
                            <div class="card-header">
                                <strong>
                                    @lang('Log Info')
                                </strong>
                                <div class="btn-toolbar float-end">
                                    <a href="{{ route('log-viewer::logs.download', [$log->date]) }}" class="btn btn-success">
                                        <i class="fas fa-download"></i>&nbsp;@lang('Download')
                                    </a>
                                    <a href="#delete-log-modal" class="btn btn-danger ms-1" data-coreui-toggle="modal">
                                        <i class="fas fa-trash-alt"></i>&nbsp;@lang('Delete')
                                    </a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-condensed mb-0">
                                    <tbody>
                                        <tr>
                                            <td>@lang('File path') :</td>
                                            <td colspan="7">{{ $log->getPath() }}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('Log entries') : </td>
                                            <td>
                                                <span class="badge text-bg-primary">{{ $entries->total() }}</span>
                                            </td>
                                            <td>@lang('Size') :</td>
                                            <td>
                                                <span class="badge text-bg-primary">{{ $log->size() }}</span>
                                            </td>
                                            <td>@lang('Created at') :</td>
                                            <td>
                                                <span class="badge text-bg-primary">{{ $log->createdAt() }}</span>
                                            </td>
                                            <td>@lang('Updated at') :</td>
                                            <td>
                                                <span class="badge text-bg-primary">{{ $log->updatedAt() }}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                {{-- Search --}}
                                <form action="{{ route('log-viewer::logs.search', [$log->date, $level]) }}" method="GET">
                                    <div class=form-group">
                                        <div class="input-group">
                                            <input id="query" name="query" class="form-control" value="{!! request('query') !!}" placeholder="Type here to search">
                                            <div class="input-group-append">
                                                @if (request()->has('query'))
                                                <a href="{{ route('log-viewer::logs.show', [$log->date]) }}" class="btn bg-secondary">
                                                    <i class="fa fa-fw fa-times"></i>
                                                </a>
                                                @endif
                                                <button id="search-btn" class="btn btn-primary">
                                                    <span class="fa fa-fw fa-search"></span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- Log Entries --}}
                        <div class="card mb-4">
                            @if ($entries->hasPages())
                            <div class="card-header">
                                <span class="badge badge-info float-end">
                                    Page {!! $entries->currentPage() !!} of {!! $entries->lastPage() !!}
                                </span>
                            </div>
                            @endif

                            <div class="table-responsive">
                                <table id="entries" class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th>ENV</th>
                                            <th style="width: 120px;">@lang('Level')</th>
                                            <th style="width: 65px;">@lang('Time')</th>
                                            <th>@lang('Header')</th>
                                            <th class="text-end">@lang('Actions')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($entries as $key => $entry)
                                        <tr>
                                            <td>
                                                <span class="badge badge-env">{{ $entry->env }}</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-level-{{ $entry->level }}">
                                                    {!! $entry->level() !!}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary">
                                                    {{ $entry->datetime->format('H:i:s') }}
                                                </span>
                                            </td>
                                            <td>
                                                @php
                                                    $header = $entry->header;
                                                    //Show header by two lines
                                                    $firstLine = substr($header, 0, 100);
                                                    $secondLine = substr($header, 100);

                                                @endphp
                                                {{ $firstLine }} <br>
                                                {{ $secondLine }} <br>

                                            </td>
                                            <td class="text-end">
                                                @if ($entry->hasStack())
                                                <a class="btn btn-sm btn-light" role="button" data-coreui-toggle="collapse" href="#log-stack-{{ $key }}" aria-expanded="false" aria-controls="log-stack-{{ $key }}">
                                                    <i class="fa fa-toggle-on"></i> Stack
                                                </a>
                                                @endif
                                            </td>
                                        </tr>
                                        @if ($entry->hasStack())
                                        <tr>
                                            <td colspan="5" class="stack py-0">
                                                <div class="stack-content collapse" id="log-stack-{{ $key }}">
                                                    {!! $entry->stack() !!}
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center">
                                                <span class="badge bg-secondary">{{ trans('log-viewer::general.empty-logs') }}</span>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {!! $entries->appends(compact('query'))->render('pagination::bootstrap-5') !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>



{{-- DELETE MODAL --}}
<div id="delete-log-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form id="delete-log-form" action="{{ route('log-viewer::logs.delete') }}" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="date" value="{{ $log->date }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">DELETE LOG FILE</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to <span class="badge bg-danger">DELETE</span> this log file <span class="badge text-bg-warning">{{ $log->date }}</span> ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary mr-auto" data-coreui-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-danger" data-loading-text="Loading&hellip;">DELETE FILE</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('after-scripts')
<script type="module">
    $(function() {
        var deleteLogModal = $('div#delete-log-modal'),
            deleteLogForm = $('form#delete-log-form'),
            submitBtn = deleteLogForm.find('button[type=submit]');

        deleteLogForm.on('submit', function(event) {
            event.preventDefault();
            submitBtn.button('loading');

            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                dataType: 'json',
                data: $(this).serialize(),
                success: function(data) {
                    submitBtn.button('reset');
                    if (data.result === 'success') {
                        deleteLogModal.modal('hide');
                        location.replace("{{ route('log-viewer::logs.list') }}");
                    } else {
                        alert('OOPS ! This is a lack of coffee exception !')
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    alert('AJAX ERROR ! Check the console !');
                    console.error(errorThrown);
                    submitBtn.button('reset');
                }
            });

            return false;
        });

        @unless(empty(log_styler() -> toHighlight()))
        @php
        $htmlHighlight = version_compare(PHP_VERSION, '7.4.0') >= 0 ?
            join('|', log_styler() -> toHighlight()) :
            join(log_styler() -> toHighlight(), '|');
        @endphp

        $('.stack-content').each(function() {
            var $this = $(this);
            var html = $this.html().trim()
                .replace(/({!! $htmlHighlight !!})/gm, '<strong>$1</strong>');

            $this.html(html);
        });
        @endunless
    });
</script>
@endpush

@push('after-styles')
@include('log-viewer::laravel-starter.partials.style')
@endpush
