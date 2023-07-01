<?php
include 'config.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

// Form verilerini al
if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['telephone']) && isset($_POST['surname']) && isset($_POST['address']) && isset($_POST['post_code']) && isset($_POST['room_number']) && isset($_POST['password'])) {
    $id = $_POST['id']; 

    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $telephone = filter_var($_POST['telephone'], FILTER_SANITIZE_STRING);
    $surname = filter_var($_POST['surname'], FILTER_SANITIZE_STRING);
    $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
    $post_code = filter_var($_POST['post_code'], FILTER_SANITIZE_STRING);
    $room_number = filter_var($_POST['room_number'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);


    // Şifreyi karma
    $hashedPassword = sha1($password);

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
    if (!empty($hashedPassword)) {
        $sql .= "password = '$hashedPassword', ";
    }
    
    //virgülü kaldır
    $sql = rtrim($sql, ", ");
    
    $sql .= " WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
       
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
                <form action="rooms.php" method="GET">
                  <button type="submit" style="background: none; border: none; padding: 0; font-size: 17px; color: rgb(255, 255, 255);">
                    <i class='fas fa-cog' style='font-size:17px;color:rgb(255, 255, 255)'>&nbsp&nbsp Rooms</i>
                  </button>
                </form>
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
           
           <h1><br/> User Settings </h1><br/>

           <form action="settings.php" method="POST">

           <label for="name" style= "font-size: 15px">Name</label>
           <input type="text" name="name" id="username"><br><br>

           <label for="surname" style= "font-size: 15px">Surname</label>
           <input type="text" name="surname" id="username"><br><br>

           <label for="email" style= "font-size: 15px">Email</label>
           <input type="email" name="email" id="email"><br><br>

           <label for="telephone" style= "font-size: 15px">Telephone</label>
           <input type="text" name="telephone" id="telephone"><br><br>

           <label for="address" style= "font-size: 15px">Address</label>
           <input type="text" name="address" id="address"><br><br>

           <label for="post_code" style= "font-size: 15px">Post Code</label>
           <input type="text" name="post_code" id="post_code"><br><br>

           <label for="room_number" style= "font-size: 15px">Room Number</label>
           <input type="text" name="room_number" id="room_number"><br><br>

           <label for="password" style= "font-size: 15px">Password</label>
           <input type="text" name="password" id="password"><br><br>

           <label for="id" style="font-size: 15px">Role</label>
                <select name="id" id="id">
                    <option value="2">Consumer</option>
                </select><br><br>
    
           <input type="submit" class="header__pro" value="Submit">
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