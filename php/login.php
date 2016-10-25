<?php
  require_once("database.php");

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
?>
