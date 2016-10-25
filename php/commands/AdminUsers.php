<?php
  require_once '../database.php';
  require_once '../session.php';
  require_once '../rbac.php';


  if (!isset($_SESSION['username']) ||
      !rbacCheck($_SESSION['username'], basename(__FILE__))
  ) {
    header('Location: LoginShopper.php');
    exit();
  }

  function getUsers() {
    $pdo = getDatabaseConnection();
    $sql = "SELECT shopper_id AS id, sh_username AS username, AG_id, AG_name FROM Shopper
            LEFT JOIN AccessUserGroup ON shopper_id = AUG_Shopper_id
            LEFT JOIN AccessGroup ON AG_id = AUG_AG_id
            ORDER BY shopper_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $users = array();
    while ($row = $stmt->fetch()) {
      $u = $row['id'];
      if (!isset($users[$u])) {
        $user = array();
        $user['id']        = $row['id'];
        $user['username']  = $row['username'];
        $user['role_ids']  = '';
        $user['role_ids'] .= $row['AG_id'];
        $user['roles']     = '';
        $user['roles']    .= $row['AG_name'];
        $users[$u] = $user;
      } else {
        $users[$u]['role_ids'] .= ', '.$row['AG_id'];
        $users[$u]['roles'] .= ', '.$row['AG_name'];
      }
    }
    return $users;
  }

  $users = getUsers();
?>

<html>
<head>
  <title>SuperAdmin - Users</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <link href="../../css/bootstrap-3.3.7.css" rel="stylesheet">
  <link href="../../css/custom.css" rel="stylesheet">
</head>
<body>
<?php require_once '../nav.php'; ?>

<div class="container content">
  <div class="row">
    <div class="col-sm-3">
      <ul class="nav nav-pills nav-stacked">
        <li id="pill-uag" class="active"><a href="AdminUsers.php">Users</a></li>
        <li id="pill-ag"><a href="AdminAccessGroups.php">AccessGroups</a></li>
        <li id="pill-cmd"><a href="AdminCommands.php">Commands</a></li>
      </ul>
    </div>
    <div class="col-sm-9">
      <table id="sa-table" class="table table-condensed table-hover">
        <thead><tr><th>ID</th><th>Username</th><th>Roles</th></tr></thead>
          <tbody>
          <?php foreach ($users as $u) {
            echo "<tr><td>{$u['id']}</td><td class='username'>{$u['username']}</td><td>{$u['roles']}</td></tr>";
          } ?>
          </tbody>
      </table>
    </div>
  </div>
</div>

<div class="modal fade" id="edit-modal" tabindex="-1">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit AccessGroups</h4>
      </div>
      <div class="modal-body">
        <form></form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="modal-submit">Save</button>
      </div>
    </div>
  </div>
</div>

<?php require_once '../footer.php'; ?>

<script src="../../js/jquery-3.1.1.js"></script>
<script src="../../js/bootstrap-3.3.7.js"></script>
<script>
</script>
</body>
</html>
