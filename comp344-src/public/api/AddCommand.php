<?php
  require_once '../database.php';

  function addCommand($cmd_name, $cmd_url) {
    $params = [$cmd_name, $cmd_url];
    query("INSERT INTO Commands (Cmd_name, Cmd_URL) VALUES (?, ?)", $params);
  }
?>
