<x-layout-penjual>
    <div class="container mx-auto px-6 py-6">
        <h1 class="text-2xl font-bold mb-6 text-center">Riwayat Pesanan di Toko Anda</h1>

        <!-- Tabel Pesanan Selesai -->
        <h2 class="text-xl font-bold mt-6 mb-4">Pesanan Selesai</h2>
        <div class="table-container">
            <table class="table-auto w-full bg-white shadow-lg rounded-lg">
                <thead class="bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 text-white">
                    <tr>
                        <th class="px-4 py-2">No.</th>
                        <th class="px-4 py-2">Nama Pelanggan</th>
                        <th class="px-4 py-2">Alamat</th>
                        <th class="px-4 py-2">Tanggal Pesanan</th>
                        <th class="px-4 py-2">Nama Produk</th>
                        <th class="px-4 py-2">Total Harga</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Aksi</th> <!-- Kolom untuk Tombol -->
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pesananSelesai as $index => $pesanan)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2 text-center">{{ $index + 1 }}</td>
                        <td class="px-4 py-2">{{ optional($pesanan->users)->nama ?? 'Data pelanggan tidak tersedia' }}</td>
                        <td class="px-4 py-2">{{ $pesanan->alamats->alamat }}</td>
                        <td class="px-4 py-2">{{ $pesanan->tanggal_pesanan }}</td>
                        @foreach ($pesanan->detail_pesanans->take(1) as $detail)
                        <td class="px-4 py-2">{{ $detail->produk->nama_produk }}</td>
                        @endforeach
                        <td class="px-4 py-2 currency">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                        <td class="px-4 py-2">{{ $pesanan->status }}</td>
                        <td class="px-4 py-2 text-center">
                            <a href="{{ route('detail.riwayat', $pesanan->id_pesanan) }}"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">
                                Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-4 py-2 text-center">Belum ada pesanan selesai.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layout-penjual>