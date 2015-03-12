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


$item_id = test_input($_POST["item_id"]);
$item_name = test_input($_POST["item_name"]);
$cost = test_input($_POST["cost"]);
$veg = test_input($_POST["veg"]);
if($item_id == "" || $item_name == ""|| $cost == "" || $veg == "")	
{
	echo "fill all the fields<br/>";
}
//validation
else
{
	$query = "INSERT INTO MENU_ITEM (item_id, item_name, cost, veg, availability) VALUES ('" . $item_id . "','". $item_name ."','" . $cost ."','" . $veg . "', '1' )";
	if(mysql_query($query))
		echo "added successfully";
	else
		echo "select unique id";
}
?>
