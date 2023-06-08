@extends('layout.admin')

@section('title', 'Liste des paiements')

@section('content')

    <main class="d-flex justify-content-between flex-row">

        <section class="manage-payments-section container">

            <x-alerts></x-alerts>

            <div class="my-3 bg-light p-3 rounded-3">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <h5>
                        <i class="fas fa-money-check-alt me-2"></i>
                        Liste des paiements
                    </h5>
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-1">
                        <button type="button" class="btn btn-primary d-flex align-items-center shadow-sm" data-toggle="modal"
                            data-target="#filters_modal" title="Filter">
                            <i class="fas fa-filter me-2"></i>
                            <span class="d-none d-md-inline">Filtrer</span>
                        </button>
                    </div>
                </div>
            </div>

            @if (count($payments) > 0)

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nom de l'utilisateur</th>
                                <th>Montant de l'objectif</th>
                                <th>Montant total reçu</th>
                                <th>Montant restant à payer</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $payment)
                                <tr class="align-middle">
                                    <td>
                                        <a href="{{ route('users.show', $payment->user_id) }}">
                                            {{ $payment->user_name }}
                                        </a>
                                    </td>
                                    <td>{{ $payment->goal_amount }}</td>
                                    <td>{{ $payment->total_paid }}</td>
                                    <td>{{ $payment->remaining_amount }}</td>
                                    <td>
                                        @if ($payment->remaining_amount == 0)
                                            <span class="badge bg-success rounded-pill">Terminé</span>
                                        @else
                                            <span class="badge bg-danger rounded-pill">En cours</span>
                                        @endif
                                    </td>
                                    <td class="d-flex flex-column gap-1">
                                        <a href="{{ route('payments.show', $payment->user_id) }}">
                                            <i class="fas fa-eye"></i>
                                            Details
                                        </a>
                                        <form action="{{ route('payments.pdf') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $payment->user_id }}">
                                            <button type="submit" class="btn btn-link p-0">
                                                <i class="fas fa-file-pdf"></i>
                                                Télécharger le PDF
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    Aucun paiement trouvé.
                </div>
            @endif

        </section>

    </main>

    <!-- Modal (Filtering) -->
    <div class="modal fade" id="filters_modal" tabindex="-1" role="dialog" aria-labelledby="filters_modal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-filter me-2"></i>
                        <span class="fw-bold">Filtrer les paiements</span>
                    </h5>
                    <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="filters_form" action="{{ route('payments.index') }}" method="GET">
                        <div class="mb-3">
                            <label for="search">Rechercher un utilisateur par nom :</label>
                            <input type="text" class="form-control" id="search" name="search"
                                value="{{ request()->query('search') }}" placeholder="Nom de l'utilisateur">
                        </div>
                        <div class="mb-3">
                            <label for="status">Statut :</label>
                            <select class="form-control" id="status" name="status">
                                <option value="">Tous</option>
                                <option value="finished" {{ request()->query('status') == 'finished' ? 'selected' : '' }}>
                                    Terminé
                                </option>
                                <option value="in_progress"
                                    {{ request()->query('status') == 'in_progress' ? 'selected' : '' }}>
                                    En cours
                                </option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times me-2"></i>
                        <span class="fw-bold">Fermer</span>
                    </button>
                    <button type="submit" class="btn btn-primary" form="filters_form">
                        <i class="fas fa-filter me-2"></i>
                        <span class="fw-bold">Filtrer</span>
                    </button>
                    <a href="{{ route('payments.index') }}" class="btn btn-danger">
                        <i class="fas fa-sync me-2"></i>
                        <span class="fw-bold">Réinitialiser</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
