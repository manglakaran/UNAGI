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

$rm_id = test_input($_POST["rm_id"]);
$rm_name = test_input($_POST["rm_name"]);
$stock_left = test_input($_POST["stock_left"]);
$required_stock = test_input($_POST["required_stock"]);
$minimum_stock = test_input($_POST["minimum_stock"]);
$status = test_input($_POST["status"]);
if($rm_id == "" || $rm_name == ""|| $stock_left == "" || $required_stock == ""|| $minimum_stock == ""|| $status == "")	// need to validate phone_no
{
	echo "fill all the fields<br/>";
}
// need to validate phone_no
else
{
	echo $rm_id;
	$query = "SELECT * FROM RAW_MATERIAL WHERE rm_id='" . $rm_id . "'";
	$result = mysql_query($query);
	$existing = mysql_num_rows($result);
	if($existing == 1)
	{
		$query = "UPDATE RAW_MATERIAL SET rm_name='". $rm_name ."', stock_left='". $stock_left ."', required_stock='". $required_stock ."', minimum_stock='". $minimum_stock ."',status='". $status ."' WHERE rm_id='".$rm_id."'";
		mysql_query($query);
		echo "updated successfully";
	}
	else
		echo "unsuccessfull";
}
?>
