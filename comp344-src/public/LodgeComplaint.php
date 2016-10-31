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
