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

$employee_id = test_input($_POST["employee_id"]);

$query = "SELECT * FROM EMPLOYEE WHERE employee_id='" . $employee_id . "'";
$result = mysql_query($query);
$existing = mysql_num_rows($result);
if($existing == 1)
{
	$query = "DELETE FROM EMPLOYEE WHERE employee_id='" . $employee_id."'";
	mysql_query($query);
	echo "deleted successfully";
}
else
	echo "Deletion Unsuccessfull Try Again";
?>
