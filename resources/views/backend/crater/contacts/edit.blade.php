@extends('sale.layouts.appkit')
@section("pageTitle","Edit contact")

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Cập nhật liên hệ</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-8 offset-sm-2">

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <br/>
                                @endif
                                <form method="post" action="{{ route('admin.contacts.update', $contact->id) }}">
                                    @method('PATCH')
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="first_name">First Name:</label>
                                        <input type="text" class="form-control @error('evaluate_quality') is-invalid @enderror" name="first_name"
                                               value={{ $contact->first_name }} />
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label" for="last_name">Tên đệm:</label>
                                        <input type="text" class="form-control @error('evaluate_quality') is-invalid @enderror" name="last_name"
                                               value={{ $contact->last_name }} />
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label" for="email">{{__('crater.customers.email')}}:</label>
                                        <input type="text" class="form-control @error('evaluate_quality') is-invalid @enderror" name="email"
                                               value={{ $contact->email }} />
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="city">City:</label>
                                        <input type="text" class="form-control @error('evaluate_quality') is-invalid @enderror" name="city"
                                               value={{ $contact->city }} />
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="country">Country:</label>
                                        <input type="text" class="form-control @error('evaluate_quality') is-invalid @enderror" name="country"
                                               value={{ $contact->country }} />
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="job_title">Job Title:</label>
                                        <input type="text" class="form-control @error('evaluate_quality') is-invalid @enderror" name="job_title"
                                               value={{ $contact->job_title }} />
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
