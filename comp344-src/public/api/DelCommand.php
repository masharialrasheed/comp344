<?php
  require_once '../database.php';

  function delCommand($cmd_id) {
    $params = [$cmd_id];
    query("DELETE FROM Commands WHERE Cmd_id = ?", $params);
  }
?>
