<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="max-w-lg mx-auto mt-12 bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-center mb-8">Register Pelanggan</h2>

        @if ($errors->any())
            <div class="mb-4">
                <ul class="text-red-500">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('post-register-pelanggan') }}">
            @csrf
            <div class="mb-5">
                <label for="nama_pelanggan" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="block w-full mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div class="mb-5">
                <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="block w-full mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div class="mb-5">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="block w-full mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div class="mb-5">
                <label for="password_pelanggan" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                <input type="password" name="password_pelanggan" id="password_pelanggan" class="block w-full mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div class="mb-5">
                <label for="password_pelanggan_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Kata Sandi</label>
                <input type="password" name="password_pelanggan_confirmation" id="password_pelanggan_confirmation" class="block w-full mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300">Daftar</button>
        </form>

        <div class="flex justify-between mt-4">
            <a href="{{ route('login-pelanggan') }}" class="text-blue-600 hover:text-blue-800">Sudah punya akun? Login</a>
        </div>
    </div>
</body>
</html>
