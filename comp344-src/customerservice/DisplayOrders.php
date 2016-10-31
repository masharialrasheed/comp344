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

<div id="content">	<div class="box">

					
		<h1>Order History</h1>
				<div class="order-list">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<td>Order ID:</td>
						<td>Customer:</td>
						<td>Date Added:</td>
						<td>Products:</td>
						<td>Status:</td>
						<td>Total:</td>
					</tr>
				</thead>
				<tbody>
										<tr>
						<td>#2014174</td>
						<td>Mashari Alrasheed</td>
						<td>01/10/2016</td>
						<td>1</td>
						<td class="order-status">Shipped </td>
						<td class="order-total">AU$308.95</td>
					</tr>
                     <?php foreach ($orders as $o) {
          echo "<tr><td>{$o['id']}</td><td>{$o['shopper_id']}</td></tr>";
        } ?>
									</tbody>
			</table>
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
