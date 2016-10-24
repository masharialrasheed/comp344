<?php
require_once('../php/functions.php');

function setup_db() {
    $pdo = get_db();
    $create = file_get_contents('./create.sql');
    $insert = file_get_contents('./insert.sql');
    $pdo->query($create);
    $pdo->query($insert);
}
?>
