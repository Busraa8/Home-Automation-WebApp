<?php
$_SESSION["on_off"] = null;
$_SESSION["brightness"] = null;
$_SESSION["temperature"] = null;
$_SESSION["connected"] = null;
$_SESSION["volume"] = null;

$hasTemperature = false; // Başlangıçta temperature yok

// özellikleri döngü ile kontrol et
foreach ($properties as $key => $value) {
  if ($key === 'on_off') {
    $currentState = $properties['on_off'] === "true" ? 'On' : 'Off';
    $onOffChecked = $value === "true" ? 'checked' : '';
    echo '<div class="on-off-device">';
    echo '<label class="switch">';
    echo '<input type="checkbox" id="on-off" ' . $onOffChecked . '>';
    echo '<span class="slider"></span>';
    echo '</label>';
    echo '<label class="on-off-label" for="on-off">On/Off</label> <label class="on-off-label" for="on-off">Current state: <label id="current-state" for="on-off">' . $currentState . '</label></label>';
    echo '</div>';
    $_SESSION["on_off"] = $value;
  } elseif ($key === 'brightness') {
    echo '<div class="brightness-device">';
    echo '<input type="range" id="brightness" min="0" max="100" value="' . $value . '">';
    echo '<span class="on-off-label" style="text-indent: 280px;">Brightness: </span><span class="brightness-value">' . $value . '</span>';
    echo '</div>';
    $_SESSION["brightness"] = $value;
  } elseif ($key === 'temperature') {
    echo '<div class="temperature-control">';
    echo '<button class="control-button" onclick="decreaseTemperature()">-</button>';
    echo '<input type="number" id="temperature" value="' . $value . '">';
    echo '<button class="control-button" onclick="increaseTemperature()">+</button>';
    echo '</div>';
    $_SESSION["temperature"] = $value;
    $hasTemperature = true; //temperature özelliği var
  } elseif ($key === 'connected') {
    $currentConnection = $properties['connected'] === "true" ? 'connected' : 'disconnected';
    echo '<div class="connection-control">';
    echo '<p id="connection-status">' . $currentConnection . '</p>';
    echo '<button id="toggle-connection">Connect/Disconnect</button>';
    echo '</div>';
    $_SESSION["connected"] = $value;
  } elseif ($key === 'volume') {
    echo '<div class="volume-device">';
    echo '<input type="range" id="volume" min="0" max="100" value="' . $value . '">';
    echo '<span>Volume: </span><span class="volume-value">' . $value . '</span>';
    echo '</div>';
    $_SESSION["volume"] = $value;
  }
}

if ($hasTemperature) {
  echo '
    <style>
      .current-temperature {
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 16px;
        font-weight: bold;
        margin-top: 10px;
      }
    </style>

    <div class="current-temperature">
       <span id="current-temperature">' . $_SESSION["temperature"] . '</span>
    </div>
  ';
}
?>


<style>
  .on-off-label, .brightness-device .on-off-label, .brightness-device .brightness-value, .connection-control {
    font-size: 12px;
    font-weight: bold;
  }
  .current-temperature {
    font-size: 25px;
    font-weight: bold;
    margin-top: 10px;
  }
</style>



<script>
  setInterval(function() {
    var currentTemperature = parseFloat(<?php echo $properties['temperature']; ?>);
    var min = currentTemperature - 1.5;
    var max = currentTemperature + 0.1;
    var newTemperature = (Math.random() * (max - min) + min).toFixed(1);
    document.getElementById("current-temperature").textContent = newTemperature;
  }, 5000);
</script>
