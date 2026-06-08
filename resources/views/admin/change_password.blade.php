@extends('admin.layout.app')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Change Password</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin-change-password-update') }}">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">Old Password</label>
                                    <input class="form-control" type="password" name="old_password" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">New Password</label>
                                    <input class="form-control" type="password" name="new_password" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <input class="form-control" type="password" name="new_password_confirmation" required>
                                </div>

                                <button class="btn btn-primary" type="submit">Update Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
