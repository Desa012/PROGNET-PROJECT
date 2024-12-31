<x-layout-penjual>

  <!-- Main Content -->
  <div class="main-content container mx-auto">
    <div class="bg-white rounded-lg shadow p-6 mt-8">
      <h2 class="text-2xl font-semibold text-center mb-6">Tambah Produk</h2>
      <form action="{{ route('produks.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
          <label for="nama_produk" class="block text-gray-700">Nama Produk</label>
          <input type="text" name="nama_produk" id="nama_produk" class="border border-gray-300 rounded p-2 w-full" required>
        </div>
        <div class="mb-4">
          <label for="id_kategori" class="block text-gray-700">Kategori Produk</label>
          <select name="id_kategori" id="id_kategori" class="border border-gray-300 rounded p-2 w-full" required>
            <option value="">Pilih Kategori</option>
            @foreach ($kategoriProduks as $kategori)
            <option value="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-4">
          <label for="deskripsi_produk" class="block text-gray-700">Deskripsi Produk</label>
          <textarea name="deskripsi_produk" id="deskripsi_produk" class="border border-gray-300 rounded p-2 w-full"></textarea>
        </div>
        <div class="mb-4">
          <label for="gambar_produk" class="block text-gray-700">Gambar Produk</label>
          <input type="file" name="gambar_produk" id="gambar_produk" class="border border-gray-300 rounded p-2 w-full">
        </div>
        <div class="mb-4">
          <label for="harga" class="block text-gray-700">Harga</label>
          <input type="number" name="harga" id="harga" class="border border-gray-300 rounded p-2 w-full" required>
        </div>
        <div class="mb-4">
          <label for="stok" class="block text-gray-700">Stok</label>
          <input type="number" name="stok" id="stok" class="border border-gray-300 rounded p-2 w-full" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Produk</button>
      </form>

</x-layout-penjual>