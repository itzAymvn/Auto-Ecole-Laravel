@extends('layout.layout')

@section('title', 'Edit Exam')

@section('content')

    <div class="container mt-3 mb-5">

        <x-alerts></x-alerts>

        {{-- Exam data section --}}
        <div class="row g-3 mb-2 mt-3">
            <div class="col-md-12">
                <h5 class="mb-4 d-flex justify-content-between" {{-- data-bs-toggle="collapse" href="#examData" role="button"
                    aria-expanded="false" aria-controls="examData" --}}>
                    <span>
                        <i class="fas fa-edit"></i>
                        Modifier les données de l'examen
                        <span class="text-primary">{{ $exam->exam_title }}</span>
                    </span>
                </h5>
                <form action="{{ route('exams.update', $exam->id) }}" method="POST" id="examData">
                    @csrf
                    @method('PUT')
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exam_title">Titre</label>
                                <input type="text" class="form-control" id="exam_title" name="exam_title"
                                    value="{{ $exam->exam_title }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exam_date">La date</label>
                                <input type="date" class="form-control" id="exam_date" name="exam_date"
                                    value="{{ $exam->exam_date }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exam_time">L'heure</label>
                                <input type="time" class="form-control" id="exam_time" name="exam_time"
                                    value="{{ $exam->exam_time }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exam_type">Le type</label>
                                <select class="form-control" id="exam_type" required disabled>
                                    <option value="drive" {{ $exam->exam_type === 'drive' ? 'selected' : '' }}>
                                        Conduite
                                    </option>
                                    <option value="code" {{ $exam->exam_type === 'code' ? 'selected' : '' }}>
                                        Code
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exam_location">Localisation</label>
                                <input type="text" class="form-control" id="exam_location" name="exam_location"
                                    value="{{ $exam->exam_location }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="instructor_id">Instructor</label>
                                <select class="form-control" id="instructor_id" name="instructor_id" required>
                                    @foreach ($instructors as $instructor)
                                        <option value="{{ $instructor->id }}"
                                            {{ $exam->instructor_id === $instructor->id ? 'selected' : '' }}>
                                            {{ $instructor->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @if ($exam->exam_type === 'drive')
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="vehicle_id">Véhicule</label>
                                    <select class="form-control" id="vehicle_id" name="vehicle_id" required>
                                        @foreach ($vehicles as $vehicle)
                                            <option value="{{ $vehicle->id }}"
                                                {{ $exam->vehicle_id === $vehicle->id ? 'selected' : '' }}>
                                                {{ $vehicle->matricule }} ({{ $vehicle->model }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-pen"></i>
                        <span>
                            Modifier
                        </span>
                    </button>
                </form>
            </div>
        </div>

        <hr>

        <div class="row g-3 mt-3">
            <div class="col-md-12">
                <div>
                    <h5>
                        <i class="fas fa-users"></i>
                        Modifier les étudiants inscrits à l'examen
                        <span class="text-primary">{{ $exam->exam_title }}</span>
                    </h5>
                </div>
                @if ($exam_students->count() > 0)
                    <div class="mb-3" id="examStudents">
                        <div class="card-body">
                            @foreach ($exam_students as $exam_student)
                                <div class="d-flex justify-content-between align-items-between mb-3 flex-wrap">
                                    <div class="d-flex align-items-center col-12 col-md-6">
                                        @empty($exam_student->image)
                                            <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                                                alt="Image" width="50" height="50" class="me-2 rounded-circle">
                                        @else
                                            <img src="{{ asset('storage/profiles/' . $exam_student->image) }}" alt="Image"
                                                width="50" height="50" class="me-2 rounded-circle">
                                        @endempty
                                        <div>
                                            <a
                                                href="{{ route('users.show', $exam_student->id) }}">{{ $exam_student->name }}</a>
                                            <p class="text-muted mb-0">{{ $exam_student->email }}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-end col-12 col-md-6">
                                        <form action="{{ route('exams.updateResult') }}" method="POST"
                                            class="d-flex align-items-center">
                                            @csrf
                                            <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                                            <input type="hidden" name="student_id" value="{{ $exam_student->id }}">
                                            <input type="number" name="result" class="form-control"
                                                placeholder="Enter result" value="{{ $exam_student->pivot->result }}">
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="fa-solid fa-pen"></i></button>
                                        </form>
                                        <form action="{{ route('exams.removeStudent') }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                                            <input type="hidden" name="student_id" value="{{ $exam_student->id }}">
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="alert alert-info mt-3">
                        <i class="fas fa-info-circle"></i>
                        <span>
                            Aucun étudiant inscrit à cet examen.
                        </span>
                    </div>
                @endif
            </div>
        </div>

        <hr>

        @if ($exam_students->count() < 5)
            <div class="row g-3 mt-3">
                <h5 class="mb-4 d-flex justify-content-between" data-bs-toggle="collapse"
                    data-bs-target="#addStudentForm" role="button" aria-expanded="false"
                    aria-controls="addStudentForm">
                    <span>
                        <i class="fas fa-edit"></i>
                        Ajouter un étudiant à l'examen:
                    </span>
                </h5>
                <form action="{{ route('exams.addStudent') }}" method="POST" class="collapse" id="addStudentForm">
                    @csrf
                    <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                    <label for="student_id">Sélectionner un étudiant à ajouter</label>
                    <div class="input-group mb-3">
                        <select class="form-control" name="student_id" required>
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}">{{ $student->name }} | {{ $student->email }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
            </div>
        @endif

        <div class="d-flex justify-content-center mt-3 gap-3">
            <a href="{{ route('exams.index') }}" class="btn btn-secondary mt-3">
                <i class="fas fa-home"></i>
                <span>
                    Page d'accueil
                </span>
            </a>
            <a href="{{ route('exams.show', $exam->id) }}" class="btn btn-secondary mt-3">
                <i class="fas fa-eye"></i>
                <span>
                    Voir l'examen
                </span>
            </a>
        </div>
    </div>

@endsection
