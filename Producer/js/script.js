function showTime() {
  var date = new Date();
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var ampm = hours >= 12 ? 'PM' : 'AM';
  hours = hours % 12;
  hours = hours ? hours : 12;
  var time = hours + ':' + (minutes < 10 ? '0' : '') + minutes + ' ';
  document.getElementById('time').innerHTML = time;
  document.getElementById('am-pm').innerHTML = ampm;
}

setInterval(showTime, 1000);

function toggle() {
  var btn = document.getElementById("toggle");
  if (btn.classList.contains("fa-toggle-on")) {
    btn.classList.replace("fa-toggle-on", "fa-toggle-off");
  } else {
    btn.classList.replace("fa-toggle-off", "fa-toggle-on");
  }
}

if(document.getElementById('change-button') != null)
{
  var changeButton = document.getElementById('change-button');

  changeButton.addEventListener('click', function() {
    // AJAX ile HTTP isteği gönderme
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'change-submit.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // İstek tamamlandıktan sonra geri dönen yanıtı işleyebilirsiniz
        alert(xhr.responseText);
      }
    };
    xhr.send();

    // Başarılı bir şekilde değişiklikler yapıldıktan sonra kullanıcıya geri bildirim verebilirsiniz.
    alert("Değişiklikler başarıyla kaydedildi.");
  });
}

// Switch değişikliğinde on_off değerini güncelle
if (document.getElementById("on-off") != null) {
  var onOffCheckbox = document.getElementById('on-off');
  var currentStateElement = document.getElementById('current-state');
  onOffCheckbox.addEventListener('change', function () {
    var onOffValue = this.checked;
    // İsteğe bağlı olarak, bu değeri sunucuya göndermek için AJAX kullanabilirsiniz
    if (this.checked) {
      currentStateElement.textContent = 'On';
    } else {
      currentStateElement.textContent = 'Off';
    }
    console.log('On/Off:', onOffValue);
  });
}

if (document.getElementById("connection-status") != null && document.getElementById("toggle-connection") != null) {
  var connectionStatusElement = document.getElementById('connection-status');
  var toggleConnectionButton = document.getElementById('toggle-connection');
  toggleConnectionButton.addEventListener('click', function () {
    if (connectionStatusElement.textContent == 'connected')
      connectionStatusElement.textContent = 'disconnected';
    else {
      connectionStatusElement.textContent = 'connected';
    }
  });
}

// Kaydırma çubuğu değişikliğinde brightness değerini güncelle
if (document.querySelector(".brightness-value") != null && document.getElementById("brightness") != null) {
  var brightnessRange = document.getElementById('brightness');
  var brightnessValue = document.querySelector('.brightness-value');

  brightnessRange.addEventListener('input', function () {
    brightnessRange.addEventListener('input', function () {
      var brightness = this.value;
      brightnessValue.textContent = brightness;
      // İsteğe bağlı olarak, bu değeri sunucuya göndermek için AJAX kullanabilirsiniz
      console.log('Brightness:', brightness);
    });
  });
}

if (document.querySelector(".volume-value") != null && document.getElementById("volume") != null) {
  var volumeRange = document.getElementById('volume');
  var volumeValue = document.querySelector('.volume-value');

  volumeRange.addEventListener('input', function () {
    volumeRange.addEventListener('input', function () {
      var volume = this.value;
      volumeValue.textContent = volume;
      // İsteğe bağlı olarak, bu değeri sunucuya göndermek için AJAX kullanabilirsiniz
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
    // İsteğe bağlı olarak, bu değeri sunucuya göndermek için AJAX kullanabilirsiniz
    console.log('Temperature:', decreasedTemperature);
  }
}

// Temperature değerini artır
function increaseTemperature() {
  var temperatureInput = document.getElementById('temperature');
  if (temperatureInput) {
    var currentTemperature = parseFloat(temperatureInput.value);
    var increasedTemperature = currentTemperature + 1;
    temperatureInput.value = increasedTemperature;
    // İsteğe bağlı olarak, bu değeri sunucuya göndermek için AJAX kullanabilirsiniz
    console.log('Temperature:', increasedTemperature);
  }
}


function toUsers() {
  window.location.href = "users-producer.php";
}
function toHome() {
  window.location.href = "home-producer.php";
}
function toDevices() {
  window.location.href = "devices-producer.php";
}
function goBack() {
  window.history.back();
}
function logOut() {
  window.location.href = "../index_producer.php";
}
function toRooms() {
  window.location.href = "rooms-producer.php";
}
function toRoom(roomId) {
  window.location.href = 'user-room-example-producer.php?roomid=' + roomId;
}
function toDevice(deviceId) {
  window.location.href = "device-example-producer.php?deviceid=" + deviceId;
}
function toAddUser() {
  window.location.href = "add-consumer-producer.php";
}