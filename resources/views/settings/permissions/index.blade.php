@extends('layout.admin')

@section('title', 'Gestion des permissions')

@section('content')

    <h5 class="text-center my-3 bg-light p-3 rounded-3 d-flex justify-content-between align-items-center flex-wrap gap-3">
        <span>
            <i class="fas fa-user-lock"></i>
            <span>Gestion des permissions des rôles</span>
        </span>
    </h5>

    <div class="alert alert-info">
        Ci-dessous vous pouvez gérer les permissions des rôles.
    </div>

    @foreach ($permissions as $role => $rolePermissions)
        <h5 class="text-center my-3 bg-light p-3 rounded-3 d-flex justify-content-between align-items-center flex-wrap gap-3 border border-2 border-primary"
            data-bs-toggle="collapse" data-bs-target="#permissions_{{ $role }}" aria-expanded="false"
            aria-controls="permissions_{{ $role }}">
            <span>
                <i class="fas fa-user-tag"></i>
                <span>{{ ucfirst($role) }}</span>
            </span>
            <i class="fas fa-chevron-down"></i>
        </h5>

        <div id="permissions_{{ $role }}" class="collapse">
            @foreach ($rolePermissions as $resource => $resourcePermissions)
                <h5>
                    Les permissions pour {{ ucfirst($resource) }}
                </h5>
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>
                                    <i class="fas fa-user-tag"></i>
                                    Permission
                                </th>
                                <th>
                                    <i class="fas fa-toggle-on"></i>
                                    Status
                                </th>
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

@endsection




@push('scripts')
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
                        toastr.success(response.message);
                    },
                    error: function(xhr, status, error) {
                        toastr.error(xhr.responseJSON.message);
                    }
                });
            });
        });
    </script>
@endpush
