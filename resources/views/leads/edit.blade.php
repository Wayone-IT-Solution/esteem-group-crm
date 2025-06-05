@extends('layout')

@section('content')
<div class="row">
    <div class="col-md-10"></div>
    <div class="col-md-2">

        <a href="{{ route('all-leads') }}" class="btn btn-sm btn-primary  mt-3 me-3">
            <i class="fa fa-arrow-left me-1"></i> Back
        </a>

    </div>
</div>
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

<div class="container mt-5">
    <div class="row g-4">



        <!-- Lead Info Card -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0" style="border-radius: 16px; background: linear-gradient(135deg, #e0f7fa, #f1f8e9);">
                <div class="card-body p-4 position-relative">

                    <!-- Back Button Top Right -->

                    <!-- Avatar & Name -->
                    <div class="text-center mb-4">
                        <div class="rounded-circle bg-primary text-white d-inline-flex justify-content-center align-items-center shadow" style="width: 70px; height: 70px; font-size: 28px;">
                            {{ strtoupper(substr($lead->name, 0, 1)) }}
                        </div>
                        <h5 class="mt-3 mb-0 fw-bold">{{ $lead->name }}</h5>
                        <small class="text-muted">{{ $lead->email }}</small>
                        <div class="text-secondary mt-1">{{ $lead->mobile_number }}</div>
                    </div>

                    <hr class="my-3">

                    <!-- 2 Column Info Grid -->
                    <div class="row g-3">
                        <div class="col-6">
                            <strong class="text-dark">Company:</strong>
                            <div class="text-muted">{{ $lead->company->name ?? 'N/A' }}</div>
                        </div>

                        <div class="col-6">
                            <strong class="text-dark">Request Type:</strong>
                            <div class="text-muted">{{ $lead->request ?? 'N/A' }}</div>
                        </div>

                        <div class="col-6">
                            <strong class="text-dark">Email</strong>
                            <div class="text-muted">{{ $lead->email ?? 'N/A' }}</div>
                        </div>

                        <div class="col-6">
                            <strong class="text-dark">Contact Number</strong>
                            <div class="text-muted">{{ $lead->mobile_number ?? 'N/A' }}</div>
                        </div>

                        <div class="col-6">
                            <strong class="text-dark">Status:</strong><br>
                            <span class="badge bg-success mt-1">{{ $lead->status ?? 'N/A' }}</span>
                        </div>

                        <div class="col-6">
                            <strong class="text-dark">Source:</strong>
                            <div class="text-muted">{{ $lead->source }}</div>
                        </div>

                        <div class="col-6">
                            <strong class="text-dark">State:</strong>
                            <div class="text-muted">{{ $lead->state }}</div>
                        </div>
                          <div class="col-6">
                            <strong class="text-dark">State:</strong>
                            <div class="text-muted">{{ $lead->state }}</div>
                        </div>
                        @if($lead->company->name =='Esteem Finance')
                        <div class="col-6">
                            <strong class="text-dark">Earning Criteria</strong>
                            <div class="text-muted">{{ $lead->earning_criteria  ?? ''}}</div>
                        </div>
                        <div class="col-6">
                            <strong class="text-dark">License Type</strong>
                            <div class="text-muted">{{ $lead->license_type  ?? ''}}</div>
                        </div>
                        <div class="col-6">
                            <strong class="text-dark">Income Source</strong>
                            <div class="text-muted">{{ $lead->income_source  ?? ''}}</div>
                        </div>
                        <div class="col-6">
                            <strong class="text-dark">Required Amount</strong>
                            <div class="text-muted">{{ $lead->required_amount  ?? ''}}</div>
                        </div>
                        @endif()
                      

                        <div class="col-6">
                            <strong class="text-dark">Address:</strong>
                            <div class="text-muted">{{ $lead->address }}</div>
                        </div>

                        <div class="col-6">
                            <strong class="text-dark">Last Discussion:</strong>
                            <div class="text-muted">{{ $lead->description }}</div>
                        </div>

                        <div class="col-6">
                            <strong class="text-dark">Assigned To:</strong>
                            <div class="text-muted" style="display: flex; gap: 2px;"> @if(!empty($lead->assinges))
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
                        </div>

                        <div class="col-6">
                            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" onclick="showconversation('{{ $lead->id }}')" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">View Conversation</button>


                        </div>
                    </div>

                </div>
            </div>
        </div>


        <!-- Form to Update Status & Description -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <h5 class="mb-4 text-primary fw-semibold">Update Lead Info</h5>

                    <form action="{{ route('leads.update.description') }}" id="commanform" method="POST">
                        @csrf
                        @method('post')

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="">Select Status</option>
                                @if(!empty($status))
                                @foreach ($status as $list )
                                <option value="{{$list->status}}">{{$list->status}}</option>

                                @endforeach

                                @endif()

                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Update Current Discussion</label>
                            <textarea name="description" id="description" rows="4" class="form-control" required placeholder="Add any comments or notes..."></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Next Follow Up Date</label>
                            <input type="date" name="next_followup" class="form-control">
                        </div>


                        <div class="mb-3">
                            <label for="status" class="form-label">Assign Lead </label>
                            <select name="user_id" id="user_id" class="form-select">
                                <option value="">Select Employee</option>
                                @if(!empty($users))
                                @foreach ($users as $list )
                                <option value="{{$list->id}}">{{$list->name}} / {{ $list->role }}</option>

                                @endforeach

                                @endif()

                            </select>
                        </div>


                        <div class="mb-3">
                            <input type="hidden" name="lead_id" value="{{ $lead->id }}" class="form-control">
                        </div>

                        <div class="text-end">
                            <button type="submit" id="commanButton" class="btn btn-primary px-4">
                                <i class="fa fa-save me-1"></i> Update Conversation
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel" style="width: 900px;">
    <div class="offcanvas-header bg-primary">
        <h5 id="offcanvasRightLabel" class="text-white">All Conversation</h5>
        <button type="button" class="btn-close text-reset text-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body" style="background-color: white;" id="canvasbody">

    </div>
</div>

<script>
    function showconversation(id) {
        $.ajax({
            url: `{{ route('admin.leads.canvas') }}`,
            type: 'POST',
            data: {
                id,

                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                $('#canvasbody').html(response);
                $('[data-bs-toggle="tooltip"]').tooltip(); // Reinitialize tooltip
            },
            error: function() {
                alert('Failed to apply filters');
            }
        });
    }
</script>
@endsection