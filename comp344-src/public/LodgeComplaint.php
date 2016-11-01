<?php 
  require_once '../php/database.php';
  require_once '../php/session.php';
  require_once '../php/rbac.php';


  rbacEnforce();
  
function getOrders() {
    $rows = query("SELECT Order_id AS id, Order_Shopper AS shopper_id FROM Orders");
    return $rows;
}

$orders = getOrders();

?>

<html>
<head>
  <title></title>
  <?php require_once '../php/styles.php'; ?>
</head>
<body>
<?php require '../php/nav.php'; ?>


<div class="container content">

  <?php
  	if (isset($_SESSION['username'])) {
		echo "You have logged on as " . $_SESSION['username'];
		?>

<div id="content">	
<div class="box">
<h1>Lodge Complaint</h1>
		<div>
        <form action="" method="post">
        
			<label for="textfield">Order ID:</label>
      42612713</p>
        <p>
          <input type="radio" name="radio" id="radio" value="radio">
          <label for="radio">Shipment was damaged</label>
        </p>
        <p>
          <input type="radio" name="radio2" id="radio2" value="radio2">
          <label for="radio2">item was missing</label></p>
        <p>
          <input type="radio" name="radio3" id="radio3" value="radio3"><label for="radio2">Shipment has not arrived after 7 Days</label>
          </p>
        <p>
          <input type="submit" name="submit" id="submit" value="Submit">
		</p>
        </form>
        
        </div>
</div>			
</div>
</div>

     
        <?php
	} else {
		echo "Please login first.";
	}
  ?>


</div>

<?php require '../php/footer.php'; ?>
</body>
</html>
