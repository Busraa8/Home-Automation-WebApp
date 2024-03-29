<?php
// Veritabanı bağlantısı
include 'config.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Veritabanına bağlanırken hata oluştu: " . $conn->connect_error);
}

// Verileri al ve donut chart için hazırla
$sqlDonut = "SELECT room.name, COUNT(*) as device_count FROM devices INNER JOIN room ON devices.room_id = room.id GROUP BY room.name";
$resultDonut = $conn->query($sqlDonut);

$donutData = [];
while ($rowDonut = $resultDonut->fetch_assoc()) {
    $donutData[] = [$rowDonut["name"], (int)$rowDonut["device_count"]];
}

// Verileri al ve bar chart için hazırla
$sqlBar = "SELECT devices.device_name, COUNT(*) as device_count FROM devices INNER JOIN room ON devices.room_id = room.id GROUP BY devices.device_name";
$resultBar = $conn->query($sqlBar);

$labels = [];
$barData = [];

while ($rowBar = $resultBar->fetch_assoc()) {
    $labels[] = $rowBar['device_name'];
    $barData[] = (int)$rowBar['device_count'];
}

$conn->close();

// Verileri JSON formatına dönüştür
$jsonDonutData = json_encode($donutData);
$jsonBarData = json_encode($barData);


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="homepage.css">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,600,700" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/37b0ae8922.js" crossorigin="anonymous"></script>
    
</head>

<body>
    <div class="dash">

        <!-- HEADER -->
        <header class="header">
            <div class="header__options">
                <a href="../index.php" class="header__pro" style="margin-right: 10px;">Log out</a>
            </div>
        </header>

        <!-- BODY -->
        <div class="body">

            <!-- SIDEBAR -->
            <div class="sidebar">

                <div class="sidebar_icon">
                    <a href="homepage.php">
                        <i class='fas fa-home' style='font-size:17px;color:rgb(255, 255, 255)'>&nbsp&nbsp Home</i>
                    </a>
                </div>

                <div class="sidebar_icon">
                    <form action="rooms.php" method="GET">
                        <button type="submit" style="background: none; border: none; padding: 0; font-size: 17px; color: rgb(255, 255, 255);">
                            <i class='fas fa-th' style='font-size:17px;color:rgb(255, 255, 255)'>&nbsp&nbsp Rooms</i>
                        </button>
                    </form>
                </div>

                <div class="sidebar_icon">
                    <form action="post-message.php" method="GET">
                        <button type="submit" style="background: none; border: none; padding: 0; font-size: 17px; color: rgb(255, 255, 255);">
                            <i class='fas fa-comment-alt' style='font-size:17px;color:rgb(255, 255, 255)'>&nbsp&nbsp Message</i>
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

                </body>


            </div>

            <!-- MAIN -->
            <main class="main">

                <div class="container_box">
                    <div class="container_chart">
                        <div class="chart-container">
                            <h2>Room Utilization Rate</h2>
                            <canvas id="donut-chart" width="10px" height="10px"></canvas>
                        </div>
                        <div class="chart-container">
                            <h2>Usage Rate of Devices</h2>
                            <canvas id="bar-chart-canvas" style="width:700px;"></canvas>
                        </div>
                    </div>
                </div>

                <div id="box">
                
                <div class="container-fluid full-width-image margins">
                </div>
            
                <div class="container">
                    <ul class="nav nav-tabs" role="tablist">
                          <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#today" role="tab">Today</a>
                          </li>
                          <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tomorrow" id="tab2" role="tab">Fri</a>
                          </li>
                          <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#third-day" id="tab3" role="tab">Sat</a>
                          </li>
                          <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#fourth-day" id="tab4" role="tab">Sun</a>
                          </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="today" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-4">
                                    <p id="cur-status"><span id="cur-deg">27</span> &deg;<span class="deg-toggle">C</span><i class="ion-ios-rainy-outline" id="today-icon"></i></p> 
                                    <p id="cur-status2"><i class="ion-leaf icons"></i><span id="cur-wind"> 37</span> <span class="speed-toggle">kph </span> <i class="ion-waterdrop icons"></i><span id="cur-humid"> 45</span> % </p> 
                                </div>
                                <div class="col">
                                    <i id="hourly-icon-0" class="hourly-icons"></i>
                                    <p class="hourly-degs"><span id="hourly-deg-0">25</span>&deg;</p>
                                    <p class="hourly-times"><span id="hourly-time-0">17:00</span></p>
                                </div>
                                <div class="col">
                                    <i id="hourly-icon-1" class="hourly-icons"></i>
                                    <p class="hourly-degs"><span id="hourly-deg-1">25</span>&deg;</p>
                                    <p class="hourly-times"><span id="hourly-time-1">21:00</span></p>
                                    
                                </div>
                                <div class="col">
                                    <i id="hourly-icon-2" class="hourly-icons"></i>
                                    <p class="hourly-degs"><span id="hourly-deg-2">25</span>&deg;</p>
                                    <p class="hourly-times"><span id="hourly-time-2">01:00</span></p>
        
                                </div>
                                <div class="col">
                                    <i id="hourly-icon-3" class="hourly-icons"></i>
                                    <p class="hourly-degs"><span id="hourly-deg-3">25</span>&deg;</p>
                                    <p class="hourly-times"><span id="hourly-time-3">05:00</span></p>
        
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tomorrow" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-4">
                                    <p id="tomorrow-status"><span id="tomorrow-deg-max">27</span> &deg;<span class="deg-toggle">C</span><span id="tomorrow-deg-min">23</span> &deg;<span class="deg-toggle">C</span><br><i class="ion-ios-rainy-outline" id="tomorrow-icon"></i></p> 
                                    <p id="tomorrow-status2"><i class="ion-leaf icons"></i><span id="tomorrow-wind"> 37</span> <span class="speed-toggle">kph </span> <i class="ion-waterdrop icons"></i><span id="tomorrow-humid"> 45</span> % </p>
                                </div>
                                <div class="col">
                                    <h3>Day summary:</h3>
                                    <p id="tomorrow-summary">Info</p>
                                </div>
                                <div class="col">
                                    <p class="more-info">Cloud cover: <span id="tomorrow-cloud">20</span>%</p>
                                    <p class="more-info">Chance of rain: <span id="tomorrow-rain">10</span>%</p>
                                    <p class="more-info">Real feel max: <span id="tomorrow-real-max">29</span>&deg;</p>
                                    <p class="more-info">Real feel min: <span id="tomorrow-real-min">18</span>&deg;</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="third-day" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-4">
                                    <p id="third-status"><span id="third-deg-max">27</span> &deg;<span class="deg-toggle">C</span><span id="third-deg-min">23</span> &deg;<span class="deg-toggle">C</span><br><i class="ion-ios-rainy-outline" id="third-icon"></i></p> 
                                    <p id="third-status2"><i class="ion-leaf icons"></i><span id="third-wind"> 37</span> <span class="speed-toggle">kph </span> <i class="ion-waterdrop icons"></i><span id="third-humid"> 45</span> % </p>
                                </div>
                                <div class="col">
                                    <h3>Day summary:</h3>
                                    <p id="third-summary">Info</p>
                                </div>
                                <div class="col">
                                    <p class="more-info">Cloud cover: <span id="third-cloud">20</span>%</p>
                                    <p class="more-info">Chance of rain: <span id="third-rain">10</span>%</p>
                                    <p class="more-info">Real feel max: <span id="third-real-max">29</span>&deg;</p>
                                    <p class="more-info">Real feel min: <span id="third-real-min">18</span>&deg;</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="fourth-day" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-4">
                                    <p id="fourth-status"><span id="fourth-deg-max">27</span> &deg;<span class="deg-toggle">C</span><span id="fourth-deg-min">23</span> &deg;<span class="deg-toggle">C</span><br><i class="ion-ios-rainy-outline" id="fourth-icon"></i></p> 
                                    <p id="fourth-status2"><i class="ion-leaf icons"></i><span id="fourth-wind"> 37</span> <span class="speed-toggle">kph </span> <i class="ion-waterdrop icons"></i><span id="fourth-humid"> 45</span> % </p>
                                </div>
                                <div class="col">
                                    <h3>Day summary:</h3>
                                    <p id="fourth-summary">Info</p>
                                </div>
                                <div class="col">
                                    <p class="more-info">Cloud cover: <span id="fourth-cloud">20</span>%</p>
                                    <p class="more-info">Chance of rain: <span id="fourth-rain">10</span>%</p>
                                    <p class="more-info">Real feel max: <span id="fourth-real-max">29</span>&deg;</p>
                                    <p class="more-info">Real feel min: <span id="fourth-real-min">18</span>&deg;</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                <script>
                    // Verileri al
                    var jsonDonutData = <?php echo $jsonDonutData; ?>;
                    var labels = <?php echo json_encode($labels); ?>;
                    var jsonBarData = <?php echo $jsonBarData; ?>;


                    // Donut chart oluştur
                    var ctx = document.getElementById('donut-chart').getContext('2d');
                    var donutChart = new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: jsonDonutData.map(item => ' ' + item[0]),
                            datasets: [{
                                data: jsonDonutData.map(item => item[1]),
                                backgroundColor: [
                                    'rgb(78, 147, 58)',
                                    'rgb(46, 44, 99)',
                                    'rgb(106, 45, 111)',
                                    'rgb(58, 147, 142)',
                                ],
            
                            }],
                        },
                        options: {
                            responsive: true,
                    
                            maintainAspectRatio: false,
                            legend: {
                                display: true,
                                position: 'bottom',
                                labels: {
                                    fontColor: 'rgb(255, 255, 255)',
                                    fontSize: 14,
                                    padding: 20,
                                }
                            }
                        }
                    });

                    // Bar chart oluştur
var ctx2 = document.getElementById('bar-chart-canvas').getContext('2d');
var barChart = new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Device Count',
            data: jsonBarData,
            backgroundColor: [
                'rgb(78, 147, 58)',
                'rgb(46, 44, 99)',
                'rgb(106, 45, 111)',
                'rgb(58, 147, 142)',
            ],
            borderColor: [
                'rgb(0, 0, 0)',
                'rgb(0, 0, 0)',
                'rgb(0, 0, 0)',
                'rgb(0, 0, 0)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    fontColor: 'rgb(255, 255, 255)',
                    fontSize: 14
                },
                gridLines: {
                    display: true,
                    color: 'rgba(255, 255, 255, 0.1)'
                }
            }],
            xAxes: [{
                ticks: {
                    fontColor: 'rgb(255, 255, 255)',
                    fontSize: 14
                },
                gridLines: {
                    display: false
                }
            }]
        },
        legend: {
            display: false
        }
    },
    plugins: [{
        beforeInit: function(chart) {
            var data = chart.config.data;
            for (var i = 0; i < data.datasets.length; i++) {
                var dataset = data.datasets[i];
                if (dataset.label === 'Device Count') {
                    for (var j = 0; j < dataset.data.length; j++) {
                        var deviceCount = dataset.data[j];
                        var deviceName = data.labels[j];
                        dataset.data[j] = { x: deviceName, y: deviceCount };
                    }
                }
            }
        }
    }]
});

                </script>

            </main>
        </div>
    </div>
</body>
<script src="clock.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>


</html>