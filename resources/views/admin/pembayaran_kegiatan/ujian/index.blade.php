@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="white-block">
            <div class="text-start px-4 pt-3">
                <section class="about" id="about">
                    <div class="row mb-2">
                        <div class="col-md-12 ">
                            <span>
                                <p class="md:h2 h4">Kelola Data Transaksi Pembayaran UTS/UAS</p>
                               <hr>
                            </span>
                        </div>
                    </div>
                </section>
            </div>
            <div class="card-body white-block">
                <div class="table-responsive">
                    <table class="table users-table-info" id="dataTable">
                        <thead>
                            <tr class="md:fs-5 fs-6 fw-bold">
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>NISN</th>
                                <th>Kelas</th>
                                @foreach ($master_biaya as $biaya)
                                    <th>{{ $biaya->kategori }}</th>
                                @endforeach()
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="users-table-info">
                            @forelse($siswas as $siswa)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $siswa->nama }}</td>
                                    <td>{{ $siswa->nisn }}</td>
                                    <td>{{ $siswa->kelas->nama_kelas }}</td>
                                    @foreach ($master_biaya as $biaya)
                                        <td class="text-center">
                                            <span class="text-sm font-weight-normal">
                                                  @if(isset($pembayaran[$siswa->nisn]) && $pembayaran[$siswa->nisn]->contains('jenis_kegiatan', $biaya->kategori))
                                                    <div class="icon success"></div>
                                                @else
                                                    <div class="icon error"></div>
                                                @endif
                                            </span>
                                        </td>
                                    @endforeach

                                    <td>
                                        <div class="form-control-icon d-flex">
                                            <div class="d-flex justify-content-end">
                                                <a href="{{ route('pembayaran.kegiatan.create', $siswa->nisn) }}">
                                                    <div class="icon cart"></div>
                                                </a>
                                                </a>
                                            </div>
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
@endsection
