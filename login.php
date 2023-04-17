<?php
session_start();
if (isset($_POST['login'])) {
    $email = "ahmet@gmail.com";
    $password = 123;
    $role = "producer";

    $email2 = "busra@gmail.com";
    $password2 = 1234;
    $role2 = "consumer";
    
    
    $nameErr = $passwordErr = $emailErr = $passRptErr = $notSame = $numberErr = "";

    if ($_POST["email"] == $email && $_POST["password"] == $password) {
        header("location: ../Producer/home-producer.php");
    }
    if ($_POST["email"] == $email2 && $_POST["password"] == $password2) {
        header("location: homepage.html");
    }
}
?>