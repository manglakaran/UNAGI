<?php
      session_start();
      if(!((isset($_SESSION['views'])) and $_SESSION['type'] == 'admin')){
        echo "<script>alert('You must be logged in as admin'); location.href = 'signin.php'</script>";
      }
?>
<!DOCTYPE html>
<html>
	<head>
		<script src="./jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<style type="text/css">
			.form-group {
				padding: 1% 0% 2% 0%;
			}
		</style>
		<script type="text/javascript">
		function flash (argument) {
			$("#flash").html(argument);
			$("#flash").fadeIn("slow");
		}
		function addEmployee()
		{
			$('#employee_create').submit(function(e){
				console.log("signup form submit");
				$.ajax({
				url:'./employee_create.php',
				type:"POST",
				data: {f_name:$('#f_name').val(), l_name:$('#l_name').val(), address:$('#address').val(), phone_no:$('#phone_no').val(), email_id:$('#email_id').val(), 
				employee_id:$('#employee_id').val(), designation:$('#designation').val(), salary:$('#salary').val()},
				success: function(x,y) {flash(x);}
				});
				e.preventDefault();
			});
		}
		function main (argument) {
			addEmployee();
		}
		window.addEventListener("load",main)
		</script>
	</head>
	<body>
		<link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/navbar-fixed-top.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Unagi</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <!--li class="active"><a href="./order.php">Place Order</a></li>
            <li class="active"><a href="./order_view.php">View Orders</a></li-->
            <li class="dropdown">
              <a aria-expanded="false" href="#" class="dropdown-toggle" data-toggle="dropdown">Order<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="order.php">Place Order</a></li>
                <li><a href="order_view.php">View Order</a></li>
                <li><a href="orderitem_view.php">Ordered Items</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a aria-expanded="false" href="#" class="dropdown-toggle" data-toggle="dropdown">Employee<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="employee.php">Add Employee</a></li>
                <li><a href="employee_view.php">View Employee</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a aria-expanded="false" href="#" class="dropdown-toggle" data-toggle="dropdown">Menu Item<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="menuitem.php">Add Menu Item</a></li>
                <li><a href="menuitem_view.php">View Menu Item</a></li>
              </ul>
            </li>

            <li class="dropdown">
              <a aria-expanded="false" href="#" class="dropdown-toggle" data-toggle="dropdown">Raw Material<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="rawmaterial.php">Add Raw Material</a></li>
                <li><a href="rawmaterial_view.php">View Raw Material</a></li>
              </ul>
            </li>

            <li class="dropdown">
              <a aria-expanded="false" href="#" class="dropdown-toggle" data-toggle="dropdown">Wholesaler<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="wholesaler.php">Add Wholesaler</a></li>
                <li><a href="wholesaler_view.php">View Wholesaler</a></li>
              </ul>
            </li>

            <li class="dropdown">
              <a aria-expanded="false" href="#" class="dropdown-toggle" data-toggle="dropdown">Customer<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="customer.php">Add Customer</a></li>
                <li><a href="customer_view.php">View Customer</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="./logout.php">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

		<div class="container">
		<br/><br/>
		<h1>Add Employee</h1>

		<form id="employee_create" method="POST" role="form">
			<div class="form-group">
				First Name:<input id="f_name" size="30" class="form-control" name="f_name" placeholder="Enter First Name" required>
			</div>
			<div class="form-group">
				Last Name:<input id="l_name" size="30" class="form-control" name="l_name" placeholder="Enter Last Name" required>
			</div>
			<div class="form-group">
				Address:<input id="address" class="form-control" name="address" placeholder="Enter Full Address" required>
			</div>
			<div class="form-group">
				Phone Number:<input id="phone_no" size="13" class="form-control" type="tel" name="phone_no" placeholder="Enter Phone Number" required>
			</div>
			<div class="form-group">
				Email:<input id="email_id" type="email" class="form-control" name="email_id" placeholder="Enter Email Id" required>
			</div>
			<div class="form-group">
				Id:<input id="employee_id" class="form-control" name="employee_id" placeholder="Enter Id" required>
			</div>
			<div class="form-group">
				Designation:<input id="designation" class="form-control" name="designation" placeholder="Enter Designation" required>
			</div>			
			<div class="form-group">
				Salary:<input id="salary" class="form-control" name="salary" placeholder="Enter Salary in Rs." required>
			</div>			
			<input type="submit" value="Add Employee" class="btn btn-primary">
		</form>
		<h2 id="flash"></h2>
		</div>
	</body>
</html>
