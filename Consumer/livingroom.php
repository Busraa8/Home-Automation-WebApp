<?php
include 'config.php';

// Veritabanı bağlantısı oluştur
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Checkbox durumlarını al
  $lightOnOff = isset($_POST['light']) ? 'true' : 'false';
  $acOnOff = isset($_POST['air_conditioner']) ? 'true' : 'false';
  $speakerOnOff = isset($_POST['speaker']) ? 'true' : 'false';

  // Güncelleme işlemi için SQL sorgularını oluştur ve çalıştır
  $stmtLight = $conn->prepare("UPDATE devices SET properties_customer = JSON_SET(properties_customer, '$.on_off', ?) WHERE room_id = 4 AND device_name = 'Light'");
  $stmtLight->bind_param("s", $lightOnOff);
  
  $stmtAC = $conn->prepare("UPDATE devices SET properties_customer = JSON_SET(properties_customer, '$.on_off', ?) WHERE room_id = 4 AND device_name = 'Air Conditioner'");
  $stmtAC->bind_param("s", $acOnOff);

  $stmtSpeaker = $conn->prepare("UPDATE devices SET properties_customer = JSON_SET(properties_customer, '$.on_off', ?) WHERE room_id = 4 AND device_name = 'Speaker'");
  $stmtSpeaker->bind_param("s", $speakerOnOff);
  
  $success = true;
  
  if (!$stmtLight->execute()) {
      echo "Hata (Light): " . $stmtLight->error;
      $success = false;
  }
  
  if (!$stmtAC->execute()) {
      echo "Hata (Air Conditioner): " . $stmtAC->error;
      $success = false;
  }

  if (!$stmtSpeaker->execute()) {
    echo "Hata (Speaker): " . $stmtSpeaker->error;
    $success = false;
  }
  
  $stmtLight->close();
  $stmtAC->close();
  $stmtSpeaker->close();
  
  if ($success) {
  } else {
      echo "Güncelleme sırasında hata oluştu";
  }
}

// Durumu veritabanından çek
$sql = "SELECT JSON_EXTRACT(properties, '$.on_off') AS light_status FROM devices WHERE room_id = 4 AND device_name = 'Light'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $lightStatus = $row["light_status"];
} else {
}

$sqlAC = "SELECT JSON_EXTRACT(properties, '$.on_off') AS ac_status FROM devices WHERE room_id = 4 AND device_name = 'Air Conditioner'";
$resultAC = $conn->query($sqlAC);

if ($resultAC->num_rows > 0) {
    $rowAC = $resultAC->fetch_assoc();
    $acStatus = $rowAC["ac_status"];
} else {
}

$sqlSpeaker = "SELECT JSON_EXTRACT(properties, '$.on_off') AS speaker_status FROM devices WHERE room_id = 4 AND device_name = 'Speaker'";
$resultSpeaker = $conn->query($sqlSpeaker);

if ($resultSpeaker->num_rows > 0) {
    $rowSpeaker = $resultSpeaker->fetch_assoc();
    $speakerStatus = $rowSpeaker["speaker_status"];
} else {
}

// Veritabanı bağlantısını kapat
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="livingroom.css">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link
    href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,600,700"
    rel="stylesheet"
  />
  <script
    src="https://kit.fontawesome.com/37b0ae8922.js"
    crossorigin="anonymous"
  ></script>
  </head>
  

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
            <a href="homepage.html">
                <i class='fas fa-home' style='font-size:17px;color:rgb(255, 255, 255)'>&nbsp&nbsp Home</i>
            </a>
          </div>

      <div class="sidebar_icon">
        <a href="rooms.html">

            <i  class='fas fa-th' style='font-size:17px;color:rgb(255, 255, 255)'>&nbsp&nbsp Rooms</i>

        </a>
      </div>

  


      <div class="sidebar_icon">
        <form action="settings.php" method="GET">
          <button type="submit" style="background: none; border: none; padding: 0; font-size: 17px; color: rgb(255, 255, 255);">
            <i class='fas fa-cog' style='font-size:17px;color:rgb(255, 255, 255)'>&nbsp&nbsp Settings</i>
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


        </div>

        

        <!-- MAIN -->
        <main class="main">
            

            <div class="containert containertl">
                
            </div>

            <div class="containert">
                <p style="font-size: 15px; color: whitesmoke;">Temperature</p>
                
                <div class="status-panel">
                  <div class="status-card">
                    
                    <span id="living-room-temp" >25&deg;C</span>
                    <h3 style="text-align: center;color: whitesmoke;">Temperature</h3><br/><br/><br/><br/>
                    <input type="range" id="living-room-temp-input" min="10" max="35" step="1" style="color:aliceblue">
                
                  </div>
                  
                </div>
                
            </div>

            <div class="containert">
                <p style="font-size: 15px; color: whitesmoke;">Light</p>
                
                <div class="status-panel">
                  <div class="status-card">
                    
                    <span id="living-room-light-value" >20&deg;C</span>
                    <h3 style="text-align: center;color: whitesmoke;">Light</h3><br/><br/><br/><br/>
                    <input type="range" id="living-room-light-input" min="10" max="30" step="1" style="color:aliceblue">
                
                  </div>
                  
                </div>
                
            </div>

            <div class="containert">
                <p style="font-size: 15px; color: whitesmoke;">Speaker</p>
                
                <div class="status-panel">
                  <div class="status-card">
                    
                    <span id="living-room-speaker-value" >25&deg;C</span>
                    <h3 style="text-align: center;color: whitesmoke;">Speaker</h3><br/><br/><br/><br/>
                    <input type="range" id="living-room-speaker-input" min="10" max="30" step="1" style="color:aliceblue">
                
                  </div>
                  
                </div>
                
            </div>
             
            <form method="post" action="livingroom.php">
            <div style="height:220px;width:1190px;overflow:auto;border:8px solid rgb(56, 55, 55);padding:2%; margin-top: 380px;margin-right:20px; margin-left: -1180px;border-radius: 8px;position: relative;">
                <div class="container_box">
                
                    <div class="boxes boxesl"><br>
                        <label class="btn-onoffd" >
                        <input type="checkbox" name="light" data-onoff="toggle" <?php if ($lightStatus === 'true') echo 'checked'; ?>><span></span>	
                            
                        </label>
                    </div>
                    <div class="boxes boxesh"><br>
                        <label class="btn-onoffd" >
                        <input type="checkbox" name="air_conditioner" data-onoff="toggle" <?php if ($acStatus === 'true') echo 'checked'; ?>><span></span>	
                        </label>
                    </div>
                    
                    <div class="boxes boxess"><br>
                        <label class="btn-onoffd" >
                            <input type="checkbox" name="speaker" data-onoff="toggle"<?php if ($speakerStatus === 'true') echo 'checked'; ?>><span></span>	
                        </label>
                    </div>
                   
            
            </div>
            <button type="submit" class="header__pro" >Update</button>
            </form>
            </div><br/>
            
            
            </div>
        </div>
            

        </main>
        

      </div>

    </div>
    <script src="livingroom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="clock.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

</html>