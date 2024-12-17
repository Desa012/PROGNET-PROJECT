@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Keranjang Belanja</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (!empty($keranjang))
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($keranjang as $item)
                    <tr>
                        <td>{{ $item['nama_produk'] }}</td>
                        <td>Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                        <td>{{ $item['jumlah'] }}</td>
                        <td>Rp {{ number_format($item['harga'] * $item['jumlah'], 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Keranjang belanja Anda kosong.</p>
    @endif

    <a href="{{ url('/dashboard-pelanggan') }}" class="btn btn-primary">Kembali Belanja</a>
</div>
@endsection
