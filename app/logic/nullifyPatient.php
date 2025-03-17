<?php
require_once '../models/Database.php';
require_once '../controllers/PatientController.php';

header("Content-Type: application/json; charset=UTF-8");

$output = ["error" => "invalid method"];

$database = new Database;
$db = $database->getConnection();

if ($db) {
  $patientController = new PatientController($db);

  $patient_id = $_POST['patientId'];

  $patient = $patientController->nullifyPatient($patient_id);

  if ($patient) $output = $patient;
} else {
  $output = ['error' => 'database error'];
}

echo json_encode($output);

exit();
