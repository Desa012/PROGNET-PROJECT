<x-layout-pelanggan>

    <div class="container">

        {{-- Gambar produk --}}

        <div class="gambar-produk sticky">
            <img src="{{ asset('images/' . $produk->gambar_produk) }}" alt="{{ $produk->nama_produk }}" class="img-fluid">
        </div>

        <div class="info-produk">
            {{-- Nama produk --}}
            <h2>
                {{ $produk->nama_produk }}
            </h2>

            {{-- Stok produk --}}
            <p>
                Stok: {{ $produk->stok }}
            </p>

            {{-- Deskripsi produk --}}
            <p class="deskripsi">
                Deskripsi: {{ $produk->deskripsi_produk }}
            </p>

            {{-- Nama penjual --}}
            <p class="oenjual">
                {{ $produk->penjual->nama_toko }}
            </p>
        </div>

        <div class="info-pembelian">
            {{-- Harga produk --}}
            <h2>
                Harga: Rp{{ number_format($produk->harga, 0, ',', '.') }}
            </h2>

            {{-- Diskon jika ada --}}
            @if ($produk->diskon->isNotEmpty())
                <p>
                    Diskon: {{ $produk->diskon->first()->persentase_diskon }}%
                </p>
                <p>
                    Harga setelah diskon: Rp{{ number_format($produk->harga - ($produk->harga * $produk->diskon->first()->persentase_diskon / 100), 0, ',', '.') }}
                </p>
            @endif

            {{-- Tambah ke keranjang --}}
            <form action="{{ route('keranjangs.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id_produk" value="{{ $produk->id_produk }}">
                <label for="jumlah">
                    Jumlah:
                </label>
                <input type="number" name="jumlah" id="jumlah" value="1" min="1" class="form-control mb-3">
                <button type="submit" class="btn btn-primary">
                    Tambah ke Keranjang
                </button>
            </form>
        </div>
    </div>

</x-layout-pelanggan>
