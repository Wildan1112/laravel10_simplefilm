@extends('be.layouts.app')
@section('pageTitle', 'Add Genre')
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('genre.index') }}">Genre</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <h6 class="card-title">Add Genre</h6>

                    <form class="forms-sample" action="{{ route('genre.store') }}" method="POST">

                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Genre</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                id="name" autofocus autocomplete="off" placeholder="Genre Name"
                                value={{ old('name') }}>
                            @error('name')
                                <label id="name-error" class="error invalid-feedback" for="name">{{ $message }}</label>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success">Add Genre</button>
                    </form>

                </div>
            </div>
        </div>
    @endsection
