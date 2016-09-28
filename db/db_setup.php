<?php
require_once('../php/functions.php');

function setup_db() {
    $pdo = get_db();
    $create = file_get_contents('mysql_create_tables.sql');
    $insert = file_get_contents('mysql_insert_data.sql');
    $pdo->query($create);
    $pdo->query($insert);
}
?>
