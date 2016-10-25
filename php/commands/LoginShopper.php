<?php
  require_once('../session.php');
  require_once('../login.php');

  // Where to go next
  if (isset($_GET['continue'])) {
  	$continue = $_GET['continue'];
  }
  else {
  	if (isset($_POST['continue'])) {
  		$continue = $_POST['continue'];
  	}
  	else {
  		$continue = "AdminUsers.php";
  	}
  }

  if (isset($_POST['stage']) && ($_POST['stage'] == 'process')) {
  	process_form();
  } else {
  	print_form($continue, "Please enter your account details:");
  }

  function process_form() {
  	global $continue;
  	if (login($_POST['username'], $_POST['password'])) {
      $_SESSION['username'] = $_POST['username'];
  		header("Location: $continue");
  	}
  	else {
  		print_form($continue, "Invalid credentials");
  	}
  }

  function print_form($continue, $error) {
  	global $store_name, $slogan;
  	$title = $store_name . " - " . "Shopper Login";

?>

<html>
<head>
<title>Shopper Login</title>
<link href="../../css/bootstrap-3.3.7.css" rel="stylesheet">
<link href="../../css/custom.css" rel="stylesheet">
</head>
<body>
<?php require_once '../nav.php'; ?>



<?php
  if (isset($_SESSION['username'])) {
?>
<div class="container content">
  <div class="row">
    <div class="col-sm-6 col-sm-offset-3">
      <h1>You're already logged in!</h1>
    </div>
  </div>
</div>
<?php require_once '../footer.php'; ?>
</html>
<?php
    exit();
  }
?>

<div class="container content">
  <div class="row">
    <div class="col-sm-6 col-sm-offset-3">
      <h1>Shopper Login</h1><br><br>
      <form id="login" method="post" onsubmit="return validateFormOnSubmit(this)" action="LoginShopper.php">
        <input type="hidden" name = "continue" value = "<?= $continue ?>" />
        <input type="hidden" name = "stage" value = "process" />

        <div class="row form-group">
          <div class="col-sm-3">
            <label for="username">Your username:</label>
          </div>
          <div class="col-sm-6">
            <input name="username" class="form-control" maxlength="50" type="text">
          </div>
        </div>
        <div class="row form-group">
          <div class="col-sm-3">
            <label for="password">Your password:</label>
          </div>
          <div class="col-sm-6">
            <input name="password" class="form-control" maxlength="25" type="password">
          </div>
        </div>
        <div class="row form-group">
          <div class="col-sm-6 col-sm-offset-3">
            <button class="btn btn-success btn-block" name="Submit" type="submit">Log In</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
  <?php require_once '../footer.php'; ?>
</html>
<?php }	?>
