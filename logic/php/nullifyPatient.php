<?php

require_once '../../config/database.php';

$output = array();

$patient = $_POST['patientId'] ?? null;

if ($patient) {
  if ($conn) {

    $nullify_patient = $conn->prepare("UPDATE pacientes SET pac_estado = 'inactivo' WHERE pac_id = :patient_id");
    $nullify_patient->bindParam(':patient_id', $patient, PDO::PARAM_INT);

    if ($nullify_patient->execute()) {
      $output = ['success' => 'patient nullified'];
    } else {
      $output = ['error' => 'nullifying error'];
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
