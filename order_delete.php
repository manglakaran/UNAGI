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
$order_no = "09052998663";
*/

$order_no = test_input($_POST["order_no"]);
$query = "SELECT * FROM CURRENT_ORDER WHERE order_no='" . $order_no . "'";
$result = mysql_query($query);
$existing = mysql_num_rows($result);
$row = mysql_fetch_array($result);
if($existing == 1 and $row["status"] == 0)
{
	$query1 = "DELETE FROM ORDER_ITEM WHERE order_no='".$order_no."'";
	$query = "DELETE FROM CURRENT_ORDER WHERE order_no='".$order_no."'";
	if(mysql_query($query) and mysql_query($query1))
	{
		if($row["type"] == "HOME_DELIVERY")
		{
			$query = "DELETE FROM HOME_DELIVERY WHERE order_no='".$order_no."'";
			if(mysql_query($query))
				echo "deleted successfully";
			else
				echo "error";
		}
		else
		{
			$query = "DELETE FROM DINE_IN WHERE order_no='".$order_no."'";
			if(mysql_query($query))
				echo "deleted successfully";
			else
				"error";
		}
	}
	else
		echo "Try Again";
}
else
	echo "Deletion Unsuccessfull Try Again Status should be 0";
?>
