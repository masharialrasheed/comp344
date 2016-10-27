<?php
  require_once 'database.php';

  function rbacCheck($username, $url) {
    $params = [$username, $url];
    $rows = query(
      "SELECT sh_username FROM Shopper
        INNER JOIN AccessUserGroup ON shopper_id = AUG_Shopper_id
        INNER JOIN AccessGroup ON AG_id = AUG_AG_id
        INNER JOIN AccessGroupCommands ON AGC_AG_id = AG_id
        INNER JOIN Commands ON AGC_Cmd_id = Cmd_id
        WHERE sh_username = ?
        AND Cmd_URL = ?", $params);

    return $rows ? true : false;
  }

  function rbacEnforce() {
    if (!isset($_SESSION['username']) ||
        !rbacCheck($_SESSION['username'], basename($_SERVER["PHP_SELF"]))
    ) {
      header('Location: Forbidden.php');
      exit();
    }
  }
?>
