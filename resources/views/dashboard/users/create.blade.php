@extends('layout.admin')

@section('title', 'Créer un utilisateur')

@section('content')

    <main class="d-flex justify-content-between flex-column">
        <section class="manage-users-section  py-5">

            <x-alerts></x-alerts>

            <div class="d-flex justify-content-between mb-3">
                <h2>Créer un utilisateur</h2>
                <a href="{{ route('users.index') }}" class="btn btn-primary d-flex align-items-center">
                    Retour
                </a>
            </div>
            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nom Complet</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">

                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">
                        Adresse email
                    </label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">

                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Telephone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">

                    @error('phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Adresse</label>
                    <input type="string" class="form-control" id="address" name="address" value="{{ old('address') }}">
                    @error('address')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Date de naissance</label>
                    <input type="date" class="form-control" id="birthdate" name="birthdate"
                        value="{{ old('birthdate') }}">
                    @error('birthdate')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password">
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Confirmer le mot de passe</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    @error('password_confirmation')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="type" class="form-label">Type</label>
                    <select class="form-select" aria-label="Default select example" name="type">
                        <option value="admin">Admin</option>
                        <option value="instructor">Instructor</option>
                        <option value="student" selected>Student</option>
                    </select>
                    @error('type')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Photo</label>
                    <input type="file" class="form-control" id="image" name="image">
                    @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Créer</button>
            </form>
        </section>
    </main>

@endsection

@push('scripts')
    <script>
        const password = document.getElementById('password');
        const passwordConfirmation = document.getElementById('password_confirmation');

        passwordConfirmation.addEventListener('input', () => {
            if (password.value !== passwordConfirmation.value) {
                passwordConfirmation.setCustomValidity('Les mots de passe ne correspondent pas');
            } else {
                passwordConfirmation.setCustomValidity('');
            }
        });

        password.addEventListener('input', () => {
            if (password.value !== passwordConfirmation.value) {
                passwordConfirmation.setCustomValidity('Les mots de passe ne correspondent pas');
            } else {
                passwordConfirmation.setCustomValidity('');
            }
        });
    </script>
@endpush
