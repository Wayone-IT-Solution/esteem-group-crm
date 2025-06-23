<table class="table table-bordered">
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
        @if(!empty($loanLeads))
        @foreach($loanLeads as $loan)
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
                    data-status="{{ $loan->status }}"
                    >
                    <i class="fa fa-circle-o-notch" aria-hidden="true"></i>
                </a>
            </td>
            
            <!-- Modal -->
            <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                <form method="POST"  action="{{ route('updateStatus') }}">
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
                                <select name="status" id="status" class="form-select" required>
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
