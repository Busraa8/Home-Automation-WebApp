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
                <<li onclick="toRooms()"><i class="fa-solid fa-door-open"></i>Rooms</li>
                <li onclick="toDevices()"><i class="fa-solid fa-mobile-screen-button"></i>Devices</li>
                <li onclick="toSettings()"><i class="fa-solid fa-gear"></i>Settings</li>
                <li onclick="toLogs()"><i class="fa-solid fa-bars"></i>Logs</li>
                <li onclick="toAddUser()"><i class="fa-solid fa-plus" ></i>Add Consumer</li>
                <li onclick="toMessage()"><i class="fa-solid fa-message"></i>Message</li>
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
        <div class="title-button">
            <button class="my-button" onclick="goBack()"><i class="fa-solid fa-arrow-left fa-2xl"></i></button>
            <h1>Users</h1>
        </div>

        <div class="cards-container">
            <div class="card" onclick="toUser()">
                <img src="images/user.png" alt="User Image">
                <h2>User ID 1</h2>
                <p>User Name</p>
            </div>
            <div class="card" onclick="toUser()">
                <img src="images/user.png" alt="User Image">
                <h2>User ID 2</h2>
                <p>User Name</p>
            </div>
            <div class="card" onclick="toUser()">
                <img src="images/user.png" alt="User Image">
                <h2>User ID 3</h2>
                <p>User Name</p>
            </div>
            <div class="card" onclick="toUser()">
                <img src="images/user.png" alt="User Image">
                <h2>User ID 3</h2>
                <p>User Name</p>
            </div>
            <div class="card" onclick="toUser()">
                <img src="images/user.png" alt="User Image">
                <h2>User ID 3</h2>
                <p>User Name</p>
            </div>
            <div class="card" onclick="toUser()">
                <img src="images/user.png" alt="User Image">
                <h2>User ID 3</h2>
                <p>User Name</p>
            </div>
            <div class="card" onclick="toUser()">
                <img src="images/user.png" alt="User Image">
                <h2>User ID 3</h2>
                <p>User Name</p>
            </div>
            <div class="card" onclick="toUser()">
                <img src="images/user.png" alt="User Image">
                <h2>User ID 3</h2>
                <p>User Name</p>
            </div>
            <div class="card" onclick="toUser()">
                <img src="images/user.png" alt="User Image">
                <h2>User ID 3</h2>
                <p>User Name</p>
            </div>
        </div>
    </main>
    <script src="js/script.js"></script>
</body>

</html>