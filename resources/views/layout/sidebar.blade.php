<a href="{{ route('users.index') }}"
    class="btn btn-primary @if (Str::startsWith(Request::url(), route('users.index'))) btn-dark @endif btn-block mb-3">
    <i class="bi bi-person"></i> Gérer les utilisateurs
</a>
<a href="{{ route('vehicles.index') }}"
    class="btn btn-primary @if (Str::startsWith(Request::url(), route('vehicles.index'))) btn-dark @endif btn-block mb-3">
    <i class="bi bi-truck"></i> Gérer les véhicules
</a>
<a href="{{ route('exams.index') }}"
    class="btn btn-primary @if (Str::startsWith(Request::url(), route('exams.index'))) btn-dark @endif btn-block mb-3">
    <i class="bi bi-clipboard-check"></i> Gérer les examens
</a>
<a href="{{ route('payments.index') }}"
    class="btn btn-primary @if (Str::startsWith(Request::url(), route('payments.index'))) btn-dark @endif btn-block mb-3">
    <i class="bi bi-cash"></i> Gérer les paiements
</a>
<a class="btn btn-primary btn-block mb-3">
    <i class="bi bi-calendar"></i> Gérer les sessions
</a>
