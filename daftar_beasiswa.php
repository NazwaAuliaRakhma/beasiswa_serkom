<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Beasiswa</title>
    <link rel="stylesheet" href="style.css">
    <script>
        // Asumsi IPK default
        const defaultIPK = 3.40; 
        window.onload = function () {
            const ipkInput = document.getElementById('ipk');
            ipkInput.value = defaultIPK.toFixed(2); // pembulatan 2 angka dibelakang koma
            validateIPK(); // cek ipk masuk disable atau enable
        };

        function validateIPK() {
            const ipkInput = document.getElementById('ipk');
            const ipkValue = parseFloat(ipkInput.value);
            const message = document.getElementById('message');

            message.textContent = ''; 

            if (ipkValue < 3.00) {
                message.textContent = 'IPK harus minimal 3.00 untuk mendaftar.';
                disableForm(); 
            } else {
                enableForm(); 
                message.textContent = ''; 
            }
        }

        function disableForm() {
            document.getElementById('pilihan_beasiswa').disabled = true;
            document.getElementById('berkas').disabled = true;
            document.querySelector('input[type="submit"]').disabled = true;
        }

        // Function to enable form fields
        function enableForm() {
            document.getElementById('pilihan_beasiswa').disabled = false;
            document.getElementById('berkas').disabled = false;
            document.querySelector('input[type="submit"]').disabled = false;
        }

        function updateDocumentRequirement() {
            const pilihanBeasiswa = document.getElementById('pilihan_beasiswa');
            const berkasLabel = document.getElementById('berkas_label');
            const documentRequirement = document.getElementById('document_requirement');

            documentRequirement.textContent = '';

            switch (pilihanBeasiswa.value) {
                case 'Beasiswa A':
                    berkasLabel.textContent = 'Upload Transkrip Nilai (PDF only):';
                    documentRequirement.textContent = 'Dokumen yang diperlukan: Transkrip Nilai';
                    break;
                case 'Beasiswa B':
                    berkasLabel.textContent = 'Upload Sertifikat Penghargaan (PDF only):';
                    documentRequirement.textContent = 'Dokumen yang diperlukan: Sertifikat Penghargaan';
                    break;
                case 'Beasiswa C':
                    berkasLabel.textContent = 'Upload Kartu Keluarga (PDF only):';
                    documentRequirement.textContent = 'Dokumen yang diperlukan: Kartu Keluarga';
                    break;
                default:
                    berkasLabel.textContent = 'Upload Berkas (PDF only):';
                    break;
            }
        }
    </script>
</head>
<body>
    <div class="content">
        <h1>Daftar Beasiswa</h1>
        <form action="hasil_beasiswa.php" method="POST" enctype="multipart/form-data" onsubmit="return validateIPK()">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" required><br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="no_hp">No HP:</label>
            <input type="tel" id="no_hp" name="no_hp" required><br><br>

            <label for="semester">Semester:</label>
            <select id="semester" name="semester" required>
                <option value="" disabled selected>Pilih Semester</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
            </select><br><br>

            <label for="ipk">IPK:</label>
            <input type="number" step="0.01" id="ipk" name="ipk" oninput="validateIPK()" required><br><br>

            <label for="pilihan_beasiswa">Pilihan Beasiswa:</label>
            <select id="pilihan_beasiswa" name="pilihan_beasiswa" required onchange="updateDocumentRequirement()">
                <option value="" disabled selected>Pilih Beasiswa</option>
                <option value="Beasiswa A">Beasiswa A</option>
                <option value="Beasiswa B">Beasiswa B</option>
                <option value="Beasiswa C">Beasiswa C</option>
            </select><br><br>

            <label id="berkas_label" for="berkas">Upload Berkas (PDF only):</label>
            <input type="file" id="berkas" name="berkas" accept="application/pdf" required><br><br>
            <div id="document_requirement" style="font-weight: bold;"></div>

            <input type="submit" value="Submit Form">
            <div id="message" style="color: red; margin-top: 10px;"></div>
        </form>
    </div>
</body>
</html>
