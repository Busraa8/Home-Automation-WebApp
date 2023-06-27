<?php session_start();
include 'connection.php';

$roomId = $_SESSION['room_id'];
// Diğer işlemler...

$sql = "SELECT name FROM room Where id = $roomId";
$result = mysqli_query($conn, $sql);
$roomname = "";
while ($row = mysqli_fetch_assoc($result)) {
    $roomname = $row["name"];
}


include 'username.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Automation</title>
    <link rel="stylesheet" href="css/style.css">
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
        <span>Consumer: <i>
                <?php echo $username; ?>
            </i> </span>
        <span class="logout" onclick="logOut()"><i class="fa-solid fa-arrow-right-from-bracket"></i> Log Out</span>
    </header>
    <main>
        <div class="title-button">
            <button class="my-button" onclick="goBack()"><i class="fa-solid fa-arrow-left fa-2xl"></i></button>
            <div class="centered">
                <h1>
                    <?php echo $roomname; ?>
                </h1>
            </div>
        </div>
        <section>
            <div>
                <h2>Devices</h2>
                <hr class="line-device">
                <?php
                ?>
            </div>
            <div>
                <?php include 'device-creator-for-room.php' ?>
            </div>

            <div>
                <hr class="line-device">
            </div>
            <div class="card-operations" >
                <div class="room-form">
                    <h2>Add New Device</h2>
                    <div>
                        <hr>
                    </div>
                    <form action="#">
                        <select id="device-create">
                            <option value="Light">Light</option>
                            <option value="Air Conditioner">Air Conditioner</option>
                            <option value="Speaker">Speaker</option>
                            <option value="Smart Plug">Smart Plug</option>
                            <option value="Wi-Fi">Wi-Fi</option>
                            <option value="Thermostat">Thermostat</option>
                        </select>
                        <button onclick="addDevice(<?php echo $roomId?>)">New Device</button>
                    </form>
                </div>
                <div class="room-form">
                    <h2>Remove Device</h2>
                    <div>
                        <hr>
                    </div>
                    <form action="#">
                        <select id="device-remove">
                            <?php include 'deviceids.php' ?>
                        </select>
                        <button onclick="removeDevice()">Remove</button>
                    </form>
                </div>
            </div>

        </section>
    </main>
    <script src="js/script.js"></script>
</body>

</html>