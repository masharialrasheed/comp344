<?php
  require_once '../php/database.php';
  require_once '../php/session.php';
  require_once '../php/rbac.php';


  rbacEnforce();

  function getAccessGroups() {
    $rows = query("SELECT AG_id AS id, AG_name AS name, AG_desc AS description FROM AccessGroup");
    return $rows;
  }

  $roles = getAccessGroups();
?>

<html>
<head>
  <title>SuperAdmin - AccessGroups</title>
  <?php require_once '../php/styles.php'; ?>
</head>
<body>
<?php require_once '../php/nav.php'; ?>

<div class="container content">
  <div class="row">
    <ul class="nav nav-tabs nav-justified">
      <li id="pill-uag"><a href="AdminUsers.php">Users</a></li>
      <li id="pill-ag" class="active"><a href="AdminAccessGroups.php">AccessGroups</a></li>
      <li id="pill-cmd"><a href="AdminCommands.php">Commands</a></li>
    </ul>
  </div>
  <br>
  <div class="row table-responsive">
    <table id="sa-table" class="table table-condensed table-hover">
      <thead><tr><th>ID</th><th>AccessGroup</th><th>Description</th></tr></thead>
        <tbody>
        <?php foreach ($roles as $r) {
          echo "<tr><td>{$r['id']}</td><td>{$r['name']}</td><td>{$r['description']}</td></tr>";
        } ?>
        </tbody>
    </table>
    <button class="btn btn-default btn-block" type="button">New AccessGroup</button>
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

<?php require_once '../php/footer.php'; ?>
</body>
</html>
