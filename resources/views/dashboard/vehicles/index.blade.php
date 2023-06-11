@extends('layout.admin')

@section('title', 'Gérer les véhicules')

@section('content')
    <main class="d-flex justify-content-between flex-row">
        {{-- @include('dashboard.panel') --}}

        <section class="manage-vehicle-section w-100 py-3">

            <x-alerts></x-alerts>

            @if (count($vehicles) > 0)
                <div class="mb-3 bg-light p-3 rounded-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>
                            <i class="fas fa-car me-2"></i>
                            Gérer les véhicules ({{ count($vehicles) }})
                        </h5>
                        <a href="{{ route('vehicles.create') }}" class="btn btn-primary d-flex align-items-center shadow-sm">
                            <i class="fa-solid fa-circle-plus me-2"></i>
                            Ajouter un véhicule
                        </a>
                    </div>
                </div>

                <div class="table-responsive table-responsive-md">
                    <table class="table table-bordered table-responsive align-middle">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Matricule</th>
                                <th scope="col">Modèle</th>
                                <th scope="col">Image</th>
                                <th scope="col">Les actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehicles as $vehicle)
                                <tr>
                                    <th scope="row">{{ $vehicle->id }}</th>
                                    <td>
                                        <a href="{{ route('vehicles.show', $vehicle->id) }}">
                                            {{ $vehicle->matricule }}
                                        </a>
                                    </td>
                                    <td>{{ $vehicle->model }}</td>
                                    <td>
                                        @if ($vehicle->image)
                                            <img src="{{ asset('storage/vehicles/' . $vehicle->image) }}"
                                                alt="Image du véhicule" class="img-fluid" width="100">
                                        @else
                                            <img src="{{ asset('images/default-vehicle.jpg') }}" alt="Image du véhicule"
                                                class="img-fluid" width="100">
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('vehicles.edit', $vehicle->id) }}"
                                                class="btn btn-primary btn-sm me-1">
                                                <i class="fa-solid fa-pen me-1"></i>
                                                Modifier
                                            </a>
                                            <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fa-solid fa-circle-xmark me-2"></i>
                                                    Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    Aucun véhicule trouvé
                </div>

                <a href="{{ route('vehicles.create') }}" class="btn btn-primary d-flex align-items-center shadow-sm">
                    <i class="fa-solid fa-circle-plus me-2"></i>
                    Ajouter un véhicule
                </a>
            @endif
        </section>
    </main>

@endsection
