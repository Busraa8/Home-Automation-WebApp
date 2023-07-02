<?php
session_start();
include 'username.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "home_automation";

// Veritabanı bağlantısını oluştur
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

// Verileri çekmek için SQL sorgusunu oluştur
$sql = "SELECT id, email, message, date, status FROM message";

// Sorguyu veritabanında çalıştır ve sonuçları al
$result = $conn->query($sql);

// Okundu durumunu güncelle
if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = $_GET['id'];
    $status = $_GET['status'];

    // Güncelleme sorgusunu hazırla ve çalıştır
    $updateSql = "UPDATE message SET status = $status WHERE id = $id";
    $conn->query($updateSql);
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

    <style>
    .status-link {
        text-decoration: none; /* Çizgiyi kaldır */
        color: inherit;
    }
</style>

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
    </header><br><br><br>
    <main class="log-content">
        <table>
            <thead>
                <tr>
                    <th>Email</th>
                    <th rowspan="34">Message</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Sonuçları döngüye alarak tablo içinde görüntüle
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {

                        $id = $row['id'];
                        $status = $row['status'];
                        $statusText = $status == 0 ? 'Unread' : 'Read';

                        echo "<tr>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["message"] . "</td>";
                        echo "<td>" . $row["date"] . "</td>";
                        echo "<td><a href='#' onclick='updateStatus($id, " . ($status == 0 ? 1 : 0) . ")' class='status-link'>$statusText</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Veri bulunamadı</td></tr>";
                }

                // Veritabanı bağlantısını kapat
                $conn->close();
                ?>
            </tbody>
        </table>

    </main>
    <script src="js/script.js"></script>
    <script>
        function updateStatus(id, status) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Sayfayı güncelle
                    location.reload();
                }
            };
            xhttp.open("GET", "?id=" + id + "&status=" + status, true);
            xhttp.send();
        }
    </script>
</body>

</html>


