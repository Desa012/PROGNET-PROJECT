<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

</head>
<body class="bg-gray-100">

  <!-- Navbar -->
  <nav class="navbar bg-gray-800" x-data="{ isOpen: false }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <img class="h-8 w-8" src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
          </div>
          <div class="hidden md:block">
            <div class="ml-10 flex items-baseline space-x-4">
              <a href="dashboard-penjual" class="rounded-md {{ request()->is('dashboard-penjual')?'bg-gray-900 text-white':'text-gray-300 hover:bg-gray-700 hover:text-white' }}">Dashboard</a>
              <a href="diskons" class="rounded-md {{ request()->is('diskons')?'bg-gray-900 text-white':'text-gray-300 hover:bg-gray-700 hover:text-white' }}">Kelola Diskon</a>
              <a href="produks" class="rounded-md {{ request()->is('produks')?'bg-gray-900 text-white':'text-gray-300 hover:bg-gray-700 hover:text-white' }}">Kelola Produk</a>
              <a href="" class="rounded-md {{ request()->is('')?'bg-gray-900 text-white':'text-gray-300 hover:bg-gray-700 hover:text-white' }}">Kelola Pesanan</a>
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
              <label for="id_diskon" class="block text-gray-700">Diskon</label>
              <select name="id_diskon" id="id_diskon" class="border border-gray-300 rounded p-2 w-full">
                  <option value="">Pilih Diskon</option>
                  @foreach ($diskons as $diskon)
                      <option value="{{ $diskon->id_diskon }}">{{ $diskon->persentase_diskon }}</option>
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

  <!-- Footer -->
  <footer class="bg-gray-800 text-gray-300 py-6">
    <div class="container mx-auto text-center">
      <p>&copy; 2024 Dashboard Penjual. All rights reserved.</p>
    </div>
  </footer>

</body>
</html>
