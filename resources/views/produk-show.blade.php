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

            <div class="info-toko-produk">
                {{-- Gambar penjual --}}
                <div class="gambar-toko-produk flex-shrink-0 mr-5">
                    <img src="https://loremflickr.com/300/200" alt="{{ $produk->penjual->nama_toko }}">
                </div>

                {{-- Informasi toko --}}
                <div class="">
                    <a href="{{ route('toko.detail', $produk->penjual->id_penjual) }}">
                        <h3 class="penjual text-lg font-bold text-gray-800">
                            {{ $produk->penjual->nama_toko }}
                        </h3>
                    </a>
                    <p class="text-xs text-gray-600">
                        {{ $produk->penjual->alamats->first()->kota }}
                    </p>
                    <p class="text-xs text-gray-600">
                        {{ $produk->penjual->deskripsi_toko }}
                    </p>
                </div>
            </div>
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
                    <input type="number" name="jumlah" id="jumlah" value="1" min="1" class="form-control mb-4 mt-2 text-center"
                        data-harga="{{ $produk->harga }}"
                        data-diskon="{{ $produk->diskon->isNotEmpty() ? $produk->diskon->first()->persentase_diskon : 0 }}"
                        style="width: 50%;">

                    {{-- Stok produk --}}
                    <p class="text-lg font-semibold ml-4">
                        Stok: {{ $produk->stok }}
                    </p>
                </div>

                {{-- Diskon jika ada --}}
                @if ($produk->diskon->isNotEmpty())

                    <div class="flex items-center mt-2 space-x-16">
                        <div class="flex items-center mt-12 mb-4 space-x-16">
                            <p class="text-md font-semibold ml-1">
                                Subtotal:
                            </p>
                        </div>

                        <div>
                            {{-- Harga setelah diskon --}}
                            <p id="subtotal" class="text-2xl font-bold mb-1">
                                Rp{{ number_format($produk->harga - ($produk->harga * $produk->diskon->first()->persentase_diskon / 100), 0, ',', '.') }}
                            </p>

                            <div class="flex items-center">
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
                        <p id="subtotal" class="text-xl font-bold ">
                            Rp{{ number_format($produk->harga, 0, ',', '.') }}
                        </p>

                    </div>

                @endif


                <button type="submit" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                    <i class="bi bi-plus-circle fs-4 me-2"></i> Tambah Ke Keranjang
                </button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const jumlah_input = document.getElementById('jumlah');
            const sub_total_element = document.getElementById('subtotal');

            if (!jumlah_input || !sub_total_element) {
                console.error("Element 'jumlah' or 'subtotal' not found");
                return;
            }

            jumlah_input.addEventListener('input', function () {
                // Ambil harga dari atribut data
                const harga = parseFloat(jumlah_input.dataset.harga);

                // Ambil diskon dari atribut data
                const diskon = parseFloat(jumlah_input.dataset.diskon);

                // Default jumlah ke 1 jika kosong atau tidak valid
                const jumlah = parseInt(jumlah_input.value) || 1;

                console.log("Harga:", harga, "Diskon:", diskon, "Jumlah:", jumlah);

                if (isNaN(harga) || isNaN(diskon)) {
                    console.error("Harga atau diskon tidak valid");
                    return;
                }

                // Hitung total
                const harga_diskon = harga - (harga * (diskon / 100));
                const subtotal = harga_diskon * jumlah;

                sub_total_element.textContent = 'Rp' + subtotal.toLocaleString('id-ID', {
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                });

                consloge.log("Subtotal:", subtotal);
            });
        });
    </script>

</x-layout-pelanggan>
