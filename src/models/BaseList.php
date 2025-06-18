<?php

/**
 * @file BaseList.php
 */
abstract class BaseList {
  protected $db;
  function __construct() {
    $this->db = new Database();
  }

}