<nav class="bg-gradient-to-b from-blue-800 to-blue-900 border-gray-200">
    <div class="flex items-center justify-between w-full px-8 py-4">

        {{-- logo dan nama JuLi --}}
        <a href="{{ route('dashboard-penjual') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <svg class="w-[34px] h-[34px] text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd"
                    d="M5.535 7.677c.313-.98.687-2.023.926-2.677H17.46c.253.63.646 1.64.977 2.61.166.487.312.953.416 1.347.11.42.148.675.148.779 0 .18-.032.355-.09.515-.06.161-.144.3-.243.412-.1.111-.21.192-.324.245a.809.809 0 0 1-.686 0 1.004 1.004 0 0 1-.324-.245c-.1-.112-.183-.25-.242-.412a1.473 1.473 0 0 1-.091-.515 1 1 0 1 0-2 0 1.4 1.4 0 0 1-.333.927.896.896 0 0 1-.667.323.896.896 0 0 1-.667-.323A1.401 1.401 0 0 1 13 9.736a1 1 0 1 0-2 0 1.4 1.4 0 0 1-.333.927.896.896 0 0 1-.667.323.896.896 0 0 1-.667-.323A1.4 1.4 0 0 1 9 9.74v-.008a1 1 0 0 0-2 .003v.008a1.504 1.504 0 0 1-.18.712 1.22 1.22 0 0 1-.146.209l-.007.007a1.01 1.01 0 0 1-.325.248.82.82 0 0 1-.316.08.973.973 0 0 1-.563-.256 1.224 1.224 0 0 1-.102-.103A1.518 1.518 0 0 1 5 9.724v-.006a2.543 2.543 0 0 1 .029-.207c.024-.132.06-.296.11-.49.098-.385.237-.85.395-1.344ZM4 12.112a3.521 3.521 0 0 1-1-2.376c0-.349.098-.8.202-1.208.112-.441.264-.95.428-1.46.327-1.024.715-2.104.958-2.767A1.985 1.985 0 0 1 6.456 3h11.01c.803 0 1.539.481 1.844 1.243.258.641.67 1.697 1.019 2.72a22.3 22.3 0 0 1 .457 1.487c.114.433.214.903.214 1.286 0 .412-.072.821-.214 1.207A3.288 3.288 0 0 1 20 12.16V19a2 2 0 0 1-2 2h-6a1 1 0 0 1-1-1v-4H8v4a1 1 0 0 1-1 1H6a2 2 0 0 1-2-2v-6.888ZM13 15a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-2Z"
                    clip-rule="evenodd" />
            </svg>
            <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">JuLi</span>
        </a>

        <div class="flex space-x-3">
            <div class="ml-10 mr-10 w-full">
                <a href="{{ route('diskons.index') }}" class="text-sm font-medium text-gray-900 text-white whitespace-nowrap hover:underline">Kelola Diskon</a>
            </div>
            <div class="mr-10 w-full">
                <a href="{{ route('produks.index') }}" class="text-sm font-medium text-gray-900 text-white whitespace-nowrap hover:underline">Kelola Produk</a>
            </div>
            <div class="mr-10 w-full">
                <a href="{{route('pesanan.kelola') }}" class="text-sm font-medium text-gray-900 text-white whitespace-nowrap hover:underline">Kelola Pesanan</a>
            </div>
            <div class="mr-10 w-full">
                <a href="{{ route('pesanan.riwayat') }}" class="text-sm font-medium text-gray-900 text-white whitespace-nowrap hover:underline">Riwayat Pesanan</a>
            </div>
        </div>

        
        <div class="flex items-center space-x-6 px-4" style="margin-left: 800px;">
            @if (Auth::user()->penjuals)
            <a href="{{ route('dashboard-pelanggan') }}" class="text-sm font-medium text-gray-900 text-white whitespace-nowrap hover:underline">Kembali</a>
            @endif

            {{-- Profil pelanggan --}}
            <div class="flex items-center md:order-2 space-x-4 md:space-x-2 rtl:space-x-reverse relative">

                {{-- Gambar profil --}}
                <button id="dropdownHoverButton" data-dropdown-toggle="dropdownHover" data-dropdown-trigger="hover"
                    class="flex items-center space-x-3 bg-transparent focus:outline-none">
                    <img class="w-8 h-8 rounded-full" src="https://picsum.photos/200/300" alt="user photo">

                    {{-- Nama pelanggan --}}
                    <span class="text-sm font-medium text-gray-900 text-white whitespace-nowrap">{{ Auth::user()->penjuals->nama_toko }}</span>

                </button>

                <!-- Dropdown menu -->
                <div id="dropdownHover"
                    class="absolute hidden z-50 mt-2 w-44 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">
                    <div class="px-4 py-3">
                        <span class="block text-sm text-gray-500 truncate dark:text-gray-400">{{ Auth::user()->email }}</span>
                    </div>
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownHoverButton">
                        <li>
                            @if(Auth::check() && Auth::user()->role === 'penjual')
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Keluar
                            </a>
                            <!-- Form Logout Tersembunyi -->
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
</nav>