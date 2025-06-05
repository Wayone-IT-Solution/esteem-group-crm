@extends('layout')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
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

    .card {
        background-color: #f8f9fa;
        /* border-radius: 15px; */
        /* box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); */
    }

    .card-header {
        color: black;
        font-size: 1.25rem;
        border-radius: 15px 15px 0 0;
    }

    .card-body {
        padding: 1.5rem;
    }

    .btn-add-company {
        background-color: #6c757d;
        color: #fff;
        border: none;
        border-radius: 20px;
        padding: 10px 20px;
        display: flex;
        align-items: center;
        font-size: 1rem;
        transition: background-color 0.3s;
    }

    .btn-add-company:hover {
        background-color: #5a6268;
    }

    .btn-add-company i {
        margin-right: 10px;
    }

    .page-body {
        background-color: white;
    }

    .table th,
    .table td {
        padding: 5px;
        text-align: center;
        vertical-align: middle;
    }

    .table td i {
        font-size: 0.9rem;
        vertical-align: middle;
        /* margin-right: 4px; */
    }

    .table td small {
        /* font-size: 0.85rem; */
        vertical-align: middle;
        font-size: 10px !important;

    }
</style>

<div class="page-body card" style="margin-top: 20px; background-color: white;">
    <div class="container-fluid">
        <div class="row page-title align-items-center">
            <div class="col-sm-2">
                <h3>All Users</h3>
            </div>

            <div class="col-md-8">
                <form id="userFilterForm" method="post" action="javascript:void(0);" class="d-flex flex-wrap gap-3 align-items-end">
                    <div class="col-md-3">
                        <select class="form-select" name="company_id" id="filterCompany">
                            <option value="">Filter by Company</option>
                            @foreach($companies as $companyOption)
                            <option value="{{ $companyOption->id }}">{{ $companyOption->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select class="form-select" name="department_id" id="filterDepartment">
                            <option value="">Filter by Department</option>
                            {{-- Will be dynamically populated --}}
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select class="form-select" name="designation" id="filterDesignation">
                            <option value="">Filter by Designation</option>
                            {{-- Will be dynamically populated --}}
                        </select>
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100" id="applyFilterBtn">
                            <span class="default-text"><i class="fa-solid fa-filter me-1"></i> Filter</span>
                            <span class="loading-text d-none"><i class="fa-solid fa-spinner fa-spin me-1"></i>Wait...</span>
                        </button>
                    </div>
                </form>
            </div>



            <div class="col-sm-2 text-end">
                <a href="{{ route('admin.users.add')}}" class="btn btn-primary">
                    <i class="fa-solid fa-user-plus"></i> Add User
                </a>
            </div>
        </div>
    </div>

    <!-- User Table -->
    <div class="container-fluid table-space basic_table mt-4 mb-4">
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table id="usersTable" class="table table-striped table-bordered">
                        <thead class="bg-light">
                            <tr class="b-b-primary table-head">
                                <th>Sr.N</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Company</th>
                                <th>Designation</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr class="table-head">
                                <td>{{ $loop->iteration }}</td>
                                <td><i class="fa-solid fa-user text-primary"></i> <small>{{ $user->name }}</small></td>
                                <td><i class="fa-solid fa-envelope text-secondary"></i> <small>{{ $user->email }}</small></td>
                                <td><i class="fa-solid fa-building text-info"></i> <small>{{ $user->company->name }}</small></td>
                                <td><i class="fa-solid fa-briefcase text-success"></i> <small>{{ ucfirst($user->role) }}</small></td>
                                <td><i class="fa-solid fa-phone text-warning"></i> <small>{{ $user->mobile_number }}</small></td>
                                <td><i class="fa-solid fa-location-dot text-danger"></i> <small>{{ $user->address }}</small></td>
                                <td>
                                    <div class="d-flex justify-content-center gap-1 action-buttons">
                                        <!-- View Info -->
                                        <button class="btn btn-sm btn-light text-info border show-user-info"
                                            data-bs-toggle="offcanvas"
                                            data-bs-target="#userInfoCanvas"
                                            data-name="{{ $user->name }}"
                                            data-email="{{ $user->email }}"
                                            data-company="{{ $user->company->name }}"
                                            data-role="{{ ucfirst($user->role) }}"
                                            data-phone="{{ $user->mobile_number }}"
                                            data-address="{{ $user->address }}"
                                            title="View Info">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>

                                        <!-- Edit -->
                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                            class="btn btn-sm btn-light text-warning border"
                                            data-id="{{ $user->id }}"
                                            data-name="{{ $user->name }}"
                                            data-update-url="{{ route('company.update', $user->id) }}"
                                            title="Edit User">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        <!-- Delete -->
                                        <button type="button" class="btn btn-sm btn-light text-danger border"
                                            onclick="CommanDelete('delete','users','{{ $user->id }}')"
                                            title="Delete User">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
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

<!-- Right Side Offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="userInfoCanvas" aria-labelledby="userInfoCanvasLabel">
    <div class="offcanvas-header bg-primary text-white">
        <h5 id="userInfoCanvasLabel" class="mb-0 text-white">
            <i class="fa-solid fa-circle-info me-2"></i> Employee Details
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body p-4 bg-light">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <div class="rounded-circle mx-auto mb-3" style="width: 80px; height: 80px; background-color: #e9ecef; display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid fa-user text-secondary" style="font-size: 36px;"></i>
                    </div>
                    <h5 class="mb-1 fw-semibold" id="canvasName">John Doe</h5>
                    <span class="text-muted d-block" id="canvasRole">Designation</span>
                </div>

                <hr class="my-4">

                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div><i class="fa-solid fa-envelope text-primary me-2"></i> Email</div>
                        <span id="canvasEmail" class="text-muted text-end"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div><i class="fa-solid fa-building text-info me-2"></i> Company</div>
                        <span id="canvasCompany" class="text-muted text-end"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div><i class="fa-solid fa-phone text-success me-2"></i> Phone</div>
                        <span id="canvasPhone" class="text-muted text-end"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div><i class="fa-solid fa-location-dot text-danger me-2"></i> Address</div>
                        <span id="canvasAddress" class="text-muted text-end"></span>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {


        $(document).on('click', '.show-user-info', function() {
            const name = $(this).data('name') || 'N/A';
            const email = $(this).data('email') || 'N/A';
            const company = $(this).data('company') || 'N/A';
            const role = $(this).data('role') || 'N/A';
            const phone = $(this).data('phone') || 'N/A';
            const address = $(this).data('address') || 'N/A';

            $('#canvasName').text(name);
            $('#canvasEmail').text(email);
            $('#canvasCompany').text(company);
            $('#canvasRole').text(role);
            $('#canvasPhone').text(phone);
            $('#canvasAddress').text(address);

            const offcanvasEl = document.getElementById('userInfoCanvas');
            const bsOffcanvas = bootstrap.Offcanvas.getOrCreateInstance(offcanvasEl);
            bsOffcanvas.show();
        });
    });

    $(document).ready(function() {
        // Update Designation and Department based on selected company
        $('#filterCompany').change(function() {
            const companyId = $(this).val();
            $('#filterDepartment').html('<option value="">Filter by Department</option>');
            $('#filterDesignation').html('<option value="">Filter by Designation</option>');

            if (!companyId) return;

            $.ajax({
                url: `/admin/users/departments/${companyId}`,
                method: 'GET',
                success: function(response) {
                    response.departments.forEach(function(dept) {
                        $('#filterDepartment').append(`<option value="${dept.id}">${dept.department}</option>`);
                    });
                    response.roles.forEach(function(role) {
                        $('#filterDesignation').append(`<option value="${role.role}">${role.role}</option>`);
                    });
                },
                error: function() {
                    alert('Failed to load departments and roles.');
                }
            });
        });

        // Handle Filter Submit via AJAX
        $('#userFilterForm').submit(function(e) {
            e.preventDefault();

            // UI: show loading
            $('#applyFilterBtn .default-text').addClass('d-none');
            $('#applyFilterBtn .loading-text').removeClass('d-none');

            // Prepare filter parameters
            const company_id = $('#filterCompany').val();
            const department_id = $('#filterDepartment').val();
            const designation = $('#filterDesignation').val();

            $.ajax({
                url: `{{ route('admin.users.filter') }}`, // Make sure this route exists in web.php
                method: 'POST',
                data: {
                    company_id,
                    department_id,
                    _token: "{{ csrf_token() }}",
                    designation
                },
                success: function(response) {
                    $('#usersTable').html(response);

                    // Reset button
                    $('#applyFilterBtn .default-text').removeClass('d-none');
                    $('#applyFilterBtn .loading-text').addClass('d-none');
                },
                error: function() {
                    alert('Failed to apply filter.');
                    $('#applyFilterBtn .default-text').removeClass('d-none');
                    $('#applyFilterBtn .loading-text').addClass('d-none');
                }
            });
        });
    });
</script>
@endsection