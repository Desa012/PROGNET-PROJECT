<x-layout-pelanggan>
    <div class="kontainer py-5">
        <!-- Daftar Alamat dengan font Poppins -->
        <h1 class="mb-4 text-center text-primary" style="font-family: 'Poppins', sans-serif; font-weight: 600;">
            Daftar Alamat
        </h1>
        <div class="text-end mb-3">
            <form action="{{ route('alamat.create') }}" method="GET">
                <button type="submit" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                    <i class="bi bi-plus-circle fs-4 me-2"></i> Tambah Alamat
                </button>
            </form>
        </div>
        <div class="row">
            @forelse ($alamats as $alamat)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div
                        class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md hover:shadow-lg dark:bg-gray-800 dark:border-gray-700">
                        <a href="{{ route('alamat.edit', $alamat->id_alamat) }}">
                            <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $alamat->alamat }}</h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                            <strong>Kecamatan:</strong> {{ $alamat->kecamatan }} <br>
                            <strong>Kota:</strong> {{ $alamat->kota }} <br>
                            <strong>Provinsi:</strong> {{ $alamat->provinsi }} <br>
                            <strong>Kode Pos:</strong> {{ $alamat->kode_pos }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('alamat.edit', $alamat->id_alamat) }}"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-yellow-600 rounded-lg hover:bg-yellow-700 focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:bg-yellow-500 dark:hover:bg-yellow-600 dark:focus:ring-yellow-700">
                                <i class="bi bi-pencil-square fs-5"></i> Edit
                            </a>
                            <form action="{{ route('alamat.destroy', $alamat->id_alamat) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-700">
                                    <i class="bi bi-trash fs-5"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center border-0 shadow-sm">
                        <i class="bi bi-exclamation-circle-fill"></i> Anda belum menambahkan alamat. Klik tombol "Tambah
                        Alamat" untuk mulai menambahkan!
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-layout-pelanggan>
