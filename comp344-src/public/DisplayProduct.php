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

        <div class="well">
          <div class="text-right">
            <a href="PostReview.php" class="btn btn-primary">Leave a Review</a>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-12">
              <p style="font-weight:bold">Tim</p>
              <p>It was a fantastic product!</p>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-12">
              <p style="font-weight:bold">Jan</p>
              <p>I like turtles</p>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-12">
              <p style="font-weight:bold">Rakim</p>
              <p>This milk was expensive</p>
            </div>
          </div>
        </div>

      </div>

  </div>

  </div>

</div>

<?php require '../php/footer.php'; ?>
</body>
</html>
