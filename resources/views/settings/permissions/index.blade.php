@extends('layout.admin')

@section('title', 'Gestion des permissions')

@section('content')

    @foreach ($permissions as $role => $rolePermissions)
        <div class="mb-4">
            <h2>{{ ucfirst($role) }} Permissions</h2>

            @foreach ($rolePermissions as $resource => $resourcePermissions)
                <h3>{{ ucfirst($resource) }}</h3>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Permission</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($resourcePermissions as $permission)
                                <tr>
                                    <td>{{ ucfirst($permission['permission']) }}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input permission-status" type="checkbox"
                                                data-permission-id="{{ $permission['id'] }}"
                                                id="status_{{ $permission['id'] }}"
                                                {{ $permission['status'] ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="status_{{ $permission['id'] }}">Enable</label>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    @endforeach

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.permission-status').on('change', function() {
                var permissionId = $(this).data('permission-id');
                var status = $(this).prop('checked') ? 1 : 0;

                $.ajax({
                    url: '/settings/permissions/' + permissionId,
                    type: 'POST',
                    data: {
                        _method: 'PUT',
                        _token: '{{ csrf_token() }}',
                        status: status
                    },
                    success: function(response) {
                        // send a notification
                        
                    },
                    error: function(xhr, status, error) {
                        console.error('Error updating permission status: ' + error);
                    }
                });
            });
        });
    </script>

@endsection
