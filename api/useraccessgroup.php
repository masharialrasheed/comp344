<?php
require_once '../php/functions.php';

if (isset($_SERVER['REQUEST_METHOD'])) {
  $method = $_SERVER['REQUEST_METHOD'];

  if ($method == 'GET') {
    $request = $_GET;
    respondToGET($request);
  } elseif ($method == 'POST') {
    $request = json_decode(file_get_contents('php://input'), true);
    respondToPOST($request);
  }
}
?>


<?php
/* Sends a JSON response and exits the script */
function sendResponse($response) {
  header('Content-Type: application/json');
  echo json_encode($response);
  exit();
}


/* Expects role_ids[] and username */
function respondToPOST($request) {
  $valid_req = isset($request['roles']) && isset($request['username']);
  if (!$valid_req) { exit(); }

  $roles = getAccessGroups();
  $formUsername = $request['username'];
  $formRoles = $request['roles'];

  foreach ($roles as $role) {
    $toBeAdded = in_array($role['id'], $formRoles);
    if ($toBeAdded) {
      addAccessUserGroup($formUsername, $role['id']);
    } else {
      removeAccessUserGroup($formUsername, $role['id']);
    }
  }

  sendResponse('success');
}


/* Returns array of roles and array of users' roles */
function respondToGET($request) {
  $response = array();
  $response['roles'] = getAccessGroups();
  $response['users'] = getUsers();

  sendResponse($response);
}
?>

<?php
/* Returns array of Users (id, username, roles)
{
  [{
    "id": 1,
    "username": "John",
    "roles": "Super Administrator, Customer Service Manager"
  }]
}
*/
function getUsers() {
  $pdo = get_db();
  $sql = "SELECT sh_id, sh_username, ag_id, ag_name FROM Shopper
          LEFT JOIN AccessUserGroup ON sh_id = aug_sh_id
          LEFT JOIN AccessGroup ON ag_id = aug_ag_id
          ORDER BY sh_id";
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
  return array_values($users);
}


/* Returns array of Roles (id, name)
{[
  {
    "id": 1,
    "name": "Super Administrator"
  }
]}
*/
function getAccessGroups() {
  $pdo = get_db();
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


function addAccessUserGroup($username, $ag_id) {
  $pdo = get_db();
  $sql = "SELECT sh_username FROM Shopper
          INNER JOIN AccessUserGroup ON sh_id = aug_sh_id
          INNER JOIN AccessGroup ON ag_id = aug_ag_id
          WHERE sh_username = ?
          AND ag_id = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$username, $ag_id]);
  $exists = $stmt->fetch();

  if (!$exists) {
    $user_id = getShopperIdFromName($username);
    $sql = "INSERT INTO AccessUserGroup VALUES (NULL, ?, ?)";
    $stmt = $pdo->prepare($sql)->execute([$user_id, $ag_id]);
  }
}


function removeAccessUserGroup($username, $ag_id) {
  $pdo = get_db();
  $sql = "SELECT sh_username FROM Shopper
          INNER JOIN AccessUserGroup ON sh_id = aug_sh_id
          INNER JOIN AccessGroup ON ag_id = aug_ag_id
          WHERE sh_username = ?
          AND ag_id = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$username, $ag_id]);
  $exists = $stmt->fetch();

  if ($exists) {
    $user_id = getShopperIdFromName($username);
    $sql = "DELETE FROM AccessUserGroup WHERE aug_sh_id = ? AND aug_ag_id = ?";
    $stmt = $pdo->prepare($sql)->execute([$user_id, $ag_id]);
  }
}


function getShopperIdFromName($username) {
  $pdo = get_db();
  $sql = "SELECT DISTINCT sh_id FROM Shopper WHERE sh_username = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$username]);
  $row = $stmt->fetch();
  return $row['sh_id'];
}
?>
