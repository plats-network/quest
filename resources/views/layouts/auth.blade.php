<x-layouts.base>

    @if(in_array(request()->route()->getName(), ['dashboard', 'profile', 'profile-example', 'users', 'bootstrap-tables', 'transactions',
    'buttons',
    'forms', 'modals', 'notifications', 'typography', 'upgrade-to-pro']))

        {{-- Nav --}}
        @include('layouts.nav')
        {{-- SideNav --}}
        @include('layouts.sidenav')
        <main class="content">
            {{-- TopBar --}}
            @include('layouts.topbar')
            {{ $slot }}
            {{-- Footer --}}
            @include('layouts.footer')
        </main>

    @elseif(in_array(request()->route()->getName(), ['register', 'register-example', 'login', 'loginAdmin', 'login-example',
    'forgot-password', 'forgot-password-example', 'admin.loginAdmin', 'reset-password','reset-password-example', 'admin.login', 'admin.register', 'admin.forgot-password', 'admin.reset-password']))

        {{ $slot }}
        {{-- Footer --}}
        @include('layouts.footer2')


    @elseif(in_array(request()->route()->getName(), ['admin.404', 'admin.500', 'admin.lock']))

        {{ $slot }}

    @endif
</x-layouts.base>
