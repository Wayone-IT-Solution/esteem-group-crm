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
                    <h3>ALL STATUS</h3>
                </div>
                <div class="d-flex justify-content-end mb-3">
                    <button class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal"
                        data-bs-target="#addDepartmentModal">
                        <i class="fa-solid fa-building me-2"></i> Add Status
                    </button>
                </div>
            </div>
        </div>

        <div class="container mt-2" id="alertContainer"></div>

        <!-- Add Status Modal -->
        <div class="modal fade" id="addDepartmentModal" tabindex="-1" aria-labelledby="addDepartmentModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form id="addDepartmentForm" action="{{ route('status.store') }}" method="POST"
                    class="modal-content shadow-lg rounded-3">
                    @csrf
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title text-white"><i class="fa-solid fa-building me-2"></i> Add Status</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 form-floating">
                            <select class="form-select" id="companyName" name="company_id" required>
                                <option value="" disabled selected>Select a Company</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name ?? '' }}</option>
                                @endforeach
                            </select>
                            <label for="companyName">Company Name</label>
                        </div>
                        <div class="mb-3 form-floating">
                            <input type="text" class="form-control" id="statusName" name="status"
                                placeholder="Enter Status" required>
                            <label for="statusName">Status</label>
                        </div>
                    </div>
                    <span id="editSubmitSpinner_success"></span>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="addSubmitBtn">
                            <span id="addSubmitText"><i class="fa-solid fa-paper-plane me-1"></i> Submit</span>
                            <span id="addSubmitSpinner" class="d-none"><i class="fa fa-spinner fa-spin me-1"></i>
                                Saving...</span>
                        </button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Status Modal -->
        <div class="modal fade" id="editDepartmentModal" tabindex="-1" aria-labelledby="editDepartmentModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form id="editDepartmentForm" method="POST" class="modal-content shadow-lg rounded-3">
                    @csrf
                    @method('PUT')
                    <div class="modal-header bg-warning text-white">
                        <h5 class="modal-title text-white"><i class="fa-solid fa-pen me-2"></i> Edit Status</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="editDepartmentId" name="id">
                        <div class="mb-3 form-floating">
                            <select class="form-select" id="editCompanyName" name="company_id" required>
                                <option value="" disabled>Select a Company</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                            <label for="editCompanyName">Company Name</label>
                        </div>
                        <div class="mb-3 form-floating">
                            <input type="text" class="form-control" id="editStatusName" name="status"
                                placeholder="Enter Status" required>
                            <label for="editStatusName">Status</label>
                        </div>
                    </div>
                    <span id="editSubmitSpinner_success1"></span>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="editSubmitBtn">
                            <span id="editSubmitText"><i class="fa-solid fa-save me-1"></i> Update</span>
                            <span id="editSubmitSpinner" class="d-none"><i class="fa fa-spinner fa-spin me-1"></i>
                                Updating...</span>
                        </button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Status Table -->
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
                                        <th>Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($status as $statusItem)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $statusItem->company->name ?? '' }}</td>
                                            <td>{{ $statusItem->status }}</td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <button type="button"
                                                        class="btn btn-sm btn-warning edit-department-btn"
                                                        data-id="{{ $statusItem->id }}"
                                                        data-status="{{ $statusItem->status }}"
                                                        data-company-id="{{ $statusItem->company_id }}"
                                                        data-update-url="{{ route('status.update', $statusItem->id) }}">
                                                        <i class="fa-solid fa-pen"></i>
                                                    </button>
                                                    <form action="{{ route('status.destroy', $statusItem->id) }}"
                                                        method="POST" class="delete-department-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="fa-solid fa-trash"></i>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function showToast(message, type = 'success') {
            const alertType = type === 'success' ? 'alert-success' : 'alert-danger';
            const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
            const toast =
                `<div class="alert ${alertType} alert-dismissible fade show custom-alert " role="alert"><i class="fa-solid ${icon} me-2"></i> ${message}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`;
            $('#editSubmitSpinner_success').append(toast);
            setTimeout(() => $('.custom-alert').alert('close'), 2000);
        }

        function showToast1(message, type = 'success') {
            const alertType = type === 'success' ? 'text-success' : 'alert-danger';
            const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
            const toast =
                `<div class="alert ${alertType} alert-dismissible fade show custom-alert " role="alert"><i class="fa-solid ${icon} me-2"></i> ${message}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`;
            $('#editSubmitSpinner_success1').append(toast);
            setTimeout(() => $('.custom-alert').alert('close'), 2000);
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function() {
            $('.edit-department-btn').on('click', function() {
                $('#editDepartmentId').val($(this).data('id'));
                $('#editCompanyName').val($(this).data('company-id'));
                $('#editStatusName').val($(this).data('status'));
                $('#editDepartmentForm').attr('action', $(this).data('update-url'));
                $('#editDepartmentModal').modal('show');
            });

            $('#addDepartmentForm').on('submit', function(e) {
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
                        showToast('Status added successfully.');
                        setTimeout(() => location.reload(), 2000);
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

            $('#editDepartmentForm').on('submit', function(e) {
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
                        showToast1('Status updated successfully.');
                        setTimeout(() => {
                            $('#editDepartmentModal').modal('hide');
                            location.reload();
                        }, 2000);
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

            $('.delete-department-form').on('submit', function(e) {
                e.preventDefault();
                if (!confirm('Are you sure?')) return;
                const $form = $(this);
                $.ajax({
                    url: $form.attr('action'),
                    method: 'POST',
                    data: $form.serialize(),
                    success: function() {
                        showToast('Status deleted successfully.');
                        setTimeout(() => location.reload(), 1000);
                    },
                    error: function() {
                        showToast('Failed to delete status.', 'error');
                    }
                });
            });
        });
    </script>
@endsection
