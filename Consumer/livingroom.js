var livingRoomTempInput = document.getElementById("living-room-temp-input");
var kitchenTempInput = document.getElementById("kitchen-temp-input");

// Sıcaklık değerlerini gösteren span elementlerini seç
var livingRoomTempSpan = document.getElementById("living-room-temp");
var kitchenTempSpan = document.getElementById("kitchen-temp");

// Sıcaklık kaydırıcılarından değer değiştiğinde fonksiyonları çalıştır
livingRoomTempInput.addEventListener("input", function() {
  var temp = this.value + "&deg;C";
  livingRoomTempSpan.innerHTML = temp;
});

kitchenTempInput.addEventListener("input", function() {
  var temp = this.value + "&deg;C";
  kitchenTempSpan.innerHTML = temp;
});