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

        #loadingOverlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Loading Overlay -->
    <div id="loadingOverlay">
        <div class="spinner-border text-light" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <!-- Add User Form -->
    <div class="card p-4 mt-4 mb-4">
        <h5 class="mb-4 d-flex align-items-center" style="color: rgb(67, 185, 178);">
            <i class="fa-solid fa-user-plus me-2"></i> Add New User
        </h5>

        <!-- Success/Error Display -->
        <div id="addUserMessage"></div>
        <div id="idProofPreview"></div>

        <form id="addUserForm" action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">

                <!-- Company -->
                <div class="col-md-6">
                    <label for="company_id" class="form-label">Company</label>
                    <select class="form-select" name="company_id" id="company_id" required>
                        <option value="">Select Company</option>
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Role -->
                <div class="col-md-6">
                    <label for="role_id" class="form-label">Designation</label>
                    <select class="form-select" name="role_id" id="role_id" required>
                        <option value="">Select Designation</option>
                    </select>
                </div>

                <!-- Department -->
                <div class="col-md-6">
                    <label for="department_id" class="form-label">Department</label>
                    <select class="form-select" name="department_id" id="department_id" required>
                        <option value="">Select Department</option>
                    </select>
                </div>

                <!-- Name -->
                <div class="col-md-6">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name"
                        required>
                </div>

                <!-- Email -->
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email"
                        required>
                </div>

                <!-- Password -->
                <div class="col-md-6">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                </div>

                <!-- Mobile Number -->
                <div class="col-md-6">
                    <label for="mobile_number" class="form-label">Mobile Number</label>
                    <input type="text" class="form-control" id="mobile_number" name="mobile_number"
                        placeholder="Enter Mobile Number" required>
                </div>

                <!-- Emergency Mobile Number -->
                <div class="col-md-6">
                    <label for="emergency_mobile_number" class="form-label">Emergency Mobile Number</label>
                    <input type="text" class="form-control" id="emergency_mobile_number" name="emergency_mobile_number"
                        placeholder="Enter Emergency Mobile Number" required>
                </div>

                <!-- Joining Date -->
                <div class="col-md-6">
                    <label for="joining_date" class="form-label">Joining Date</label>
                    <input type="date" class="form-control" id="joining_date" name="joining_date" required>
                </div>

                <!-- ID Proof -->
                <div class="col-md-6">
                    <label for="id_proof" class="form-label">ID Proof</label>
                    <input type="file" class="form-control" id="id_proof" name="id_proof" required>
                </div>

                <!-- Address -->
                <div class="col-6">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter Address" required></textarea>
                </div>

                <!-- Submit -->
                <div class="col-12 text-end mt-3">
                    <button type="submit" id="addUserBtn" class="btn btn-primary">
                        <span id="addUserText">Submit</span>
                        <span id="addUserSpinner" class="spinner-border spinner-border-sm d-none" role="status"
                            aria-hidden="true"></span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Scripts -->
    <script>
        $(document).ready(function() {
            // Load roles
            $('#company_id').on('change', function() {
                var companyId = $(this).val();
                $('#role_id').html('<option value="">Loading...</option>');
                $('#department_id').html('<option value="">Loading...</option>');

                if (companyId) {
                    $.get(`/company/${companyId}/roles`, function(roles) {
                        $('#role_id').html('<option value="">Select Role</option>');
                        $.each(roles, function(i, role) {
                            $('#role_id').append(
                                `<option value="${role.id}">${role.role}</option>`);
                        });
                    });

                    $.get(`/company/${companyId}/departments`, function(departments) {
                        $('#department_id').html('<option value="">Select Department</option>');
                        $.each(departments, function(i, department) {
                            $('#department_id').append(
                                `<option value="${department.id}">${department.department}</option>`
                                );
                        });
                    });
                } else {
                    $('#role_id').html('<option value="">Select Role</option>');
                    $('#department_id').html('<option value="">Select Department</option>');
                }
            });

            // Form submit
            $('#addUserForm').on('submit', function(e) {
                e.preventDefault();

                let formData = new FormData(this);
                $('#addUserBtn').prop('disabled', true);
                $('#addUserText').addClass('d-none');
                $('#addUserSpinner').removeClass('d-none');
                $('#loadingOverlay').fadeIn();
                $('.text-danger').remove();
                $('input, select, textarea').removeClass('is-invalid');
                $('#addUserMessage').html('');
                $('#idProofPreview').html('');

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#addUserForm')[0].reset();
                        $('#addUserMessage').html(
                            '<div class="alert alert-success">User added successfully!</div>'
                            );

                        if (response.id_proof_url) {
                            $('#idProofPreview').html(`
                                <div class="mt-3">
                                    <strong>ID Proof Uploaded:</strong><br>
                                    <img src="${response.id_proof_url}" class="img-thumbnail" style="max-width: 200px;" />
                                </div>
                            `);
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, messages) {
                                let input = $(`[name="${key}"]`);
                                input.addClass('is-invalid');
                                input.after(
                                    `<div class="text-danger">${messages[0]}</div>`);
                            });
                            $('#addUserMessage').html(
                                '<div class="alert alert-danger">Please fix the errors below.</div>'
                                );
                        } else {
                            $('#addUserMessage').html(
                                '<div class="alert alert-danger">Something went wrong. Please try again.</div>'
                                );
                        }
                    },
                    complete: function() {
                        $('#addUserBtn').prop('disabled', false);
                        $('#addUserText').removeClass('d-none');
                        $('#addUserSpinner').addClass('d-none');
                        $('#loadingOverlay').fadeOut();
                    }
                });
            });
        });
    </script>
@endsection
