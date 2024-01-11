<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Otopark Araç Ekle</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Formdan gelen araç bilgilerini al
        $plaka = $_POST["plaka"];
        $marka = $_POST["marka"];

        // Veritabanına bağlan
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "otoparkotomasyonu";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Bağlantı kontrolü
        if ($conn->connect_error) {
            die("Bağlantı hatası: " . $conn->connect_error);
        }

        // Verileri veritabanına ekle
        $sql = "INSERT INTO Araclar (PlakaNumarasi, Marka) VALUES ('$plaka', '$marka')";

        // Sorguyu çalıştır ve hata kontrolü yap
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Araç başarıyla eklendi.');</script>";
        } else {
            echo "Hata: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>

    <form action="" method="post">
        <h1>Otopark Araç Ekle</h1>
        
        <label for="plaka">Plaka:</label>
        <input type="text" id="plaka" name="plaka" required>

        <label for="marka">Marka:</label>
        <input type="text" id="marka" name="marka" required>

        <button type="submit">devam et</button>
    </form>

    
     <!-- Müşteri Ekle Sayfasına Yönlendirme Butonu -->
     

     <script>
        // Form gönderildiğinde çalışacak JavaScript kodu
        document.querySelector('form').addEventListener('submit', function (event) {
            event.preventDefault(); // Formun otomatik olarak gönderilmesini engelle
            window.location.href = 'musteri_ekle.php'; // Müşteri Ekle sayfasına yönlendir
        });
    </script>

</div>

</body>
</html>

