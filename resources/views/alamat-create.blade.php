<x-layout-pelanggan>
    <div class="max-w-lg mx-auto mt-12 bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-center mb-8">Tambah Alamat</h2>

        <form method="POST" action="{{ route('alamats.store') }}">
            @csrf
            <div class="mb-5">
                <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                <textarea name="alamat" id="alamat" class="w-full mt-1 p-2 border rounded" required></textarea>
            </div>
            <div class="mb-5">
                <label for="kecamatan" class="block text-sm font-medium text-gray-700">Kecamatan</label>
                <input type="text" name="kecamatan" id="kecamatan" class="w-full mt-1 p-2 border rounded" required>
            </div>
            <div class="mb-5">
                <label for="kota" class="block text-sm font-medium text-gray-700">Kota</label>
                <input type="text" name="kota" id="kota" class="w-full mt-1 p-2 border rounded" required>
            </div>
            <div class="mb-5">
                <label for="provinsi" class="block text-sm font-medium text-gray-700">Provinsi</label>
                <input type="text" name="provinsi" id="provinsi" class="w-full mt-1 p-2 border rounded" required>
            </div>
            <div class="mb-5">
                <label for="kode_pos" class="block text-sm font-medium text-gray-700">Kode Pos</label>
                <input type="text" name="kode_pos" id="kode_pos" class="w-full mt-1 p-2 border rounded" required>
            </div>
            <div class="mb-5">
                <label class="flex items-center">
                    <input type="checkbox" name="is_default" class="mr-2">
                    Jadikan alamat utama
                </label>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded">Simpan Alamat</button>
        </form>
    </div>
</x-layout-pelanggan>
