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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

        .swiper-pagination-bullet {
            top: 10.5px;
            position: relative;
            width: 50px;
            height: 5px;
            margin: 0 5px;
            background-color: #17416e;
            border-radius: 15px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .swiper-pagination-bullet-active {
            background-color: #007bff;
            transform: scale(1.1);
        }

        .swiper-pagination {
            opacity: 0.5;
            margin-top: 10px;
            display: grid;
            grid-auto-flow: column;
            justify-content: center;
            align-items: center;
            gap: 10px;
            transition: opacity 0.3s ease;
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
            gap: 50px;
            margin: 20px -20px;
        }

        .gambar-produk {
            width: 350px;
            aspect-ratio: 1/1;
            overflow: hidden;
            border-radius: 20px;
            position: sticky;
            top: 20px;
        }

        .gambar-produk img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
        }

        .info-produk {
            overflow: hidden;
        }

        .info-produk h2 {
            font-size: 22px;
            font-weight: bold;
            font-family: Arial, sans-serif;
            color: #000000;
            margin-bottom: 10px;
        }

        .info-produk .deskripsi {
            font-size: 16px;
            color: #202020;
            line-height: 1.5;
            margin-bottom: 70px;
        }

        .info-produk .penjual {
            font-size: 14px;
            color: #202020;
        }

        .info-pembelian {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
            background-color: #f9f9f9;
            height: 75%;
        }

        .info-pembelian h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 15px;
        }

        .info-pembelian input {
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

        .kontainer-gambar-pesanan {
            width: 80px;
            aspect-ratio: 1/1;
            overflow: hidden;
            border-radius: 8px;
        }

        .kontainer-gambar-pesanan img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
        }

        .gambar-toko-produk {
            width: 60px;
            aspect-ratio: 1/1;
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.5)
        }

        .gambar-toko-produk img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .info-toko-produk {
            display: flex;
            align-items: center;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            width: 100%;
            /* max-width: 400px; */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        /* .kontainer-keranjang-layout {
            display: flex;
            gap: 20px;
            padding: 20px;
            background-color: #f8f9fa;
        } */

        /* .kontainer-keranjang {
            flex: 3;
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #ddd;
        } */

        .keranjang-item {
            width: 100%;
            display: flex;
            gap: 50px;
        }

        .keranjang-detail-toko {
            width: 100%;
            height: 210px;
            background-color: #f2f2f2;
            border: 2px solid #1a64b4;
            border-radius: 8px;
            padding: 2%;
            padding-top: 3%;
            margin-bottom: 5%;
        }

        .keranjang-header {
            display: flex;
            align-items: center;
            gap: 15px;
            font-weight: bold;
            color: #000000;
            margin-bottom: 3%;
        }

        .keranjang-detail {
            display: flex;
            gap: 35px;
            align-items: center;
            width: 800px;
        }

        .keranjang-gambar-produk {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
        }

        .keranjang-detail-produk {
            flex-grow: 1;
        }

        .keranjang-nama-produk {
            font-weight: 600;
            margin-bottom: 7px;
        }

        .keranjang-harga-produk {
            display: flex;
            background-color: #046ad6;
            color: #f4f4f4;
            font-size: 95%;
            font-weight: 400;
            margin-top: 10%;
            padding: 5px 10px;
            border-radius: 6px;
            align-items: center;
            justify-content: center;
            width: fit-content;
        }

        .keranjang-aksi-produk {
            margin-right: 60px;
            margin-top: 8%;
        }

        .keranjang-hapus-barang {
            background-color: red;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
        }

        .keranjang-ringkasan-belanja {
            position: sticky;
            height : fit-content;
            width: 75%;
            padding: 20px 20px;
            border: 2px solid #1a64b4;
            border-radius: 8px;
            background-color: white;
        }

        .btn-beli {
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: block;
            width: 100%;
            text-align: center;
        }

    </style>
</head>

<body>
    <div class="min-h-full">
        <x-navbar-pelanggan></x-navbar-pelanggan>
      <main>
        <div class="mx-auto max-w-7xl px-4 py-6">
          {{ $slot }}
        </div>
      </main>
    </div>
</body>
</html>
