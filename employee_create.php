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

if($f_name == "" || $l_name == "" || $address == "" || $phone_no == "" 
|| $email_id == "" || $employee_id == "" || $designation == "" || $salary == "" )	// need to validate fields
{
	echo "fill all the fields<br/>";
}
// need to validate fields
else
{
	$query = "SELECT * FROM EMPLOYEE WHERE employee_id='" . $employee_id . "'";
	$result = mysql_query($query);
	$existing = mysql_num_rows($result);
	if($existing == 0)
	{
		$query = "INSERT INTO EMPLOYEE (f_name, l_name, address, phone_no, email_id, employee_id, designation, salary
			) VALUES ('" . $f_name . "','". $l_name . "','". $address . "','". $phone_no 
			. "','". $email_id. "','". $employee_id. "','". $designation."','" . $salary . "')";
		mysql_query($query);
		echo "redgistered successfully";
	}
	else
		echo "id is already registered try again with another id";
}
?>
