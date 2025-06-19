<?php

/**
 * @file TaskList.php
 */
class TaskList extends BaseList {

  function getCurrentUsersTasks($pageSize = 100, $pageNumber = 1): array {
    //@todo: optimise this + retrieve usernames so we don't have to query them
    $query = 'SELECT id, title, description, status, creator_user_id, assigned_user_id FROM tasks WHERE creator_user_id = :user_id OR assigned_user_id = :user_id ORDER BY id DESC LIMIT :limit OFFSET :offset';
    $results = $this->db->query($query, [
      'user_id' => Session::currentUser()->id,
      'limit' => $pageSize,
      'offset' => $pageNumber - 1
    ]);
    return $this->processQueryResults($results);
  }

  function getCurrentUsersDelegatedTasks($pageSize = 100, $pageNumber = 1): array {
    $query = 'SELECT id, title, description, status, creator_user_id, assigned_user_id FROM tasks WHERE creator_user_id = :user_id AND assigned_user_id <> :user_id ORDER BY id DESC LIMIT :limit OFFSET :offset';
    $results = $this->db->query($query, [
      'user_id' => Session::currentUser()->id,
      'limit' => $pageSize,
      'offset' => $pageNumber - 1
    ]);
    return $this->processQueryResults($results);
  }

  function getTasksAssignedToCurrentUser($pageSize = 100, $pageNumber = 1): array {
    $query = 'SELECT id, title, description, status, creator_user_id, assigned_user_id FROM tasks WHERE creator_user_id <> :user_id AND assigned_user_id = :user_id ORDER BY id DESC LIMIT :limit OFFSET :offset';
    $results = $this->db->query($query, [
      'user_id' => Session::currentUser()->id,
      'limit' => $pageSize,
      'offset' => $pageNumber - 1
    ]);
    return $this->processQueryResults($results);
  }

  protected function processQueryResults($results): array {
    $return = [];
    $user_list = new UserList();
    foreach ($results as $task) {
      //@todo: instanciate User from date instead of getById().
      $return[] = new Task($task['id'], $task['title'], $task['description'], $user_list->getById($task['creator_user_id']), $user_list->getById($task['assigned_user_id']), $task['status']);
    }
    return $return;
  }

  public function create(Task $task): void {
    $query = 'INSERT INTO tasks (title, description, creator_user_id, assigned_user_id) VALUES (:title, :description, :creator_user_id, :assigned_user_id)';
    $this->db->query($query, [
      'title' => $task->getTitle(),
      'description' => $task->getDescription(),
      'creator_user_id' => $task->getCreator()->id,
      'assigned_user_id' => $task->getAssignee()->id,
    ]);
  }

  public function update(Task $task): void {
    $query = 'UPDATE tasks SET title = :title, description = :description, status = :status, assigned_user_id = :assigned_user_id WHERE id = :id';
    $this->db->query($query, [
      'id' => $task->getId(),
      'title' => $task->getTitle(),
      'description' => $task->getDescription(),
      'assigned_user_id' => $task->getAssignee()->id,
      'status' => $task->getStatus(),
    ]);
  }

  public function delete(Task $task): void {
    //@todo: check ownership
    $query = 'DELETE FROM tasks WHERE id = :id';
    $this->db->query($query, [
      'id' => $task->getId(),
    ]);
  }

  public function getById(int $id): ?Task {
    $user_list = new UserList();
    $query = 'SELECT * FROM tasks WHERE id = :id';
    $result = $this->db->query($query, [
      'id' => $id,
    ]);
    if ($result) {
      $result = $result[0];
      return new Task($result['id'], $result['title'], $result['description'], $user_list->getById($result['creator_user_id']), $user_list->getById($result['assigned_user_id']));
    }
    return null;
  }

}