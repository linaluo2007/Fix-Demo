<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">  

    <h1><center>Fix&Demo Sign In Page</center></h1>
     <link rel="stylesheet" type="text/css" href="style.css" />
    
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
      
  <div class="clear"></div>
  <div class="banner">
    <div class="logozone">Fix&amp;Demo</div>
  </div>
  
  <div class="workzone">
    <div class="workzone-center">
      <div>
        <h1><center>Member Sign In</center></h1>
      </div>
        </div>
      <div style="margin-bottom:10px;">
      <div><center>
   <br />
</head>
<body>      
   <?php  
   if($username && $userid){
          echo "You are alread logged in as <b>$dbuser</b> <a href='./member.php'>Click here</a>to go to the member page.";
    }
    else{

   $form ="<form action='./login.php' method='post'>    
            <table>
              <tr>
                 <td>Username:</td>
                 <td><input type='text' name='user' /></td>
              </tr>
              <tr>
                 <td>Password:</td>
                 <td><input type='password' name='password' /></td>
              </tr>
              <tr>
                 <td></td>
                 <td><input type='submit' name='loginbtn' value='Login' /></td>
              </tr>
              <tr>
                 <td></td>
                 <td><a href='./signup.php'/n/n>Sign Up Here</a>
                 <a href='./forgotpass.php'>Forgot your password.</a></td>
              </tr>
            </table>   
          </form>";
 
       if (isset($_POST['loginbtn'])) {
        
        $user = $_POST['user'];
        $password = $_POST['password'];

        if ($user) {
            if ($password) {
               
               require ("connect.php");

               $password = md5(md5("sdhfdh".$password."djfdsjl"));    
               $query = mysql_query("SELECT * FROM users WHERE username='$user'");
               $numrows = mysql_num_rows($query);
               if ($numrows === 1){
                     $row = mysql_fetch_assoc($query);
                     $dbid = $row['id'];
                     $dbuser = $row['username'];
                     $dbpass = $row['password'];
                     $dbactive = $row['active'];
         
                 if ($password === $dbpass){
                     if($dbactiveactive == 1){
                       
                         $_SESSION['id'] = $dbid;
                         $_SESSION['username'] = $dbuser;
                         
                         echo "You have been logged in as <b>$dbuser</b> <a href='./member.php'>Click here</a>to go to the member page.";
                     }
                     else
                         echo"You must activate your account to login. $form";
                 }
                  else
                      echo"You did not enter the correct password. $form";
               }
               else
                   echo"The username you entered was not found. $form";
               
               mysql_close();
            }
            else
                echo"You must enter your password, $form";
        }
        else
            echo "You must enter your username. $form";
    }                              
    else
      echo $form;
     }           
    ?>      

</body> 
</html>  