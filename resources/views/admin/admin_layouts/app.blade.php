<!doctype html>
<html lang="en">
<head>
    <title>Admin Panel - ThePipLab</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link href="{{ asset('images/piplabLogo.png') }}" rel="icon">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <!-- Font Awesome (single, modern) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- ✅ SAME CSS AS CLIENT -->
       <link href="{{ asset('assets/client/css/client-portal.css') }}" rel="stylesheet">
</head>

<body>

    <div class="wrapper d-flex">

        {{-- Admin Sidebar --}}
        @include('admin.sidebar')

        {{-- Page Content --}}
        <main class="flex-grow-1">
            @yield('content')
        </main>

    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @stack('scripts')
</body>
</html>




