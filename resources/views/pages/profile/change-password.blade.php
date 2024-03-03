@extends('be.layouts.app')
@section('pageTitle', 'Change Password')

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Change Password</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-6 grid-margin">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('post.change.password') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input name="current_password" type="password"
                                class="form-control @error('current_password') is-invalid @enderror" id="current_password"
                                autocomplete="off">
                            @error('current_password')
                                <label id="current_password-error" class="error invalid-feedback"
                                    for="current_password">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input name="new_password" type="password"
                                class="form-control @error('new_password') is-invalid @enderror" id="new_password"
                                autocomplete="off">
                            @error('new_password')
                                <label id="new_password-error" class="error invalid-feedback"
                                    for="new_password">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">Confirm Password</label>
                            <input name="new_password_confirmation" type="password"
                                class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                id="new_password_confirmation" autocomplete="off">
                            @error('new_password_confirmation')
                                <label id="new_password_confirmation-error" class="error invalid-feedback"
                                    for="new_password_confirmation">{{ $message }}</label>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Save</button>
                    </form>

                </div>
            </div>
        </div>
    @endsection
