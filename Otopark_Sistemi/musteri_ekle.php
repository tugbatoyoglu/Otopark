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

// Müşteri Ekleme İşlemleri
$sqlMusteri = "INSERT INTO musteriler (Ad, Soyad, Email, Telefon) VALUES ('John', 'Doe', 'john@example.com', '123456789')";
if ($conn->query($sqlMusteri) === TRUE) {
    echo "Müşteri başarıyla eklendi. ";
} else {
    echo "Hata: " . $sqlMusteri . "<br>" . $conn->error;
}

// Araç Ekleme İşlemleri
$sqlArac = "INSERT INTO araclar (PlakaNumarasi, Marka) VALUES ('ABC123', 'Toyota')";
if ($conn->query($sqlArac) === TRUE) {
    echo "Araç başarıyla eklendi. ";
} else {
    echo "Hata: " . $sqlArac . "<br>" . $conn->error;
}

// Giriş Çıkış Kaydı Ekleme İşlemleri
$sqlGirisCikis = "INSERT INTO giriscikiskayitlari (GirisTarihiVeSaat, CikisTarihiVeSaat, AracID) VALUES ('2024-01-12 03:03', '2024-01-19 04:04', LAST_INSERT_ID())";
if ($conn->query($sqlGirisCikis) === TRUE) {
    echo "Giriş çıkış kaydı başarıyla eklendi.";
} else {
    echo "Hata: " . $sqlGirisCikis . "<br>" . $conn->error;
}

// Veritabanı bağlantısını kapat
$conn->close();
?>


    <h1>Müşteri Ekle</h1>

    <!-- Müşteri Ekle Formu -->
    <form action="" method="post">
        <label for="ad">Ad:</label>
        <input type="text" id="ad" name="ad" required>

        <label for="soyad">Soyad:</label>
        <input type="text" id="soyad" name="soyad" required>

        <label for="email">E-posta:</label>
        <input type="email" id="email" name="email" required>

        <label for="telefon">Telefon:</label>
        <input type="tel" id="telefon" name="telefon" required>

        <button type="submit" name="ekle">Ekle</button>
    </form>
    <script>
    // Form gönderildiğinde çalışacak JavaScript kodu
    document.querySelector('form').addEventListener('submit', function (event) {
        event.preventDefault(); // Formun otomatik olarak gönderilmesini engelle

        // AJAX kullanarak asenkron bir istek gönder
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // İstek başarıyla tamamlandığında çalışacak kod
                window.location.href = 'giris_cikis.php'; // Müşteri Ekle sayfasına yönlendir
            }
        };

        // POST isteği gönder
        xhr.open('POST', '', true); // Boş URL, çünkü aynı sayfaya istek gönderiyoruz
        xhr.send(new FormData(this));
    });
</script>

</body>
</html>
