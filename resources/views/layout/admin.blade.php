<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="keywords"
        name="drivin, driving school, driving, driving lessons, driving instructor, driving school near me, driving school website, driving school website template, driving school template, driving school wordpress theme, driving school wordpress" />
    <meta content="description" name="Drivin - Driving School Website" />

    <!-- Font Awesome & Bootstrap Icons -->
    <link href="{{ asset('css/fontawesome-6.3.0.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/bootstrap-icons.min.css') }}" rel="stylesheet" />

    <!-- Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap-5.0.0.min.css') }}" rel="stylesheet" />

    <!-- Custom Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>

<body class="d-flex flex-column vh-100 justify-content-between">

    <!-- Spinner -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>

    @include('layout.header')

    <!-- Offcanvas sidebar -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarLabel">Sidebar</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="sidebar py-3 d-flex flex-column">
                @include('layout.sidebar')
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between flex-row flex-grow-1">
        {{-- This is the container --}}
        <div class="d-none d-md-block" id="sidebar-container">
            <div class="sidebar d-flex flex-column">
                @include('layout.sidebar')
            </div>
        </div>
        <div id="main-container">
            @yield('content')
        </div>
    </div>

    @include('layout.footer')

    @stack('scripts')
    <!-- Importing Necessary Javascript Files -->
    <script src="{{ asset('js/jquery-3.6.3.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle-5.1.1.min.js') }}"></script>

    <!-- Custom Javascript File -->
    <script src="{{ asset('js/script.js') }}"></script>

    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

</body>

</html>
