<?php

/**
 * @file Database.php
 */
class Database {
  const DB_FILE = 'phptodo.sqlite';

  private $pdo;
  function __construct() {
    try {
      $this->pdo = new PDO("sqlite:".self::DB_FILE);
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $exception) {
      die("Connection failed: " . $exception->getMessage());
    }
  }

  function query($query, $params = []) {
    $statement = $this->pdo->prepare($query);
    foreach ($params as $key => $value) {
      $statement->bindValue($key, $value);
    }
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

}