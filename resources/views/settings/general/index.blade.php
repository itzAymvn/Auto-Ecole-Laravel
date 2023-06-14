@extends('layout.admin')

@section('title', 'Les paramètres généraux')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 my-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">General Settings</h4>
                </div>
                <div class="card-body">
                    <form id="settings-form">
                        <div class="alert alert-info">
                            <strong>Info!</strong> Si vous laissez le champ vide, il résultera en la valeur par défaut
                        </div>
                        @foreach ($general as $setting)
                            <div class="form-group mb-3">

                                <label for="{{ $setting->name }}" class="text-capitalize form-label">
                                    {{ $setting->title }} - <span class="text-muted">Default:
                                        {{ $setting->default_value }}</span>
                                </label>

                                <div class="input-group">
                                    <input type="text" class="form-control" id="{{ $setting->id }}"
                                        name="{{ $setting->name }}"
                                        value="{{ empty($setting->value) ? $setting->default_value : $setting->value }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary apply-setting"
                                            data-setting-id="{{ $setting->id }}">Apply</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection



@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.apply-setting').on('click', function(event) {
                event.preventDefault();

                var settingId = $(this).data('setting-id');
                var settingValue = $('#' + settingId).val();

                $.ajax({
                    url: "{{ route('general.update', ". $setting->id .") }}",
                    type: 'POST',
                    data: {
                        _method: 'PUT',
                        _token: '{{ csrf_token() }}',
                        setting_id: settingId,
                        setting_value: settingValue
                    },
                    success: function(response) {
                        if (response.warning) {
                            toastr.warning(response.warning);
                        } else if (response.message) {
                            toastr.success(response.message);
                        } else if (response.error) {
                            toastr.error(response.error);
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error(xhr.responseJSON.message);
                    }
                });
            });
        });
    </script>
@endpush
