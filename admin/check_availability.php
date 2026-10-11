<?php
// Start the session to manage user authentication and session variables
session_start();

// Include the configuration file for database connection and other settings
include_once('../inc/config.php');

// code   username availablity
if(!empty($_POST["username"])) {
	$uname= $_POST["username"];
$query=mysqli_query($con,"select AdminuserName from tbladmin where AdminuserName='$uname'");		
$row=mysqli_num_rows($query);
if($row>0){
echo "<span style='color:red'> Username already exists. Try with another username</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else{
echo "<span style='color:green'> Username available for Registration .</span>";
echo "<script>$('#submit').prop('disabled',false);</script>";
}}
?>
