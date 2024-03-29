function toggle() {
    var btn = document.getElementById("toggle");
    if (btn.classList.contains("fa-toggle-on")) {
      btn.classList.replace("fa-toggle-on", "fa-toggle-off");
    } else {
      btn.classList.replace("fa-toggle-off", "fa-toggle-on");
    }
  }
  
  var onOffValue = "";
  var connectionv = "";
  var brightness = "";
  var volume = "";
  var temperature = "";
  var temperatureInput = document.getElementById('temperature');
  if (temperatureInput != null)
    var temperature = temperatureInput.value;
  
  // Switch değişikliğinde on_off değerini güncelle
  if (document.getElementById("on-off") != null) {
    var onOffCheckbox = document.getElementById('on-off');
    var currentStateElement = document.getElementById('current-state');
    if (currentStateElement.textContent == 'On') {
      onOffValue = true;
    } else {
      onOffValue = false;
    }
    onOffCheckbox.addEventListener('change', function () {
      onOffValue = this.checked;
      if (this.checked) {
        currentStateElement.textContent = 'On';
      } else {
        currentStateElement.textContent = 'Off';
      }
    });
  }
  
  if (document.getElementById("connection-status") != null && document.getElementById("toggle-connection") != null) {
    var connectionStatusElement = document.getElementById('connection-status');
    var toggleConnectionButton = document.getElementById('toggle-connection');
    if (connectionStatusElement.textContent == 'disconnected') {
      connectionv = false;
    } else {
      connectionv = true;
    }
    toggleConnectionButton.addEventListener('click', function () {
      if (connectionStatusElement.textContent == 'connected') {
        connectionStatusElement.textContent = 'disconnected';
        connection = "disconnected";
        connectionv = false;
      }
      else {
        connectionStatusElement.textContent = 'connected';
        connection = "connected";
        connectionv = true;
      }
    });
  }
  
  // Kaydırma çubuğu değişikliğinde brightness değerini güncelle
  if (document.querySelector(".brightness-value") != null && document.getElementById("brightness") != null) {
    var brightnessRange = document.getElementById('brightness');
    var brightnessValue = document.querySelector('.brightness-value');
  
    brightness = brightnessValue.textContent;
    brightnessRange.addEventListener('input', function () {
      brightness = this.value;
      brightnessValue.textContent = brightness;
    });
    ;
  }
  
  // Volume value 
  if (document.querySelector(".volume-value") != null && document.getElementById("volume") != null) {
    var volumeRange = document.getElementById('volume');
    var volumeValue = document.querySelector('.volume-value');
  
    volume = volumeValue.textContent;
    volumeRange.addEventListener('input', function () {
      volumeRange.addEventListener('input', function () {
        volume = this.value;
        volumeValue.textContent = volume;
        console.log('Volume:', volume);
      });
    });
  }
  
  function decreaseTemperature() {
    var temperatureInput = document.getElementById('temperature');
    if (temperatureInput) {
      var currentTemperature = parseFloat(temperatureInput.value);
      var decreasedTemperature = currentTemperature - 1;
      temperatureInput.value = decreasedTemperature;
      temperature = temperatureInput.value;
      // İsteğe bağlı olarak, bu değeri sunucuya göndermek için AJAX kullanabilirsiniz
      console.log('Temperature:', decreasedTemperature);
    }
  }
  
  // Temperature değerini artır
  function increaseTemperature() {
    var temperatureInput = document.getElementById('temperature');
    temperature = temperatureInput.value;
    if (temperatureInput) {
      var currentTemperature = parseFloat(temperatureInput.value);
      var increasedTemperature = currentTemperature + 1;
      temperatureInput.value = increasedTemperature;
      temperature = temperatureInput.value;
      // İsteğe bağlı olarak, bu değeri sunucuya göndermek için AJAX kullanabilirsiniz
      console.log('Temperature:', increasedTemperature);
    }
  }

  function toDevice(deviceId) {
    window.location.href = "dynamic-device-props.php?deviceid=" + deviceId;
  }