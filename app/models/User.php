<?php
class User
{
  private $conn;
  private $users_table = "usuarios";
  private $roles_table = "roles";

  public function __construct($db)
  {
    $this->conn = $db;
  }

  public function validateUser($id, $password, $role)
  {
    if (empty($id) || empty($password) || empty($role)) return ["error" => "empty fields"];

    $user = $this->getUserById($id);

    if ($user && $user['usu_clave'] === $password) return ["success" => "login successful", "user" => $user];

    return ["error" => "invalid credentials"];
  }

  public function getAllUsers()
  {
    $sql = "SELECT * 
            FROM {$this->users_table} u INNER JOIN {$this->roles_table} r
            ON u.rol_id = r.rol_id";
    $get_users = $this->conn->prepare($sql);

    if ($get_users->execute()) return $get_users->fetchAll(PDO::FETCH_ASSOC);

    return null;
  }

  public function getUserById($id)
  {
    $sql = "SELECT *  
            FROM {$this->users_table} u INNER JOIN {$this->roles_table} r
            ON u.rol_id = r.rol_id
            WHERE u.usu_docum = :id
            LIMIT 1";
    $get_user = $this->conn->prepare($sql);
    $get_user->bindValue(":id", $id, PDO::PARAM_INT);

    if ($get_user->execute()) return $get_user->fetch(PDO::FETCH_ASSOC);

    return null;
  }

  public function saveUser($docum, $name, $surname, $password, $role)
  {
    $user = $this->getUserById($docum);

    if ($user) return ["error" => "user already exists"];

    $sql = "INSERT INTO {$this->users_table}
            (usu_docum, usu_nombre, usu_apellido, usu_clave, rol_id) 
            VALUES (:docum, :name, :surname, :password, :role)";
    $save_user = $this->conn->prepare($sql);
    $save_user->bindValue("docum", $docum, PDO::PARAM_INT);
    $save_user->bindValue("name", $name, PDO::PARAM_STR);
    $save_user->bindValue("surname", $surname, PDO::PARAM_STR);
    $save_user->bindValue("password", $password, PDO::PARAM_STR);
    $save_user->bindValue("role", $role, PDO::PARAM_INT);

    if ($save_user->execute()) return ["success" => "user created"];

    return ["error" => "error creating user"];
  }
}
