@extends('layout.admin')

@section('title', 'Créer une session')

@section('content')

    <main class="d-flex justify-content-between flex-column">
        <section class="manage-users-section  py-5">

            <x-alerts></x-alerts>

            <div class="d-flex justify-content-between mb-3">
                <h2>Créer une session</h2>
                <a href="{{ route('sessions.index') }}" class="btn btn-primary d-flex align-items-center">
                    Retour
                </a>
            </div>
            <form action="{{ route('sessions.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- Title of session --}}
                <div class="mb-3">
                    <label for="title" class="form-label">Titre de la session</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">

                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- L'instructor --}}
                @if (Auth()->user()->type == 'instructor')
                    <input type="hidden" name="instructor_id" value="{{ Auth()->user()->id }}">
                @else
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
                @endif

                {{-- Date --}}
                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}"
                        min="{{ date('Y-m-d') }}">

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

                <div class="p-3 mb-3 bg-light rounded border">
                    <h4 class="mb-3">Étudiants</h4>

                    <div class="student-">
                        <div class="mb-3">
                            <label for="student" class="form-label">Étudiant 1</label>
                            <select class="form-select" aria-label="Default select example" name="student_id_1">
                                <option selected>Choisir un étudiant</option>
                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                    <button type="button" id="add-student" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Ajouter un étudiant
                    </button>
                </div>


                {{-- Submit --}}
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Enregistrer
                </button>
            </form>
        </section>
    </main>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var addButton = document.getElementById('add-student');
            var studentContainer = document.querySelector('.student-');
            var studentCount = 1;

            addButton.addEventListener('click', function() {
                studentCount++;
                var newStudentDiv = document.createElement('div');
                newStudentDiv.classList.add('mb-3');

                var newStudentLabel = document.createElement('label');
                newStudentLabel.setAttribute('for', 'student');
                newStudentLabel.classList.add('form-label');
                newStudentLabel.textContent = 'Étudiant ' + studentCount;

                var newStudentSelect = document.createElement('select');
                newStudentSelect.classList.add('form-select');
                newStudentSelect.setAttribute('aria-label', 'Default select example');
                newStudentSelect.setAttribute('name', 'student_id_' + studentCount);

                var defaultOption = document.createElement('option');
                defaultOption.setAttribute('selected', 'selected');
                defaultOption.textContent = 'Choisir un étudiant';
                newStudentSelect.appendChild(defaultOption);

                @foreach ($students as $student)
                    var newOption = document.createElement('option');
                    newOption.setAttribute('value', '{{ $student->id }}');
                    newOption.textContent = '{{ $student->name }}';
                    newStudentSelect.appendChild(newOption);
                @endforeach

                newStudentDiv.appendChild(newStudentLabel);
                newStudentDiv.appendChild(newStudentSelect);
                studentContainer.appendChild(newStudentDiv);
            });
        });
    </script>
@endpush
