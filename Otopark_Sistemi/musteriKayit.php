<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Müşteri Kayıt</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php
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
    // Formdan gelen verileri al
    $ad = $_POST["ad"];
    $soyad = $_POST["soyad"];
    $email = $_POST["email"];
    $telefon = $_POST["telefon"];

    // Veritabanına ekle
    $sql = "INSERT INTO Musteriler (Ad, Soyad, Email, Telefon) VALUES ('$ad', '$soyad', '$email', '$telefon')";

    if ($conn->query($sql) === TRUE) {
        echo "Müşteri başarıyla kaydedildi.";
    } else {
        echo "Hata: " . $sql . "<br>" . $conn->error;
    }
}

// Bağlantıyı kapat
$conn->close();
?>

    <form action="" method="post">
        <label for="ad">Ad:</label>
        <input type="text" id="ad" name="ad" required>

        <label for="soyad">Soyad:</label>
        <input type="text" id="soyad" name="soyad" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="telefon">Telefon:</label>
        <input type="tel" id="telefon" name="telefon" required>

        <button type="submit">Kaydet</button>
    </form>

</body>
</html>
