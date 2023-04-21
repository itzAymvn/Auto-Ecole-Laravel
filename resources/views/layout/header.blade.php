<!-- Navbar -->
<nav class="w-100 navbar navbar-expand-lg bg-white navbar-light sticky-top p-0 shadow-sm">
    <a href="{{ route('main') }}" class="navbar-brand d-flex align-items-center border-end px-4 px-lg-5">
        <h2 class="m-0">
            <i class="fas fa-car text-primary me-2"></i>Auto-Ecole
        </h2>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0 align-items-lg-center">
            <a href="{{ route('main') }}" class="nav-item nav-link {{ request()->routeIs('main') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                <span>Accueil</span>
            </a>
            <a href="{{ route('main') }}#about-section" class="nav-item nav-link">
                <i class="fas fa-info-circle"></i>
                <span>A propos</span>
            </a>
            <a href="{{ route('main') }}#contact-section" class="nav-item nav-link">
                <i class="fas fa-phone"></i>
                <span>Contact</span>
            </a>
            @if (request()->is('dashboard*'))
                @if ((Auth::user() && Auth::user()->type == 'admin') || Auth::user()->type == 'superadmin')
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" id="dashboardDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-gear"></i>
                            <span>Gestion</span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu w-100 border-0 shadow" aria-labelledby="userDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('users.index') }}">
                                    <i class="fas fa-users"></i>
                                    <span>Utilisateurs</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('exams.index') }}">
                                    <i class="fas fa-clipboard-list"></i>
                                    <span>Examens</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item">
                                    <i class="fas fa-money-bill-wave"></i>
                                    <span>Paiements</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                @endif
            @endif
            @if (Auth::check())
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" id="userDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        @if (Auth::user()->image)
                            <img src="{{ asset('storage/profiles/' . Auth::user()->image) }}" alt="user image"
                                class="rounded-circle" width="30" height="30">
                        @else
                            <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                                alt="user image" class="rounded-circle" width="30" height="30">
                        @endif

                        <div>
                            {{ Auth::user()->name }}
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu w-100 border-0 shadow" aria-labelledby="userDropdown">
                        <li>
                            <a class="dropdown-item " href="{{ route('profile') }}">
                                <i class="fas fa-user-circle"></i>
                                <span>Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        @if (Auth::user()->type === 'admin' || Auth::user()->type === 'superadmin')
                            <li>
                                <a class="dropdown-item" href="{{ route('dashboard') }}">
                                    <i class="fas fa-user-cog"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                        @endif
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Se déconnecter</span>
                            </a>
                        </li>
                    </ul>
                </div>
            @else
                <a href="{{ route('login-show') }}" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Se
                    connecter</a>
            @endif

        </div>
    </div>
</nav>
