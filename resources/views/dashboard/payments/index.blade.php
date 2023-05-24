@extends('layout.admin')

@section('title', 'Liste des paiements')

@section('content')

    <main class="d-flex justify-content-between flex-row">

        <section class="manage-payments-section container py-5">

            <h5 class="mb-3">
                <div class="title">
                    <div>
                        <i class="fas fa-money-check-alt me-2"></i>
                        Liste des paiements
                        <span class="badge bg-primary rounded-pill">{{ count($payments) }}</span>
                    </div>

                    <small class="text-muted">
                        Ce sont tous les paiements effectués par tous les utilisateurs. Vous pouvez cliquer sur le nom de
                        l'utilisateur pour voir le profil de l'utilisateur ou sur le bouton détails pour voir les détails
                        des paiements effectués par
                        l'utilisateur.
                    </small>
                </div>
            </h5>


            <x-alerts></x-alerts>

            <form class="input-group mb-3" method="GET" action="{{ route('payments.index') }}">
                <input type="text" class="form-control" placeholder="Rechercher un paiement par nom d'utilisateur"
                    value="{{ request()->query('search') }}" name="search">
                <div class="input-group-append">
                    <button class="btn btn-primary" id="search-btn" type="submit">
                        <i class="fas fa-search"></i>
                        Rechercher
                    </button>
                    <a href="{{ route('payments.index') }}" class="btn btn-primary">
                        <i class="fas fa-sync-alt"></i>
                        Actualiser
                    </a>
                </div>
            </form>

            @if (count($payments) > 0)

                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Nom de l'utilisateur</th>
                                <th>Montant de l'objectif</th>
                                <th>Montant total reçu</th>
                                <th>Montant restant à payer</th>
                                <th>Voir les détails</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $payment)
                                <tr>
                                    <td>
                                        <a href="{{ route('users.show', $payment->user_id) }}">
                                            {{ $payment->user_name }}
                                        </a>
                                    </td>
                                    <td>{{ $payment->goal_amount }}</td>
                                    <td>{{ $payment->total_paid }}</td>
                                    <td>{{ $payment->remaining_amount }}</td>
                                    <td>
                                        <a href="{{ route('payments.show', $payment->user_id) }}">
                                            <i class="fas fa-eye"></i>
                                            Details
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p>Aucun paiement trouvé.</p>
            @endif

        </section>

    </main>

@endsection
