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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Title and Add Button -->
    <div class="d-flex justify-content-between align-items-center mb-3 mt-4">
        <h3 class="mb-0">ALL User</h3>
        <button class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addUserModal">
            <i class="fa-solid fa-user-plus me-2 text-primary"></i> Add User
        </button>
    </div>

    <!-- Add User Modal -->
    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content p-4">
                <form id="addUserForm" action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h5 class="mb-4 p-2 text-white bg-primary rounded">Add New User</h5>
                    <div class="row g-3">

                        <!-- Unique ID -->
                        <div class="col-md-6">
                            <label for="unique_id" class="form-label">Unique ID</label>
                            <input type="text" class="form-control" id="unique_id" name="unique_id"
                                placeholder="Enter Unique ID" required>
                        </div>

                        <!-- Branch -->
                        <div class="col-md-6">
                            <label for="branch" class="form-label">Branch</label>
                            <input type="text" class="form-control" id="branch" name="branch"
                                placeholder="Enter Branch" required>
                        </div>

                        <!-- Department -->
                        <div class="col-md-6">
                            <label for="department_id" class="form-label">Department</label>
                            <select class="form-select" name="department_id" id="department_id" required>
                                <option value="">Select Department</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Designation -->
                        <div class="col-md-6">
                            <label for="designation" class="form-label">Designation</label>
                            <input type="text" class="form-control" id="designation" name="designation"
                                placeholder="Enter Designation" required>
                        </div>

                        <!-- Name -->
                        <div class="col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter Name" required>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Enter Email" required>
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
                            <input type="text" class="form-control" id="emergency_mobile_number"
                                name="emergency_mobile_number" placeholder="Enter Emergency Mobile Number" required>
                        </div>

                        <!-- Joining Date -->
                        <div class="col-md-6">
                            <label for="joining_date" class="form-label">Joining Date</label>
                            <input type="date" class="form-control" id="joining_date" name="joining_date" required>
                        </div>

                        <!-- Role -->
                        <div class="col-md-6">
                            <label for="role_id" class="form-label">Role</label>
                            <select class="form-select" name="role_id" id="role_id" required>
                                <option value="">Select Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->role }}</option>
                                @endforeach
                            </select>
                        </div>

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

                        <!-- ID Proof -->
                        <div class="col-md-6">
                            <label for="id_proof" class="form-label">ID Proof</label>
                            <input type="file" class="form-control" id="id_proof" name="id_proof" required>
                        </div>

                        <!-- Address -->
                        <div class="col-12">
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
        </div>
    </div>



    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content p-4">
                <form id="editUserForm" action="{{ route('users.update', 'user_id') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <!-- Unique ID Field -->
                        <div class="col-md-6">
                            <label for="edit_unique_id" class="form-label">Unique ID</label>
                            <input type="text" class="form-control" id="edit_unique_id" placeholder="Enter Unique ID"
                                required>
                        </div>
                        <!-- Branch Field -->
                        <div class="col-md-6">
                            <label for="edit_branch" class="form-label">Branch</label>
                            <input type="text" class="form-control" id="edit_branch" name="branch"
                                placeholder="Enter Branch" required>
                        </div>
                        <!-- Department Field -->
                        <div class="col-md-6">
                            <label for="edit_department" class="form-label">Department</label>
                            <select class="form-select" name="department_id" id="edit_department" required>
                                <option value="">Select Department</option>



                                @foreach ($departments as $list)
                                    <option value="{{ $list->id }}">
                                        212121212121212
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Designation Field -->
                        <div class="col-md-6">
                            <label for="edit_designation" class="form-label">Designation</label>
                            <input type="text" class="form-control" id="edit_designation" name="designation"
                                placeholder="Enter Designation" required>
                        </div>
                        <!-- Name Field -->
                        <div class="col-md-6">
                            <label for="edit_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="edit_name" name="name"
                                placeholder="Enter Name" required>
                        </div>
                        <!-- Email Field -->
                        <div class="col-md-6">
                            <label for="edit_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="edit_email" name="email"
                                placeholder="Enter Email" required>
                        </div>
                        <!-- Mobile Number Field -->
                        <div class="col-md-6">
                            <label for="edit_mobile_number" class="form-label">Mobile Number</label>
                            <input type="text" class="form-control" id="edit_mobile_number" name="mobile_number"
                                placeholder="Enter Mobile Number" required>
                        </div>
                        <!-- Emergency Mobile Number Field -->
                        <div class="col-md-6">
                            <label for="edit_emergency_mobile_number" class="form-label">Emergency Mobile Number</label>
                            <input type="text" class="form-control" id="edit_emergency_mobile_number"
                                name="emergency_mobile_number" placeholder="Enter Emergency Mobile Number" required>
                        </div>
                        <!-- Joining Date Field -->
                        <div class="col-md-6">
                            <label for="edit_joining_date" class="form-label">Joining Date</label>
                            <input type="date" class="form-control" id="edit_joining_date" name="joining_date"
                                required>
                        </div>
                        <!-- Role Field -->
                        <div class="col-md-6">
                            <label for="edit_role_id" class="form-label">Role</label>
                            <select class="form-select" name="role_id" id="edit_role_id" required>
                                <option value="">Select Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->role ?? 'no name' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Company Field -->
                        <div class="col-md-6">
                            <label for="edit_company_id" class="form-label">Company</label>
                            <select class="form-select" name="company_id" id="edit_company_id" required>
                                <option value="">Select Company</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Address Field -->
                        <div class="col-12">
                            <label for="edit_address" class="form-label">Address</label>
                            <textarea name="address" id="edit_address" rows="3" class="form-control" required></textarea>
                        </div>
                        <!-- ID Proof Field (Newly Added for Edit) -->
                        <div class="col-md-6">
                            <label for="edit_id_proof" class="form-label">ID Proof</label>
                            <input type="file" id="edit_id_proof" name="id_proof" class="form-control">
                        </div>
                        <!-- Submit Button -->
                        <div class="col-12 text-end">
                            <button type="submit" id="editUserBtn" class="btn btn-primary">
                                <span id="editUserText">Save Changes</span>
                                <span id="editUserSpinner" class="spinner-border spinner-border-sm d-none" role="status"
                                    aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- User Table -->
    <div class="container-fluid table-space basic_table mt-4">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="bg-light">
                                <tr>
                                    <th>S.No.</th>
                                    <th>Unique ID</th>
                                    <th>Branch</th>
                                    <th>Department</th>
                                    <th>Designation</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Email</th>

                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->unique_id }}</td>
                                        <td>{{ $user->branch }}</td>
                                        <td>{{ $user->department }}</td>
                                        <td>{{ $user->designation }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->Address }}</td>
                                        <td>{{ $user->email }}</td>

                                        <td>
                                            <button class="btn btn-warning btn-sm btn-edit"
                                                data-id="{{ $user->id }}">
                                                <i class="fa-solid fa-pencil-alt"></i> Edit
                                            </button>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure?')">
                                                    <i class="fa-solid fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endsection
                <script>
                    $(document).ready(function() {
                        $('#addUserForm').on('submit', function(e) {
                            e.preventDefault(); // prevent default form submission

                            let formData = new FormData(this);

                            // Show loading spinner
                            $('#addUserBtn').prop('disabled', true);
                            $('#addUserText').addClass('d-none');
                            $('#addUserSpinner').removeClass('d-none');

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
                                    $('#addUserModal').modal('hide');
                                    $('#addUserForm')[0].reset();
                                    location.reload(); // or update table dynamically
                                },
                                error: function(xhr) {
                                    // Handle validation errors
                                    let errors = xhr.responseJSON.errors;
                                    let message = "Please fix the following errors:\n\n";
                                    $.each(errors, function(key, value) {
                                        message += `- ${value[0]}\n`;
                                    });
                                    alert(message);
                                },
                                complete: function() {
                                    $('#addUserBtn').prop('disabled', false);
                                    $('#addUserText').removeClass('d-none');
                                    $('#addUserSpinner').addClass('d-none');
                                }
                            });
                        });
                    });
                </script>
