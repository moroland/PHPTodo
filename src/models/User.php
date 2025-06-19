<?php
/**
 * @file User.php
 */

class User {
  public $id;
  protected $username;
  protected $password;

  function __construct($id, $username = '', $password = '') {
    $this->id = $id;
    $this->username = $username;
    $this->password = $password;
  }

  function validatePassword($password): bool {
    return password_verify($password, $this->password);
  }

  function getUsername(): string {
    return $this->username;
  }
}