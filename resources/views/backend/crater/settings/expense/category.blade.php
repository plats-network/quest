@extends('admin.layouts.horizontal')
@section("pageTitle","Settings")

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Thiết lập</h1>

        <div class="row">
            <div class="col-md-4 col-xl-3">

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Profile Settings</h5>
                    </div>

                    @include('admin.crater.settings.partials._menuSetting')
                </div>
            </div>

            <div class="col-md-8 col-xl-9">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="account" role="tabpanel">

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Expense Categories</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-end bd-highlight mb-3">
                                    <div class="p-2 bd-highlight">
                                        <button class="btn btn-primary">Add new Category</button>
                                    </div>
                                </div>
                                <table class="table">
                                    <thead class="thead-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">Mô tả</th>
                                        <th colspan="2" scope="col">Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categories as $category)
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>{{$category->name}}</td>
                                            <td>{{$category->description}}</td>
                                            <td><a href="{{route('admin.categories.edit', ['category' =>$category])}}"
                                                   class="btn btn-info btn-sm">Edit</a></td>
                                            <td><a href="" class="btn btn-danger btn-sm">{{__('crater.general.delete')}}</a></td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
