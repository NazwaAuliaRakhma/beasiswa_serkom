<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beasiswa Application</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            padding: 20px;
            color: #ecf0f1;
        }
        .sidebar a {
            color: #ecf0f1;
            text-decoration: none;
            display: block;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }
        .sidebar a:hover {
            background-color: #34495e;
        }
        .main-content {
            flex-grow: 1;
            background-color: #ecf0f1;
            padding: 40px;
            box-sizing: border-box;
        }
        .main-content h1 {
            font-size: 36px;
            margin-bottom: 20px;
            color: #34495e;
        }
        .main-content p {
            font-size: 18px;
        }
        .btn-custom {
            background-color: #34495e;
            color: white;
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #2c3e50;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2 class="text-center">Beasiswa</h2>
        <a href="index.php?page=home">Home</a>
        <a href="index.php?page=pilihan_beasiswa">Pilihan Beasiswa</a>
        <a href="index.php?page=daftar_beasiswa">Daftar Beasiswa</a>
        <a href="index.php?page=hasil_beasiswa">Hasil Beasiswa</a>
    </div>

    <!-- Main Content Area -->
    <div class="main-content">
        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            
            switch ($page) {
                case 'home':
                    include 'home.php';
                    break;
                case 'pilihan_beasiswa':
                    include 'pilihan_beasiswa.php';
                    break;
                case 'beasiswa_a':
                    include 'beasiswa_a.php';
                    break;
                case 'beasiswa_b':
                    include 'beasiswa_b.php';
                    break;
                case 'beasiswa_c':
                    include 'beasiswa_c.php';
                    break;
                case 'daftar_beasiswa':
                    include 'daftar_beasiswa.php';
                    break;
                case 'hasil_beasiswa':
                    include 'hasil_beasiswa.php';
                    break;
                default:
                    echo "<h1>Page Not Found</h1>";
            }
        } else {
            // Default page is home
            include 'home.php';
        }
        ?>
    </div>
</body>
</html>
