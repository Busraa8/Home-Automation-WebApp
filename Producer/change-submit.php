<?php 
    include 'connection.php';
    session_start();    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $deviceId = $_SESSION["deviceid"];        

        $onof = "";
        $brightness = "";
        $temperature = "";
        $connectionv = "";
        $volume = "";

        $props = $_SESSION["props"];
        if($_SESSION["on_off"] != null){
            $onof = $_POST["onof"];
            $props["on_off"] = $onof;
        }
        if ($_SESSION["brightness"] != null){
             $brightness = $_POST["brightness"];   
             $props["brightness"] = $brightness;
        }
        if ($_SESSION["temperature"] != null){
            $temperature = $_POST["temperature"];
            $props["temperature"] = $temperature;
        }
        if ($_SESSION["connected"] != null){
            $connectionv = $_POST["connectionv"];
            $props["connected"] = $connectionv;          
        }
        if ($_SESSION["volume"] != null){
            $volume = $_POST["volume"];
            $props["volume"] = $volume;
        }
        $propsJson = json_encode($props);
        $propsJsonEscaped = mysqli_real_escape_string($conn, $propsJson);
        $sql = "UPDATE devices SET properties = '$propsJsonEscaped' WHERE id = $deviceId";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            // Başarılı bir şekilde güncellendi
        } else {
            // Hata oluştu
            echo "Error: " . mysqli_error($conn);
        }
    }
?>