<?php
// Veritabanına bağlan
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "otoparkotomasyonu";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}



// Müşteri ve araç bilgilerini içeren sorgu
$sql = "SELECT musteriler.MusteriID, musteriler.Ad, musteriler.Soyad, musteriler.Telefon, araclar.PlakaNumarasi, araclar.Marka
        FROM musteriler
        LEFT JOIN araclar ON musteriler.MusteriID = araclar.MusteriID";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Otopark Müşteri ve Araç Listesi</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <?php
    if ($result && $result->num_rows > 0) {
        echo '<table>';
        echo '<tr>';
        echo '<th>MusteriID</th>';
        echo '<th>Ad</th>';
        echo '<th>Soyad</th>';
        echo '<th>Telefon</th>';
        echo '<th>Plaka Numarası</th>';
        echo '<th>Marka</th>';
        echo '</tr>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['MusteriID'] . '</td>';
            echo '<td>' . $row['Ad'] . '</td>';
            echo '<td>' . $row['Soyad'] . '</td>';
            echo '<td>' . $row['Telefon'] . '</td>';
            echo '<td>' . $row['PlakaNumarasi'] . '</td>';
            echo '<td>' . $row['Marka'] . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo "Veritabanında kayıtlı müşteri ve araç bulunamadı.";
    }

    // Veritabanı bağlantısını kapat
    $conn->close();
    ?>
</body>
</html>
