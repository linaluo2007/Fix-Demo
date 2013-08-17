<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
$userid=$_SESSION['userid'];
$username=$_SESSION['username'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">  

       <h1><center>Fix&Demo Member Page</center></h1>
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
        <li><a href="contact.html">Contact Us</a></li>
        <li><a href="./login.php">Sign In</a></li>
        <li><a href="./member.php">Member Page</a></li>
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
    
    if($username && $userid){
        echo"Welcome<b>$username</b>,<a href='./logout.php'>Logout Page</a>";
    }
    else
        echo"Please login to access this page.<a href='./login.php'>Login Here</a>; ";
    ?>
<?php
function get_file_list($path) {
    $files = array();
    if (!is_dir($path)) return $files;

    $items = scandir($path);
    foreach ($items as $item) {
         $item_path = $path . DIRECTORY_SEPARATOR . $item;
         if (is_file($item_path)) {
             $files[] = $item;
         }
    }
    return $files;
}
?>
<?php
function process_image($dir, $filename) {
    // Set up the variables
    $dir = $dir . DIRECTORY_SEPARATOR;
    $i = strrpos($filename, '.');
    $image_name = substr($filename, 0, $i);
    $ext = substr($filename, $i);

    // Set up the read path
    $image_path = $dir . DIRECTORY_SEPARATOR . $filename;

    // Set up the write paths
    $image_path_400 = $dir . $image_name . '_400' . $ext;
    $image_path_100 = $dir . $image_name . '_100' . $ext;

    // Create an image that's a maximum of 400x300 pixels
    resize_image($image_path, $image_path_400, 400, 300);

    // Create a thumbnail image that's a maximum of 100x100 pixels
    resize_image($image_path, $image_path_100, 100, 100);
}

/*******************************************
 * Resize image to 400x300 max
 ********************************************/
function resize_image($old_image_path, $new_image_path,
        $max_width, $max_height) {

    // Get image type
    $image_info = getimagesize($old_image_path);
    $image_type = $image_info[2];

    // Set up the function names
    switch($image_type) {
        case IMAGETYPE_JPEG:
            $image_from_file = 'imagecreatefromjpeg';
            $image_to_file = 'imagejpeg';
            break;
        case IMAGETYPE_GIF:
            $image_from_file = 'imagecreatefromgif';
            $image_to_file = 'imagegif';
            break;
        case IMAGETYPE_PNG:
            $image_from_file = 'imagecreatefrompng';
            $image_to_file = 'imagepng';
            break;
        default:
            echo 'File must be a JPEG, GIF, or PNG image.';
            exit;
    }

    // Get the old image and its height and width
    $old_image = $image_from_file($old_image_path);
    $old_width = imagesx($old_image);
    $old_height = imagesy($old_image);

    // Calculate height and width ratios
    $width_ratio = $old_width / $max_width;
    $height_ratio = $old_height / $max_height;

    // If image is larger than specified ratio, create the new image
    if ($width_ratio > 1 || $height_ratio > 1) {

        // Calculate height and width for the new image
        $ratio = max($width_ratio, $height_ratio);
        $new_height = round($old_height / $ratio);
        $new_width = round($old_width / $ratio);

        // Create the new image
        $new_image = imagecreatetruecolor($new_width, $new_height);

        // Set transparency according to image type
        if ($image_type == IMAGETYPE_GIF) {
            $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
            imagecolortransparent($new_image, $alpha);
        }
        if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
            imagealphablending($new_image, false);
            imagesavealpha($new_image, true);
        }

        // Copy old image to new image - this resizes the image
        $new_x = 0;
        $new_y = 0;
        $old_x = 0;
        $old_y = 0;
        imagecopyresampled($new_image, $old_image,
                           $new_x, $new_y, $old_x, $old_y,
                           $new_width, $new_height, $old_width, $old_height);

        // Write the new image to a new file
        $image_to_file($new_image, $new_image_path);

        // Free any memory associated with the new image
        imagedestroy($new_image);
    } else {
        // Write the old image to a new file
        $image_to_file($old_image, $new_image_path);
    }
    // Free any memory associated with the old image
    imagedestroy($old_image);
}

?>


<?php

$image_dir = 'images';
$image_dir_path = getcwd() . DIRECTORY_SEPARATOR . $image_dir;

$action = '';
if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

switch ($action) {
    case 'upload':
        if (isset($_FILES['file1'])) {
            $filename = $_FILES['file1']['name'];
            if (empty($filename)) {
                break;
            }
            $source = $_FILES['file1']['tmp_name'];
            $target = $image_dir_path . DIRECTORY_SEPARATOR . $filename;
            move_uploaded_file($source, $target);

            // create the '400' and '100' versions of the image
            process_image($image_dir_path, $filename);
        }
        break;
    case 'delete':
        $filename = $_GET['filename'];
        $target = $image_dir_path . DIRECTORY_SEPARATOR . $filename;
        if (file_exists($target)) {
            unlink($target);
        }
        break;
}

$files = get_file_list($image_dir_path);

?>
<?php
  $form ="<form action='./member.php' method='post'>
    <table>
    <tr>
     <td></td>
     <td></td>
    </tr>
    <tr>
     <td>First Name:</td>
     <td><input type='text' name='firstName'/></td>
    </tr>
     <tr>
     <td>Last Name:</td>
     <td><input type='text' name='LastName' value=''/></td>
    </tr>
     <tr>
     <td>Email Address:</td>
     <td><input type='email' name='emailAddress' value=''/></td>
    </tr>
    <tr>
     <td>Adress:</td>
     <td><input type='text' name='address' value=''/></td>
    </tr>
    <td>Service Request:</td>
     <td><input type='text' name='service' value=''/></td>
    </tr>
     <td></td>
     <td><input type='submit' name='registerbtn' value='submit'/></td>
    </tr>
    </table>
    
    </table>
    </form>";
    
  echo $form;
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
                <h2>Files in the directory</h2>
                <?php if (count($files) == 0) : ?>
                    <p>No files uploaded.</p>
                <?php else: ?>
                    <ul>
                    <?php foreach($files as $filename) :
                        $file_url = $image_dir . '/' .
                                    $filename;
                        $delete_url = '.?action=delete&filename=' .
                                      urlencode($filename);
                    ?>
                        <li>
                            <a href="<?php echo $delete_url;?>">
                                <img src="delete.png" alt="Delete"/></a>
                            <a href="<?php echo $file_url; ?>">
                                <?php echo $filename; ?></a>
                        </li>
                    <?php endforeach; ?>
                        
                    </ul>
                <?php endif; ?>
            </div><!-- end main -->
        </div><!-- end page -->
    </body>
</html>
