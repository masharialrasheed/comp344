<?php
require_once 'functions.php';
include_once 'ChromePhp.php';

if (isset($_SERVER['REQUEST_METHOD'])) {
  $method = $_SERVER['REQUEST_METHOD'];
  $response = array();

  if ($method == 'GET') {
    sendResponse(respondToGET());
  } elseif ($method == 'POST') {
    sendResponse(respondToPOST());
  }

}
?>


<?php
/* Send a JSON response and exit script */
function sendResponse($response) {
  header('Content-Type: application/json');
  echo json_encode($response);
  exit();
}


/* Expects role_ids[] and username */
function respondToPOST() {
  $req = isset($_POST['roles']) && isset($_POST['username']);
  if (!$req) { exit(); }

  $pdo = get_db();
  $roles = getAccessGroups($pdo);
  $formUsername = $_POST['username'];
  $formRoles = $_POST['roles'];

  foreach ($roles as $role) {
    $toBeAdded = in_array($role['id'], $formRoles);
    if ($toBeAdded) {
      addAccessGroup($pdo, $formUsername, $role['id']);
    } else {
      removeAccessGroup($pdo, $formUsername, $role['id']);
    }
  }

  return json_encode('success');
}


/* Returns array of roles and array of users' roles */
function respondToGET() {
  $pdo = get_db();
  $response = array();
  $response['roles'] = getAccessGroups($pdo);
  $response['users'] = getUsers($pdo);
  return $response;
}
?>

<?php
/* Returns associative array of Users (id, username, roles)
{
  "John": {
    "id": 1,
    "username": "John",
    "roles": "Super Administrator, Customer Service Manager"
  }
}
*/
function getUsers($pdo) {
  $sql = "SELECT sh_id, sh_username, ag_id, ag_name FROM Shopper
          LEFT JOIN AccessUserGroup ON sh_id = aug_sh_id
          LEFT JOIN AccessGroup ON ag_id = aug_ag_id";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();

  $users = array();
  while ($row = $stmt->fetch()) {
    $u = $row['sh_username'];
    if (!isset($users[$u])) {
      $user             = array();
      $user['id']       = $row['sh_id'];
      $user['username'] = $row['sh_username'];
      $user['roles']    = array();
      $user['roles'][]  = $row['ag_name'];
      $user['role_ids']   = array();
      $user['role_ids'][] = $row['ag_id'];
      $users[$u]        = $user;
    } else {
      $users[$u]['roles'][] = $row['ag_name'];
      $users[$u]['role_ids'][] = $row['ag_id'];
    }
  }
  return $users;
}


/* Returns array of Roles (id, name)
{[
  {
    "id": 1,
    "name": "Super Administrator"
  }
]}
*/
function getAccessGroups($pdo) {
  $sql = "SELECT ag_id, ag_name FROM AccessGroup ORDER BY ag_id";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();

  $roles = array();
  while ($row = $stmt->fetch()) {
    $role         = array();
    $role['id']   = $row['ag_id'];
    $role['name'] = $row['ag_name'];
    $roles[] = $role;
  }
  return $roles;
}


function addAccessGroup($pdo, $username, $ag_id) {
  $sql = "SELECT sh_username FROM Shopper
          INNER JOIN AccessUserGroup ON sh_id = aug_sh_id
          INNER JOIN AccessGroup ON ag_id = aug_ag_id
          WHERE sh_username = ?
          AND ag_id = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$username, $ag_id]);
  $exists = $stmt->fetch();

  if (!$exists) {
    $user_id = getShopperIdFromName($pdo, $username);
    $sql = "INSERT INTO AccessUserGroup VALUES (NULL, ?, ?)";
    $stmt = $pdo->prepare($sql)->execute([$user_id, $ag_id]);
  }
}


function removeAccessGroup($pdo, $username, $ag_id) {
  $sql = "SELECT sh_username FROM Shopper
          INNER JOIN AccessUserGroup ON sh_id = aug_sh_id
          INNER JOIN AccessGroup ON ag_id = aug_ag_id
          WHERE sh_username = ?
          AND ag_id = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$username, $ag_id]);
  $exists = $stmt->fetch();

  if ($exists) {
    $user_id = getShopperIdFromName($pdo, $username);
    $sql = "DELETE FROM AccessUserGroup WHERE aug_sh_id = ? AND aug_ag_id = ?";
    $stmt = $pdo->prepare($sql)->execute([$user_id, $ag_id]);
  }
}


function getShopperIdFromName($pdo, $username) {
  $sql = "SELECT sh_id FROM Shopper WHERE sh_username = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$username]);
  $row = $stmt->fetch();
  return $row['sh_id'];
}
?>
