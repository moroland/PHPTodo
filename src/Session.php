<?php

/**
 * @file Session.php
 */
class Session {

  static public function logIn($userid) {
    $_SESSION['user_id'] = $userid;
  }

  static public function isLoggedIn() {
    return isset($_SESSION['user_id']);
  }

  static public function logout() {
    unset($_SESSION['user_id']);
  }

  public static function currentUser(): User {
    $user_id = $_SESSION['user_id'];
    return new User($user_id);
  }
}