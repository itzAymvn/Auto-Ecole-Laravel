<aside
    class="d-flex flex-column align-items-center justify-content-start bg-primary py-5 w-25 d-none d-lg-flex d-xl-flex">
    <div class="d-flex flex-column">
        <a href="{{ route('dashboard') }}"
            class="btn btn-primary btn-block flex-grow-1 mb-3 {{ request()->routeIs('dashboard') ? 'btn-secondary' : '' }}">
            Dashboard
        </a>
        <a href="{{ route('users.index') }}"
            class="btn btn-primary btn-block flex-grow-1 mb-3 {{ request()->routeIs('users.*') ? 'btn-secondary' : '' }}">
            Manage Users
        </a>
        <a href="{{ route('exams.index') }}" class="btn btn-primary btn-block flex-grow-1 mb-3">
            Manage Sessions
        </a>
        <a class="btn btn-primary btn-block flex-grow-1 mb-3">
            Manage Exams
        </a>
    </div>
</aside>
