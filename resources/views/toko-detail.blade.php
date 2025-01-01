<x-layout-pelanggan>
    <div class="kontainer py-8">
        <!-- Header Toko -->
        <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
            <h1 class="text-3xl font-bold text-blue-900 mb-2">{{ $penjual->nama_toko }}</h1>
            <p class="text-gray-700 mb-4">{{ $penjual->deskripsi_toko }}</p>
            <p class="text-gray-500 text-sm mb-4"><strong>Alamat:</strong> {{ $alamat_default->kecamatan }}, {{ $alamat_default->kota }}, {{ $alamat_default->provinsi }}</p>
        </div>

        <!-- Produk List -->
        <div class="produk-list max-w grid grid-cols-5 gap-6">
                    @if($penjual->produks->isEmpty())
                    <p class="col-span-full text-gray-500 text-center">Tidak ada produk di toko ini.</p>
                    @else
                    @foreach($penjual->produks as $product)
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
</x-layout-pelanggan>
