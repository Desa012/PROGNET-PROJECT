<x-layout-pelanggan>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="kontainer-keranjang-layout">
        <h1 style="font-size: 18px; font-weight: 600; margin-bottom: 2%;">
            Keranjang Belanja
        </h1>
        <div class="kontainer-keranjang">
            <div class="keranjang-item">
                <div class="keranjang-per-item">
                    @foreach($keranjangs as $item)
                        <div class="keranjang-detail-toko">
                            {{-- Informasi toko --}}
                            <div class="keranjang-header">
                                <div class="keranjang-nama-toko">
                                    <span>
                                        {{ $item->produks->penjual->nama_toko }}
                                    </span>
                                </div>
                            </div>

                            {{-- Detail produk --}}
                            <div class="keranjang-detail">
                                <img class="keranjang-gambar-produk" src="{{ asset('images/' . $item->produks->gambar_produk) }}" alt="{{ $item->produks->nama_produk }}" />

                                <div class="keranjang-detail-produk">
                                    {{-- Nama produk --}}
                                    <p class="keranjang-nama-produk">
                                        {{ $item->produks->nama_produk }}
                                    </p>

                                    {{-- Harga produk --}}
                                    <p class="keranjang-harga-produk">
                                        Total: Rp<span
                                            id="total-{{ $item->id_keranjang }}">{{ number_format($item->produks->harga * $item->jumlah, 0, ',', '.') }}
                                        </span>
                                    </p>

                                    {{-- <p class="keranjang-harga-produk">
                                        Rp{{ number_format($item->produks->harga, 0, ',', '.') }}
                                    </p> --}}

                                </div>

                                <div class="jumlah" style="padding-top: 7%; width: fit-content;">
                                    <!-- Tombol untuk mengurangi jumlah -->
                                    <button class="minus"
                                        style="width: 10%; font-weight: bold; font-size: 18px; background-color: #046ad6; color: white; border-radius: 4px; padding: 6px 6px; cursor: pointer"
                                        data-id="{{ $item->id_keranjang }}" data-action="minus"
                                        data-id-produk="{{ $item->id_produk }}">-</button>
                                    <input type="number" value="{{ $item->jumlah }}" min="1" id="jumlah-{{ $item->id_keranjang }}"
                                        class="quantity"
                                        style="width: 25%; height: 12%; text-align: center; font-weight: 400; font-size: 16px; background-color: #e7e7e7; color: rgb(39, 39, 39); border-radius: 4px;">
                                    <!-- Tombol untuk menambah jumlah -->
                                    <button class="plus"
                                        style="width: 10%; aspect-ratio: 1/1; font-weight: bold; font-size: 18px; background-color: #046ad6; color: white; border-radius: 4px; padding: 6px 6px; cursor: pointer;"
                                        data-id="{{ $item->id_keranjang }}" data-action="plus"
                                        data-id-produk="{{ $item->id_produk }}">+</button>
                                </div>

                                {{-- Hapus produk --}}
                                <div class="keranjang-aksi-produk">
                                    <form action="{{ route('keranjangs.destroy', $item->id_keranjang) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="keranjang-hapus-barang" type="submit">Hapus</button>
                                    </form>
                                </div>

                            </div>
                        </div>

                    @endforeach
                </div>

                <div class="keranjang-ringkasan-belanja">
                    <h3 style="font-size: 24px; font-weight: 500; margin-bottom: 3%;">
                        Total Harga Belanja
                    </h3>

                    {{-- Jumlah Harga --}}
                    <p id="total-all" style="font-size: 20px; font-weight: 400; margin-bottom: 4%;">
                        Rp{{number_format($keranjangs->sum(function ($item) {
                            return $item->produks->harga * $item->jumlah; }), 0, ',', '.')
                        }}
                    </p>

                    @if ($keranjangs->isNotEmpty())
                        <a href="{{ route('pesanan.create') }}" class="btn-beli bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                            Beli
                        </a>
                    @else
                        <p>Keranjang kosong.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Ketika tombol tambah jumlah (+) atau kurangi jumlah (-) ditekan
        $(document).on('click', '.plus, .minus', function () {
            var action = $(this).data('action');
            var keranjang_id = $(this).data('id');
            var produk_id = $(this).data('id-produk');
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
                success: function (response) {
                    // Update jumlah input dan total harga setiap item
                    jumlah_input.val(jumlah);
                    $('#total-' + keranjang_id).text(response.total_harga);

                    $('#total-all').text('Rp ' + response.total_harga_keranjang);
                },
                error: function (err) {
                    console.log("Error:", err);
                }
            });
        });
    </script>

</x-layout-pelanggan>
