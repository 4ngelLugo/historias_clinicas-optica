<?php

require_once '../../config/database.php';

$output = array();

$id = $_POST['id'] ?? null;
$password = $_POST['password'] ?? null;
$role = $_POST['role'] ?? null;

if ($id && $password && $role) {
  if ($conn) {

    $get_user = $conn->prepare("SELECT * FROM usuarios WHERE usu_docum = :id AND rol_id = :role");
    $get_user->bindParam(':id', $id, PDO::PARAM_INT);
    $get_user->bindParam(':role', $role, PDO::PARAM_INT);
    $get_user->execute();

    $user = $get_user->fetch(PDO::FETCH_ASSOC);

    if ($user && $user['usu_clave'] == $password) {

      $get_role = $conn->prepare("SELECT rol_nombre FROM roles JOIN usuarios ON roles.rol_id = usuarios.rol_id WHERE usu_nombre = :usu_nombre");
      $get_role->bindParam(':usu_nombre', $user['usu_nombre'], PDO::PARAM_STR);
      $get_role->execute();

      $role = $get_role->fetch(PDO::FETCH_ASSOC);

      session_start();
      $_SESSION['user'] = $user;
      $_SESSION['user_name'] = $user['usu_nombre'] . " " . $user['usu_apellido'];
      $_SESSION['role'] = $role['rol_nombre'];

      $output = ['success' => 'login succesful', 'userName' => $_SESSION['user_name']];
    } else {
      $output = ['error' => 'invalid credentials'];
    }
  } else {
    $output = ['error' => 'database error'];
  }
} else {
  $output = ['error' => 'empty fields'];
}

header("Content-type: application/json; charset=utf-8");

echo json_encode($output);

exit();
