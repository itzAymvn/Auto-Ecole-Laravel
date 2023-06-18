<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top shadow-sm py-0">

    <div class="d-flex align-items-center">

        @if (request()->is('dashboard*') || request()->is('settings*'))
            {{-- Button for the small screens --}}
            <button class="d-md-none mx-1 btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar"
                aria-controls="sidebar">
                <i class="fas fa-bars"></i>
            </button>

            {{-- Button for the large screens / THIS IS THE BUTTTON --}}
            <button class="d-none d-md-block mx-2 btn" type="button" id="sidebar-toggle">
                <i class="fas fa-bars"></i>
            </button>
        @endif

        <a href="{{ route('main') }}" class="navbar-brand d-flex align-items-center border-end px-2 px-lg-5">
            <h2 class="m-0">
                <i class="fas fa-car text-primary mx-2"></i>
                {{ config('settings.site_name', 'Votre site-name') }}
            </h2>
        </a>
    </div>
    <button type="button" class="navbar-toggler mx-2" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
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
            <a team-section href="{{ route('main') }}#team-section" class="nav-item nav-link">
                <i class="fas fa-users"></i>
                <span>Equipe</span>
            </a>
            <div class="nav-item dropdown me-lg-3 me-xl-4">
                <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" id="langDropdown" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-globe"></i>
                    <div>
                        {{ strtoupper(app()->getLocale()) }}
                    </div>
                </a>

                <ul class="dropdown-menu dropdown-menu w-100 border-0 shadow" aria-labelledby="langDropdown">
                    @foreach (config('app.available_locales') as $key => $locale)
                        <li>
                            <a class="dropdown-item" href="{{ route('language', $key) }}">
                                {{ strtoupper($locale) }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- If the user is connected --}}
            @if (Auth::check())
                <div class="nav-item dropdown me-lg-3 me-xl-4">
                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" id="userDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        @if (Auth::user()->image)
                            <img src="{{ asset('storage/profiles/' . Auth::user()->image) }}" alt="user image"
                                class="rounded-circle" width="30" height="30">
                        @else
                            <img src="{{ asset('images/default-user.jpg') }}" alt="user image" class="rounded-circle"
                                width="30" height="30">
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
                        @if (Auth::user()->type === 'admin' || Auth::user()->type === 'instructor')
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
                        @can('view-settings')
                            <li>
                                <a class="dropdown-item" href="{{ route('settings') }}">
                                    <i class="fas fa-cog"></i>
                                    <span>Paramètres</span>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                        @endcan

                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Se déconnecter</span>
                            </a>
                        </li>
                    </ul>
                </div>
            @else
                <a href="{{ route('login-show') }}" class="btn btn-primary py-4 px-lg-5 d-lg-block">
                    <i class="fas fa-sign-in-alt"></i>
                    Se
                    connecter
                </a>
            @endif

        </div>
    </div>
</nav>


@push('scripts')
    @if (request()->is('dashboard*') || request()->is('settings*'))
        <script>
            const sideBarToggle = document.getElementById('sidebar-toggle');

            // add event listener to the button
            sideBarToggle.addEventListener("click", () => {
                // hide the sidebar
                document.getElementById('sidebar-container').classList.toggle('hidden');
                document.getElementById('main-container').classList.toggle('full');


            })
        </script>
    @endif
@endpush
