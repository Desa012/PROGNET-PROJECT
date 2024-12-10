<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .main-content {
            padding-top: 4rem; /* Adjust for fixed navbar height */
        }

        .card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 2rem;
        }

        .card h5 {
            font-size: 24px;
            margin: 10px 0;
            color: #333;
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

        .button-group .delete-btn {
            background-color: #dc3545;
            color: white;
        }

        .button-group .delete-btn:hover {
            background-color: #c82333;
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
                        <a href="diskons" class="rounded-md text-gray-300 hover:bg-gray-700 hover:text-white">Diskon</a>
                        <a href="kategori_produks" class="rounded-md text-gray-300 hover:bg-gray-700 hover:text-white">Kategori Produk</a>
                        <a href="produks" class="rounded-md {{ request()->is('produks')?'bg-gray-900 text-white':'text-gray-300 hover:bg-gray-700 hover:text-white' }}">Produk</a>
                    </div>
                </div>
            </div>

            <!-- Profile and Logout -->
            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">
                    <div class="relative ml-3">
                        <div>
                            <button type="button" @click="isOpen = !isOpen" class="flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none">
                                <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e" alt="User profile">
                            </button>
                        </div>
                        <div x-show="isOpen" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg">
                            <a href="profile" class="block px-4 py-2 text-sm text-gray-700">Your Profile</a>
                            <a href="settings" class="block px-4 py-2 text-sm text-gray-700">Settings</a>
                            @if(Auth::guard('penjual')->check())
                                <form action="{{ route('logout-penjual') }}" method="POST">
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
<div class="main-content container mx-auto px-4">
    <!-- Add Category Button -->
    <button class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700" onclick="location.href='{{ route('kategori_produks.create') }}'">
        Tambah Kategori Produk
    </button>

    <!-- Category List -->
    @foreach ($kategori as $kat)
    <div class="card">
        <label>Nama Kategori</label>
        <h5>{{ $kat->nama_kategori }}</h5>
        <div class="button-group">
            <button onclick="location.href='{{ route('kategori_produks.edit', $kat->id_kategori) }}'">Edit</button>
            <form action="{{ route('kategori_produks.destroy', $kat->id_kategori) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');">
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
