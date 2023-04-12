@extends('layout.layout')

@section('title', 'Profile')

@section('content')

    <section class="profile-section py-1">

        <div class="container">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div>
                <h1 class="text-center">Bienvenue <span class="text-primary">{{ session('user')->name }}</span>!</h1>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-3">
                                <div class="flex-shrink-0">
                                    @if (session('user')->image)
                                        <img src="{{ asset('storage/profiles/' . session('user')->image) }}" alt="profile"
                                            class="rounded-circle" width="60" height="60">
                                    @else
                                        <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                                            alt="profile" class="rounded-circle" width="60" height="60">
                                    @endif
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mb-0">{{ session('user')->name }}</h5>
                                    <p class="mb-0">{{ session('user')->email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="mb-3">Mes informations</h5>
                            <form action="{{ route('profile') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">


                                            <label for="image" class="form-label">
                                                @if (session('user')->image)
                                                    <img src="{{ asset('storage/profiles/' . session('user')->image) }}"
                                                        alt="profile" class="rounded-circle" width="60" height="60">
                                                @else
                                                    <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                                                        alt="profile" class="rounded-circle" width="60" height="60">
                                                @endif
                                            </label>
                                            <input type="file" name="image" id="image" class="form-control d-none">
                                            @error('image')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nom</label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                value="{{ session('user')->name }}">
                                            @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" name="email" id="email" class="form-control"
                                                value="{{ session('user')->email }}">
                                            @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Téléphone</label>
                                            <input type="text" name="phone" id="phone" class="form-control"
                                                value="{{ session('user')->phone }}">
                                            @error('phone')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Adresse</label>
                                            <input type="text" name="address" id="address" class="form-control"
                                                value="{{ session('user')->address }}">
                                            @error('address')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="birthdate" class="form-label">Date de naissance</label>
                                            <input type="date" name="birthdate" id="birthdate" class="form-control"
                                                value="{{ session('user')->birthdate }}">
                                            @error('birthdate')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
