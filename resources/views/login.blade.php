@extends('layout.layout')

@section('title', 'Login')

@section('content')
    <section class="login-section py-5 h-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8 col-12 mx-4">
                    <h2 class="text-center mb-5">Se connecter</h2>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse email</label>
                            <input type="email" class="form-control" id="email" name="email" required autofocus
                                autocomplete="email" value="{{ old('email') }}" placeholder="Adresse email">
                            @error('email')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" placeholder="Mot de passe" id="password"
                                    name="password" required autocomplete="current-password" aria-label="Mot de passe"
                                    aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button id="togglePassword"
                                        class="
                                        border border-top border-end border-bottom
                                        btn btn-outline-secondary"
                                        type="button"><i class="bi bi-eye"></i></button>
                                </div>
                            </div>
                            @error('password')
                                <div class="alert alert-danger mt-2">{{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="d-grid">
                            <button type="submit" disabled id="login" class="btn btn-primary py-2">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const email = document.querySelector('#email');
            const password = document.querySelector('#password');
            const login = document.querySelector('#login');
            const togglePassword = document.querySelector('#togglePassword');

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            const validateForm = () => {
                if (emailRegex.test(email.value) && password.value.length >= 8) {

                    // Enable login button
                    login.removeAttribute('disabled');

                    // Remove invalid class
                    email.classList.remove('is-invalid');
                    password.classList.remove('is-invalid');

                    // Add valid class
                    email.classList.add('is-valid');
                    password.classList.add('is-valid');
                } else {

                    // Disable login button
                    login.setAttribute('disabled', true);

                    // IF email is valid
                    if (emailRegex.test(email.value)) {

                        // Remove invalid class and add valid class
                        email.classList.remove('is-invalid');
                        email.classList.add('is-valid');
                    } else {

                        // Remove valid class and add invalid class
                        email.classList.remove('is-valid');
                        email.classList.add('is-invalid');
                    }

                    // IF password is valid
                    if (password.value.length >= 8) {

                        // Remove invalid class and add valid class
                        password.classList.remove('is-invalid');
                        password.classList.add('is-valid');

                    } else {

                        // Remove valid class and add invalid class
                        password.classList.remove('is-valid');
                        password.classList.add('is-invalid');
                    }
                }
            };

            form.addEventListener('keyup', validateForm);
            togglePassword.addEventListener('click', function() {
                if (password.type === 'password') {
                    password.type = 'text';
                } else {
                    password.type = 'password';
                }
            });
        });
    </script>
@endpush
