<?php
include 'connection.php';

session_start();

$propsDevice = "";
$consumerPropsDevice = "";

if (isset($_POST['device_type'])) {
    if ($_POST['device_type'] == 'Light') {
        $propsDevice = '{\"on_off\":\"false\",\"brightness\":\"50\"}';
    }
    if ($_POST['device_type'] == 'Air Conditioner') {
        $propsDevice = '{\"on_off\":\"false\",\"temperature\":\"25\"}';
    }
    if ($_POST['device_type'] == 'Wi-Fi') {
        $propsDevice = '{\"connected\":\"false\",\"on_off\":\"false\"}';
    }
    if ($_POST['device_type'] == 'Speaker') {
        $propsDevice = '{\"volume\":\"50\",\"on_off\":\"false\"}';
    }
    if ($_POST['device_type'] == 'Smart Plug') {
        $propsDevice = '{\"on_off\":\"false\"}';
    }
    $consumerPropsDevice = $propsDevice;

    $deviceName = $_POST['device_type'];
    $roomid = $_POST['room_id'];
    $sql = "INSERT INTO `devices` (`id`, `room_id`, `device_name`, `properties`, `properties_consumer`) VALUES (NULL, '$roomid', '$deviceName', '$propsDevice', '$consumerPropsDevice');";
    
    if (mysqli_query($conn, $sql)) {
        echo "Succesful";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_close($conn);
    header('Location: user-room-example-producer.php');
}
?>