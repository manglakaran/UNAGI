<?php
      session_start();
      if(!((isset($_SESSION['views'])) and $_SESSION['type'] == 'admin')){
        echo "<script>alert('You must be logged in as admin'); location.href = 'signin.php'</script>";
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
$wholesaler_id = "09052998663";
*/

$wholesaler_id = test_input($_POST["wholesaler_id"]);
$query = "SELECT * FROM WHOLESALER WHERE wholesaler_id='" . $wholesaler_id . "'";
$result = mysql_query($query);
$existing = mysql_num_rows($result);
if($existing == 1)
{
	$query = "DELETE FROM WHOLESALER WHERE wholesaler_id='".$wholesaler_id."'";
	mysql_query($query);
	echo "deleted successfully";
}
else
	echo "Deletion Unsuccessfull Try Again";
?>
