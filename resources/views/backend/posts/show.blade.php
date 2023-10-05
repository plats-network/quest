@extends ('layouts.backend')

@section('title') {{ __($module_action) }} {{ __($module_title) }} @endsection

@section('breadcrumbs')
<x-backend-breadcrumbs>
    <x-backend-breadcrumb-item route='{{route("backend.$module_name.index")}}' icon='{{ $module_icon }}'>
        {{ __($module_title) }}
    </x-backend-breadcrumb-item>
    <x-backend-breadcrumb-item type="active">{{ __($module_action) }}</x-backend-breadcrumb-item>
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
                    <li class="breadcrumb-item active" aria-current="page">{{__('posts.title')}}</li>
                </ol>
            </nav>
            <h2 class="h4">{{__('posts.title_post')}} Detail - Quest Complete</h2>
            <p class="mb-0">Your web analytics dashboard template.</p>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button  data-bs-toggle="modal" data-bs-target="#modal-achievement" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
                <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Prize Draw
            </button>
            <!-- Button Modal -->
            <div class="btn-group ms-2 ms-lg-3">
                <button type="button" class="btn btn-sm btn-outline-gray-600">@lang('Share')</button>
                <button type="button" class="btn btn-sm btn-outline-gray-600">@lang('Export')</button>
            </div>
        </div>
    </div>


<div class="card">
    <div class="card-body">

        <x-backend.section-header>
            <i class="{{ $module_icon }}"></i> {{ __($module_title) }} <small class="text-muted">{{ __($module_action) }}</small>

            <x-slot name="subtitle">
                @lang(":module_name Management Dashboard", ['module_name'=>Str::title($module_name)])
            </x-slot>
            <x-slot name="toolbar">
                <x-backend.buttons.return-back />
                <a href="{{ route("backend.$module_name.index") }}" class="btn btn-secondary" data-toggle="tooltip" title="{{ ucwords($module_name) }} List"><i class="fas fa-list"></i> List</a>
                @can('edit_'.$module_name)
                <x-buttons.edit route='{!!route("backend.$module_name.edit", $$module_name_singular)!!}' title="{{__('Edit')}} {{ ucwords(Str::singular($module_name)) }}" class="ms-1" />
                @endcan
            </x-slot>
        </x-backend.section-header>

        {{--Danh sách trúng thưởng--}}
        <div class="container2" id="listPrizeWin">
            <div class="bg-white px-4 py-3 rounded shadow-sm">
                <h5 class="text-center">List User Prize</h5>
                <table class="table table-responsive">
                    <thead>
                    <tr>
                        <th>Project</th>
                        <th>Budget</th>
                        <th>Status</th>
                        <th>Completion</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="d-flex align-items-center">
                            <img class="img-fluid rounded-circle border border-white" style="height: 35px; width: 35px; object-fit: cover; object-position: top;" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=128&amp;q=60" data-config-id="auto-img-2">
                            <div class="ps-3">
                                <p class="mb-0 fw-bold">Alex</p>
                                <a class="text-decoration-none" href="#">www.reactjs.org</a>
                            </div>
                        </td>
                        <td class="fw-bold">5000</td>
                        <td>
                            <span class="badge py-2 px-3 bg-success rounded-pill text-uppercase">Success</span>
                        </td>

                        <td>
                            <div class="d-flex align-items-center">
                                <p class="mb-0 fw-bold me-2">100%</p>
                                <div class="progress w-50" style="height: 6px;">
                                    <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="d-flex align-items-center">
                            <img class="img-fluid rounded-circle border border-white" style="height: 35px; width: 35px; object-fit: cover; object-position: top;" src="https://shuffle.dev/wrexa-assets/images/avatar-women1.png" data-config-id="auto-img-2">

                            <div class="ps-3">
                                <p class="mb-0 fw-bold">Coo</p>
                                <a class="text-decoration-none" href="#">www.reactjs.org</a>
                            </div>
                        </td>
                        <td class="fw-bold">5000</td>
                        <td>
                            <span class="badge py-2 px-3 bg-success rounded-pill text-uppercase">Success</span>
                        </td>

                        <td>
                            <div class="d-flex align-items-center">
                                <p class="mb-0 fw-bold me-2">100%</p>
                                <div class="progress w-50" style="height: 6px;">
                                    <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="d-flex align-items-center">
                            <img class="img-fluid rounded-circle border border-white" style="height: 35px; width: 35px; object-fit: cover; object-position: top;" src="https://images.unsplash.com/photo-1456327102063-fb5054efe647?ixlib=rb-1.2.1&auto=format&fit=crop&w=128&q=60" data-config-id="auto-img-2">
                            <div class="ps-3">
                                <p class="mb-0 fw-bold">Alex</p>
                                <a class="text-decoration-none" href="#">www.reactjs.org</a>
                            </div>
                        </td>
                        <td class="fw-bold">5000</td>
                        <td>
                            <span class="badge py-2 px-3 bg-success rounded-pill text-uppercase">Success</span>
                        </td>

                        <td>
                            <div class="d-flex align-items-center">
                                <p class="mb-0 fw-bold me-2">100%</p>
                                <div class="progress w-50" style="height: 6px;">
                                    <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="d-flex align-items-center">
                            <img class="img-fluid rounded-circle border border-white" style="height: 35px; width: 35px; object-fit: cover; object-position: top;" src="https://shuffle.dev/uinel-assets/elements/dashboard-tables/av-2.png" data-config-id="auto-img-2">

                            <div class="ps-3">
                                <p class="mb-0 fw-bold">Coo</p>
                                <a class="text-decoration-none" href="#">www.reactjs.org</a>
                            </div>
                        </td>
                        <td class="fw-bold">5000</td>
                        <td>
                            <span class="badge py-2 px-3 bg-success rounded-pill text-uppercase">Success</span>
                        </td>

                        <td>
                            <div class="d-flex align-items-center">
                                <p class="mb-0 fw-bold me-2">100%</p>
                                <div class="progress w-50" style="height: 6px;">
                                    <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="d-flex align-items-center">
                            <img class="img-fluid rounded-circle border border-white" style="height: 35px; width: 35px; object-fit: cover; object-position: top;" src="https://shuffle.dev/dashy-assets/images/avatar34.png" data-config-id="auto-img-2">

                            <div class="ps-3">
                                <p class="mb-0 fw-bold">Coo</p>
                                <a class="text-decoration-none" href="#">www.reactjs.org</a>
                            </div>
                        </td>
                        <td class="fw-bold">5000</td>
                        <td>
                            <span class="badge py-2 px-3 bg-success rounded-pill text-uppercase">Success</span>
                        </td>

                        <td>
                            <div class="d-flex align-items-center">
                                <p class="mb-0 fw-bold me-2">100%</p>
                                <div class="progress w-50" style="height: 6px;">
                                    <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <hr>

        <div class="row mt-4">
            <div class="col-12 col-sm-6">

                @include('backend.includes.show')

            </div>
            <div class="col-12 col-sm-6">

                <div class="text-center">
                    <a href="{{route("frontend.$module_name.show", [encode_id($$module_name_singular->id), $$module_name_singular->slug])}}" class="btn btn-success" target="_blank"><i class="fas fa-link"></i> Public View</a>
                </div>
                <hr>

                <h4>@lang('Category') </h4>
                <ul>
                    <li>
                        <a href="{{route('backend.categories.show', $$module_name_singular->category_id)}}">{{$$module_name_singular->category_name}}</a>
                    </li>
                </ul>
                <hr>

                <h4>Tags</h4>
                <ul>
                    @foreach($$module_name_singular->tags as $row)
                    <li>
                        <a href="{{route('backend.tags.show', $row->id)}}">{{$row->name}}</a>
                    </li>
                    @endforeach
                </ul>
                <hr>

                <h4>Comments</h4>
                <ul>
                    @foreach($$module_name_singular->comments as $row)
                    <li>
                        <a href="{{route('backend.comments.show', $row->id)}}">{{$row->name}}</a> by {{$row->user_name}}
                    </li>
                    @endforeach
                </ul>
                <hr>

                @include('backend.posts.includes.activitylog')
                <hr>

            </div>
        </div>
    </div>

    <div class="card-footer">
        <div class="row">
            <div class="col">
                <small class="float-end text-muted">
                    Updated: {{$$module_name_singular->updated_at->diffForHumans()}},
                    Created at: {{$$module_name_singular->created_at->isoFormat('LLLL')}}
                </small>
            </div>
        </div>
    </div>
</div>


    <!-- Modal Content -->
    <div class="modal fade" id="modal-achievement" tabindex="-1" role="dialog" aria-labelledby="modal-achievement" aria-hidden="true">
        <div class="modal-dialog modal-tertiary modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close theme-settings-close fs-6 ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-header mx-auto">
                    <p class="lead mb-0 text-white">Lucky Draw</p>
                </div>
                <div class="modal-body pt-0">
                    <div class="py-3 px-5 text-center">
                                                        <span class="modal-icon display-1 text-white">
                                                            <svg class="icon icon-lg text-gray-200" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"></path></svg>
                                                        </span>
                        <h2 class="h3 modal-title mb-3 text-white">Lucky Draw for 5 Winners!</h2>
                        <p class="mb-4 text-white">Experience the thrill of our Lucky Spin! Spin the wheel for a chance to win incredible prizes. 5 lucky winners will be chosen. Don't miss out!</p>
                        <div class="progress mb-0">
                            <div class="progress-bar bg-secondary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center pt-0 pb-3">
                    <button type="button" id="btnStartLuckyDraw" class="btn btn-sm btn-white text-tertiary" data-bs-dismiss="modal2">Start Prize Draw!</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Modal Content -->
    <audio src="https://res.cloudinary.com/dfeqcehdw/video/upload/v1637553319/wow.mp3"></audio>
@endsection


@push('after-styles')
    <!-- File Manager -->
       <style>

    </style>
@endpush

@push ('after-scripts')
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.8.0/dist/confetti.browser.min.js"></script>

    <script>
        const audio = document.querySelector("audio");
        audio.volume = 0.2;

        audio.play();

        /*Auto redirect to homepage after 3 minute*/
        setTimeout(function () {
            window.location.href = "{{route('backend.home')}}";
        }, 180000);
    </script>

    <script type="text/javascript">
        var _token = $('meta[name="csrf-token"]').attr('content');
        var spinText = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ';
        var fileAvatarInit = null;
        var flag_check = 1;

        jQuery(document).ready(function ($) {
            //listPrizeWin
            var listPrizeWin = $('#listPrizeWin');
            var btnStartLuckyDraw = $('#btnStartLuckyDraw');

            listPrizeWin.hide();
            //Btn btnStartLuckyDraw Click Function
            btnStartLuckyDraw.click(function () {
                $(this).html(spinText + 'Processing...').attr('disabled', true);
                setTimeout(function () {
                    $('#btnStartLuckyDraw').html('Start Prize Draw!').attr('disabled', false);
                    $('#modal-achievement').modal('hide');
                    $('#modal-achievement-result').modal('show');
                    showSuccessScreen();
                    //listPrizeWin show
                    listPrizeWin.show();
                }, 2000);
            });

            function showSuccessScreen(){
                var defaults = {
                    spread: 360,
                    ticks: 50,
                    gravity: 0,
                    decay: 0.94,
                    startVelocity: 30,
                    colors: ['FFE400', 'FFBD00', 'E89400', 'FFCA6C', 'FDFFB8']
                };

                function shoot() {
                    confetti({
                        ...defaults,
                        particleCount: 40,
                        scalar: 1.2,
                        shapes: ['star']
                    });

                    confetti({
                        ...defaults,
                        particleCount: 10,
                        scalar: 0.75,
                        shapes: ['circle']
                    });
                }

                setTimeout(shoot, 0);
                setTimeout(shoot, 100);
                setTimeout(shoot, 200);
            }
        });

    </script>

@endpush

