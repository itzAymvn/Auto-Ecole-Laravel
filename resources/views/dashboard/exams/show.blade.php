@extends('layout.admin')

@section('title', 'Page d\'examen')

@section('content')

    <div class=" py-3">

        <x-alerts></x-alerts>

        <div class="row">
            <div class="col-md-12">
                <h5
                    class="text-center bg-light p-3 rounded-3 d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <span>
                        <i class="fas fa-clipboard-list"></i>
                        Vous êtes sur l'examen:
                        <span class="text-primary">{{ $exam->exam_title }} </span>
                    </span>

                    <a href="{{ route('exams.index') }}" class="btn btn-primary float-end">
                        <i class="fas fa-arrow-left"></i>
                        Retour
                    </a>
                </h5>
                <table class="table table-responsive table-bordered">
                    <tbody>
                        <tr>
                            <td>
                                <strong>
                                    <i class="fas fa-user"></i>
                                    L'instructeur:
                                </strong>
                            </td>
                            <td>
                                <a href="{{ route('users.show', $exam->instructor_id) }}">
                                    {{ $instructor->name }}
                                </a>
                            </td>
                        </tr>
                        @if ($exam->exam_type === 'drive')
                            <tr>
                                <td>
                                    <strong>
                                        <i class="fas fa-car"></i>
                                        Le véhicule:
                                    </strong>
                                </td>
                                <td>
                                    <a>
                                        {{ $vehicle->model }}
                                    </a>
                                </td>
                            </tr>
                        @endif
                        <tr>
                            <td>
                                <strong>
                                    <i class="fas fa-clipboard-list"></i>
                                    Titre de l'examen:
                                </strong>
                            </td>
                            <td>{{ $exam->exam_title }}</td>
                        </tr>
                        <tr>
                            <td title="Conduite ou Code">
                                <strong>
                                    <i class="fas fa-clipboard-list"></i>
                                    Type d'examen:
                                </strong>
                            </td>
                            <td>
                                @if ($exam->exam_type === 'drive')
                                    <span class="badge bg-primary">Conduite</span>
                                @else
                                    <span class="badge bg-primary">Code</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                    <i class="fas fa-map-marker-alt"></i>
                                    Lieu de l'examen:
                                </strong>
                            </td>
                            <td>{{ $exam->exam_location }}</td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                    <i class="fas fa-calendar-alt"></i>
                                    Date de l'examen:
                                </strong>
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($exam->exam_date)->format('d/m/Y') }}
                                à
                                {{ \Carbon\Carbon::parse($exam->exam_time)->format('H:i') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h5
                    class="text-center bg-light p-3 rounded-3 d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <span>
                        <i class="fas fa-user"></i>
                        Les étudiants inscrits à l'examen:
                        <span class="text-primary">{{ $students->count() }}/5</span>
                    </span>
                </h5>

                @if ($students->count() === 5)
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i>
                        Vous avez atteint le nombre maximum d'étudiants pour cet examen.
                    </div>
                @endif

                @if ($students->count() > 0)
                    <div class="card">
                        <div class="card-body">
                            @foreach ($students as $user)
                                <div class="d-flex justify-content-between align-items-center mb-1 flex-wrap">
                                    <div class="d-flex align-items-center">
                                        @empty($user->image)
                                            <img src="{{ asset('images/default-user.jpg') }}" alt="Image" width="50"
                                                height="50" class="me-2 rounded-circle">
                                        @else
                                            <img src="{{ asset('storage/profiles/' . $user->image) }}" alt="Image"
                                                width="50" height="50" class="me-2 rounded-circle">
                                        @endempty
                                        <div>
                                            <a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a>
                                            <p class="text-muted mb-0">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                    <div>
                                        @isset($user->pivot->result)
                                            <h3 class="badge bg-success">
                                                <i class="fas fa-check"></i>
                                                {{ $user->pivot->result }}
                                            </h3>
                                        @else
                                            <h3 class="badge bg-warning">
                                                <i class="fas fa-times"></i>
                                                Pas encore noté
                                            </h3>
                                        @endisset
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning">
                        <span class="text-danger">
                            <i class="fas fa-exclamation-triangle"></i>
                            Aucun étudiant n'est inscrit à cet examen.
                        </span>
                        <br>
                        <span class="text-danger">
                            <i class="fas fa-exclamation-triangle"></i>
                            Vous pouvez ajouter des étudiants à cet examen en cliquant sur le bouton
                            <span class="badge bg-primary">
                                <i class="fas fa-edit"></i>
                                Modifier
                            </span>
                            ci-dessous.
                        </span>
                    </div>
                @endif
            </div>
        </div>
        <a href="{{ route('exams.edit', $exam->id) }}" class="btn btn-primary mt-3">
            <i class="fas fa-edit"></i>
            Modifier les informations de l'examen
        </a>
    </div>

@endsection
