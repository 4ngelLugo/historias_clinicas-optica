<?php

class SecondaryTables
{
  private $conn;
  private $tables = [
    "roles" => "roles",
    "genders" => "generos",
    "stratums" => "estratos",
    "hobbies" => "hobbies"
  ];

  public function __construct($db)
  {
    $this->conn = $db;
  }

  private function getAllFromTable($tableKey)
  {
    if (!isset($this->tables[$tableKey])) {
      return ["error" => "Invalid table name"];
    }

    try {
      $sql = "SELECT * FROM {$this->tables[$tableKey]}";
      $query = $this->conn->prepare($sql);

      if ($query->execute()) {
        return $query->fetchAll(PDO::FETCH_ASSOC);
      }
    } catch (PDOException $e) {
      return ["error" => "Database error: " . $e->getMessage()];
    }

    return [];
  }

  public function getAllRoles()
  {
    return $this->getAllFromTable("roles");
  }

  public function getAllGenders()
  {
    return $this->getAllFromTable("genders");
  }

  public function getAllStratums()
  {
    return $this->getAllFromTable("stratums");
  }

  public function getAllHobbies()
  {
    return $this->getAllFromTable("hobbies");
  }
}
