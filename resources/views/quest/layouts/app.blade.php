<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="white">

<head>
    <meta charset="utf-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>@yield('title') | {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ setting('meta_description') }}">
    <meta name="keyword" content="{{ setting('meta_keyword') }}">

    @include('quest.includes.meta')

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="120x120" href="/img/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/img/favicon_io/favicon/site.webmanifest">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        #scrollUp {
            bottom: 80px;
            right: 20px;
            height: 38px;
            width: 38px;
            background: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACYAAAAmCAYAAACoPemuAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyRpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoTWFjaW50b3NoKSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDo1N0RENUJFNTk4QkExMUUyOUI2NkUxNzQyMUQ5RDM3RCIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDo1N0RENUJFNjk4QkExMUUyOUI2NkUxNzQyMUQ5RDM3RCI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjU3REQ1QkUzOThCQTExRTI5QjY2RTE3NDIxRDlEMzdEIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjU3REQ1QkU0OThCQTExRTI5QjY2RTE3NDIxRDlEMzdEIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+uCzm/wAAA0dJREFUeNrMmD1MU1EUx08/CKSxkkjSDrRDQ5Wk6QeJQ2PZQOJinHQwOmjasGiiQxdAJktDBxNNXDSBaNS1GBcWXbUflkYMpbhAYthQbBQCgbae8zivVj7fu+9RepJ/0r7envPLPffde88xDAwMgID5UP2oEOocyok6xb/9QX1HfUN9RH1AfVUbwKxiLAUeRIVRnkPGnWEFUNf4WQE1gXrO4EeaUSH8PdQS6tERUAeZh/+7xL7MWsHOolKox6gO0G4d7CvFvoXALqM+o86D/kY+cxxDFdgN1BTqNByfWTnGTaVgV1AvVb4YokYxXnDMQ8G6Ua9RJmicmThm90FgRP+Gp7jRZuXY5v3A7hzTQlfzQtzdDUab5yicvD2QTxAZbFCnfUqPfW6wHiwMzWNhGcwveMz8Z4FAAEZGRsBs1rzLEIufvPTpARWLxaC1tRXK5TIkEgmoVqtaXPaburq67uMHr6gHv98PY2NjEhSZy+UCi8UCuVxOC1iJwOhttAtdynw+iMfjNahaLjwe2NjYgEKhIApWpjXWqSeUbJFIBPr6hFdJp1Fkp98Pam5uDpLJZO27wWCAaDQKwWBQ6CSQU2lSA0Vrqq2trfaMUkZvZCqVApvNBm63e2f3Nhqht7cX8vk8rKysqEqlvPgtSkZ7vV5ppnZDDQ8Pw/r6uvQ9nU4D+gSn07lzAOP2EQqFIJPJQKlUUgr2i1K5rHQ0peYwKLJKpSLB1y/89vZ2GBoaUjNjywRWVDq6paVlT/rqoWTb3NyUfltcXKw9czgcasCKlEqa80uKRheLYLfbpYU+Pj4Oa2trB47d2tqS1lxPTw9YrVaYnp6GbDarFGzCgHUlHUlfoLksQKmc5bqvWYxYZuXbxWQTgU3WX3ueoX40AdRPZqmBUdkeawKwh3ILof7O/5SL0JOyPDPsKUa2udD9fQJQNEvXmWHfunKBK+NyA6HKPCELR1Xi71C3GgRHMW5zTEW9C6qMryrtZWlIH/XPXqnt9rzlInTmGKBm2PeUaH+M2pV006Or0aoOQKvsK8i+QRRMflufUJ1BNx/UvADQPP/Xxb62lbSBFFcusNOuJFFz+CLqAvxrDstXdNpu5ObwJ9R7EGgO/xVgAApa34qsLbcEAAAAAElFTkSuQmCC') no-repeat;
        }
        .text-red-400 {
            color: #f56565;
        }
    </style>
    @stack('before-styles')

    @vite(['resources/css/app-frontend.css'])
    @vite(['resources/js/app-frontend.js'])

    {{--Flowbite--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
    @stack('after-styles')

    {{--Check env production--}}
    @if(config('app.env') == 'production')
    <x-google-analytics />
    @endif
</head>

<body>

    @include('quest.includes.header')


    <main>
        @yield('content')
    </main>

    @include('quest.includes.footer')

</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Moment JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>
<script src="https://bootstraptoaster.peytongasink.dev/js/bootstrap-toaster.js"></script>

<script src="{{ asset('assets/yii2-assets/yii.js') }}"></script>
<script src="{{ asset('assets/yii2-assets/yii.gridView.js') }}"></script>
<script src="{{ asset('assets/yii2-assets/yii.activeForm.js') }}"></script>
<script src="{{ asset('assets/yii2-assets/yii.validation.js') }}"></script>

<script src="{{asset('plugins/scrollup/jquery.scrollUp.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://shuffle.dev/vendor/tailwind-flex/js/charts-demo.js"></script>
<script src="{{asset('plugins/scrollup/jquery.scrollUp.min.js')}}"></script>
<script>
    jQuery(document).ready(function ($) {
        $(function () {
            $.scrollUp({
                scrollName: 'scrollUp', // Element ID
                scrollDistance: 140, // Distance from top/bottom before showing element (px)
                scrollFrom: 'top', // 'top' or 'bottom'
                scrollSpeed: 300, // Speed back to top (ms)
                easingType: 'linear', // Scroll to top easing (see https://easings.net/)
                animation: 'fade', // Fade, slide, none
                animationInSpeed: 200, // Animation in speed (ms)
                animationOutSpeed: 200, // Animation out speed (ms)
                scrollText: 'Scroll to top', // Text for element, can contain HTML
                scrollTitle: 'Scroll to top', // Set a custom <a> title if required. Defaults to scrollText
                scrollImg: true, // Set true to use image
                activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
                zIndex: 2147483647 // Z-Index for the overlay
            });
        });
    });

    //Messaging
    /**
     *
     * @param chat
     */
    function addMessage(chat) {
        //console.log(122)
        Toast.setPlacement(TOAST_PLACEMENT.BOTTOM_RIGHT);
        let toast = {
            title: "Thông báo",
            message: chat.msg,
            status: TOAST_STATUS.WARNING,
            timeout: timeout
        }
        Toast.create(toast);
    }

    /**
     *
     * @param chat
     */
    function addInfoMsg(msg) {
        //console.log(122)
        Toast.setPlacement(TOAST_PLACEMENT.BOTTOM_RIGHT);
        let toast = {
            title: "Thông báo",
            message: msg,
            status: TOAST_STATUS.WARNING,
            timeout: timeout
        }
        Toast.create(toast);
    }
</script>
<!-- Scripts -->
@stack('before-scripts')


@stack('after-scripts')

</html>
