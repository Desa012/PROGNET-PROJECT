<x-layout-penjual>

    <div class="container mx-auto px-6 py-6">
        <h1 class="text-2xl font-bold mb-6 text-center">Daftar Pesanan di Toko Anda</h1>

        <div class="table-container">
            <table class="table-auto w-full bg-white shadow-lg rounded-lg">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-2">No.</th>
                        <th class="px-4 py-2">Nama Pelanggan</th>
                        <th class="px-4 py-2">Alamat</th>
                        <th class="px-4 py-2">Tanggal Pesanan</th>
                        <th class="px-4 py-2">Total Harga</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Pengiriman</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pesanans as $index => $pesanan)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2 text-center">{{ $index + 1 }}</td>
                        <td class="px-4 py-2">{{ optional($pesanan->users)->nama ?? 'Data pelanggan tidak tersedia' }}</td>
                        <td class="px-4 py-2">{{ $pesanan->alamats->alamat }}</td>
                        <td class="px-4 py-2">{{ $pesanan->tanggal_pesanan->format('d-m-Y') }}</td>
                        <td class="px-4 py-2 currency">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                        <td class="px-4 py-2">{{ $pesanan->status }}</td>
                        <td class="px-4 py-2 text-center">
                            <form action="{{ route('pengiriman.update', $pesanan->id_pesanan) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="status_pengiriman" class="border p-1 rounded w-full">
                                    <option value="belum dikirim" {{ ($pesanan->pengiriman->status_pengiriman ?? '') == 'belum dikirim' ? 'selected' : '' }}>Belum Dikirim</option>
                                    <option value="dalam perjalanan" {{ ($pesanan->pengiriman->status_pengiriman ?? '') == 'dalam perjalanan' ? 'selected' : '' }}>Dalam Perjalanan</option>
                                    <option value="sudah dikirim" {{ ($pesanan->pengiriman->status_pengiriman ?? '') == 'sudah dikirim' ? 'selected' : '' }}>Sudah Dikirim</option>
                                </select>
                                <input type="date" name="tanggal_pengiriman" value="{{ $pesanan->pengiriman->tanggal_pengiriman ?? '' }}" class="border p-1 rounded w-full mt-2">
                                <input type="date" name="tanggal_diterima" value="{{ $pesanan->pengiriman->tanggal_diterima ?? '' }}" class="border p-1 rounded w-full mt-2">
                                <input type="text" name="no_resi" value="{{ $pesanan->pengiriman->no_resi ?? '' }}" placeholder="Nomor Resi" class="border p-1 rounded w-full mt-2">
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