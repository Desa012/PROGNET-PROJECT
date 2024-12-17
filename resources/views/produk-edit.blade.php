<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

  <!-- Navbar -->
  <nav class="navbar bg-gray-800 shadow-lg">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <img class="h-8 w-8" src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
          </div>
          <div class="hidden md:block">
            <div class="ml-10 flex items-baseline space-x-4">
              <a href="dashboard-penjual" class="rounded-md text-gray-300 hover:bg-gray-700 hover:text-white">Home</a>
              <a href="diskons" class="rounded-md text-gray-300 hover:bg-gray-700 hover:text-white">Diskon</a>
              <a href="produks" class="rounded-md text-gray-300 hover:bg-gray-700 hover:text-white">Produk</a>
            </div>
          </div>
        </div>
        <div class="hidden md:block">
          <div class="ml-4 flex items-center md:ml-6">
            <div class="relative ml-3">
                  @if(Auth::guard('penjual')->check())
                    <form action="{{ route('logout-penjual') }}" method="POST" class="inline">
                      @csrf
                      <button type="submit" class="rounded-md text-gray-300 hover:bg-gray-700 hover:text-white">Logout</button>
                    </form>
                  @else
                    <a href="{{ route('login-penjual') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Login</a>
                  @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>

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
          <label for="id_diskon" class="block text-sm font-medium text-gray-700">Diskon</label>
          <select name="id_diskon" id="id_diskon" 
                  class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <option value="">Pilih Diskon</option>
            @foreach($diskons as $diskon)
              <option value="{{ $diskon->id_diskon }}" {{ $produk->id_diskon == $diskon->id_diskon ? 'selected' : '' }}>{{ $diskon->persentase_diskon }}%</option>
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

  <!-- Footer -->
  <footer class="bg-gray-800 text-gray-300 py-6">
    <div class="container mx-auto text-center">
      <p>&copy; 2024 Dashboard Penjual. All rights reserved.</p>
    </div>
  </footer>

</body>
</html>