@extends('be.layouts.app')
@section('pageTitle', "Edit Network $network->name")

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('network.index') }}">Network</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <h6 class="card-title">Edit Network - {{ $network->name }}</h6>

                    <form class="forms-sample" action="{{ route('network.update', $network->slug) }}" method="POST">

                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Network</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                id="name" autocomplete="off" placeholder="Network Name"
                                value="{{ old('name', $network->name) }}">
                            @error('name')
                                <label id="name-error" class="error invalid-feedback" for="name">{{ $message }}</label>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success">Save Edit</button>
                    </form>

                </div>
            </div>
        </div>
    @endsection
