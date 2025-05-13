@extends('layout')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <h5 class="mb-4" style="color: rgb(67, 185, 178);">
        <i class="fa-solid fa-user-plus me-2"></i> Add New User
    </h5>

    <div class="container mt-4 mb-5 p-4" style="border: 1px solid #ddd; border-radius: 10px;">
        <form id="userForm" action="{{ route('company.Alluser.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Form Fields (same as in the modal) -->
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="company_id" class="form-label">Company</label>
                    <select class="form-select" name="company_id" id="company_id" required>
                        <option value="">Select Company</option>
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="role_id" class="form-label">Designation</label>
                    <select class="form-select" name="role" id="role_id" required>
                        <option value="">Select Designation</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="department_id" class="form-label">Department</label>
                    <select class="form-select" name="department_id" id="department_id" required>
                        <option value="">Select Department</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name"
                        required>
                </div>

                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email"
                        required>
                </div>

                <div class="col-md-6">
                    <label for="mobile_number" class="form-label">Mobile Number</label>
                    <input type="text" class="form-control" name="mobile_number" id="mobile_number"
                        placeholder="Enter Mobile Number" required>
                </div>

                <div class="col-md-6">
                    <label for="emergency_mobile_number" class="form-label">Emergency Mobile Number</label>
                    <input type="text" class="form-control" name="emergency_mobile_number" id="emergency_mobile_number"
                        placeholder="Enter Emergency Mobile Number">
                </div>

                <div class="col-md-6">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password">
                </div>

                <div class="col-md-6">
                    <label for="id_proof" class="form-label">ID Proof</label>
                    <input type="file" class="form-control" name="id_proof" id="id_proof" accept=".jpg,.jpeg,.png,.pdf">
                </div>

                <div class="col-md-6">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control" name="address" id="address" rows="3" placeholder="Enter Address" required></textarea>
                </div>

                <div class="col-12 text-end mt-3">
                    <button type="submit" id="userSubmitBtn" class="btn btn-primary">
                        <span id="userSubmitText">Submit</span>
                        <span id="userSubmitSpinner" class="spinner-border spinner-border-sm d-none" role="status"
                            aria-hidden="true"></span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Dynamic Role and Department Loading for Add User Form
        function loadRolesAndDepartments(companyId, roleSelectId, departmentSelectId) {
            $.ajax({
                url: `/getRolesAndDepartments/${companyId}`,
                method: 'GET',
                success: function(data) {
                    let rolesOptions = '<option value="">Select Designation</option>';
                    let departmentsOptions = '<option value="">Select Department</option>';

                    data.roles.forEach(role => {
                        rolesOptions += `<option value="${role.role}">${role.role}</option>`;
                    });

                    data.departments.forEach(department => {
                        departmentsOptions +=
                            `<option value="${department.department}">${department.department}</option>`;
                    });

                    $(roleSelectId).html(rolesOptions);
                    $(departmentSelectId).html(departmentsOptions);
                }
            });
        }

        $('#company_id').change(function() {
            let companyId = $(this).val();
            loadRolesAndDepartments(companyId, '#role_id', '#department_id');
        });
    </script>
@endsection
<div id="userTable" class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Department</th>
                <th>Company</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->role ?? 'N/A' }}</td>
                    <td>{{ $user->department->department ?? 'N/A' }}</td>
                    <td>{{ $user->company->name ?? 'N/A' }}</td>
                    <td>{{ $user->address ?? 'N/A' }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm editUserBtn" data-bs-toggle="modal"
                            data-bs-target="#editUserModal" data-user="{{ json_encode($user) }}">
                            Edit
                        </button>

                        <form action="{{ route('company.Alluser.destroy', $user->id) }}" method="POST"
                            class="d-inline-block" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center mt-4">
        {{ $users->links() }}
    </div>
</div>

<div class="card p-4 mt-4 mb-4">
    <h5 class="mb-4 d-flex align-items-center" style="color: rgb(67, 185, 178);">
        <i class="fa-solid fa-users me-2"></i> Manage Users
    </h5>

    <!-- Search Filter -->
    <div class="d-flex mb-3">
        <input type="text" class="form-control me-2" id="searchInput" placeholder="Search by Name or Email">
        <button class="btn btn-secondary" id="searchBtn">Search</button>
    </div>

    <!-- Add User Button -->
    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal"
            data-bs-target="#addUserModal">
            <i class="fa-solid fa-user-plus me-2"></i> Add User
        </button>
    </div>
</div>

<script>
    // Search functionality (basic)
    document.getElementById('searchBtn').addEventListener('click', function() {
        var query = document.getElementById('searchInput').value.toLowerCase();
        var rows = document.querySelectorAll('#userTable tbody tr');

        rows.forEach(function(row) {
            var name = row.cells[0].textContent.toLowerCase();
            var email = row.cells[1].textContent.toLowerCase();

            if (name.includes(query) || email.includes(query)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
