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

    if ($user) {

      try {
        $conn->beginTransaction();

        $update_patient = $conn->prepare("UPDATE pacientes SET pac_nombre = :name, pac_apellido = :surname, pac_correo = :email, pac_direccion = :address, pac_telefono = :phone, gen_id = :gender, estr_id = :estr WHERE pac_id = :patient_id");
        $update_patient->bindParam(':patient_id', $id, PDO::PARAM_INT);
        $update_patient->bindParam(':name', $name, PDO::PARAM_STR);
        $update_patient->bindParam(':surname', $surname, PDO::PARAM_STR);
        $update_patient->bindParam(':email', $email, PDO::PARAM_STR);
        $update_patient->bindParam(':address', $address, PDO::PARAM_STR);
        $update_patient->bindParam(':phone', $phone, PDO::PARAM_INT);
        $update_patient->bindParam(':gender', $gender, PDO::PARAM_INT);
        $update_patient->bindParam(':estr', $estr, PDO::PARAM_INT);

        if (!$update_patient->execute()) {
          throw new PDOException("Error al actualizar paciente.");
        }

        if (!empty($hobbies)) {
          $delete_hobbies = $conn->prepare("DELETE FROM paciente_hobbies WHERE pac_id = :pac_id");
          $delete_hobbies->bindParam(':pac_id', $id, PDO::PARAM_INT);
          $delete_hobbies->execute();

          foreach ($hobbies as $hobbie) {
            $create_hobbie = $conn->prepare("INSERT INTO paciente_hobbies (pac_id, hob_id) VALUES (:pac_id, :hob_id)");
            $create_hobbie->bindParam(':pac_id', $id, PDO::PARAM_INT);
            $create_hobbie->bindParam(':hob_id', $hobbie, PDO::PARAM_INT);

            if (!$create_hobbie->execute()) {
              throw new PDOException("Error al insertar hobby.");
            }
          }
        }

        $conn->commit();
        $output = ['success' => 'patient updated'];
      } catch (PDOException $e) {
        $conn->rollBack();
        $output = ['error' => 'update error'];
      }
    } else {
      $output = ['error' => 'user doesnt exist'];
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
