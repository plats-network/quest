<div class="list-group list-group-flush" role="tablist">
    <a class="list-group-item list-group-item-action {{ request()->is('sale/setting*') ? 'active' : '' }}"
       href="{{route('admin.craterSetting')}}">
        <i class="align-middle" data-feather="user"></i> Account Settings
    </a>
    <a class="list-group-item list-group-item-action" href="">
        <i class="align-middle" data-feather="home"></i> Company Information
    </a>
    <a class="list-group-item list-group-item-action" href="{{route('admin.homeAdmin')}}">
        <i class="align-middle" data-feather="settings"></i> Prerefence
    </a>
    <a class="list-group-item list-group-item-action" href="{{route('admin.homeAdmin')}}">
        <i class="align-middle" data-feather="edit"></i> Customization
    </a>
    <a class="list-group-item list-group-item-action" href="{{route('admin.homeAdmin')}}">
        <i class="align-middle" data-feather="bell"></i> Notifications
    </a>
    <a class="list-group-item list-group-item-action" href="{{route('admin.homeAdmin')}}">
        <i class="align-middle" data-feather="check"></i> Fax Types
    </a>
    <a class="list-group-item list-group-item-action" href="{{route('admin.homeAdmin')}}">
        <i class="align-middle" data-feather="credit-card"></i> Payment Model
    </a>
    <a class="list-group-item list-group-item-action" href="{{route('admin.homeAdmin')}}">
        <i class="align-middle" data-feather="box"></i> Custom field
    </a>
    <a class="list-group-item list-group-item-action" href="{{route('admin.homeAdmin')}}">
        <i class="align-middle" data-feather="edit-3"></i> Notes
    </a>
    <a class="list-group-item list-group-item-action {{ request()->is('sale/categories*') ? 'active' : '' }}"
       href="{{route('admin.categories.index')}}">
        <i class="align-middle" data-feather="settings"></i> Expense Categories
    </a>
    <a class="list-group-item list-group-item-action {{ request()->is('sale/mail*') ? 'active' : '' }}"
       href="{{route('admin.mailConfig')}}">
        <i class="align-middle" data-feather="mail"></i> Mail Configuration
    </a>
    <a class="list-group-item list-group-item-action" href="{{route('admin.homeAdmin')}}">
        <i class="align-middle" data-feather="settings"></i> File Disk
    </a>
    <a class="list-group-item list-group-item-action" href="{{route('admin.homeAdmin')}}">
        <i class="align-middle" data-feather="settings"></i> Backup
    </a>
</div>
