<!doctype html>
<html lang="en">
<head>
    <title>Admin Login · ThePipLab</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link href="{{ asset('images/piplabLogo.png') }}" rel="icon">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Same CSS as client & admin -->
    <link rel="stylesheet" href="{{ asset('css/client-portal.css') }}">
</head>

<body class="bg-light d-flex align-items-center justify-content-center min-vh-100">

    <div class="container px-3">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-6 col-lg-4">

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4 p-md-5">

                        {{-- Logo --}}
                        <div class="text-center mb-4">
                            <img src="{{ asset('images/logo.png') }}" alt="ThePipLab" style="height:48px">
                            <div class="fw-semibold mt-2">Admin Panel</div>
                            <div class="text-muted small">Secure access only</div>
                        </div>

                        {{-- Errors --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0 small">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Login Form --}}
                        <form action="{{ route('admin.authenticate') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    placeholder="admin@thepiplab.com"
                                    required
                                >
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Password</label>
                                <input
                                    type="password"
                                    name="password"
                                    class="form-control"
                                    placeholder="••••••••"
                                    required
                                >
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-lock me-2"></i> Sign In
                                </button>
                            </div>
                        </form>

                    </div>
                </div>

                {{-- Footer --}}
                <div class="text-center text-muted small mt-4">
                    © {{ date('Y') }} ThePipLab · Admin Access
                </div>

            </div>
        </div>
    </div>

</body>
</html>