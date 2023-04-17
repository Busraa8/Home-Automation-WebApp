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

            <form action="consumer_ekle.php" method="POST" enctype="multipart/form-data">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required><br>

                <label for="surname">Surname:</label>
                <input type="text" id="surname" name="surname" required><br>

                <label for="email">E-Mail:</label>
                <input type="email" id="email" name="email" required><br>

                <label for="phone">Telephone:</label>
                <input type="tel" id="phone" name="phone" required><br>

                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required><br>

                <label for="postcode">Post Code:</label>
                <input type="text" id="postcode" name="postcode" required><br>

                <label for="house_size">Size of House:</label>
                <input type="number" id="house_size" name="house_size" required><br>

                <label for="photos">Photo:</label>
                <input type="file" id="photos" name="photos[]" multiple><br>

                <input type="submit" value="Kaydet">
            </form>


        </div>

    </main>
    <script src="js/script.js"></script>
</body>

</html>