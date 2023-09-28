<ul class="sidebar-nav">
    <li class="sidebar-header">
        Catalogs
    </li>

    <li class="sidebar-item {{ request()->is('sale/dashboard*') ? 'active' : '' }}">
        <a class="sidebar-link" href="{{route('admin.saleDashboaard')}}">
            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
        </a>
    </li>

    <li class="sidebar-item {{ request()->is('sale/items*') ? 'active' : '' }}">
        <a class="sidebar-link" href="{{route('admin.items.index')}}">
            <i class="align-middle" data-feather="list"></i> <span
                class="align-middle">{{__('crater.navigation.items')}}</span>
        </a>
    </li>


    <li class="sidebar-item  {{ request()->is('sale/customers*') ? 'active' : '' }}">
        <a class="sidebar-link" href="{{route('admin.customers.index')}}">
            <i class="align-middle" data-feather="user-plus"></i> <span
                class="align-middle">{{__('crater.navigation.customers')}}</span>
        </a>
    </li>

    <li class="sidebar-item">
        <a class="sidebar-link" href="{{route('admin.customers.index')}}">
            <i class="align-middle" data-feather="book"></i> <span
                class="align-middle">{{__('crater.navigation.companies')}}</span>
        </a>
    </li>

    <li class="sidebar-header">
        Invoices
    </li>

    <li class="sidebar-item {{ request()->is('sale/invoices*') ? 'active' : '' }}">
        <a class="sidebar-link" href="{{route('admin.invoices.index')}}">
            <i class="align-middle" data-feather="file-text"></i> <span
                class="align-middle">{{__('crater.navigation.invoices')}}</span>
        </a>
    </li>
    <li class="sidebar-item {{ request()->is('sale/payments*') ? 'active' : '' }}">
        <a class="sidebar-link" href="{{route('admin.payments.index')}}">
            <i class="align-middle" data-feather="credit-card"></i> <span
                class="align-middle">{{__('crater.navigation.payments')}}</span>
        </a>
    </li>


    <li class="sidebar-header">
        Settings
    </li>

    <li class="sidebar-item {{ request()->is('sale/users*') ? 'active' : '' }}">
        <a class="sidebar-link" href="{{route('admin.users.index')}}">
            <i class="align-middle" data-feather="user"></i> <span
                class="align-middle">{{__('crater.navigation.users')}}</span>
        </a>
    </li>

    <li class="sidebar-item">
        <a class="sidebar-link" href="{{route('admin.invoices.index')}}">
            <i class="align-middle" data-feather="map"></i> <span
                class="align-middle">{{__('crater.navigation.reports')}}</span>
        </a>
    </li>
    <li class="sidebar-item {{ request()->is('sale/settings*') ? 'active' : '' }}">
        <a class="sidebar-link" href="{{route('admin.craterSetting')}}">
            <i class="align-middle" data-feather="grid"></i> <span
                class="align-middle">{{__('crater.navigation.settings')}}</span>
        </a>
    </li>
</ul>
