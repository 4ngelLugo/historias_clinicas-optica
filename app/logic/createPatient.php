<?php
require_once '../models/Database.php';
require_once '../controllers/PatientController.php';

header("Content-Type: application/json; charset=UTF-8");

$output = ["error" => "invalid method"];

$database = new Database;
$db = $database->getConnection();

if ($db) {
  $patientController = new PatientController($db);

  $id = $_POST['id'] ?? null;
  $name = $_POST['name'] ?? null;
  $surname = $_POST['surname'] ?? null;
  $email = $_POST['email'] ?? null;
  $address = $_POST['address'] ?? null;
  $phone = $_POST['phone'] ?? null;
  $hobbies = $_POST['hobbie'] ?? null;
  $gender = $_POST['gender'] ?? null;
  $stratums = $_POST['estr'] ?? null;

  $patient = $patientController->createPatient($id, $name, $surname, $email, $address, $phone, $gender, $stratums, $hobbies);

  if ($patient) $output = $patient;
} else {
  $output = ['error' => 'database error'];
}

echo json_encode($output);

exit();
