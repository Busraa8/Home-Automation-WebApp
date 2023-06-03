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
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['telephone']) && isset($_POST['surname']) && isset($_POST['address']) && isset($_POST['post_code']) && isset($_POST['room_number']) && ($_POST['role']) && ($_POST['password'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $surname = $_POST['surname'];
    $address = $_POST['address'];
    $post_code = $_POST['post_code'];
    $room_number = $_POST['room_number'];
    $role = $_POST['role'];
    $password = $_POST['password'];

    // Form alanlarının dolu olup olmadığını kontrol et
    if (!empty($name) && !empty($email) && !empty($telephone) && !empty($surname) && !empty($address) && !empty($post_code) && !empty($room_number) && !empty($role) && !empty($password)) {
        // Verileri veritabanına ekle
        $sql = "INSERT INTO user_table (name, email, telephone, surname, address, post_code, room_number, role, password) VALUES ('$name', '$email', '$telephone', '$surname', '$address', '$post_code', '$room_number', '$role', '$password')";

        if ($conn->query($sql) === TRUE) {
            echo "Kayıt başarıyla eklendi.";
        } else {
            echo "Hata: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Kullanıcı adı ve e-posta boş bırakılamaz.";
    }
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
                <li onclick="toUsers()"><i class="fa-solid fa-user"></i>Users</li>
                <li onclick="toDevices()"><i class="fa-solid fa-mobile-screen-button"></i>Devices</li>
                <li onclick="toSettings()"><i class="fa-solid fa-gear"></i>Settings</li>
                <li onclick="toAddUser()"><i class="fa-solid fa-plus"></i>Add Consumer</li>
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

           <label for="role">Role:</label>
           <select name="role" id="role">
           <option value="consumer">Consumer</option>
           <option value="producer">Producer</option>
           </select><br><br>
    
           <input type="submit" value="Submit">
        </form>


        </div>

    </main>
    <script src="js/script.js"></script>
</body>

</html>