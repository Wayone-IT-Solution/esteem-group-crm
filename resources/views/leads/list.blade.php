@extends('layout')

@section('content')
<!-- Lead Management Dashboard -->
<div class="container-fluid mt-4">

    <!-- Page Title -->
    <div class="row mb-3">
        <div class="col-12">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h2 class="fw-bold mb-0">All Leads</h2>
                <div class="page-title-right">
                    <!-- Additional action buttons can go here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white p-3 rounded shadow-sm mb-4">
        <div class="row g-3 align-items-end">

            <div class="col-md-3">
                <label class="form-label fw-semibold">Select Company</label>
                <select class="form-select">
                    <option selected>Select Company Name</option>
                    <option value="1">Esteem Finance</option>
                    <option value="2">Esteem Cars</option>
                    <option value="3">We Care Auto Repairs</option>
                </select>
            </div>

            <div class="col-md-2">
                <label class="form-label fw-semibold">From Date</label>
                <input type="date" class="form-control">
            </div>

            <div class="col-md-2">
                <label class="form-label fw-semibold">To Date</label>
                <input type="date" class="form-control">
            </div>

            <div class="col-md-3">
                <label class="form-label fw-semibold">Search</label>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Lead ID or Name">
                    <button class="btn btn-primary btn-sm" type="submit">Add Filter</button>
                </div>
            </div>

            <div class="col-md-2 text-end">
                <a href="{{ route('add-leads') }}" class="btn btn-primary w-100">
                    <i class="ri-add-fill me-1"></i> Add Lead
                </a>
            </div>
        </div>
    </div>

    <!-- Leads Table -->
    <div class="bg-white p-4 rounded shadow-sm">
        <h4 class="mb-3 fw-semibold">Leads Overview</h4>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>S.no.</th>
                        <th>Lead Code</th>
                        <th>Vehicle</th>
                        <th>Lead Date</th>
                        <th>Client Name</th>
                        <th>Mobile</th>
                        <th>Request</th>
                        <th>Status</th>
                        <th>Source</th>
                        <th>Assign RA</th>
                        <th>Assign SRA/QC/B2B</th>
                        <th>Assign CE</th>
                        <th>Assign DRM</th>
                        <th>Assign CA</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>LD1001</td>
                        <td>Honda City</td>
                        <td>2025-05-13</td>
                        <td>Rahul Sharma</td>
                        <td>9876543210</td>
                        <td>Test Drive</td>
                        <td><span class="badge bg-warning text-dark">Pending</span></td>
                        <td>Website</td>
                        <td>RA1</td>
                        <td>SRA1</td>
                        <td>CE1</td>
                        <td>DRM1</td>
                        <td>CA1</td>
                        <td><button class="btn btn-sm btn-outline-primary">View</button></td>
<td>
 <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete()">Delete</button></td>
                    </tr>
                    <!-- Add more rows here -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .form-label {
        font-size: 0.875rem;
    }

    .table th, .table td {
        vertical-align: middle !important;
    }

    .table thead th {
        font-size: 0.9rem;
    }

    .btn-sm {
        padding: 0.35rem 0.65rem;
        font-size: 0.8rem;
    }

    .shadow-sm {
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    }
</style>

<script>
    function showDeleteAlert() {
        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // TODO: Call delete action or submit form
                Swal.fire(
                    'Deleted!',
                    'Your lead has been deleted.',
                    'success'
                )
            }
        })
    }
</script>

    @endsection
