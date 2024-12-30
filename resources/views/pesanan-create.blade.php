<x-layout-pelanggan>

    <div class="container">
        <h2>Konfirmasi Pemesanan</h2>
        <form action="{{ route('pesanan.store') }}" method="POST">
            @csrf
            <div>
                <h3>Produk dalam Keranjang</h3>
                @foreach ($keranjangs as $keranjang)
                    <div>
                        <p>{{ $keranjang->produks->nama_produk }}</p>
                        <p>Harga: Rp {{ number_format($keranjang->produks->harga, 0, ',', '.') }}</p>
                        <p>Jumlah: {{ $keranjang->jumlah }}</p>
                    </div>
                @endforeach
            </div>
            <div>
                <label for="metode_pembayaran">Metode Pembayaran</label>
                <select id="metode_pembayaran" name="metode_pembayaran" required>
                    @foreach($metode_pembayaran as $metode)
                        <option value="{{ $metode->id_metode }}">{{ $metode->jenis_metode }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="alamat">Alamat Pengiriman</label>
                <textarea id="alamat" name="alamat" required>{{ old('alamat', $alamat) }}</textarea>
            </div>
            <div>
                <p>Total Harga: Rp {{ number_format($total_harga, 0, ',', '.') }}</p>
                <input type="hidden" name="total_harga" value="{{ $total_harga }}">
                @foreach ($keranjangs as $keranjang)
                    <input type="hidden" name="produk_id[]" value="{{ $keranjang->produks->id_produk }}"> <!-- Tambahkan produk_id berdasarkan produk di keranjang -->
                @endforeach
            </div>
            <button type="submit">Lanjutkan Pemesanan</button>
        </form> 
    </div>
</x-layout-pelanggan>

