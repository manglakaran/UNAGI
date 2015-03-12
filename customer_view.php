<?php
    session_start();
    if(!isset($_SESSION['views'])){
        echo "<script>alert('You must be logged in'); location.href = 'signin.php'</script>";
    }
?>

<!DOCTYPE html>
<html>
  <head>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

      <!-- Custom styles for this template -->
    <link href="css/starter-template.css" rel="stylesheet">
    <script src="css/ie-emulation-modes-warning.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="./jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/edit.js"></script>
    <script type="text/javascript">
    tableIndexes = ["phone_no_prev", "f_name", "l_name", "phone_no"];
      function deleteCustomer () {
        var parent = $(this).parent();
        $.ajax({
          url:'./customer_delete.php',
          type:"POST",
          data: {"phone_no" : parent.attr('id')},
          success: function(x,y) {alert(x); location.reload();}
        });
      }
      function update (tr_element) {
        dataObj = {};
        i = 0;
        dataObj[tableIndexes[i++]] = tr_element.attr('id');
        tr_element.children('td').each(function () {
        if(this.className == 'field')
          dataObj[tableIndexes[i++]] = $(this).html();
        });
        console.log(dataObj);
        $.ajax({
          url:'./customer_update.php',
          type:"POST",
          data: dataObj,
          success: function(x,y) {alert(x); location.reload();}
        });
      } 
      
      function main () {
        onClickEdit();
        $('.delete').click(deleteCustomer);
      }
      window.addEventListener("load",main);
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

    <h1>Customers</h1>
    <table class="table table-striped table-condensed table-hover">
      <thead>
        <tr>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Phone Number</th>
        </tr>
      </thead>
      <tbody>
          <?php
            require 'connect_db.php';
            $query = "SELECT * FROM CUSTOMER";
            $result = mysql_query($query);
            while($row = mysql_fetch_assoc($result)) {
              echo "<tr class='phone_nos' id=". $row["phone_no"] .">";
              echo "<td class='field'>". $row["f_name"] ."</td>";
              echo "<td class='field'>". $row["l_name"] ."</td>";
              echo "<td class='field'>". $row["phone_no"] ."</td>";
              echo "<td class='edit'><button>Edit</button></td>";
              echo "<td class='delete'><button>Delete</button></td>";
              echo "</tr>";
            }
          ?>
      </tbody>
    </table>
  </body>
</html>
