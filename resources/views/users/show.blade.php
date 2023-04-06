@extends('layout.layout')

@section('title', 'Viewing User ID: ' . $user->id)

@section('content')

    <div class="container mt-3 mb-5">

        {{-- User --}}

        <div class="row">
            <div class="col-md-12">
                <h1>
                    <span>
                        Viewing User: {{ $user->id }}, {{ $user->fullname }}
                    </span>

                    <a href="{{ route('users.index') }}" class="btn btn-primary float-end">Retour</a>
                </h1>
                <table class="table">
                    <tbody>
                        <tr>
                            <td><strong>ID:</strong></td>
                            <td>{{ $user->id }}</td>
                        </tr>
                        <tr>
                            <td><strong>Nom:</strong></td>
                            <td>{{ $user->fullname }}</td>
                        </tr>
                        <tr>
                            <td><strong>Nom d'utilisateur:</strong></td>
                            <td>{{ $user->username }}</td>
                        </tr>
                        <tr>
                            <td><strong>Addresse email:</strong></td>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <td><strong>Type:</strong></td>
                            <td>{{ $user->type }}</td>
                        </tr>
                        <tr>
                            <td><strong>Image:</strong></td>
                            <td>
                                @empty($user->profile)
                                    <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                                        alt="Image" width="50" height="50">
                                @else
                                    <img src="{{ asset('storage/profiles/' . $user->profile) }}" alt="Image" width="50"
                                        height="50">
                                @endempty
                            </td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Modifier l'utilisateur</a>
            </div>
        </div>

        {{-- Sessions --}}

        <section class="mt-5">
            <div class="row">
                @if (count($sessions) > 0)
                    <h2>Sessions</h2>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Temp</th>
                                    <th>Location</th>
                                    <th>Instructeur</th>
                                    <th>Vehicle</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sessions as $session)
                                    <tr>
                                        <td>{{ $session->id }}</td>
                                        <td>{{ $session->date }}</td>
                                        <td>{{ $session->time }}</td>
                                        <td>{{ $session->location }}</td>
                                        <td>{{ $session->instructor->fullname }}</td>
                                        <td>{{ $session->vehicle->make }} {{ $session->vehicle->model }}
                                            ({{ $session->vehicle->license_plate }})
                                        </td>
                                        <td class="d-flex justify-content-around">
                                            <a {{-- href="{{ route('sessions.show', $session->id) }}" --}}> <i class="fas fa-eye"></i>
                                            </a>
                                            <a {{-- href="{{ route('sessions.edit', $session->id) }}" --}}> <i class="fas fa-edit"></i>
                                            </a>
                                            <form {{-- action="{{ route('sessions.destroy', $session->id) }}"  --}} method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <i class="fas fa-trash"></i>

                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info" role="alert">
                        Pas de sessions trouvées.
                    </div>
                @endif
            </div>
            <a {{-- href="{{ route('sessions.create', $user->id) }}"  --}} class="btn btn-primary">Ajouter une session</a>
        </section>

        {{-- Exams --}}

        <section class="mt-5">
            <div class="row">
                @if (count($exams) > 0)
                    <h2>Les examens</h2>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Temp</th>
                                    <th>Location</th>
                                    <th>Instructeur</th>
                                    <th>Vehicle</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($exams as $exam)
                                    <tr>
                                        <td>{{ $exam->id }}</td>
                                        <td>{{ $exam->date }}</td>
                                        <td>{{ $exam->time }}</td>
                                        <td>{{ $exam->location }}</td>
                                        <td>{{ $exam->instructor->fullname }}</td>
                                        <td>{{ $exam->vehicle->make }} {{ $exam->vehicle->model }}
                                            ({{ $exam->vehicle->license_plate }})
                                        </td>
                                        <td class="d-flex justify-content-around">
                                            <a {{-- href="{{ route('exams.show', $exam->id) }}" --}}> <i class="fas fa-eye"></i>
                                            </a>
                                            <a {{-- href="{{ route('exams.edit', $exam->id) }}" --}}> <i class="fas fa-edit"></i>
                                            </a>
                                            <form {{-- action="{{ route('exams.destroy', $exam->id) }}"  --}} method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <i class="fas fa-trash"></i>

                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info" role="alert">
                        Pas d'examen trouvé.
                    </div>
                @endif
            </div>

            <a {{-- href="{{ route('exams.create', $user->id) }}"  --}} class="btn btn-primary">Ajouter un examen</a>
        </section>

        {{-- Progress --}}

        <section class="mt-5">
            <div class="row">
                @if (count($progress) > 0)
                    <h2>L'avancement</h2>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Statut</th>
                                    <th>Notes</th>
                                    <th>Créé</th>
                                    <th>Modifié</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($progress as $progress)
                                    <tr>
                                        <td>{{ $progress->id }}</td>
                                        <td>{{ $progress->progress_status }}</td>
                                        <td>{{ $progress->notes }}</td>
                                        <td>{{ $progress->created_at }}</td>
                                        <td>{{ $progress->updated_at }}</td>
                                        <td class="d-flex justify-content-around">
                                            <a {{-- href="{{ route('progress.show', $progress->id) }}" --}}> <i class="fas fa-eye"></i>
                                            </a>
                                            <a {{-- href="{{ route('progress.edit', $progress->id) }}" --}}> <i class="fas fa-edit"></i>
                                            </a>
                                            <form {{-- action="{{ route('progress.destroy', $progress->id) }}"  --}} method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <i class="fas fa-trash"></i>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info" role="alert">
                        Pas d'avancement trouvé.
                    </div>
                @endif
            </div>
            <a {{-- href="{{ route('progress.create', $user->id) }}"  --}} class="btn btn-primary">Ajouter un progrès</a>
        </section>
    </div>

@endsection
