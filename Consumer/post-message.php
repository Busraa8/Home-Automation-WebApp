<?php
session_start();

$error = $msg = '';

if (isset($_POST['submit'])) {
    $message = $_POST['message'];
    
    // Saat dilimini ayarla (örneğin: Türkiye saat dilimi)
    date_default_timezone_set('Europe/Istanbul');
    
    // Tarih ve saat bilgisini al
    $datetime = date('Y-m-d H:i:s');
    $status = 'pending';

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "home_automation";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Assuming 'user_table' is the name of your user table
    $query = "SELECT email FROM user_table WHERE role = 'consumer'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email = $row['email'];

        $stmt = $conn->prepare("INSERT INTO message (email, message, date, status) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $email, $message, $datetime, $status);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $msg = "Message saved successfully.";
            $_SESSION['msg'] = $msg; // Store success message in session variable
            header("Location: ".$_SERVER['PHP_SELF']); // Redirect to clear POST data
            exit;
        } else {
            $error = "Error occurred while saving message.";
        }

        $stmt->close();
    } else {
        $error = "No consumer found in the user table.";
    }

    $conn->close();
}

// Check if success message is stored in session variable
if (isset($_SESSION['msg'])) {
    $msg = $_SESSION['msg'];
    unset($_SESSION['msg']); // Remove success message from session
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="settings.css">
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
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
            <i class='fas fa-home' style='font-size:17px;color:rgb(255, 255, 255)'> Home</i>
          </a>
        </div>

        <div class="sidebar_icon">
          <form action="rooms.php" method="GET">
            <button type="submit" style="background: none; border: none; padding: 0; font-size: 17px; color: rgb(255, 255, 255);">
              <i class='fas fa-cog' style='font-size:17px;color:rgb(255, 255, 255)'> Rooms</i>
            </button>
          </form>
        </div>

        <div class="sidebar_icon">
                <form action="post-message.php" method="GET">
                  <button type="submit" style="background: none; border: none; padding: 0; font-size: 17px; color: rgb(255, 255, 255);">
                    <i class='fas fa-cog' style='font-size:17px;color:rgb(255, 255, 255)'> Message</i>
                  </button>
                </form>
              </div>

        <div class="sidebar_icon">
          <form action="settings.php" method="GET">
            <button type="submit" style="background: none; border: none; padding: 0; font-size: 17px; color: rgb(255, 255, 255);">
              <i class='fas fa-cog' style='font-size:17px;color:rgb(255, 255, 255)'> Settings</i>
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
        <div style="height:540px;width:1100px;overflow:auto;border:8px solid rgb(56, 55, 55);padding:2%; margin-top: 40px;border-radius: 8px;position: relative;">
          <h1><br/> POST A MESSAGE </h1><br/>
          <?php if ($error) { ?>
            <div class="errorWrap"><strong>ERROR</strong>: <?php echo htmlentities($error); ?></div>
          <?php } else if ($msg) { ?>
            <div class="succWrap"><strong>SUCCESS</strong>: <?php echo htmlentities($msg); ?></div>
          <?php } ?>

          <form action="" method="POST"><br/>
            <label for="message" style="font-size: 15px">Message</label><br/>
            <textarea class="form-control white_bg" name="message" rows="8" required=""></textarea><br/><br/>
            <input type="submit" name="submit" class="header__pro" value="Save">
          </form>
        </div>
      </main>
    </div>
  </div>

  <script src="clock.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</body>

</html>

