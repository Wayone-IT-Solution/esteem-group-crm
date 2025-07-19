@extends('layout')

@section('content')

    <head>
        {{-- Font Awesome for icons --}}
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        {{-- Bootstrap CSS --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        {{-- Google Fonts: Poppins --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        {{-- Custom Styles --}}
        <style>
            body {
                background-color: #f7f8fc;
                font-family: 'Poppins', sans-serif;
            }

            .card {
                border: none;
                border-radius: 12px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
                margin-bottom: 1.5rem;
                overflow: hidden;
            }

            .card-header {
                font-weight: 600;
                font-size: 1.1rem;
                padding: 1rem 1.5rem;
                color: #fff;
                border-bottom: none;
            }

            .card-body {
                padding: 1.5rem;
            }

            .form-label {
                font-weight: 500;
                color: #555;
            }

            .form-control,
            .form-select {
                border-radius: 8px;
                border: 1px solid #e0e0e0;
                padding: 0.75rem 1rem;
                background-color: #fdfdff;
            }

            .form-control:focus,
            .form-select:focus {
                border-color: #4a90e2;
                box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.15);
            }

            .file-input-display {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 0.75rem 1rem;
                border: 1px solid #e0e0e0;
                border-radius: 8px;
                background-color: #f8f9fa;
            }

            .file-input-display a {
                color: #4a90e2;
                text-decoration: none;
                font-weight: 500;
            }

            .file-input-display a:hover {
                text-decoration: underline;
            }

            .btn-primary {
                background-image: linear-gradient(to right, #4a90e2 0%, #2772c3 100%);
                border: none;
                border-radius: 8px;
                padding: 0.75rem 1.5rem;
                font-weight: 600;
                transition: all 0.3s ease;
                box-shadow: 0 4px 10px rgba(74, 144, 226, 0.2);
            }

            .btn-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 15px rgba(74, 144, 226, 0.3);
            }

            .btn-secondary {
                border-radius: 8px;
                padding: 0.75rem 1.5rem;
                font-weight: 600;
            }

            .applicant-header {
                background: white;
                padding: 1.5rem;
                border-radius: 12px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
                margin-bottom: 2rem;
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            .applicant-avatar {
                width: 60px;
                height: 60px;
                border-radius: 50%;
                background-image: linear-gradient(135deg, #89f7fe 0%, #66a6ff 100%);
                color: white;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.75rem;
                font-weight: 700;
            }

            /* Card Header Colors */
            .header-blue {
                background-color: #4a90e2;
            }

            .header-green {
                background-color: #50cda9;
            }

            .header-purple {
                background-color: #9068d3;
            }

            .header-teal {
                background-color: #47c1bf;
            }

            .header-orange {
                background-color: #f5a623;
            }

            .header-slate {
                background-color: #64748b;
            }
        </style>
    </head>

    <div class="container my-5">
        {{-- Header and Back Button --}}
        <div class="applicant-header">
            <div class="d-flex align-items-center">
                <div class="applicant-avatar me-3">
                    {{ strtoupper(substr($loan->first_name, 0, 1)) }}
                </div>
                <div>
                    <h1 class="h4 fw-bold text-dark mb-0">{{ $loan->first_name }} {{ $loan->last_name }}</h1>
                    <p class="text-muted mb-0">Editing Loan Application ID: {{ $loan->id }}</p>
                </div>
            </div>
            <a href="{{ url()->previous() }}" class="btn btn-light btn-sm">
                <i class="fa fa-arrow-left me-1"></i> Back
            </a>
        </div>


      <form action="{{ route('loan.update', ['id' => $loan->id]) }}" id="commanform" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-lg-8">
                    <!-- Loan Details Section -->
                    <div class="card">
                        <div class="card-header header-blue">Loan Details</div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="loan_amount" class="form-label">Loan Amount ($)</label>
                                    <input type="number" step="0.01" id="loan_amount" name="loan_amount"
                                        value="{{ $loan->loan_amount }}" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="weekly_payment" class="form-label">Weekly Payment ($)</label>
                                    <input type="number" step="0.01" id="weekly_payment" name="weekly_payment"
                                        value="{{ $loan->weekly_payment }}" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="term_years" class="form-label">Term (Years)</label>
                                    <input type="number" id="term_years" name="term_years" value="{{ $loan->term_years }}"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Personal Information Section -->
                    <div class="card">
                        <div class="card-header header-green">Personal Information</div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="title" class="form-label">Title</label>
                                    <select id="title" name="title" class="form-select">
                                        @foreach (['Mr', 'Mrs', 'Miss', 'Ms'] as $title)
                                            <option value="{{ $title }}"
                                                @if ($loan->title == $title) selected @endif>{{ $title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" id="first_name" name="first_name" value="{{ $loan->first_name }}"
                                        class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" id="last_name" name="last_name" value="{{ $loan->last_name }}"
                                        class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="date_of_birth" class="form-label">Date of Birth</label>
                                    <input type="date" id="date_of_birth" name="date_of_birth"
                                        value="{{ $loan->date_of_birth }}" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="marital_status" class="form-label">Marital Status</label>
                                    <input type="text" id="marital_status" name="marital_status"
                                        value="{{ $loan->marital_status }}" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="no_of_dependents" class="form-label">Dependents</label>
                                    <input type="number" id="no_of_dependents" name="no_of_dependents"
                                        value="{{ $loan->no_of_dependents }}" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label for="driving_licence_type" class="form-label">Driving Licence Type</label>
                                    <select id="driving_licence_type" name="driving_licence_type" class="form-select">
                                        @foreach (['Restricted', 'Full Licence', 'Learner', 'No Licence', 'International', 'Other'] as $type)
                                            <option value="{{ $type }}"
                                                @if ($loan->driving_licence_type == $type) selected @endif>{{ $type }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact & Address Section -->
                    <div class="card">
                        <div class="card-header header-purple">Contact & Address</div>
                        <div class="card-body">
                            <h5 class="card-title h6">Contact Details</h5>
                            <div class="row g-3 mb-4">
                                <div class="col-md-3">
                                    <label for="country_code" class="form-label">Code</label>
                                    <input type="text" id="country_code" name="country_code"
                                        value="{{ $loan->country_code }}" class="form-control">
                                </div>
                                <div class="col-md-5">
                                    <label for="mobile" class="form-label">Mobile</label>
                                    <input type="tel" id="mobile" name="mobile" value="{{ $loan->mobile }}"
                                        class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="preferred_contact" class="form-label">Preferred Contact</label>
                                    <select id="preferred_contact" name="preferred_contact" class="form-select">
                                        @foreach (['Phone', 'SMS', 'Email', 'Facebook Messenger', 'WhatsApp', 'Signal'] as $method)
                                            <option value="{{ $method }}"
                                                @if ($loan->preferred_contact == $method) selected @endif>{{ $method }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" id="email" name="email" value="{{ $loan->email }}"
                                        class="form-control">
                                </div>
                            </div>
                            <hr>
                            <h5 class="card-title h6 mt-4">Address Details</h5>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="street_address" class="form-label">Street Address</label>
                                    <input type="text" id="street_address" name="street_address"
                                        value="{{ $loan->street_address }}" class="form-control">
                                </div>
                                <div class="col-12">
                                    <label for="address_line2" class="form-label">Address Line 2</label>
                                    <input type="text" id="address_line2" name="address_line2"
                                        value="{{ $loan->address_line2 }}" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" id="city" name="city" value="{{ $loan->city }}"
                                        class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="region" class="form-label">Region</label>
                                    <input type="text" id="region" name="region" value="{{ $loan->region }}"
                                        class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="postal_code" class="form-label">Postal Code</label>
                                    <input type="text" id="postal_code" name="postal_code"
                                        value="{{ $loan->postal_code }}" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="property_status" class="form-label">Property Status</label>
                                    <input type="text" id="property_status" name="property_status"
                                        value="{{ $loan->property_status }}" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Time at Property</label>
                                    <div class="input-group">
                                        <input type="number" name="time_at_property_years"
                                            value="{{ $loan->time_at_property_years }}" class="form-control"
                                            placeholder="Years">
                                        <input type="number" name="time_at_property_months"
                                            value="{{ $loan->time_at_property_months }}" class="form-control"
                                            placeholder="Months">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="monthly_cost" class="form-label">Monthly Cost ($)</label>
                                    <input type="number" step="0.01" id="monthly_cost" name="monthly_cost"
                                        value="{{ $loan->monthly_cost }}" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Employment & Residency Section -->
                    <div class="card">
                        <div class="card-header header-teal">Employment & Residency</div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="residential_status" class="form-label">Residential Status</label>
                                    <select id="residential_status" name="residential_status" class="form-select">
                                        @foreach (['NZ Citizen', 'NZ Resident', 'Non NZ Resident', 'Work Visa'] as $status)
                                            <option value="{{ $status }}"
                                                @if ($loan->residential_status == $status) selected @endif>{{ $status }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="employment_status" class="form-label">Employment Status</label>
                                    <select id="employment_status" name="employment_status" class="form-select">
                                        @foreach (['Employed Full-Time', 'Employed Part-Time', 'Contractor', 'Self Employed', 'Unemployed', 'Disabled', 'Temporary', 'Retired', 'WINZ', 'ACC', 'WINZ & ACC', 'Studylink', 'Super-Annuation', 'Casual'] as $status)
                                            <option value="{{ $status }}"
                                                @if ($loan->employment_status == $status) selected @endif>{{ $status }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="job_title" class="form-label">Job Title / Occupation</label>
                                    <input type="text" id="job_title" name="job_title"
                                        value="{{ $loan->job_title }}" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Time with Employer</label>
                                    <div class="input-group">
                                        <input type="number" name="time_at_employer_years"
                                            value="{{ $loan->time_at_employer_years }}" class="form-control"
                                            placeholder="Years">
                                        <input type="number" name="time_at_employer_months"
                                            value="{{ $loan->time_at_employer_months }}" class="form-control"
                                            placeholder="Months">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <!-- Status and Admin Section -->
                    <div class="card">
                        <div class="card-header header-orange">Application Status & Admin</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="status" class="form-label">Update Status</label>
                                <select id="status" name="status" class="form-select">
                                    @foreach (['Pending', 'Eligible', 'Not Eligible', 'Completed', 'Lost', 'Working', 'Progress', 'No Response', 'Won'] as $status)
                                        <option value="{{ $status }}"
                                            @if ($loan->status == $status) selected @endif>{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="disapproval_reason" class="form-label">Reason for Disapproval</label>
                                <textarea id="disapproval_reason" name="disapproval_reason" rows="4" class="form-control">{{ $loan->disapproval_reason }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Document Uploads Section -->
                    <div class="card">
                        <div class="card-header header-slate">Uploaded Documents</div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="license_number" class="form-label">License Number</label>
                                    <input type="text" id="license_number" name="license_number"
                                        value="{{ $loan->license_number ?? '' }}" class="form-control">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Driver's License</label>
                                    @if ($loan->license_file ?? false)
                                        <div class="file-input-display mb-2">
                                            <a href="/storage/{{ $loan->license_file }}" target="_blank"><i
                                                    class="fa fa-file-pdf me-2 text-danger"></i>{{ basename($loan->license_file) }}</a>
                                        </div>
                                    @endif
                                    <input type="file" name="license_file" class="form-control form-control-sm">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Payslip 1</label>
                                    @if ($loan->payslip1 ?? false)
                                        <div class="file-input-display mb-2">
                                            <a href="/storage/{{ $loan->payslip1 }}" target="_blank"><i
                                                    class="fa fa-file-invoice-dollar me-2 text-success"></i>{{ basename($loan->payslip1) }}</a>
                                        </div>
                                    @endif
                                    <input type="file" name="payslip1" class="form-control form-control-sm">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Payslip 2</label>
                                    @if ($loan->payslip2 ?? false)
                                        <div class="file-input-display mb-2">
                                            <a href="/storage/{{ $loan->payslip2 }}" target="_blank"><i
                                                    class="fa fa-file-invoice-dollar me-2 text-success"></i>{{ basename($loan->payslip2) }}</a>
                                        </div>
                                    @endif
                                    <input type="file" name="payslip2" class="form-control form-control-sm">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Photo ID</label>
                                    @if ($loan->photo ?? false)
                                        <div class="file-input-display mb-2">
                                            <a href="/storage/{{ $loan->photo }}" target="_blank"><i
                                                    class="fa fa-id-card me-2 text-info"></i>{{ basename($loan->photo) }}</a>
                                        </div>
                                    @endif
                                    <input type="file" name="photo" class="form-control form-control-sm">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">WINZ Breakdown</label>
                                    @if ($loan->winz_breakdown ?? false)
                                        <div class="file-input-display mb-2">
                                            <a href="/storage/{{ $loan->winz_breakdown }}" target="_blank"><i
                                                    class="fa fa-file-alt me-2 text-secondary"></i>{{ basename($loan->winz_breakdown) }}</a>
                                        </div>
                                    @endif
                                    <input type="file" name="winz_breakdown" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="mt-4 pt-4 border-top d-flex justify-content-end align-items-center gap-2">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary px-4">
                    <i class="fa fa-save me-1"></i> Save Changes
                </button>
            </div>
        </form>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection
