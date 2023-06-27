<?php session_start();

if (isset($_GET['deviceid'])) {
    $deviceId = $_GET['deviceid'];
    $_SESSION['deviceid'] = $deviceId;
}

include 'connection.php';
$sql = "SELECT device_name, properties FROM devices Where id = $deviceId";
$result = mysqli_query($conn, $sql);
$devicename = "";
$deviceprops = "";
while ($row = mysqli_fetch_assoc($result)) {
    $devicename = $row["device_name"];
    $deviceprops = $row["properties"];
}

$jsonData = $deviceprops;

// JSON verisini diziye dönüştür
$properties = json_decode($jsonData, true);
$_SESSION["props"] = $properties ;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Automation</title>
    <link rel="stylesheet" href="css/device-example.css">
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
                <li onclick="toRequests()" id="request-button"><i class="fa-solid fa-message"></i>Requests</li>
                <li onclick="toRooms()"><i class="fa-solid fa-door-open"></i>Rooms</li>
                <li onclick="toDevices()"><i class="fa-solid fa-mobile-screen-button"></i>Devices</li>
                <li onclick="toLogs()"><i class="fa-solid fa-bars"></i>Logs</li>
                <li onclick="toAddUser()"><i class="fa-solid fa-gear"></i>Settings</li>

            </ul>
        </div>
        <div class="extra-content">

        </div>
        <footer>
            <p>© 2023 Home Automation System. All Rights Reserved.</p>
        </footer>
    </nav>
    <header>
        <span>Device ID: <i>
                <?php echo $deviceId ?>
            </i> </span>
            <span class="logout" onclick="logOut()"><i class="fa-solid fa-arrow-right-from-bracket"></i> Log Out</span>
    </header>
    <main>
        <div class="title-button">
            <button class="my-button" onclick="goBack()"><i class="fa-solid fa-arrow-left fa-2xl"></i></button>
            <h1>
                <?php echo $devicename; ?>
            </h1>
        </div>
        <section>
            <div class="device-attributes">
                <h2>Device Properties</h2>
                <hr>
                <div class="order-device">
                    <?php include 'device-properties.php'; ?>
                </div>
                <hr>
                <button id="change-button">Change</button>
            </div>
        </section>
    </main>
    <script src="js/script.js"></script>
</body>

</html>