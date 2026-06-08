@extends('admin.layout.app')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Edit Admin</h4>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin-update') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id }}">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Name</label>
                                <input class="form-control" name="name" value="{{ old('name', $data->name) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input class="form-control" type="email" name="email"
                                    value="{{ old('email', $data->email) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone</label>
                                <input class="form-control" name="phone" value="{{ old('phone', $data->phone) }}">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Address</label>
                                <textarea class="form-control" name="address">{{ old('address', $data->address) }}</textarea>
                            </div>
                        </div>

                        <button class="btn btn-primary" type="submit">Update Admin</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
