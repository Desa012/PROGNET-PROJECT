<x-layout-pelanggan>

    <h3>Kategori Produk</h3>

    <div class="kategori-carousel mt-5">
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
                slidesToScroll: 2,
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


    <div class="kontainer">
        {{-- Menampilkan produk berdasarkan kategori --}}
        @foreach($kategoriProduks as $kategori)
        <div class="kategori-header flex text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 rounded-md shadow">
            <h3 class="font-semibold text-black-800">{{ $kategori->nama_kategori }}</h3> <!-- Nama kategori -->
            <a href="{{ route('kategori.produks', $kategori->id_kategori) }}" class="text-sm text-black-500 hover:underline">
                Lihat selengkapnya
            </a>
        </div>

        <!-- Slider untuk produk per kategori -->
        <div class="swiper-container category-slider-{{ $kategori->id_kategori }}">
            <div class="swiper-wrapper">
                @foreach($kategori->produks->take(10) as $produk)
                <div class="swiper-slide">
                    <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 pb-2.5" style="max-width: 200px; max-height: 300px;">
                        {{-- Gambar produk --}}
                        <div class="image-container">
                            <a href="{{ route('produksdetail.show', $produk->id_produk) }}">
                                <img src="{{ asset('images/' . $produk->gambar_produk) }}" alt="{{ $produk->nama_produk }}">
                            </a>
                        </div>

                        <div class="flex flex-col h-full">

                            {{-- Nama produk --}}
                            <a href="{{ route('produksdetail.show', $produk->id_produk) }}" class="mx-3 mb-3">
                                <h5 class="text-sm font-normal tracking-tight text-gray-900 dark:text-white mt-1.5">{{ $produk->nama_produk }}</h5>
                            </a>

                            {{-- Menghitung diskon --}}
                            @php
                                $total_diskon = $produk->diskon->isNotEmpty()
                                    ? $produk->diskon->sum(function($d) use ($produk) {
                                    return $produk->harga * ($d->persentase_diskon / 100);
                                    })
                                    : 0;

                                $harga_setelah_diskon = $produk->harga - $total_diskon;
                            @endphp

                            {{-- Menampilkan harga --}}

                            {{-- Kondisi ada diskon --}}

                            @if ($total_diskon > 0)
                                {{-- Harga setelah diskon --}}
                                <div class="mx-3">
                                    <span class="text-lg font-bold text-gray-900">
                                        Rp{{ number_format($harga_setelah_diskon, 0, ',', '.') }}
                                    </span>
                                </div>

                                {{-- Harga sebelum diskon --}}
                                <div class="" style="margin-top: -5px;">
                                    <span class="text-xs text-gray-500 line-through ml-3">
                                        Rp{{ number_format($produk->harga, 0, ',', '.') }}
                                    </span>

                                    {{-- Persentase diskon --}}
                                    <span class="text-sm text-red-600 ml-1">
                                        ({{ $produk->diskon->first()->persentase_diskon }}%)
                                    </span>
                                </div>

                                @if ($produk->alamat_penjual)
                                    {{-- Alamat Penjual --}}
                                    <div class="mb-1 mx-3">
                                        <span class="text-xs font-normal text-gray-600">
                                            {{ $produk->alamat_penjual['kota']}}
                                        </span>
                                    </div>
                                @else
                                    <div class="mb-1 mx-3">
                                        <span class="text-xs font-normal text-gray-600">

                                        </span>
                                    </div>
                                @endif

                                <div class="flex items-center pt-1 mx-3">
                                    <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                        <svg class="w-3 h-3 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                        </svg>
                                    </div>
                                    <span class="bg-blue-100 text-blue-800 font-bold px-1.5 py-0.4 rounded dark:bg-blue-200 dark:text-blue-800 ms-1" style="font-size: 10px;">4.0</span>
                                </div>
                            @else

                            {{-- Kondisi tidak ada diskon  --}}

                                {{-- Harga tanpa diskon --}}
                                <div class="mb-6 mx-3">
                                    <span class="text-lg font-bold text-gray-900">
                                        Rp{{ number_format($produk->harga, 0, ',', '.') }}
                                    </span>
                                </div>

                                @if ($produk->alamat_penjual)
                                    {{-- Alamat Penjual --}}
                                    <div class="mb-2 mx-3">
                                        <h5 class="text-xs font-normal text-gray-600">
                                            {{$produk->alamat_penjual['kota']}}
                                        </h5>
                                    </div>
                                @else
                                <div class="mb-2 mx-3">
                                    <h5 class="text-xs font-normal text-gray-600">

                                    </h5>
                                </div>
                                @endif

                                <div class="flex items-center pt-1 mx-3">
                                    <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                        <svg class="w-3 h-3 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                        </svg>
                                    </div>
                                    <span class="bg-blue-100 text-blue-800 font-bold px-1.5 py-0.4 rounded dark:bg-blue-200 dark:text-blue-800 ms-1" style="font-size: 10px;">4.0</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Navigasi -->
            <div class="swiper-button-next--{{ $kategori->id_kategori }}"></div>
            <div class="swiper-button-prev--{{ $kategori->id_kategori }}"></div>
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
                    nextEl: '.swiper-button-next--{{ $kategori->id_kategori }}',
                    prevEl: '.swiper-button-prev--{{ $kategori->id_kategori }}',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                    renderBullet: function (index, className) {
                        return '<span class="' + className + '"></span>';
                    },
                },
                on: {
                    slideChange: function() {
                        const swiper = this;
                        const nextButton = document.querySelector('.swiper-button-next--{{ $kategori->id_kategori }}');
                        const prevButton = document.querySelector('.swiper-button-prev--{{ $kategori->id_kategori }}');

                        if (swiper.isBeginning) {
                            prevButton.classList.add('swiper-button-disabled');
                        } else {
                            prevButton.classList.remove('swiper-button-disabled');
                        }

                        if (swiper.isEnd) {
                            nextButton.classList.add('swiper-button-disabled');
                        } else {
                            nextButton.classList.remove('swiper-button-disabled');
                        }
                    },

                    reachBeginning: function() {
                        document.querySelector('.swiper-button-prev--{{ $kategori->id_kategori }}').classList.add('swiper-button-disabled');
                    },
                    reachEnd: function() {
                        document.querySelector('.swiper-button-next--{{ $kategori->id_kategori }}').classList.add('swiper-button-disabled');
                    },
                    fromEdge: function() {
                        document.querySelector('.swiper-button-prev--{{ $kategori->id_kategori }}').classList.remove('swiper-button-disabled');
                        document.querySelector('.swiper-button-next--{{ $kategori->id_kategori }}').classList.remove('swiper-button-disabled');
                    }
                }
            });
            @endforeach
        });
    </script>

</x-layout-pelanggan>
