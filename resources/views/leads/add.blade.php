@extends('layout')

@section('content')
<div class="container mt-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Add New Enquiry</h3>
        <a href="{{ route('all-leads') }}" class="btn btn-primary btn-sm">
            <i class="fa fa-arrow-left me-1"></i> Back to Enquiries
        </a>
    </div>

    <!-- Card -->
    <div class="card shadow border-0">
        <div class="card-body p-4">


            <form id="commanform" action="{{ route('leads.store') }}" method="POST">
                @csrf



                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="company_id" class="form-label">Company</label>
                        <select name="company_id" id="company_id" class="form-select" required>
                            <option value="" disabled selected>Select a company</option>
                            @foreach($companies as $companyOption)
                            <option value="{{ $companyOption->id }}">{{ $companyOption->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="request" class="form-label">Request Type</label>
                        <select name="requestfor" id="requestfor" class="form-select" required>
                            <option value="" disabled selected>Select request</option>

                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="status" class="form-label">Lead Status</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="" disabled selected>Select a company first</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" name="name" id="name" class="form-control" required placeholder="Enter full name">
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" name="email" id="email" class="form-control" required placeholder="example@email.com">
                    </div>

                    <div class="col-md-3">
                        <label for="mobile_number" class="form-label">Mobile Number</label>
                        <input type="text" name="mobile_number" id="mobile_number" class="form-control" required placeholder="e.g. 9876543210">
                    </div>


                    <div class="col-md-3">
                        <label for="source" class="form-label">Source</label>
                        <input type="text" name="source" id="source" class="form-control" required placeholder="e.g. Website, Referral">
                    </div>



                    <div class="col-md-6">
                        <label for="state" class="form-label">State</label>
                        <input type="text" name="state" id="state" class="form-control" required placeholder="Enter state">
                    </div>


                    <div class="col-md-6">
                        <label for="address" class="form-label">Address</label>
                        <textarea name="address" id="address" rows="3" class="form-control" required placeholder="Enter address..."></textarea>
                    </div>

                    <div class="col-md-6">
                        <label for="description" class="form-label">Lead Description</label>
                        <textarea name="description" id="description" rows="3" class="form-control" required placeholder="Enter additional details..."></textarea>
                    </div>
                    <div class="col-md-12">
                        <label for="users" class="form-label">Assign Lead</label>
                        <select name="users" id="users" class="form-select" required>
                            <option value="" disabled selected>Select a Employee</option>
                        </select>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary px-4" id="commanButton">
                        <span id="addUserText">Submit</span>
                        <span id="addUserSpinner" class="spinner-border spinner-border-sm d-none ms-2" role="status" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- JS -->
<script>
    document.getElementById('company_id').addEventListener('change', function() {
        const companyId = this.value;
        const statusSelect = document.getElementById('status');
        const requestSelect = document.getElementById('requestfor');
        const usersSelect = document.getElementById('users');

        statusSelect.innerHTML = `<option disabled selected>Loading...</option>`;
        requestSelect.innerHTML = `<option disabled selected>Loading...</option>`;
        usersSelect.innerHTML = `<option disabled selected>Loading...</option>`;

        fetch(`/admin/companies/get-statuses/${companyId}`)
            .then(response => response.json())
            .then(data => {
                statusSelect.innerHTML = '<option disabled selected>Select status</option>';
                requestSelect.innerHTML = '<option disabled selected>Select Request</option>';
                usersSelect.innerHTML = '<option disabled selected>Select Employee</option>';
                data.statuses.forEach(status => {
                    const option = document.createElement('option');
                    option.value = status.status;
                    option.textContent = status.status;
                    statusSelect.appendChild(option);
                });

                data.requests.forEach(status => {
                    const option = document.createElement('option');
                    option.value = status.request;
                    option.textContent = status.request;
                    requestSelect.appendChild(option);
                });
                 data.users.forEach(status => {
                    const option = document.createElement('option');
                    option.value = status.id;
                    option.textContent = status.name;
                    usersSelect.appendChild(option);
                });
            })
            .catch(err => {
                statusSelect.innerHTML = '<option disabled>Error loading statuses</option>';
                console.error('Status fetch error:', err);
            });
    });

    document.querySelector('form').addEventListener('submit', function() {
        document.getElementById('addUserText').textContent = 'Submitting...';
        document.getElementById('addUserSpinner').classList.remove('d-none');
    });
</script>
@endsection