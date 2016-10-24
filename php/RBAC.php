<?php
  require_once '../database.php'

  function check($username, $command) {
    $params = [$username, $command];
    $rows = query(
      "SELECT sh_username FROM Shopper
        INNER JOIN AccessUserGroup ON shopper_id = AUG_Shopper_id
        INNER JOIN AccessGroup ON AG_id = AUG_AG_id
        INNER JOIN AccessGroupCommands ON AGC_AG_id = AG_id
        INNER JOIN Commands ON AGC_Cmd_id = Cmd_id
        WHERE sh_username = ?
        AND cmd_name = ?", $params);

    return $rows ? true : false;
  }
?>
