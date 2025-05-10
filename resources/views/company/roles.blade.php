@extends('layout')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .form-floating>.form-control,
        .form-floating>.form-select {
            padding: 1.25rem 0.75rem 0.25rem;
            height: auto;
        }

        .form-floating label {
            padding: 0.5rem 0.75rem;
        }

        .modal .modal-content {
            border-radius: 12px;
        }

        .table td img {
            border-radius: 6px;
        }
    </style>

    <div class="page-body">
        <div class="container-fluid">
            <div class="row page-title">
                <div class="col-sm-6">
                    <h3>ALL ROLES</h3>
                </div>
                <div class="d-flex justify-content-end mb-3">
                    <button class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal"
                        data-bs-target="#addRoleModal">
                        <i class="fa-solid fa-user-tag me-2"></i> Add Role
                    </button>
                </div>
            </div>
        </div>

        <!-- Alert Container -->
        <div class="container mt-2" id="alertContainer"></div>


        <!-- Add Role Modal -->
        <div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="addRoleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form id="addRoleForm" action="{{ route('role.store') }}" method="POST"
                    class="modal-content shadow-lg rounded-3">
                    @csrf
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title"><i class="fa-solid fa-user-tag me-2"></i> Add Role</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Company Name Dropdown -->
                        <div class="mb-3 form-floating">
                            <select class="form-select" id="companyName" name="company_id" required>
                                <option value="" disabled selected>Select a Company</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name ?? '' }}</option>
                                @endforeach
                            </select>
                            <label for="companyName">Company Name</label>
                        </div>

                        <!-- Role Name Input -->
                        <div class="mb-3 form-floating">
                            <input type="text" class="form-control" id="roleName" name="role"
                                placeholder="Enter role name" required>
                            <label for="roleName">Role Name</label>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="addSubmitBtn">
                            <span id="addSubmitText"><i class="fa-solid fa-paper-plane me-1"></i> Submit</span>
                            <span id="addSubmitSpinner" class="d-none"><i class="fa fa-spinner fa-spin me-1"></i>
                                Saving...</span>
                        </button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Role Modal -->

        <div class="modal fade" id="editRoleModal" tabindex="-1" aria-labelledby="editRoleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form id="editRoleForm" method="POST" class="modal-content shadow-lg rounded-3">
                    @csrf
                    @method('PUT')
                    <div class="modal-header bg-warning text-white">
                        <h5 class="modal-title"><i class="fa-solid fa-pen me-2"></i> Edit Role</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="editRoleId" name="id">
                        <div class="mb-3 form-floating">
                            <select class="form-select" id="editCompanyName" name="company_id" required>
                                <option value="" disabled>Select a Company</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}">
                                        {{ $company->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="editCompanyName">Company Name</label>
                        </div>

                        <div class="mb-3 form-floating">
                            <input type="text" class="form-control" id="editRoleName" name="role"
                                placeholder="Enter role name" required>
                            <label for="editRoleName">Role Name</label>
                        </div>

                        {{-- <div class="mb-3 form-floating">
                            <input type="text" class="form-control" id="editRoleDisplayName" name="name"
                                placeholder="Display name" required>
                            <label for="editRoleDisplayName">Display Name</label>
                        </div> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="editSubmitBtn">
                            <span id="editSubmitText"><i class="fa-solid fa-save me-1"></i> Update</span>
                            <span id="editSubmitSpinner" class="d-none"><i class="fa fa-spinner fa-spin me-1"></i>
                                Updating...</span>
                        </button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Role Table -->
        <div class="container-fluid table-space basic_table">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="bg-light">
                                    <tr class="b-b-primary">
                                        <th class="text-center">Sr.No</th>
                                        <th>Company Name</th>
                                        <th>Role Name</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $role->company->name ?? '' }}</td>
                                            <td>{{ $role->role }}</td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <button type="button" class="btn btn-sm btn-warning edit-role-btn"
                                                        data-id="{{ $role->id }}" data-role="{{ $role->role }}"
                                                        data-company-id="{{ $role->company_id }}"
                                                        data-name="{{ $role->name }}"
                                                        data-update-url="{{ route('role.update', $role->id) }}">
                                                        <i class="fa-solid fa-pen"></i> Edit
                                                    </button>
                                                    <form action="{{ route('role.destroy', $role->id) }}" method="POST"
                                                        class="delete-role-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="fa-solid fa-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function showToast(message, type = 'success') {
            const alertType = type === 'success' ? 'alert-success' : 'alert-danger';
            const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
            const toast = `
                <div class="alert ${alertType} alert-dismissible fade show custom-alert shadow-sm mt-2" role="alert">
                    <i class="fa-solid ${icon} me-2"></i> ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>`;
            $('#alertContainer').append(toast);
            setTimeout(() => $('.custom-alert').alert('close'), 2000);
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function() {
            $('.edit-role-btn').on('click', function() {
                $('#editRoleId').val($(this).data('id'));
                $('#editCompanyName').val($(this).data('company-id'));
                $('#editRoleName').val($(this).data('role'));
                $('#editRoleDisplayName').val($(this).data('name'));
                $('#editRoleForm').attr('action', $(this).data('update-url'));
                $('#editRoleModal').modal('show');
            });

            $('#addRoleForm').on('submit', function(e) {
                e.preventDefault();
                const $btn = $('#addSubmitBtn');
                $btn.prop('disabled', true);
                $('#addSubmitText').addClass('d-none');
                $('#addSubmitSpinner').removeClass('d-none');

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function() {
                        $('#addRoleModal').modal('hide');
                        showToast('Role added successfully.');
                        setTimeout(() => location.reload(), 1000);
                    },
                    error: function(xhr) {
                        const errors = xhr.responseJSON?.errors;
                        const errorMsg = errors ? Object.values(errors).flat().join('<br>') :
                            'Something went wrong!';
                        showToast(errorMsg, 'error');
                    },
                    complete: function() {
                        $btn.prop('disabled', false);
                        $('#addSubmitText').removeClass('d-none');
                        $('#addSubmitSpinner').addClass('d-none');
                    }
                });
            });

            $('#editRoleForm').on('submit', function(e) {
                e.preventDefault();
                const $btn = $('#editSubmitBtn');
                $btn.prop('disabled', true);
                $('#editSubmitText').addClass('d-none');
                $('#editSubmitSpinner').removeClass('d-none');

                const formData = new FormData(this);
                formData.append('_method', 'PUT');

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function() {
                        $('#editRoleModal').modal('hide');
                        showToast('Role updated successfully.');
                        setTimeout(() => location.reload(), 1000);
                    },
                    error: function(xhr) {
                        const errors = xhr.responseJSON?.errors;
                        const errorMsg = errors ? Object.values(errors).flat().join('<br>') :
                            'Something went wrong!';
                        showToast(errorMsg, 'error');
                    },
                    complete: function() {
                        $btn.prop('disabled', false);
                        $('#editSubmitText').removeClass('d-none');
                        $('#editSubmitSpinner').addClass('d-none');
                    }
                });
            });

            $('.delete-role-form').on('submit', function(e) {
                e.preventDefault();
                if (!confirm('Are you sure?')) return;
                const $form = $(this);
                $.ajax({
                    url: $form.attr('action'),
                    method: 'POST',
                    data: $form.serialize(),
                    success: function() {
                        showToast('Role deleted successfully.');
                        setTimeout(() => location.reload(), 1000);
                    },
                    error: function() {
                        showToast('Failed to delete role.', 'error');
                    }
                });
            });
        });
    </script>
@endsection
