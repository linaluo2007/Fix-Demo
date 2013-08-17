<?php
error_reporting(E_ALL ^ E_NOTICE);
?>


<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">  

    <h1><center>Fix&Demo Sign Up Page</center></h1>
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
        <h1><center>Member Sign Up Page</center></h1>
      </div>
      <div style="margin-bottom:10px;">
 <div><center>
   <br />

</head>
<body>
<?php
 if($_POST['registerbtn']){
       $getuser = $_POST['user'];
       $getemail = $_POST['email'];
       $getpass = $_POST['pass'];
       $getretypepass = $_POST['retypepass'];
       
       if($getuser){
           if($getemail){
               if($getpass){
                 if($getretypepass){
                  if( $getpass === $getretypepass){
                  if( (strlen($getemail) >= 7) && (strstr($getemail,"@")) && (strstr($getemail,".")) ){
                      require ("./connect.php");
                      
                      $query = mysql_query("SELECT * FROM users WHERE username='$getuser'");
                      $numrows = mysql_num_rows($query);
                      if($numrows == 0){
                           $query = mysql_query("SELECT * FROM users WHERE email='$getemail'");
                           $numrows = mysql_num_rows($query);
                           if($numrows == 0){
                               
                               $password = md5(md5("sdhfdh".$password."djfdsjl"));    
                               $date = date("F d, Y");
                               $code = md5(rand());
                               
                               mysql_query("INSERT INTO users VALUES (
                                   '','$getuser', '$getpass','$getemail','0','$code','$date'
                               )");
                               
                               $query = mysql_query("SELECT * FROM users WHERE username ='$getuser'");
                               $numrows = mysql_num_rows($query);
                               if($numrows == 1){
                                   
                                   $site = "http://localhost/FixDemo";
                                   $webmaster = "support <admin@fixdemo.com>";
                                   $headers = "From: $webmaster";
                                   $subject ="Activate Your account.";
                                   $message = "Thanks for registering. Click the link below to active your account.\n";
                                   $message .= "$site/activate.php?user=$getuser&code=$code.\n";
                                   $message .= "You must activate your account to login.";
                                   
                                   if(mail($getemail,$subject,$message,$headers)){
                                     $errormsg = "You have been registered. You must activate your account from the activation link sent to <b>$getemail</b>"; 
                                     $getuser = "";
                                     $getemail = "";
                                   }
                                   else
                                       $errormsg = "An error has occured. Your activation emial was not sent.";
                                   
                               }
                              else
                                  $errormsg = "An error has occured, Your account was not created.";
                            }
                           else 
                           $errormsg = "There is already a user with that email.";
                      }
                      else 
                         $errormsg = "There is already a user with that username.";
                      mysql_close();
                      }
                      else
                          $errormsg = "You must enter a valid email address to log in.";
                  }
                  else
                  $errormsg = "Your password did not match.";
                  }
                 else
                 $errormsg = "You must retype your password to register.";
               
               }
               else
               $errormsg = "You must enter your password to register.";
           }
           else
               $errormsg = "You must enter your email to register.";
       }
       else 
           $errormsg ="You must enter your username to register.";
       }
  
       
       
    $form ="<form action='./signup.php' method='post'>
    <table>
    <tr>
     <td></td>
     <td><font color='red'></font>$errormsg</td>
    </tr>
    <tr>
     <td>Username:</td>
     <td><input type='text' name='user' value='$getuser'/></td>
    </tr>
     <tr>
     <td>Email:</td>
     <td><input type='text' name='email' value='$getemail'/></td>
    </tr>
     <tr>
     <td>Password:</td>
     <td><input type='password' name='pass' value=''/></td>
    </tr>
    <tr>
     <td>Retype password:</td>
     <td><input type='password' name='retypepass' value=''/></td>
    </tr>
    <tr>
     <td></td>
     <td><input type='submit' name='registerbtn' value='register'/></td>
    </tr>
    </table>
    </form>";
    
  echo $form;
       

 ?>      
</body>
 
</html>
