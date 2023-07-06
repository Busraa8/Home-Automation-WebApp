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
                            <i class='fas fa-cog' style='font-size:17px;color:rgb(255, 255, 255)'>&nbsp&nbsp Rooms</i>
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

                <p style="font-family:'Open Sans'; font-size: 34px; ">
                    <?php
                    include 'config.php';

                    // Veritabanı bağlantısı oluştur
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Bağlantıyı kontrol et
                    if ($conn->connect_error) {
                        die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
                    }

                    $roomId = $_GET['room_id'];

                    // Odanın adını al
                    $sql = "SELECT name FROM room WHERE id = '$roomId'";
                    $result = mysqli_query($conn, $sql);
                    $roomName = "";

                    if ($row = mysqli_fetch_assoc($result)) {
                        $roomName = $row['name'];
                    }

                    echo "" . $roomName;
                    ?>

                </p> <br/><br/><br/>

                <div class="box_rooms">
                    <div class="container_box">

                        <?php

                        $sql = "SELECT device_name, id
                            FROM devices
                            WHERE room_id = '$roomId' ";

                        $result = mysqli_query($conn, $sql);
                        $data = array();

                        while ($row = mysqli_fetch_assoc($result)) {
                            $data[] = array('id' => $row['id'], 'name' => $row['device_name']); // Her name değerini diziye ekle
                        }

                        foreach ($data as $item) {
                            $id = $item['id'];
                            $deviceName = $item['name'];

                            $sql = "SELECT device_name, properties FROM devices WHERE id = $id";
                            $result = mysqli_query($conn, $sql);

                            $devicename = "";
                            $deviceprops = "";

                            while ($row = mysqli_fetch_assoc($result)) {
                                $devicename = $row["device_name"];
                                $deviceprops = $row["properties"];
                            }

                            $jsonData = $deviceprops;
                            $properties = json_decode($jsonData, true);

                            echo '<div class="boxes"';

                            // arka plan
                            if ($deviceName == "Light") {
                                echo " style='background-image: url(images/light.jpeg);'";
                            }

                            if ($deviceName == "Thermostat") {
                                echo " style='background-image: url(images/thermostat.jpeg);'";
                            }

                            if ($deviceName == "Air Conditioner") {
                                echo " style='background-image: url(images/air.jpeg);'";
                            }

                            if ($deviceName == "Wi-Fi") {
                                echo " style='background-image: url(images/wifi.jpeg);'";
                            }

                            if ($deviceName == "Smart Plug") {
                                echo " style='background-image: url(images/smartplug.jpeg);'";
                            }

                            if ($deviceName == "Speaker") {
                                echo " style='background-image: url(images/smartplug.jpeg);'";
                            }

                            echo '>';
                            echo "<div class='user-device-card' onclick='toDevice($id)'>";
                            echo "<div class='boxes-text'>" . $deviceName . "</div>";
                            echo '</a>';
                            echo '</div>';
                            echo '</div>';
                        }
                        ?>

                    </div>
                </div>

            </main>

        </div>

    </div>
    <script src="devices.js"></script>
    <script src="clock.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
        integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"
        crossorigin="anonymous"></script>
</body>

</html>

