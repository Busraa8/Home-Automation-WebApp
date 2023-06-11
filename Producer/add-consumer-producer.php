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

    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $telephone = filter_var($_POST['telephone'], FILTER_SANITIZE_STRING);
    $surname = filter_var($_POST['surname'], FILTER_SANITIZE_STRING);
    $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
    $post_code = filter_var($_POST['post_code'], FILTER_SANITIZE_STRING);
    $room_number = filter_var($_POST['room_number'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

    // Şifreyi karma işlemine tabi tut
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
else {
  
}

// Veritabanı bağlantısını kapat
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Automation</title>
    <link rel="stylesheet" href="css/add-consumer.css">
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
            <span class="logout" onclick="logOut()"><i class="fa-solid fa-arrow-right-from-bracket"></i> Log Out</span>
        </div>
    </header>
    <main>

        <div class="add-card">

        <form action="add-consumer-producer.php" method="POST">

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
                    <option value="1">Producer</option>
                </select><br><br>
    
           <input type="submit" value="Submit">
        </form>


        </div>

    </main>
    <script src="js/script.js"></script>
</body>

</html>