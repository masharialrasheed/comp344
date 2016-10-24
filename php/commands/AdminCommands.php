<?php
  require_once '../database.php';

  /* Returns array of Commands */
  function getCommands() {
    return query("SELECT Cmd_id AS id, Cmd_name AS name, Cmd_URL AS url FROM Commands");
  }

  $commands = getCommands();
?>

<html>
<head>
  <title>SuperAdmin</title>
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
        <li id="pill-uag"><a href="AdminUsers.php">Users</a></li>
        <li id="pill-ag"><a href="AdminAccessGroups.php">AccessGroups</a></li>
        <li id="pill-cmd" class="active"><a href="AdminCommands.php">Commands</a></li>
      </ul>
    </div>
    <div class="col-sm-9">
      <table id="sa-table" class="table table-condensed table-hover">
        <thead><tr><th>ID</th><th>Command</th><th>URL</th></tr></thead>
          <tbody>
          <?php foreach ($commands as $c) {
            echo "<tr><td>{$c['id']}</td><td>{$c['name']}</td><td>{$c['url']}</td></tr>";
          } ?>
          </tbody>
      </table>
      <button class="btn btn-success pull-right" type="button">New Command</button>
    </div>
  </div>
</div>

<div class="modal fade" id="edit-modal" tabindex="-1">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Commands</h4>
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
</body>
</html>
