@extends('layout')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<div class="container my-5">
    <div class="card border-0 shadow rounded-4">
        <div class="card-header bg-white border-bottom py-4 px-4">
            <div style="display:flex;justify-content:space-between">
                <h4 class="mb-0 text-dark">
                    <i class="fa-solid fa-user-plus me-2"></i> Update Password ({{ $user->name ?? '' }})
                </h4>
            </div>
        </div>

        <div class="card-body bg-white px-4 rounded-bottom-4">
            <form action="{{ route('profile.password.update') }}" method="POST" class="space-y-5">
                @csrf
                <div class="mb-5">
                <div class="mb-4">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Password <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="password" name="password" placeholder="Create a password">
                            <div class="text-danger" id="password-error"></div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-5">
                    <button type="submit" id="commanButton" class="btn btn-primary px-5">
                        <i class="fa-solid fa-paper-plane me-1"></i> Submit
                        <span class="spinner-border spinner-border-sm d-none ms-2" role="status" aria-hidden="true" id="userSubmitSpinner"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
