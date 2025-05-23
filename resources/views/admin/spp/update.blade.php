<form method="POST" id="editForm">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>Nominal SPP</label>
        <input value="{{ $item->nominal }}" type="number" name="nominal" id="edit_nominal"
            class="form-control @error('nominal')is-invalid @enderror form-input"
            placeholder="Masukkan Nominal SPP Anda">
        @error('nominal')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group">
        <label>level</label>
        <select name="level" class="form-control form-input @error('level')is-invalid @enderror">
            @if ($item->level)
                <option value="{{ $item->level }}">{{ $item->level }}</option>
            @endif
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
            class="btn btn-success">Batal</button>
        <button type="submit" class="btn btn-primary">Edit Data</button>
    </div>
</form>
