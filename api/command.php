<?php
require_once '../php/functions.php';
require_once '../php/ChromePhp.php';

if (isset($_SERVER['REQUEST_METHOD'])) {
  $method = $_SERVER['REQUEST_METHOD'];

  if ($method == 'GET') {
    $response = getCommands();
    sendResponse($response);
  }
}


/* Sends a JSON response and exits the script */
function sendResponse($response) {
  header('Content-Type: application/json');
  echo json_encode($response);
  exit();
}


/* Returns array of Commands */
function getCommands() {
  $pdo = get_db();
  $sql = "SELECT cmd_id, cmd_name, cmd_url
          FROM Command";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();

  $commands = array();
  while ($row = $stmt->fetch()) {
    $cmd         = array();
    $cmd['id']   = $row['cmd_id'];
    $cmd['name'] = $row['cmd_name'];
    $cmd['url']  = $row['cmd_url'];
    $commands[]  = $cmd;
  }

  return $commands;
}


function addCommand($cmd_name, $cmd_url) {
  $pdo = get_db();
  $sql = "INSERT INTO Command (cmd_id, cmd_name, cmd_url) VALUES (NULL, ?, ?)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$cmd_name, $cmd_url]);
}

?>
