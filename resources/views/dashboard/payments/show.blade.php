@extends('layout.admin')

@section('title', 'Historique des paiements')

@section('content')

    <main class="d-flex justify-content-between flex-row">

        <section class="manage-payments-section w-100">
            
            <x-alerts></x-alerts>

            <h5
                class="text-center my-3 bg-light p-3 rounded-3 d-flex justify-content-between align-items-center flex-wrap gap-3">
                <span>
                    <i class="fas fa-money-check-alt"></i>
                    Historique des paiements de l'utilisateur:
                    <span class="text-primary">
                        <a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a>
                    </span>
                </span>

                <a href="{{ route('payments.index') }}" class="btn btn-primary float-end">
                    <i class="fas fa-arrow-left"></i>
                    Retour
                </a>
            </h5>


            <x-alerts></x-alerts>

            @if (count($payments) > 0)
                <div class="table-responsive mb-3">
                    <table class="table table-striped table-hover">
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
                </div>
                <div class="d-flex gap-2">
                    <form action="{{ route('payments.pdf') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-file-pdf"></i>
                            Télécharger le PDF
                        </button>
                    </form>
                    @if ($payment->remaining_amount > 0)
                        <a href="{{ route('payments.create', ['user_id' => $user->id]) }}"
                            class="btn btn-primary btn-block">
                            <i class="fas fa-plus-circle me-2"></i>
                            Ajouter un paiement
                        </a>
                    @endif
                </div>
            @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    Aucun paiement n'a été effectué pour cet utilisateur.
                </div>
            @endif



        </section>

    </main>

@endsection
