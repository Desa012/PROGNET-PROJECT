<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .navbar {
            position: relative;
            z-index: 10; 
        }

        .main-content {
            padding-top: 4rem; /* Menyesuaikan dengan tinggi navbar */
        }

        .card {
            display: flex;
            flex-direction: column;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 2rem;
            transition: background-color 0.3s ease;
        }

        .card:hover {
            background-color: #f8f9fa;
        }

        .card h5 {
            font-size: 24px;
            margin: 10px 0;
            color: #333;
        }

        .card p {
            font-size: 16px;
            color: #666;
        }

        .card label {
            font-size: 14px;
            font-weight: bold;
            color: #555;
        }

        .button-group {
            display: flex;
            gap: 10px;
        }

        .button-group button {
            padding: 8px 16px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button-group button:hover {
            background-color: #007bff;
            color: white;
        }

        .button-group button.delete-btn {
            background-color: #dc3545;
            color: white;
        }

        .button-group button.delete-btn:hover {
            background-color: #c82333;
        }

        @media (max-width: 768px) {
            .card {
                flex-direction: column;
            }

            .button-group {
                flex-direction: column;
            }
        }
    </style>
</head>
<body class="bg-gray-100">

  <!-- Navbar -->
  <nav class="navbar bg-gray-800" x-data="{ isOpen: false }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <img class="h-8 w-8" src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
          </div>
          <div class="hidden md:block">
            <div class="ml-10 flex items-baseline space-x-4">
              <a href="dashboard-penjual" class="rounded-md text-gray-300 hover:bg-gray-700 hover:text-white">Home</a>
              <a href="produk" class="rounded-md text-gray-300 hover:bg-gray-700 hover:text-white">Produk</a>
              <a href="kategori_produks" class="rounded-md text-gray-300 hover:bg-gray-700 hover:text-white">Kategori Produk</a>
            </div>
          </div>
        </div>
        <div class="hidden md:block">
          <div class="ml-4 flex items-center md:ml-6">
            <div class="relative ml-3">
              <button type="button" @click="isOpen = !isOpen" class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="User profile">
              </button>
              <div x-show="isOpen" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg">
                <a href="profile" class="block px-4 py-2 text-sm text-gray-700">Your Profile</a>
                <a href="settings" class="block px-4 py-2 text-sm text-gray-700">Settings</a>
                @if(Auth::guard('penjual')->check())
                  <form action="{{ route('logout-penjual') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="block px-4 py-2 text-sm text-gray-700">Logout</button>
                  </form>
                @else
                  <a href="{{ route('login-penjual') }}" class="block px-4 py-2 text-sm text-gray-700">Login</a>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="main-content container mx-auto">
    <!-- Add Product Button -->
    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-5" onclick="location.href='{{ route('produks.create') }}'">Tambah Produk</button>

    <!-- Produk List -->
    @foreach ($produk as $prod)
      <div class="card">
        <label>Nama Produk</label>
        <h5>{{ $prod->nama_produk }}</h5>
        <label>Kategori</label>
        <p>{{ $prod->kategori }}</p>
        <label>Diskon</label>
        <p>{{ $prod->diskon ? $prod->diskon->persentase_diskon . '%' : 'Tidak ada diskon' }}</p>
        <label>Harga</label>
        <p>Rp {{ number_format($prod->harga, 3, ',', '.') }}</p>
        <label>Harga Setelah Diskon</label>
        <p>Rp {{ number_format(($prod->harga - ($prod->harga * ($prod->diskon->persentase_diskon / 100))), 3, ',', ',') }}</p>
        <label>Stok</label>
        <p>{{ $prod->stok }}</p>
        <label>Gambar</label>
        <img src="{{ asset('storage/' . $prod->gambar_produk) }}" alt="Gambar Produk" class="w-32 h-32 object-cover mb-2" />
        <div class="button-group">
          <button onclick="location.href='{{ route('produks.edit', $prod->id_produk) }}'">Edit</button>
          <form action="{{ route('produks.destroy', $prod->id_produk) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="delete-btn">Delete</button>
          </form>
        </div>
      </div>
    @endforeach
  </div>

</body>
</html>
