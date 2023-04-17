<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Automation</title>
    <link rel="stylesheet" href="css/style.css">
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
            <span>Yazi</span>
            <span>Yazi</span>
            <span>Yazi</span>
            <span class="logout" onclick="logOut()"><i class="fa-solid fa-arrow-right-from-bracket"></i> Log Out</span>
        </div>
    </header>
    <main>
        <div class="users" onclick="toUsers()">
            <h1>Users</h1>
            <div class="cards-container">
                <div class="card">
                    <img src="images/user.png" alt="User Image">
                    <h2>User ID 1</h2>
                    <p>User Name</p>
                </div>
                <div class="card">
                    <img src="images/user.png" alt="User Image">
                    <h2>User ID 2</h2>
                    <p>User Name</p>
                </div>
                <div class="card">
                    <img src="images/user.png" alt="User Image">
                    <h2>User ID 3</h2>
                    <p>User Name</p>
                </div>
                <i class="fa-solid fa-plus fa-2xl"></i>
            </div>
        </div>

        <hr class="line1">

        <div class="devices" onclick="toDevices()">
            <h1>Devices</h1>
            <div class="device-cards-container">
                <div class="device-card">
                    <img src="images/wifi-icon.png" alt="User Image">
                    <h2>Wi-fi</h2>
                </div>
                <div class="device-card">
                    <img src="images/thermostat.png" alt="User Image">
                    <h2>Thermostat</h2>
                </div>
                <div class="device-card">
                    <img src="images/light.png" alt="User Image">
                    <h2>Light</h2>
                </div>
                <i class="fa-solid fa-plus fa-2xl"></i>
            </div>
        </div>


    </main>
    <script src="js/script.js"></script>
</body>

</html>