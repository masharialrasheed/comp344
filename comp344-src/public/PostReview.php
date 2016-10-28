<?php require_once '../php/session.php'; ?>

<html>
<head>
  <title></title>
  <?php require_once '../php/styles.php'; ?>
</head>
<body>
<?php require '../php/nav.php'; ?>

<div class="container content">

  <div class="row">
    <div class="col-xs-8 col-xs-offset-2">
      <form action="index.html" method="post">
        <div class="form-group">
          <textarea class="form-control" rows="3"></textarea>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary pull-right">Post review!</button>
        </div>
      </form>
    </div>
  </div>

</div>

<?php require '../php/footer.php'; ?>
</body>
</html>
