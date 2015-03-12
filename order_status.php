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

$order_no = test_input($_POST["order_no"]);
echo $order_no;
if($order_no == "")	
{
	echo "fill all the fields<br/>";
}
else
{
	$query = "SELECT * FROM CURRENT_ORDER WHERE order_no='" . $order_no . "'";
	$result = mysql_query($query);
	$existing = mysql_num_rows($result);
	if($existing == 1)
	{
		$query = "UPDATE CURRENT_ORDER SET status=1 WHERE order_no='" . $order_no . "'";
		if(mysql_query($query))
			echo "order is ready";
	}
	else
		echo "try again";
}
?>
