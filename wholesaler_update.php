<?php
      session_start();
      if(!((isset($_SESSION['views'])) and $_SESSION['type'] == 'admin')){
        echo "<script>alert('You must be logged in as admin'); location.href = 'signin.php'</script>";
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

$wholesaler_id = test_input($_POST["wholesaler_id"]);
$wholesaler_name = test_input($_POST["wholesaler_name"]);
$phone_no = test_input($_POST["phone_no"]);
$current_order = test_input($_POST["current_order"]);
$address = test_input($_POST["address"]);
$payment = test_input($_POST["payment"]);
if($wholesaler_id == "" || $wholesaler_name == ""|| $phone_no == "" || $current_order == ""|| $address == ""|| $payment == "")	// need to validate phone_no
{
	echo "fill all the fields<br/>";
}
// need to validate phone_no
else
{
	echo $wholesaler_id;
	$query = "SELECT * FROM WHOLESALER WHERE wholesaler_id='" . $wholesaler_id . "'";
	$result = mysql_query($query);
	$existing = mysql_num_rows($result);
	if($existing == 1)
	{
		$query = "UPDATE WHOLESALER SET wholesaler_name='". $wholesaler_name ."', phone_no='". $phone_no ."', current_order='". $current_order ."', address='". $address ."',payment='". $payment ."' WHERE wholesaler_id='".$wholesaler_id."'";
		mysql_query($query);
		echo "updated successfully";
	}
	else
		echo "unsuccessfull";
}
?>
