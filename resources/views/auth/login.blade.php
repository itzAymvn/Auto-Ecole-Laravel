@extends('layout.layout')

@section('title', 'Login')

@section('content')
    <section class="login-section py-5 h-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8 col-12 mx-4">
                    <h2 class="text-center mb-5">
                        <i class="fa fa-user-circle"></i>
                        Se connecter
                    </h2>

                    <x-alerts />

                    <form action="{{ route('login') }}" method="POST" id="loginForm">
                        @csrf
                        <div id="emailSection">
                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    <i class="bi bi-envelope"></i>
                                    Adresse email
                                </label>
                                <input type="email"
                                    class="form-control @if ($errors->has('email')) is-invalid @endif"
                                    value="{{ old('email') }}" id="email" name="email" required autofocus
                                    autocomplete="email" value="{{ old('email') }}" placeholder="Adresse email">
                            </div>
                            <div class="d-grid">
                                <button type="button" id="nextBtn" class="btn btn-primary py-2" disabled>
                                    <i class="bi bi-arrow-right"></i>
                                    Suivant
                                </button>
                            </div>
                        </div>
                        <div id="passwordSection" style="display: none;">
                            <div class="mb-3">
                                <label for="password" class="form-label">
                                    <i class="bi bi-lock"></i>
                                    Mot de passe
                                </label>
                                <div class="input-group mb-3">
                                    <input type="password"
                                        class="form-control @if ($errors->has('password')) is-invalid @endif"
                                        placeholder="Mot de passe" id="password" name="password" required
                                        autocomplete="current-password" aria-label="Mot de passe"
                                        aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button id="togglePassword"
                                            class="border border-top border-end border-bottom
                                            btn btn-outline-secondary"
                                            type="button">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <button type="button" id="backBtn" class="btn btn-secondary py-2 flex-fill me-2">
                                    <i class="bi bi-arrow-left"></i>
                                    Retour
                                </button>
                                <button type="submit" disabled id="loginBtn" class="btn btn-primary py-2 flex-fill">
                                    <i class="bi bi-box-arrow-in-right"></i>
                                    Se connecter
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            <div class="row justify-content-center mx-1">
                <div class="alert alert-info mt-5 col-lg-6 col-md-8 col-12 mx-4" role="alert">
                    <h4 class="alert-heading">Vous n'avez pas de compte ?</h4>
                    <p>
                        Si vous n'avez pas de compte, veuillez contacter l'administrateur du site pour en créer un.
                    </p>
                    <hr>
                    <p class="mb-0">
                        Si vous avez perdu votre mot de passe, veuillez contacter l'administrateur du site pour le
                        réinitialiser.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#nextBtn').click(function() {
                $('#emailSection').animate({
                    width: 'toggle',
                    opacity: 'toggle'
                }, 'slow', function() {
                    $('#passwordSection').animate({
                        width: 'toggle',
                        opacity: 'toggle'
                    }, 'slow', function() {
                        $('#password').focus();
                    });
                });
            });

            $('#backBtn').click(function() {
                $('#passwordSection').animate({
                    width: 'toggle',
                    opacity: 'toggle'
                }, 'slow', function() {
                    $('#emailSection').animate({
                        width: 'toggle',
                        opacity: 'toggle'
                    }, 'slow', function() {
                        $('#email').focus();
                    });
                });
            });

            $('#togglePassword').click(function() {
                var passwordInput = $('#password');
                var passwordFieldType = passwordInput.attr('type');

                if (passwordFieldType === 'password') {
                    passwordInput.attr('type', 'text');
                    $(this).html('<i class="bi bi-eye-slash"></i>');
                } else {
                    passwordInput.attr('type', 'password');
                    $(this).html('<i class="bi bi-eye"></i>');
                }
            });

            $('#email').on('input', function() {
                var email = $(this).val();
                var nextBtn = $('#nextBtn');
                var mailFormat = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;

                if (email.length > 0 && email.match(mailFormat)) {
                    nextBtn.prop('disabled', false);
                } else {
                    nextBtn.prop('disabled', true);
                }
            });

            $('#password').on('input', function() {
                var password = $(this).val();
                var loginBtn = $('#loginBtn');

                if (password.length > 0) {
                    loginBtn.prop('disabled', false);
                } else {
                    loginBtn.prop('disabled', true);
                }
            });
        });
    </script>
@endpush
