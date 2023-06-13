<?php

$servername = "localhost"; 
    $username = "root"; 
    $password = "";    
    $dbname = "home_automation"; 

    // Veritabanı bağlantısı oluşturma
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

?>