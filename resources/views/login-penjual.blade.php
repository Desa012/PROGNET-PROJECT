<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Penjual</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <div class="max-w-sm mx-auto mt-10">
        <h2 class="text-2xl font-semibold text-center mb-6">Login Sebagai Penjual</h2>

        <!-- Form Login -->
        <form method="POST" action="{{ route('post-login') }}" class="bg-white p-6 rounded-lg shadow-lg">
            @csrf

            <!-- Email Field -->
            <div class="mb-5">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email Toko</label>
                <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="email@gmail.com" value="{{ old('email') }}" required />
            </div>

            <!-- Password Field -->
            <div class="mb-5">
                <label for="password_toko" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                <input type="password" id="password_toko" name="password_toko" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
            </div>

            <!-- Error Display -->
            @error('email')
            <div class="mb-6 text-red-600 text-sm">
                <strong>{{ $message }}</strong>
            </div>
            @enderror

            <!-- Submit Button -->
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login</button>
        </form>
        <div class="mt-6 text-center">
            <p class="text-sm">Belum punya akun? <a href="{{ route('register-penjual') }}" class="text-blue-600 hover:underline">Daftar di sini</a></p>
        </div>
    </div>

</body>

</html>
