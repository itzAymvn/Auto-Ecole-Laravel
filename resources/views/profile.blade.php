@extends('layout.layout')

@section('title', 'Profile')

@section('content')

    <section class="profile-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8 col-12 mx-4">
                    <h2 class="text-center mb-5">Profile</h2>
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="profile-image">
                            <label for="profile-image-input">
                                @if ($user->image)
                                    <img src="{{ asset('storage/' . $user->image) }}" alt="profile image">
                                @else
                                    <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                                        alt="profile image" class="img-fluid w-50 rounded-circle">
                                @endif
                            </label>
                            <input type="file" id="profile-image-input" name="image" style="display:none;">
                        </div>
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Full name</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" required
                                value="{{ $user->fullname }}">
                            @error('fullname')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required
                                value="{{ $user->username }}">
                            @error('username')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required
                                value="{{ $user->email }}">
                            @error('email')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary py-2">Update</button>
                        </div>
                    </form>
                </div>

            </div>

            {{-- section for change password --}}

            <div class="row justify-content-center mt-5">
                <div class="col-lg-6 col-md-8 col-12 mx-4">
                    <h2 class="text-center mb-5">Change Password</h2>
                    <form action="" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="old_password" class="form-label">Old Password</label>
                            <input type="password" class="form-control" id="old_password" name="old_password" required>
                            @error('old_password')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                            @error('new_password')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                                required>
                            @error('confirm_password')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary py-2">Update</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- section for delete account --}}

            <div class="row justify-content-center mt-5">
                <div class="col-lg-6 col-md-8 col-12 mx-4">
                    <h2 class="text-center mb-5">Delete Account</h2>
                    <form action="" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            @error('password')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-danger py-2">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
