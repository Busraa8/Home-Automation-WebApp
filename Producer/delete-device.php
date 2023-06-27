<?php
include 'connection.php';

session_start();

$propsDevice = "";
$consumerPropsDevice = "";

if (isset($_POST['device_ids'])) {
    $deviceids = $_POST['device_ids'];
    $sql = "DELETE FROM devices WHERE id = '$deviceids'";
    
    if (mysqli_query($conn, $sql)) {
        echo "Succesful";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>