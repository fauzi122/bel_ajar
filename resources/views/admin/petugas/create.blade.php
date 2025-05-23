@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="white-block">
            <div class="text-start px-4 pt-3">
                <section class="about" id="about">
                    <div class="row mb-2">
                        <div class="col-md-12 ">
                            <span>
                                <p class="md:h2 h4">Kelola Data Petugas</p>
                                <p class="font-weight-bold small" style="line-height: 10px">Data
                                    Petugas/{{ $name }}</p>
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
                <form class="sign-up-form form" action="{{ route('petugas.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Petugas</label>
                                <input type="text" name="nama_petugas"
                                    class="form-control form-input @error('nama_petugas')is-invalid  @enderror"
                                    placeholder="Masukkan Nama Petugas Anda">
                                @error('nama_pengguna')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username"
                                    class="form-control form-input @error('username')is-invalid @enderror"
                                    placeholder="Masukkan Username Anda">
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="password-field" class="form-group">
                                <label>Password</label>
                                <input id="password" type="password" name="password"
                                    class="form-control form-input @error('password')is-invalid @enderror"
                                    placeholder="Masukkan Password Anda">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Level</label>
                                <select name="level" class="form-control form-input @error('level')is-invalid @enderror">
                                    <option value="">Pilih Level</option>
                                    <option value="admin">Admin</option>
                                    <option value="petugas">petugas</option>
                                </select>
                                @error('level')
                                    <div class="invalid-feedbabck">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group px-3">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                            <a href="{{ route('petugas.index') }}" class="btn  btn-success">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
