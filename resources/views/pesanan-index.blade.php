<x-layout-pelanggan>
    <div class="kontainer-pesanan mx-auto py-6">
        <h1 class = "text-2xl font-semibold mb-4">
            Daftar Pesanan
        </h1>

        @forelse ($pesanans as $pesanan)
            <div class="border rounded-lg mb-4 p-4 bg-white shadow">
                <div class="flex justify-between items-center">
                    <div>
                        <div class="flex justify-between items-center">
                            <h2 class="text-lg font-bold mr-7">
                                Pesanan
                            </h2>

                            <p class="text-sm text-gray-500">
                                Tanggal: {{ \Carbon\Carbon::parse($pesanan->tanggal_pesanan)->format('d M Y') }}
                            </p>
                        </div>

                        <div class="flex space-x-5 my-4">
                            <div class="kontainer-gambar-pesanan">
                                @if ($pesanan->detail_pesanans->isNotEmpty() && $pesanan->detail_pesanans->first()->produk)
                                    <img src="{{ asset('images/'. $pesanan->detail_pesanans->first()->produk->gambar_produk) }}" alt="{{ $pesanan->detail_pesanans->first()->produk->nama_produk }}">
                                @else
                                    <p class="text-gray-500">
                                        Tidak ada gambar produk.
                                    </p>
                                @endif
                            </div>

                            <div>
                                <div>
                                    @if($pesanan->detail_pesanans->isNotEmpty() && $pesanan->detail_pesanans->first()->produk)
                                        <p class="text-sm font-bold text-gray-900">
                                            {{ $pesanan->detail_pesanans->first()->produk->nama_produk }}
                                        </p>
                                    @else
                                        <p class="text-sm font-bold text-gray-900">
                                            Tidak ada produk.
                                        </p>
                                    @endif
                                </div>

                            </div>
                        </div>


                        <p class="text-sm text-gray-500">Status:
                            <span class="{{ $pesanan->status == 'sudah bayar' ? 'text-green-500' : 'text-red-500' }}">
                                {{ $pesanan->status }}
                            </span>
                        </p>
                    </div>

                    <div>
                        <p>
                            Total Harga: <strong>Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}</strong>
                        </p>

                        <div>
                            <a href="{{ route('pesanan.show', $pesanan->id_pesanan) }}">
                                Tampilkan Detail Transaksi
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-500">
                Belum ada transaksi.
            </p>
        @endforelse
    </div>
</x-layout-pelanggan>
