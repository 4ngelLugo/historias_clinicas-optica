<?php
require_once '../models/Database.php';
require_once '../controllers/RecordController.php';

header("Content-Type: application/json; charset=UTF-8");

$output = ["error" => "invalid method"];

$database = new Database;
$db = $database->getConnection();

if ($db) {
  $recordController = new RecordController($db);

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

  $record = $recordController->createRecord($motivo, $esfod, $cilod, $ejeod, $esfoi, $ciloi, $ejeoi, $diagod, $diagoi, $recom, $patientId);

  if ($record) $output = $record;
} else {
  $output = ['error' => 'database error'];
}

echo json_encode($output);

exit();
