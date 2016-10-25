<!-- Static navbar -->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">RBAC</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li <?php if (basename($_SERVER["PHP_SELF"]) == "LoginShopper.php") {echo 'class="active"';} ?>>
          <a href="LoginShopper.php">Login</a></li>
        <li><a href="LogoutShopper.php">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
