<?php

class Database
{
  private $host = "localhost";
  private $user = "root";
  private $password = "";
  private $database = "historia_clinica";
  protected ?PDO $conn = null;

  public function getConnection(): ?PDO
  {
    if ($this->conn === null) {
      try {
        $this->conn = new PDO(
          "mysql:host={$this->host};dbname={$this->database};charset=utf8",
          $this->user,
          $this->password,
          [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
      } catch (PDOException $e) {
        error_log("Database connection error: " . $e->getMessage()); // Loguea el error
        return null; // Devuelve null en lugar de detener el script
      }
    }
    return $this->conn;
  }
}
