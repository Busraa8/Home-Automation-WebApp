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
    <main class="log-content">
        <table>
            <thead>
                <tr>
                    <th>Role</th>
                    <th>Room ID</th>
                    <th>Device Name</th>
                    <th>Previous State</th>
                    <th>New State</th>
                    <th>Request</th>
                    <th>Change Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM logs";
                $result = mysqli_query($conn, $sql);
                $data = array();
                while ($row = mysqli_fetch_assoc($result)) {
                    $data[] = array('role' => $row['role'], 'room_id' => $row['room_id'], 'device_name' => $row['device_name'], 'previous_state' => $row['previous_state'], 'new_state' => $row['new_state'], 'change_date' => $row['date'], 'request' => $row['request']);
                }

                $data = array_reverse($data);

                foreach ($data as $item) {
                    $role = $item['role'];
                    $room_id = $item['room_id'];
                    $device_name = $item['device_name'];
                    $previous_state = $item['previous_state'];
                    $new_state = $item['new_state'];
                    $request = $item['request'];
                    $change_date = $item['change_date'];
                    echo '<tr>';
                    echo '<td>'. $role .'</td>';
                    echo '<td>'. $room_id .'</td>';
                    echo '<td>'. $device_name .'</td>';
                    echo '<td>'. $previous_state .'</td>';
                    echo '<td>'. $new_state .'</td>';
                    echo '<td>'. $request .'</td>';
                    echo '<td>'. $change_date .'</td>';
                    echo '<tr>';
                }
                ?>
                <!-- Diğer log kayıtlarını buraya ekleyebilirsiniz -->
            </tbody>
        </table>

    </main>
    <script src="js/script.js"></script>
</body>

</html>