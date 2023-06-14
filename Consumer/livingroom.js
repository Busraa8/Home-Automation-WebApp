var livingRoomLightInput = document.getElementById("living-room-light-value-degree");
var livingRoomLightValue = document.getElementById("living-room-light-value");

livingRoomLightInput.addEventListener("input", function() {
  var light = this.value + "";
  livingRoomLightValue.innerHTML = light;
});


var livingRoomSpeakerInput = document.getElementById("living-room-speaker-value-degree");
var livingRoomSpeakerValue = document.getElementById("living-room-speaker-value");

livingRoomSpeakerInput.addEventListener("input", function() {
  var speaker = this.value + "";
  livingRoomSpeakerValue.innerHTML = speaker;
});

var livingRoomTempInput = document.getElementById("living-room-temp-value-degree");
// Sıcaklık değerlerini gösteren span elementlerini seç
var livingRoomTempSpan = document.getElementById("living-room-temp-value");

// Sıcaklık kaydırıcılarından değer değiştiğinde fonksiyonları çalıştır
livingRoomTempInput.addEventListener("input", function() {
  var temp = this.value + "&deg;C";
  livingRoomTempSpan.innerHTML = temp;
});

