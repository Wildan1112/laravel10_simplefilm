@extends('be.layouts.app')
@section('pageTitle', 'Import Type from Excel')
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('type.index') }}">Type</a></li>
            <li class="breadcrumb-item active" aria-current="page">Import</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <h6 class="card-title">Import Data Type from Excel</h6>

                    <form class="forms-sample" action="{{ route('import.type') }}" method="POST"
                        enctype="multipart/form-data">

                        @csrf
                        <div class="mb-3">
                            <label for="file" class="form-label">Import File Excel / CSV</label>
                            <input type="file" name="file" class="form-control @error('file') is-invalid @enderror"
                                id="name" autofocus autocomplete="off" placeholder="Import File">
                            @error('file')
                                <label id="file" class="error invalid-feedback" for="file">{{ $message }}</label>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success">Import</button>
                    </form>

                </div>
            </div>
        </div>
    @endsection
