@extends('layout.layout')

@section('title', 'Créer un paiement')

@section('content')

    <div class="container mt-3 mb-5">
        <div class="row">
            <div class="col-md-12">
                <h5 class="my-5">
                    <span>
                        <i class="fas fa-user"></i>
                        Vous créez un paiement pour l'utilisateur:
                        <span class="text-primary">{{ $user->name }}</span>
                    </span>

                    <a href="{{ redirect()->back()->getTargetUrl() }}" class="btn btn-primary float-end">
                        <i class="fas fa-arrow-left"></i>
                        Retour
                    </a>
                </h5>
                <form action="{{ route('payments.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="student_id" value="{{ $user->id }}">

                    <div class="mb-3">
                        <label for="total_amount" class="form-label">
                            <i class="fa-solid fa-receipt"></i>
                            Montant total à payer en dirhams:</label>

                        <input type="number" name="goal_amount" class="form-control"
                            min="0"value=@if ($goal_amount != null) {{ $goal_amount }} @endif>
                    </div>

                    @if ($total_paid < $goal_amount || $goal_amount == null)
                        @if ($remaining_amount != null)
                            <div class="mb-3">
                                <label for="remaining_amount" class="form-label">
                                    <i class="fa-solid fa-cash-register"></i>
                                    Montant restant à payer en dirhams:
                                </label>
                                <div>{{ $remaining_amount }}</div>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="amount_paid" class="form-label">
                                <i class="fa-solid fa-credit-card"></i>
                                Montant payé en dirhams:
                            </label>
                            <input type="number" name="amount_paid" class="form-control" min=0
                                max=@if ($remaining_amount != null) {{ $remaining_amount }} @endif
                                value=@if ($remaining_amount != null) {{ $remaining_amount }} @else 0 @endif>
                        </div>

                        <button type="submit" class="btn btn-primary float-end">
                            <i class="fas fa-save"></i>
                            Enregistrer
                        </button>
                    @else
                        <div class="alert alert-success" role="alert">
                            <i class="fas fa-check-circle"></i>
                            <span>Ce utilisateur a payé tout le montant de l'objectif.</span>
                        </div>
                    @endif
                </form>

            </div>
        </div>
    </div>



@endsection
