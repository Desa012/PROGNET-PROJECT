<x-layout-penjual>

    <!-- Header Dashboard -->
    <div class="bg-blue-900 text-white py-10">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold mb-6 text-center">Dashboard Penjual</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-blue-700 p-6 rounded-lg shadow-md text-center">
                    <h3 class="text-lg font-bold">Total Produk</h3>
                    <p class="text-3xl mt-2">{{ $totalProduk }}</p>
                </div>
                <div class="bg-blue-700 p-6 rounded-lg shadow-md text-center">
                    <h3 class="text-lg font-bold">Total Penjualan</h3>
                    <p class="text-3xl mt-2">Rp{{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                </div>
                <div class="bg-blue-700 p-6 rounded-lg shadow-md text-center">
                    <h3 class="text-lg font-bold">Total Pesanan</h3>
                    <p class="text-3xl mt-2">{{ $totalPesanan }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tampilan Semua Produk -->
    <div class="container mx-auto mt-10 px-4">
        <h3 class="text-2xl font-bold text-blue-900 mb-6">Semua Produk</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($produk as $prod)
            <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
                <img src="{{ asset('images/' . $prod->gambar_produk) }}" alt="Gambar Produk" class="w-full h-48 object-cover">
                <div class="p-5">
                    <h4 class="text-lg font-semibold text-blue-900 mb-2">
                        {{ $prod->nama_produk }}
                    </h4>
                    <p class="text-gray-600 mb-1">
                        <strong>Kategori:</strong> {{ $prod->Kategori_Produk->nama_kategori ?? 'Tidak ada kategori' }}
                    </p>
                    <p class="text-gray-600 mb-1">
                        <strong>Harga:</strong> Rp {{ number_format($prod->harga, 0, ',', '.') }}
                    </p>

                    <!-- Diskon -->
                    @if ($prod->diskon->isNotEmpty())
                    <p class="text-gray-600 mb-1"><strong>Diskon:</strong></p>
                    <ul class="list-disc list-inside text-gray-600 mb-2">
                        @foreach ($prod->diskon as $diskon)
                        <li>{{ $diskon->nama_diskon }} ({{ $diskon->persentase_diskon }}%)</li>
                        @endforeach
                    </ul>
                    @else
                    <p class="text-gray-600 mb-2">Diskon: Tidak ada diskon</p>
                    @endif

                    <!-- Harga Setelah Diskon -->
                    @php
                    $totalDiskon = $prod->diskon->sum(function($d) use ($prod) {
                        return $prod->harga * ($d->persentase_diskon / 100);
                    });
                    $hargaSetelahDiskon = $prod->harga - $totalDiskon;
                    @endphp
                    <p class="text-gray-600 mb-1">
                        <strong>Harga Setelah Diskon:</strong> Rp {{ number_format($hargaSetelahDiskon, 0, ',', '.') }}
                    </p>
                    <p class="text-gray-600">
                        <strong>Stok:</strong> {{ $prod->stok }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</x-layout-penjual>
