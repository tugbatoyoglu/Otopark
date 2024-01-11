<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "otoparkotomasyonu";

// MySQL bağlantısı oluştur
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantı kontrolü
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// Araçlar ve Giriş Çıkış Kayıtlarını İçeren SQL Sorgusu
$sql = "SELECT araclar.AracID, PlakaNumarasi, GirisTarihiVeSaat, CikisTarihiVeSaat FROM araclar
        JOIN giriscikiskayitlari ON araclar.AracID = giriscikiskayitlari.AracID";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Her bir araç için işlemleri yap
    while ($row = $result->fetch_assoc()) {
        $aracID = $row["AracID"];
        $plakaNumarasi = $row["PlakaNumarasi"];
        $girisTarihiVeSaat = $row["GirisTarihiVeSaat"];
        $cikisTarihiVeSaat = $row["CikisTarihiVeSaat"];

        // Giriş ve çıkış saatlerini DateTime nesnelerine dönüştür
        $girisSaat = new DateTime($girisTarihiVeSaat);
        $cikisSaat = new DateTime($cikisTarihiVeSaat);

        // Saat farkını hesapla
        $saatFarki = $girisSaat->diff($cikisSaat);

        // Ücreti hesapla (örneğin her saat başına 10 TL)
        $ucret = $saatFarki->h * 10;

        // Ödeme işlemleri
        $odemeID = uniqid('odeme_');
        $MusteriID = "1"; // Örnek müşteri ID, gerçek müşteri ID'sini veritabanından almalısınız.
        $odemeTutar = $ucret;
        $odemeTur = "Nakit"; // Ödeme türünü kendi gereksinimlerinize göre ayarlayabilirsiniz.

        // Ödemeyi veritabanına ekle
        $sqlOdemeEkle = "INSERT INTO odemeler (odeme_id, MusteriID, odeme_tutar, odeme_tur) VALUES ('$odemeID', '$musteriID', '$odemeTutar', '$odemeTur')";

        if ($conn->query($sqlOdemeEkle) === TRUE) {
            echo "Araç ID: $aracID, Plaka Numarası: $plakaNumarasi, Ücret: $ucret TL, Ödeme başarıyla eklendi.<br>";
        } else {
            echo "Hata: " . $sqlOdemeEkle . "<br>" . $conn->error;
        }
    }
} else {
    echo "Veritabanında kayıtlı araç bulunamadı.";
}

// Veritabanı bağlantısını kapat
$conn->close();
?>
