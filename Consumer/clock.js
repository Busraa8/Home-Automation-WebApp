Number.prototype.pad = function(n) {
  for (var r = this.toString(); r.length < n; r = 0 + r);
  return r;
};

function updateClock() {
  var now = new Date();
  var sec = now.getSeconds(),
    min = now.getMinutes(),
    hou = now.getHours(),
    mo = now.getMonth(),
    dy = now.getDate(),
    yr = now.getFullYear();
  var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
  var tags = ["mon", "d", "y", "h", "m", "s"],
    corr = [months[mo], dy, yr, hou.pad(2), min.pad(2), sec.pad(2)];
  for (var i = 0; i < tags.length; i++)
    document.getElementById(tags[i]).firstChild.nodeValue = corr[i];
}

function initClock() {
  updateClock();
  window.setInterval("updateClock()", 1);
}


$('#tab2').html(unixTimeToDay(data.daily.data[1]));
$('#tab3').html(unixTimeToDay(data.daily.data[2]));
$('#tab4').html(unixTimeToDay(data.daily.data[3]));

function unixTimeToDay(data) {
var date = new Date(data.time * 1000);
var dayName = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
return dayName[date.getDay()];
};
