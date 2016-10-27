<?php
  function getDatabaseConnection() {
    static $connection;

    if (!isset($connection)) {
      $db = require 'databaseConfig.php'; // {host, name, user, pass}
      $dsn = "mysql:host={$db['host']};dbname={$db['name']};charset=utf8";
      $opt = [
          PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
          PDO::ATTR_EMULATE_PREPARES   => false,
      ];
      $connection = new PDO($dsn, $db['user'], $db['pass'], $opt);
    }

    return $connection;
  }


  function query($sql, $params=[]) {
    $pdo = getDatabaseConnection();
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $results = $stmt->fetchAll();
    return $results;
  }

?>
