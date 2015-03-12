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
$item_id = "09052998663";
*/

$item_id = test_input($_POST["item_id"]);
$query = "SELECT * FROM MENU_ITEM WHERE item_id='" . $item_id . "'";
$result = mysql_query($query);
$existing = mysql_num_rows($result);
if($existing == 1)
{
	$query = "DELETE FROM MENU_ITEM WHERE item_id='".$item_id."'";
	if(mysql_query($query))
		echo "deleted successfully";
	else
		echo "Deletion Unsuccessfull Try Again";
}
else
	echo "Deletion Unsuccessfull Try Again";
?>
