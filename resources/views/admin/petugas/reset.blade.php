<form method="POST" id="FormReset">
    @csrf
    @method('PUT')
    <div class="container">
    <div class="form-group">
        <label for="new_password">Password Baru</label>
        <input class="form-control form-input" type="password" name="new_password" id="new_password" required>
    </div>

    <div class="form-group">
        <label for="new_password_confirmation">Konfirmasi Password Baru</label>
        <input class="form-control form-input" type="password" name="new_password_confirmation" id="new_password_confirmation" required>
    </div>
    <div class="modal-footer px-3">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close"
            class="btn  btn-success">Batal</button>
        <button type="submit" class="btn btn-primary">Edit Data</button>
    </div>
</form>
