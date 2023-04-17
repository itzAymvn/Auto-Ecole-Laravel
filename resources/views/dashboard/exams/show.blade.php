@extends('layout.layout')

@section('title', 'Page d\'examen')

@section('content')

    <div class="container mt-3 mb-5">
        {{-- 2 section, exam data & exam users --}}
        <div class="row">
            <div class="col-md-12">
                <h1>
                    <span>
                        Viewing Exam: <span class="text-primary">{{ $exam->name }}</span>
                    </span>

                    <a href="{{ route('exams.index') }}" class="btn btn-primary float-end">Retour</a>
                </h1>
                <table class="table">
                    <tbody>
                        <tr>
                            <td><strong>ID:</strong></td>
                            <td>{{ $exam->id }}</td>
                        </tr>
                        <tr>
                            <td><strong>Instructor:</strong></td>
                            <td>
                                <a href="{{ route('users.show', $exam->instructor_id) }}">
                                    {{ $instructor->name }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Vehicule:</strong></td>
                            <td>
                                <a>
                                    {{ $vehicle->model }}
                                </a>
                            </td>
                        <tr>
                            <td><strong>Title:</strong></td>
                            <td>{{ $exam->exam_title }}</td>
                        </tr>
                        <tr>
                            <td><strong>Type:</strong></td>
                            <td>{{ $exam->exam_type }}</td>
                        </tr>
                        <tr>
                            <td><strong>Location:</strong></td>
                            <td>{{ $exam->exam_location }}</td>
                        </tr>
                        <tr>
                            <td><strong>Date & Time:</strong></td>
                            <td>{{ $exam->exam_date }} at {{ $exam->exam_time }}</td>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h1>
                    <span>
                        Exam Users
                        <span class="text-primary">{{ $students->count() }}/5</span>
                    </span>
                </h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Birthdate</th>
                            <th>Type</th>
                            <th>Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>
                                    <a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->address }}</td>
                                <td>{{ $user->birthdate }}</td>
                                <td>{{ $user->type }}</td>
                                <td>
                                    @empty($user->image)
                                        <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                                            alt="Image" width="50" height="50">
                                    @else
                                        <img src="{{ asset('storage/profiles/' . $user->image) }}" alt="Image"
                                            width="50" height="50">
                                    @endempty
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
