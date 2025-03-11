<?php
function getAllUsers($conn)
{
  $get_users = $conn->prepare("SELECT * FROM usuarios INNER JOIN roles ON usuarios.rol_id = roles.rol_id");

  if ($get_users->execute()) {
    return $get_users->fetchAll(PDO::FETCH_ASSOC);
  }

  return null;
}

function getAllPatients($conn, $estate = 'activo')
{
  $get_patients = $conn->prepare("SELECT * FROM pacientes INNER JOIN generos ON pacientes.gen_id = generos.gen_id INNER JOIN estratos ON pacientes.estr_id = estratos.estr_id WHERE pac_estado = :estado ORDER BY pac_id ASC");
  $get_patients->bindParam(':estado', $estate, PDO::PARAM_STR);

  if ($get_patients->execute()) {
    return $get_patients->fetchAll(PDO::FETCH_ASSOC);
  }

  return null;
}

function getPatientById($conn, $patientId)
{
  $get_patient = $conn->prepare("SELECT * FROM pacientes INNER JOIN generos ON pacientes.gen_id = generos.gen_id INNER JOIN estratos ON pacientes.estr_id = estratos.estr_id WHERE pac_id = :patient_id");
  $get_patient->bindParam(':patient_id', $patientId, PDO::PARAM_INT);

  if ($get_patient->execute()) {
    return $get_patient->fetch(PDO::FETCH_ASSOC);
  }

  return null;
}

function getAllHobbies($conn)
{
  $get_hobbies = $conn->prepare("SELECT * FROM hobbies");

  if ($get_hobbies->execute()) {
    return $get_hobbies->fetchAll(PDO::FETCH_ASSOC);
  }

  return null;
}

function getPatientHobbies($conn, $patientId)
{
  $get_patient_hobbies = $conn->prepare("SELECT * FROM paciente_hobbies WHERE pac_id = :patient_id");
  $get_patient_hobbies->bindParam(':patient_id', $patientId, PDO::PARAM_INT);

  if ($get_patient_hobbies->execute()) {
    return $get_patient_hobbies->fetchAll(PDO::FETCH_ASSOC);
  }

  return null;
}

function getAllStratums($conn)
{
  $get_stratums = $conn->prepare("SELECT * FROM estratos");

  if ($get_stratums->execute()) {
    return $get_stratums->fetchAll(PDO::FETCH_ASSOC);
  }

  return null;
}

function getAllGenders($conn)
{
  $get_genders = $conn->prepare("SELECT * FROM generos");

  if ($get_genders->execute()) {
    return $get_genders->fetchAll(PDO::FETCH_ASSOC);
  }

  return null;
}

function getPatientGender($conn, $patientId)
{
  $get_gender = $conn->prepare("SELECT gen_nombre FROM generos g INNER JOIN pacientes p ON p.gen_id = g.gen_id WHERE pac_id = :patientId");
  $get_gender->bindParam(':patientId', $patientId, PDO::PARAM_INT);

  if ($get_gender->execute()) {
    return $get_gender->fetch(PDO::FETCH_ASSOC);
  }

  return null;
}

function getAllRecords($conn)
{
  $get_records = $conn->prepare("SELECT * FROM historias h INNER JOIN pacientes p ON h.pac_id = p.pac_id INNER JOIN generos g ON p.gen_id = g.gen_id");

  if ($get_records->execute()) {
    return $get_records->fetchAll(PDO::FETCH_ASSOC);
  }

  return null;
}
