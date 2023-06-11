@extends('layout.admin')

@section('title', 'Gérer les sessions')

@section('content')
    <main class="d-flex justify-content-between flex-row">
        <section class="manage-users-section w-100 py-3">
            <x-alerts></x-alerts>

            @if (count($sessions) > 0)
                <div class="mb-3 bg-light p-3 rounded-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>
                            <i class="fa-solid fa-car-side"></i>
                            {{-- If the route has a query param --}}
                            @if (request()->has('student_id'))
                                Sessions de l'étudiant
                                <a href="{{ route('users.show', request()->student_id) }}">
                                    {{ $sessions->student_name }}
                                </a>
                                ({{ count($sessions) }})
                            @else
                                Gérer les sessions
                                ({{ count($sessions) }})
                            @endif
                        </h5>
                        <a href="{{ route('sessions.create') }}" class="btn btn-primary d-flex align-items-center shadow-sm">
                            <i class="fa-solid fa-circle-plus me-2"></i>
                            Ajouter une session
                        </a>
                    </div>
                </div>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Session</th>
                            <th scope="col">Date</th>
                            <th scope="col">Heure</th>
                            <th scope="col">Instructeur</th>
                            <th scope="col">Nb. étudiants</th>
                            <th scope="col">Location</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sessions as $session)
                            <tr class="align-middle @if ($session->session_date == date('Y-m-d')) table-warning @endif">
                                <td class="fw-bold">{{ $session->title }}</td>
                                <td>{{ $session->session_date }}</td>
                                <td>{{ $session->session_time }}</td>
                                <td>
                                    <a href="{{ route('users.show', $session->instructor_id) }}">
                                        {{ $session->instructor_name }}
                                    </a>
                                </td>
                                <td>{{ $session->students_count }}</td>
                                <td>{{ $session->session_location }}</td>
                                <td>
                                    <a href="{{ route('sessions.show', $session->id) }}"
                                        class="btn btn-primary">Détails</a>
                                    <a href="{{ route('sessions.edit', $session->id) }}"
                                        class="btn btn-outline-secondary me-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('sessions.destroy', $session->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Aucune session</h4>
                    <p>
                        @if (request()->has('student_id'))
                            Cet étudiant n'a pas encore de session. Vous pouvez en créer une en cliquant sur le bouton
                            ci-dessous.
                        @else
                            Vous n'avez pas encore de session. Vous pouvez en créer une en cliquant sur le bouton
                            ci-dessous.
                        @endif
                    </p>
                    <hr>
                    <p class="mb-0">
                        @if (request()->has('student_id'))
                            <button type="button" class="btn btn-primary">
                                Créer une session
                            </button>
                        @else
                            <a href="{{ route('sessions.create') }}" class="btn btn-primary">
                                Créer une session
                            </a>
                        @endif

                    </p>
                </div>

            @endif
        </section>
    </main>
@endsection
