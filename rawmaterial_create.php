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
$rm_name = "Chandan";
$l_name = "Kharbanda";
$phone_no = "09052998663";
*/

$rm_name = test_input($_POST["rm_name"]);
$stock_left = test_input($_POST["stock_left"]);
$required_stock = test_input($_POST["required_stock"]);
$minimum_stock = test_input($_POST["minimum_stock"]);
$status = test_input($_POST["status"]);
if($rm_name == "" || $stock_left == ""|| $required_stock == "" || $minimum_stock == "" || $status == "")	// need to validate phone_no
{
	echo "fill all the fields<br/>";
}
// need to validate phone_no
else
{
	$query = "INSERT INTO RAW_MATERIAL (rm_name, stock_left, required_stock, minimum_stock, status) VALUES ('" . $rm_name . "','". $stock_left ."','". $required_stock ."','". $minimum_stock ."','" . $status . "')";
	if(mysql_query($query))
		echo "added successfully";
	else
		echo "unsuccessfull";
}
?>
