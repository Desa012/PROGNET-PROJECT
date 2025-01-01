<x-layout-pelanggan> 
    <div class="container">
        <form method="GET" action="{{ route('toko.index') }}" class="mb-4">
            <input type="text" name="search" placeholder="Cari Toko..." class="p-2 border rounded" value="{{ request('search') }}">
            <button type="submit" class="bg-blue-600 text-white p-2 rounded">Cari</button>
        </form>

        <div class="toko-list">
            @if($penjuals->isEmpty())
                <p>Toko tidak ditemukan</p>
            @else
                @foreach($penjuals as $penjual)
                    <div class="toko-item">
                        <h3>{{ $penjual->nama_toko }}</h3>
                        <p>{{ $penjual->deskripsi_toko }}</p>

                        {{-- Menampilkan produk-produk dari toko --}}
                        <div class="produk-list mt-4">
                            <h4>Produk di Toko:</h4>
                            @if($penjual->produks->isEmpty())
                                <p>Tidak ada produk di toko ini.</p>
                            @else
                                <ul>
                                    @foreach($penjual->produks as $product)
                                        <li>
                                            <h5>{{ $product->nama_produk }}</h5>
                                            <p>{{ $product->deskripsi_produk }}</p>
                                            <p>Harga: Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</x-layout-pelanggan>

