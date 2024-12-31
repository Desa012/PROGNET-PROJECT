<x-layout-pelanggan>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Pesanan</th>
                <th>Status Pengiriman</th>
                <th>No. Resi</th>
                <th>Tanggal Diterima</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pesanans as $pesanan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $pesanan->tanggal_pesanan }}</td>
                <td>{{ $pesanan->pengiriman->status_pengiriman ?? 'Belum Diatur' }}</td>
                <td>{{ $pesanan->pengiriman->no_resi ?? '-' }}</td>
                <td>{{ $pesanan->pengiriman->tanggal_diterima ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</x-layout-pelanggan>