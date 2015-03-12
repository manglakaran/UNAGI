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
$phone_no = "09052998663";
*/

$phone_no = test_input($_POST["phone_no"]);
$query = "SELECT * FROM CUSTOMER WHERE phone_no='" . $phone_no . "'";
$result = mysql_query($query);
$existing = mysql_num_rows($result);
if($existing == 1)
{
	$query = "DELETE FROM CUSTOMER WHERE phone_no='".$phone_no."'";
	mysql_query($query);
	echo "deleted successfully";
}
else
	echo "Deletion Unsuccessfull Try Again";
?>
