<?php
define("HOST", "localhost");
define("DATABASE", "historia_clinica");
define("USER", "root");
define("PASSWORD", "");

try {
  $conn = new PDO("mysql:host=" . HOST . ";dbname=" . DATABASE, USER, PASSWORD);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
  echo json_encode(['error' => 'Error al conectar con la base de datos' . $exception->getMessage()]);
}
