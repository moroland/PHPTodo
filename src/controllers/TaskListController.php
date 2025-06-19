<?php

require_once 'src/controllers/LoginRequired.php';

/**
 * @file HomeController.php
 */
class TaskListController {
  use LoginRequired;

  function home(): void {
    $task_list = new TaskList();
    $tasks = $task_list->getCurrentUsersTasks();
    $users = new UserList()->getAll();
    $current_page = '/';
    include 'src/views/tasks.php';
  }

  function delegated(): void {
    $task_list = new TaskList();
    $tasks = $task_list->getCurrentUsersDelegatedTasks();
    $users = new UserList()->getAll();
    $current_page = '/delegated';
    include 'src/views/tasks.php';
  }

  function assigned(): void {
    $task_list = new TaskList();
    $tasks = $task_list->getTasksAssignedToCurrentUser();
    $users = new UserList()->getAll();
    $current_page = '/assigned';
    include 'src/views/tasks.php';
  }

  function create(): void {
    $user_list = new UserList();
    $assignee = $user_list->getByName($_POST['assignee']);
    $task_list = new TaskList();
    $task = new Task(null, $_POST['title'], $_POST['description'], Session::currentUser(), $assignee);
    $task_list->create($task);
    Router::redirect($_POST['current_page']);
  }

  function update(): void {
    $tasks = new TaskList();
    $user_list = new UserList();
    $task = $tasks->getById($_POST['id']);

    // Tasks can be updated only if creator or assignee is current user.
    if ($task->canUpdate(Session::currentUser())) {
      if ($_POST['delete']) {
        $tasks->delete($task);
      } else {
        $task->setTitle($_POST['title']);
        $task->setDescription($_POST['description']);
        $task->setStatus($_POST['status'] ?? 0);
        $task->setAssignee($user_list->getByName($_POST['assignee']));
        $tasks->update($task);
      }

      Router::redirect($_POST['current_page']);
    }

    $controller = new ErrorController();
    $controller->forbidden();
    exit;
  }
}