<?php
  require_once('../php/database.php');
  require_once('../php/session.php');

  function check_credentials($username, $password) {
  	$rows = query("SELECT shopper_id as id, sh_password as password FROM Shopper WHERE sh_username = ?", [$username]);
    if ($rows && $rows[0]['id']) {
  		if (password_verify($password, $rows[0]['password'])) {
        return $rows[0]['id'];
    	}
    }
  	else return FALSE;
  }

  function login($username, $password) {
  	$shopper_id = check_credentials($username, $password);

  	if ($shopper_id > 0) {
  		session_regenerate_id(TRUE);
  		$sessid = session_id();
  		query("INSERT INTO Session (id, Shopper_id) VALUES (?,?)", [$sessid, $shopper_id]);
      $_SESSION['username'] = $username;
  		return TRUE;
  	}
    else return FALSE;
  }

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
<?php require_once '../php/styles.php'; ?>
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
</html>
