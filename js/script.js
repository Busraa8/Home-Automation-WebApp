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
    var btn = document.getElementById("toggle-btn");
    if (btn.innerHTML === "On") {
      btn.innerHTML = "Off";
    } else {
      btn.innerHTML = "On";
    }
  }

  $(document).ready(function(){
    $("#myBtn").click(function(){
      $(this).toggleClass("active");
    });
  });