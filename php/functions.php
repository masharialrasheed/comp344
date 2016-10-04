<?php
// Define DB_USER, DB_PASS, DB_NAME, DB_HOST
require_once('config.php');

function get_db() {
    $charset = 'utf8';
    $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    return new PDO($dsn, DB_USER, DB_PASS, $opt);
}

// function query($sql, $params) {
//     $stmt = $pdo->prepare($sql);
//     $stmt->execute([$username]);
//     $rows = $stmt->fetchAll();
//     return $rows;
// }


// function outputf($str) {
//     $f = fopen("error.txt", "w") or die("Unable to open file!");
//     fwrite($f, $str);
//     fclose($f);
// }

?>
