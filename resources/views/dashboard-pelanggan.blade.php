<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pelanggan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-gray-800 fixed w-full z-10 top-0 shadow">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <span class="text-white font-bold text-lg">Toko Saya</span>
                </div>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-300 hover:text-white">Dashboard</a>
                    <a href="#" class="text-gray-300 hover:text-white">Pesanan</a>
                    <a href="#" class="text-gray-300 hover:text-white">Profil</a>
                    <a href="#" class="text-gray-300 hover:text-white">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar + Main Content -->
    <div class="flex pt-20">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow h-screen">
            <div class="p-4">
                <h2 class="text-lg font-bold text-gray-700">Menu Pelanggan</h2>
                <ul class="mt-4 space-y-2">
                    <li>
                        <a href="#" class="block p-2 text-gray-700 rounded hover:bg-gray-100">Dashboard</a>
                    </li>
                    <li>
                        <a href="#" class="block p-2 text-gray-700 rounded hover:bg-gray-100">Pesanan Saya</a>
                    </li>
                    <li>
                        <a href="#" class="block p-2 text-gray-700 rounded hover:bg-gray-100">Riwayat Belanja</a>
                    </li>
                    <li>
                        <a href="#" class="block p-2 text-gray-700 rounded hover:bg-gray-100">Notifikasi</a>
                    </li>
                    <li>
                        <a href="#" class="block p-2 text-gray-700 rounded hover:bg-gray-100">Pengaturan Akun</a>
                    </li>
                </ul>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 bg-gray-50">
            <h1 class="text-2xl font-bold text-gray-800">Selamat Datang, Pelanggan!</h1>
            <p class="mt-2 text-gray-600">Berikut adalah ringkasan aktivitas Anda:</p>

            <!-- Ringkasan Aktivitas -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                <div class="p-4 bg-white shadow rounded">
                    <h2 class="text-xl font-bold text-gray-800">Pesanan Aktif</h2>
                    <p class="mt-2 text-gray-600">3 Pesanan sedang diproses</p>
                </div>
                <div class="p-4 bg-white shadow rounded">
                    <h2 class="text-xl font-bold text-gray-800">Saldo Wallet</h2>
                    <p class="mt-2 text-gray-600">Rp 150.000</p>
                </div>
                <div class="p-4 bg-white shadow rounded">
                    <h2 class="text-xl font-bold text-gray-800">Poin Reward</h2>
                    <p class="mt-2 text-gray-600">120 Poin</p>
                </div>
            </div>

            <!-- Pesanan Terbaru -->
            <div class="mt-8">
                <h2 class="text-lg font-bold text-gray-700">Pesanan Terbaru</h2>
                <div class="mt-4 bg-white shadow rounded">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="p-3 text-left text-gray-600">#</th>
                                <th class="p-3 text-left text-gray-600">Tanggal</th>
                                <th class="p-3 text-left text-gray-600">Total</th>
                                <th class="p-3 text-left text-gray-600">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="p-3 border-b">1</td>
                                <td class="p-3 border-b">2024-12-10</td>
                                <td class="p-3 border-b">Rp 250.000</td>
                                <td class="p-3 border-b text-green-600">Selesai</td>
                            </tr>
                            <tr>
                                <td class="p-3 border-b">2</td>
                                <td class="p-3 border-b">2024-12-09</td>
                                <td class="p-3 border-b">Rp 120.000</td>
                                <td class="p-3 border-b text-yellow-600">Diproses</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
