<?php 
require_once '../php/session.php'; 
require_once '../php/rbac.php';

//rbacEnforce();
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
<br>
  
        <?php
	} else {
		echo "Please login first.";
	}
  ?>

</div>

<?php require '../php/footer.php'; ?>
</body>
</html>
