<?php

/**
 * @file ErrorController.php
 */


class ErrorController {
  function not_found() {
    http_response_code(404);
    include 'src/views/404.php';
  }

   function forbidden() {
     http_response_code(403);
    FlashMessages::add('Forbidden');
  }

   function unathenticated() {
     http_response_code(401);
    FlashMessages::add('Please login to access this page.');
    Router::redirect('login');
  }

}