@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="white-block">
            <div class="text-start px-4 pt-3">
                <section class="about" id="about">
                    <div class="row mb-2">
                        <div class="col-md-12 ">
                            <span>
                                <button data-bs-toggle="modal" data-bs-target="#tambahData" type="button"
                                    class="btn btn-primary md:btn-lg btn-sm  float-right">Tambah
                                    Data</button>
                                <p class="md:h2 h4">Kelola Data SPP</p>
                                <p class="font-weight-bold small" style="line-height: 10px">{{ $name }}</p>
                            </span>
                        </div>
                    </div>
            </div>
            </section>
            <div class="card-body white-block">
                <div class="table-responsive">
                    <table class="table users-table-info dt-table-hover" id="dataTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nominal</th>
                                <th>Level</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="users-table-info ">
                            @forelse ($items as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nominal }}</td>
                                    <td>{{ $item->level }}</td>
                                    <td>
                                        <div class="form-control-icon d-flex">
                                            <button type="button"
                                                class="editBtn bg-success border-0 mb-3 px-2 py-1 rounded mx-1"
                                                data-id="{{ $item->id }}"><i data-bs-toggle="modal"
                                                    data-bs-target="#editData" class="icon edit mx-auto"></i>
                                            </button>

                                            <form action="{{ @route('spp.destroy', $item->id) }}" method="POST">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="border-0 bg-danger px-2 py-1 rounded mx-1"
                                                    onclick="confirmDelete(event,this)"><i
                                                        class="icon delete mx-auto"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="tambahData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title fs-5" id="exampleModalLabel">Tambah Data SPP</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" aria-hidden="true"><svg
                            aria-hidden="true" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-x">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg></button>
                </div>
                <div class="modal-body">
                    @include('admin.spp.create')
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="editData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="d-flex justify-content-center">
                <div class="badge bg-warning text-white py-3 px-2" id="loading">
                    <p class="text-white">LOADING...</p>
                </div>
            </div>
            <div class="modal-content" id="modal-dialog">
                <div class="modal-header">
                    <h5 class="modal-title fs-5" id="exampleModalLabel">Edit Data SPP</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" aria-hidden="true"><svg
                            aria-hidden="true" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-x">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg></button>
                </div>
                <div class="modal-body">
                    @include('admin.spp.update')
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('.editBtn').click(function() {
                let ID = $(this).data('id');
                $("#modal-dialog").hide();
                $("#loading").show();
                $.ajax({
                    url: `spp/${ID}/edit`,
                    method: 'GET',
                    success: (res) => {
                        $("#modal-dialog").show();
                        $("#loading").hide();

                        $('#edit_tahun').val(res.tahun);
                        $('#edit_nominal').val(res.nominal);
                        $('#editForm').attr('action', `/dashboard/spp/${ID}`)
                    }
                });
            });
        })
    </script>
@endpush
