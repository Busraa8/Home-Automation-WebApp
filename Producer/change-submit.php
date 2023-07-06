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
    if ($_SESSION["on_off"] != null) {
        $onof = $_POST["onof"];
        $props["on_off"] = $onof;
    }
    if ($_SESSION["brightness"] != null) {
        $brightness = $_POST["brightness"];
        $props["brightness"] = $brightness;
    }
    if ($_SESSION["temperature"] != null) {
        $temperature = $_POST["temperature"];
        $props["temperature"] = $temperature;
    }
    if ($_SESSION["connected"] != null) {
        $connectionv = $_POST["connectionv"];
        $props["connected"] = $connectionv;
    }
    if ($_SESSION["volume"] != null) {
        $volume = $_POST["volume"];
        $props["volume"] = $volume;
    }
    $propsJson = json_encode($props);
    $propsJsonEscaped = mysqli_real_escape_string($conn, $propsJson);

    $sql = "SELECT * FROM devices Where id = $deviceId";
    $result = mysqli_query($conn, $sql);
    $roomnameid = "";
    $previousState = "";
    $newState = "";
    $deviceName = "";
    while ($row = mysqli_fetch_assoc($result)) {
        $roomnameid = $row["room_id"];
        $deviceName = $row["device_name"];
        $previousState = $row["properties"];
    }
    $sql = "UPDATE devices SET properties = '$propsJsonEscaped' WHERE id = $deviceId";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        // Başarılı bir şekilde güncellendi
    } else {
        // Hata oluştu
        echo "Error: " . mysqli_error($conn);
    }
    date_default_timezone_set('Europe/Istanbul');
    $currentTimestamp = time();
    $formattedDateTime = date("Y-m-d H:i:s", $currentTimestamp);
    $sql = "INSERT INTO logs (`id`, `role`, `room_id`, `device_id`, `device_name`, `previous_state`, `new_state`, `request`, `date`) VALUES (NULL, 'producer', '$roomnameid', '$deviceId', '$deviceName', '$previousState', '$propsJson', 'null', '$formattedDateTime' );";

    if (mysqli_query($conn, $sql)) {
        echo "Succesful";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>