<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{asset_cdn('adminkit/dist/img/icons/icon-48x48.png')}}"/>

    <title>Invoice</title>

    <link href="{{asset_cdn('adminkit/dist/css/app.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    @yield('style')
</head>

<body>
<div class="wrapper">
    <nav id="sidebar" class="sidebar js-sidebar">
        <div class="sidebar-content js-simplebar">
            <a class="sidebar-brand" href="{{route('admin.saleDashboaard')}}">
                <span class="align-middle">Invoice</span>
            </a>

            @include('admin.crater.layouts.partials._menu')

            <div class="sidebar-cta">
                <div class="sidebar-cta-content">
                    <strong class="d-inline-block mb-2">Cập nhật bản Pro</strong>
                    <div class="mb-3 text-sm">
                        Are you looking for more components? Check out our premium version.
                    </div>
                    <div class="d-grid">
                        <a href="" class="btn btn-primary">Cập nhật bản Pro</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="main">
        <nav class="navbar navbar-expand navbar-light navbar-bg">
            <a class="sidebar-toggle js-sidebar-toggle">
                <i class="hamburger align-self-center"></i>
            </a>

            <div class="navbar-collapse collapse">
                <ul class="navbar-nav navbar-align">
                    <li class="nav-item dropdown">
                        <a class="nav-icon dropdown-toggle" href="{{route('admin.homeAdmin')}}" id="alertsDropdown" data-bs-toggle="dropdown">
                            <div class="position-relative">
                                <i class="align-middle" data-feather="bell"></i>
                                <span class="indicator">4</span>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0"
                             aria-labelledby="alertsDropdown">
                            <div class="dropdown-menu-header">
                                4 New Notifications
                            </div>
                            <div class="list-group">
                                <a href="{{route('admin.homeAdmin')}}" class="list-group-item">
                                    <div class="row g-0 align-items-center">
                                        <div class="col-2">
                                            <i class="text-danger" data-feather="alert-circle"></i>
                                        </div>
                                        <div class="col-10">
                                            <div class="text-dark">Update completed</div>
                                            <div class="text-muted small mt-1">Restart server 12 to complete the
                                                update.
                                            </div>
                                            <div class="text-muted small mt-1">30m ago</div>
                                        </div>
                                    </div>
                                </a>
                                <a href="{{route('admin.homeAdmin')}}" class="list-group-item">
                                    <div class="row g-0 align-items-center">
                                        <div class="col-2">
                                            <i class="text-warning" data-feather="bell"></i>
                                        </div>
                                        <div class="col-10">
                                            <div class="text-dark">Lorem ipsum</div>
                                            <div class="text-muted small mt-1">Aliquam ex eros, imperdiet vulputate
                                                hendrerit et.
                                            </div>
                                            <div class="text-muted small mt-1">2h ago</div>
                                        </div>
                                    </div>
                                </a>
                                <a href="{{route('admin.homeAdmin')}}" class="list-group-item">
                                    <div class="row g-0 align-items-center">
                                        <div class="col-2">
                                            <i class="text-primary" data-feather="home"></i>
                                        </div>
                                        <div class="col-10">
                                            <div class="text-dark">Login from 192.186.1.8</div>
                                            <div class="text-muted small mt-1">5h ago</div>
                                        </div>
                                    </div>
                                </a>
                                <a href="{{route('admin.homeAdmin')}}" class="list-group-item">
                                    <div class="row g-0 align-items-center">
                                        <div class="col-2">
                                            <i class="text-success" data-feather="user-plus"></i>
                                        </div>
                                        <div class="col-10">
                                            <div class="text-dark">New connection</div>
                                            <div class="text-muted small mt-1">Christina accepted your request.</div>
                                            <div class="text-muted small mt-1">14h ago</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="dropdown-menu-footer">
                                <a href="{{route('admin.homeAdmin')}}" class="text-muted">Show all Thông báo</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-icon dropdown-toggle" href="{{route('admin.homeAdmin')}}" id="messagesDropdown" data-bs-toggle="dropdown">
                            <div class="position-relative">
                                <i class="align-middle" data-feather="message-square"></i>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0"
                             aria-labelledby="messagesDropdown">
                            <div class="dropdown-menu-header">
                                <div class="position-relative">
                                    4 New Messages
                                </div>
                            </div>
                            <div class="list-group">
                                <a href="{{route('admin.homeAdmin')}}" class="list-group-item">
                                    <div class="row g-0 align-items-center">
                                        <div class="col-2">
                                            <img  src="{{asset_cdn('adminkit/dist/img/avatars/avatar-5.jpg')}}"
                                                 class="avatar lazyload img-fluid rounded-circle" alt="Vanessa Tucker">
                                        </div>
                                        <div class="col-10 ps-2">
                                            <div class="text-dark">Vanessa Tucker</div>
                                            <div class="text-muted small mt-1">Nam pretium turpis et arcu. Duis arcu
                                                tortor.
                                            </div>
                                            <div class="text-muted small mt-1">15m ago</div>
                                        </div>
                                    </div>
                                </a>
                                <a href="{{route('admin.homeAdmin')}}" class="list-group-item">
                                    <div class="row g-0 align-items-center">
                                        <div class="col-2">
                                            <img  src="{{asset_cdn('adminkit/dist/img/avatars/avatar-2.jpg')}}"
                                                 class="avatar lazyload img-fluid rounded-circle" alt="William Harris">
                                        </div>
                                        <div class="col-10 ps-2">
                                            <div class="text-dark">William Harris</div>
                                            <div class="text-muted small mt-1">Curabitur ligula sapien euismod vitae.
                                            </div>
                                            <div class="text-muted small mt-1">2h ago</div>
                                        </div>
                                    </div>
                                </a>
                                <a href="{{route('admin.homeAdmin')}}" class="list-group-item">
                                    <div class="row g-0 align-items-center">
                                        <div class="col-2">
                                            <img  src="{{asset_cdn('adminkit/dist/img/avatars/avatar-4.jpg')}}"
                                                 class="avatar lazyload img-fluid rounded-circle" alt="Christina Mason">
                                        </div>
                                        <div class="col-10 ps-2">
                                            <div class="text-dark">Christina Mason</div>
                                            <div class="text-muted small mt-1">Pellentesque auctor neque nec urna.</div>
                                            <div class="text-muted small mt-1">4h ago</div>
                                        </div>
                                    </div>
                                </a>
                                <a href="{{route('admin.homeAdmin')}}" class="list-group-item">
                                    <div class="row g-0 align-items-center">
                                        <div class="col-2">
                                            <img  src="{{asset_cdn('adminkit/dist/img/avatars/avatar-3.jpg')}}"
                                                 class="avatar  lazyload img-fluid rounded-circle" alt="Sharon Lessman">
                                        </div>
                                        <div class="col-10 ps-2">
                                            <div class="text-dark">Sharon Lessman</div>
                                            <div class="text-muted small mt-1">Aenean tellus metus, bibendum sed,
                                                posuere ac, mattis non.
                                            </div>
                                            <div class="text-muted small mt-1">5h ago</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="dropdown-menu-footer">
                                <a href="{{route('admin.homeAdmin')}}" class="text-muted">Show all messages</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="{{route('admin.homeAdmin')}}" data-bs-toggle="dropdown">
                            <i class="align-middle" data-feather="settings"></i>
                        </a>

                        <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="{{route('admin.homeAdmin')}}" data-bs-toggle="dropdown">
                            <img  src="{{asset_cdn('adminkit/dist/img/avatars/avatar.jpg')}}"
                                 class="avatar img-fluid rounded me-1" alt="{{Auth::user()->name}}"/> <span
                                class="text-dark">{{Auth::user()->name}}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href=""><i class="align-middle me-1" data-feather="user"></i>
                                Profile</a>
                            <a class="dropdown-item" href="{{route('admin.homeAdmin')}}"><i class="align-middle me-1" data-feather="pie-chart"></i>
                                Analytics</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{route('admin.craterSetting')}}"><i
                                    class="align-middle me-1" data-feather="settings"></i> Settings & Privacy</a>
                            <a class="dropdown-item" href="{{route('admin.homeAdmin')}}"><i class="align-middle me-1"
                                                                 data-feather="help-circle"></i> Help Center</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{route('admin.homeAdmin')}}">{{__('crater.navigation.logout')}}</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="content">
            @if(session()->get('success') or session()->get('warning'))
                <div class="container-fluid p-0">
                    <div class="row">
                        <div class="col-sm-12">
                            <div
                                class="alert alert-{{session()->get('success') ? 'primary':'warning'}} alert-dismissible"
                                role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                <div class="alert-message">
                                    {{ session()->get('success')? session()->get('success') :session()->get('warning') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @yield('content')

        </main>

        <footer class="footer">
            <div class="container-fluid">
                <div class="row text-muted">
                    <div class="col-6 text-start">
                        <p class="mb-0">
                            <a class="text-muted" href="https://adminkit.io/"
                               target="_blank"><strong>Invoice</strong></a> &copy;
                        </p>
                    </div>
                    <div class="col-6 text-end">
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a class="text-muted" href="https://adminkit.io/" target="_blank"> Hỗ trợ</a>
                            </li>
                            <li class="list-inline-item">
                                <a class="text-muted" href="https://adminkit.io/" target="_blank">Help Center</a>
                            </li>
                            <li class="list-inline-item">
                                <a class="text-muted" href="https://adminkit.io/" target="_blank">Privacy</a>
                            </li>
                            <li class="list-inline-item">
                                <a class="text-muted" href="https://adminkit.io/" target="_blank">Terms</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://js.pusher.com/7.2.0/pusher.min.js"></script>

<script src="{{asset_cdn('adminkit/dist/js/app.js')}}"></script>

@yield('script')
</body>

</html>
