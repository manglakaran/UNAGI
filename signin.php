<!DOCTYPE html>
<html lang="en">
<head>

    <title>Log In</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/starter-template.css" rel="stylesheet">
    <script src="css/ie-emulation-modes-warning.js"></script>
  </head>

  <body>
     <?php
      session_start();
      if(isset($_SESSION['views'])){
        echo "<script>alert('You are already logged in'); location.href = 'order.php'</script>";
      }
    ?>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="order.php">Unagi</a>
        </div>
      </div>
    </nav>

    <div class="container">

      <div class="starter-template">
        <div class='col-md-4'></div>
        <form class="col-md-4 form-signin" role="form" action='checklogin.php' method='post'>
          <h2 class="form-signin-heading">Login - </h2>
          <br />
          <input class="form-control" id='name' name='name' placeholder='Employee Name' required="" autofocus="" type='text'>
          <input class="form-control" id='pass' name='password' placeholder='Password' required="" autofocus="" type='password'>
          <br />
          <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
        </form>
      </div>

    </div>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  
<script type="text/javascript">
    document.getElementById("pass").value = "";
    document.getElementById("name").value = "";
</script>

</body>
</html>
