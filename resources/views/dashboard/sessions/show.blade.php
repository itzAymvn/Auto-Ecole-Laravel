@extends('layout.admin')

@section('title', 'Détails de la session')

@section('content')

    <div class=" py-3">

        <x-alerts></x-alerts>

        <div class="row">
            <div class="col-md-12">
                <h5
                    class="text-center bg-light p-3 rounded-3 d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <span>
                        <i class="fas fa-clipboard-list"></i>
                        Détails de la session:
                        <span class="text-primary">{{ $session->title }}</span>
                    </span>
                    <a href="{{ route('sessions.index') }}" class="btn btn-primary float-end">
                        <i class="fas fa-arrow-left"></i>
                        Retour
                    </a>
                </h5>
                <table class="table table-responsive table-bordered">
                    <tbody>
                        <tr>
                            <td>
                                <strong>
                                    <i class="fas fa-user"></i>
                                    Instructeur:
                                </strong>
                            </td>
                            <td>
                                @can('view-users')
                                    <a href="{{ route('users.show', $session->instructor_id) }}">
                                        {{ $instructor->name }}
                                    </a>
                                @else
                                    {{ $instructor->name }}
                                @endcan
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                    <i class="fas fa-calendar-alt"></i>
                                    Date de la session:
                                </strong>
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($session->session_date)->format('d/m/Y') }}
                                à
                                {{ \Carbon\Carbon::parse($session->session_time)->format('H:i') }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                    <i class="fas fa-map-marker-alt"></i>
                                    Lieu de la session:
                                </strong>
                            </td>
                            <td>{{ $session->session_location }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h5
                    class="text-center bg-light p-3 rounded-3 d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <span>
                        <i class="fas fa-user"></i>
                        Étudiants inscrits à la session:
                        <span class="text-primary">{{ $students->count() }}</span>
                    </span>
                </h5>

                @if ($students->count() > 0)
                    <div class="card">
                        <div class="card-body">
                            @foreach ($students as $user)
                                <div class="d-flex justify-content-between align-items-center mb-1 flex-wrap">
                                    <div class="d-flex align-items-center">
                                        @empty($user->image)
                                            <img src="{{ asset('images/default-user.jpg') }}" alt="Image" width="50"
                                                height="50" class="me-2 rounded-circle">
                                        @else
                                            <img src="{{ asset('storage/profiles/' . $user->image) }}" alt="Image"
                                                width="50" height="50" class="me-2 rounded-circle">
                                        @endempty
                                        <div>
                                            @can('view-users')
                                                <a href="{{ route('users.show', $user->id) }}">
                                                    {{ $user->name }}
                                                </a>
                                            @else
                                                <span class="text-primary">{{ $user->name }}</span>
                                            @endcan
                                            <p class="text-muted mb-0">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                    <div>
                                        @isset($user->pivot->attended)
                                            @if ($user->pivot->attended == 1)
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
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning">
                        <span class="text-danger">
                            <i class="fas fa-exclamation-triangle"></i>
                            Aucun étudiant n'est inscrit à cette session.
                        </span>
                        <br>
                        <span class="text-danger">
                            <i class="fas fa-exclamation-triangle"></i>
                            Vous pouvez ajouter des étudiants à cette session en cliquant sur le bouton
                            <span class="badge bg-primary">
                                <i class="fas fa-edit"></i>
                                Modifier
                            </span>
                            ci-dessous.
                        </span>
                    </div>
                @endif
            </div>
        </div>
        @can('edit-sessions')
            <a href="{{ route('sessions.edit', $session->id) }}" class="btn btn-primary mt-3">
                <i class="fas fa-edit"></i>
                Modifier les informations de la session
            </a>
        @endcan
    </div>

@endsection
