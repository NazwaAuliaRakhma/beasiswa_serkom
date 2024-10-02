<?php
session_start(); // Mulai sesi

// Koneksi ke database
require 'db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $semester = $_POST['semester'];
    $ipk = $_POST['ipk'];
    $pilihan_beasiswa = $_POST['pilihan_beasiswa'];

    // Validasi dan proses upload file
    $target_dir = "uploads/";
    
    // Buat folder uploads jika belum ada
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true); // Buat folder dengan akses penuh
    }
    
    $target_file = $target_dir . basename($_FILES["berkas"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Cek apakah file adalah PDF
    if ($fileType != "pdf") {
        echo "<div class='alert'>Sorry, only PDF files are allowed.</div>";
        $uploadOk = 0;
    }

    // Jika tidak ada masalah dengan upload
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["berkas"]["tmp_name"], $target_file)) {
            // Masukkan data ke database tanpa menyertakan status_ajuan, karena status ajuan akan otomatis diset oleh database
            $stmt = $conn->prepare("INSERT INTO mahasiswa (nama, email, no_hp, semester, ipk, pilihan_beasiswa, berkas) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $nama, $email, $no_hp, $semester, $ipk, $pilihan_beasiswa, $target_file);

            // Eksekusi statement dan cek apakah berhasil
            if ($stmt->execute()) {
                $_SESSION['success_message'] = "Application submitted successfully.";
            } else {
                echo "<div class='alert'>Error: " . $stmt->error . "</div>";
            }
            $stmt->close();
        } else {
            echo "<div class='alert'>Sorry, there was an error uploading your file.</div>";
        }
    }
}

// Menampilkan data hasil pendaftaran
$stmt = $conn->prepare("SELECT * FROM mahasiswa ORDER BY id DESC");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Beasiswa</title>
    <link rel="stylesheet" href="style.css"> <!-- External file CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .alert {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        /* Styling untuk tombol kembali */
        .back-button {
            margin-top: 20px;
        }
        .back-button a {
            text-decoration: none;
            color: white;
        }
        .back-button button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            display: inline-flex;
            align-items: center;
        }
        .back-button button i {
            margin-right: 8px;
        }
    </style>
</head>
<body>

<div class="content">
    <h1>Hasil Beasiswa</h1>
    
    <?php
    // Menampilkan pesan sukses jika ada
    if (isset($_SESSION['success_message'])) {
        echo "<div class='alert'>" . $_SESSION['success_message'] . "</div>";
        unset($_SESSION['success_message']); // Hapus setelah ditampilkan
    }

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Nama</th><th>Email</th><th>No HP</th><th>Semester</th><th>IPK</th><th>Pilihan Beasiswa</th><th>Status Ajuan</th><th>Berkas</th></tr>";
        
        // Loop untuk menampilkan data pendaftar
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['no_hp']) . "</td>";
            echo "<td>" . htmlspecialchars($row['semester']) . "</td>";
            echo "<td>" . htmlspecialchars($row['ipk']) . "</td>";
            echo "<td>" . htmlspecialchars($row['pilihan_beasiswa']) . "</td>";
            echo "<td>" . htmlspecialchars($row['status_ajuan']) . "</td>";
            echo "<td><a href='" . htmlspecialchars($row['berkas']) . "' target='_blank'>Download Berkas</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<div class='alert'>No applications found.</div>";
    }

    // Tutup koneksi
    $stmt->close();
    $conn->close();
    ?>

    <!-- Tombol Kembali ke Halaman Home -->
    <div class="back-button">
        <a href="index.php">
            <button><i class="fas fa-home"></i> Kembali ke Halaman Home</button>
        </a>
    </div>
</div>

</body>
</html>
