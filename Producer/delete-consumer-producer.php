<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "home_automation";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Error: " . $conn->connect_error);
}

// Silinecek ID numarasını al
if (isset($_POST['id'])) {
    $delete_id = $_POST['id'];

    // Silme işlemini gerçekleştir
    $sql = "DELETE FROM user_table WHERE id = '$delete_id'";

    if ($conn->query($sql) === TRUE) {
        echo "User deleted";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Veritabanı bağlantısını kapat
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Automation</title>
    <link rel="stylesheet" href="css/add-consumer.css">
    <script src="https://kit.fontawesome.com/299750f20b.js" crossorigin="anonymous"></script>
</head>

<body>

    <nav class="left-panel">
        <div class="clock">
            <div>
                <span class="time" id="time"></span>
                <span class="am-pm" id="am-pm"></span>
            </div>
        </div>
        <div class="line">
            <hr>
        </div>
        <div class="elements">
            <ul>
                <li onclick="toHome()"><i class="fa-solid fa-house"></i>Home</li>
                <li onclick="toRooms()"><i class="fa-solid fa-door-open"></i>Rooms</li>
                <li onclick="toRequests()"><i class="fa-solid fa-message"></i>Requests</li>
                <li onclick="toDevices()"><i class="fa-solid fa-mobile-screen-button"></i>Devices</li>
                <li onclick="toLogs()"><i class="fa-solid fa-bars"></i>Logs</li>
                <li onclick="toAddUser()"><i class="fa-solid fa-gear"></i>Settings</li>
                <li onclick="toMessage()"><i class="fa-solid fa-message"></i>Message</li>
            </ul>
        </div>
        <div class="extra-content">

        </div>
        <footer>
            <p>© 2023 Home Automation System. All Rights Reserved.</p>
        </footer>
    </nav>
    <header>
        <div class="selections">
            <span class="logout" onclick="logOut()"><i class="fa-solid fa-arrow-right-from-bracket"></i> Log Out</span>
        </div>
    </header>
    <main>

        <div class="add-card">

        <form action="delete-consumer-producer.php" method="POST">
        <label for="id">Silinecek ID:</label>
        <input type="text" name="id">
        <input type="submit" value="Sil">
        </form>


        </div>

    </main>
    <script src="js/script.js"></script>
</body>

</html>