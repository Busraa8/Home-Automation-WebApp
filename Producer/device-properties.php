<?php
// Özellikleri döngü ile kontrol et
foreach ($properties as $key => $value) {
  if ($key === 'on_off') {
    $currentState = $properties['on_off'] ? 'On' : 'Off';

    $onOffChecked = $value ? 'checked' : '';
    echo '<div class="on-off-device">';
    echo '<label class="switch">';
    echo '<input type="checkbox" id="on-off" ' . $onOffChecked . '>';
    echo '<span class="slider"></span>';
    echo '</label>';
    echo '<label for="on-off">Current state: <label id="current-state" for="on-off">' . $currentState . '</label></label>  <label for="on-off">On/Off</label>';
    echo '</div>';
  } elseif ($key === 'brightness') {
    echo '<div class="brightness-device">';
    echo '<input type="range" id="brightness" min="0" max="100" value="' . $value . '">';
    echo '<span>Brightness: </span><span class="brightness-value">' . $value . '</span>';
    echo '</div>';
  } elseif ($key === 'temperature') {
    echo '<div class="temperature-control">';
    echo '<button class="control-button" onclick="decreaseTemperature()">-</button>';
    echo '<input type="number" id="temperature" value="' . $value . '">';
    echo '<button class="control-button" onclick="increaseTemperature()">+</button>';
    echo '</div>';
  } elseif ($key === 'connected') {
    $currentConnection = $properties['connected'] ? 'connected' : 'disconnected';
    echo '<div class="connection-control">';
    echo '<p id="connection-status">' . $currentConnection . '</p>';
    echo '<button id="toggle-connection">Connect/Disconnect</button>';
    echo '</div>';
  } elseif ($key === 'volume') {
    echo '<div class="volume-device">';
    echo '<input type="range" id="volume" min="0" max="100" value="' . $value . '">';
    echo '<span>Volume: </span><span class="volume-value">' . $value . '</span>';
    echo '</div>';
  }
  // Diğer özelliklere göre gerekli kontrolleri ekleyebilirsiniz
}
?>