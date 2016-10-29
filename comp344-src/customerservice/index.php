<?php require_once '../php/session.php'; ?>

<html>
<head>
  <title></title>
  <?php require_once '../php/styles.php'; ?>
</head>
<body>
<?php require '../php/nav.php'; ?>

<div class="container content">

  <?php
  	if (isset($_SESSION['username']) {
		echo $_SESSION['username'];
	}
  ?>

</div>

<?php require '../php/footer.php'; ?>
</body>
</html>
