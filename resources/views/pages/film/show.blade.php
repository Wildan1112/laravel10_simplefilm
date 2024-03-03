@extends('be.layouts.app')
@section('pageTitle', "$film->title")

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('film.index') }}">Film</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $film->title }}</li>
        </ol>

        <div class="col-md-9">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-3 text-center">
                        <img src="{{ asset('storage/posters/' . $film->poster) }}" class="img-fluid rounded-start"
                            alt=""{{ $film->title }} style="height: 4x00px">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <h5 class="card-title">{{ $film->title }}</h5>

                            <div><span>🟣</span> Status : <strong>{{ $film->status->name }}</strong></div>
                            <div><span>🟣</span> Network : <strong>{{ $film->status->name }}</strong></div>
                            <div><span>🟣</span> Type : <strong>{{ $film->type->name }}</strong></div>
                            <div><span>🟣</span> Release : <strong>{{ $film->status->name }}</strong></div>
                            <div><span>🟣</span> Country : <strong>{{ $film->status->name }}</strong></div>
                            <div><span>🟣</span> Studio : <strong>{{ $film->status->name }}</strong></div>

                            <div class="mt-3">
                                <p>{!! $film->synopsis !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-9">
            <div class="card">
                <div class="row">
                    <div class="card-body">
                        <h5 class="card-title">Episode</h5>

                        <div><span>🟣</span> Status : <strong>{{ $film->status->name }}</strong></div>
                    </div>
                </div>
            </div>
    </nav>
@endsection
