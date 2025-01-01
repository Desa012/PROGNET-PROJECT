<x-layout-pelanggan>
    <div class="max-w-lg mx-auto mt-12 bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-center mb-8">Edit Alamat</h2>

        <form method="POST" action="{{ route('alamat.update', $alamat->id_alamat) }}">
            @csrf
            @method('PUT')
            <div class="mb-5">
                <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                <textarea name="alamat" id="alamat" class="w-full mt-1 p-2 border rounded" required>{{ old('alamat', $alamat->alamat) }}</textarea>
            </div>
            <div class="mb-5">
                <label for="kecamatan" class="block text-sm font-medium text-gray-700">Kecamatan</label>
                <input type="text" name="kecamatan" id="kecamatan" class="w-full mt-1 p-2 border rounded" value="{{ old('kecamatan', $alamat->kecamatan) }}" required>
            </div>
            <div class="mb-5">
                <label for="kota" class="block text-sm font-medium text-gray-700">Kota</label>
                <input type="text" name="kota" id="kota" class="w-full mt-1 p-2 border rounded" value="{{ old('kota', $alamat->kota) }}" required>
            </div>
            <div class="mb-5">
                <label for="provinsi" class="block text-sm font-medium text-gray-700">Provinsi</label>
                <input type="text" name="provinsi" id="provinsi" class="w-full mt-1 p-2 border rounded" value="{{ old('provinsi', $alamat->provinsi) }}" required>
            </div>
            <div class="mb-5">
                <label for="kode_pos" class="block text-sm font-medium text-gray-700">Kode Pos</label>
                <input type="text" name="kode_pos" id="kode_pos" class="w-full mt-1 p-2 border rounded" value="{{ old('kode_pos', $alamat->kode_pos) }}" required>
            </div>
            <div class="mb-5">
                <label class="flex items-center">
                    <input type="checkbox" name="is_default" class="mr-2" {{ $alamat->is_default ? 'checked' : '' }}>
                    Jadikan alamat utama
                </label>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded">Update Alamat</button>
        </form>
    </div>
</x-layout-pelanggan>
