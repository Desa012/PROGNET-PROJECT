<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Diskon</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

  <!-- Navbar -->
  <nav class="navbar bg-gray-800 shadow-lg">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <img class="h-8 w-8" src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
          </div>
          <div class="hidden md:block">
            <div class="ml-10 flex items-baseline space-x-4">
              <a href="dashboard-penjual" class="rounded-md {{ request()->is('dashboard-penjual')?'bg-gray-900 text-white':'text-gray-300 hover:bg-gray-700 hover:text-white' }}">Dashboard</a>
              <a href="diskons" class="rounded-md {{ request()->is('diskons')?'bg-gray-900 text-white':'text-gray-300 hover:bg-gray-700 hover:text-white' }}">Kelola Diskon</a>
              <a href="produks" class="rounded-md {{ request()->is('produks')?'bg-gray-900 text-white':'text-gray-300 hover:bg-gray-700 hover:text-white' }}">Kelola Produk</a>
              <a href="" class="rounded-md {{ request()->is('')?'bg-gray-900 text-white':'text-gray-300 hover:bg-gray-700 hover:text-white' }}">Kelola Pesanan</a>
            </div>
          </div>
        </div>
        <div class="hidden md:block">
          <div class="ml-4 flex items-center md:ml-6">
            <div class="relative ml-3">
              @if(Auth::check() && Auth::user()->role === 'penjual')
              <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="rounded-md text-gray-300 hover:bg-gray-700 hover:text-white">Logout</button>
              </form>
              @else
              <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Login</a>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
    <div class="container mx-auto py-10">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg mx-auto">
            <h2 class="text-center text-2xl font-semibold mb-5">Edit Diskon</h2>
            <form method="POST" action="{{ route('diskons.update', $diskon['id_diskon']) }}">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="nama_diskon" class="block text-sm font-medium text-gray-700">Nama Diskon</label>
                    <input type="text" name="nama_diskon" id="nama_diskon" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('nama_diskon', $diskon['nama_diskon']) }}" required>
                </div>
                <div class="mb-4">
                    <label for="persentase_diskon" class="block text-sm font-medium text-gray-700">Persentase Diskon</label>
                    <input type="number" name="persentase_diskon" id="persentase_diskon" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('persentase_diskon', $diskon['persentase_diskon']) }}" required>
                </div>
                <div class="mb-4">
                    <label for="kategori_produk" class="block text-sm font-medium text-gray-700">Pilih Berdasarkan Kategori</label>
                    <select name="kategori_produk" id="kategori_produk" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategori as $kat)
                            <option value="{{ $kat->id_kategori }}">{{ $kat->id_kategori == old('kategori_produk', $diskon['kategori_produk'] ?? '') ? 'selected' : '' }}
                                {{ $kat->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-6 grid grid-cols-3 gap-4 mt-2">
                    <label for="produk" class="block text-sm font-medium text-gray-700">Pilih Produk (Opsional)</label>
                    @foreach ($produk as $prod)
                        <div class="flex items-center">
                            <input type="checkbox" name="produk[]" value="{{ $prod->id_produk }}" id="produk-{{ $prod->id_produk }}"
                                class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                {{ in_array($prod->id_produk, $diskon_produk ?? []) ? 'checked' : '' }}
                            <label for="produk-{{ $prod->id_produk }}" class="ml-2 block text-sm text-gray-900">
                                {{ $prod->nama_produk }}
                            </label>
                        </div>
                    @endforeach
                </div>
                <div class="mb-6">
                    <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('tanggal_mulai', $diskon['tanggal_mulai']) }}" required>
                </div>
                <div class="mb-6">
                    <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('tanggal_selesai', $diskon['tanggal_selesai']) }}" required>
                </div>
                <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md shadow">
                    Simpan
                </button>
            </form>
        </div>
    </div>

  <!-- Footer -->
  <footer class="bg-gray-800 text-gray-300 py-6">
    <div class="container mx-auto text-center">
      <p>&copy; 2024 Dashboard Penjual. All rights reserved.</p>
    </div>
  </footer>

</body>

</html>
