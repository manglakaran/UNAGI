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
$phone_no = "09052998663";
*/

$f_name = test_input($_POST["f_name"]);
$l_name = test_input($_POST["l_name"]);
$address = test_input($_POST["address"]);
$phone_no = test_input($_POST["phone_no"]);
$email_id = test_input($_POST["email_id"]);
$employee_id = test_input($_POST["employee_id"]);
$designation = test_input($_POST["designation"]);
$salary = test_input($_POST["salary"]);
$employee_id_prev = test_input($_POST["employee_id_prev"]);
if($f_name == "" || $l_name == ""|| $address == "" || $phone_no == "" || $email_id == ""|| $employee_id == "" || $designation == "" || $salary == "" || $employee_id_prev == "")	// need to validate phone_no
{
	echo "fill all the fields<br/>";
}
// need to validate phone_no
else
{
	$query = "SELECT * FROM EMPLOYEE WHERE employee_id='" . $employee_id_prev . "'";
	$result = mysql_query($query);
	$existing = mysql_num_rows($result);
	if($existing == 1)
	{
		$query = "UPDATE EMPLOYEE SET f_name='". $f_name ."', l_name='". $l_name ."', address='". $address ."',phone_no='". $phone_no ."', email_id='". $email_id ."', employee_id='". $employee_id ."', designation='". $designation ."', salary='". $salary ."' WHERE employee_id='".$employee_id_prev."'";
		mysql_query($query);
		echo "updated successfully";
	}
	else
		echo "unsuccessfull";
}
?>
