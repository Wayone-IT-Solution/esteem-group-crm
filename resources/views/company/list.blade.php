@extends('layout')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<style>
    .form-floating>.form-control,
    .form-floating>.form-select {
        padding: 1.25rem 0.75rem 0.25rem;
        height: auto;
    }

    .form-floating label {
        padding: 0.5rem 0.75rem;
    }

    #primarthide {
        display: none;
    }

    #primarthide2 {
        display: none;
    }

    .modal .modal-content {
        border-radius: 12px;
    }

    .table td img {
        border-radius: 6px;
    }

    /* Card Style */
    .card {
        background-color: #f8f9fa;
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        color: black;
        font-size: 1.25rem;
        border-radius: 15px 15px 0 0;
    }

    .card-body {
        padding: 1.5rem;
    }

    /* Add Company Button Style */
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

    /* Table CSS */
    .table {
        width: 100%;
        /* Adjust this to fit your layout */
        table-layout: fixed;
        /* Forces the table to obey the width of columns */
    }

    .table th,
    .table td {
        padding: 12px 2px;
        /* Reduce vertical padding */
        text-align: center;
        vertical-align: middle;
    }
</style>

<div class="page-body card" style="margin-top: 44px;">
    <div class="container-fluid">
        <div class="row page-title">
            <div class="col-sm-6">
                <h3>All Companies</h3>
            </div>
            <div class="col-sm-6">
                <nav>
                    <ol class="breadcrumb justify-content-sm-end align-items-center mb-3">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCompanyModal">
                            <i class="fa-solid fa-building"></i>
                            Add Company
                        </button>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Add Company Modal -->
    <div class="modal fade" id="addCompanyModal" tabindex="-1" aria-labelledby="addCompanyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form id="addCompanyForm" action="{{ route('company.store') }}" method="POST" enctype="multipart/form-data" class="modal-content shadow-lg rounded-3">
                @csrf
                <div class="modal-header text-white">
                    <h5 class="modal-title" id="addCompanyModalLabel">
                        <i class="fa-solid fa-building me-2"></i> Add Company
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="alert alert-primary" id="primarthide">
                        Company Added Successfully!
                    </div>

                    <div class="mb-3 form-floating">
                        <input type="text" class="form-control" id="companyName" name="company_name" placeholder="Enter company name" required>
                        <label for="companyName">Company Name</label>
                    </div>

                    <div class="mb-3 form-floating">
                        <input class="form-control" type="file" id="companyLogo" name="company_logo" accept="image/*" required>
                        <label for="companyLogo">Company Logo</label>
                        <small class="text-muted">Allowed formats: JPG, PNG, SVG</small>
                        <div id="addLogoPreview" class="mt-2"></div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="addSubmitBtn">
                        <span id="addSubmitText"><i class="fa-solid fa-paper-plane me-1"></i> Submit</span>
                        <span id="addSubmitSpinner" class="d-none"><i class="fa fa-spinner fa-spin me-1"></i> Saving...</span>
                    </button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Company Table -->
    <div class="container-fluid table-space basic_table">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="bg-light">
                                    <tr class="b-b-primary">
                                        <th class="text-center" style="width: 10%;">Sr.N</th>
                                        <th style="width: 40%;">Company</th>
                                        <th class="text-center" style="width: 30%;">Logo</th>
                                        <th class="text-center" style="width: 20%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($companies as $company)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $company->name }}</td>
                                        <td class="text-center">
                                            @if ($company->logo)
                                            <img src="{{ asset( $company->logo) }}" alt="Logo"
                                                width="200" height="50" style="object-fit: contain;">
                                            @else
                                            <span class="text-muted">No Logo</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="#" class="btn btn-sm btn-warning edit-company-btn"
                                                    data-id="{{ $company->id }}" data-name="{{ $company->name }}"
                                                    data-logo="{{ asset( $company->logo) }}"
                                                    data-update-url="{{ route('company.update', $company->id) }}">
                                                    <i class="fa-solid fa-pen"></i>
                                                </a>
                                                <form action="{{ route('company.destroy', $company->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure?')">
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
</div>
<div class="modal fade" id="editCompanyModal" tabindex="-1"
    aria-labelledby="editCompanyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form id="editCompanyForm" method="POST" enctype="multipart/form-data"
            class="modal-content shadow-lg rounded-3">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title text-white" id="editCompanyModalLabel">
                    <i class="fa-solid fa-pen me-2"></i> Edit Company
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="alert alert-primary" id="primarthide2">
                    Company Updated Successfully!
                </div>

                <input type="hidden" id="editCompanyId">
                <div class="mb-3 form-floating">
                    <input type="text" class="form-control" id="editCompanyName"
                        name="company_name" required>
                    <label for="editCompanyName">Company Name</label>
                </div>

                <div class="mb-3 form-floating">
                    <input type="file" class="form-control" id="editCompanyLogo"
                        name="company_logo" accept="image/*">
                    <label for="editCompanyLogo">Company Logo</label>
                    <small class="text-muted">Leave blank to keep existing logo.</small>
                    <div id="currentLogo" class="mt-2"></div>
                </div>
            </div>

            <!-- Alert Container -->
            <div id="alertContainer" class="position-fixed top-0 end-0 p-3"
                style="z-index: 1055;"></div>
            <span id="editSubmitSpinner_success1"></span>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="editSubmitBtn">
                    <span id="editSubmitText"><i class="fa-solid fa-save me-1"></i>
                        Update</span>
                    <span id="editSubmitSpinner" class="d-none"><i
                            class="fa fa-spinner fa-spin me-1"></i> Updating...</span>
                </button>
                <button type="button" class="btn btn-outline-secondary"
                    data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function showToast(message, type = 'success') {
        const alertType = type === 'success' ? 'text-success' : 'text-danger';
        const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
        const toast = `
                <div class="alert ${alertType} alert-dismissible fade show custom-alert" role="alert">
                    <i class="fa-solid ${icon} me-2"></i> ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>`;
        $('#editSubmitSpinner_success').append(toast);
        setTimeout(() => $('.custom-alert').alert('close'), 2000);
    }

    $(document).ready(function() {
        $('#companyLogo').on('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = e => $('#addLogoPreview').html(
                    `<img src="${e.target.result}" width="80">`);
                reader.readAsDataURL(file);
            }
        });

        $('.edit-company-btn').on('click', function() {
            $('#editCompanyId').val($(this).data('id'));
            $('#editCompanyName').val($(this).data('name'));
            $('#editCompanyForm').attr('action', $(this).data('update-url'));

            const logo = $(this).data('logo');
            $('#currentLogo').html(logo ? `<img src="${logo}" width="80">` :
                '<span class="text-muted">No Logo</span>');
            $('#editCompanyModal').modal('show');
        });

        $('#addCompanyForm').on('submit', function(e) {
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
                success: function(result) {
                    $('#primarthide').show();
                    setTimeout(() => $('#addCompanyModal').modal('hide'), 3000);
                    $btn.prop('disabled', false);
                    $('#addSubmitText').removeClass('d-none');
                    $('#addSubmitSpinner').addClass('d-none');
                    location.reload();
                },
                error: function(error) {
                    $btn.prop('disabled', false);
                    $('#addSubmitText').removeClass('d-none');
                    $('#addSubmitSpinner').addClass('d-none');
                    showToast('Failed to add company.', 'error');
                }
            });
        });
    });

    $('#editCompanyForm').on('submit', function(e) {
        e.preventDefault();
        const $btn = $('#editSubmitBtn');
        $btn.prop('disabled', true);
        $('#editSubmitText').addClass('d-none');
        $('#editSubmitSpinner').removeClass('d-none');

        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function() {
                $('#primarthide2').show();
                setTimeout(() => {
                    location.reload();
                }, 1000);
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
</script>
@endsection