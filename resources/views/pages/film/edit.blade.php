@extends('be.layouts.app')
@section('pageTitle', "Edit Film $film->title")

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('film.index') }}">Film</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Edit Film - {{ $film->title }}</h6>

                    <form class="forms-sample" action="{{ route('film.update', $film->slug) }}" method="POST"
                        enctype="multipart/form-data">

                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="title" class="form-label">Title Film</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                id="title" autofocus autocomplete="off" placeholder="Title name"
                                value="{{ old('title', $film->title) }}">
                            @error('title')
                                <label id="title-error" class="error invalid-feedback"
                                    for="title">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="statusFilm" class="form-label">Status Film</label>
                            <select class="form-select @error('status_id') is-invalid @enderror" id="statusFilm" required
                                name="status_id" value="{{ old('status_id', $film->status_id) }}">
                                <option disabled="">--Select Status--</option>
                                @foreach ($status as $status)
                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                @endforeach
                            </select>
                            @error('status_id')
                                <label id="status_id-error" class="error invalid-feedback"
                                    for="status_id">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="typeFilm" class="form-label">Type Film</label>
                            <select class="form-select @error('type_id') is-invalid @enderror" id="typeFilm" required
                                name="type_id" value="{{ old('type_id', $film->type_id) }}">
                                <option disabled="">--Select Status--</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                            @error('type_id')
                                <label id="type_id-error" class="error invalid-feedback"
                                    for="type_id">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="network" class="form-label">Network</label>
                            <select class="form-select @error('network_id') is-invalid @enderror" id="network" required
                                name="network_id" value="{{ old('network_id', $film->network_id) }}">
                                <option disabled="">--Select Network--</option>
                                @foreach ($networks as $network)
                                    <option value="{{ $network->id }}">{{ $network->name }}</option>
                                @endforeach
                            </select>
                            @error('network_id')
                                <label id="network_id-error" class="error invalid-feedback"
                                    for="network_id">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Genre</label>
                            <select class="js-example-basic-multiple form-select" multiple="multiple" data-width="100%"
                                name="genres[]" value="{{ old('genres[]', $film->genres->pluck('id')) }}">
                                @foreach ($genres as $genre)
                                    <option value="{{ $genre->id }}"
                                        {{ in_array($genre->id, $film->genres->pluck('id')->toArray()) ? 'selected' : '' }}>
                                        {{ $genre->name }}</option>
                                @endforeach
                            </select>
                            @error('genres[]')
                                <label id="genres-error" class="error invalid-feedback"
                                    for="genres[]">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="synopsis">Synopsis</label>
                            <textarea id="synopsis" class="form-control @error('synopsis') is-invalid @enderror" name="synopsis" rows="5">{{ old('synopsis', $film->synopsis) }}</textarea>
                            @error('synopsis')
                                <label id="synopsis-error" class="error invalid-feedback"
                                    for="synopsis">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="formFile">Poster</label>
                            <input class="form-control @error('poster') is-invalid @enderror" type="file" id="formFile"
                                name="poster">
                            <img src="{{ asset('storage/posters/' . $film->poster) }}" alt="Preview" id="previewImg"
                                class="rounded mt-3" style="width: 120px;height:auto;">
                            @error('poster')
                                <label id="poster-error" class="error invalid-feedback"
                                    for="poster">{{ $message }}</label>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success">Add Film</button>
                </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@push('styles')
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}" />
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/demo1/style.css') }}" />
    <!-- End layout styles -->
@endpush

@push('scripts')
    {{-- <script src="{{ asset('assets/vendors/tinymce/tinymce.min.js') }}"></script> --}}
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script src="{{ asset('assets/js/tinymce.js') }}"></script>


    <script src="{{ asset('assets/js/select2.js') }}"></script>
    <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>
    <script>
        CKEDITOR.replace('synopsis');
    </script>

    <script>
        const input = document.getElementById('formFile');

        const previewPhoto = () => {
            const file = input.files
            if (file) {
                const fileReader = new FileReader()
                const preview = document.getElementById('previewImg')

                fileReader.onload = e => {
                    preview.setAttribute('src', e.target.result)
                }
                fileReader.readAsDataURL(file[0])
            }
        }
        input.addEventListener('change', previewPhoto)
    </script>
@endpush
