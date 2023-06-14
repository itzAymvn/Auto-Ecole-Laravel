@extends('layout.admin')

@section('title', 'Voir un véhicule')

@section('content')

    <main class="d-flex justify-content-between  flex-column mb-5">

        <x-alerts></x-alerts>

        <h5
            class="text-center my-3 bg-light p-3 rounded-3 d-flex justify-content-between align-items-center flex-wrap gap-3">
            <span>
                <i class="fas fa-car"></i>
                Vous êtes en train de voir le véhicule:
                <span class="text-primary">{{ $vehicle->matricule }}</span>
            </span>

            <a href="{{ route('vehicles.index') }}" class="btn btn-primary float-end">
                <i class="fas fa-arrow-left"></i>
                Retour
            </a>
        </h5>

        {{-- Vehicle details section --}}
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>
                                <strong>
                                    <i class="fas fa-id-card"></i>
                                    ID:
                                </strong>
                            </td>
                            <td>{{ $vehicle->id }}</td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                    <i class="fas fa-car"></i>
                                    Matricule:
                                </strong>
                            </td>
                            <td>{{ $vehicle->matricule }}</td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                    <i class="fas fa-car"></i>
                                    Modèle:
                                </strong>
                            </td>
                            <td>{{ $vehicle->model }}</td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                    <i class="fas fa-image"></i>
                                    Image:
                                </strong>
                            </td>
                            <td>
                                @empty($vehicle->image)
                                    <img src="{{ asset('images/default-vehicle.jpg') }}" alt="Image" width="100">
                                @else
                                    <img src="{{ asset('storage/vehicles/' . $vehicle->image) }}" alt="Image" width="100">
                                @endempty
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Exams section --}}
        <div class="row mt-5">
            <div class="col-md-12">
                <h5
                    class="text-center my-3 bg-light p-3 rounded-3 d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <span>
                        <i class="fas fa-car"></i>
                        Liste des examens du véhicule:
                        <span class="text-primary">{{ $vehicle->matricule }}</span>
                    </span>
                </h5>
                @if ($exams->count() > 0)

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Date</th>
                                <th>Heure</th>
                                <th>Emplacement</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($exams as $exam)
                                <tr>
                                    <td>
                                        <a href="{{ route('exams.show', $exam->id) }}">
                                            {{ $exam->exam_title }}
                                        </a>
                                    </td>
                                    <td>{{ $exam->exam_date }}</td>
                                    <td>{{ $exam->exam_time }}</td>
                                    <td>{{ $exam->exam_location }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-info" role="alert">
                        Il n'y a aucun examen pour ce véhicule.
                    </div>
                @endif
                <div class="d-flex mt-3">
                    <a href="{{ route('exams.create', ['vehicle_id' => $vehicle->id]) }}" class="btn btn-primary">
                        <i class="fas fa-plus-circle"></i>
                        Ajouter un examen
                    </a>
                </div>
            </div>
        </div>
    </main>
@endsection
