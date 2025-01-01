<x-layout-pelanggan>
    <div class="kontainer-detail-pesanan mx-auto py-6">
        <h1 class="text-2xl font-semibold mb-4">
            Detail Pesanan
        </h1>

        <div class="border rounded-lg p-4 bg-white shadow">
            <div class="mb-4">
                <p>
                    <strong>Tanggal:</strong> {{ $pesanan->tanggal_pesanan }}
                </p>

                <p>
                    <strong>Status:</strong>
                    <span class="{{ $pesanan->status == 'sudah bayar' ? 'text-green-500' : 'text-red-500' }}">
                        {{ $pesanan->status }}
                    </span>
                </p>

                <p>
                    <Strong>Total Harga:</Strong>
                    Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}
                </p>
            </div>

            <div>
                <h2 class="text-lg font-semibold">
                    Detail Produk:
                </h2>

                <ul class="mt-2 list-disc list-inside">
                    @foreach ($pesanan->detail_pesanans as $detail)
                        <li>
                            {{ $detail->produk->nama_produk }} - {{ $detail->jumlah }} x Rp{{ number_format($detail->produk->harga, 0, ',', '.') }}
                            (Subtotal: Rp{{ number_format($detail->subtotal, 0, ',', '.') }})
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('pesanan.index' )}}" class="text-blue-500 hover:underline">
                Kembali ke Daftar Pesanan
            </a>
        </div>
    </div>
</x-layout-pelanggan>
