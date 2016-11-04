<?php 
require_once '../php/database.php';
require_once '../php/session.php';
require_once '../php/rbac.php';

function getOrders($username) {
	$sql = "SELECT shopper_id FROM Shopper WHERE sh_username='" . $username ."'";
	$shopper = query($sql);
	
	$shopper_id = $shopper[0]['shopper_id'];
	
	$sql = "SELECT Order_id AS id, Shopper.sh_email AS email, Order_PayDate as pay_date, Order_ShipDate AS ship_date, 
	Order_Total as total
	FROM Orders  
	INNER JOIN Shopper
	ON Orders.order_shopper = Shopper.shopper_id
	WHERE order_shopper='" . $shopper_id . "'";
    $rows = query($sql);
    return $rows;
}

rbacEnforce();
$orders = getOrders($_SESSION['username']);

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
  <div>
    <div>
      <h1>Order History</h1>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Order ID</th>
            <th>Customer Email</th>
            <th>Pay Date</th>
            <th>Ship Date</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($orders as $o) {
          echo "<tr>";
		  echo "<td><a href=\"DisplayOrderDetails.php?order_id={$o['id']}\">{$o['id']}</a></td>";
		  echo "<td>{$o['email']}</td>";
		  echo "<td>{$o['pay_date']}</td>";
		  echo "<td>{$o['ship_date']}</td>";
		  echo "<td>{$o['total']}</td>";
		  echo "</tr>";
        } ?>
        </tbody>
      </table>
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
