<?php 
    include 'connection.php';
    session_start();    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $deviceId = $_SESSION["deviceid"];

        $roomName = "";
        $deviceName = "";
        $sql = "SELECT r.name, d.device_name 
        from room r JOIN devices d ON d.room_id = r.id  
        WHERE d.id = $deviceId";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $roomName = $row["name"];
            $deviceName = $row["device_name"];
        }
        $roomName = strtolower($roomName);
        $deviceName = strtolower(str_replace(' ', '_', $deviceName));
        
        if($deviceName == "wi-fi")
            $deviceName = "wifi";
        $sql = "UPDATE checkbox_".$roomName." SET $deviceName = 0";
        $result = mysqli_query($conn, $sql);
        if ($result) {
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        

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