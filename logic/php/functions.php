<?php
function getAllUsers($conn)
{
  $get_users = $conn->prepare("SELECT * FROM usuarios INNER JOIN roles ON usuarios.rol_id = roles.rol_id");
  $get_users->execute();

  return $get_users->fetchAll(PDO::FETCH_ASSOC);
}

function getAllPatients($conn, $estate = 'activo')
{
  $get_patients = $conn->prepare("SELECT * FROM pacientes INNER JOIN generos ON pacientes.gen_id = generos.gen_id INNER JOIN estratos ON pacientes.estr_id = estratos.estr_id WHERE pac_estado = :estado ORDER BY pac_id ASC");
  $get_patients->bindParam(':estado', $estate, PDO::PARAM_STR);
  $get_patients->execute();

  return $get_patients->fetchAll(PDO::FETCH_ASSOC);
}

function getPatientById($conn, $patientId)
{
  $get_patient = $conn->prepare("SELECT * FROM pacientes WHERE pac_id = :patient_id");
  $get_patient->bindParam(':patient_id', $patientId, PDO::PARAM_INT);
  $get_patient->execute();

  return $get_patient->fetch(PDO::FETCH_ASSOC);
}

function getAllHobbies($conn)
{
  $get_hobbies = $conn->prepare("SELECT * FROM hobbies");
  $get_hobbies->execute();

  return $get_hobbies->fetchAll(PDO::FETCH_ASSOC);
}

function getPatientHobbies($conn, $patientId)
{
  $get_patient_hobbies = $conn->prepare("SELECT * FROM paciente_hobbies WHERE pac_id = :patient_id");
  $get_patient_hobbies->bindParam(':patient_id', $patientId, PDO::PARAM_INT);
  $get_patient_hobbies->execute();

  return $get_patient_hobbies->fetchAll(PDO::FETCH_ASSOC);
}

function getAllStratums($conn)
{
  $get_stratums = $conn->prepare("SELECT * FROM estratos");
  $get_stratums->execute();

  return $get_stratums->fetchAll(PDO::FETCH_ASSOC);
}

function getAllGenders($conn)
{
  $get_genders = $conn->prepare("SELECT * FROM generos");
  $get_genders->execute();

  return $get_genders->fetchAll(PDO::FETCH_ASSOC);
}
