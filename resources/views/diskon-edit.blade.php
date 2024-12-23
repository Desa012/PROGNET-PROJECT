<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Diskon</title>
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
  <div class="container mx-auto py-10">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg mx-auto">
      <h2 class="text-center text-2xl font-semibold mb-5">Edit Diskon</h2>
      <form method="POST" action="{{ route('diskons.update', $diskon['id_diskon']) }}">
        @csrf
        @method('PUT')
        <div class="mb-4">
          <label for="nama_diskon" class="block text-sm font-medium text-gray-700">Nama Diskon</label>
          <input type="text" name="nama_diskon" id="nama_diskon" value="{{ $diskon['nama_diskon'] }}" required 
                 class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                 placeholder="Masukkan nama diskon">
        </div>
        <div class="mb-4">
          <label for="persentase_diskon" class="block text-sm font-medium text-gray-700">Persentase Diskon</label>
          <input type="number" name="persentase_diskon" id="persentase_diskon" value="{{ $diskon['persentase_diskon'] }}" required 
                 class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                 placeholder="Masukkan persentase diskon">
        </div>
        <div class="mb-4">
          <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
          <input type="date" name="tanggal_mulai" id="tanggal_mulai" value="{{ $diskon['tanggal_mulai'] }}" required 
                 class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="mb-4">
          <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
          <input type="date" name="tanggal_selesai" id="tanggal_selesai" value="{{ $diskon['tanggal_selesai'] }}" required 
                 class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
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
