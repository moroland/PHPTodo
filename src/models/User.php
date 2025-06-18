<?php
/**
 * @file User.php
 */

class User {
  public $id;
  public $username;
  private $password;

  function __construct($id, $username = '', $password = '') {
    $this->id = $id;
    $this->username = $username;
    $this->password = $password;
  }

  function validatePassword($password): bool {
    return password_verify($password, $this->password);
  }
}