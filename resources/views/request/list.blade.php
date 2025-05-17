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

<div class="page-body card" style="margin-top: 20px; background-color: white;">

    <div class="container-fluid">
        <div class="row page-title align-items-center">
            <div class="col-sm-3">
                <h3>All Request Type</h3>
            </div>

            <div class="col-md-7">
                <form id="userFilterForm" method="post" action="javascript:void(0);" class="d-flex flex-wrap gap-3 align-items-end">
                    <div class="col-md-6">
                        <select class="form-select" name="company_id" id="filterCompany">
                            <option value="">Filter by Company</option>
                            @foreach($companies as $companyOption)
                            <option value="{{ $companyOption->id }}">{{ $companyOption->name }}</option>
                            @endforeach
                        </select>
                    </div>





                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary w-100" id="applyFilterBtn">
                            <span class="default-text"><i class="fa-solid fa-filter me-1"></i> Filter</span>
                            <span class="loading-text d-none"><i class="fa-solid fa-spinner fa-spin me-1"></i>Wait...</span>
                        </button>
                    </div>
                </form>
            </div>



            <div class="col-sm-2 text-end">
                <button class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal"
                    data-bs-target="#addDepartmentModal">
                    <i class="fa-solid fa-building me-2"></i>  Request
                </button>
            </div>
        </div>
    </div>


    <div class="container mt-2" id="alertContainer"></div>

    <!-- Add Department Modal -->
    <div class="modal fade" id="addDepartmentModal" tabindex="-1" aria-labelledby="addDepartmentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form id="addDepartmentForm" action="{{ route('request.store') }}" method="POST"
                class="modal-content shadow-lg rounded-3">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title text-white"><i class="fa-solid fa-building me-2"></i> Add Request For</h5>
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
                        <input type="text" class="form-control" id="request" name="request"
                            placeholder="Enter request" required>
                        <label for="request">Request For</label>
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

    <!-- Edit Department Modal -->
    <div class="modal fade" id="editDepartmentModal" tabindex="-1" aria-labelledby="editDepartmentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form id="editDepartmentForm" method="POST" class="modal-content shadow-lg rounded-3">
                @csrf
                @method('PUT')
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title text-white"><i class="fa-solid fa-pen me-2"></i> Edit Request</h5>
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
                        <input type="text" class="form-control" id="editDepartmentName" name="request"
                            placeholder="Enter Request" required>
                        <label for="editDepartmentName">Request</label>
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

    <!-- Department Table -->
    <div class="container-fluid table-space basic_table">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="table-responsive">
                        <table id="daparmentTable" class="table table-striped table-bordered">
                            <thead class="bg-light">
                                <tr class="b-b-primary">
                                    <th class="text-center">Sr.No</th>
                                    <th>Company Name</th>
                                    <th>Request For</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requests as $department)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $department->company->name ?? '' }}</td>
                                    <td>{{ $department->request }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <button type="button"
                                                class="btn btn-sm btn-warning edit-department-btn"
                                                data-id="{{ $department->id }}"
                                                data-department="{{ $department->request }}"
                                                data-company-id="{{ $department->company_id }}"
                                                data-update-url="{{ route('request.update', $department->id) }}">
                                                <i class="fa-solid fa-pen"></i>
                                            </button>

                                            <button type="submit" class="btn btn-sm btn-danger" onclick="CommanDelete('delete','requests','{{ $department->id }}')">
                                                <i class="fa-solid fa-trash" style="font-size: 14px;"></i>
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
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function showToast(message, type = 'success') {
        const alertType = type === 'success' ? 'alert-success' : 'alert-danger';
        const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
        const toast =
            `<div class="alert ${alertType} alert-dismissible fade show custom-alert shadow-sm mt-2" role="alert"><i class="fa-solid ${icon} me-2"></i> ${message}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`;
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
            $('#editDepartmentName').val($(this).data('department'));
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

                    Swal.fire({
                        title: 'Success!',
                        text: 'Request added successfully',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = window.location.href;
                    });
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

                    Swal.fire({
                        title: 'Success!',
                        text: 'Request updated successfully',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = window.location.href;
                    });

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


    });

    $('#userFilterForm').submit(function(e) {
        e.preventDefault();

        // UI: show loading
        $('#applyFilterBtn .default-text').addClass('d-none');
        $('#applyFilterBtn .loading-text').removeClass('d-none');

        // Prepare filter parameters
        const company_id = $('#filterCompany').val();

        $.ajax({
            url: `{{ route('admin.request.filter') }}`, // Make sure this route exists in web.php
            method: 'POST',
            data: {
                company_id,
                _token: "{{ csrf_token() }}",
            },
            success: function(response) {
                $('#daparmentTable').html(response);

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
</script>
@endsection