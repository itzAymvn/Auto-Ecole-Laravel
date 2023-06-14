@extends('layout.layout')

@section('title', 'Profile')

@section('content')
    <section class="profile-section py-3">

        <div class="container py-3">

            <x-alerts></x-alerts>

            @if (Auth::user()->type == 'student')
                <ul class="nav nav-tabs mb-4">
                    <li class="nav-item">
                        <a class="nav-link active" data-target="profileTabContent">
                            <i class="fas fa-user me-2"></i>
                            Profile
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-target="paymentsTabContent">
                            <i class="fas fa-money-bill me-2"></i>
                            Historique des paiements
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-target="sessionsTabContent">
                            <i class="fas fa-book me-2"></i>
                            Mes séances
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-target="examsTabContent">
                            <i class="fas fa-book me-2"></i>
                            Mes examens
                        </a>
                    </li>

                </ul>
            @endif

            <div class="tab-content" id="profileTabContent">
                {{-- Profile --}}
                <div class="mb-4 bg-light rounded-3 p-3 shadow-sm">
                    <h3 class="text-center">
                        <i class="fas fa-user me-2"></i>
                        Profile
                    </h3>
                </div>

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-4">
                    <div class="col-12">
                        <div class="card shadow-sm rounded">
                            <div class="card-body">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="flex-shrink-0">
                                        @if (Auth::user()->image)
                                            <img src="{{ asset('storage/profiles/' . Auth::user()->image) }}" alt="profile"
                                                class="rounded-circle" width="60" height="60">
                                        @else
                                            <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                                                alt="profile" class="rounded-circle" width="60" height="60">
                                        @endif
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="mb-0">{{ Auth::user()->name }}</h5>
                                        <p class="mb-0">{{ Auth::user()->email }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Update Profile --}}

                    <div class="col-12">
                        <div class="card shadow-sm rounded">
                            <div class="card-body">
                                <h5 class="mb-3">Mes informations</h5>
                                <form action="{{ route('update-profile') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="image" class="form-label">
                                                    @if (Auth::user()->image)
                                                        <img src="{{ asset('storage/profiles/' . Auth::user()->image) }}"
                                                            alt="profile" class="rounded-circle" width="100"
                                                            height="100">
                                                    @else
                                                        <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                                                            alt="profile" class="rounded-circle" width="60"
                                                            height="60">
                                                    @endif
                                                    <span class="ms-2">Changer l'image</span>

                                                </label>

                                                <input type="file" name="image" id="image"
                                                    class="form-control d-none">
                                                @error('image')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">
                                                    <i class="fas fa-user me-2"></i>
                                                    Nom
                                                </label>
                                                <input type="text" name="name" id="name" class="form-control"
                                                    value="{{ old('name') ? old('name') : Auth::user()->name }}">
                                                @error('name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">
                                                    <i class="fas fa-envelope me-2"></i>
                                                    Email
                                                </label>
                                                <input type="email" name="email" id="email" class="form-control"
                                                    value="{{ old('email') ? old('email') : Auth::user()->email }}">
                                                @error('email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">
                                                    <i class="fas fa-phone me-2"></i>
                                                    Téléphone
                                                </label>
                                                <input type="text" name="phone" id="phone" class="form-control"
                                                    value="{{ old('phone') ? old('phone') : Auth::user()->phone }}">
                                                @error('phone')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="address" class="form-label">
                                                    <i class="fas fa-map-marker-alt me-2"></i>
                                                    Adresse
                                                </label>
                                                <input type="text" name="address" id="address" class="form-control"
                                                    value="{{ old('address') ? old('address') : Auth::user()->address }}">
                                                @error('address')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="birthdate" class="form-label">
                                                    <i class="fas fa-calendar me-2"></i>
                                                    Date de naissance
                                                </label>
                                                <input type="date" name="birthdate" id="birthdate"
                                                    class="form-control"
                                                    value="{{ old('birthdate') ? old('birthdate') : Auth::user()->birthdate }}">
                                                @error('birthdate')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fas fa-save me-2"></i>
                                                        Enregistrer
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Change password --}}

                    <div class="col-12">
                        <div class="card shadow-sm rounded">
                            <div class="card-body">
                                <h5 class="mb-3">Changer le mot de passe</h5>
                                <form action="{{ route('update-password') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="password" class="form-label">
                                                    <i class="fas fa-lock me-2"></i>
                                                    Nouveau mot de passe
                                                </label>
                                                <input type="password" name="password" id="password"
                                                    class="form-control">
                                                @error('password')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="password_confirmation" class="form-label">
                                                    <i class="fas fa-lock me-2"></i>
                                                    Confirmer le mot de passe
                                                </label>
                                                <input type="password" name="password_confirmation"
                                                    id="password_confirmation" class="form-control">
                                                @error('password_confirmation')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-save me-2"></i>
                                                    Enregistrer
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Delete account --}}

                    <div class="col-12">
                        <div class="card shadow-sm rounded">
                            <div class="card-body">
                                <h5 class="mb-3">Supprimer le compte</h5>
                                <div class="alert alert-danger">
                                    Pour supprimer votre compte, veuillez contacter l'administrateur.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if (Auth::user()->type == 'student')
                <div class="tab-content d-none" id="paymentsTabContent">
                    <div class="mb-4 bg-light rounded-3 p-3 shadow-sm">
                        <h3 class="text-center">
                            <i class="fas fa-money-bill-wave"></i>
                            Historique des paiements
                        </h3>
                    </div>
                    @if (count($payments) > 0)
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>
                                                    <i class="fas fa-calendar me-2"></i>
                                                    Date
                                                </th>
                                                <th>
                                                    <i class="fas fa-money-bill-wave me-2"></i>
                                                    Montant payé
                                                </th>
                                                <th>
                                                    <i class="fas fa-money-bill-wave me-2"></i>
                                                    Montant total
                                                </th>
                                                <th>
                                                    <i class="fas fa-money-bill-wave me-2"></i>
                                                    Montant restant
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($payments as $payment)
                                                <tr>
                                                    <td>{{ $payment['id'] }}</td>
                                                    <td>{{ $payment['created_at'] }}</td>
                                                    <td>{{ $payment['amount_paid'] }}</td>
                                                    <td>{{ $payment['goal_amount'] }}</td>
                                                    <td>{{ $payment['remaining_amount'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @if ($payments->last()->remaining_amount == 0)
                                    <div class="alert alert-success">
                                        <i class="fas fa-check-circle me-2"></i>
                                        Vous avez terminé le paiement de votre objectif.
                                    </div>
                                @else
                                    <div class="alert alert-warning">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        Vous n'avez pas encore terminé le paiement de votre objectif.
                                        <span class="fw-bold">Montant restant :
                                            {{ $payments->last()->remaining_amount }}
                                            DH</span>
                                    </div>
                                @endif

                                <form action="{{ route('payments.pdf') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fas fa-file-pdf"></i>
                                        Télécharger le PDF
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Vous n'avez pas encore effectué de paiement.
                        </div>
                    @endif
                </div>

                <div class="tab-content" id="sessionsTabContent">
                    <div class="mb-4 bg-light rounded-3 p-3 shadow-sm">
                        <h3 class="text-center">
                            <i class="fas fa-calendar-alt"></i>
                            Historique des sessions
                        </h3>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                @if (count($sessions) == 0)
                                    Vous n'avez pas encore participé à une session.
                                @else
                                    Vous avez participé à
                                    {{ count($sessions) == 1 ? 'une session' : count($sessions) . ' sessions' }}
                                @endif
                            </div>
                            @if (count($sessions) > 0)
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <i class="fas fa-calendar-alt me-2"></i>
                                                    Titre de la session
                                                </th>
                                                <th>
                                                    <i class="fas fa-calendar me-2"></i>
                                                    Date
                                                </th>
                                                <th>
                                                    <i class="fas fa-clock me-2"></i>
                                                    Heure
                                                </th>
                                                <th>
                                                    <i class="fas fa-map-marker-alt me-2"></i>
                                                    Location
                                                </th>
                                                <th>
                                                    <i class="fas fa-check-circle me-2"></i>
                                                    Présence
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sessions as $session)
                                                <tr>
                                                    <td>{{ $session['title'] }}</td>
                                                    <td>{{ $session['session_date'] }}</td>
                                                    <td>{{ $session['session_time'] }}</td>
                                                    <td>{{ $session['session_location'] }}</td>
                                                    <td>
                                                        @isset($session->pivot->attended)
                                                            @if ($session->pivot->attended == 1)
                                                                <span class="badge bg-success">
                                                                    <i class="fas fa-check"></i>
                                                                    Présent
                                                                </span>
                                                            @else
                                                                <span class="badge bg-danger">
                                                                    <i class="fas fa-times"></i>
                                                                    Absent
                                                                </span>
                                                            @endif
                                                        @else
                                                            <span class="badge bg-warning">
                                                                <i class="fas fa-question"></i>
                                                                Non défini
                                                            </span>
                                                        @endisset
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="tab-content" id="examsTabContent">
                    <div class="mb-4 bg-light rounded-3 p-3 shadow-sm">
                        <h3 class="text-center">
                            <i class="fas fa-calendar-alt"></i>
                            Historique des examens
                        </h3>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                @if (count($exams) == 0)
                                    Vous n'avez pas encore passé d'examen.
                                @else
                                    Vous avez passé
                                    {{ count($exams) == 1 ? 'un examen' : count($exams) . ' examens' }}
                                @endif
                            </div>
                            @if (count($exams) > 0)
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <i class="fas fa-calendar-alt me-2"></i>
                                                    Titre de l'examen
                                                </th>
                                                <th>
                                                    <i class="fas fa-calendar me-2"></i>
                                                    Date
                                                </th>
                                                <th>
                                                    <i class="fas fa-clock me-2"></i>
                                                    Heure
                                                </th>
                                                <th>
                                                    <i class="fas fa-map-marker-alt me-2"></i>
                                                    Lieu
                                                </th>
                                                <th>
                                                    <i class="fas fa-check-circle me-2"></i>
                                                    Résultat
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($exams as $exam)
                                                <tr>
                                                    <td>{{ $exam['exam_title'] }}</td>
                                                    <td>{{ $exam['exam_date'] }}</td>
                                                    <td>{{ $exam['exam_time'] }}</td>
                                                    <td>{{ $exam['exam_location'] }}</td>
                                                    <td>
                                                        @isset($exam->pivot->result)
                                                            <span class="badge bg-success">
                                                                <i class="fas fa-check"></i>
                                                                {{ $exam->pivot->result }}
                                                            </span>
                                                        @else
                                                            <span class="badge bg-warning">
                                                                <i class="fas fa-question"></i>
                                                                Non défini
                                                            </span>
                                                        @endisset
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            @endif
        </div>
    </section>
@endsection

{{-- USE JS TO PREVIEW IMAGE WHEN CHANGING no jquery --}}

@push('scripts')
    <script>
        // Image preview
        const image = document.getElementById('image');
        const label = document.querySelector('.form-label');

        image.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.addEventListener('load', function() {
                    label.innerHTML = `<img src="${this.result}" alt="profile" class="rounded-circle" width="100" height="100">
                                                <span class="ms-2">Changer l'image</span>`;
                });
                reader.readAsDataURL(file);
            }
        });

        // Tabs
        const tabs = document.querySelectorAll('.nav-link');
        const tabContent = document.querySelectorAll('.tab-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', function(e) {
                const tabButton = tab
                const tabTarget = tab.dataset.target;

                // Remove active class from all tabs
                tabs.forEach(tab => {
                    if (tab !== tabButton) {
                        tab.classList.remove('active');
                    }

                    // Add active class to clicked tab
                    tabButton.classList.add('active');
                });

                // Add d-none class to all tab content
                tabContent.forEach(tab => {
                    if (tab.id !== tabTarget) {
                        tab.classList.add('d-none');
                    } else {
                        tab.classList.remove('d-none');
                    }
                });
            });
        });
    </script>
@endpush
