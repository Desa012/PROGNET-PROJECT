<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
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
              <a href="diskons" class="rounded-md text-gray-300 hover:bg-gray-700 hover:text-white">Kelola Diskon</a>
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
                <a href="{{ route('login-penjual') }}" class="rounded-md text-gray-300 hover:bg-gray-700 hover:text-white">Login</a>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="container mx-auto py-10">
    <!-- Add Product Button -->
      <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="location.href='{{ route('produks.create') }}'">Tambah Produk</button>

    <!-- Produk List -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach ($produk as $prod)
        <div class="bg-white p-6 rounded-lg shadow-md">
          <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $prod->nama_produk }}</h3>
          <div class="my-4">
            <img src="{{ asset('images/' . $prod->gambar_produk) }}" alt="Gambar Produk" class="w-full h-50 object-cover rounded-md mt-4">
          </div>
          <p class="text-sm text-gray-600"><strong>Kategori:</strong> {{ $prod->Kategori_Produk->nama_kategori }}</p>
          <p class="text-sm text-gray-600"><strong>Diskon:</strong> 
            {{ $prod->diskon ? $prod->diskon->nama_diskon : '' }}
            {{ $prod->diskon ? $prod->diskon->persentase_diskon . '%' : 'Tidak ada diskon' }}</p>
          <p class="text-sm text-gray-600"><strong>Harga:</strong> Rp {{ number_format($prod->harga, 0, ',', '.') }}</p>
          <p class="text-sm text-gray-600">
            <strong>Harga Setelah Diskon:</strong> Rp
            {{ number_format(($prod->harga - ($prod->harga * ($prod->diskon->persentase_diskon ?? 0) / 100)), 0, ',', '.') }}</p>
          <p class="text-sm text-gray-600"><strong>Stok:</strong> {{ $prod->stok }}</p>
          <div class="flex justify-between items-center">
            <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded" onclick="location.href='{{ route('produks.edit', $prod->id_produk) }}'">Edit</button>
            <form action="{{ route('produks.destroy', $prod->id_produk) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">Delete</button>
            </form>
          </div>
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
