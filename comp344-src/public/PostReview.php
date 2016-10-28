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
    <div class="col-sm-9 col-sm-offset-3">
      <div class="thumbnail">
        <img class="img-responsive" src="http://placehold.it/800x300" alt="">
        <div class="caption">
            <h4 class="pull-right">$29.99</h4>
            <h3>Product</h3>
            <p>This is a fantastic product!</p>
        </div>
      </div>

      <form method="post">
        <div class="form-group">
          <textarea class="form-control" rows="3"></textarea>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary pull-right">Post review</button>
        </div>
      </form>
    </div>
  </div>

</div>

<?php require '../php/footer.php'; ?>
</body>
</html>
