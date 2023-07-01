<?php
include 'config.php';

// Veritabanı bağlantısı oluştur
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
  die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

// Oda kimliğini al
if (isset($_GET['room_id'])) {
  $roomId = $_GET['room_id'];

  // Odayı veritabanından çek
  $stmtRoom = $conn->prepare("SELECT * FROM room WHERE id = ?");
  $stmtRoom->bind_param("i", $roomId);
  $stmtRoom->execute();
  $resultRoom = $stmtRoom->get_result();
  $rowRoom = $resultRoom->fetch_assoc();

  $roomName = $rowRoom["name"];

  echo "<h2>$roomName</h2>";

  // Odadaki cihazları veritabanından çek
  $stmtDevices = $conn->prepare("SELECT * FROM devices WHERE room_id = ?");
  $stmtDevices->bind_param("i", $roomId);
  $stmtDevices->execute();
  $resultDevices = $stmtDevices->get_result();

  // Cihazları döngüyle gez
  while ($rowDevice = $resultDevices->fetch_assoc()) {
    $deviceId = $rowDevice["id"];
    $deviceName = $rowDevice["device_name"];

    echo "<h3>$deviceName</h3>";

    // Cihazın durumunu veritabanından çek
    $stmtStatus = $conn->prepare("SELECT JSON_UNQUOTE(JSON_EXTRACT(properties, '$.on_off')) AS status FROM devices WHERE id = ?");
    $stmtStatus->bind_param("i", $deviceId);
    $stmtStatus->execute();
    $resultStatus = $stmtStatus->get_result();
    $rowStatus = $resultStatus->fetch_assoc();
    $status = $rowStatus["status"];

    echo "<p>Status: $status</p>";

    // Durumu güncelleme formunu oluştur
    echo "<form method='post' action=''>";
    echo "<input type='hidden' name='device_id' value='$deviceId'>";
    echo "<label>";
    echo "<input type='checkbox' name='on_off_button' value='on' onchange='this.form.submit()' ";
    if ($status == 'on') {
      echo "checked";
    }
    echo ">";
    echo "Aç/Kapat";
    echo "</label>";
    echo "</form>";
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['on_off_button'])) {
      $deviceId = $_POST['device_id'];
      $status = isset($_POST['on_off_button']) ? 'on' : 'off';

      // Cihazın durumunu güncelle
      $stmtUpdate = $conn->prepare("UPDATE devices SET properties = JSON_SET(properties, '$.on_off', ?) WHERE id = ?");
      $stmtUpdate->bind_param("si", $status, $deviceId);

      if ($stmtUpdate->execute()) {
        echo "Durum güncellendi";
      } else {
        echo "Hata oluştu: " . $stmtUpdate->error;
      }

      $stmtUpdate->close();
    }
  }

  $stmtDevices->close();
  $stmtStatus->close();
  $stmtRoom->close();
}

$conn->close();
?>
