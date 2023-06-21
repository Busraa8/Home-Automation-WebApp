<?php
include 'connection.php';

if (isset($_POST['room_type'])) {
    $roomName = $_POST['room_type'];
    $sql = "INSERT INTO `room` VALUES (NULL, '$roomName', '2');";
    if (mysqli_query($conn, $sql)) {
        echo "Succesful";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>