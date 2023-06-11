@extends('layout.admin')

@section('title', 'Créer un paiement')

@section('content')

    <div class=" mt-3 mb-5">
        <div class="row">
            <div class="col-md-12">
                <h5 class="mb-3">
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
                <div class="d-flex justify-content-start align-items-center mb-3">
                    <div>
                        @empty($user->image)
                            <img src="{{ asset('images/default-user.jpg') }}" alt="Image" class="rounded-circle"
                                width="100" height="100">
                        @else
                            <img src="{{ asset('storage/profiles/' . $user->image) }}" alt="Image" class="rounded-circle"
                                width="100" height="100">
                        @endempty
                    </div>
                    <div class="ms-3">
                        <h5 class="text-capitalize">{{ $user->name }}</h5>
                        <p class="text-capitalize">
                            @if ($user->type == 'admin')
                                <span class="badge bg-danger">Administrateur</span>
                            @elseif($user->type == 'student')
                                <span class="badge bg-primary">Étudiant</span>
                            @elseif($user->type == 'instructor')
                                <span class="badge bg-success">Instructeur</span>
                            @endif
                        </p>
                    </div>
                </div>

            </div>


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
