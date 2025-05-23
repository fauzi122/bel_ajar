@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="white-block">
            <div class="text-start px-4 pt-3">
                <section class="about" id="about">
                    <div class="row mb-2">
                        <div class="col-md-12 ">
                            <span>
                                <a href="{{ route('siswa.create') }}" class="btn btn-primary md:btn-lg btn-sm  float-right">Tambah Data+</a>
                                <p class="md:h2 h4">Kelola Data Siswa
                                    <p class="font-weight-bold small" style="line-height: 10px">{{ $name }}</p>
                                </p>
                            </span>
                        </div>
                    </div>
                </section>
            </div>
            <div class="card-body white-block">
                <div class="table-responsive">
                    <table class="table users-table-info" id="dataTable">
                        <thead>
                            <tr>
                                <th  class="text-center">No</th>
                                <th  class="text-center">Nisn</th>
                                <th  class="text-center">Nis</th>
                                <th  class="text-center">Nama</th>
                                <th  class="text-center">Kelas</th>
                                <th  class="text-center">Jenis Kelamin</th>
                                <th  class="text-center">No Telp</th>
                                <th  class="text-center">Alamat</th>
                                <th  class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="users-table-info">
                            @forelse($siswas as $siswa)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $siswa->nisn }}</td>
                                    <td>{{ $siswa->nis }}</td>
                                    <td>{{ $siswa->nama }}</td>
                                    <td>{{ $siswa->kelas->nama_kelas }}</td>
                                    <td>{{ $siswa->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
                                    <td>{{ $siswa->no_telp }}</td>
                                    <td>{{ $siswa->alamat }}</td>
                                    <td>
                                        <div class="form-control-icon d-flex">
                                            <a href="{{ @route('siswa.edit', $siswa->id) }}" method="POST"
                                                class="bg-success border-0 mb-3 px-2 py-1 rounded mr-1"><i
                                                    class="icon edit mx-auto"></i></a>
                                            <form action="{{ @route('siswa.destroy', $siswa->id) }}" method="POST">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="border-0 bg-danger px-2 py-1 rounded"
                                                    onclick="confirmDelete(event,this)"><i class="icon delete mx-auto"></i></button>
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
@endsection
