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

$status = 0; 	//order placed nto made
$address = test_input($_POST["address"]);
$customer_phone_no = test_input($_POST["customer_phone_no"]);
$query = "SELECT * FROM EMPLOYEE WHERE designation='Manager' ORDER BY RAND() LIMIT 1";
$result = mysql_query($query);
if(mysql_num_rows($result) == 1)
{	
	$row = mysql_fetch_assoc($result);
	$taken_by_employee_id = $row["employee_id"];
}
else
{	
	"Try again";
	exit();
}
$type = test_input($_POST["type"]);
$total_amount = 0;
$item_ids = $_POST["item_ids"];
$costs = $_POST["costs"];
$quantities = $_POST["quantities"];

if(sizeof($item_ids) == 0 || sizeof($item_ids)!= sizeof($costs) || sizeof($item_ids) != sizeof($quantities))
{
	echo "select some items to order";
}
else if(($address == "" && $type == "HOME_DELIVERY")|| $customer_phone_no == "")	// need to validate fields
{
	echo "fill all the fields";
}
// need to validate fields
else
{	
	for ($i=0; $i < sizeof($item_ids) ; $i++) {
		$total_amount += ($costs[$i] * $quantities[$i]);	
	}
	echo $total_amount;
	if($total_amount == 0)
	{
		echo "select some items to order";
		exit();
	}
	if ($type == "DINE_IN") {
			$already_occupied_tables = [];
		$query = "SELECT table_no FROM DINE_IN UNION SELECT table_no FROM APPROACHING_ORDER";
		$result = mysql_query($query);
		while($row = mysql_fetch_assoc($result)) {
			var_dump($row["table_no"]);
			$already_occupied_tables[] = $row["table_no"];
		}
		$flag = 0;
		for ($i=0; $i < 20; $i++) { 
			if(!in_array($i, $already_occupied_tables))
			{
				$flag = 1;
				$table_no = $i;
				break; 
			}
		}
		if($flag == 0)
		{
			echo "All tables occupied wait for some time and try again";
			exit();
		}
	}
	$query = "INSERT INTO CURRENT_ORDER (status, total_amount, customer_phone_no, date_time, taken_by_employee_id, type
		) VALUES ('" . $status . "','". $total_amount . "','". $customer_phone_no . "',Now(),'". $taken_by_employee_id . "','". $type . "')";
	mysql_query($query);
	$order_no = mysql_insert_id();
	if ($type == "HOME_DELIVERY") {
		$query = "SELECT employee_id FROM EMPLOYEE WHERE designation='Deliverer' ORDER BY RAND() LIMIT 1";
		$result = mysql_query($query);
		if(mysql_num_rows($result) == 1)
			$row = mysql_fetch_assoc($result);
		else
		{	
			"Try again";
			exit();
		}
		$delivery_employee_id = $row["employee_id"];
		echo "delivery_employee_id:". $delivery_employee_id;
		echo "order_no:". $order_no;
		echo "address:". $address;
		$query = "INSERT INTO HOME_DELIVERY (order_no, delivery_employee_id, address) VALUES (". $order_no. ",". $delivery_employee_id.",'". $address ."')";
		mysql_query($query);
	}
	$query = "INSERT INTO ORDER_ITEM (order_no, item_id, quantity) VALUES ";
	echo $order_no;
	$order_items = array();
	for ($i=0; $i < sizeof($item_ids) ; $i++) {
        $item_id = test_input( $item_ids[$i] );
        $quantity = test_input( $quantities[$i] );
        if ($quantity != 0) {
	        $valuesArr[] = "('$order_no', '$item_id', '$quantity')";
        }
	}
	$query .= implode(',', $valuesArr);
	mysql_query($query);
	if($flag == 1)
	{		
		echo "order_no:";
		echo $order_no;
		echo "table_no:";
		echo $table_no;
		$query = "INSERT INTO DINE_IN (order_no, table_no) VALUES (". $order_no. "," . $table_no. ")";
		echo "bye";
		mysql_query($query);
	}
	echo "Your order no is ". $order_no;
}
?>
