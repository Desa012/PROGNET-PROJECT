<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diskon</title>
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
              <a href="dashboard-penjual" class="rounded-md text-gray-300 hover:bg-gray-700 hover:text-white">Dashboard</a>
              <a href="diskons" class="rounded-md bg-gray-900 text-white">Kelola Diskon</a>
              <a href="produks" class="rounded-md text-gray-300 hover:bg-gray-700 hover:text-white">Kelola Produk</a>
            </div>
          </div>
        </div>
        <div class="hidden md:block">
          <div class="ml-4 flex items-center md:ml-6">
            <div class="relative ml-3">
                  @if(Auth::guard('penjual')->check())
                    <form action="{{ route('logout-penjual') }}" method="POST" class="inline">
                      @csrf
                      <button type="submit" class="rounded-md text-gray-300 hover:bg-gray-700 hover:text-white">Logout</button>
                    </form>
                  @else
                    <a href="{{ route('login-penjual') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Login</a>
                  @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="container mx-auto py-10">
    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-8" onclick="location.href='{{ route('diskons.create') }}'">Tambah Diskon</button>

    <!-- Diskon List -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach ($diskon as $dis)
      <!-- Diskon Card -->
      <div class="bg-white p-6 rounded-lg shadow-lg">
        <h4 class="text-lg font-semibold mb-2">Diskon {{ $dis['persentase_diskon'] }}%</h4>
        <p class="text-gray-500 mb-2"><strong>Tanggal Mulai:</strong> {{ $dis['tanggal_mulai'] }}</p>
        <p class="text-gray-500 mb-2"><strong>Tanggal Selesai:</strong> {{ $dis['tanggal_selesai'] }}</p>
        <div class="flex justify-between mt-4">
          <button onclick="location.href='{{ route('diskons.edit', $dis['id_diskon']) }}'" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Edit</button>
          <form action="{{ route('diskons.destroy', $dis['id_diskon']) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Hapus</button>
          </form>
        </div>
      </div>
      @endforeach
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
