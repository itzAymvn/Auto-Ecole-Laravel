@extends('layout.admin')

@section('title', 'Créer un paiement')

@section('content')

    <div class=" mt-3 mb-5">

        <x-alerts></x-alerts>

        <h5 class="text-center bg-light p-3 rounded-3 d-flex justify-content-between align-items-center flex-wrap gap-3">
            <span>
                <i class="fas fa-money-bill-wave"></i>
                Créer une dépense
            </span>
        </h5>

        <form action="{{ route('spendings.store') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label for="type">
                    <i class="fas fa-money-bill-wave"></i>
                    Type:
                </label>
                <select name="type" id="type" class="form-control">
                    <option value="other" @if (!request()->has('user_id')) selected @endif>Autre</option>
                    <option value="salary" @if (request()->has('user_id')) selected @endif>Salaire</option>
                </select>
            </div>

            <div class="form-group mb-3" id="userField" @if (!request()->has('user_id')) style="display: none;" @endif>
                <label for="user_id">
                    <i class="fas fa-user"></i>
                    Utilisateur:
                </label>
                <select name="user_id" id="user_id" class="form-control">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @if (request()->has('user_id') && request()->user_id == $user->id) selected @endif>
                            {{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="amount">
                    <i class="fas fa-coins"></i>
                    Montant:
                </label>
                <input type="text" name="amount" id="amount" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label for="description">
                    <i class="fas fa-info-circle"></i>
                    Description:
                </label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Ajouter
            </button>
        </form>

    </div>


@endsection

@push('scripts')
    <script>
        // Function to toggle the visibility of the "User" select field
        function toggleUserField() {
            var typeSelect = document.getElementById('type');
            var userField = document.getElementById('userField');

            if (typeSelect.value === 'salary') {
                userField.style.display = 'block';
            } else {
                userField.style.display = 'none';
                document.getElementById('user_id').value = null;
            }
        }

        // Attach an event listener to the "Type" select field
        document.getElementById('type').addEventListener('change', toggleUserField);

        // Call the function initially to set the initial visibility state
        toggleUserField();
    </script>
@endpush
