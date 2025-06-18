<?php

/**
 * @file TaskList.php
 */
class TaskList extends BaseList {

  function getCurrentUsersTasks($pageSize = 100, $pageNumber = 1) {
    $query = 'SELECT * FROM tasks WHERE creator_user_id = :user_id OR assigned_user_id = :user_id ORDER BY id DESC LIMIT :limit OFFSET :offset';
    return $this->db->query($query,  ['user_id' => Session::currentUser()->id, 'limit' => $pageSize, 'offset' => $pageNumber-1]);
  }

  function getCurrentUsersDelegatedTasks($pageSize = 100, $pageNumber = 1) {
    $query = 'SELECT * FROM tasks WHERE creator_user_id = :user_id AND assigned_user_id <> :user_id ORDER BY id DESC LIMIT :limit OFFSET :offset';
    return $this->db->query($query,  ['user_id' => Session::currentUser()->id, 'limit' => $pageSize, 'offset' => $pageNumber-1]);
  }

  function getTasksAssignedToCurrentUser($pageSize = 100, $pageNumber = 1) {
    $query = 'SELECT * FROM tasks WHERE creator_user_id <> :user_id AND assigned_user_id = :user_id ORDER BY id DESC LIMIT :limit OFFSET :offset';
    return $this->db->query($query,  ['user_id' => Session::currentUser()->id, 'limit' => $pageSize, 'offset' => $pageNumber-1]);
  }

}