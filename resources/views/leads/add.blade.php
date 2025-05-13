@extends('layout')

@section('content')
<div class="container-fluid mt-4">

    <!-- Page Title -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Add New Lead</h2>
                <a href="{{ route('all-leads') }}" class="btn btn-outline-secondary btn-sm">← Back to Leads</a>
            </div>
        </div>
    </div>

    <!-- Lead Form Card -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">

            <h5 class="card-title mb-4 text-secondary">Lead Information</h5>

            <form action="" method="POST">
                @csrf
                <div class="row g-3">

                    <!-- Name -->
                    <div class="col-md-6">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter full name" required>
                    </div>

                    <!-- Email -->
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="example@email.com" required>
                    </div>

                    <!-- Mobile Number -->
                    <div class="col-md-6">
                        <label for="mobile_number" class="form-label">Mobile Number</label>
                        <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="e.g. 9876543210" required>
                    </div>

                    <!-- Company -->
                    <div class="col-md-6">
                        <label for="company_id" class="form-label">Company</label>
                        <select class="form-select" name="company_id" id="company_id" required>
                            <option value="" selected disabled>Select a company</option>
                            <option value="1">Esteem Finance</option>
                            <option value="2">Esteem Cars</option>
                            <option value="3">We Care Auto Repairs</option>
                        </select>
                    </div>

                    <!-- Source -->
                    <div class="col-md-6">
                        <label for="source" class="form-label">Source</label>
                        <input type="text" class="form-control" id="source" name="source" placeholder="e.g. Website, Referral, etc." required>
                    </div>

                    <!-- Status -->
                    <div class="col-md-6">
                        <label for="status" class="form-label">Lead Status</label>
                        <input type="text" class="form-control" id="status" name="status" placeholder="e.g. New, Follow-up" required>
                    </div>

                    <!-- State -->
                    <div class="col-md-6">
                        <label for="state" class="form-label">State</label>
                        <input type="text" class="form-control" id="state" name="state" placeholder="Enter location/state" required>
                    </div>

                    <!-- Request Type -->
                    <div class="col-md-6">
                        <label for="request" class="form-label">Request Type</label>
                        <select class="form-select" name="request" id="request" required>
                            <option value="" selected disabled>Select request</option>
                            <option value="Buy">Buy</option>
                            <option value="Sell">Sell</option>
                            <option value="Buy and Sell Both">Buy and Sell Both</option>
                            <option value="Did not Answer">Did not Answer</option>
                            <option value="Scrap">Scrap</option>
                        </select>
                    </div>

                    <!-- Address -->
                    <div class="col-md-6">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter address here..." required></textarea>
                    </div>

                    <!-- Description -->
                    <div class="col-md-6">
                        <label for="description" class="form-label">Lead Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Provide additional details..." required></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-12 text-end mt-3">
                        <button type="submit" class="btn btn-primary px-4">
                            <span id="addUserText">Submit</span>
                            <span id="addUserSpinner" class="spinner-border spinner-border-sm d-none ms-2" role="status" aria-hidden="true"></span>
                        </button>
                    </div>

                </div>
            </form>

        </div>
    </div>

</div>

<!-- Optional Custom Styles -->
<style>
    body {
        background-color: #f0f2f5;
    }

    .form-label {
        font-weight: 500;
    }

    .card-title {
        font-size: 1.1rem;
        font-weight: 600;
    }
</style>
@endsection
