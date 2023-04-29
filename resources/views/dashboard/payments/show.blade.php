@extends('layout.layout')

@section('title', 'Historique des paiements')

@section('content')

    <main class="d-flex justify-content-between flex-row">

        <section class="manage-payments-section container py-5">

            <h5 class="mb-3">
                <i class="fas fa-money-check-alt me-2"></i>
                Liste des paiements de {{ $user->name }}
            </h5>


            <x-alerts></x-alerts>

            @if (count($payments) > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th>Montant de l'objectif</th>
                            <th>Montant reçu</th>
                            <th>Montant restant à payer</th>
                            <th>Paiement effectué le</th>
                            <th>Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $payment)
                            <tr>
                                <th scope="row">{{ $payment->id }}</th>
                                <td>{{ $payment->goal_amount }}</td>
                                <td>{{ $payment->amount_paid }}</td>
                                <td>{{ $payment->remaining_amount }}</td>
                                <td>{{ $payment->created_at }}</td>
                                <td>
                                    <form action="{{ route('payments.destroy', $payment->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Aucun paiement trouvé.</p>
            @endif

            <a href="{{ route('payments.create', $user->id) }}" class="btn btn-primary">
                <i class="fas fa-plus-circle me-2"></i>
                Ajouter un paiement
            </a>

            <a href="{{ route('payments.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>
                Retour à la liste des paiements
            </a>

        </section>

    </main>

@endsection
