<x-layouts.base>


    @if(true)

        {{-- Nav --}}
        @include('layouts.nav')
        {{-- SideNav --}}
        @include('layouts.sidenavPost')
        <main class="content">
            {{-- TopBar --}}
            @include('layouts.topbarBackend')

            @yield('content')
            {{ $slot }}

            {{-- Footer --}}
            @include('layouts.footer')
        </main>

    @elseif(in_array(request()->route()->getName(), ['register', 'register-example', 'login', 'login-example',
    'forgot-password', 'forgot-password-example', 'reset-password','reset-password-example']))

        {{ $slot }}
        {{-- Footer --}}
        @include('layouts.footer2')

    @elseif(in_array(request()->route()->getName(), ['404', '500', 'lock']))

        {{ $slot }}

    @endif
</x-layouts.base>
