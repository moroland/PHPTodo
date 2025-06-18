<?php
/**
 * @file UserList.php
 */

class UserList extends BaseList {

  function find_by_name($username): ?User {
    $query = 'SELECT id, username, password FROM users WHERE username = :username';
    $users = $this->db->query($query, [':username' => $username]);
    if (count($users) > 0) {
      return new User($users[0]['id'], $users[0]['username'], $users[0]['password']);
    }
    return null;
  }
}
