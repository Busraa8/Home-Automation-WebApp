<?php session_start();
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
            <span>Consumer: <i>
                    <?php echo $username; ?>
                </i> </span>
            <span class="logout" onclick="logOut()"><i class="fa-solid fa-arrow-right-from-bracket"></i> Log Out</span>
        </div>
    </header>
    <main class="log-content" >
        <table>
            <thead>
                <tr>
                    <th>Log ID</th>
                    <th>Role</th>
                    <th>Room ID</th>
                    <th>Device ID</th>
                    <th>Device Name</th>
                    <th>Previous State</th>
                    <th>New State</th>
                    <th>Change Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Consumer</td>
                    <td>456</td>
                    <td>789</td>
                    <td>Air Conditioner</td>
                    <td>Off</td>
                    <td>On</td>
                    <td>2023-06-27 12:34:56</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Producer</td>
                    <td>789</td>
                    <td>123</td>
                    <td>Air Conditioner</td>
                    <td>On</td>
                    <td>Off</td>
                    <td>2023-06-28 09:45:21</td>
                </tr>
                <!-- Diğer log kayıtlarını buraya ekleyebilirsiniz -->
            </tbody>
        </table>

    </main>
    <script src="js/script.js"></script>
</body>

</html>