<title>Volt Laravel Dashboard - New User</title>
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
                    <li class="breadcrumb-item active" aria-current="page">Add user</li>
                </ol>
            </nav>
            <h2 class="h4">Add user</h2>
            <p class="mb-0">Your user creation template.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-xl-8">
            <div class="card card-body shadow-sm mb-4">
                <h2 class="h5 mb-4">General information</h2>
                <form wire:submit.prevent="add" action="#" method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="first_name">First Name</label>
                                <input wire:model="first_name"
                                       class="form-control " id="first_name"
                                       type="text" placeholder="Enter your first name" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="last_name">Last Name</label>
                                <input wire:model="last_name"
                                       class="form-control " id="last_name"
                                       type="text" placeholder="Also your last name" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input wire:model="email" class="form-control "
                                       id="email" type="email" placeholder="name@company.com">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input wire:model="phone" class="form-control" id="phone" type="text"
                                       placeholder="+12-345 678 910">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="status">Status</label>
                            <select wire:model="status" class="form-select mb-0 " id="status"
                                    aria-label="status select example">
                                <option selected>Choose</option>
                                <option value="Active">Active</option>
                                <option value="Pending">Pending</option>
                                <option value="Suspended">Suspended</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="role">Role</label>
                            <select wire:model="role_id" class="form-select mb-0 "
                                    id="role" aria-label="role select example">
                                <option selected>Choose...</option>
                                <option value="1">Admin</option>
                                <option value="2">Creator</option>
                                <option value="3">Member</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group mb-4">
                            <label for="password">New Password</label>
                            <div class="input-group">
                                    <span class="input-group-text" id="basic-addon4"><span
                                            class="fas fa-unlock-alt"></span></span>
                                <input wire:model.lazy="password" type="password" placeholder="Password"
                                       class="form-control " id="password">
                            </div>
                        </div>
                        <div class="col-md-6 form-group mb-4">
                            <label for="confirm_password">Confirm Password</label>
                            <div class="input-group">
                                    <span class="input-group-text" id="basic-addon5"><span
                                            class="fas fa-unlock-alt"></span></span>
                                <input wire:model.lazy="passwordConfirmation" type="password"
                                       placeholder="Confirm Password" class="form-control" id="confirm_password">
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-gray-800 mt-2 animate-up-2">Save All</button>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col-6">

                </div>
            </div>
        </div>
        <div class="col-12 col-xl-4">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="card shadow border-0 text-center p-0">
                        <div wire:ignore.self class="profile-cover rounded-top"
                             data-background="../assets/img/profile-cover.jpg"></div>
                        <div class="card-body pb-5">
                            <img src="/assets/img/team/profile-picture-5.jpg"
                                 class="avatar-xl rounded-circle mx-auto mt-n7 mb-4" alt="Neil Portrait">
                            <h4 class="h3">
                                User Name</h4>
                            <h5 class="fw-normal">Senior Software Engineer</h5>
                            <p class="text-gray mb-4">City, Country</p>
                            <a class="btn btn-sm btn-gray-800 d-inline-flex align-items-center me-2" href="#">
                                <svg class="icon icon-xs me-1" fill="currentColor" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z">
                                    </path>
                                </svg>
                                Connect
                            </a>
                            <a class="btn btn-sm btn-secondary" href="#">Send Message</a>
                        </div>
                    </div>
                    <div class="card card-body border-0 shadow mb-4 mt-4">
                        <h2 class="h5 mb-4">Select profile photo</h2>
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <!-- Avatar -->
                                <div class="user-avatar xl-avatar">
                                    <img class="rounded avatar-xl" src="/assets/img/team/profile-picture-5.jpg"
                                         alt="Profile Photo">
                                </div>
                            </div>
                            <div class="file-field">
                                <div class="d-flex justify-content-xl-center ms-xl-3">
                                    <div class="d-flex">
                                            <span class="icon icon-md"><svg class="icon text-gray-500 me-2"
                                                                            fill="currentColor" viewBox="0 0 20 20"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                          d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                                                          clip-rule="evenodd"></path>
                                                </svg>
                                            </span>
                                        <input wire:model='upload' type="file" accept="image/*">
                                        <div class="d-md-block text-left">
                                            <div class="fw-normal text-dark mb-1">Choose Image</div>
                                            <div class="text-gray small">JPG, GIF or PNG. Max size of 2MB
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
