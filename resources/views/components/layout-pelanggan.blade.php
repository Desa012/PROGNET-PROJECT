<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <title>Document</title>

    <style>
        .kategori-item {
            text-align: center;
        }

        .kategori-item img {
            width: auto;
            height: 60px;
            max-width: 100%;
            object-fit: contain;
            border-radius: 10%;
            margin: 0 auto;
            aspect-ratio: 1 / 1;
        }

        .kategori-item p {
            margin-top: 10px;
            font-size: 14px;
        }

        .kategori-header {
            border: 2px solid #e5e7eb;
            background-color: #f9fafb;
            border-radius: 6px;
            padding: 10px;
            margin-top: 120px;
            margin-bottom: 25px;
            display:flex;
            justify-content: space-between;
            align-items: center;
        }

        .slick-dots {
            position: relative;
            margin-top: -15px;
            margin-bottom: -40px;
        }

        .slick-dots li {
            margin: 0 10px;
        }

        .slick-dots li button::before {
            font-size: 8px;
        }

        [class^="swiper-button-next--"]::before,
        [class^="swiper-button-prev--"]::before {
            content: ''; /* Bersihkan konten default */
            display: inline-block;
            width: 12px;
            height: 12px;
            border-style: solid;
            border-width: 4px 4px 0 0; /* Membuat panah */
            /* transform: rotate(45deg); Menyesuaikan arah */
            position: absolute;
        }

        [class^="swiper-button-prev--"]::before {
            /* transform: rotate(-135deg); Panah mengarah ke kiri */
            left: 22px; /* Penyesuaian posisi */
            top: 50%;
            transform: translateY(-50%) rotate(-135deg);
        }

        [class^="swiper-button-next--"]::before {
            /* transform: rotate(45deg); Panah mengarah ke kanan */
            right: 22px; /* Penyesuaian posisi */
            top: 50%;
            transform: translateY(-50%) rotate(45deg);
        }

        /* Kustom CSS untuk Swiper Button */
        [class^="swiper-button-next--"],
        [class^="swiper-button-prev--"] {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
            width: 40px;
            height: 40px;
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
            border-radius: 10%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.3s ease, background-color 0.3s ease;
            opacity: 0.5;
        }

        [class^="swiper-button-prev--"] {
            left: -10px;
        }

        [class^="swiper-button-next--"] {
            right: -10px;
        }

        .swiper-button-disabled {
            opacity: 0;
            pointer-events: none;
        }

        [class^="swiper-button-next--"]:hover,
        [class^="swiper-button-prev--"]:hover {
            opacity: 1;
            background-color: #000000;
        }

        .swiper-container {
            height: auto;
            max-height: 300px;
            overflow: hidden;
            position: relative;
        }

        .image-container {
            width: 100%;
            height: 150px;
            overflow: hidden;
            position: relative;
            border-radius: 5px 5px 0px 0px;
        }

        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .container {
            display: grid;
            grid-template-columns: 1fr 2fr 1fr;
            gap: 20px;
            margin: 20px;
        }

        .gambar-produk {
            position: sticky;
            top: 20px;
        }

        .gambar-produk img {
            width: 100%;
            display: block;
            margin-bottom: 10px;
        }

        .info-produk {
            overflow: hidden;
        }

        .info-produk h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .info-produk .deskripsi {
            font-size: 16px;
            color: #666;
            line-height: 1.5;
        }

        .info-produk .penjual {
            font-size: 14px;
            color: #333;
        }

        .info-pembelian {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .info-pembelian h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 15px;
        }

        .purcase.info input {
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .info-pembelian button {
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            background-color: #007bff;
            color: #fff;
        }

        .info-pembelian button:hover {
            background-color: #054080;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="min-h-full">
        <x-navbar-pelanggan></x-navbar-pelanggan>
      <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
          {{ $slot }}
        </div>
      </main>
    </div>
</body>
</html>
