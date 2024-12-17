<x-layout-pelanggan>
    <h1>Keranjang Belanja</h1>
    <div class="cart-items">
        @foreach($keranjangs as $item)
        <div class="cart-item">
            <img src="{{ asset('images/' . $item->produks->gambar_produk) }}" alt="{{ $item->produks->nama_produk }}" />
            <div>{{ $item->produks->nama_produk }}</div>
            <div>Jumlah: {{ $item->jumlah }}</div>
            <div>Rp {{ number_format($item->produks->harga, 0, ',', '.') }}</div>

            {{-- <form action="{{ route('keranjangs.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="number" name="jumlah" value="{{ $item->jumlah }}" min="1">
                <button type="submit">Update Jumlah</button>
            </form> --}}


            <form action="{{ route('keranjangs.destroy', $item->id_produk) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Hapus</button>
            </form>
        </div>
        @endforeach
    </div>
</x-layout-pelanggan>
