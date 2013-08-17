<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
$userid=$_SESSION['userid'];
$username=$_SESSION['username'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">  

    <h1><center>Fix&Demo Logout Page</center></h1>
     <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<div id="container">
  <div class="header">
    <div class="topmenu">
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="services.html">Services</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="contactus.html">Contact Us</a></li>
        <li><a href="./login.php">Sign In</a></li>
        <li><a href="./member.php">Member Page</a></li>
        <li><a href="./signup.php">Sign Up</a></li>
        <li><a href="./logout.php">Log Out</a></li>
      </ul>
    </div>
  </div>
  <div class="clear"></div>
  <div class="banner">
    <div class="logozone">Fix&amp;Demo</div>
  </div>
  <div class="workzone">
    <div class="workzone-center">
      <div>
        <h1><center>Member Logout Page</center></h1>
      </div>
      <div style="margin-bottom:10px;">
 <div><center>
   <br />

</head>
<body>
    

<?php
  if($username && $userid){
      session_destroy();
      echo"You have been logged out.<a href='./member.php'>Member</a>";
  }
  else
      echo"You are not logged in.";
                
    ?>      
</body>
 
</html>
