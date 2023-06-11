@extends('layout.admin')

@section('title', 'Gérer les examens')

@section('content')
    <main class="d-flex justify-content-between flex-row">

        <section class="manage-users-section w-100  py-3">

            <x-alerts></x-alerts>

            @if (count($exams) > 0)
                <div class="mb-3 bg-light p-3 rounded-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>
                            <i class="fa-solid fa-car-side"></i>
                            {{-- If the route has a query param --}}
                            Gérer les examens
                            @if (request()->has('user_id'))
                                @if ($user->type == 'student')
                                    de {{ $user->name }}
                                @else
                                    de {{ $user->name }}
                                @endif
                            @else
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
                            <div class="card" style="height: 100%;">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="card-title">{{ $exam->exam_title }}</h5>
                                    <h6 class="card-subtitle text-muted h6">
                                        <span>
                                            <i class="fa-solid fa-calendar-day me-2"></i>
                                            {{ date('d/m/Y', strtotime($exam->exam_date)) }}
                                        </span>
                                        <span>
                                            <i class="fa-solid fa-clock me-2"></i>
                                            {{ date('H:i A', strtotime($exam->exam_time)) }}
                                        </span>
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">{{ $exam->exam_location }}</p>
                                    <p class="card-text">
                                        <small class="text-muted">
                                            <i class="fa-solid fa-user"></i>
                                            <a href="{{ route('users.show', $exam->instructor_id) }}">
                                                {{ $exam->instructor_name }}
                                            </a>
                                        </small>
                                        @if ($exam->vehicle_id)
                                            <br>
                                            <small class="text-muted">
                                                <i class="fa-solid fa-car"></i>
                                                <a href="{{ route('vehicles.show', $exam->vehicle_id) }}">
                                                    {{ $exam->vehicle->model }}
                                                </a>
                                            </small>
                                        @endif
                                        <br class="mb-2">
                                        <small class="text-muted">
                                            <i class="fa-solid fa-user"></i>
                                            {{ $exam->students_count }}/5</small>
                                    </p>
                                </div>
                                <div class="card-footer mt-auto">
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
