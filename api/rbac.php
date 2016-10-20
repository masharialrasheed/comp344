<?php

class RBAC {
  function check($ag_id, $username) {
    $pdo = get_db();
    $sql = "SELECT sh_username FROM Shopper
            INNER JOIN AccessUserGroup ON sh_id = aug_sh_id
            INNER JOIN AccessGroup ON ag_id = aug_ag_id
            WHERE sh_username = ?
            AND ag_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username, $ag_id]);
    $exists = $stmt->fetch();

    return $exists;
  }
}

?>
