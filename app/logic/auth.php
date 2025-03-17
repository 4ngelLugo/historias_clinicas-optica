<?php
session_start();

require_once '../models/Database.php';
require_once '../controllers/AuthController.php';

header("Content-Type: application/json; charset=UTF-8");

$output = ["error" => "invalid method"];

$database = new Database();
$db = $database->getConnection();

if ($db) {
  $authController = new AuthController($db);

  $id = $_POST['id'] ?? null;
  $password = $_POST['password'] ?? null;
  $role = $_POST['role'] ?? null;

  $output = $authController->logIn($id, $password, $role);

  if (isset($output['success'])) {
    $user = $output['user'];

    $_SESSION['user'] = [
      "id" => $user['usu_docum'],
      "name" => $user['usu_nombre'] . " " . $user['usu_apellido'],
      "role_id" => $user['rol_id'],
      "role" => $user['rol_nombre']
    ];

    array_pop($output);
    $output['userName'] = $_SESSION['user']['name'];
  }
} else {
  $output = ['error' => 'database error'];
}

echo json_encode($output);

exit();
