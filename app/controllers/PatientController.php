<?php
require_once __DIR__ . '/../models/Patient.php';

class PatientController
{
  private $patient_model;

  public function __construct($db)
  {
    $this->patient_model = new Patient($db);
  }

  public function createPatient($id, $name, $surname, $email, $address, $phone, $gender, $stratums, $hobbies)
  {
    if (empty($id) || empty($name) || empty($surname) || empty($email) || empty($phone) || empty($gender) || empty($stratums)) return ['error' => 'empty fields'];

    $create_patient = $this->patient_model->createPatient($id, $name, $surname, $email, $address, $phone, $gender, $stratums, $hobbies);

    if ($create_patient) return $create_patient;

    return ['error' => 'update patient error'];
  }


  public function getAllPatients()
  {
    $patients = $this->patient_model->getAllPatients();

    if ($patients) return $patients;

    return null;
  }

  public function getPatientById($id)
  {
    $patient = $this->patient_model->getPatientById($id);

    if ($patient) return $patient;

    return null;
  }

  public function getPatientHobbies($id)
  {
    $get_patient_hobbies = $this->patient_model->getPatientHobbies($id);

    if ($get_patient_hobbies) return $get_patient_hobbies;

    return null;
  }

  public function updatePatient($id, $name, $surname, $email, $address, $phone, $gender, $stratums, $hobbies)
  {
    $update_patient = $this->patient_model->updatePatient($id, $name, $surname, $email, $address, $phone, $gender, $stratums, $hobbies);

    if ($update_patient) return $update_patient;

    return ['error' => 'update patient error'];
  }

  public function nullifyPatient($id)
  {
    $nullify_patient = $this->patient_model->nullifyPatient($id);

    if ($nullify_patient) return $nullify_patient;

    return ['error' => 'nullifying error'];
  }
}
