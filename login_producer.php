<?php
session_start();

if (isset($_POST['login'])) {
    $userEmail = $_POST["email"];
    $userPassword = $_POST["password"];

    $servername = "localhost"; // Sunucu adı
    $username = "root"; // Veritabanı kullanıcı adı
    $password = ""; // Veritabanı şifresi    
    $dbname = "home_automation"; // Kullanılan veritabanı adı

    // Veritabanı bağlantısı oluşturma
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Bağlantıyı kontrol etme
    if ($conn->connect_error) {
        die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
    }

    // SQL sorgusu oluşturma
    $sql = "SELECT * FROM user_table WHERE email = '$userEmail' AND password = '$userPassword'";

    // Sorguyu çalıştırma
    $result = $conn->query($sql);

    // Sonuçları kontrol etme
    if ($result->num_rows > 0) {
        // Kullanıcı bulundu
        $row = $result->fetch_assoc();
        $role = $row["role"];

        // Kullanıcının rolüne göre yönlendirme yapma
        if ($role == "producer") {
            header("location: Producer/home-producer.php");
        } else {
            echo "Undefined user role";
        }
    } else {
        // Kullanıcı bulunamadı veya hatalı giriş
        echo "Invalid email or password";
    }

    // Veritabanı bağlantısını kapatma
    $conn->close();
}
?>