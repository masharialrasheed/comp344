<?php
  require_once('../php/session.php');
  require_once('../php/login.php');


	if (isset($_POST['username']) && isset($_POST['password'])) {
    if (login($_POST['username'], $_POST['password'])) {
      $_SESSION['username'] = $_POST['username'];
  		header("Location: AdminUsers.php");
      exit();
    }
	}

?>

<html>
<head>
<title>Shopper Login</title>
<link href="../css/bootstrap-3.3.7.css" rel="stylesheet">
<link href="../css/custom.css" rel="stylesheet">
</head>
<body>
<?php require_once '../php/nav.php'; ?>

<?php if (isset($_SESSION['username'])) { ?>

  <div class="container content">
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3">
        <h1>You're already logged in!</h1>
      </div>
    </div>
  </div>

<?php } else { ?>

  <div class="container content">
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3">
        <h1>Shopper Login</h1><br><br>
        <form method="POST" onsubmit="return validateFormOnSubmit(this)" action="LoginShopper.php">
          <div class="row form-group">
            <div class="col-xs-4">
              <label for="username">Your username:</label>
            </div>
            <div class="col-xs-8">
              <input name="username" class="form-control" maxlength="50" type="text">
            </div>
          </div>
          <div class="row form-group">
            <div class="col-xs-4">
              <label for="password">Your password:</label>
            </div>
            <div class="col-xs-8">
              <input name="password" class="form-control" maxlength="25" type="password">
            </div>
          </div>
          <div class="row form-group">
            <div class="col-xs-8 col-xs-offset-4">
              <button class="btn btn-success btn-block" name="Submit" type="submit">Log In</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

<?php } ?>

<?php require_once '../php/footer.php'; ?>
<script src="../js/jquery-3.1.1.js"></script>
<script src="../js/bootstrap-3.3.7.js"></script>
</html>
