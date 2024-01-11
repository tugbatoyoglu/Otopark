<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Otopark Araç Listesi</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    <h1>Otopark Araç Listesi</h1>

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

    // Verileri al
    $sql = "SELECT * FROM Araclar";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>AracID</th><th>Plaka Numarası</th><th>Marka</th></tr>";

        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["AracID"] . "</td>";
            echo "<td>" . $row["PlakaNumarasi"] . "</td>";
            echo "<td>" . $row["Marka"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Veritabanında kayıtlı araç bulunamadı.";
    }

    // Veritabanı bağlantısını kapat
    $conn->close();
    ?>
</div>

</body>
</html>
