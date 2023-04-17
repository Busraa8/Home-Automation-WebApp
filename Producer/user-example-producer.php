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
        <span>HomeID: <i>123123213</i></span>
    </header>
    <main>
        <div class="title-button">
            <button class="my-button" onclick="goBack()"><i class="fa-solid fa-arrow-left fa-2xl"></i></button>
            <h1>User Name</h1>
        </div>
        <section class="devices-user">
            <div>
                <h2>Devices</h2>
                <hr class="line-device">
            </div>
            <div>
                <div class="user-cards-container">
                    <div class="user-device-card">
                        <img src="images/wifi-icon.png" alt="User Image">
                        <h2>Wi-fi</h2>
                        <hr>
                        <p>Status: <span>On</span></p>
                        <p>Brand: <span>Brand-name</span></p>
                    </div>
                    <div class="user-device-card">
                        <img src="images/thermostat.png" alt="User Image">
                        <h2>Thermostat</h2>
                        <hr>
                        <p>Status: <span>On</span></p>
                        <p>Brand: <span>Brand-name</span></p>
                    </div>
                    <div class="user-device-card">
                        <img src="images/light.png" alt="User Image">
                        <h2>Light</h2>
                        <hr>
                        <p>Status: <span>On</span></p>
                        <p>Brand: <span>Brand-name</span></p>
                    </div>
                    <div class="user-device-card">
                        <img src="images/humidifier.png" alt="User Image">
                        <h2>Humidifier</h2>
                        <hr>
                        <p>Status: <span>Off</span></p>
                        <p>Brand: <span>Brand-name</span></p>
                    </div>
                    <div class="user-device-card">
                        <img src="images/speaker.png" alt="User Image">
                        <h2>Speaker</h2>
                        <hr>
                        <p>Status: <span>Off</span></p>
                        <p>Brand: <span>Brand-name</span></p>
                    </div>
                    <div class="user-device-card">
                        <img src="images/plug.png" alt="User Image">
                        <h2>Smart Plug</h2>
                        <hr>
                        <p>Status: <span>On</span></p>
                        <p>Brand: <span>Brand-name</span></p>
                    </div>
                </div>
            </div>
            <div>
                <h1>Payment Plan</h1>
                <hr class="line-device">
                <p><span>Pro:</span> <span>150,99 USD/month</span> after offer period</p>
            </div>
            <div>
                <h1>Payment Plan</h1>
                <hr class="line-device">
                <p><span>Pro:</span> <span>150,99 USD/month</span> after offer period</p>
            </div>

        </section>
    </main>
    <script src="js/script.js"></script>
</body>

</html>