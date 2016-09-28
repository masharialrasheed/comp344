<?php
require_once('../php/functions.php');

function setup_db() {
    $pdo = get_db();
    $sql = file_get_contents('mysql_db_setup.sql');
    $pdo->query($sql);
}
?>
