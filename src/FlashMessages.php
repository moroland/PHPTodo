<?php

/**
 * @file FlashMessages.php
 */
class FlashMessages {
  static function add(string $message): void {
    $_SESSION['flash_messages'][] = $message;
  }

  static function get(): array {
    return $_SESSION['flash_messages'] ?? [];
  }

  static function clear(): void {
    $_SESSION['flash_messages'] = [];
  }

  static function retrieve(): string {
    $messages = '';
    foreach (self::get() as $message) {
      $messages .= "<div class='alert alert-info'>$message</div>";
    }
    self::clear();
    return $messages;
  }

}