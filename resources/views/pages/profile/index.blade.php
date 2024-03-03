@extends('be.layouts.app')
@section('pageTitle', 'Profile')

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-4 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center ">
                        <img class="wd-80 ht-80 rounded-circle" src="https://via.placeholder.com/80x80" alt="">
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Name:</label>
                        <p class="text-muted">{{ Auth::user()->name }}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Username:</label>
                        <p class="text-muted">{{ Auth::user()->username }}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Email:</label>
                        <p class="text-muted">{{ Auth::user()->email }}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Website:</label>
                        <p class="text-muted">www.nobleui.com</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Joined:</label>
                        <p class="text-muted">{{ Auth::user()->created_at->format('d M, Y') }}</p>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-8 grid-margin">
            <div class="card">
                <div class="card-body">

                    <div class="mb-3">
                        <label for="exampleInputUsername1" class="form-label">Name</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" autocomplete="off"
                            placeholder="Name">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputUsername1" class="form-label">Username</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" autocomplete="off"
                            placeholder="Username">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                    </div>

                    <button type="submit" class="btn btn-primary me-2">Save</button>


                </div>
            </div>
        </div>
    @endsection
