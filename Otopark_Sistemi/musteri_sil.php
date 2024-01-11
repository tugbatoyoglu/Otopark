<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Otopark Müşteri Silme</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    <h1>Otopark Müşteri Silme</h1>

    <?php
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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Formdan gelen müşteri ID'sini al
        $musteriID = $_POST["musteriID"];

        // Veritabanında müşteriyi sil
        $sql = "DELETE FROM Musteriler WHERE MusteriID = $musteriID";

        if ($conn->query($sql) === TRUE) {
            echo "<p>Müşteri başarıyla silindi.</p>";
        } else {
            echo "Hata: " . $sql . "<br>" . $conn->error;
        }
    }

    // Verileri al
    $sql = "SELECT MusteriID, Ad, Soyad FROM Musteriler";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<form action='' method='post'>";
        echo "<label for='musteriID'>Silinecek Müşteriyi Seçin:</label>";
        echo "<select name='musteriID' id='musteriID'>";

        while($row = $result->fetch_assoc()) {
            echo "<option value='" . $row["MusteriID"] . "'>" . $row["Ad"] . " " . $row["Soyad"] . "</option>";
        }

        echo "</select>";
        echo "<button type='submit'>Sil</button>";
        echo "</form>";
    } else {
        echo "Veritabanında kayıtlı müşteri bulunamadı.";
    }

    // Veritabanı bağlantısını kapat
    $conn->close();
    ?>
</div>

</body>
</html>
