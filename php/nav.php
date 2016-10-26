<?php
  function navLink($name, $url) {
    $active = '';
    if (basename($_SERVER["PHP_SELF"]) == $url) {
      $active = 'active';
    }
    echo "<li class=\"{$active}\"><a href={$url}>{$name}</a></li>";
  }
?>

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
      <a class="navbar-brand" href="index.php">RBAC</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php
        navLink('Login', 'LoginShopper.php');
        navLink('Logout', 'LogoutShopper.php');
        ?>
      </ul>
    </div>
  </div>
</nav>
