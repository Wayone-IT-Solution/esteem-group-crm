@extends('layout')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const statusModal = document.getElementById('statusModal');
        const statusSelect = document.getElementById('statusSelect');
        const modalLoanId = document.getElementById('modalLoanId');

        statusModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const loanId = button.getAttribute('data-loan-id');
            const status = button.getAttribute('data-status');
            if (status == 'Not Eligible') {
                $('#reasondid').show();
                $('#reasonname').prop('required', true);
            } else {
                $('#reasondid').hide();
                $('#reasonname').prop('required', false);

            }

            modalLoanId.value = loanId;

            // Set the selected status in the dropdown
            if (statusSelect) {
                [...statusSelect.options].forEach(option => {
                    option.selected = (option.value.toLowerCase() === status.toLowerCase());
                });
            }
        });
    });
</script>

<style>
    .card {
        background-color: #f8f9fa;
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        color: black;
        font-size: 1.25rem;
    }

    .scroll-wrapper {
        max-height: 80vh;
        overflow-y: auto;
        overflow-x: auto;
        padding-right: 10px;
    }

    x .btn-add-lead {
        background-color: #198754;
        color: #fff;
        border-radius: 20px;
        padding: 10px 20px;
        display: flex;
        align-items: center;
    }

    .btn-add-lead i {
        margin-right: 10px;
    }

    .table th,
    .table td {
        text-align: center;
        vertical-align: middle;
    }

    .assigned-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background-color: #0d6efd;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 14px;
        cursor: pointer;
        transition: 0.3s;
    }

    .assigned-avatar:hover {
        transform: scale(1.1);
    }
</style>
<div class=" mt-4" style="background-color: white; margin-top: 40px; padding: 10px 0px;">

    <div class="col-md-12">
        <form id="userFilterForm" method="post" action="javascript:void(0);" class="d-flex align-items-end">
            <div class="col-md-2 p-3">
                <select class="form-select" name="company_id" id="filterCompany" disabled>
                    <option value="" {{ request('company_id') == '' ? 'selected' : '' }}>All Companies</option>
                    @foreach($companies as $company)
                    <option value="{{ $company->id }}" {{ request('company_id') == $company->id ? 'selected' : '' }}>
                        {{ $company->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2 p-3">
                <input type="text" class="form-control" name="search" id="searchInput" placeholder="Search name/mobile">
            </div>

            <div class="col-md-2 p-3">
                <input type="date" class="form-control" name="from_date" id="fromDate" placeholder="From Date">
            </div>

            <div class="col-md-2 p-3">
                <input type="date" class="form-control" name="to_date" id="toDate" placeholder="To Date">
            </div>
            <div class="col-md-2 p-3">
                <select class="form-select" name="status" id="status">
                    <option value="">Select Status</option>
                    <option value="eligible" {{ request('status') == 'eligible' ? 'selected' : '' }}>Eligible</option>
                    <option value="not eligible" {{ request('status') == 'not eligible' ? 'selected' : '' }}>Not Eligible</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="lost" {{ request('status') == 'lost' ? 'selected' : '' }}>Lost</option>
                    <option value="working" {{ request('status') == 'working' ? 'selected' : '' }}>Working</option>
                    <option value="progress" {{ request('status') == 'progress' ? 'selected' : '' }}>Progress</option>
                    <option value="no response" {{ request('status') == 'no response' ? 'selected' : '' }}>No Response</option>
                    <option value="won" {{ request('status') == 'won' ? 'selected' : '' }}>Won</option>
                </select>
            </div>


            <div class="col-md-2 p-3">
                <button type="submit" class="btn btn-primary w-100" id="applyFilterBtn">
                    <span class="default-text"><i class="fa-solid fa-filter me-1"></i> Filter</span>
                    <span class="loading-text d-none"><i class="fa-solid fa-spinner fa-spin me-1"></i>Wait...</span>
                </button>
            </div>
        </form>

    </div>
</div>

@if(session('error'))
<div class="alert alert-danger">

    <div style="color: white;">{{ session('error') }}</div>
</div>
@endif

@if(session('success'))
<div class="alert alert-success">
    <div style="color: white;">{{ session('success') }}</div>
</div>
@endif


<div class="page-body card mt-4" style="background-color: white; margin-top: 40px; padding: 10px 0px;">
    <div class="container-fluid">
        <div class="row align-items-center mb-4">
            <div class="col-md-3">
                <h4 class="mb-0">All Leads</h4>
            </div>

            {{-- <div class="col-md-9 text-md-end mt-3 mt-md-0">
                <div class="d-flex flex-wrap justify-content-md-end gap-2">
                    <a href="{{ asset('sample/sample.xlsx') }}" class="btn btn-success">
            <i class="fa-solid fa-download me-1"></i> Download Sample Lead
            </a>

            <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#importLeadsModal">
                <i class="fa-solid fa-file-import me-1"></i> Import Leads
            </a>

            <a href="{{ route('admin.leads.create') }}" class="btn btn-primary">
                <i class="fa-solid fa-plus me-1"></i> Add Enquiry
            </a>
        </div>
    </div> --}}
</div>


<div class="table-responsive overflow-x overflow-y">
    <table id="leadsTable" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>S.no</th>
                <th>Date</th>
                <th>Personal Info</th>
                <th>Loan Details</th>
                <th>Contact Info</th>
                <th>Address</th>
                <th>Employment</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($leads))
            @foreach($leads as $loan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <div>{{ \Carbon\Carbon::parse($loan->created_at)->format('d M Y') }}</div>
                    <small class="text-muted">{{ \Carbon\Carbon::parse($loan->created_at)->format('h:i A') }}</small>
                </td>
                <td>
                    <div><strong>{{ $loan->title }} {{ $loan->first_name }} {{ $loan->last_name }}</strong></div>
                    <div>DOB: {{ \Carbon\Carbon::parse($loan->date_of_birth)->format('d M Y') }}</div>
                    <div>Marital: {{ $loan->marital_status }}</div>
                    <div>Dependents: {{ $loan->no_of_dependents }}</div>
                    <div>License: {{ $loan->driving_licence_type }}</div>
                </td>
                <td>
                    <div>Amount: ${{ number_format($loan->loan_amount, 2) }}</div>
                    <div>Weekly: ${{ number_format($loan->weekly_payment, 2) }}</div>
                    <div>Term: {{ $loan->term_years }} years</div>
                </td>
                <td>
                    <div>{{ $loan->country_code ?? '' }} {{ $loan->mobile }}</div>
                    <div>{{ $loan->email }}</div>
                    <div>Contact: {{ $loan->preferred_contact }}</div>
                </td>
                <td>
                    <div>{{ $loan->street_address }}</div>
                    <div>{{ $loan->address_line2 }}</div>
                    <div>{{ $loan->city }}</div>
                    <div>{{ $loan->postal_code }}</div>
                    <div>Status: {{ $loan->property_status }}</div>
                    <div>Time: {{ $loan->time_at_property_years }}y {{ $loan->time_at_property_months }}m</div>
                    <div>Cost: ${{ number_format($loan->monthly_cost, 2) }}/month</div>
                </td>
                <td>
                    <div>Status: {{ $loan->employment_status }}</div>
                    <div>Title: {{ $loan->job_title }}</div>
                    <div>Time: {{ $loan->time_at_employer_years }}y {{ $loan->time_at_employer_months }}m</div>
                    <div>Resident: {{ $loan->residential_status }}</div>
                </td>
                <td>

                    @if($loan->otp_verified)
                    <span class="badge bg-success mt-1">OTP Verified</span>
                    @else
                    <span class="badge bg-danger mt-1">OTP Pending</span>
                    @endif
                    @php
                    $statusColors = [
                    'eligible' => 'bg-success',
                    'not eligible' => 'bg-danger',
                    'pending' => 'bg-warning text-dark',
                    'lost' => 'bg-danger',
                    'working' => 'bg-info',
                    'progress' => 'bg-primary',
                    'no response' => 'bg-dark',
                    'won' => 'bg-success',
                    ];

                    $statusKey = strtolower($loan->status);
                    @endphp

                    @if($loan->status)
                    <div class="badge mt-1 {{ $statusColors[$statusKey] ?? 'bg-secondary' }}">
                        {{ ucfirst(str_replace('_', ' ', $loan->status)) }}
                    </div>
                    @endif

                    @if($loan->disapproval_reason)
                    <div class="text-danger mt-1 small">{{ $loan->disapproval_reason }}</div>
                    @endif
                </td>
                <td>
                    <a type="button"
                        class="btn btn-sm btn-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#statusModal"
                        data-loan-id="{{ $loan->id }}"
                        data-status="{{ $loan->status }}">
                        <i class="fa fa-circle-o-notch" aria-hidden="true"></i>
                    </a>

                </td>

                <!-- Modal -->
                <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <form method="POST" action="{{ route('updateStatus') }}">
                            @csrf
                            <input type="hidden" name="id" id="modalLoanId">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="statusModalLabel">Update Loan Status</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Select Status</label>
                                        <select name="status" id="statusSelect" class="form-select" required>
                                            <option value="">Select</option>
                                            <option value="eligible">Eligible</option>
                                            <option value="not eligible">Not Eligible</option>
                                            <option value="pending">Pending</option>
                                            <option value="lost">Lost</option>
                                            <option value="working">Working</option>
                                            <option value="progress">Progress</option>
                                            <option value="no response">No Response</option>
                                            <option value="won">Won</option>
                                        </select>
                                    </div>
                                    <div id="reasondid" style="display: none;">
                                        <div class="mb-3">
                                            <label>Reason </label>
                                            <textarea class="form-control" id="reasonname" name="reason"></textarea>
                                        </div>
                                    </div>
                                    <script>
                                        $(function() {
                                            $('#statusSelect').on('change', function() {
                                                if (this.value === 'not eligible') {
                                                    $('#reasondid').show();
                                                    $('#reasonname').prop('required', true);
                                                } else {
                                                    $('#reasondid').hide();
                                                    $('#reasonname').prop('required', false);
                                                }
                                            });
                                        });
                                    </script>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </tr>

            @endforeach
            @endif()
        </tbody>
    </table>

    <div class="row">
        <div class="mt-4 d-flex justify-content-end">
            <div class="pagination-container">
                {{-- Previous Link --}}
                @if ($leads->onFirstPage())
                <span class="page-link disabled">Previous</span>
                @else
                <a href="{{ $leads->previousPageUrl() }}" class="page-link">Previous</a>
                @endif

                {{-- Page Numbers --}}
                @php
                $current = $leads->currentPage();
                $last = $leads->lastPage();
                $start = max(1, $current - 2);
                $end = min($last, $current + 2);
                @endphp

                {{-- Always show first page --}}
                @if ($start > 1)
                <a href="{{ $leads->url(1) }}" class="page-link {{ $current == 1 ? 'active' : '' }}">1</a>
                @if ($start > 2)
                <span class="page-link dots">...</span>
                @endif
                @endif

                {{-- Main loop --}}
                @for ($i = $start; $i <= $end; $i++)
                    <a href="{{ $leads->url($i) }}" class="page-link {{ $current == $i ? 'active' : '' }}">{{ $i }}</a>
                    @endfor

                    {{-- Always show last page --}}
                    @if ($end < $last)
                        @if ($end < $last - 1)
                        <span class="page-link dots">...</span>
                        @endif
                        <a href="{{ $leads->url($last) }}" class="page-link {{ $current == $last ? 'active' : '' }}">{{ $last }}</a>
                        @endif

                        {{-- Next Link --}}
                        @if ($leads->hasMorePages())
                        <a href="{{ $leads->nextPageUrl() }}" class="page-link">Next</a>
                        @else
                        <span class="page-link disabled">Next</span>
                        @endif
            </div>
        </div>
    </div>

    <style>
        .pagination-container {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            padding: 8px 12px;
        }

        .page-link {
            padding: 8px 14px;
            background: white;
            color: #43b9b2;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease-in-out;
        }

        .page-link:hover:not(.active):not(.disabled) {
            background-color: rgba(67, 185, 178, 0.1);
            color: #43b9b2;
            border-color: #43b9b2;
        }

        .page-link.active {
            background-color: #43b9b2;
            color: white;
            border-color: #43b9b2;
        }

        .page-link.disabled {
            background-color: #f8f9fa;
            color: #ccc;
            cursor: not-allowed;
            border-color: #ddd;
        }

        .page-link.dots {
            cursor: default;
            background: transparent;
            border: none;
            color: #999;
            padding: 8px 10px;
        }
    </style>




</div>
</div>
</div>

<!-- Offcanvas for Lead Info -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="leadInfoCanvas" aria-labelledby="leadInfoCanvasLabel">
    <div class="offcanvas-header bg-success text-white">
        <h5 class="mb-0"><i class="fa-solid fa-info-circle me-2"></i> Lead Details</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body bg-light p-4">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <div class="rounded-circle bg-white mx-auto mb-3" style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid fa-user text-secondary" style="font-size: 36px;"></i>
                    </div>
                    <h5 class="fw-semibold mb-1" id="canvasName">John Lead</h5>
                    <span class="text-muted" id="canvasStatus">Status</span>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between">
                        <div><i class="fa-solid fa-envelope me-2 text-primary"></i>Email</div>
                        <span id="canvasEmail"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <div><i class="fa-solid fa-building me-2 text-info"></i>Company</div>
                        <span id="canvasCompany"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <div><i class="fa-solid fa-phone me-2 text-success"></i>Phone</div>
                        <span id="canvasPhone"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <div><i class="fa-solid fa-user-tie me-2 text-muted"></i>Assigned</div>
                        <span id="canvasAssigned"></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Import Leads Modal -->
<div class="modal fade" id="importLeadsModal" tabindex="-1" aria-labelledby="importLeadsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('admin.leads.import') }}" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="importLeadsModalLabel"><i class="fa-solid fa-file-import me-2"></i>Import Leads</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label for="company_id" class="form-label">Select Company</label>
                    <select name="company_id" id="company_id" class="form-select" required>
                        <option value="">Choose Company</option>
                        @foreach($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="excel_file" class="form-label">Upload Excel File</label>
                    <input type="file" name="excel_file" id="excel_file" accept=".xls,.xlsx" class="form-control" required>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-success" id="leadImportButton" onclick="changetext()"><i class="fa-solid fa-upload me-1"></i>Upload</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>


<script>
    $(document).ready(function() {
        function changetext() {
            $('#leadImportButton').text('Please wait..');

        }
        // Tooltip init
        $('[data-bs-toggle="tooltip"]').tooltip();

        // Offcanvas data fill
        $(document).on('click', '.show-lead-info', function() {
            $('#canvasName').text($(this).data('name') || 'N/A');
            $('#canvasEmail').text($(this).data('email') || 'N/A');
            $('#canvasCompany').text($(this).data('company') || 'N/A');
            $('#canvasPhone').text($(this).data('phone') || 'N/A');
            $('#canvasStatus').text($(this).data('status') || 'N/A');
            $('#canvasAssigned').text($(this).data('assigned') || 'N/A');
        });

        $('#userFilterForm').submit(function(e) {
            e.preventDefault();

            // UI: show loading
            $('#applyFilterBtn .default-text').addClass('d-none');
            $('#applyFilterBtn .loading-text').removeClass('d-none');

            // Prepare filter parameters
            const company_id = $('#filterCompany').val();
            const search = $('#searchInput').val();

            const fromDate = $('#fromDate').val();
            const toDate = $('#toDate').val();

            $.ajax({
                url: `{{ route('admin.finance.filter') }}`,
                method: 'POST',
                data: {
                    company_id,
                    search,
                    fromDate,
                    toDate,
                    status: $('#status').val(),
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    $('#leadsTable').html(response.table);

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