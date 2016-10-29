<?php require_once '../php/session.php'; ?>
<html>
<head>
  <title></title>
  <?php require_once '../php/styles.php'; ?>
  <style>
  #index.jumbotron {
    background: #FFF url("../img/jumbo.jpg") center center;*/
    background-size: cover;
    color: #4E342E;
    text-shadow: 1px 1px 2px #FFF;
  }
  </style>
</head>
<body>
<?php require '../php/nav.php'; ?>

<div class="container content">

  <div id="index" class="jumbotron">
    <h1>COMP344</h1>
    <br>
    <p>Role Based Access Control</p>
    <br><br><br><br>
  </div>

  <br><br><br>
  <div class="row">
    <div class="col-md-4">
      <h2>Secure</h2>
      <p>Through a Role Based Access Control scheme users may only access pages they are permitted to, else they are redirected to the login page.</p>
    </div>
    <div class="col-md-4">
      <h2>Dynamic</h2>
      <p>The navigation bar allows access to the shop for guests and users, and dynamically adds navigation groups based on a user's access groups.</p>
   </div>
    <div class="col-md-4">
      <h2>Powerful</h2>
      <p>The superadmin has full control over the access control system. Through the control panel she may create commands, create access groups, assign users to access groups, assign commands to access groups and etc. This functionality is currently restricted on this site.</p>
    </div>
  </div>

</div>

<?php require '../php/footer.php'; ?>
</body>
</html>
