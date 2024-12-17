<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<!-- Navbar -->
<nav class="bg-gray-800 shadow-lg">
    <div class="container mx-auto flex justify-between items-center h-16 px-4">
        <div class="text-white text-2xl font-bold">
            Dashboard
        </div>
        <form action="{{ route('logout-pelanggan') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="text-gray-300 hover:text-white">Logout</button>
        </form>
    </div>
</nav>

<!-- Kategori Tombol -->
<div class="container mx-auto mt-6 px-4">
    <div class="flex flex-wrap gap-4 mb-6">
        <button class="filter-btn bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" data-filter="all">Semua</button>
        @foreach ($kategoriProduks as $kategori)
            <button class="filter-btn bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" data-filter="{{ $kategori->nama_kategori }}">
                {{ $kategori->nama_kategori }}
            </button>
        @endforeach
    </div>
</div>

<!-- Produk Container -->
<div class="container mx-auto px-4">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 produk-container">
        @foreach ($kategoriProduks as $kategori)
            @foreach ($kategori->produks as $produk)
                <div class="produk-item hidden shadow-lg bg-white rounded-lg overflow-hidden" data-kategori="{{ $kategori->nama_kategori }}">
                    <img src="{{ asset('images/' . $produk->gambar_produk) }}" alt="{{ $produk->nama_produk }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h5 class="font-bold text-lg">{{ $produk->nama_produk }}</h5>
                        <p class="text-gray-600">Harga: Rp {{ number_format($produk->harga, 3, ',', '.') }}</p>
                        <p class="text-gray-600">Stok: {{ $produk->stok }}</p>
                        <form action="{{ route('keranjang.tambah') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_produk" value="{{ $produk->id_produk }}">
                            <button type="submit" class="mt-2 w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                                Tambah ke Keranjang
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>
</div>

<!-- JavaScript Filter -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const filterButtons = document.querySelectorAll(".filter-btn");
        const produkItems = document.querySelectorAll(".produk-item");

        // Fungsi untuk menyembunyikan semua produk secara default
        produkItems.forEach(item => item.classList.add("hidden"));

        // Event Listener untuk setiap tombol filter
        filterButtons.forEach(button => {
            button.addEventListener("click", function () {
                const filter = button.getAttribute("data-filter");

                produkItems.forEach(item => {
                    const kategori = item.getAttribute("data-kategori");

                    if (filter === "all" || kategori === filter) {
                        item.classList.remove("hidden"); // Tampilkan produk
                    } else {
                        item.classList.add("hidden"); // Sembunyikan produk
                    }
                });
            });
        });
    });
</script>

</body>
</html>
