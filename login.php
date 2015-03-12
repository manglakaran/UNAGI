<?php
include "connect_db.php";
function test_input($data)
{
        $data = htmlspecialchars($data);
        $data = trim($data);
        $data = stripslashes($data);
        return $data;
}
$username = test_input($_POST["username"]);
$pwd = test_input($_POST["pwd"]);
if($username == "" || $pwd == "")
{
	echo "fill all the fields<br/>";
}
else
{
	$query = "SELECT * FROM members WHERE username='" . $username . "' AND password='". $pwd ."'";
	$result = mysql_query($query);
	$existing = mysql_num_rows($result);
	if($existing == 0)
	{
		echo "wrong credentials!<br/>";		
	}
	elseif($existing == 1)
	{
		$row = mysql_fetch_array($result);
		echo "found:" . $row['username'] . "<br/>";
		session_start();
		$_SESSION['username'] = $username;
		$_SESSION['ltime'] = time();
		$url = "main.php";
		//alert("successfull login!");
		echo '<script>window.location = "' . $url . '";</script>';
	}
	else
	{
		echo "serious error in db<br/>";
	}
}
?>
