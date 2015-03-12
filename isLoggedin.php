<?php
      session_start();
      if(!isset($_SESSION['views'])){
        echo "<script>alert('You are not logged in'); location.href = 'signup.php'</script>";
      }
?>
