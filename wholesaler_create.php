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
$wholesaler_name = "Chandan";
$l_name = "Kharbanda";
$phone_no = "09052998663";
*/

$wholesaler_name = test_input($_POST["wholesaler_name"]);
$address = test_input($_POST["address"]);
$phone_no = test_input($_POST["phone_no"]);
$current_order = test_input($_POST["current_order"]);
$payment = test_input($_POST["payment"]);
if($wholesaler_name == "" || $address == ""|| $phone_no == "" || $current_order == "" || $payment == "")	// need to validate phone_no
{
	echo "fill all the fields<br/>";
}
// need to validate phone_no
else
{
	$query = "INSERT INTO WHOLESALER (wholesaler_name, address, phone_no, current_order, payment) VALUES ('" . $wholesaler_name . "','". $address ."','". $phone_no ."','". $current_order ."','" . $payment . "')";
	if(mysql_query($query))
		echo "added successfully";
	else
		echo "unsuccessfull";
}
?>
