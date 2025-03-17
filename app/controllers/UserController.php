<?php
require_once __DIR__ . '/../models/User.php';

class UserController
{
  private $user_model;

  public function __construct($db)
  {
    $this->user_model = new User($db);
  }

  public function getAllUsers()
  {
    $users = $this->user_model->getAllUsers();

    if ($users) return $users;

    return null;
  }
}
