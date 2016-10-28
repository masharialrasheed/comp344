<?php
  require_once '../php/session.php';
  require_once '../php/rbac.php';

  rbacEnforce();
?>

<html>
<head>
  <title></title>
  <?php require_once '../php/styles.php'; ?>
</head>
<body>
<?php require '../php/nav.php'; ?>

<div class="container content">

  <ul class="nav nav-tabs nav-justified">
    <li class="active"><a>All Orders</a></li>
    <li><a>Pending Orders</a></li>
    <li><a>Picked Orders</a></li>
    <li><a>Shipped Orders</a></li>
  </ul>
  <br>
  <div class="table-responsive">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Order ID</th>
          <th>Shopper ID</th>
          <th>Placed On</th>
          <th>Picked?</th>
          <th>Shipped?</th>
          <th>Shipped On</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  </div>

</div>

<?php require '../php/footer.php'; ?>
<script>
var orders = [
  ['000305', '15430', '01/07/16 11:32', '✘', '✘', ''],
  ['000304', '19844', '01/07/16 11:31', '✓', '✘', ''],
  ['000303', '10234', '01/07/16 11:31', '✘', '✘', ''],
  ['000302', '21075', '01/07/16 11:31', '✓', '✘', ''],
  ['000301', '10432', '01/07/16 11:30', '✓', '✓', '01/07/16'],
  ['000300', '10023', '01/07/16 11:30', '✓', '✓', '01/07/16']
];
$(function() {
  var $tbody = $('tbody');
  var tableHtml = '';
  $.each(orders, function(i, val) {
    tableHtml += '<tr><td>'+val[0]+'</td><td>'+val[1]+'</td><td>'+val[2]+'</td>'
              +  '<td class="text-center">'+val[3]+'</td>'
              +  '<td class="text-center">'+val[4]+'</td><td>'+val[5]+'</td><td></tr>';
  });
  $tbody.html(tableHtml);
});
</script>
</body>
</html>
