<?php
require_once __DIR__ . '/../models/Record.php';

class RecordController
{
  private $record_model;

  public function __construct($db)
  {
    $this->record_model = new Record($db);
  }

  public function createRecord($motivo, $esfod, $cilod, $ejeod, $esfoi, $ciloi, $ejeoi, $diagod, $diagoi, $recom, $patientId)
  {
    $record = $this->record_model->createRecord($motivo, $esfod, $cilod, $ejeod, $esfoi, $ciloi, $ejeoi, $diagod, $diagoi, $recom, $patientId);

    if ($record) return $record;

    return null;
  }

  public function getAllRecords()
  {
    $records = $this->record_model->getAllRecords();

    if ($records) return $records;

    return null;
  }
}
