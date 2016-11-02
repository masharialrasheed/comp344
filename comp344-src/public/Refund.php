<?php 
  require_once '../php/database.php';
  require_once '../php/session.php';
  require_once '../php/rbac.php';


  rbacEnforce();
  
  if (isset($_POST['order_id'])) {
	$sp = new SecurePay('ABC0001','abc123');
	$sp->TestMode(); // Remove this line to actually preform a transaction
	
	$sp->TestConnection();
	print_r($sp->ResponseXml);
	
	$sp->Cc = 4444333322221111;
	$sp->ExpiryDate = '07/17';
	$sp->ChargeAmount = 123;
	$sp->ChargeCurrency = 'AUD';
	$sp->Cvv = 321;
	$sp->OrderId = 'ORD34234';
	if ($sp->Valid()) { // Is the above data valid?
		$response = $sp->Process();
		if ($response == SECUREPAY_STATUS_APPROVED) {
			echo "Transaction was a success\n";
		} else {
			echo "Transaction failed with the error code: $response\n";
			echo "XML Dump: " . print_r($sp->ResponseXml,1) . "\n";
		}
	} else {
		die("Your data is invalid\n");
	}

	
}


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
<h1>Refund</h1>
		<div>
        <form action="Refund.php" method="post">
        Order ID: 1
        <br>
        
        <input name="" type="submit">
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
