@extends('layout.layout')

@section('title', 'Gérer les examens')

@section('content')
    <main class="d-flex justify-content-between flex-row">

        <section class="manage-users-section container py-5">
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

            @if (count($exams) > 0)
                <div class="mb-3 bg-light p-3 rounded-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2>Gérer les examens
                            <span class="badge bg-primary">{{ count($exams) }}</span>
                        </h2>
                        <a href="{{ route('exams.create') }}" class="btn btn-primary d-flex align-items-center shadow-sm">
                            Ajouter un examen
                        </a>
                    </div>
                </div>

                <div class="table-responsive table-responsive-md">
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Titre</th>
                                <th scope="col">Type</th>
                                <th scope="col">Instructor</th>
                                <th scope="col">Nb. étudiants</th>
                                <th scope="col">Date</th>
                                <th scope="col">Heure</th>
                                <th scope="col">Location</th>
                                <th scope="col">Créé à</th>
                                <th scope="col">Modifié à</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($exams as $exam)
                                <tr>
                                    <th scope="row">{{ $exam->id }}</th>
                                    <td title="Cliquez pour voir les détails">
                                        <a href="{{ route('exams.show', $exam->id) }}">
                                            {{ $exam->exam_title }}
                                        </a>
                                    </td>
                                    <td>
                                        @if ($exam->exam_type === 'drive')
                                            <span class="badge bg-primary">Conduite</span>
                                        @else
                                            <span class="badge bg-primary">Code</span>
                                        @endif
                                    </td>
                                    <td title="Cliquez pour voir les détails">
                                        <a href="{{ route('users.show', $exam->instructor_id) }}">
                                            {{ $exam->instructor_name }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ $exam->students_count }}/5
                                    </td>
                                    <td>{{ $exam->exam_date }}</td>
                                    <td>{{ $exam->exam_time }}</td>
                                    <td>{{ $exam->exam_location }}</td>
                                    <td>{{ $exam->created_at }}</td>
                                    <td>{{ $exam->updated_at }}</td>
                                    <td>
                                        <div class="d-flex justify-content-around">
                                            <a href="{{ route('exams.show', $exam->id) }}"
                                                class="d-flex align-items-center shadow-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>


                                            <a href="{{ route('exams.edit', $exam->id) }}"
                                                class="d-flex align-items-center shadow-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('exams.destroy', $exam->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link p-0">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- <div class="d-flex justify-content-center">
                    {{ $users->links() }}
                </div> --}}
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
