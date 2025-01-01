<x-layout-pelanggan>

    <div class="container">

        {{-- Gambar produk --}}

        <div class="gambar-produk sticky">
            @if ($produk->gambar_produk)
                <img src="{{ asset('images/' . $produk->gambar_produk) }}" alt="{{ $produk->nama_produk }}" class="img-fluid">
            @else
                <p class="text-gray-500">
                    Tidak ada gambar produk.
                </p>
            @endif
        </div>

        <div class="info-produk">
            {{-- Nama produk --}}
            <h2>
                {{ $produk->nama_produk }}
            </h2>

            {{-- Diskon jika ada --}}
            @if ($produk->diskon->isNotEmpty())
                {{-- Harga setelah diskon --}}
                <p class="text-3xl font-bold mb-1">
                    Rp{{ number_format($produk->harga - ($produk->harga * $produk->diskon->first()->persentase_diskon / 100), 0, ',', '.') }}
                </p>

                <div class="flex items-center mb-5">
                    {{-- Harga produk --}}
                    <p class="text-md line-through mr-2">
                        Rp{{ number_format($produk->harga, 0, ',', '.') }}
                    </p>

                    {{-- Persentase diskon --}}
                    <p class="text-lg text-red-600">
                        ({{ $produk->diskon->first()->persentase_diskon }}%)
                    </p>
                </div>
            @else
                {{-- Harga produk --}}
                <p class="text-3xl font-bold mb-10">
                    Rp{{ number_format($produk->harga, 0, ',', '.') }}
                </p>
            @endif

            {{-- Deskripsi produk --}}
            <p class="deskripsi">
                {{ $produk->deskripsi_produk }}
            </p>

            {{-- Nama penjual --}}
            <p class="penjual">
                {{ $produk->penjual->nama_toko }}
            </p>
        </div>

        <div class="info-pembelian">

            {{-- Tambah ke keranjang --}}
            <form action="{{ route('keranjangs.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id_produk" value="{{ $produk->id_produk }}">
                <label for="jumlah">
                    Jumlah:
                </label>

                <div class="flex items-center mb-2">
                    <input type="number" name="jumlah" id="jumlah" value="1" min="1" class="form-control mb-4 mt-2 text-center" style="width: 50%;">

                    {{-- Stok produk --}}
                    <p class="text-lg font-semibold ml-4">
                        Stok: {{ $produk->stok }}
                    </p>
                </div>

                {{-- Diskon jika ada --}}
                @if ($produk->diskon->isNotEmpty())

                    <div>
                        <div class="flex items-center mt-12 mb-4 space-x-16">
                            <p class="text-md font-semibold ml-1">
                                Subtotal:
                            </p>
                        </div>

                        <div>
                            {{-- Harga setelah diskon --}}
                            <p class="text-2xl font-bold mb-1">
                                Rp{{ number_format($produk->harga - ($produk->harga * $produk->diskon->first()->persentase_diskon / 100), 0, ',', '.') }}
                            </p>

                            <div class="flex items-center mb-5">
                                {{-- Harga produk --}}
                                <p class="text-md line-through mr-2">
                                    Rp{{ number_format($produk->harga, 0, ',', '.') }}
                                </p>

                                {{-- Persentase diskon --}}
                                <p class="text-lg text-red-600">
                                    ({{ $produk->diskon->first()->persentase_diskon }}%)
                                </p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="flex items-center mt-12 mb-4 space-x-16">

                        <div>
                            <p class="text-md font-semibold ml-1">
                                Subtotal:
                            </p>
                        </div>

                        {{-- Harga produk --}}
                        <p class="text-xl font-bold ">
                            Rp{{ number_format($produk->harga, 0, ',', '.') }}
                        </p>

                    </div>

                @endif


                <button type="submit" class="btn btn-primary">
                    Tambah ke Keranjang
                </button>
            </form>
        </div>
    </div>

</x-layout-pelanggan>
