<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Diskon</title>
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
        .form-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        .form-container input:focus {
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
      </div>
  </nav>

  <!-- Main Content -->
  <div class="container">
    <div class="form-container">
        <h2 class="text-center text-2xl font-semibold mb-5">Tambah Diskon</h2>
        <form method="POST" action="{{ route('diskons.store') }}">
            @csrf
            <div class="form-group">
                <label for="persentase_diskon">Persentase Diskon</label>
                <input type="number" name="persentase_diskon" id="persentase_diskon" required placeholder="Masukkan persentase diskon" />
            </div>
            <div class="form-group">
                <label for="tanggal_mulai">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" id="tanggal_mulai" required />
            </div>
            <div class="form-group">
                <label for="tanggal_selesai">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" id="tanggal_selesai" required />
            </div>

            <button type="submit">Submit</button>
        </form>
    </div>
  </div>

</body>
</html>
