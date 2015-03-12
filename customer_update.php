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

$f_name = test_input($_POST["f_name"]);
$l_name = test_input($_POST["l_name"]);
$phone_no = test_input($_POST["phone_no"]);
$phone_no_prev = test_input($_POST["phone_no_prev"]);
if($f_name == "" || $l_name == ""|| $phone_no == "" || $phone_no_prev == "")	// need to validate phone_no
{
	echo "fill all the fields<br/>";
}
// need to validate phone_no
else
{
	$query = "SELECT * FROM CUSTOMER WHERE phone_no='" . $phone_no_prev . "'";
	$result = mysql_query($query);
	$existing = mysql_num_rows($result);
	if($existing == 1)
	{
		$query = "UPDATE CUSTOMER SET f_name='". $f_name ."', l_name='". $l_name ."',phone_no='". $phone_no ."' WHERE phone_no='".$phone_no_prev."'";
		mysql_query($query);
		echo "updated successfully";
	}
	else
		echo "unsuccessfull";
}
?>
