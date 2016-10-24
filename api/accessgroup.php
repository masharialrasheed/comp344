<?php
require_once '../php/functions.php';

if (isset($_SERVER['REQUEST_METHOD'])) {
  $method = $_SERVER['REQUEST_METHOD'];

  if ($method == 'GET') {
    $response = getAccessGroups();
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
function getAccessGroups() {
  $pdo = get_db();
  $sql = "SELECT ag_id, ag_name, ag_desc
          FROM AccessGroup";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();

  $accessgroups = array();
  while ($row = $stmt->fetch()) {
    $ag         = array();
    $ag['id']   = $row['ag_id'];
    $ag['name'] = $row['ag_name'];
    $ag['desc'] = $row['ag_desc'];
    $accessgroups[] = $ag;
  }

  return $accessgroups;
}
?>
