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
</head>

<body class="d-flex flex-column vh-100 justify-content-between">

    <!-- Spinner -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>

    @include('layout.header')

    @yield('content')

    @include('layout.footer')

    @stack('scripts')
    <!-- Importing Necessary Javascript Files -->
    <script src="{{ asset('js/jquery-3.6.3.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle-5.1.1.min.js') }}"></script>

    <!-- Custom Javascript File -->
    <script src="{{ asset('js/script.js') }}"></script>

    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

</html>
