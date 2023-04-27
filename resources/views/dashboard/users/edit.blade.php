@extends('layout.layout')

@section('title', 'Modifier l\'utilisateur')

@section('content')

    <main class="d-flex justify-content-between container flex-column">

        <h5 class="text-center my-3 bg-light p-3 rounded-3">
            <i class="fas fa-user"></i>
            <span>
                Vous êtes en train de modifier l'utilisateur
                <a href="{{ route('users.show', $user->id) }}">
                    {{ $user->name }}
                </a>
            </span>
        </h5>

        <x-alerts></x-alerts>

        <h5 class="text-center my-3">
            <hr class="my-0 my-3 bg-dark">
            <div>
                <i class="fas fa-user-cog"></i>
                <span>
                    Qu'est ce que vous voulez faire ?
                </span>
            </div>
            <hr class="my-0 my-3 bg-dark">
        </h5>

        {{-- Update user section --}}

        <section class="manage-users-section container py-2">
            <div class="d-flex justify-content-between mb-3">
                <h5 data-bs-target="#updateuserform" data-bs-toggle="collapse" role="button" aria-expanded="false"
                    aria-controls="updateuserform">
                    <i class="fas fa-user-edit"></i>
                    <span>
                        Modifier l'utilisateur
                    </span>
                </h5>
            </div>
            <form class="collapse multi-collapse" id="updateuserform" action="{{ route('users.update', $user->id) }}"
                method="POST" enctype="multipart/form-data">
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
                            <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                                alt="Profile Image" width="100" height="100" class="mb-3 rounded-circle">
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

        <hr>
        {{-- Delete user section --}}

        <section class="delete-user-section container py-2">
            <div class="d-flex justify-content-between mb-3">
                <h5 data-bs-target="#deleteuserform" data-bs-toggle="collapse" role="button" aria-expanded="false"
                    aria-controls="deleteuserform">
                    <i class="fas fa-trash"></i>
                    <span>
                        Supprimer l'utilisateur
                    </span>
                </h5>
            </div>
            <form class="collapse multi-collapse" id="deleteuserform" action="{{ route('users.destroy', $user->id) }}"
                method="POST">
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
        </section>

        <hr>
        {{-- More data section --}}

        <section class="container py-2">
            <div class="d-flex justify-content-between mb-3">
                <h5 data-bs-target="#moredata" data-bs-toggle="collapse" role="button" aria-expanded="false"
                    aria-controls="moredata">
                    <i class="fas fa-trash"></i>
                    <span>
                        Voir plus d'informations
                    </span>
                </h5>
            </div>
            <div class="collapse multi-collapse" id="moredata">
                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="/aaa">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <span>
                                Les seances
                            </span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="/aaa">
                            <i class="fa-solid fa-car"></i>
                            <span>
                                Les examens
                            </span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="/aaa">
                            <i class="fa-regular fa-credit-card"></i>
                            <span>
                                Les paiements
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </section>

        {{-- Back button --}}

        <section class="container py-2">
            <div class="d-flex justify-content-between mb-3">
                <a href="{{ route('users.index') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i>
                    <span>
                        Retour
                    </span>
                </a>
            </div>
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
