<title>Volt Laravel Dashboard - Category Management</title>
<div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                    <li class="breadcrumb-item">
                        <a href="#">
                            <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                        </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Category Management</li>
                </ol>
            </nav>
            <h2 class="h4">Category Management</h2>
            <p class="mb-0">Your category management dashboard template.</p>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{route('new-category')}}" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center"><svg
                    class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg> New category</a>
            <div class="btn-group ms-2 ms-lg-3">
                <button type="button" class="btn btn-sm btn-outline-gray-600">@lang('Share')</button>
                <button type="button" class="btn btn-sm btn-outline-gray-600">@lang('Export')</button>
            </div>
        </div>
    </div>
    <div class="card card-body shadow-sm table-wrapper table-responsive">
        <div class="table-settings mb-4">
            <div class="row justify-content-between align-items-center">
                <div class="col-6 col-lg-4 d-flex">
                    <div class="input-group me-2 me-lg-3">
                            <span class="input-group-text"><svg class="icon icon-xs"
                                                                x-description="Heroicon name: solid/search" xmlns="http://www.w3.org/2000/svg"
                                                                viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                          d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                          clip-rule="evenodd"></path>
                                </svg></span></span>
                        <input wire:model="search" type="text" class="form-control" placeholder="Search categories">
                    </div>
                    <div class="col-2 d-flex">
                        <select wire:model="entries" class="form-select mb-0" id="entries"
                                aria-label="Entries per page">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <table class="table user-table table-hover align-items-center" style="overflow-x: clip">
            <thead>
            <tr>

                <th class="border-bottom">
                    <a wire:click="sortBy('name')" class="text-default me-3">
                        <span>Name</span>

                        <span>
                                    <i class="fas fa-sort-up"></i>
                            </span>
                    </a>
                </th>
                <th class="border-bottom">
                    <a wire:click="sortBy('description')" class="text-default me-3">
                        <span>Description</span>

                        <span>
                                    <i class="fas fa-sort"></i>
                            </span>
                    </a>
                </th>
                <th class="border-bottom">
                    <a wire:click="sortBy('created_at')" class="text-default me-3">
                        <span>Date created</span>

                        <span>
                                    <i class="fas fa-sort"></i>
                            </span>
                    </a>
                </th>
                <th class="border-bottom">
                    <a class="text-default me-3"> @lang('Actions')</a>
                </th>

            </tr>
            </thead>


            <tbody>
            <tr>
                <td>
                    <span>Fashion</span>
                </td>                        <td>
                    <span>Stay in touch with the latest trends</span>
                </td>                        <td>
                    <span>22 Mar 2023</span>
                </td>                                                <td>
    <span><div class="btn-group">
    <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path></svg>
        <span class="visually-hidden">Toggle Dropdown</span>
    </button>
    <div class="dropdown-menu dashboard-dropdown dropdown-menu-start mt-2 py-1">
        <a class="dropdown-item rounded-top"
           href="edit-category/1"><span
                class="fas fa-user-shield me-2"></span>Edit category</a>
                                                                                                <a onclick="confirm('Are you sure you want to remove this category?') || event.stopImmediatePropagation()"
                                                                                                   wire:click="delete(1)"
                                                                                                   class="dropdown-item text-danger rounded-bottom"><span
                                                                                                        class="fas fa-user-times me-2"></span>Delete category</a>
    </div>
</div></span>
                </td>
            </tr>                                        <tr>
                <td>
                    <span>Food</span>
                </td>                        <td>
                    <span>Our favourite recipes</span>
                </td>                        <td>
                    <span>22 Mar 2023</span>
                </td>                                                <td>
    <span><div class="btn-group">
    <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path></svg>
        <span class="visually-hidden">Toggle Dropdown</span>
    </button>
    <div class="dropdown-menu dashboard-dropdown dropdown-menu-start mt-2 py-1">
        <a class="dropdown-item rounded-top"
           href="edit-category/2"><span
                class="fas fa-user-shield me-2"></span>Edit category</a>
                                                                                                <a onclick="confirm('Are you sure you want to remove this category?') || event.stopImmediatePropagation()"
                                                                                                   wire:click="delete(2)"
                                                                                                   class="dropdown-item text-danger rounded-bottom"><span
                                                                                                        class="fas fa-user-times me-2"></span>Delete category</a>
    </div>
</div></span>
                </td>
            </tr>                                        <tr>
                <td>
                    <span>Health</span>
                </td>                        <td>
                    <span>An apple a day keeps the doctor away</span>
                </td>                        <td>
                    <span>22 Mar 2023</span>
                </td>                                                <td>
    <span><div class="btn-group">
    <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path></svg>
        <span class="visually-hidden">Toggle Dropdown</span>
    </button>
    <div class="dropdown-menu dashboard-dropdown dropdown-menu-start mt-2 py-1">
        <a class="dropdown-item rounded-top"
           href="edit-category/3"><span
                class="fas fa-user-shield me-2"></span>Edit category</a>
                                                                                                <a onclick="confirm('Are you sure you want to remove this category?') || event.stopImmediatePropagation()"
                                                                                                   wire:click="delete(3)"
                                                                                                   class="dropdown-item text-danger rounded-bottom"><span
                                                                                                        class="fas fa-user-times me-2"></span>Delete category</a>
    </div>
</div></span>
                </td>
            </tr>                                        <tr>
                <td>
                    <span>Home</span>
                </td>                        <td>
                    <span>The latest trends in home decorations</span>
                </td>                        <td>
                    <span>22 Mar 2023</span>
                </td>                                                <td>
    <span><div class="btn-group">
    <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path></svg>
        <span class="visually-hidden">Toggle Dropdown</span>
    </button>
    <div class="dropdown-menu dashboard-dropdown dropdown-menu-start mt-2 py-1">
        <a class="dropdown-item rounded-top"
           href="edit-category/4"><span
                class="fas fa-user-shield me-2"></span>Edit category</a>
                                                                                                <a onclick="confirm('Are you sure you want to remove this category?') || event.stopImmediatePropagation()"
                                                                                                   wire:click="delete(4)"
                                                                                                   class="dropdown-item text-danger rounded-bottom"><span
                                                                                                        class="fas fa-user-times me-2"></span>Delete category</a>
    </div>
</div></span>
                </td>
            </tr>                                        <tr>
                <td>
                    <span>Travel</span>
                </td>                        <td>
                    <span>Travel ideas for everyone</span>
                </td>                        <td>
                    <span>22 Mar 2023</span>
                </td>                                                <td>
    <span><div class="btn-group">
    <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path></svg>
        <span class="visually-hidden">Toggle Dropdown</span>
    </button>
    <div class="dropdown-menu dashboard-dropdown dropdown-menu-start mt-2 py-1">
        <a class="dropdown-item rounded-top"
           href="edit-category/5"><span
                class="fas fa-user-shield me-2"></span>Edit category</a>
                                                                                                <a onclick="confirm('Are you sure you want to remove this category?') || event.stopImmediatePropagation()"
                                                                                                   wire:click="delete(5)"
                                                                                                   class="dropdown-item text-danger rounded-bottom"><span
                                                                                                        class="fas fa-user-times me-2"></span>Delete category</a>
    </div>
</div></span>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="mt-3">
            <div>
            </div>

        </div>
    </div>
</div>
</div>
