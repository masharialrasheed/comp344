<?php 
require_once '../php/database.php';
require_once '../php/session.php';
require_once '../php/rbac.php';

function getOrderDetail($order_id) {
	$sql = "SELECT Product.prod_name AS prod_name, Product.prod_desc AS prod_desc
	FROM Orders
	INNER JOIN OrderProduct
	ON Orders.order_id = OrderProduct.op_order_id
	INNER JOIN Product
	ON OrderProduct.op_prod_id=Product.prod_id
	WHERE order_id='" . $order_id . "'";
    $rows = query($sql);
    return $rows;
}

rbacEnforce();
$orders = getOrderDetail($_GET["order_id"]);

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
      <h1>Order# <?php echo $_GET["order_id"]; ?></h1>
      <form method="post">
      <input name="order_id" type="hidden" value="<?php echo $_GET["order_id"]; ?>">
      <table class="table table-bordered">
        <thead>
          <tr>
            <td>Product Name</td>
            <td>Product Description</td>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($orders as $o) {
          echo "<tr>";
		  echo "<td>{$o['prod_name']}</td>";
		  echo "<td>{$o['prod_desc']}</td>";
		  echo "</tr>";
        } ?>
        </tbody>
      </table>
      Process:
      <select>
      <option>Refund</option>
      <option>Resend</option>
      </select>
      <input name="" type="submit">
      </form>
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
