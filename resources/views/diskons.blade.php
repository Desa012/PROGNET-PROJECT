<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diskon</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            padding-top: 100px; /* Space for navbar */
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

        /* Button Style */
        .add-discount-btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            text-align: center;
            display: inline-block;
            margin-bottom: 2rem;
            transition: background-color 0.3s ease;
        }

        .add-discount-btn:hover {
            background-color: #0056b3;
        }

        /* Card Styles */
        .card {
            display: flex;
            flex-direction: column;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 2rem;
            transition: background-color 0.3s ease;
        }

        .card:hover {
            background-color: #f8f9fa;
        }

        .card h5 {
            font-size: 24px;
            margin: 10px 0;
            color: #333;
        }

        .card p {
            font-size: 16px;
            color: #666;
        }

        .card label {
            font-size: 14px;
            font-weight: bold;
            color: #555;
        }

        /* Button Group */
        .button-group {
            display: flex;
            gap: 10px;
        }

        .button-group button {
            padding: 8px 16px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button-group button:hover {
            background-color: #007bff;
            color: white;
        }

        .button-group button.delete-btn {
            background-color: #dc3545;
            color: white;
        }

        .button-group button.delete-btn:hover {
            background-color: #c82333;
        }

        /* Media Queries for responsiveness */
        @media (max-width: 768px) {
            .card {
                flex-direction: column;
            }

            .button-group {
                flex-direction: column;
            }
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
    <!-- Add Discount Button -->
    <button class="add-discount-btn" onclick="location.href='{{ route('diskons.create') }}'">Tambah Diskon</button>

    <!-- Diskon List -->
    @foreach ($diskon as $dis)
      <div class="card">
        <label>Persentase Diskon</label>
        <h5>{{ $dis['persentase_diskon'] }}%</h5>

        <label>Tanggal Mulai</label>
        <p>{{ $dis['tanggal_mulai'] }}</p>

        <label>Tanggal Selesai</label>
        <p>{{ $dis['tanggal_selesai'] }}</p>

        <!-- Button Group (Edit & Delete) -->
        <div class="button-group">
          <button onclick="location.href='{{ route('diskons.edit',$dis['id_diskon']) }}'">Edit</button>
          <form action="{{ route('diskons.destroy',$dis['id_diskon']) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="delete-btn">Delete</button>
          </form>
        </div>
      </div>
    @endforeach
  </div>

</body>
</html>
