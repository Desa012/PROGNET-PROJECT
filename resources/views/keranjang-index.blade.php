<x-layout-pelanggan>
   <meta name="csrf-token" content="{{ csrf_token() }}">
    <h1>Keranjang Belanja</h1>
    <div class="cart-items">
        @foreach($keranjangs as $item)
        <div class="cart-item">
            <img src="{{ asset('images/' . $item->produks->gambar_produk) }}" alt="{{ $item->produks->nama_produk }}" />
            <div>{{ $item->produks->nama_produk }}</div>
            <div>Rp {{ number_format($item->produks->harga, 0, ',', '.') }}</div>

            <div class="jumlah">
                <!-- Tombol untuk mengurangi jumlah -->
                <button class="minus" style="font-size: 18px; background-color: #007bff; color: white; border: none; padding: 5px 10px; cursor: pointer;" data-id="{{ $item->id_keranjang }}" data-action="minus" data-id-produk="{{ $item->id_produk }}">-</button>
                <input type="number" value="{{ $item->jumlah }}" min="1" id="jumlah-{{ $item->id_keranjang }}" class="quantity">
                <!-- Tombol untuk menambah jumlah -->
                <button class="plus" style="font-size: 18px; background-color: #007bff; color: white; border: none; padding: 5px 10px; cursor: pointer;" data-id="{{ $item->id_keranjang }}" data-action="plus" data-id-produk="{{ $item->id_produk }}">+</button>
            </div>

            <p>Total: Rp <span id="total-{{ $item->id_keranjang }}">{{ number_format($item->produks->harga * $item->jumlah, 0, ',', '.') }}</span></p>

            <form action="{{ route('keranjangs.destroy', $item->id_keranjang) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Hapus</button>
            </form>
        </div>
        @endforeach
    </div>

    <div class="total-summary">
        <h3>Total Harga Keranjang</h3>
        <p id="total-all">Rp {{number_format($keranjangs->sum(function($item) { return $item->produks->harga * $item->jumlah; }), 0, ',', '.') }} </p>
        {{-- <a href="{{ route('checkout.index') }}" class="btn-beli">Beli</a> --}}
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Ketika tombol tambah jumlah (+) atau kurangi jumlah (-) ditekan
        $(document).on('click', '.plus, .minus', function() {
            var action = $(this).data('action');
            var keranjang_id = $(this).data('id');
            var produk_id =$(this).data('id-produk');
            var jumlah_input = $('#jumlah-' + keranjang_id);
            var jumlah = parseInt(jumlah_input.val());

            if (action == 'plus') {
                jumlah++;
            } else if (action == 'minus' && jumlah > 1) {
                jumlah--;
            }

            // Request Ajax
            $.ajax({
                url: '{{ route('keranjangs.update', '') }}/' + keranjang_id,
                method: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    jumlah: jumlah,
                    id_produk: produk_id // pastikan id_produk dikirim dengan benar
                },
                success: function(response) {
                    // Update jumlah input dan total harga setiap item
                    jumlah_input.val(jumlah);
                    $('#total-' + keranjang_id).text(response.total_harga);

                    // Update total harga keseluruhan
                    // var totalAll = 0;
                    // $('.cart-item').each(function() {
                    //     var item_total = parseInt($(this).find('span[id^="total-"]').text().replace('Rp ', '').replace(',', ''));
                    //     totalAll += item_total;
                    // });

                    $('#total-all').text('Rp ' + response.total_harga_keranjang);
                },
                error: function(err) {
                    console.log("Error:", err);
                }
            });
        });

    </script>

</x-layout-pelanggan>
