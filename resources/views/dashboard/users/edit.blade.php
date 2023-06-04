@extends('layout.admin')

@section('title', 'Modifier l\'utilisateur')

@section('content')

    <main class="d-flex justify-content-between container flex-column">

        <h5
            class="text-center my-3 bg-light p-3 rounded-3 d-flex justify-content-between align-items-center flex-wrap gap-3">
            <span>
                <i class="fas fa-user"></i>
                Vous êtes en train de modifier l'utilisateur:
                <span class="text-primary">{{ $user->name }}</span>
            </span>

            <a href="{{ route('users.show', $user->id) }}" class="btn btn-primary float-end">
                <i class="fas fa-arrow-left"></i>
                Retour
            </a>
        </h5>

        <x-alerts></x-alerts>

        {{-- Update user section --}}

        <section class="manage-users-section container py-5">
            <div class="d-flex justify-content-between mb-3">
                <h4>
                    <i class="fas fa-user-edit"></i>
                    <span>
                        Modifier l'utilisateur
                    </span>
                </h4>
            </div>
            <form id="updateuserform" class="container" action="{{ route('users.update', $user->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">
                        <i class="fas fa-user"></i>
                        <span>Nom Complet</span>
                    </label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">

                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">
                        <i class="fas fa-envelope"></i>
                        <span>Addresse Email</span>
                    </label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">

                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">
                        <i class="fas fa-phone"></i>
                        <span>Numéro de téléphone</span>
                    </label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">

                    @error('phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Adresse</span>
                    </label>
                    <input type="string" class="form-control" id="address" name="address" value="{{ $user->address }}">

                    @error('address')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="birthdate" class="form-label">
                        <i class="fas fa-birthday-cake"></i>
                        <span>Date de naissance</span>
                    </label>
                    <input type="date" class="form-control" id="birthdate" name="birthdate"
                        value="{{ $user->birthdate }}">

                    @error('birthdate')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label" id="image-label">
                        @if ($user->image)
                            <img src="{{ asset('storage/profiles/' . $user->image) }}" alt="Profile Image" width="100"
                                height="100" class="mb-3 rounded-circle">
                        @else
                            <img src="{{ asset('images/default-user.jpg') }}" alt="Profile Image" width="100"
                                height="100" class="mb-3 rounded-circle">
                        @endif
                    </label>
                    <input class="form-control d-none" type="file" id="image" name="image">
                    @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-user-edit"></i>
                    <span>
                        Modifier l'utilisateur
                    </span>
                </button>
            </form>
        </section>

        {{-- Delete user section --}}

        <section class="delete-user-section container py-5">
            <div class="d-flex justify-content-between mb-3">
                <h4>
                    <i class="fas fa-trash"></i>
                    <span>
                        Supprimer l'utilisateur
                    </span>
                </h4>
            </div>
            <form class="container" id="deleteuserform" action="{{ route('users.destroy', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <div class="mb-3">
                    <p class="alert alert-danger d-flex flex-column">
                        <span>
                            Attention! Vous êtes sur le point de supprimer cet utilisateur. Cette action est irréversible.
                        </span>
                        <button type="submit" class="btn btn-danger mt-3 align-self-start">
                            <i class="fas fa-trash"></i>
                            <span>
                                Supprimer l'utilisateur
                            </span>
                        </button>
                    </p>
                </div>
            </form>
        </section>

    </main>

@endsection

@push('scripts')
    <script>
        const image = document.querySelector('#image');
        const imageLabel = document.querySelector('#image-label');

        image.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.addEventListener('load', function() {
                    imageLabel.innerHTML =
                        `<img src="${this.result}" alt="Profile Image" width="100" height="100" class="mb-3 rounded-circle">`;
                });
                reader.readAsDataURL(file);
            }
        });
    </script>
@endpush
