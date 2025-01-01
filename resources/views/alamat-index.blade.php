<x-layout-pelanggan>
<div class="container">
    <h1>Daftar Alamat</h1>
    <a href="{{ route('alamat.create') }}" class="btn btn-primary">Tambah Alamat</a>
    
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Alamat</th>
                <th>Kecamatan</th>
                <th>Kota</th>
                <th>Provinsi</th>
                <th>Kode Pos</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($alamats as $alamat)
            <tr>
                <td>{{ $alamat->alamat }}</td>
                <td>{{ $alamat->kecamatan }}</td>
                <td>{{ $alamat->kota }}</td>
                <td>{{ $alamat->provinsi }}</td>
                <td>{{ $alamat->kode_pos }}</td>
                <td>
                <a href="{{ route('alamat.edit', $alamat->id_alamat) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('alamat.destroy', $alamat->id_alamat) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</x-layout-pelanggan>
