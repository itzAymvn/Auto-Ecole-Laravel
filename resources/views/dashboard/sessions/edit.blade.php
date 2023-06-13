@extends('layout.admin')

@section('title', 'Edit Session')

@section('content')

    <div class=" mt-3 mb-5">

        <x-alerts></x-alerts>

        {{-- Session data section --}}
        <div class="row g-3">
            <div class="col-md-12">
                <h5
                    class="text-center bg-light p-3 rounded-3 d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <span>
                        <i class="fas fa-calendar-alt"></i>
                        You are editing the session:
                        <span class="text-primary">{{ $session->session_title }}</span>
                    </span>

                    <a href="{{ route('sessions.show', $session->id) }}" class="btn btn-primary float-end">
                        <i class="fas fa-arrow-left"></i>
                        Back
                    </a>
                </h5>
                <form action="{{ route('sessions.update', $session->id) }}" method="POST" id="sessionData">
                    @csrf
                    @method('PUT')
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="session_title">Title</label>
                                <input type="text" class="form-control" id="session_title" name="title"
                                    value="{{ $session->title }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="session_date">Date</label>
                                <input type="date" class="form-control" id="session_date" name="date"
                                    value="{{ $session->session_date }}" required min="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="session_time">Time</label>
                                <input type="time" class="form-control" id="session_time" name="time"
                                    value="{{ $session->session_time }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="session_location">Location</label>
                            <input type="text" class="form-control" id="location" name="location"
                                value="{{ $session->session_location }}" required>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="instructor_id">Instructor</label>
                                <select class="form-control" id="instructor_id" name="instructor_id" required>
                                    @foreach ($instructors as $instructor)
                                        <option value="{{ $instructor->id }}"
                                            {{ $session->instructor_id === $instructor->id ? 'selected' : '' }}>
                                            {{ $instructor->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-pen"></i>
                        <span>
                            Update
                        </span>
                    </button>
                </form>
            </div>
        </div>

        <div class="row g-3 mt-3">
            <div class="col-md-12">
                <div>
                    <h5
                        class="text-center bg-light p-3 rounded-3 d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <span>
                            <i class="fas fa-users"></i>
                            You are editing the students in the session:
                            <span class="text-primary">{{ $session->session_title }}</span>
                        </span>
                    </h5>
                </div>
                @if ($session_students->count() > 0)
                    <div class="mb-3" id="sessionStudents">
                        <div class="card-body">
                            @foreach ($session_students as $session_student)
                                <div class="d-flex justify-content-between align-items-between mb-3 flex-wrap">
                                    <div class="d-flex align-items-center col-12 col-md-6">
                                        @empty($session_student->image)
                                            <img src="{{ asset('images/default-user.jpg') }}" alt="Image" width="50"
                                                height="50" class="me-2 rounded-circle">
                                        @else
                                            <img src="{{ asset('storage/profiles/' . $session_student->image) }}"
                                                alt="Image" width="50" height="50" class="me-2 rounded-circle">
                                        @endempty
                                        <div>
                                            @can('view-users')
                                                <a href="{{ route('users.show', $session_student->id) }}">{{ $session_student->name }}
                                                </a>
                                            @else
                                                <span class="text-primary">{{ $session_student->name }}</span>
                                            @endcan
                                            <p class="text-muted mb-0">{{ $session_student->email }}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-end col-12 col-md-6">
                                        <form action="{{ route('sessions.updateIsAttended') }}" method="POST"
                                            class="d-flex align-items-center">
                                            @csrf
                                            <input type="hidden" name="session_id" value="{{ $session->id }}">
                                            <input type="hidden" name="student_id" value="{{ $session_student->id }}">
                                            <select class="form-control" name="attended" onchange="this.form.submit()">
                                                <option value="0"
                                                    {{ $session_student->pivot->attended === 0 ? 'selected' : '' }}>
                                                    Absent
                                                </option>
                                                <option value="1"
                                                    {{ $session_student->pivot->attended === 1 ? 'selected' : '' }}>
                                                    Present
                                                </option>
                                            </select>
                                        </form>
                                        <form action="{{ route('sessions.removeStudent') }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <input type="hidden" name="session_id" value="{{ $session->id }}">
                                            <input type="hidden" name="student_id" value="{{ $session_student->id }}">
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
                            No students assigned to this session.
                        </span>
                    </div>
                @endif
            </div>
        </div>

        @if ($session_students->count() < 5)
            <div class="row g-3 mt-1">
                <h5
                    class="text-center bg-light p-3 rounded-3 d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <span>
                        <i class="fas fa-user-plus"></i>
                        Add a student to the session
                    </span>
                </h5>
                <form action="{{ route('sessions.addStudent') }}" method="POST" id="addStudentForm">
                    @csrf
                    <input type="hidden" name="session_id" value="{{ $session->id }}">
                    <label for="student_id">Select a student to add</label>
                    <div class="input-group mb-3">
                        <select class="form-control" name="student_id" required>
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}">{{ $student->name }} | {{ $student->email }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        @endif

    </div>
@endsection
