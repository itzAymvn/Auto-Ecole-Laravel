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
            <a href="{{ route('login') }}" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Se Connecter
                <i class="fa fa-arrow-right ms-3"></i></a>
        </div>
    </div>
</nav>
<!-- Navbar End -->
