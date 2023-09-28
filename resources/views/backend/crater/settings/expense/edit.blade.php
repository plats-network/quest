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
                                <form>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Name</label>
                                        <input type="text" class="form-control @error('evaluate_quality') is-invalid @enderror" id="name" name="name"
                                               value="{{$model->name}}" >
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Mô tả</label>
                                        <textarea class="form-control @error('evaluate_quality') is-invalid @enderror" id="description"
                                                  rows="3">{{$model->description}}</textarea>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Gửi yêu cầu</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
