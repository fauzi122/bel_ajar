<form action="{{ @route('spp.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Nominal SPP</label>
        <input type="number" name="nominal" class="form-control @error('nominal')is-invalid @enderror form-input"
            placeholder="Masukkan Nominal SSP Anda">

        @error('nominal')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group">
        <label>level</label>
        <select name="level" class="form-control form-input @error('level')is-invalid @enderror">
            <option value="">-- Pilih Level --</option>
            <option value="X" {{ old('level') == 'X' ? 'selected' : ''}}>X</option>
            <option value="XI" {{ old('level') == 'XI' ? 'selected' : '' }}>XI</option>
            <option value="XII" {{ old('level')  == 'XII' ? 'selected' : ''}}>XII</option>
        </select>
        @error('level')
            <div class="invalid-feedbabck">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="modal-footer px-3">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close"
            class="btn  btn-success">Batal</button>
        <button type="submit" class="btn btn-primary">Tambah Data</button>
    </div>
</form>
