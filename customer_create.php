<?php
    session_start();
    if(!isset($_SESSION['views'])){
        echo "<script>alert('You must be logged in'); location.href = 'signin.php'</script>";
    }
?>

<?php
include "connect_db.php";
function test_input($data)
{
        $data = htmlspecialchars($data);
        $data = trim($data);
        $data = stripslashes($data);
        return $data;
}

/*
$f_name = "Chandan";
$l_name = "Kharbanda";
$phone_no = "09052998663";
*/

$f_name = test_input($_POST["f_name"]);
$l_name = test_input($_POST["l_name"]);
$phone_no = test_input($_POST["phone_no"]);
if($f_name == "" || $l_name == ""|| $phone_no == "")	// need to validate phone_no
{
	echo "fill all the fields<br/>";
}
// need to validate phone_no
else
{
	$query = "SELECT * FROM CUSTOMER WHERE phone_no='" . $phone_no . "'";
	$result = mysql_query($query);
	$existing = mysql_num_rows($result);
	if($existing == 0)
	{
		$query = "INSERT INTO CUSTOMER (f_name, l_name, phone_no) VALUES ('" . $f_name . "','". $l_name ."','" . $phone_no . "')";
		mysql_query($query);
		echo "redgistered successfully";
	}
	else
		echo "phone number is already registeres try again with another phone number";
}
?>
