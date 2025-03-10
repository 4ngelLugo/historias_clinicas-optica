<?php

require_once '../../config/database.php';
require_once './functions.php';

$output = array();

$motivo = $_POST['motivo'] ?? '...';
$esfod = $_POST['esfod'] ?? null;
$cilod = $_POST['cilod'] ?? null;
$ejeod = $_POST['ejeod'] ?? null;
$esfoi = $_POST['esfoi'] ?? null;
$ciloi = $_POST['ciloi'] ?? null;
$ejeoi = $_POST['ejeoi'] ?? null;
$diagod = $_POST['diagod'] ?? null;
$diagoi = $_POST['diagoi'] ?? null;
$recom = $_POST['recom'] ?? '...';
$patientId = $_POST['paciente'] ?? null;

if ($esfod && $cilod && $ejeod && $esfoi && $ciloi && $ejeoi && $diagod && $diagoi && $patientId) {
  if ($conn) {
    $patient = getPatientById($conn, $patientId);

    if ($patient) {

      $create_record = $conn->prepare("INSERT INTO historias (hist_motv, hist_esfod, hist_cilod, hist_ejeod, hist_esfoi, hist_ciloi, hist_ejeoi, hist_diaod, hist_diaoi, hist_recom, pac_id) VALUES (:motivo, :esfod, :cilod, :ejeod, :esfoi, :ciloi, :ejeoi, :diagod, :diagoi, :recom, :patientId)");
      $create_record->bindParam(':motivo', $motivo, PDO::PARAM_STR);
      $create_record->bindParam(':esfod', $esfod, PDO::PARAM_STR);
      $create_record->bindParam(':cilod', $cilod, PDO::PARAM_STR);
      $create_record->bindParam(':ejeod', $ejeod, PDO::PARAM_STR);
      $create_record->bindParam(':esfoi', $esfoi, PDO::PARAM_STR);
      $create_record->bindParam(':ciloi', $ciloi, PDO::PARAM_STR);
      $create_record->bindParam(':ejeoi', $ejeoi, PDO::PARAM_STR);
      $create_record->bindParam(':diagod', $diagod, PDO::PARAM_STR);
      $create_record->bindParam(':diagoi', $diagoi, PDO::PARAM_STR);
      $create_record->bindParam(':recom', $recom, PDO::PARAM_STR);
      $create_record->bindParam(':patientId', $patientId, PDO::PARAM_INT);

      if ($create_record->execute()) {
        $output = ['success' => 'record created'];
      } else {
        $output = ['error' => 'creation error'];
      }
    } else {
      $output = ['error' => 'patient doesnt exists'];
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
