<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    <link href="{{ asset('admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css">
</head>

<body class="authentication-bg authentication-bg-pattern">
    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-4">
                    <div class="card">
                        <div class="card-body p-4">
                            <h4 class="text-center mb-4">Admin Login</h4>

                            @if (session('message'))
                                <div class="alert alert-{{ session('alert-type') === 'error' ? 'danger' : session('alert-type') }}">
                                    {{ session('message') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('admin-login-post') }}">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label" for="email">Email</label>
                                    <input class="form-control @error('email') is-invalid @enderror" id="email"
                                        type="email" name="email" value="{{ old('email') }}" required autofocus>
                                    @error('email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="password">Password</label>
                                    <input class="form-control @error('password') is-invalid @enderror" id="password"
                                        type="password" name="password" required>
                                    @error('password')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button class="btn btn-primary w-100" type="submit">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
