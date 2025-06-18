<?php

/**
 * @file LoginController.php
 */
class LoginController {
  function login_screen() {
    global $page_title;
    $page_title = 'Login';
    include 'src/views/login.php';
  }

  function login() {
    $user_list = new UserList();
    $user = $user_list->find_by_name($_POST['username']);
    if ($user && $user->validatePassword($_POST['password'])) {
      Session::logIn($user->id);
      FlashMessages::add('Successful Login');
      Router::redirect('/');
    } else {
      FlashMessages::add('Invalid username or password');
      Router::redirect('/login');
    }
  }

  function logout() {
    Session::logOut();
    FlashMessages::add('Successful Logout');
    Router::redirect('/');
  }

}