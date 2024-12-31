<x-layout-penjual>

  <!-- Main Content -->
  <div class="container mx-auto py-10">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg mx-auto">
      <h2 class="text-center text-2xl font-semibold mb-5">Edit Produk</h2>
      <form method="POST" action="{{ route('produks.update', $produk->id_produk) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
          <label for="nama_produk" class="block text-sm font-medium text-gray-700">Nama Produk</label>
          <input type="text" name="nama_produk" id="nama_produk" value="{{ $produk->nama_produk }}" required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            placeholder="Masukkan nama produk">
        </div>

        <div class="mb-4">
          <label for="id_kategori" class="block text-sm font-medium text-gray-700">Kategori Produk</label>
          <select name="id_kategori" id="id_kategori" required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <option value="">Pilih Kategori</option>
            @foreach($kategoriProduks as $kategori)
            <option value="{{ $kategori->id_kategori }}" {{ $produk->id_kategori == $kategori->id_kategori ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-4">
          <label for="deskripsi_produk" class="block text-sm font-medium text-gray-700">Deskripsi Produk</label>
          <textarea name="deskripsi_produk" id="deskripsi_produk" required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            placeholder="Masukkan deskripsi produk">{{ $produk->deskripsi_produk }}</textarea>
        </div>

        <div class="mb-4">
          <label for="gambar_produk" class="block text-sm font-medium text-gray-700">Gambar Produk</label>
          <input type="file" name="gambar_produk" id="gambar_produk"
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
          <small class="text-gray-500">Biarkan kosong jika tidak ingin mengubah gambar.</small>
        </div>

        <div class="mb-4">
          <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
          <input type="number" name="harga" id="harga" value="{{ $produk->harga }}" required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            placeholder="Masukkan harga produk">
        </div>

        <div class="mb-4">
          <label for="stok" class="block text-sm font-medium text-gray-700">Stok</label>
          <input type="number" name="stok" id="stok" value="{{ $produk->stok }}" required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            placeholder="Masukkan stok produk">
        </div>

        <button type="submit"
          class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md shadow">
          Simpan
        </button>
      </form>
    </div>
  </div>

</x-layout-penjual>