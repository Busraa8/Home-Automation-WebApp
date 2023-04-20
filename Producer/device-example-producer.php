<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Automation</title>
    <link rel="stylesheet" href="css/device-example.css">
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
        <span>Device ID: <i>123</i> </span> 
    </header>
    <main>
        <div class="title-button">
            <button class="my-button" onclick="goBack()"><i class="fa-solid fa-arrow-left fa-2xl"></i></button>
            <h1>Device Name</h1>
        </div>
        <section>
            <div class="features">
                <h2>Features</h2>
                <ul>
                    <li>Energy Consumption: <span> info </span></li>
                    <li>Status: <span> info </span></li>
                    <li>Brand: <span> info </span></li>
                </ul>
                <h2>Informations</h2>
                <ul>
                    <li>Cost: <span> info </span></li>
                </ul>
            </div>
            <div class="set">
                <h2>Settings</h2>
                <ul>
                    <li>Status: <span> <i onclick="toggle()" id="toggle" class="fa-solid fa-toggle-on fa-2xl"></i>
                        </span></li>
                    <li>C°: <input type="text" name="" id=""></li>
                    <li>Speed:
                        <Select>
                            <option value="">Choose an option</option>
                            <option value="fast">Fast</option>
                            <option value="medium">Medium speed</option>
                            <option value="slow">Slow</option>
                        </Select>
                    </li>
                </ul>

                <button style="margin-top: 69%;">Set</button>
            </div>
            <div class="users">
                <h2> User </h2>
                <div class="user-container">
                    <div class="user-card">
                        <h3>User Name</h3>
                        <p>User id</p>
                        <img src="images/user.png" alt="user">
                    </div>
                </div>
                <button onclick="toUsers()">
                    Select
                </button>
            </div>
        </section>
    </main>
    <script src="js/script.js"></script>
</body>

</html>