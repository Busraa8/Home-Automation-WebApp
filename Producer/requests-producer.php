<?php session_start();
include 'username.php'; ?>
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
                <li onclick="toRequests()" id="request-button" ><i class="fa-solid fa-message"></i>Requests</li>
                <li onclick="toRooms()"><i class="fa-solid fa-door-open"></i>Rooms</li>
                <li onclick="toDevices()"><i class="fa-solid fa-mobile-screen-button"></i>Devices</li>
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
        <div class="selections">
            <span>Consumer: <i>
                    <?php echo $username; ?>
                </i> </span>
            <span class="logout" onclick="logOut()"><i class="fa-solid fa-arrow-right-from-bracket"></i> Log Out</span>
        </div>
    </header>
    <main>
        <div class="rooms">
            <h1>Requests in Rooms</h1>
        </div>
        <hr class="line1">
        <div class="request-tables">
            <div class="admin-container">
                <h1 class="admin-title">Bedroom</h1>
                <table class="user-table">
                    <thead>
                        <tr>
                            <?php include 'request-bedroom.php' ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php include 'request-bedroom-data.php' ?>
                        </tr>
                    </tbody>
                </table>
                <h1 class="admin-title">Livingroom</h1>
                <table class="user-table">
                    <thead>
                        <tr>
                            <?php include 'request-livingroom.php' ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php include 'request-livingroom-data.php' ?>
                        </tr>
                    </tbody>
                </table>
                <h1 class="admin-title">Kitchen</h1>
                <table class="user-table">
                    <thead>
                        <tr>
                            <?php include 'request-kitchen.php' ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php include 'request-kitchen-data.php' ?>
                        </tr>
                    </tbody>
                </table>
                <h1 class="admin-title">Entryway</h1>
                <table class="user-table">
                    <thead>
                        <tr>
                            <?php include 'request-entryway.php' ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php include 'request-entryway-data.php' ?>
                        </tr>
                    </tbody>
                </table>
            </div>
            

        </div>


    </main>
    <script src="js/script.js"></script>
</body>
<?php
include 'request-check.php';
?>

</html>