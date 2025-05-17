@extends('layout')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<div class="container my-5">
    <div class="card border-0 shadow rounded-4">
        <div class="card-header bg-white border-bottom py-4 px-4">
            <div style="display:flex;justify-content:space-between">
                <h4 class="mb-0 text-dark">
                    <i class="fa-solid fa-user-plus me-2"></i> Edit {{ $user->name ?? '' }}
                </h4>
                <a href="{{ route('admin.users.all') }}" class="btn btn-primary px-5">
                    Back
                </a>
            </div>
        </div>

        <div class="card-body bg-white px-4 rounded-bottom-4">
            <form id="commanform" action="{{ route('admin.user.update',$user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Section: Company Details --}}
                <div class="mb-5">
                    <h5 class="text-secondary mb-4 border-bottom pb-2">Company Details</h5>
                    <div class="row g-4">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Company <span class="text-danger">*</span></label>
                            <select class="form-select" id="company_id" name="company_id">
                                <option value="">Select Company</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}" {{ $user->company_id == $company->id ? 'selected' : '' }}>
                                        {{ $company->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="text-danger" id="company_id-error"></div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Designation <span class="text-danger">*</span></label>
                            <select class="form-select" id="role" name="role">
                                <option value="">Select Designation</option>
                                @if(!empty($user->role))
                                    <option selected>{{ $user->role }}</option>
                                @endif
                            </select>
                            <div class="text-danger" id="role-error"></div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Department <span class="text-danger">*</span></label>
                            <select class="form-select" id="department_id" name="department_id">
                                <option value="">Select Department</option>
                                @if($user->department)
                                    <option value="{{ $user->department_id }}" selected>{{ $user->department->department }}</option>
                                @endif
                            </select>
                            <div class="text-danger" id="department_id-error"></div>
                        </div>
                    </div>
                </div>

                {{-- Personal Information --}}
                <div class="mb-5">
                    <h5 class="text-secondary mb-4 border-bottom pb-2">Personal Information</h5>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter full name" value="{{ old('name', $user->name) }}">
                            <div class="text-danger" id="name-error"></div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter address" value="{{ old('address', $user->address) }}">
                            <div class="text-danger" id="address-error"></div>
                        </div>
                    </div>
                </div>

                {{-- Contact Details --}}
                <div class="mb-5">
                    <h5 class="text-secondary mb-4 border-bottom pb-2">Contact Details</h5>
                    <div class="row g-4">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="{{ old('email', $user->email) }}">
                            <div class="text-danger" id="email-error"></div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Mobile Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="Mobile number" value="{{ old('mobile_number', $user->mobile_number) }}">
                            <div class="text-danger" id="mobile_number-error"></div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Emergency Contact</label>
                            <input type="text" class="form-control" id="emergency_mobile_number" name="emergency_mobile_number" placeholder="Optional contact number" value="{{ old('emergency_mobile_number', $user->emergency_mobile_number) }}">
                            <div class="text-danger" id="emergency_mobile_number-error"></div>
                        </div>
                    </div>
                </div>

                {{-- Security --}}
                <div class="mb-4">
                    <h5 class="text-secondary mb-4 border-bottom pb-2">Security</h5>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Password <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="password" name="password" placeholder="Create a password">
                            <div class="text-danger" id="password-error"></div>
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="d-flex justify-content-end mt-5">
                    <button type="submit" id="commanButton" class="btn btn-primary px-5">
                        <i class="fa-solid fa-paper-plane me-1"></i> Submit
                        <span class="spinner-border spinner-border-sm d-none ms-2" role="status" aria-hidden="true" id="userSubmitSpinner"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- JS --}}
<script>
    function populateRolesAndDepartments(companyId) {
        if (!companyId) return;

        $.ajax({
            url: `/admin/users/departments/${companyId}`,
            method: 'GET',
            success: function(data) {
                let roleOptions = '<option value="">Select Designation</option>';
                data.roles.forEach(role => {
                    roleOptions += `<option value="${role.role}" ${role.role === "{{ $user->role }}" ? 'selected' : ''}>${role.role}</option>`;
                });

                let deptOptions = '<option value="">Select Department</option>';
                data.departments.forEach(dept => {
                    deptOptions += `<option value="${dept.id}" ${dept.id == "{{ $user->department_id }}" ? 'selected' : ''}>${dept.department}</option>`;
                });

                $('#role').html(roleOptions);
                $('#department_id').html(deptOptions);
            }
        });
    }

    $('#company_id').change(function() {
        populateRolesAndDepartments($(this).val());
    });

    $(document).ready(function() {
        const selectedCompanyId = $('#company_id').val();
        if (selectedCompanyId) {
            populateRolesAndDepartments(selectedCompanyId);
        }
    });
</script>
@endsection
