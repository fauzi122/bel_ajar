<form method="POST" id="editForm">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>Nama Kelas</label>
        <input type="text" name="nama_kelas" id="edit_nama_kelas"
            class="form-control @error('nama_kelas')is-invalid  @enderror form-input"
            placeholder="Masukkan Nama Kelas Anda">

        @error('nama_kelas')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group">
        <label>Kompetensi Keahlian</label>
        <input type="text" name="kompetensi_keahlian" id="edit_kompetensi_keahlian"
            class="form-control @error('kompetensi_keahlian')is-invalid @enderror form-input"
            placeholder="Masukkan Kompetensi Keahlian Anda">
        @error('kompetensi_keahlian')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="modal-footer px-3">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close"
            class="btn btn-success">Batal</button>
        <button type="submit" class="btn btn-primary">Edit Data</button>
    </div>
</form>
