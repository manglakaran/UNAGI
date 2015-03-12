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
$item_name = "Chandan";
$cost = "Kharbanda";
$item_id = "09052998663";
*/

$item_id = test_input($_POST["item_id"]);
$item_name = test_input($_POST["item_name"]);
$cost = test_input($_POST["cost"]);
$veg = test_input($_POST["veg"]);
$availability = test_input($_POST["availability"]);
$item_id_prev = test_input($_POST["item_id_prev"]);
if($item_name == "" || $cost == ""|| $item_id == "" ||$veg == "" || $item_id_prev == "")	// need to validate item_id
{
	echo "fill all the fields<br/>";
}
// need to validate item_id
else
{
	$query = "SELECT * FROM MENU_ITEM WHERE item_id='" . $item_id_prev . "'";
	$result = mysql_query($query);
	$existing = mysql_num_rows($result);
	if($existing == 1)
	{
		$query = "UPDATE MENU_ITEM SET item_id='". $item_id ."', item_name='". $item_name ."', cost='". $cost ."', veg='". $veg ."',availability='". $availability ."' WHERE item_id='".$item_id_prev."'";
		if(mysql_query($query))
			echo "updated successfully";
		else
			echo "unsuccessfull";
	}
	else
		echo "try again";
}
?>
