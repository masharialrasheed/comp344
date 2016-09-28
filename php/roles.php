<?php
require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pdo = get_db();
    $response = array();
    $response['success'] = true;

    if (isset($_POST['roles'])) {
        $accessgroups = array_keys(getAccessGroups($pdo));
        foreach ($accessgroups as $ag_id) {
            if (in_array($ag_id, $_POST['roles'])) {
                addAccessGroup($pdo, $_POST['username'], $ag_id);
            } else {
                removeAccessGroup($pdo, $_POST['username'], $ag_id);
            }
        }
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $pdo = get_db();
    $response = array();
    $response['success'] = true;

    /* Get the AccessGroups a User is part of */
    if (isset($_GET['username'])) {
        $response['userroles'][$u] = getUserAccessGroupsFor($pdo, $_GET['username']);
    }
    /* Get list of AccessGroups and a list of Users with their AccessGroups */
    else {
        $response['roles'] = getAccessGroups($pdo);
        $response['userroles'] = getUserAccessGroups($pdo);
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
?>

<?php
/* Returns associative array {sh_username: [ag_names]} */
function getUserAccessGroups($pdo) {
    $sql = "SELECT sh_username, ag_name FROM shopper sh
            INNER JOIN accessusergroup aug ON shopper_id = aug_shopper_id
            INNER JOIN accessgroup ag ON ag_id = aug_ag_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $result = array();
    while ($row = $stmt->fetch()) {
        $username = $row['sh_username'];
        if (!isset($result[$username])) {
            $result[$username] = array();
        }
        $result[$username][] = $row['ag_name'];
    }
    return $result;
}


/* Returns associative array {ag_id: ag_name} */
function getUserAccessGroupsFor($pdo, $username) {
    $sql = "SELECT sh_username, ag_id, ag_name FROM shopper sh
            INNER JOIN accessusergroup aug ON shopper_id = aug_shopper_id
            INNER JOIN accessgroup ag ON ag_id = aug_ag_id
            WHERE sh_username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);

    $result = array();
    while ($row = $stmt->fetch()) {
        $result[$row['ag_id']] = $row['ag_name'];
    }
    return $result;
}


/* Returns associative array {ag_id: ag_name} */
function getAccessGroups($pdo) {
    $sql = "SELECT ag_id, ag_name FROM accessgroup ORDER BY ag_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $result = array();
    while ($row = $stmt->fetch()) {
        $result[$row['ag_id']] = $row['ag_name'];
    }
    return $result;
}


function addAccessGroup($pdo, $username, $ag_id) {
    $sql = "SELECT sh_username FROM shopper sh
            INNER JOIN accessusergroup aug ON shopper_id = aug_shopper_id
            INNER JOIN accessgroup ag ON ag_id = aug_ag_id
            WHERE sh_username = ?
            AND ag_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username, $ag_id]);
    $exists = $stmt->fetch();

    if (!$exists) {
        $user_id = getShopperIdFromName($pdo, $username);
        $sql = "INSERT INTO accessusergroup VALUES (NULL, ?, ?)";
        $stmt = $pdo->prepare($sql)->execute([$user_id, $ag_id]);
    }
}


function removeAccessGroup($pdo, $username, $ag_id) {
    $sql = "SELECT sh_username FROM shopper sh
            INNER JOIN accessusergroup aug ON shopper_id = aug_shopper_id
            INNER JOIN accessgroup ag ON ag_id = aug_ag_id
            WHERE sh_username = ?
            AND ag_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username, $ag_id]);
    $exists = $stmt->fetch();

    if ($exists) {
        $user_id = getShopperIdFromName($pdo, $username);
        $sql = "DELETE FROM accessusergroup WHERE aug_shopper_id = ? AND aug_ag_id = ?";
        $stmt = $pdo->prepare($sql)->execute([$user_id, $ag_id]);
    }
}


function getShopperIdFromName($pdo, $username) {
    $sql = "SELECT shopper_id FROM shopper WHERE sh_username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);
    $row = $stmt->fetch();
    return $row['shopper_id'];
}
?>
