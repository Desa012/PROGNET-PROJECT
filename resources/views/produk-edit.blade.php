<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <style>
        /* Global styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Navbar */
        .navbar {
            background-color: #343a40;
            padding: 1rem;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 100;
        }

        .navbar .logo {
            color: #ffffff;
            font-size: 24px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .navbar a {
            color: #ffffff;
            text-decoration: none;
            margin-left: 20px;
            font-size: 16px;
        }

        .navbar a:hover {
            color: #007bff;
        }

        /* Form Styling */
        .form-container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin-top: 5rem;
        }

        .form-container input, .form-container textarea, .form-container select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        .form-container input:focus, .form-container textarea:focus, .form-container select:focus {
            border-color: #007bff;
            outline: none;
        }

        .form-container label {
            font-size: 14px;
            color: #555;
            margin-bottom: 5px;
        }

        .form-container button {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        .form-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar">
      <div class="container">
          <span class="logo">Toko Saya</span>
          <a href="dashboard-penjual">Home</a>
          <a href="diskons">Diskon</a>
          <a href="kategori_produks">Kategori Produk</a>
          <a href="produks">Produk</a>
      </div>
  </nav>

  <!-- Main Content -->
  <div class="container">
    <div class="form-container">
        <h2 class="text-center text-2xl font-semibold mb-5">Edit Produk</h2>
        <form method="POST" action="{{ route('produks.update', $produk->id_produk) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama_produk">Nama Produk</label>
                <input type="text" name="nama_produk" id="nama_produk" value="{{ $produk->nama_produk }}" required placeholder="Masukkan nama produk" />
            </div>

            <div class="form-group">
                <label for="id_kategori">Kategori Produk</label>
                <select name="id_kategori" id="id_kategori" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($kategoriProduks as $kategori)
                        <option value="{{ $kategori->id_kategori }}" {{ $produk->id_kategori == $kategori->id_kategori ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="id_diskon">Diskon</label>
                <select name="id_diskon" id="id_diskon">
                    <option value="">Pilih Diskon</option>
                    @foreach($diskons as $diskon)
                        <option value="{{ $diskon->id_diskon }}" {{ $produk->id_diskon == $diskon->id_diskon ? 'selected' : '' }}>{{ $diskon->persentase_diskon }}%</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="deskripsi_produk">Deskripsi Produk</label>
                <textarea name="deskripsi_produk" id="deskripsi_produk" required placeholder="Masukkan deskripsi produk">{{ $produk->deskripsi_produk }}</textarea>
            </div>

            <div class="form-group">
                <label for="gambar_produk">Gambar Produk</label>
                <input type="file" name="gambar_produk" id="gambar_produk" />
                <small>Biarkan kosong jika tidak ingin mengubah gambar.</small>
            </div>

            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" name="harga" id="harga" value="{{ $produk->harga }}" required placeholder="Masukkan harga produk" />
            </div>

            <div class="form-group">
                <label for="stok">Stok</label>
                <input type="number" name="stok" id="stok" value="{{ $produk->stok }}" required placeholder="Masukkan stok produk" />
            </div>


            <button type="submit">Simpan</button>
        </form>
    </div>
  </div>

</body>
</html>
