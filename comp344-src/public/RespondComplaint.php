<?php 
require_once '../php/database.php';
require_once '../php/session.php';
require_once '../php/rbac.php';

function complain($order_id) {
	$sql = "SELECT Shopper.sh_email AS email
	FROM Orders  
	INNER JOIN Shopper
	ON Orders.order_shopper = Shopper.shopper_id
	WHERE Order_id='{$order_id}'";
	
	$shopper = query($sql);
	$shopper_email = $shopper[0]['email'];

$from = $shopper_email;
$to = "comp344@outlook.com";
$subject = "Complaint";
$message = "Please {$_POST['request']} {$order_id} because {$_POST['complaint']}";
$headers = "From: " . $from;

mail($to, $subject, $message, $headers);
echo "<p>The email has been sent to</p>";
echo "<p>$to</p>";
}

rbacEnforce();
complain($_POST['order_id']);

?>
<html>
<head>
<title>Respond Complaint</title>
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
      <div>Apologies. We will attend to your complaint ASAP.</div>
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
