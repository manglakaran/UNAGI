<?php

$flag = 0;
require 'connect_db.php';

$username=$_POST['name'];
$password=$_POST['password'];
session_start();
if(isset($_SESSION['views'])) 
{
   $msg = 'You are already logged in ' . $_SESSION['username'];
}
	$query = "SELECT * FROM AUTH WHERE username = '$username' AND password = '$password' LIMIT 1";
	$result = mysql_query($query);
	if($row = mysql_fetch_array($result)) {
		$_SESSION['username'] = $row['username'];
		$_SESSION['type'] = $row['type'];
		$_SESSION['views'] = 1;
		$flag = 1;
		$msg = 'Login Successful';
	}
	else {
		$msg = "*Invalid username or password";
	}

if($flag == 1)
	echo "<script>alert('".$msg."'); location.href='./order.php'; </script>";
else {
	echo "<script>alert('".$msg."'); location.href='./signin.php'; </script>";
}
?>
