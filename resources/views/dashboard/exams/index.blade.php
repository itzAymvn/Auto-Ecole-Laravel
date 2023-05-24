@extends('layout.admin')

@section('title', 'Gérer les examens')

@section('content')
    <main class="d-flex justify-content-between flex-row">

        <section class="manage-users-section container py-5">

            <x-alerts></x-alerts>

            @if (count($exams) > 0)
                <div class="mb-3 bg-light p-3 rounded-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>
                            <i class="fa-solid fa-car-side"></i>
                            {{-- If the route has a query param --}}
                            @if (request()->has('student_id'))
                                Examens de l'étudiant
                                <a href="{{ route('users.show', request()->student_id) }}">
                                    {{ $exams->student_name }}
                                </a>
                                ({{ count($exams) }})
                            @else
                                Gérer les examens
                                ({{ count($exams) }})
                            @endif
                        </h5>
                        <a href="{{ route('exams.create') }}" class="btn btn-primary d-flex align-items-center shadow-sm">
                            <i class="fa-solid fa-circle-plus me-2"></i>
                            Ajouter un examen
                        </a>
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @foreach ($exams as $exam)
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                                        <h5 class="card-title">{{ $exam->exam_title }}</h5>
                                        <h6 class="card-subtitle mb-2 text-muted align-self-end">
                                            {{ $exam->exam_date }} -
                                            {{ $exam->exam_time }}
                                        </h6>
                                    </div>
                                    <p class="card-text">{{ $exam->exam_location }}</p>
                                    <p class="card-text">
                                        <small class="text-muted">Instructeur:
                                            <a href="{{ route('users.show', $exam->instructor_id) }}">
                                                {{ $exam->instructor_name }}
                                            </a>
                                        </small>
                                        <br>
                                        @if ($exam->vehicle_id)
                                            <small class="text-muted">Vehicle:
                                                <a href="{{ route('vehicles.show', $exam->vehicle_id) }}">
                                                    {{ $exam->vehicle->model }}
                                                </a>
                                            </small>
                                        @endif
                                        <br class="mb-2">
                                        <small class="text-muted">Nb. étudiants: {{ $exam->students_count }}/5</small>
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="{{ route('exams.show', $exam->id) }}" class="btn btn-primary">Détails</a>
                                        <div>
                                            <a href="{{ route('exams.edit', $exam->id) }}"
                                                class="btn btn-outline-secondary me-2">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('exams.destroy', $exam->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info">
                    <h2 class="text-center">Aucun examen n'a été trouvé</h2>
                </div>
                <a href="{{ route('exams.create') }}" class="btn btn-primary d-flex align-items-center">
                    Créer un examen
                </a>
            @endif
        </section>
    </main>

@endsection
