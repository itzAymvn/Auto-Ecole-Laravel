@extends('layout.admin')

@section('title', 'Créer un véhicule')

@section('content')

    <main class="d-flex justify-content-between  flex-column">

        <x-alerts></x-alerts>

        <h5 class="text-center my-3 bg-light p-3 rounded-3">
            <i class="fas fa-car"></i>
            <span>
                Vous êtes en train d'ajouter un nouveau véhicule

            </span>
        </h5>


        {{-- Update vehicle section --}}

        <section class="manage-vehicles-section  py-2">
            <form id="updateuserform" action="{{ route('vehicles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="matricule" class="form-label">
                        <i class="fas fa-car"></i>
                        <span>
                            Matricule
                        </span>
                    </label>
                    <input type="text" class="form-control" id="matricule" name="matricule">

                    @error('matricule')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="model" class="form-label">
                        <i class="fas fa-car"></i>
                        <span>
                            Model
                        </span>
                    </label>
                    <input type="text" class="form-control" id="model" name="model">

                    @error('matricule')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">
                        <i class="fas fa-image"></i>
                        <span>
                            Image
                        </span>
                    </label>
                    <input type="file" class="form-control" id="image" name="image">

                    @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    <span>
                        Enregistrer
                    </span>
                </button>

                <a href="{{ route('vehicles.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    <span>
                        Retour
                    </span>
                </a>
            </form>
        </section>
    </main>

@endsection
