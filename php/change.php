<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Refresh:0; url=index.php");
}
require 'connect.php';
if(isset($_POST['submit']))
{  $p=$_POST['password'];
$u=$_SESSION['username'];
    $q="UPDATE attendance SET password='$p' WHERE crn='$u'";
    $s=mysqli_query($conn,$q);
}
?>
<link rel="shortcut icon" href="https://www.gndec.ac.in/sites/default/files/acquia_marina_favicon.png" type="image/x-icon" />
<title>CHANGE </title>
<form method="POST">
<input type="password" name="password" placeholder="New Password" required>
<button type="submit" name="submit">Change Password</button>
</form>