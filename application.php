<?php
error_reporting(E_ALL ^ E_NOTICE);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" type="text/css" href="style.css" />
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">  

       <h1><center>Fix&Demo Page</center></h1>
     <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
<body>
    <div id="container">
  <div class="header">
    <div class="topmenu">
      <ul>
        <li><a href="./index.php">Home</a></li>
        <li><a href="./services.html">Services</a></li>
        <li><a href="./about.html">About</a></li>
        <li><a href="./contactus.html">Contact Us</a></li>
        <li><a href="./login.php">Sign In</a></li>
        <li><a href="./application.php">Application</a></li>
        <li><a href="./signup.php">Sign Up</a></li>
        <li><a href="./logout.php">Log Out</a></li>
      </ul>
    </div>
  </div>
    </div>
 
      <div>
        <h1><center><font color='red'></font>Application Form</center></h1>
      </div>
      <div style="margin-bottom:10px;">
 <div><center>
   <br />

<?php
//initilize PHP
if ( isset ( $_POST['submit'] ) ) //If submit is hit
{
mysql_connect("localhost","root","");
mysql_select_db("fixdemo")or die ( "<p><span style=\"color: red;\">Unable to select database</span></p>");
//convert all the posts to variables:
$title = $_POST['title'];
$message = $_POST['message'];
$who = $_POST['who'];
$email = $_POST['email'];
$date = $_POST['date'];
$time = $_POST['time'];
//Insert the values into the correct database with the right fields
//mysql table = your-table-name
//table columns = id, title, message, who, email, date, time
//post variables = $title, $message, $who, $email, $date, $time
$result= MYSQL_QUERY("INSERT INTO application VALUES ('', '$title', '$message', '$who', '$email', '$date', '$time')")or die( "<p><span style=\"color: red;\">Unable to select table</span></p>");
mysql_close();
//confirm
echo "<p><span style=\"color: red;\">Thank You; your comments have been entered in my database. DO NOT REFRESH THE PAGE or data will be sent again.</span></p>";
}
else
{
// close php so we can put in our code
?>

 
    <form id="form1" method="post" action="application.php"><!--same page filename-->
    <fieldset>
    <legend>Application Form</legend>
    <label for="title">
    <span>Job Name:</span>
    <input id="title" type='text' name='title' size='80'/><br>
    </label>
    <label for="text">
    <span>Description:</span>
    <textarea id="text" name="message" rows="4" cols="80">Maximum 4 lines please</textarea><br>
    </label>
    <label for="name">
    <span>Name:</span>
    <input id="name" type='text' name='who' size='50'/><br>
    </label>
    <label for="email">
    <span>Email:</span>
    <input id="email" type='text' name='email' size='50'/><br>
    </label>
    <label for="date">
    <span>Date:</span>
    <!-- You can use PHP functions to automatically get the value of date -->
    <input id="date" type='text' name='date' size='20'/><br>
    </label>
    <label for="time">
    <span>Time:</span>
    <!-- You can use PHP functions to automatically get the value of time -->
    <input id="time" type='text' name='time' size='20'/><br>
    </label>
    <label for="submit1" id="submit"><span>&nbsp;</span>
    <input id="submit1" class="submit" type="submit" name="submit" value="submit"/>
    </label>
    </fieldset>
    </form>
<?php
 } //close the else statement   
?>

  <head>
        <title>Upload Image</title>
        <link rel="stylesheet" type="text/css" href="style.css"/>
    </head>
    <body>
        <div id="page">
            <div id="header">
                <h1>File upload</h1>
            </div>
            <div id="main">
                <h2>Files to be uploaded</h2>
                <form id="upload_form"
                      action="." method="POST"
                      enctype="multipart/form-data">
                    <input type="hidden" name="action" value="upload"/>
                    <input type="file" name="file1"/><br />
                    <input id="upload_button" type="submit" value="Upload"/>
                </form>             
               


   
 