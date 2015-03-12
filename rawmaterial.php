<?php
    session_start();
    if(!isset($_SESSION['views'])){
        echo "<script>alert('You must be logged in'); location.href = 'signin.php'</script>";
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
		function addRawmaterial()
		{
			$('#rawmaterial_create').submit(function(e){
				$.ajax({
				url:'./rawmaterial_create.php',
				type:"POST",
				data: {rm_name:$('#rm_name').val(), stock_left:$('#stock_left').val(), required_stock:$('#required_stock').val(), minimum_stock:$('#minimum_stock').val(), status:$('#status').val()},
				success: function(x,y) {flash(x);}
				});
				e.preventDefault();
			});
		}
		function main (argument) {
			addRawmaterial();
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

		<br/><br/>
		<div class="container">
		<h1>Add Rawmaterial</h1>

		<form id="rawmaterial_create" method="POST" role="form">
			<div class="form-group">
				Raw Material Name:<input id="rm_name" size="30" class="form-control" name="rm_name" placeholder="Raw material name" required>
			</div>
			<div class="form-group">
				Stock Left:<input id="stock_left" class="form-control" type="number" min="0" name="stock_left" value="0" required>
			</div>
			<div class="form-group">
				Required Stock:<input id="required_stock" class="form-control" min="0" type="number" name="required_stock" value="0" required>
			</div>
			<div class="form-group">
				Minimum Stock:<input id="minimum_stock" class="form-control" min="0" type="number" name="minimum_stock" value="0" required>
			</div>
			<div class="form-group">
				Status:<input id="status" class="form-control" type="number" min="0" max="1" name="status" value="0" required>
			</div>			
			<input type="submit" value="Add Rawmaterial" class="btn btn-primary">
		</form>
		<h2 id="flash"></h2>
		</div>
	</body>
</html>
