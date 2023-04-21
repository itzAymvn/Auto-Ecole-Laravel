@extends('layout.layout')

@section('title', 'Edit Exam')

@section('content')

    <div class="container mt-3 mb-5">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif      

        {{-- Exam data section --}}
        <div class="row">
            <div class="col-md-12">
                <h1 class="mb-4 d-flex justify-content-between">
                    <span>
                        Editing Exam: <span class="text-primary">{{ $exam->exam_title }} ({{ $exam->exam_type }})</span>
                    </span>

                    <a href="{{ route('exams.index') }}" class="btn btn-primary float-end">Retour</a>
                </h1>
                <form action="{{ route('exams.update', $exam->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exam_title">Title</label>
                                <input type="text" class="form-control" id="exam_title" name="exam_title"
                                    value="{{ $exam->exam_title }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exam_date">Date</label>
                                <input type="date" class="form-control" id="exam_date" name="exam_date"
                                    value="{{ $exam->exam_date }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exam_time">Time</label>
                                <input type="time" class="form-control" id="exam_time" name="exam_time"
                                    value="{{ $exam->exam_time }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exam_type">Type</label>
                                <select class="form-control" id="exam_type" name="exam_type" required>
                                    <option value="drive" {{ $exam->exam_type === 'drive' ? 'selected' : '' }}>
                                        Drive</option>
                                    <option value="code" {{ $exam->exam_type === 'code' ? 'selected' : '' }}>
                                        Code</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exam_location">Location</label>
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
                    </div>
                    <button type="submit" class="btn btn-primary">Update Exam</button>
                </form>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12">
                <div>
                    <h1>
                        Les étudiants de l'examen: <span class="text-primary">{{ $exam->exam_title }}</span>
                    </h1>
                    <span class="text-muted">Total: {{ $exam_students->count() }}/5</span>

                </div>
                <div class="table-responsive table-responsive-md">
                    <table class="table table-hover table-responsive">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Addresse Email</th>
                                <th>Téléphone</th>
                                <th>Address</th>
                                <th>Date de naissance</th>
                                <th>Type</th>
                                <th>Image</th>
                                <th>Résultat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($exam_students as $exam_student)
                                <tr>
                                    <td>{{ $exam_student->id }}</td>
                                    <td>
                                        <a
                                            href="{{ route('users.show', $exam_student->id) }}">{{ $exam_student->name }}</a>
                                    </td>
                                    <td>{{ $exam_student->email }}</td>
                                    <td>{{ $exam_student->phone }}</td>
                                    <td>{{ $exam_student->address }}</td>
                                    <td>{{ $exam_student->birthdate }}</td>
                                    <td>{{ $exam_student->type }}</td>
                                    <td>
                                        @empty($exam_student->image)
                                            <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                                                alt="Image" width="50" height="50">
                                        @else
                                            <img src="{{ asset('storage/profiles/' . $exam_student->image) }}" alt="Image"
                                                width="50" height="50">
                                        @endempty
                                    </td>
                                    <td>
                                        <form action="{{ route('exams.updateResult') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                                            <input type="hidden" name="student_id" value="{{ $exam_student->id }}">
                                            <div class="input-group mb-3">
                                                <input type="number" name="result" class="form-control"
                                                    placeholder="Enter result"
                                                    value="{{ $exam_student->pivot->result }}">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if ($exam_students->count() < 5)
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('exams.addStudents', $exam->id) }}" class="btn btn-primary">Add Students</a>
                    </div>
                @endif
            </div>
        </div>

    </div>

@endsection
