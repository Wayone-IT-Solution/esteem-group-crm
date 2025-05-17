@extends('layout')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

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

    .btn-add-lead {
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
<div class=" mt-4" style="background-color: white; margin-top: 40px; padding: 30px;">

    <div class="col-md-12">
        <form id="userFilterForm" method="post" action="javascript:void(0);" class="d-flex flex-wrap gap-3 align-items-end">
            <div class="col-md-3">
                <select class="form-select" name="company_id" id="filterCompany">
                    <option value="">All Companies</option>
                    @foreach($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>


            <div class="col-md-3">
                <input type="date" class="form-control" name="from_date" id="fromDate">
            </div>

            <div class="col-md-3">
                <input type="date" class="form-control" name="to_date" id="toDate">
            </div>


            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100" id="applyFilterBtn">
                    <span class="default-text"><i class="fa-solid fa-filter me-1"></i> Filter</span>
                    <span class="loading-text d-none"><i class="fa-solid fa-spinner fa-spin me-1"></i>Wait...</span>
                </button>
            </div>
        </form>

    </div>
</div>

<div class="page-body card mt-4" style="background-color: white; margin-top: 40px; padding: 30px;">
    <div class="container-fluid">
        <div class="row align-items-center mb-3">
            <div class="col-md-8">
                <h4 class="mb-0">All Enquiries</h4>
            </div>

            <div class="col-md-4 text-end">
                <a href="{{ route('admin.leads.create') }}" class="btn btn-primary">
                    <i class="fa-solid fa-plus"></i> Add Enquiry
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table id="leadsTable" class="table table-bordered table-striped">
                <thead class="bg-light">
                    <tr>
                        <th>SNO.</th>
                        <th>Lead Id</th>
                        <th>Name</th>
                        <th>Company</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Description</th>
                        <th>Source</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Assigned To</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leads as $lead)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td> <a href="{{ route('admin.leads.edit', $lead->id) }}">{{ $lead->unique_id }}</a></td>
                        <td>{{ $lead->name }}</td>
                        <td>{{ $lead->company->name ?? 'N/A' }}</td>
                        <td>{{ $lead->email }}</td>
                        <td>{{ $lead->mobile_number }}</td>
                        <td>{{ $lead->address }}</td>
                        <td>{{ $lead->description }}</td>
                        <td>{{ $lead->source }}</td>
                        <td>
                            <span class="badge bg-{{ $lead->status == 'converted' ? 'success' : ($lead->status == 'contacted' ? 'warning' : 'secondary') }}">
                                {{ ucfirst($lead->status) }}
                            </span>
                        </td>
                        <td>{{ date('d-m-Y', strtotime($lead->created_at)) }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-1">
                                @if(!empty($lead->assinges))
                                @foreach ($lead->assinges as $list)
                                @php
                                $user = DB::table('users')->where('id', $list->user_id)->first();
                                $initials = $user ? strtoupper(substr($user->name, 0, 1)) : '?';
                                @endphp
                                <div class="assigned-avatar" data-bs-toggle="tooltip" title="{{ $user->name ?? 'N/A' }}">
                                    {{ $initials }}
                                </div>
                                @endforeach
                                @else
                                <div class="assigned-avatar bg-secondary" data-bs-toggle="tooltip" title="Unassigned">?</div>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-1">

                                <a href="{{ route('admin.leads.edit', $lead->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <button class="btn btn-sm btn-danger" onclick="CommanDelete('delete', 'lead_models', '{{ $lead->id }}')">
                                    <i class="fa-solid fa-trash"></i>
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

<script>
    $(document).ready(function() {
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
            const fromDate = $('#fromDate').val();
            const toDate = $('#toDate').val();

            $.ajax({
                url: `{{ route('admin.leads.filter') }}`, // Make sure this route exists in web.php
                method: 'POST',
                data: {
                    company_id,
                    fromDate,
                    toDate,
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