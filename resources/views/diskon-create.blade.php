<x-layout-penjual>

  <!-- Main Content -->
  <div class="main-content container mx-auto">
    <div class="bg-white rounded-lg shadow p-6 mt-8">
      <h2 class="text-2xl font-semibold text-center mb-6">Tambah Diskon</h2>
      <form method="POST" action="{{ route('diskons.store') }}">
        @csrf
        <div class="mb-4">
          <label for="nama_diskon" class="block text-sm font-medium text-gray-700">Nama Diskon</label>
          <input type="text" name="nama_diskon" id="nama_diskon" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Masukkan nama diskon" required>
        </div>
        <div class="mb-4">
          <label for="persentase_diskon" class="block text-sm font-medium text-gray-700">Persentase Diskon</label>
          <input type="number" name="persentase_diskon" id="persentase_diskon" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Masukkan persentase diskon" required>
        </div>
        <div class="mb-4">
          <label for="kategori_produk" class="block text-sm font-medium text-gray-700">Pilih Berdasarkan Kategori</label>
          <select name="kategori_produk" id="kategori_produk"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <option value="">-- Pilih Kategori --</option>
            @foreach ($kategori as $kat)
            <option value="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-6">
          <label for="produk" class="block text-sm font-medium text-gray-700">Pilih Produk (Opsional)</label>
          <div class="grid grid-cols-3 gap-4 mt-2">
            @foreach ($produk as $prod)
            <div class="flex items-center">
              <input type="checkbox" name="produk[]" value="{{ $prod->id_produk }}" id="produk-{{ $prod->id_produk }}"
                class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
              <label for="produk-{{ $prod->id_produk }}" class="ml-2 block text-sm text-gray-900">
                {{ $prod->nama_produk }}
              </label>
            </div>
            @endforeach
          </div>
        </div>
        <div class="mb-4">
          <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
          <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
        </div>
        <div class="mb-6">
          <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
          <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
        </div>
        <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Submit</button>
      </form>
    </div>
  </div>

</x-layout-penjual>