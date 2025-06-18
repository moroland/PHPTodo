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
    include 'src/views/tasks.php';
  }

  function delegated(): void {
    $task_list = new TaskList();
    $tasks = $task_list->getCurrentUsersDelegatedTasks();
    include 'src/views/tasks.php';
  }

  function assigned(): void {
    $task_list = new TaskList();
    $tasks = $task_list->getTasksAssignedToCurrentUser();
    include 'src/views/tasks.php';
  }
}