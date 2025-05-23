@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="white-block">
            <div class="text-start px-4 pt-3">
                <section class="about" id="about">
                    <div class="row mb-2">
                        <div class="col-md-12 ">
                            <span>
                                <p class="md:h2 h4">Laporan Rekap Kelas Pembayaran </p>
                                <p class="font-weight-bold small my-1" style="line-height: 10px"> {{ $name }}</p>
                            </span>
                        </div>
                    </div>
                </section>
            </div>
            <div class="card-body white-block">
                <div class="table-responsive">
                    <table class="table users-table-info text-center" id="dataTable">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama Kelas</th>
                                <th class="text-center">Total Pembayaran</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="users-table-info">
                            @forelse ($items as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_kelas }}</td>
                                    @php($paymentTotal = 0)
                                        @foreach ($item->siswa as $siswa)
                                            @foreach ($siswa->pembayaran as $pembayaran)
                                               @php($paymentTotal += $pembayaran->jumlah_bayar)
                                            @endforeach
                                        @endforeach

                                    <td> Rp. {{ number_format($paymentTotal) }},- </td>
                                    <td>
                                          <a href="{{ route('laporan.rekap', $item->id) }}"
                                            class="border-0 px-2 py-1 h5 mb-1 bg-light d-inline-block mb--1 px-1 py-2 rounded-circle"
                                            target="_blank">
                                            <div class="justify-content-center icon cetak mx-auto "
                                                style="width: 35px; height: 35px; border-radius: 10%">
                                            </div>
                                        </a>
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
