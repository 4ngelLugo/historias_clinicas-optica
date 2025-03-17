<?php

class Record
{
  private $conn;
  private $records_table = "historias";
  private $patients_table = "pacientes";
  private $genders_table = "generos";

  public function __construct($db)
  {
    $this->conn = $db;
  }

  public function createRecord($motivo, $esfod, $cilod, $ejeod, $esfoi, $ciloi, $ejeoi, $diagod, $diagoi, $recom, $patientId)
  {
    if (!$esfod || empty($cilod) || empty($ejeod) || empty($esfoi) || empty($ciloi) || empty($ejeoi) || empty($diagod) || empty($diagoi) || empty($patientId)) return ['error' => 'empty fields'];

    $sql = "INSERT INTO historias (hist_motv, hist_esfod, hist_cilod, hist_ejeod, hist_esfoi, hist_ciloi, hist_ejeoi, hist_diaod, hist_diaoi, hist_recom, pac_id)
            VALUES (:motivo, :esfod, :cilod, :ejeod, :esfoi, :ciloi, :ejeoi, :diagod, :diagoi, :recom, :patientId)";
    $create_record = $this->conn->prepare($sql);
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

    if ($create_record->execute()) return ['success' => 'record created'];

    return ['error' => 'creation error'];
  }

  public function getAllRecords()
  {
    $sql = "SELECT * FROM {$this->records_table} r
    INNER JOIN {$this->patients_table} p ON r.pac_id = p.pac_id
    INNER JOIN {$this->genders_table} g ON p.gen_id = g.gen_id";
    $get_records = $this->conn->prepare($sql);

    if ($get_records->execute()) return $get_records->fetchAll(PDO::FETCH_ASSOC);

    return null;
  }
}
