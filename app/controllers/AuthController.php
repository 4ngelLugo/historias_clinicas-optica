<?php
require_once '../models/User.php';
class AuthController
{
  private $user_model;

  public function __construct($db)
  {
    $this->user_model = new User($db);
  }

  public function logIn($id, $password, $role)
  {
    $user = $this->user_model->validateUser($id, $password, $role);

    if ($user) return $user;

    return ['error' => 'login error'];
  }
}
