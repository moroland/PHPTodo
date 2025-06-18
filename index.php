<?php

// Helpers
require_once 'src/Database.php';
require_once 'src/FlashMessages.php';
require_once 'src/Router.php';
require_once 'src/Session.php';

// Controllers
require_once 'src/controllers/TaskListController.php';
require_once 'src/controllers/ErrorController.php';
require_once 'src/controllers/LoginController.php';

// Models
require_once 'src/models/BaseList.php';
require_once 'src/models/UserList.php';
require_once 'src/models/User.php';
require_once 'src/models/TaskList.php';
require_once 'src/models/Task.php';

session_start();

$body = '';
$page_title = 'Todo List';
$messages = '';

$router = new Router();

$router->add('GET', '/', TaskListController::class, 'home');
$router->add('GET', '/delegated', TaskListController::class, 'delegated');
$router->add('GET', '/assigned', TaskListController::class, 'assigned');
$router->add('GET', '/login', LoginController::class, 'login_screen');
$router->add('GET', '/logout', LoginController::class, 'logout');
$router->add('POST', '/login', LoginController::class, 'login');

// Output buffering to catch output from controllers/views so we don't have
// to eval() but can use PHP files as "Templating" engine.
ob_start();
$router->resolve();
$body = ob_get_contents();
ob_clean();

$messages = FlashMessages::retrieve();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php print($page_title); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT"
          crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
            crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary mb-5">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">PHPToDo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <?php if (Session::isLoggedIn()): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/">My Tasks</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/delegated">Delegated to someone else</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/assigned">Assigned to me</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">Logout</a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <?php print($messages); ?>
</div>
<div class="container">
  <?php print($body); ?>
</div>

</body>
</html>
