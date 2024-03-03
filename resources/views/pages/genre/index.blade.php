@extends('be.layouts.app')
@section('pageTitle', 'Genre')
@push('styles')
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
    <!-- End plugin css for this page -->
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Genre</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Data Genre</h6>
                    <div class="d-flex mb-3">
                        <a href="{{ route('genre.create') }}" class="btn btn-sm btn-primary btn-icon-text">
                            <i class="btn-icon-prepend" data-feather="plus-circle"></i>
                            Add Genre
                        </a>
                        <a href="{{ route('import.genre') }}" class="btn mx-1 btn-sm btn-info btn-icon-text">
                            <i class="btn-icon-prepend" data-feather="file-plus"></i>
                            Import from Excel
                        </a>
                        <form action="{{ route('export.genre') }}" method="GET">
                            <button type="submit" class="btn btn-sm btn-success btn-icon-text">
                                <i class="btn-icon-prepend" data-feather="file-text"></i>
                                Export to Excel
                            </button>
                        </form>
                    </div>

                    {{-- <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($genres as $genre)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $genre->name }}</td>
                                        <td>{{ $genre->slug }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('genre.edit', $genre->slug) }}"
                                                    class="btn mx-1 btn-xs btn-warning btn-icon">
                                                    <i data-feather="edit"></i>
                                                </a>
                                                <form action="{{ route('genre.destroy', $genre->slug) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-xs btn-danger btn-icon confirm">
                                                        <i data-feather="trash-2"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> --}}
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($genres as $genre)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $genre->name }}</td>
                                        <td>{{ $genre->slug }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('genre.edit', $genre->slug) }}"
                                                    class="btn mx-1 btn-xs btn-warning btn-icon">
                                                    <i data-feather="edit"></i>
                                                </a>
                                                <form action="{{ route('genre.destroy', $genre->slug) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-xs btn-danger btn-icon confirm">
                                                        <i data-feather="trash-2"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="d-flex mt-3 justify-content-end">
                            {!! $genres->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@push('scripts')
    <!-- Plugin js for this page -->
    <script src="{{ asset('assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>
    <!-- End plugin js for this page -->

    <!-- Custom js for this page -->
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
    <!-- End custom js for this page -->

    <script>
        $(function() {
            $(document).on('click', '.confirm', function(e) {
                e.preventDefault();
                let form = $(this).closest("form");

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Delete This Data?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                        Swal.fire(
                            'Deleted!',
                            'Data has been deleted.',
                            'success'
                        )
                    }
                })


            });

        });
    </script>
@endpush
