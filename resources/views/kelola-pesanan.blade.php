<x-layout-penjual>

    <div class="container mx-auto px-6 py-6">
        <h1 class="text-2xl font-bold mb-6 text-center">Daftar Pesanan di Toko Anda</h1>

        <div class="table-container">
            <table class="table-auto w-full bg-white shadow-lg rounded-lg">
                <thead class="bg-gradient-to-b from-blue-800 to-blue-900 border-gray-200 text-white">
                    <tr>
                        <th class="px-4 py-2">No.</th>
                        <th class="px-4 py-2">Nama Pelanggan</th>
                        <th class="px-4 py-2">Alamat</th>
                        <th class="px-4 py-2">Tanggal Pesanan</th>
                        <th class="px-4 py-2">Nama Produk</th>
                        <th class="px-4 py-2">Total Harga</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Status Pengiriman</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pesanans as $index => $pesanan)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2 text-center">{{ $index + 1 }}</td>
                        <td class="px-4 py-2">{{ optional($pesanan->users)->nama ?? 'Data pelanggan tidak tersedia' }}</td>
                        <td class="px-4 py-2">{{ $pesanan->alamats->alamat }}</td>
                        <td class="px-4 py-2">{{ $pesanan->tanggal_pesanan->format('d-m-Y') }}</td>
                        @foreach ($pesanan->detail_pesanans as $detail)
                        <td class="px-4 py-2">{{ $detail->produk->nama_produk }}</td>
                        @endforeach
                        <td class="px-4 py-2 currency">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                        <td class="px-4 py-2">{{ $pesanan->status }}</td>
                        <td class="px-4 py-2 text-center">
                            <form action="{{ route('pengiriman.update', $pesanan->id_pesanan) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="status_pengiriman" class="border p-1 rounded w-full">
                                    <option value="dikemas" {{ optional($pesanan->pengiriman)->status_pengiriman == 'dikemas' ? 'selected' : '' }}>Dikemas</option>
                                    <option value="dikirim" {{ optional($pesanan->pengiriman)->status_pengiriman == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                                </select>
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-2 w-full">Update</button>
                            </form>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 py-2 text-center">Belum ada pesanan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</x-layout-penjual>