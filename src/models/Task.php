<?php

/**
 * @file Task.php
 */
class Task {
  protected ?int $id;
  protected string $title;
  protected ?string $description;
  protected int $status;
  protected ?User $creator;
  protected ?User $assignee;

  function __construct(?int $id, string $title, ?string $description,  ?User $creator, ?User $assignee = null, int $status = 0) {
    $this->id = $id;
    $this->title = $title;
    $this->description = $description;
    $this->status = $status;
    $this->creator = $creator;
    $this->assignee = $assignee;
  }

  public function getId(): int {
    return $this->id;
  }
  public function getTitle(): string {
    return htmlspecialchars($this->title);
  }

  public function setTitle(string $title): void {
    $this->title = $title;
  }

  public function getDescription(): ?string {
    if ($this->description == null) return '';
    return htmlspecialchars($this->description);
  }

  public function setDescription(?string $description): void {
    $this->description = $description;
  }

  public function getCreator(): User {
    return $this->creator;
  }
  public function getAssignee(): ?User {
    return $this->assignee;
  }

  public function setAssignee(?User $assignee): void {
    $this->assignee = $assignee;
  }

  public function getStatus(): int {
    return $this->status;
  }

  public function setStatus(int $status): void {
    $this->status = $status;
  }

  public function canUpdate(User $user): bool {
    // Can update assigned tasks.
    if ($this->getAssignee() && $this->getAssignee()->id == $user->id) {
      return true;
    }
    // Can update own tasks
    if ($this->getCreator()->id == $user->id) {
      return true;
    }
    // Forbid otherwise.
    return false;
  }

}