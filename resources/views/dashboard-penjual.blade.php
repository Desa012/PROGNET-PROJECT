<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Penjual</title>
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
              <a href="dashboard-penjual" class="rounded-md text-gray-300 hover:bg-gray-700 hover:text-white">Dashboard</a>
              <a href="diskons" class="rounded-md text-gray-300 hover:bg-gray-700 hover:text-white">Kelola Diskon</a>
              <a href="produks" class="rounded-md {{ request()->is('produks')?'bg-gray-900 text-white':'text-gray-300 hover:bg-gray-700 hover:text-white' }}">Kelola Produk</a>
            </div>
          </div>
        </div>

        <!-- Profile and Logout Dropdown -->
        <div class="hidden md:block">
          <div class="ml-4 flex items-center md:ml-6">
            <div class="relative ml-3">
              <div>
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
    </div>
  </nav>

  <div class="bg-gray-800 text-white py-10">
    <div class="container mx-auto">
      <h2 class="text-3xl font-bold mb-4">Dashboard Penjual</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-indigo-600 p-6 rounded-lg shadow-md">
          <h3 class="text-xl font-bold">Total Produk</h3>
          <p class="text-2xl mt-2">{{ $totalProduk }}</p>
        </div>
        <div class="bg-green-600 p-6 rounded-lg shadow-md">
          <h3 class="text-xl font-bold">Total Penjualan</h3>
          <p class="text-2xl mt-2">Rp 15.000.000</p>
        </div>
        <div class="bg-yellow-600 p-6 rounded-lg shadow-md">
          <h3 class="text-xl font-bold">Diskon Aktif</h3>
          <p class="text-2xl mt-2">10</p>
        </div>
      </div>
    </div>
  </div>

<!-- Tampilan Produk -->
<div class="container mx-auto mt-10">
    <h3 class="text-2xl font-bold text-gray-800 mb-4">Semua Produk</h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($produk as $prod)
            <div class="bg-white shadow-md rounded-lg p-5">
                <h4 class="text-xl font-semibold text-gray-800">{{ $prod->nama_produk }}</h4>
                <img src="{{ asset('images/' . $prod->gambar_produk) }}" alt="Gambar Produk" class="w-full h-50 object-cover rounded-md mt-4">
                <p class="text-gray-600">Kategori: {{ $prod->Kategori_Produk->nama_kategori }}</p>
                <p class="text-gray-600">Harga: Rp {{ number_format($prod->harga, 3, ',', '.') }}</p>
                <p class="text-gray-600">Diskon: 
                    {{ $prod->diskon ? $prod->diskon->persentase_diskon . '%' : 'Tidak ada diskon' }}
                </p>
                <p class="text-sm text-gray-600">
                  <strong>Harga Setelah Diskon:</strong> Rp 
                  {{ number_format(($prod->harga - ($prod->harga * ($prod->diskon->persentase_diskon ?? 0) / 100)), 3, ',', '.') }}</p>
                <p class="text-gray-600">Stok: {{ $prod->stok }}</p>
            </div>
        @endforeach
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