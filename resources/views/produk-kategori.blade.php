<x-layout-pelanggan>
    <div class="kontainer-produk-kategori mt-5 px-4" style="margin-right: -200px; margin-left: -200px;">
        {{-- Navigasi Kategori --}}
        <h2 class="text-2xl font-bold mb-4 text-gray-800">{{ $kategori->nama_kategori }}</h2>
        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 mt-4">
            @foreach ($produks as $produk)
            <div class="w-full max-w-sm bg-white border border-gray-300 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-200">
                {{-- Gambar Produk --}}
                <div class="image-container">
                    <a href="{{ route('produks.show', $produk->id_produk) }}">
                        <img src="{{ asset('images/' . $produk->gambar_produk) }}"
                             alt="{{ $produk->nama_produk }}"
                             class="rounded-t-lg w-full h-48 object-cover">
                    </a>
                </div>
                {{-- Informasi Produk --}}
                <div class="p-4">
                    {{-- Nama Produk --}}
                    <a href="{{ route('produks.show', $produk->id_produk) }}">
                        <h5 class="text-sm font-medium text-gray-700">{{ $produk->nama_produk }}</h5>
                    </a>

                    {{-- Menghitung Diskon --}}
                    @php
                        $total_diskon = $produk->diskon->isNotEmpty()
                            ? $produk->diskon->sum(function($d) use ($produk) {
                                return $produk->harga * ($d->persentase_diskon / 100);
                            })
                            : 0;

                        $harga_setelah_diskon = $produk->harga - $total_diskon;
                    @endphp

                    {{-- Harga Produk --}}
                    <div class="mt-2">
                        @if ($total_diskon > 0)
                            {{-- Harga Setelah Diskon --}}
                            <span class="text-lg font-bold text-gray-900">
                                Rp{{ number_format($harga_setelah_diskon, 0, ',', '.') }}
                            </span>
                            {{-- Harga Sebelum Diskon --}}
                            <span class="text-xs text-gray-500 line-through ml-2">
                                Rp{{ number_format($produk->harga, 0, ',', '.') }}
                            </span>
                            {{-- Persentase Diskon --}}
                            <span class="text-sm text-red-600 ml-1">
                                ({{ $produk->diskon->first()->persentase_diskon }}%)
                            </span>
                        @else
                            {{-- Harga Tanpa Diskon --}}
                            <span class="text-lg font-bold text-gray-900">
                                Rp{{ number_format($produk->harga, 0, ',', '.') }}
                            </span>
                        @endif
                    </div>

                    @if ($produk->alamat_penjual)
                        {{-- Alamat Penjual --}}
                        <div class="mt-3">
                            <span class="text-xs text-gray-600">
                                {{ $produk->alamat_penjual->kota}}
                            </span>
                        </div>
                    @else
                        <p>

                        </p>
                    @endif


                    {{-- Rating Produk --}}
                    <div class="flex items-center mt-3">
                        <svg class="w-4 h-4 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                        </svg>
                        <span class="text-xs text-gray-800 ml-1 bg-blue-100 px-1.5 py-0.5 rounded">
                            4.0
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-layout-pelanggan>
