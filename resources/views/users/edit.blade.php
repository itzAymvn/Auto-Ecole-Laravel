@extends('layout.layout')

@section('title', 'Edit User')

@section('content')

    <main class="d-flex justify-content-between flex-column">
        @include('users.panel')
        <section class="manage-users-section container py-5">
            <div class="d-flex justify-content-between mb-3">
                <h2>Modifier l'utilisateur</h2>
                <a href="{{ route('users.index') }}" class="btn btn-primary d-flex align-items-center">
                    Retour
                </a>
            </div>
            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="fullname" class="form-label">Nom Complet</label>
                    <input type="text" class="form-control" id="fullname" name="fullname" value="{{ $user->fullname }}">

                    @error('fullname')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Nom d'utilisateur</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}">

                    @error('username')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                </div>

                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror


                @if ($user->profile)
                    <img src="{{ asset('storage/profiles/' . $user->profile) }}" alt="Profile Image" width="100"
                        class="mb-3 rounded-circle">
                @endif

                <div class="mb-3">

                    <label for="profile" class="form-label">Image</label>
                    <input class="form-control" type="file" id="profile" name="profile">

                    @error('profile')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Modifier</button>
            </form>
        </section>
    </main>

@endsection
