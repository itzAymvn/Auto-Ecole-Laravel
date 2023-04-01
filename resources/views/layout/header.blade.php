<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0 shadow-sm">
    <a href="{{ route('main') }}" class="navbar-brand d-flex align-items-center border-end px-4 px-lg-5">
        <h2 class="m-0">
            <i class="fas fa-car text-primary me-2"></i>Auto-Ecole
        </h2>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="{{ route('main') }}" class="nav-item nav-link active">Accueil</a>
            <a href="{{ route('main') }}#about-section" class="nav-item nav-link">A Propos</a>
            <a href="{{ route('main') }}#contact-section" class="nav-item nav-link">Contactez Nous</a>
            @if (session()->has('user'))
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ session('user')->username }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-left" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        @if (session('user')->type == 'Admin')
                            <li><a class="dropdown-item" href="{{ route('admin') }}">Admin </a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                        @endif
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}">Se déconnecter</a>
                        </li>
                    </ul>
                </div>
            @else
                <a href="{{ route('login-form') }}" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Se
                    connecter</a>
            @endif

        </div>
    </div>
</nav>
<!-- Navbar End -->

<style>
    .dropdown-menu-left {
        right: auto;
        left: -50%;
        width: 150%;
    }
</style>
