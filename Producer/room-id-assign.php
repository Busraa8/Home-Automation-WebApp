<?php 
    session_start();

    if (isset($_POST['room_id'])) {
        $_SESSION['room_id'] = $_POST['room_id'];
    }
?>