<x-layout-pelanggan>
    <div class="container">
        <h2 class="title">Konfirmasi Pemesanan</h2>
        <form action="{{ route('pesanan.store') }}" method="POST" class="form-konfirmasi">
            @csrf
            <div class="produk-keranjang">
                <h3>Produk dalam Keranjang</h3>
                @foreach ($keranjangs as $keranjang)
                    <div class="produk-item">
                        <p class="produk-nama">{{ $keranjang->produks->nama_produk }}</p>
                        <p class="produk-harga">Harga: Rp {{ number_format($keranjang->produks->harga, 0, ',', '.') }}</p>
                        <p class="produk-jumlah">Jumlah: {{ $keranjang->jumlah }}</p>
                    </div>
                @endforeach
            </div>

            <div class="form-group">
                <label for="metode_pembayaran" class="label">Metode Pembayaran</label>
                <select id="metode_pembayaran" name="metode_pembayaran" class="input" required>
                    @foreach($metode_pembayaran as $metode)
                        <option value="{{ $metode->id_metode }}">{{ $metode->jenis_metode }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="alamat" class="label">Alamat Pengiriman</label>
                <select name="id_alamat" id="id_alamat" class="input" required>
                    @foreach ($alamats as $alamat)
                        <option value="{{ $alamat->id_alamat }}">
                            {{ $alamat->alamat }}, {{ $alamat->kecamatan }}, {{ $alamat->kota }}, {{ $alamat->provinsi }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="total-harga">
                <p class="harga-total">Total Harga: Rp {{ number_format($total_harga, 0, ',', '.') }}</p>
                <input type="hidden" name="total_harga" value="{{ $total_harga }}">
                @foreach ($keranjangs as $keranjang)
                    <input type="hidden" name="produk_id[]" value="{{ $keranjang->produks->id_produk }}">
                @endforeach
            </div>

            <button type="submit" class="btn-pesan">Lanjutkan Pemesanan</button>
        </form>
    </div>

    <style>
        .container {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 0 auto;
        }
        
        .title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 20px;
        }

        .form-konfirmasi {
            display: flex;
            flex-direction: column;
        }

        .produk-keranjang h3 {
            color: #343a40;
        }

        .produk-item {
            background-color: #ffffff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
        }

        .produk-nama {
            font-weight: bold;
            color: #495057;
        }

        .produk-harga, .produk-jumlah {
            color: #6c757d;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .label {
            font-weight: bold;
            color: #495057;
            margin-bottom: 5px;
        }

        .input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 16px;
            color: #495057;
            background-color: #ffffff;
        }

        .total-harga {
            background-color: #ffffff;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .harga-total {
            font-size: 18px;
            font-weight: bold;
            color: #28a745;
        }

        .btn-pesan {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-pesan:hover {
            background-color: #0056b3;
        }
    </style>
</x-layout-pelanggan>
