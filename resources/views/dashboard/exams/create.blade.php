@extends('layout.admin')

@section('title', 'Créer un examen')

@section('content')

    <main class="d-flex justify-content-between flex-column">
        <section class="manage-users-section  py-5">

            <x-alerts></x-alerts>

            <div class="d-flex justify-content-between mb-3">
                <h2>Créer un examen</h2>
                <a href="{{ route('exams.index') }}" class="btn btn-primary d-flex align-items-center">
                    Retour
                </a>
            </div>
            <form action="{{ route('exams.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- Title of exam --}}
                <div class="mb-3">
                    <label for="title" class="form-label">Titre de l'examen</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">

                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- L'instructor --}}
                <div class="mb-3">
                    <label for="instructor" class="form-label">Instructeur</label>
                    <select class="form-select" aria-label="Default select example" name="instructor_id">
                        <option selected>Choisir un instructeur</option>
                        @foreach ($instructors as $instructor)
                            <option value="{{ $instructor->id }}">{{ $instructor->name }}</option>
                        @endforeach
                    </select>

                    @error('instructor_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Type (drive, code) --}}
                <div class="mb-3">
                    <label for="type" class="form-label">Type</label>
                    <select class="form-select" aria-label="Default select example" name="type" id="type">
                        <option value="drive">Conduite</option>
                        <option value="code">Code</option>
                    </select>

                    @error('type')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- La vehicule --}}
                <div class="mb-3" id="vehicle-input-container">
                    <label for="vehicle" class="form-label">Véhicule</label>
                    <select class="form-select" aria-label="Default select example" name="vehicle_id" id="vehicle">
                        <option disabled selected value> -- select an option -- </option>
                        @foreach ($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}">{{ $vehicle->model }}</option>
                        @endforeach
                    </select>

                    @error('vehicle_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Date --}}
                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}">

                    @error('date')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Time --}}
                <div class="mb-3">
                    <label for="time" class="form-label">Heure</label>
                    <input type="time" class="form-control" id="time" name="time" value="{{ old('time') }}">

                    @error('time')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Location --}}
                <div class="mb-3">
                    <label for="location" class="form-label">Lieu</label>
                    <input type="text" class="form-control" id="location" name="location"
                        value="{{ old('location') }}">

                    @error('location')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- 5 Students at least --}}
                <div class="p-3 mb-3 bg-light rounded border">
                    <h4 class="mb-3">Étudiants</h4>
                    {{-- Student 1 --}}
                    <div class="mb-3">
                        <label for="student" class="form-label">Étudiant 1</label>
                        <select class="form-select" aria-label="Default select example" name="student_id_1">
                            <option selected>Choisir un étudiant</option>
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}">{{ $student->name }}</option>
                            @endforeach
                        </select>

                        @error('student_id_1')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Student 2 --}}
                    <div class="mb-3">
                        <label for="student" class="form-label">Étudiant 2</label>
                        <select class="form-select" aria-label="Default select example" name="student_id_2">
                            <option selected>Choisir un étudiant</option>
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}">{{ $student->name }}</option>
                            @endforeach
                        </select>

                        @error('student_id_2')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Student 3 --}}
                    <div class="mb-3">
                        <label for="student" class="form-label">Étudiant 3</label>
                        <select class="form-select" aria-label="Default select example" name="student_id_3">
                            <option selected>Choisir un étudiant</option>
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}">{{ $student->name }}</option>
                            @endforeach
                        </select>

                        @error('student_id_3')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Student 4 --}}
                    <div class="mb-3">
                        <label for="student" class="form-label">Étudiant 4</label>
                        <select class="form-select" aria-label="Default select example" name="student_id_4">
                            <option selected>Choisir un étudiant</option>
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}">{{ $student->name }}</option>
                            @endforeach
                        </select>

                        @error('student_id_4')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Student 5 --}}
                    <div class="mb-3">
                        <label for="student" class="form-label">Étudiant 5</label>
                        <select class="form-select" aria-label="Default select example" name="student_id_5">
                            <option selected>Choisir un étudiant</option>
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}">{{ $student->name }}</option>
                            @endforeach
                        </select>

                        @error('student_id_5')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
        </section>
    </main>

@endsection

@push('scripts')
    <script>
        const examTypeInput = document.getElementById('type');
        const vehicleInputContainer = document.getElementById('vehicle-input-container');
        const vehicleInput = document.getElementById('vehicle');

        examTypeInput.addEventListener('change', () => {
            if (examTypeInput.value === 'drive') {
                vehicleInputContainer.style.display = 'block';
                vehicleInput.required = true;
            } else {
                vehicleInputContainer.style.display = 'none';
                vehicleInput.required = false;
                vehicleInput.value = '';
            }
        });
    </script>
@endpush
