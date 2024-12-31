<x-layout-penjual>

  <!-- Main Content -->
  <div class="container mx-auto py-10">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg mx-auto">
      <h2 class="text-center text-2xl font-semibold mb-5">Edit Diskon</h2>
      <form method="POST" action="{{ route('diskons.update', $diskon['id_diskon']) }}">
        @csrf
        @method('PUT')
        <div class="mb-4">
          <label for="nama_diskon" class="block text-sm font-medium text-gray-700">Nama Diskon</label>
          <input type="text" name="nama_diskon" id="nama_diskon" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('nama_diskon', $diskon['nama_diskon']) }}" required>
        </div>
        <div class="mb-4">
          <label for="persentase_diskon" class="block text-sm font-medium text-gray-700">Persentase Diskon</label>
          <input type="number" name="persentase_diskon" id="persentase_diskon" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('persentase_diskon', $diskon['persentase_diskon']) }}" required>
        </div>
        <div class="mb-4">
          <label for="kategori_produk" class="block text-sm font-medium text-gray-700">Pilih Berdasarkan Kategori</label>
          <select name="kategori_produk" id="kategori_produk" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <option value="">-- Pilih Kategori --</option>
            @foreach ($kategori as $kat)
            <option value="{{ $kat->id_kategori }}">{{ $kat->id_kategori == old('kategori_produk', $diskon['kategori_produk'] ?? '') ? 'selected' : '' }}
              {{ $kat->nama_kategori }}
            </option>
            @endforeach
          </select>
        </div>

        <div class="mb-6 grid grid-cols-3 gap-4 mt-2">
          <label for="produk" class="block text-sm font-medium text-gray-700">Pilih Produk (Opsional)</label>
          @foreach ($produk as $prod)
          <div class="flex items-center">
            <input type="checkbox" name="produk[]" value="{{ $prod->id_produk }}" id="produk-{{ $prod->id_produk }}"
              class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
            {{ in_array($prod->id_produk, $diskon_produk ?? []) ? 'checked' : '' }}
            <label for="produk-{{ $prod->id_produk }}" class="ml-2 block text-sm text-gray-900">
              {{ $prod->nama_produk }}
            </label>
          </div>
          @endforeach
        </div>
        <div class="mb-6">
          <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
          <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('tanggal_mulai', $diskon['tanggal_mulai']) }}" required>
        </div>
        <div class="mb-6">
          <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
          <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('tanggal_selesai', $diskon['tanggal_selesai']) }}" required>
        </div>
        <button type="submit"
          class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md shadow">
          Simpan
        </button>
      </form>
    </div>
  </div>

</x-layout-penjual>