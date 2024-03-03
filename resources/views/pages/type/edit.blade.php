@extends('be.layouts.app')
@section('pageTitle', "Edit Type $type->name")

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('type.index') }}">Type</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <h6 class="card-title">Edit Type - {{ $type->name }}</h6>

                    <form class="forms-sample" action="{{ route('type.update', $type->slug) }}" method="POST">

                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Type</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                id="name" autocomplete="off" placeholder="Type Name"
                                value="{{ old('name', $type->name) }}">
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
