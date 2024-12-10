<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .navbar {
            position: relative;
            z-index: 10;
        }

        .main-content {
            padding-top: 4rem; /* Menyesuaikan dengan tinggi navbar */
        }
    </style>
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
              <a href="dashboard-penjual" class="rounded-md text-gray-300 hover:bg-gray-700 hover:text-white">Home</a>
              <a href="diskons" class="rounded-md text-gray-300 hover:bg-gray-700 hover:text-white">Diskon</a>
              <a href="kategori_produks" class="rounded-md text-gray-300 hover:bg-gray-700 hover:text-white">Kategori Produk</a>
              <a href="produks" class="rounded-md {{ request()->is('produks')?'bg-gray-900 text-white':'text-gray-300 hover:bg-gray-700 hover:text-white' }}">Produk</a>
            </div>
          </div>
        </div>
        <div class="hidden md:block">
          <div class="ml-4 flex items-center md:ml-6">
            <div class="relative ml-3">
              <button type="button" @click="isOpen = !isOpen" class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="User profile">
              </button>
              <div x-show="isOpen" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg">
                <a href="profile" class="block px-4 py-2 text-sm text-gray-700">Your Profile</a>
                <a href="settings" class="block px-4 py-2 text-sm text-gray-700">Settings</a>
                @if(Auth::guard('penjual')->check())
                  <form action="{{ route('logout-penjual') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="block px-4 py-2 text-sm text-gray-700">Logout</button>
                  </form>
                @else
                  <a href="{{ route('login-penjual') }}" class="block px-4 py-2 text-sm text-gray-700">Login</a>
                @endif
              </div>
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
        <form method="POST" action="{{ route('produks.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="nama_produk" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                <input type="text" name="nama_produk" id="nama_produk" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Masukkan nama produk" required>
            </div>

            <div class="mb-4">
                <label for="id_kategori" class="block text-sm font-medium text-gray-700">Kategori Produk</label>
                <select name="id_kategori" id="id_kategori" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($kategoriProduks as $kategori)
                        <option value="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="id_diskon" class="block text-sm font-medium text-gray-700">Diskon</label>
                <select name="id_diskon" id="id_diskon" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                    <option value="">Pilih Diskon</option>
                    @foreach($diskons as $diskon)
                        <option value="{{ $diskon->id_diskon }}">{{ $diskon->persentase_diskon }}%</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="deskripsi_produk" class="block text-sm font-medium text-gray-700">Deskripsi Produk</label>
                <textarea name="deskripsi_produk" id="deskripsi_produk" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Masukkan deskripsi produk" required></textarea>
            </div>

            <div class="mb-4">
                <label for="gambar_produk" class="block text-sm font-medium text-gray-700">Gambar Produk</label>
                <input type="file" name="gambar_produk" id="gambar_produk" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
            </div>

            <div class="mb-4">
                <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
                <input type="number" name="harga" id="harga" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Masukkan harga produk" required>
            </div>

            <div class="mb-4">
                <label for="stok" class="block text-sm font-medium text-gray-700">Stok</label>
                <input type="number" name="stok" id="stok" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Masukkan stok produk" required>
            </div>

            <div class="mb-4">
                <label for="id_penjual" class="block text-sm font-medium text-gray-700">Penjual</label>
                <select name="id_penjual" id="id_penjual" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                    <option value="">Pilih Penjual</option>
                    @foreach($penjuals as $seller)
                        <option value="{{ $seller->id_penjual }}">{{ $seller->nama_penjual }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Submit</button>
        </form>
    </div>
  </div>

</body>
</html>
