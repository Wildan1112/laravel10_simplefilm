@extends('be.layouts.app')
@section('pageTitle', 'Film')

@push('styles')
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
    <!-- End plugin css for this page -->
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/status">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Film</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Data Film</h6>
                    <div class="d-flex mb-3">
                        <a href="{{ route('film.create') }}" class="btn btn-primary btn-icon-text">
                            <i class="btn-icon-prepend" data-feather="plus-circle"></i>
                            Add Film
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Poster</th>
                                    <th>Status</th>
                                    <th>Type</th>
                                    <th>Network</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($films as $film)
                                    <tr style="vertical-align: middle">
                                        <td>{{ $loop->iteration }}</td>
                                        <td><strong>{{ $film->title }}</strong></td>
                                        <td>
                                            <img src="{{ asset('storage/posters/' . $film->poster) }}" class="rounded"
                                                style="width: 100px;height:auto;">
                                        </td>
                                        <td>
                                            <span
                                                class="badge mr-1 rounded-pill
                                            @if ($film->status->name === 'Completed') bg-success
                                            @elseif($film->status->name === 'Ongoing')
                                                bg-primary
                                            @elseif($film->status->name === 'Upcoming')
                                                bg-warning
                                                @elseif($film->status->name === 'Hiatus')
                                                bg-danger @endif
                                        ">
                                                {{ $film->status->name }}
                                            </span>

                                        </td>
                                        <td><span
                                                class="badge border border-success text-success">{{ $film->type->name }}</span>
                                        </td>
                                        <td><span
                                                class="badge border border-info text-success">{{ $film->network->name }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('film.show', $film->slug) }}"
                                                    class="btn btn-xs btn-info btn-icon">
                                                    <i data-feather="eye"></i>
                                                </a>
                                                <a href="{{ route('film.edit', $film->slug) }}"
                                                    class="btn mx-1 btn-xs btn-warning btn-icon">
                                                    <i data-feather="edit"></i>
                                                </a>
                                                <form action="{{ route('film.destroy', $film->slug) }}" method="POST">
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
