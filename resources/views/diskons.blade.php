<x-layout-penjual>

  <!-- Main Content -->
  <div class="container mx-auto py-10">
    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-8" onclick="location.href='{{ route('diskons.create') }}'">Tambah Diskon</button>

    <!-- Diskon List -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach ($diskon as $dis)
      <div class="bg-white p-6 rounded-lg shadow-lg">
        <h4 class="text-lg font-semibold mb-2">{{ $dis->nama_diskon }}</h4>
        <p class="text-lg font-semibold mb-2">Diskon {{ $dis->persentase_diskon }}%</p>
        <p class="text-gray-500 mb-2"><strong>Tanggal Mulai:</strong> {{ $dis->tanggal_mulai }}</p>
        <p class="text-gray-500 mb-2"><strong>Tanggal Selesai:</strong> {{ $dis->tanggal_selesai }}</p>
        <div class="flex justify-between mt-4">
          <button onclick="location.href='{{ route('diskons.edit', $dis->id_diskon) }}'" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Edit</button>
          <form action="{{ route('diskons.destroy', $dis->id_diskon) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Hapus</button>
          </form>
        </div>
      </div>
      @endforeach

    </div>
  </div>

</x-layout-penjual>