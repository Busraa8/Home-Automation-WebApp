<?php

$servername = "localhost"; // Sunucu adı
    $username = "root"; // Veritabanı kullanıcı adı
    $password = ""; // Veritabanı şifresi    
    $dbname = "home_automation"; // Kullanılan veritabanı adı

    // Veritabanı bağlantısı oluşturma
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

?>