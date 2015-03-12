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
if($existing == 1)
{
	$row = mysql_fetch_array($result);
	//copy
	$amount = $row["total_amount"];
	$date = "date('" .$row["date_time"]."')";
	$query = "SELECT * from SALES WHERE date=". $date;
	$result = mysql_query($query);
	$existing = mysql_num_rows($result);
	if($existing == 0)
		$query1 = "INSERT INTO SALES ( date , amount) VALUES (" . $date . ",'". $amount . "')";
	else
	{
		$rowsales = mysql_fetch_array($result);
		var_dump($rowsales);
		echo $rowsales["amount"];
		echo " ";
		$amount = $amount + $rowsales["amount"];
		echo $amount;
		$query1 = "UPDATE SALES SET amount=". $amount . " WHERE date=" . $date ;
	}
	$query = "INSERT INTO FINISHED_ORDER (order_no, taken_by_employee_id, customer_phone_no, total_amount, date_time) VALUES ('" . $row["order_no"] . "','". $row["taken_by_employee_id"] ."','". $row["customer_phone_no"] ."','". $row["total_amount"] ."','" . $row["date_time"] . "')";
	if($row["status"] == 1 and mysql_query($query) and mysql_query($query1))
	{
		//deletion
		$query1 = "DELETE FROM ORDER_ITEM WHERE order_no='".$order_no."'";
		$query = "DELETE FROM CURRENT_ORDER WHERE order_no='".$order_no."'";
		if(mysql_query($query) and mysql_query($query1))
		{
			if($row["type"] == "HOME_DELIVERY")
			{
				$query = "DELETE FROM HOME_DELIVERY WHERE order_no='".$order_no."'";
				if(mysql_query($query))
					echo "finished";
				else
					echo "error";
			}
			else
			{
				$query = "DELETE FROM DINE_IN WHERE order_no='".$order_no."'";
				if(mysql_query($query))
					echo "finished";
				else
					"Error";
			}
		}
		else
			echo "Try Again";
	}
	else
		echo "Try Again Check if status is 1";
}
else
	echo "Deletion Unsuccessfull Try Again";
?>
