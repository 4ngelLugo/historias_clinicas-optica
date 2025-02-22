<?php

require_once '../../config/database.php';

$output = array();

$id = $_POST['id'] ?? null;
$name = $_POST['name'] ?? null;
$surname = $_POST['surname'] ?? null;
$email = $_POST['email'] ?? null;
$address = $_POST['address'] ?? null;
$phone = $_POST['phone'] ?? null;
$hobbies = $_POST['hobbie'] ?? null;
$gender = $_POST['gender'] ?? null;
$estr = $_POST['estr'] ?? null;

if ($id && $name && $surname && $email && $address && $phone && $hobbies && $gender && $estr) {
  if ($conn) {

    $get_patient = $conn->prepare("SELECT * FROM pacientes WHERE pac_id = :id");
    $get_patient->bindParam(':id', $id, PDO::PARAM_INT);
    $get_patient->execute();

    $user = $get_patient->fetch(PDO::FETCH_ASSOC);

    if (!$user) {

      try {
        $conn->beginTransaction();

        $create_patient = $conn->prepare("INSERT INTO pacientes (pac_id, pac_nombre, pac_apellido, pac_correo, pac_direccion, pac_telefono, gen_id, estr_id) VALUES (:id, :name, :surname, :email, :address, :phone, :gender, :estr)");
        $create_patient->bindParam(':id', $id, PDO::PARAM_INT);
        $create_patient->bindParam(':name', $name, PDO::PARAM_STR);
        $create_patient->bindParam(':surname', $surname, PDO::PARAM_STR);
        $create_patient->bindParam(':email', $email, PDO::PARAM_STR);
        $create_patient->bindParam(':address', $address, PDO::PARAM_STR);
        $create_patient->bindParam(':phone', $phone, PDO::PARAM_INT);
        $create_patient->bindParam(':gender', $gender, PDO::PARAM_INT);
        $create_patient->bindParam(':estr', $estr, PDO::PARAM_INT);

        if (!$create_patient->execute()) {
          throw new PDOException();
        }

        $created_hobbies = 0;
        foreach ($hobbies as $hobbie) {
          $create_hobbie = $conn->prepare("INSERT INTO paciente_hobbies (pac_id, hob_id) VALUES (:pac_id, :hob_id)");
          $create_hobbie->bindParam(':pac_id', $id, PDO::PARAM_INT);
          $create_hobbie->bindParam(':hob_id', $hobbie, PDO::PARAM_INT);

          if (!$create_hobbie->execute()) {
            throw new PDOException();
          }

          $created_hobbies++;
        }

        if ($created_hobbies == count($hobbies)) {
          $conn->commit();
          $output = ['success' => 'patient created'];
        }
      } catch (PDOException $e) {
        $conn->rollBack();
        $output = ['error' => 'creation error'];
      }
    } else {
      $output = ['error' => 'user already exists'];
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
