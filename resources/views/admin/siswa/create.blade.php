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
                <form class="sign-up-form form" action="{{ route('siswa.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>NISN</label>
                                <input type="text" name="nisn" id="nisn" value="{{ old('nisn') }}"
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
                                <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
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
                                <input type="text" name="alamat" id="alamat" value="{{ old('alamat') }}"
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
                                <input type="text" name="no_telp" id="no_telp" value="{{ old('no_telp') }}"
                                    class="form-control form-input @error('no_telp')is-invalid @enderror"
                                    placeholder="Masukkan No Telp Anda">
                                @error('no_telp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>NIS</label>
                                <input id="nis" type="nis" name="nis" value="{{ old('nis') }}"
                                    class="form-control form-input @error('nis')is-invalid @enderror"
                                    placeholder="Masukkan NIs Anda">
                                @error('nis')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select id="jenis_kelamin" name="jenis_kelamin"
                                    class="form-control form-input @error('jenis_kelamin')is-invalid @enderror">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-Laki
                                    </option>
                                    <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan
                                    </option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedbabck">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Kelas</label>
                                <select name="id_kelas"
                                    class="form-control form-input @error('id_kelas')is-invalid @enderror">
                                    <option value="">Pilih Kelas</option>
                                    @foreach ($dataKelas as $kelas)
                                        <option value="{{ $kelas->id }}"
                                            {{ old('id_kelas') == $kelas->id ? 'selected' : '' }}>{{ $kelas->nama_kelas }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_kelas')
                                    <div class="invalid-feedbabck">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group mr-1">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                            <a href="{{ route('siswa.index') }}" class="btn btn-success">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
