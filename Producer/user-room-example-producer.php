<?php   session_start(); 
        
        if (isset($_GET['roomid'])) {
            $roomId = $_GET['roomid'];
            echo $roomId;
            $_SESSION['roomid'] = $roomId;
            // Diğer işlemler...
          }
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
                <li onclick="toRooms()"><i class="fa-solid fa-door-open"></i>Rooms</li>
                <li onclick="toDevices()"><i class="fa-solid fa-mobile-screen-button"></i>Devices</li>
                <li onclick="toSettings()"><i class="fa-solid fa-gear"></i>Settings</li>
                <li onclick="toAddUser()"><i class="fa-solid fa-plus" ></i>Add Consumer</li>

            </ul>
        </div>
        <div class="extra-content">

        </div>
        <footer>
            <p>© 2023 Home Automation System. All Rights Reserved.</p>
        </footer>
    </nav>
    <header>
        <span>Room: <i>Bedroom</i> </span>
    </header>
    <main>
        <div class="title-button">
            <button class="my-button" onclick="goBack()"><i class="fa-solid fa-arrow-left fa-2xl"></i></button>
            <h1>User Name</h1>
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
        </section>
    </main>
    <script src="js/script.js"></script>
</body>

</html>