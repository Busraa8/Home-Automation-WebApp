<?php include 'login.php';?>
<link rel="stylesheet" href="Consumer/login.css">
<div id="container">
  <div id="left">
    <h1 id="welcome">Welcome</h1>
  </div>
  <div id="right">
    <h1 id="login">LogIn</h1><br>
    <form action="login.php" method="post"> 
      <input type="email" id="email" name="email" class="client-info">
      <label for="email">Email</label>
      <input type="password" id="password" name="password" class="client-info">
      <label for="password">Password</label>
      <a href="#" style="text-decoration: none;">
        <input type="submit" id="submit" name="login" class="client-info" value="LogIn">
      </a>
      <a href="forgotpass.html" style="text-decoration: none;">
        <button class="social" id="forgot">forgot password</button>
      </a>
    </form>

  </div>

</div>