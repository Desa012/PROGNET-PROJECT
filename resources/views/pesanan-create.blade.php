<x-layout-pelanggan>
    <div class="kontainer-pesanan">
        <h2 class="title">
            Konfirmasi Pemesanan
        </h2>
        <div class="content">
            <div class="produk-keranjang">
                <h3>
                    Produk dalam Keranjang
                </h3>

                @foreach ($keranjangs as $keranjang)
                    <div class="produk-item">
                        <p class="produk-nama">
                            {{ $keranjang->produks->nama_produk }}
                        </p>
                        <p class="produk-harga">
                            Harga: Rp {{ number_format($keranjang->produks->harga, 0, ',', '.') }}
                        </p>
                        <p class="produk-jumlah">
                            Jumlah: {{ $keranjang->jumlah }}
                        </p>
                    </div>
                @endforeach
            </div>

<<<<<<< Updated upstream
            <div class="kolom-kanan">
                <form action="{{ route('pesanan.store') }}" method="POST" class="form-konfirmasi">
                    @csrf
                    <div class="form-group">
                        <label for="metode_pembayaran" class="label">
                            Metode Pembayaran
                        </label>
                        <select id="metode_pembayaran" name="metode_pembayaran" class="input" required>
                            @foreach ($metode_pembayaran as $metode)
                                <option value="{{ $metode->id_metode }}">{{ $metode->jenis_metode }}</option>
                            @endforeach
                        </select>
                    </div>
=======
            <div>
                <label for="tanggal_pesanan">Tanggal Pemesanan</label>
                <p></p>
                <input type="date" id="tanggal_pesanan" name="tanggal_pesanan" required>
            </div>
>>>>>>> Stashed changes

                    <div class="form-group">
                        <label for="alamat" class="label">
                            Alamat Pengiriman
                        </label>
                        <select name="id_alamat" id="id_alamat" class="input" required>
                            @foreach ($alamats as $alamat)
                                <option value="{{ $alamat->id_alamat }}">
                                    {{ $alamat->alamat }}, {{ $alamat->kecamatan }}, {{ $alamat->kota }},
                                    {{ $alamat->provinsi }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="total-harga">
                        <p class="harga-total">
                            Total Harga: Rp {{ number_format($total_harga, 0, ',', '.') }}
                        </p>
                        <input type="hidden" name="total_harga" value="{{ $total_harga }}">
                        @foreach ($keranjangs as $keranjang)
                            <input type="hidden" name="produk_id[]" value="{{ $keranjang->produks->id_produk }}">
                        @endforeach
                    </div>

                    <button type="submit"
                        class="btn-pesan bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                        Lanjutkan Pemesanan
                    </button>
                </form>
            </div>
        </div>

        @if(session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    timer: 3000, // Durasi pop-up dalam milidetik
                    showConfirmButton: false,
                    // confirmButtonText: 'OK',
                    timerProgressBar: true,
                });
            </script>
        @endif

        @if(session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: '{{ session('error') }}',
                    timer: 3000,
                    showConfirmButton: false,
                    timerProgressBar: true,
                });
            </script>
        @endif

    </div>

    <style>
        .kontainer-pesanan {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 100%;
            margin: 0 auto;
        }

        .title {
            text-align: left;
            font-size: 24px;
            font-weight: bold;
            color: #0c0c0c;
            margin-bottom: 20px;
        }

        .content {
            display: flex;
            gap: 20px;
        }

        .form-konfirmasi {
            display: flex;
            flex-direction: column;
        }

        .produk-keranjang {
            flex: 2;
            background-color: #ffffff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }

        .produk-keranjang h3 {
            color: #343a40;
            margin-bottom: 10px;
        }

        .produk-item {
            background-color: #ffffff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            margin-bottom: 25px;
        }

        .produk-nama {
            font-weight: bold;
            color: #495057;
            margin-bottom: 1%;
        }

        .produk-harga,
        .produk-jumlah {
            color: #6c757d;
        }

        .kolom-kanan {
            flex: 1;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 20px;
            height: fit-content;
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
            color: #1945ad;
        }

        .btn-pesan {
            color: #ffffff;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
    </style>
</x-layout-pelanggan>
