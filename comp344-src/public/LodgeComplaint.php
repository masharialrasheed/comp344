<?php 
require_once '../php/database.php';
require_once '../php/session.php';
require_once '../php/rbac.php';

function getOrders($username) {
	$sql = "SELECT shopper_id FROM Shopper WHERE sh_username='" . $username ."'";
	$shopper = query($sql);
	
	$shopper_id = $shopper[0]['shopper_id'];
	
	$sql = "SELECT Order_id AS id
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
<title>Lodge Complaint</title>
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
        <form method="post" action="RespondComplaint.php">
       
          <p>
            <label for="select">Order ID:</label>
            <select name="order_id">
              <?php 
				foreach ($orders as $o) {
  					echo "<option value=\"{$o['id']}\">{$o['id']}</option>";
				}
			?>
            </select>
          </p>
          <p>
            <input type="radio" name="complaint" value="damaged">
            <label for="radio">Shipment was damaged</label>
          </p>
          <p>
            <input type="radio" name="complaint" value="missing">
            <label for="radio2">Item was missing</label>
          </p>
          <p>
            <input type="radio" name="complaint" value="late">
            <label for="radio2">Shipment has not arrived after 7 days</label>
          </p>
          <p>
            <label for="select">Action request:</label>
            <select name="request">
              <option value="refund">Refund</option>
              <option value="resend">Resend</option>
            </select>
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
