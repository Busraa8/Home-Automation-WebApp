<?php
session_start();

if (isset($_POST['login'])) {
    $userEmail = $_POST["email"];
    $userPassword = $_POST["password"];
    $encryptedPass = md5($userPassword); 
    include 'Producer/connection.php';
    $sql = "SELECT * FROM user_table WHERE email = '$userEmail' AND password = '$encryptedPass'";
    $result = $conn->query($sql);

    
    // Sonuçları kontrol etme
    if ($result->num_rows > 0) {
        // Kullanıcı bulundu
        $row = $result->fetch_assoc();
        $role = $row["role"];
        $id = $row["id"];
        $_SESSION["userid"] = 2;
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