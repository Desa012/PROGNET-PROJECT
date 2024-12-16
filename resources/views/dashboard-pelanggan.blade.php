<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<style>
    .horizontal-scroll-container {
    display: flex;
    overflow-x: auto; /* Memungkinkan scroll horizontal */
    gap: 1rem; /* Jarak antar produk */
    padding: 1rem; /* Padding untuk kenyamanan visual */
}

.horizontal-scroll-container::-webkit-scrollbar {
    height: 8px; /* Tinggi scrollbar */
}

.horizontal-scroll-container::-webkit-scrollbar-thumb {
    background-color: #888; /* Warna scrollbar */
    border-radius: 4px;
}

.horizontal-scroll-container::-webkit-scrollbar-thumb:hover {
    background-color: #555;
}

.produk-item {
    min-width: 200px; /* Lebar minimum produk */
    flex: 0 0 auto; /* Agar produk tidak menyusut */
}

.card-img-top {
    width: 100%; /* Gambar menyesuaikan lebar container */
    height: 200px; /* Tetapkan tinggi gambar agar konsisten */
    object-fit: cover; /* Potong gambar agar proporsional tanpa merusak rasio */
    border-radius: 8px; /* Opsional: Beri sudut membulat */
}

</style>
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
              <a href="dashboard-pelanggan" class="rounded-md text-gray-300 hover:bg-gray-700 hover:text-white">Dashboard</a>
            <!-- Taruh navbar baru disini -->
            </div>
          </div>
        </div>

        <!-- Profile and Logout Dropdown -->
        <div class="hidden md:block">
          <div class="ml-4 flex items-center md:ml-6">
            <div class="relative ml-3">
              <div>
                    <form action="{{ route('logout-pelanggan') }}" method="POST" class="inline">
                      @csrf
                      <button type="submit" class="rounded-md text-gray-300 hover:bg-gray-700 hover:text-white">Logout</button>
                    </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>

<div class="container mx-auto mt-10">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Semua Produk Berdasarkan Kategori</h2>
    
    @foreach ($kategoriProduks as $kategori)
    <h3>{{ $kategori->nama_kategori }}</h3>
    <div class="horizontal-scroll-container">
        @foreach ($kategori->produks as $produk)
            <div class="produk-item">
                <div class="card">
                    <img src="{{ asset('images/' . $produk->gambar_produk) }}" alt="{{ $produk->nama_produk }}" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">{{ $produk->nama_produk }}</h5>
                        <p>Harga: Rp {{ number_format($produk->harga, 3, ',', '.') }}</p>
                        <p>Stok: {{ $produk->stok }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @endforeach
</div>

</body>
</html>
