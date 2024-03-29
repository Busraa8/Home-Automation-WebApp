<?php
session_start();
include 'config.php';

// Veritabanı bağlantısı oluştur
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

$deviceId = $_GET["deviceid"];
$sql = "SELECT d.device_name, r.name AS room_name, d.properties FROM devices d INNER JOIN room r ON d.room_id = r.id WHERE d.id = $deviceId";
$result = mysqli_query($conn, $sql);

$devicename = "";
$roomname = "";
$deviceprops = "";

while ($row = mysqli_fetch_assoc($result)) {
    $devicename = $row["device_name"];
    $roomname = $row["room_name"];
    $deviceprops = $row["properties"];
}

$jsonData = $deviceprops;
$properties = json_decode($jsonData, true);
$_SESSION["props"] = $properties;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="rooms.css">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
        integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,600,700" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/37b0ae8922.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="dash">

        <!-- HEADER -->
        <header class="header">
            <div class="header__options">
                <a href="../select.php" class="header__pro">Log out</a>
            </div>
        </header>

        <!-- BODY -->
        <div class="body">

            <!-- SIDEBAR -->
            <div class="sidebar">

                <div class="sidebar_icon">
                    <a href="homepage.php">
                        <i class='fas fa-home' style='font-size:17px;color:rgb(255, 255, 255)'>&nbsp&nbsp Home</i>
                    </a>
                </div>

                <div class="sidebar_icon">
                    <form action="rooms.php" method="GET">
                        <button type="submit"
                            style="background: none; border: none; padding: 0; font-size: 17px; color: rgb(255, 255, 255);">
                            <i class='fas fa-th' style='font-size:17px;color:rgb(255, 255, 255)'>&nbsp&nbsp Rooms</i>
                       </button>
                    </form>
                </div>

                <div class="sidebar_icon">
                    <form action="post-message.php" method="GET">
                        <button type="submit"
                            style="background: none; border: none; padding: 0; font-size: 17px; color: rgb(255, 255, 255);">
                            <i class='	fas fa-comment-alt' style='font-size:17px;color:rgb(255, 255, 255)'>&nbsp&nbsp Message</i>
                        </button>
                    </form>
                </div>

                <div class="sidebar_icon">
                    <form action="settings.php" method="GET">
                        <button type="submit"
                            style="background: none; border: none; padding: 0; font-size: 17px; color: rgb(255, 255, 255);">
                            <i class='fas fa-cog' style='font-size:17px;color:rgb(255, 255, 255)'>&nbsp&nbsp
                                Settings</i>
                        </button>
                    </form>
                </div>

                <body onLoad="initClock()">
                    <div id="timedate">
                        <a id="mon">January</a>
                        <a id="d">1</a>,
                        <a id="y">0</a><br />
                        <a id="h">12</a> :
                        <a id="m">00</a>:
                        <a id="s">00</a>
                    </div>
                </body>

            </div>

            <!-- MAIN -->

            <main class="main">
                <div class="box_roomss" style="height:150px;width:1190px;overflow:auto;border:8px solid whitesmoke;padding:2%;border-radius: 8px;position: relative;margin-left:-20px;margin-top:20px;">
                    <p style="font-family:'Open Sans'; font-size: 34px; height:20px; weight: 1000px; margin-top:10px;"><?php echo strtoupper($roomname) . "-" . strtoupper($devicename); ?></p>
                </div>

                <div class="box_rooms" style="height:280px;width:1190px;overflow:auto;border:8px solid rgb(56, 55, 55);padding:2%;border-radius: 8px;position: relative;margin-top: 160px; margin-left:-1190px;">
                    <div class="container_box" style="display: flex; flex-direction: column; max-width: 500px;">
                        <?php include 'device-properties.php'; ?>
                        <button id="change-button" class="header__change">Change</button>
                    </div>
                </div>
            </main>

        </div>

    </div>
    <script src="devices.js"></script>
    <script>
        var changeButton = document.getElementById('change-button');
        changeButton.addEventListener('click', function () {
            var deviceidnew = <?php echo $deviceId; ?>;
            // AJAX ile HTTP isteği gönderme
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'change-submit.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    
                } else {}
            };
            var params =
                "onof=" + encodeURIComponent(onOffValue) +
                "&volume=" + encodeURIComponent(volume) +
                "&temperature=" + encodeURIComponent(temperature) +
                "&brightness=" + encodeURIComponent(brightness) +
                "&deviceidnew=" + encodeURIComponent(deviceidnew) +
                "&connectionv=" + encodeURIComponent(connectionv);
            xhr.send(params);
            
            alert("Değişiklikler başarıyla kaydedildi.");
        });
    </script>
    <script src="clock.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
        integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"
        crossorigin="anonymous"></script>
</body>

</html>

