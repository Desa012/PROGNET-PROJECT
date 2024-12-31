<x-layout-pelanggan>

    <h3>Kategori Produk</h3>

    <div class="kategori-carousel">
        @foreach ($kategoriProduks as $kategori)
        <div class="kategori-item mt-7">
            <img src="{{ asset('images/' . $kategori->gambar_kategori) }}" class="mx-auto object-cover rounded-full" alt="{{ $kategori->nama_kategori }}">
            <div class="mt-2 mb-4 text-sm font-medium">
                {{ $kategori->nama_kategori }}
            </div>
        </div>
        @endforeach
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.kategori-carousel').slick({
                slidesToShow: 5,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                dots: true,
                arrows: true,
                responsive: [{
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        }
                    }
                ]
            });
        });
    </script>

    <div class="container">
        {{-- Menampilkan produk berdasarkan kategori --}}
        @foreach($kategoriProduks as $kategori)
        <div class="kategori-header flex justify between items-center border-gray-100 px-4 py-2 rounded-md shadow">
            <h3 class="font-semibold text-black-800">{{ $kategori->nama_kategori }}</h3> <!-- Nama kategori -->
            <a href="#" class="text-sm text-black-500 hover:underline">
                Lihat selengkapnya
            </a>
        </div>

        <!-- Slider untuk produk per kategori -->
        <div class="swiper-container category-slider-{{ $kategori->id_kategori }}">
            <div class="swiper-wrapper">
                @foreach($kategori->produks as $produk)
                <div class="swiper-slide">
                    <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700" style="max-width: 200px; height: 300px;">
                        {{-- Gambar produk --}}
                        <div class="image-container">
                            <a href="#">
                                <img src="{{ asset('images/' . $produk->gambar_produk) }}" alt="{{ $produk->nama_produk }}">
                            </a>
                        </div>

                        <div class="flex flex-col h-full space-y-2">
                            {{-- Nama produk --}}
                            <a href="#" class="mx-3">
                                <h5 class="text-md font-normal tracking-tight text-gray-900 dark:text-white mt-2">{{ $produk->nama_produk }}</h5>
                            </a>

                            {{-- Menghitung diskon --}}
                            @php
                                $total_diskon = $produk->diskon->sum(function($d) use ($produk) {
                                    return $produk->harga * ($d->persentase_diskon / 100);
                                });
                                $harga_setelah_diskon = $produk->harga - $total_diskon;
                            @endphp

                            {{-- Menampilkan harga --}}
                            <div class="flex items-center justify-between mt-2 pb-2.5 mx-3">
                                @if ($total_diskon > 0)
                                    {{-- Harga setelah diskon --}}
                                    <span class="text-lg font-bold text-red-500">
                                        Rp{{ $produk->diskon ? number_format($produk->harga - ($produk->harga * $produk->diskon /100), 0, ',', '.') : number_format($produk->harga, 0, ',', '.') }}
                                    </span>

                                    {{-- Harga sebelum diskon --}}
                                    <span class="text-sm text-gray-500 line-through ml-2">
                                        Rp{{ number_format($produk->harga, 0, ',', '.') }}
                                    </span>
                                @else
                                    {{-- Harga tanpa diskon --}}
                                    <span class="text-lg font-bold text-gray-900">
                                        Rp{{ number_format($produk->harga, 0, ',', '.') }}
                                    </span>
                                @endif

                                {{-- <form action="{{ route('keranjangs.store') }}" method="POST" class="text-center">
                                    @csrf
                                    <input type="hidden" name="id_produk" value="{{ $produk->id_produk }}">
                                    <input type="hidden" name="jumlah" value="1"> <!-- Default quantity can be set to 1 -->
                                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-1 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        Tambah ke Keranjang
                                    </button>
                                </form> --}}
                            </div>

                            <div class="mx-3">
                                <h5 class="text-xs font-normal text-gray-600">
                                    {{$produk->alamat_penjual->get('kota', 'kota tidak ditemukan.')}}
                                </h5>
                            </div>

                            <div class="flex items-center pt-1 mx-3">
                                <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                    <svg class="w-3 h-3 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                    </svg>
                                </div>
                                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ms-1">4.0</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Navigasi -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>

        <hr> <!-- Garis pemisah antar kategori -->
        @endforeach
    </div>

    <!-- Inisialisasi Swiper -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @foreach($kategoriProduks as $kategori)
            new Swiper('.category-slider-{{ $kategori->id_kategori }}', {
                slidesPerView: 5, // Jumlah produk per view
                spaceBetween: 10, // Jarak antar produk
                loop: false, // Looping slider
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
            });
            @endforeach
        });
    </script>

</x-layout-pelanggan>
