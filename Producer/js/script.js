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
  console.log("asdasd");
  var btn = document.getElementById("toggle");
  if (btn.classList.contains("fa-toggle-on")) {
    btn.classList.replace("fa-toggle-on","fa-toggle-off");
  } else {
    btn.classList.replace("fa-toggle-off","fa-toggle-on");
  }
}

$(document).ready(function () {
  $("#myBtn").click(function () {
    $(this).toggleClass("active");
  });
});

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
function toDevice() {
  window.location.href = "device-example-producer.php";
}
function toAddUser() {
  window.location.href = "add-consumer-producer.php";
}