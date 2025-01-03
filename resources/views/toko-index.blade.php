<x-layout-pelanggan>
    <div class="kontainer-toko py-8" style="margin-left: -50px; margin-right: -50px;">
        <!-- Toko List -->
        <div class="toko-list space-y-6">
            @if($penjuals->isEmpty())
            <p class="text-center text-gray-500">Toko tidak ditemukan</p>
            @else
            @foreach($penjuals as $penjual)
            <div class="toko-item border rounded-lg p-6 shadow-md flex items-start bg-white">
                <!-- Informasi Toko -->
                <div class="toko-info w-1/4 pr-6 border-r border-gray-200">
                    <h3 class="text-lg font-bold text-gray-800">{{ $penjual->nama_toko }}</h3>
                    <p class="text-gray-700 mb-4">{{ $penjual->deskripsi_toko }}</p>
                    
                    <p class="text-gray-500 text-sm mb-2">Alamat: {{ $penjual->alamats->where('is_default', 1)->first()->kota }}</p>
                    <a
                        href="{{ route('toko.detail', $penjual->id_penjual) }}"
                        class="inline-block mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                        Kunjungi Toko
                    </a>
                </div>

                <!-- Produk List -->
                <div class="produk-list w-3/4 grid grid-cols-4 gap-6 pl-6">
                    @if($penjual->produks->isEmpty())
                    <p class="col-span-full text-gray-500 text-center">Tidak ada produk di toko ini.</p>
                    @else
                    @foreach($penjual->produks->take(4) as $product)
                    <div class="produk-item bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
                        <a href="{{ route('produks.show', $product->id_produk) }}">
                            <img
                                src="{{ asset('images/' . $product->gambar_produk) }}"
                                alt="{{ $product->nama_produk }}"
                                class="w-full h-48 object-cover">
                        </a>
                        <div class="flex flex-col h-full">
                            <a href="{{ route('produks.show', $product->id_produk) }}" class="mx-3 mb-3">
                                <h4 class="text-md font-semibold text-gray-800 mb-2">
                                    {{ $product->nama_produk }}
                                </h4>
                            </a>
                            @php
                                $total_diskon = $product->diskon->isNotEmpty()
                                    ? $product->diskon->sum(function($d) use ($product) {
                                    return $product->harga * ($d->persentase_diskon / 100);
                                    })
                                    : 0;

                                $harga_setelah_diskon = $product->harga - $total_diskon;
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
                                        Rp{{ number_format($product->harga, 0, ',', '.') }}
                                    </span>

                                    {{-- Persentase diskon --}}
                                    <span class="text-sm text-red-600 ml-1">
                                        ({{ $product->diskon->first()->persentase_diskon }}%)
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
                                        Rp{{ number_format($product->harga, 0, ',', '.') }}
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
                    @endif
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</x-layout-pelanggan>