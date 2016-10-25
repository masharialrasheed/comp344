<html>
<head>
  <title></title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <link href="css/bootstrap-3.3.7.css" rel="stylesheet">
  <link href="css/custom.css" rel="stylesheet">
  <style>
  .jumbotron {
    background: #000 url("img/jumbo.jpg") center center;
    background-size: cover;
  }
  </style>
</head>
<body>
<?php require 'php/nav.php'; ?>

<div class="container content">

  <div class="jumbotron" style="text-shadow: 1.4px 1.4px 2px #F0D2B4;">
    <h1>Hello, world!</h1>
    <br>
    <p style="color:#F0D2B4;text-shadow: 1px 1px 2px #000;">Welcome to the Role Based Access Control subsystem</p>
    <br><br><br><br><br>
  </div>

  <br><br><br>
  <div class="row">
    <div class="col-md-4">
      <h2>This</h2>
      <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
      <p><a class="btn btn-default" href="#" role="button">View</a></p>
    </div>
    <div class="col-md-4">
      <h2>That</h2>
      <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
      <p><a class="btn btn-default" href="#" role="button">View</a></p>
   </div>
    <div class="col-md-4">
      <h2>The other</h2>
      <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
      <p><a class="btn btn-default" href="#" role="button">View</a></p>
    </div>
  </div>

</div>

<?php require 'php/footer.php'; ?>

<script src="js/jquery-3.1.1.js"></script>
<script src="js/bootstrap-3.3.7.js"></script>
</body>
</html>
