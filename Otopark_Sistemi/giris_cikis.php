<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Çıkış Kaydı Ekle</title>
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen verileri al
    $girisTarihiSaat = $_POST["girisTarihiSaat"];
    $cikisTarihiSaat = $_POST["cikisTarihiSaat"];

    // Veritabanına giriş-çıkış kaydını ekle
    $sqlEkle = "INSERT INTO GirisCikisKayitlari (GirisTarihiVeSaat, CikisTarihiVeSaat, AracID)
                VALUES ('$girisTarihiSaat', '$cikisTarihiSaat', LAST_INSERT_ID())";
    
    $conn = new mysqli("localhost", "root", "", "otoparkotomasyonu");
    
    if ($conn->query($sqlEkle) === TRUE) {
        echo "Giriş-Çıkış kaydı başarıyla eklendi.";
    } else {
        echo "Hata: " . $sqlEkle . "<br>" . $conn->error;
    }

    // Veritabanı bağlantısını kapat
    $conn->close();
}
?>

<h1>Giriş Çıkış Kaydı Ekle</h1>

<!-- Giriş Çıkış Kaydı Ekleme Formu -->
<form action="" method="post">
    <label for="girisTarihiSaat">Giriş Tarihi ve Saati:</label>
    <input type="datetime-local" id="girisTarihiSaat" name="girisTarihiSaat" required>

    <label for="cikisTarihiSaat">Çıkış Tarihi ve Saati:</label>
    <input type="datetime-local" id="cikisTarihiSaat" name="cikisTarihiSaat" required>

    <button type="submit">Kaydet</button>
</form>


</body>
</html>
