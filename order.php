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
		<script src="order.js"></script>
		<style type="text/css">
			.form-group {
				padding: 1% 0% 2% 0%;
			}
			#address_div {
				display: none;
			}
		</style>
	</head>
	<body>
		<!-- Bootstrap core CSS -->
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
		<h1>Place an order</h1>

		<form id="place_order" method="POST" role="form">
			<div class="form-group">
				Phone Number:<input id="customer_phone_no" size="13" class="form-control" type="tel" name="customer_phone_no" placeholder="Enter Phone Number" required>
			</div>
			<input type="radio" name="type" id="dine_in" value="DINE_IN" checked="checked">Dine in<br/>
			<input type="radio" name="type" id="home_delivery" value="HOME_DELIVERY">Home Delivery<br/>
			<div id="address_div">
				Address:<input id="address" class="form-control" name="address" placeholder="Enter Address" required>
			</div><br/>
			<button id="submit_button" type="button" class="btn btn-primary">Place Order</button>
		</form>
		<h1>Menu</h1>
		<table class="table table-striped table-condensed table-hover">
      <thead>
        <tr>
          <th>Item Id</th>
          <th>Item Name</th>
          <th>Cost</th>
          <th>Is it veg.</th>
          <th>Quantity</th>
        </tr>
      </thead>
      <tbody id="menu">
          <?php
            require 'connect_db.php';
            $query = "SELECT * FROM MENU_ITEM";
            $result = mysql_query($query);
            while($row = mysql_fetch_assoc($result)) {
            	if($row["availability"] == 1)
            	{	
		            echo "<tr clas='row' id= '" . $row["item_id"] . "'>";
		            echo "<td class='field'>". $row["item_id"] ."</td>";
		            echo "<td class='field'>". $row["item_name"] ."</td>";
		            echo "<td class='field'>". $row["cost"] ."</td>";
		            if($row["veg"] = 1)
		            	echo "<td class='field'>Yes</td>";
		            else	
		            	echo "<td class='field'>No</td>";
		            echo "<td class='input'><input type='number' value='0' name='quantity' min='0'></td>";
	              	echo "</tr>";
	          	}
            }
          ?>
      </tbody>
    </table>
		<h2 id="flash"></h2>
		</div>
	</body>
</html>
