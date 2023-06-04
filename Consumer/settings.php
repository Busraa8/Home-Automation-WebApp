<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "home_automation";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

// Form verilerini al
if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['telephone']) && isset($_POST['surname']) && isset($_POST['address']) && isset($_POST['post_code']) && isset($_POST['room_number']) && isset($_POST['password'])) {
    $id = $_POST['id']; // İd numarasını al

    $name = $_POST['name'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $surname = $_POST['surname'];
    $address = $_POST['address'];
    $post_code = $_POST['post_code'];
    $room_number = $_POST['room_number'];
    $password = $_POST['password'];

    // Verileri veritabanında güncelle
    $sql = "UPDATE user_table SET ";
    
    if (!empty($name)) {
        $sql .= "name = '$name', ";
    }
    if (!empty($email)) {
        $sql .= "email = '$email', ";
    }
    if (!empty($telephone)) {
        $sql .= "telephone = '$telephone', ";
    }
    if (!empty($surname)) {
        $sql .= "surname = '$surname', ";
    }
    if (!empty($address)) {
        $sql .= "address = '$address', ";
    }
    if (!empty($post_code)) {
        $sql .= "post_code = '$post_code', ";
    }
    if (!empty($room_number)) {
        $sql .= "room_number = '$room_number', ";
    }
    if (!empty($password)) {
        $sql .= "password = '$password', ";
    }
    
    // Son karakteri (virgülü) kaldır
    $sql = rtrim($sql, ", ");
    
    $sql .= " WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Kayıt başarıyla güncellendi.";
    } else {
        echo "Hata: " . $sql . "<br>" . $conn->error;
    }
} 

// Veritabanı bağlantısını kapat
$conn->close();
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
            <body style="font-family: 'Open Sans', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                <div style= "height:540px;width:1100px;overflow:auto;border:8px solid rgb(56, 55, 55);padding:2%; margin-top: 40px;border-radius: 8px;position: relative;">

                    <h1><br/>User Settings</h1><br/>
                    <form action= "settings.php" class="settings-form" method="POST">

                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" placeholder="Your Name">

                    <label for="surname">Surname:</label>
                    <input type="text" id="surname" name="surname" placeholder="Your Surname">
                    
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="Your Email">

                    <label for="email">Telephone:</label>
                    <input type="email" id="telephone" name="email" placeholder="Your Telephone">

                    
                    
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" placeholder="Your Password">
                    
            
                    <label for="id" style="font-size: 15px">Role</label>
                         <select name="id" id="id">
                              <option value="2">Consumer</option>
                         </select><br><br>
    
                    <input type="submit" value="Submit">
                </form>

                </div>
                
            </body>

           

        </main>

      </div>

    </div>
    <script src="clock.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

</html>