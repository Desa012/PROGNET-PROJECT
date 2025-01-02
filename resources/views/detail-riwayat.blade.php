<x-layout-penjual>
    <div class="kontainer-detail-pesanan mx-auto py-6">
        <h1 class="text-2xl font-semibold mb-4">
            Detail Riwayat Pesanan
        </h1>

        <div class="border rounded-lg p-4 bg-white shadow">
            <div class="mb-4">
                <p>
                    <strong>Nama Pelanggan</strong> {{ optional($pesanan->users)->nama ?? 'Data pelanggan tidak tersedia' }}
                </p>

                <p>
                    <strong>Alamat</strong> {{ $pesanan->alamats->alamat }}
                </p>

                <p>
                    <strong>Tanggal Pesan</strong> {{ $pesanan->tanggal_pesanan }}
                </p>

                <p>
                    <strong>Tanggal Kirim</strong> {{ $pesanan->pengiriman->tanggal_pengiriman }}
                </p>

                <p>
                    <strong>Tanggal Terima</strong> {{ $pesanan->pengiriman->tanggal_diterima }}
                </p>

                <p>
                    <strong>Status</strong> {{ $pesanan->status }}
                </p>
            </div>
            <div>
                <h2 class="text-lg font-semibold">
                    Detail Produk:
                </h2>

                <div class="mt-2 list-disc list-inside">
                    @foreach ($pesananSelesai as $pesanan)
                    @foreach ($pesanan->detail_pesanans as $detail)
                    <div class="flex items-center mb-6">
                        <div style="width: 60px; aspect-ratio: 1/1; overflow: hidden; border-radius: 8px; margin-right: 15px;">
                            <img style="width: 100%; height: 100%; object-fit: cover;" class="" src="{{ asset('images/'. $detail->produk->gambar_produk) }}" alt="{{ $detail->produk->nama_produk }}">
                        </div>

                        <p>
                            {{ $detail->produk->nama_produk }} - {{ $detail->jumlah }} x Rp{{ number_format($detail->subtotal / $detail->jumlah, 0, ',', '.') }}
                            (Subtotal: Rp{{ number_format($detail->subtotal, 0, ',', '.') }})
                        </p>
                    </div>
                    @endforeach
                    @endforeach
                </div>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('pesanan.riwayat' )}}" class="text-blue-500 hover:underline">
                Kembali ke Daftar Pesanan
            </a>
        </div>
    </div>
</x-layout-penjual>