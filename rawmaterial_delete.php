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
$rm_id = "09052998663";
*/

$rm_id = test_input($_POST["rm_id"]);
$query = "SELECT * FROM RAW_MATERIAL WHERE rm_id='" . $rm_id . "'";
$result = mysql_query($query);
$existing = mysql_num_rows($result);
if($existing == 1)
{
	$query = "DELETE FROM RAW_MATERIAL WHERE rm_id='".$rm_id."'";
	mysql_query($query);
	echo "deleted successfully";
}
else
	echo "Deletion Unsuccessfull Try Again";
?>
