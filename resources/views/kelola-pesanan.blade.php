<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .table-container {
            overflow-x: auto;
            margin-top: 1rem;
        }

        .form-container {
            margin-top: 2rem;
            padding: 1rem;
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
        }

        .form-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #4a4a4a;
            margin-bottom: 1rem;
        }
    </style>
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
                            <a href="dashboard-penjual" class="rounded-md {{ request()->is('diskons')?'bg-gray-900 text-white':'text-gray-300 hover:bg-gray-700 hover:text-white' }}">Dashboard</a>
                            <a href="diskons" class="rounded-md {{ request()->is('diskons')?'bg-gray-900 text-white':'text-gray-300 hover:bg-gray-700 hover:text-white' }}">Kelola Diskon</a>
                            <a href="produks" class="rounded-md {{ request()->is('produks')?'bg-gray-900 text-white':'text-gray-300 hover:bg-gray-700 hover:text-white' }}">Kelola Produk</a>
                            <a href="kelola-pesanan" class="rounded-md {{ request()->is('')?'bg-gray-900 text-white':'text-gray-300 hover:bg-gray-700 hover:text-white' }}">Kelola Pesanan</a>
                        </div>
                    </div>
                </div>

                <!-- Profile and Logout Dropdown -->
                <div class="hidden md:block">
                    <div class="ml-4 flex items-center md:ml-6">
                        <div class="relative ml-3">
                            <div>
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
        </div>
    </nav>

    <div class="container mx-auto px-6 py-6">
        <h1 class="text-2xl font-bold mb-6 text-center">Daftar Pesanan di Toko Anda</h1>

        <div class="table-container">
            <table class="table-auto w-full bg-white shadow-lg rounded-lg">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-2">No.</th>
                        <th class="px-4 py-2">Nama Pelanggan</th>
                        <th class="px-4 py-2">Alamat</th>
                        <th class="px-4 py-2">Tanggal Pesanan</th>
                        <th class="px-4 py-2">Total Harga</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Pengiriman</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pesanans as $index => $pesanan)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2 text-center">{{ $index + 1 }}</td>
                        <td class="px-4 py-2">{{ optional($pesanan->users)->nama ?? 'Data pelanggan tidak tersedia' }}</td>
                        <td class="px-4 py-2">{{ $pesanan->alamats->alamat }}</td>
                        <td class="px-4 py-2">{{ $pesanan->tanggal_pesanan->format('d-m-Y') }}</td>
                        <td class="px-4 py-2 currency">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                        <td class="px-4 py-2">{{ $pesanan->status }}</td>
                        <td class="px-4 py-2 text-center">
                            <form action="{{ route('pengiriman.update', $pesanan->id_pesanan) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="status_pengiriman" class="border p-1 rounded w-full">
                                    <option value="belum dikirim" {{ ($pesanan->pengiriman->status_pengiriman ?? '') == 'belum dikirim' ? 'selected' : '' }}>Belum Dikirim</option>
                                    <option value="dalam perjalanan" {{ ($pesanan->pengiriman->status_pengiriman ?? '') == 'dalam perjalanan' ? 'selected' : '' }}>Dalam Perjalanan</option>
                                    <option value="sudah dikirim" {{ ($pesanan->pengiriman->status_pengiriman ?? '') == 'sudah dikirim' ? 'selected' : '' }}>Sudah Dikirim</option>
                                </select>
                                <input type="date" name="tanggal_pengiriman" value="{{ $pesanan->pengiriman->tanggal_pengiriman ?? '' }}" class="border p-1 rounded w-full mt-2">
                                <input type="date" name="tanggal_diterima" value="{{ $pesanan->pengiriman->tanggal_diterima ?? '' }}" class="border p-1 rounded w-full mt-2">
                                <input type="text" name="no_resi" value="{{ $pesanan->pengiriman->no_resi ?? '' }}" placeholder="Nomor Resi" class="border p-1 rounded w-full mt-2">
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-2 w-full">Update</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 py-2 text-center">Belum ada pesanan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <footer class="bg-gray-800 text-gray-300 py-6">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Dashboard Penjual. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>