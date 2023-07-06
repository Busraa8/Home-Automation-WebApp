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
              <i class='fas fa-comment-alt' style='font-size:17px;color:rgb(255, 255, 255)'>&nbsp&nbsp Message</i>
            </button>
          </form>
        </div>

        <div class="sidebar_icon">
          <form action="settings.php" method="GET">
            <button type="submit"
              style="background: none; border: none; padding: 0; font-size: 17px; color: rgb(255, 255, 255);">
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
        </body>

      </div>

      <!-- MAIN -->
      <main class="main">

        <p style="font-family:'Open Sans'; font-size: 34px;">ROOMS</p>

        <div class="box_rooms">
          <div class="container_box">

            <?php
            include 'config.php';

            // Veritabanına bağlanma
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Bağlantıyı kontrol etme
            if ($conn->connect_error) {
              die("Veritabanına bağlanırken bir hata oluştu: " . $conn->connect_error);
            }

            // Odaları veritabanından sorgula
            $sql = "SELECT * FROM room";
            $result = $conn->query($sql);

            function getRoomImage($roomname)
            {
              return 'images/' . strtolower($roomname) . '.jpeg';
            }

            // Sorgu sonuçlarını kullanarak kutucukları oluştur
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                $roomId = $row["id"];
                $roomName = $row["name"];

                echo '<div class="boxes">';
                echo '<a href="dynamic-devices.php?room_id=' . $roomId . '">';
                echo '<img src="' . getRoomImage($roomName) . '" alt="' . $roomName . '">';
                echo '<div class="boxes-text">' . $roomName . '</div>';
                echo '</a>';
                echo '<h2><a href="dynamic-devices.php?room_id=' . $roomId . '">' . $roomName . '</a></h2>';
                echo '</div>';
              }
            } else {
              echo "Hiç oda bulunamadı.";
            }

            // Veritabanı bağlantısını kapat
            $conn->close();
            ?>

          </div>
        </div>

      </main>

    </div>

  </div>
  <script src="clock.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
    integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"
    crossorigin="anonymous"></script>
</body>

</html>