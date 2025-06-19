<?php

/**
 * @file LoginRequired.php
 */
trait LoginRequired {
  function __construct() {
    if (!isset($_SESSION['user_id'])) {
      $controller = new ErrorController();
      $controller->unathenticated();
    }
  }
}
