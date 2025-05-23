@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="white-block">
            <div class="text-start px-4 pt-3">
                <section class="about" id="about">
                    <div class="row mb-2">
                        <div class="col-md-12 ">
                            <span>
                                <p class="md:h2 h4">Kelola Data Siswa</p>
                                <p class="font-weight-bold small" style="line-height: 10px">Data Siswa/{{ $name }}
                                </p>
                            </span>
                        </div>
                    </div>
                </section>
            </div>
            <div class="card-body white-block">
                @if (session()->has('success'))
                    <div class="alert-success p-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert-success p-3 rounded">
                        {{ session('error') }}
                    </div>
                @endif
                <form class="sign-up-form form" action="{{ route('siswa.update', $item->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>NISN</label>
                                <input value="{{ $item->nisn }}" type="text" name="nisn" id="nisn"
                                    class="form-control form-input @error('nisn')is-invalid  @enderror"
                                    placeholder="Masukkan Nisn Anda">
                                @error('nisn')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Nama</label>
                                <input value="{{ $item->nama }}" type="text" name="nama" id="nama"
                                    class="form-control form-input @error('nama')is-invalid @enderror"
                                    placeholder="Masukkan Nama Anda">
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Alamat</label>
                                <input value="{{ $item->alamat }}" type="text" name="alamat" id="alamat"
                                    class="form-control form-input @error('alamat')is-invalid @enderror"
                                    placeholder="Masukkan Alamat Anda">
                                @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>No Telp</label>
                                <input type="text" name="no_telp" id="no_telp" value="{{ $item->no_telp }}"
                                    class="form-control form-input @error('no_telp')is-invalid @enderror"
                                    placeholder="Masukkan No Telp Anda">
                                @error('no_telp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group px-3">
                                <button type="submit" class="btn btn-primary">Edit</button>
                                <a href="{{ route('siswa.index') }}" class="btn btn-success">Batal</a>
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>NIS</label>
                                <input value="{{ $item->nis }}" id="nis" type="nis" name="nis"
                                    id="nis" class="form-control form-input @error('nis')is-invalid @enderror"
                                    placeholder="Masukkan NIs Anda">
                                @error('nis')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select id="jenis_kelamin" name="jenis_kelamin" id="jenis_kelamin"
                                    class="form-control form-input @error('jenis_kelamin')is-invalid @enderror">
                                    @if ($item->id)
                                        <option value="{{ $item->jenis_kelamin }}">
                                            {{ $item->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</option>
                                    @endif()
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-Laki
                                    </option>
                                    <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan
                                    </option>
                                </select>

                                <div class="form-group">
                                    <label>Kelas</label>
                                    <select name="id_kelas" id="kelas"
                                        class="form-control form-input @error('id_kelas')is-invalid @enderror">
                                        @if ($item->kelas->id)
                                            <option selected value="{{ $item->kelas->id }}">{{ $item->kelas->nama_kelas }}
                                            </option>
                                        @endif
                                        <option value="">Pilih Kelas</option>
                                        @foreach ($dataKelas as $kelas)
                                            @if (old('id_kelas') == $kelas->id)
                                                <option selected value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}
                                                </option>
                                            @endif
                                            <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                                        @endforeach
                                    </select>
                                    @error('level')
                                        <div class="invalid-feedbabck">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection
