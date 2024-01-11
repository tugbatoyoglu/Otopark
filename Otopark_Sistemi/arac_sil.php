<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Otopark Araç Silme</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    <h1>Otopark Araç Silme</h1>

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
        // Formdan gelen araç ID'sini al
        $aracID = $_POST["aracID"];

        // Veritabanında aracı sil
        $sql = "DELETE FROM Araclar WHERE AracID = $aracID";

        if ($conn->query($sql) === TRUE) {
            echo "<p>Araç başarıyla silindi.</p>";

            // Araç silindikten sonra müşteri silme sayfasına yönlendir
            header("Location: musteri_sil.php");
            exit();
        } else {
            echo "Hata: " . $sql . "<br>" . $conn->error;
        }
    }

    // Verileri al
    $sql = "SELECT AracID, PlakaNumarasi FROM Araclar";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<form action='' method='post'>";
        echo "<label for='aracID'>Silinecek Araçı Seçin:</label>";
        echo "<select name='aracID' id='aracID'>";

        while($row = $result->fetch_assoc()) {
            echo "<option value='" . $row["AracID"] . "'>" . $row["PlakaNumarasi"] . "</option>";
        }

        echo "</select>";
        echo "<button type='submit'>Sil</button>";
        echo "</form>";
    } else {
        echo "Veritabanında kayıtlı araç bulunamadı.";
    }

    // Veritabanı bağlantısını kapat
    $conn->close();
    ?>
</div>

</body>
</html>

