<x-layout-penjual>

  <!-- Main Content -->
  <div class="container mx-auto py-10">
    <!-- Add Product Button -->
    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="location.href='{{ route('produks.create') }}'">Tambah Produk</button>

    <!-- Produk List -->
    <div class="grid grid-cols-5 gap-6 mt-6">
      @foreach ($produk as $prod)
      <div class="bg-white p-10 rounded-lg shadow-md">
        <h4 class="text-xl font-semibold text-gray-800">{{ $prod->nama_produk }}</h4>
        <img src="{{ asset('images/' . $prod->gambar_produk) }}" alt="Gambar Produk" class="w-full h-50 object-cover rounded-md mt-4">
        <p class="text-gray-600">Kategori: {{ $prod->Kategori_Produk->nama_kategori ?? 'Tidak ada kategori' }}</p>
        <p class="text-gray-600">Harga: Rp {{ number_format($prod->harga, 0, ',', '.') }}</p>

        <!-- Diskon -->
        @if ($prod->diskon->isNotEmpty())
        <p class="text-gray-600">Diskon:</p>
        <ul class="text-gray-600">
          @foreach ($prod->diskon as $diskon)
          <li>{{ $diskon->nama_diskon }} ({{ $diskon->persentase_diskon }}%)</li>
          @endforeach
        </ul>
        @else
        <p class="text-gray-600">Diskon: Tidak ada diskon</p>
        @endif

        <!-- Harga Setelah Diskon -->
        @php
        $totalDiskon = $prod->diskon->sum(function($d) use ($prod) {
        return $prod->harga * ($d->persentase_diskon / 100);
        });
        $hargaSetelahDiskon = $prod->harga - $totalDiskon;
        @endphp
        <p class="text-sm text-gray-600">
          <strong>Harga Setelah Diskon:</strong> Rp {{ number_format($hargaSetelahDiskon, 0, ',', '.') }}
        </p>
        <p class="text-gray-600">Stok: {{ $prod->stok }}</p>
        <div class="flex justify-between items-center mt-4">
          <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded" onclick="location.href='{{ route('produks.edit', $prod->id_produk) }}'">Edit</button>
          <form action="{{ route('produks.destroy', $prod->id_produk) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">Delete</button>
          </form>
        </div>
      </div>
      @endforeach
    </div>
  </div>

</x-layout-penjual>