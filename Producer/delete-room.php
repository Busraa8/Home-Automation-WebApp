<?php
include 'connection.php';

if (isset($_POST['room_id'])) {
    $roomids = $_POST['room_id'];
    $sql = "DELETE FROM devices WHERE room_id = '$roomids'";
    if (mysqli_query($conn, $sql)) {
        echo "Succesful";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    $sql = "DELETE FROM room WHERE id = '$roomids'";
    if (mysqli_query($conn, $sql)) {
        echo "Succesful";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>