<?php

/**
 * @file Router.php
 */
class Router {

  private array $routes = [];

  static function redirect($url): void {
    header("Location: $url");
    die();
  }

  function add($method, $path, $controller, $action): void {
    $this->routes[$method][$path] = [$controller, $action];
  }

  function resolve(): void {
    $method = $_SERVER['REQUEST_METHOD'];
    $path = $_SERVER['REQUEST_URI'] ?? '/';
    $path = explode('?', $path)[0];

    $callback = $this->routes[$method][$path] ?? NULL;

    if ($callback == NULL) {
      $callback = [ErrorController::class, 'not_found'];
    }

    $controller = NULL;
    if ($callback) {
      $controller = new $callback[0]();
    }
    if ($controller) {
      $controller->{$callback[1]}();
    }

  }

}