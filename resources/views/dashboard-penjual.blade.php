<x-layout-penjual>

    <!-- Header Dashboard -->
    <div class="bg-blue-900 text-white py-10">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold mb-6 text-center">Dashboard Penjual</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-blue-700 p-6 rounded-lg shadow-md text-center">
                    <h3 class="text-lg font-bold">Total Produk</h3>
                    <p class="text-3xl mt-2">{{ $totalProduk }}</p>
                </div>
                <div class="bg-blue-700 p-6 rounded-lg shadow-md text-center">
                    <h3 class="text-lg font-bold">Total Penjualan</h3>
                    <p class="text-3xl mt-2">Rp{{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                </div>
                <div class="bg-blue-700 p-6 rounded-lg shadow-md text-center">
                    <h3 class="text-lg font-bold">Pesanan Selesai</h3>
                    <p class="text-3xl mt-2">{{ $pesananSelesai }}</p>
                </div>
                <div class="bg-blue-700 p-6 rounded-lg shadow-md text-center">
                    <h3 class="text-lg font-bold">Pesanan Belum selesai</h3>
                    <p class="text-3xl mt-2">{{ $pesananBelumSelesai }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tampilan Semua Produk -->
    <div class="container mx-auto mt-10 px-4">
        <h3 class="text-2xl font-bold text-blue-900 mb-6">Semua Produk</h3>
        <div class="grid grid-cols-5 gap-8">
            @foreach ($produk as $prod)
            <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200" style="width: 300px;">
                <img src="{{ asset('images/' . $prod->gambar_produk) }}" alt="Gambar Produk" class="w-full h-48 object-cover">
                <div class="flex flex-col h-full">
                    <h4 class="text-lg font-semibold text-blue-900 mb-2">
                        {{ $prod->nama_produk }}
                    </h4>
                    <p class="text-gray-600 mb-1">
                        <strong>Kategori:</strong> {{ $prod->Kategori_Produk->nama_kategori ?? 'Tidak ada kategori' }}
                    </p>

                    <!-- Diskon -->
                    @if ($prod->diskon->isNotEmpty())
                    <span class="list-disc list-inside text-gray-600 mb-2">
                        <p><strong>Diskon:</strong> {{ $prod->diskon->first()->nama_diskon }} ({{ $prod->diskon->first()->persentase_diskon }}%)</p>
                        @foreach ($prod->diskon->slice(1) as $diskon)
                        <p>{{ $diskon->nama_diskon }} ({{ $diskon->persentase_diskon }}%)</p>
                        @endforeach
                    </span>
                    @else
                    <p class="text-gray-600 mb-2">Diskon: Tidak ada diskon</p>
                    @endif

                    <!-- Harga Setelah Diskon -->
                    @php
                    $total_diskon = 0; // Awal total diskon
                    $harga_sementara = $prod->harga; // Harga sementara untuk perhitungan bertahap

                    if ($prod->diskon->isNotEmpty()) {
                    foreach ($prod->diskon as $diskon) {
                    $potongan = $harga_sementara * ($diskon->persentase_diskon / 100);
                    $total_diskon += $potongan; // Tambahkan potongan ke total diskon
                    $harga_sementara -= $potongan; // Kurangi harga sementara dengan potongan
                    }
                    }

                    $harga_setelah_diskon = $prod->harga - $total_diskon;
                    @endphp
                    @if ($total_diskon > 0)
                    {{-- Harga setelah diskon --}}
                    <div class="mx-3">
                        <span class="text-lg font-bold text-gray-900">
                            Rp{{ number_format($harga_setelah_diskon, 0, ',', '.') }}
                        </span>
                    </div>

                    {{-- Harga sebelum diskon --}}
                    <div class="mb-2" style="margin-top: -5px;">
                        <span class="text-xs text-gray-500 line-through ml-3">
                            Rp{{ number_format($prod->harga, 0, ',', '.') }}
                        </span>

                        {{-- Persentase diskon --}}
                        <span class="text-sm text-red-600 ml-1">
                            ({{ $prod->diskon->first()->persentase_diskon }}%)
                        </span>
                    </div>

                    <div class="flex items-center pt-1 mx-3">
                        <div class="flex items-center space-x-1 rtl:space-x-reverse">
                            <svg class="w-3 h-3 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                            </svg>
                        </div>
                        <span class="bg-blue-100 text-blue-800 font-bold px-1.5 py-0.4 rounded dark:bg-blue-200 dark:text-blue-800 ms-1" style="font-size: 10px;">4.0</span>
                    </div>
                    @else

                    {{-- Kondisi tidak ada diskon  --}}

                    {{-- Harga tanpa diskon --}}
                    <div class="mb-6 mx-3">
                        <span class="text-lg font-bold text-gray-900">
                            Rp{{ number_format($prod->harga, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="flex items-center pt-1 mx-3">
                        <div class="flex items-center space-x-1 rtl:space-x-reverse">
                            <svg class="w-3 h-3 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                            </svg>
                        </div>
                        <span class="bg-blue-100 text-blue-800 font-bold px-1.5 py-0.4 rounded dark:bg-blue-200 dark:text-blue-800 ms-1" style="font-size: 10px;">4.0</span>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>

</x-layout-penjual>