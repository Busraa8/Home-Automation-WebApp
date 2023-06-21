<?php

include 'connection.php';
$userid = $_SESSION["userid"];

$sql = "SELECT name FROM user_table Where id = $userid";
$result = mysqli_query($conn, $sql);
$username = "";
while ($row = mysqli_fetch_assoc($result)) {
    $username = $row["name"];
}

?>