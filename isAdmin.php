<?php
    session_start();
    if(!(isset($_SESSION['views']))
	{
 	      	 echo "<script>alert('You must be logged in.'); location.href = 'signin.php'</script>";
	}
	else if($_SESSION['type'] == 'employee'){
        echo "<script>alert('You must be logged in as admin'); location.href = 'order.php'</script>";
    }
?>
