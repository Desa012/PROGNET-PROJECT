@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Konfirmasi Pemesanan</h2>
    <form action="{{ route('pesanan.store') }}" method="POST">
        @csrf
        <div>
            <h3>Produk dalam Keranjang</h3>
            @foreach ($keranjang->produk as $produk)
                <div>
                    <p>{{ $produk->nama }}</p>
                    <p>Harga: Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                </div>
            @endforeach
        </div>
        
        <div>
            <label for="tanggal_pesanan">Tanggal Pemesanan</label>
            <input type="date" id="tanggal_pesanan" name="tanggal_pesanan" required>
        </div>

        <div>
            <label for="metode_pembayaran">Metode Pembayaran</label>
            <select id="metode_pembayaran" name="metode_pembayaran" required>
                @foreach($metodePembayaran as $metode)
                    <option value="{{ $metode->id }}">{{ $metode->nama }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <p>Total Harga: Rp {{ number_format($totalHarga, 0, ',', '.') }}</p>
            <input type="hidden" name="total_harga" value="{{ $totalHarga }}">
            <input type="hidden" name="produk_id[]" value="{{ $produk->id }}"> <!-- Tambahkan produk_id berdasarkan produk di keranjang -->
        </div>

        <button type="submit">Lanjutkan Pemesanan</button>
    </form>
</div>
@endsection
