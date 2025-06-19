<?php
/**
 * @file UserList.php
 */

class UserList extends BaseList {

  function getByName($username): ?User {
    $query = 'SELECT id, username, password FROM users WHERE username = :username';
    $users = $this->db->query($query, [':username' => $username]);
    if (count($users) > 0) {
      return new User($users[0]['id'], $users[0]['username'], $users[0]['password']);
    }
    return null;
  }

  function getById($id): ?User {
    $query = 'SELECT id, username, password FROM users WHERE id = :id';
    $users = $this->db->query($query, [':id' => $id]);
    if (count($users) > 0) {
      return new User($users[0]['id'], $users[0]['username'], $users[0]['password']);
    }
    return null;
  }

  function getAll(): array {
    $query = 'SELECT id, username FROM users ORDER BY id DESC';
    $result = $this->db->query($query);
    $users = [];
    foreach ($result as $user) {
      $users[] = new User($user['id'], $user['username']);
    }
    return $users;
  }

}
