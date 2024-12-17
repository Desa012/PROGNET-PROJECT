<x-layout-pelanggan>
    <div class="kategori-carousel">
        @foreach ($kategoriProduks as $kategori)
            <div class="kategori-item">
                <img src="https://picsum.photos/200/400" class="mx-auto w-24 h-24 object-cover rounded-full" alt="{{ $kategori->nama_kategori }}">
                <div class="mt-2 text-sm font-medium">
                        {{ $kategori->nama_kategori }}
                </div>
            </div>
        @endforeach
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            $('.kategori-carousel').slick({
                slidesToShow: 5,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                dots: true,
                arrows: true,
                responsive: [
                    {
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
</x-layout-pelanggan>
