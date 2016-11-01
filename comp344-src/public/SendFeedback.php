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
<h1>Send Feedback</h1>
		<div>
        <form action="" method="post">
        
			<p>
        <input type="radio" name="radio" id="radio" value="radio">
        <label for="radio">Do you like the way information is presented.</label> 
         <input name="Yes" type="button" id="Yes" title="Yes" value="Yes">
         / 
         <input name="No" type="button" id="No" title="No" value="No">
      </p>
      <p>
        <input type="radio" name="radio2" id="radio2" value="radio2">
        Did any problems occur in shipping in the product. 
        <input name="Yes" type="button" id="Yes" title="Yes" value="Yes">
      / 
      <input name="No" type="button" id="No" title="No" value="No">
      </p>
      <p>
        <input type="radio" name="radio3" id="radio3" value="radio3">
        Behaviur between employee and customer was reasonable. 
        <input name="Yes" type="button" id="Yes" title="Yes" value="Yes">
      / 
      <input name="No" type="button" id="No" title="No" value="No">
      </p>
      <p>
        <input type="radio" name="radio4" id="radio4" value="radio4">
        Did product deliver on time. 
        <input name="Yes" type="button" id="Yes" title="Yes" value="Yes">
      /
      <input name="No" type="button" id="No" title="No" value="No">
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
