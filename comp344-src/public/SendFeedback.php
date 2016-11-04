<?php 
require_once '../php/database.php';
require_once '../php/session.php';
require_once '../php/rbac.php';
  
function feedback($username) {
	$sql = "SELECT sh_email FROM Shopper WHERE sh_username='" . $username ."'";
	$shopper = query($sql);
	$shopper_email = $shopper[0]['sh_email'];
	
	$from = $shopper_email;
	$to = "comp344@outlook.com";
	$subject = "Feedback";
	$message = "Do you like the way information is presented? {$_POST['presentation']}";
	$headers = "From: " . $from;

	mail($to, $subject, $message, $headers);
	echo "<p>The email has been sent to</p>";
	echo "<p>$to</p>";
}


rbacEnforce();

if (isset($_POST['feedback'])) {
	feedback($_SESSION['username']);
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
<h1>Send Feedback</h1>
		<div>
        <form action="" method="post">
        <input name="feedback" type="hidden" value="sent">
			<p>
			 Do you like the way information is presented?
			   <label for="presentation">Yes
			   <input name="presentation" type="radio" value="yes"></label>
             <label for="presentation">No
               <input name="presentation" type="radio" value="no"></label>
			</p>
      <p>
        Did any problems occur in shipping in the product? 
          <label for="shipping_problem">Yes<input name="shipping_problem" type="radio" value="yes"></label>
             <label for="shipping_problem">No
               <input name="shipping_problem" type="radio" value="no"></label>
       </p>
      <p>
        Was the behaviour between employee and customer was reasonable? 
          <label for="behaviour">Yes<input name="behaviour" type="radio" value="yes"></label>
             <label for="behaviour">No
               <input name="behaviour" type="radio" value="no"></label>
       </p>
      <p>
        Did product deliver on time?
        <label for="delivery">Yes<input name="delivery" type="radio" value="yes"></label>
             <label for="delivery">No
               <input name="delivery" type="radio" value="no"></label>
      </p>
      <p>
      <input name="" type="submit">
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
