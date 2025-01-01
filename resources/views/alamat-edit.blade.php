<div>
<div class="container">
    <h1>Edit Alamat</h1>

    <form action="{{ route('alamat.update', $alamat->id_alamat) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat', $alamat->alamat) }}" required>
        </div>
        <div class="mb-3">
            <label for="kecamatan" class="form-label">Kecamatan</label>
            <input type="text" class="form-control" id="kecamatan" name="kecamatan" value="{{ old('kecamatan', $alamat->kecamatan) }}" required>
        </div>
        <div class="mb-3">
            <label for="kota" class="form-label">Kota</label>
            <input type="text" class="form-control" id="kota" name="kota" value="{{ old('kota', $alamat->kota) }}" required>
        </div>
        <div class="mb-3">
            <label for="provinsi" class="form-label">Provinsi</label>
            <input type="text" class="form-control" id="provinsi" name="provinsi" value="{{ old('provinsi', $alamat->provinsi) }}" required>
        </div>
        <div class="mb-3">
            <label for="kode_pos" class="form-label">Kode Pos</label>
            <input type="text" class="form-control" id="kode_pos" name="kode_pos" value="{{ old('kode_pos', $alamat->kode_pos) }}" required>
        </div>
        <div class="mb-3">
            <label for="is_default" class="form-check-label">
                <input type="checkbox" id="is_default" name="is_default" class="form-check-input" {{ $alamat->is_default ? 'checked' : '' }}> Jadikan alamat default
            </label>
        </div>

        <button type="submit" class="btn btn-success">Update Alamat</button>
    </form>
</div>
</div>
