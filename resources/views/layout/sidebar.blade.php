<div
    class="d-flex justify-content-center w-100 flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3 mb-3">
        <i class="bi bi-gear"></i>
        <span>Tableau de bord</span>
    </h1>
</div>

{{-- Users --}}
<a href="{{ route('users.index') }}" title="Gestion des utilisateurs, création, modification, suppression, ..."
    class="btn btn-primary @if (Str::startsWith(Request::url(), route('users.index'))) btn-dark @endif btn-block mb-3">
    <i class="bi bi-person"></i>
    <span>
        Les utilisateurs
    </span>
</a>

{{-- Vehicles --}}
<a href="{{ route('vehicles.index') }}" title="Gestion des véhicules, création, modification, suppression, ..."
    class="btn btn-primary @if (Str::startsWith(Request::url(), route('vehicles.index'))) btn-dark @endif btn-block mb-3">
    <i class="bi bi-truck"></i>
    <span>
        Les véhicules
    </span>
</a>

{{-- Exams --}}
<a href="{{ route('exams.index') }}" title="Gestion des examens, création, modification, suppression, ..."
    class="btn btn-primary @if (Str::startsWith(Request::url(), route('exams.index'))) btn-dark @endif btn-block mb-3">
    <i class="bi bi-clipboard-check"></i>
    <span>
        Les examens
    </span>
</a>

{{-- Payments --}}
<a href="{{ route('payments.index') }}" title="Gestion des paiements, création, modification, suppression, ..."
    class="btn btn-primary
    @if (Str::startsWith(Request::url(), route('payments.index'))) btn-dark @endif btn-block mb-3">
    <i class="bi bi-cash"></i>
    <span>
        Les paiements
    </span>
</a>

{{-- Spendings --}}
<a href="{{ route('spendings.index') }}" title="Gestion des dépenses, création, modification, suppression, ..."
    class="btn btn-primary
    @if (Str::startsWith(Request::url(), route('spendings.index'))) btn-dark @endif btn-block mb-3">
    <i class="bi bi-cash"></i>
    <span>
        Les dépenses
    </span>
</a>

{{-- Sessions --}}
<a class="btn btn-primary btn-block mb-3" title="Gestion des sessions, création, modification, suppression, ...">
    <i class="bi bi-calendar"></i>
    <span>
        Les seances
    </span>
</a>

{{-- Statistics --}}
<a href="{{ route('statistics.index') }}" title="Gestion des statistiques, création, modification, suppression, ..."
    class="btn btn-primary
    @if (Str::startsWith(Request::url(), route('statistics.index'))) btn-dark @endif btn-block mb-3">
    <i class="bi bi-graph-up"></i>
    <span>
        Les statistiques
    </span>
</a>
