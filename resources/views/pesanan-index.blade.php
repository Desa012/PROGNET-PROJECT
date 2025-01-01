<x-layout-pelanggan>
    <div class="kontainer-pesanan mx-auto py-6">
        <h1 class = "text-2xl font-semibold mb-4">
            Daftar Pesanan
        </h1>

        @forelse ($pesanans as $pesanan)
            <div class="border rounded-lg mb-4 p-4 bg-white shadow">
                <div class="flex justify-between items-center">
                    <div>
                        <div class="flex items-center">
                            <h2 class="text-lg font-bold mr-8">
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

                    <div class="pr-6">
                        <p class="text-sm" style="text-align: right;">
                            Total Harga:
                        </p>

                        <p class="text-2xl" style="text-align: right; margin-bottom: 5%;">
                            <strong>Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}</strong>
                        </p>

                        @if($pesanan->pengiriman->status_pengiriman !== 'selesai')
                            <div style="margin-top: 25%; display: flex; gap: 20px; align-items: center">
                                <a href="{{ route('pesanan.show', $pesanan->id_pesanan) }}">
                                    Tampilkan Detail Transaksi
                                </a>

                                <form action="{{ route('pesanan.selesaikan', $pesanan->id_pesanan) }}" method ="POST" onsubmit="return confirm('Apakah Anda yakin ingin menyelesaikan pesanan ini?')">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="text-sm bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 text-white py-2 px-4 rounded">
                                        Selesaikan Pesanan
                                    </button>
                                </form>
                            </div>
                        @else
                            <div style="margin-top: 25%; display: flex; gap: 20px; align-items: center">
                                <a href="{{ route('pesanan.show', $pesanan->id_pesanan) }}">
                                    Tampilkan Detail Transaksi
                                </a>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-500">
                Belum ada transaksi.
            </p>
        @endforelse
    </div>

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                // timer: 3000, // Durasi pop-up dalam milidetik
                showConfirmButton: true,
                confirmButtonText: 'OK',
                // timerProgressBar: true,
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

</x-layout-pelanggan>
