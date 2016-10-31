<?php
  require_once('../php/session.php');

  function logout() {
  	session_regenerate_id(TRUE);
  	session_destroy();
  }

  logout();

  if (isset($_GET['continue'])) {
  	header('Location: ' . $_GET['continue']);
  } else {
  	header('Location: LoginShopper.php');
  }
?>
