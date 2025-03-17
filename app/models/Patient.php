<?php

class Patient
{
  private $conn;
  private $patients_table = "pacientes";
  private $genders_table = "generos";
  private $stratums_table = "estratos";

  public function __construct($db)
  {
    $this->conn = $db;
  }

  public function createPatient($id, $name, $surname, $email, $address, $phone, $gender, $stratums, $hobbies)
  {
    if (empty($id) || empty($name) || empty($surname) || empty($email) || empty($phone) || empty($gender) || empty($stratums)) return ['error' => 'empty fields'];

    $patient = $this->getPatientById($id);

    if ($patient) return ['error' => 'patient already exist'];

    try {
      $this->conn->beginTransaction();

      $create_sql = "INSERT INTO pacientes (pac_id, pac_nombre, pac_apellido, pac_correo, pac_direccion, pac_telefono, gen_id, estr_id)
                    VALUES (:id, :name, :surname, :email, :address, :phone, :gender, :estr)";

      $create_patient = $this->conn->prepare($create_sql);
      $create_patient->bindValue(':id', $id, PDO::PARAM_INT);
      $create_patient->bindValue(':name', $name, PDO::PARAM_STR);
      $create_patient->bindValue(':surname', $surname, PDO::PARAM_STR);
      $create_patient->bindValue(':email', $email, PDO::PARAM_STR);
      $create_patient->bindValue(':address', $address, PDO::PARAM_STR);
      $create_patient->bindValue(':phone', $phone, PDO::PARAM_INT);
      $create_patient->bindValue(':gender', $gender, PDO::PARAM_INT);
      $create_patient->bindValue(':estr', $stratums, PDO::PARAM_INT);

      if (!$create_patient->execute()) {
        $this->conn->rollBack();
        throw new PDOException("create patient error");
      }

      foreach ($hobbies as $hobbie) {
        $hobbie_sql = "INSERT INTO paciente_hobbies (pac_id, hob_id)
                      VALUES (:pac_id, :hob_id)";
        $create_hobbie = $this->conn->prepare($hobbie_sql);
        $create_hobbie->bindValue(':pac_id', $id, PDO::PARAM_INT);
        $create_hobbie->bindValue(':hob_id', $hobbie, PDO::PARAM_INT);

        if (!$create_hobbie->execute()) {
          throw new PDOException("create hobbies error");
        }
      }

      $this->conn->commit();
      return ['success' => 'patient created'];
    } catch (PDOException $e) {
      return ['error' => $e->getMessage()];
    }
  }

  public function getAllPatients($estate = "activo")
  {
    $sql = "SELECT *
            FROM {$this->patients_table} p
            INNER JOIN {$this->genders_table} g ON p.gen_id = g.gen_id
            INNER JOIN {$this->stratums_table} s ON p.estr_id = s.estr_id
            WHERE pac_estado = :estate";
    $get_patients = $this->conn->prepare($sql);
    $get_patients->bindValue(":estate", $estate, PDO::PARAM_STR);

    if ($get_patients->execute()) return $get_patients->fetchAll(PDO::FETCH_ASSOC);

    return null;
  }

  public function getPatientById($id)
  {
    $sql = "SELECT *
            FROM {$this->patients_table} p
            INNER JOIN {$this->genders_table} g ON p.gen_id = g.gen_id
            INNER JOIN {$this->stratums_table} s ON p.estr_id = s.estr_id
            WHERE pac_id = :id";
    $get_patient = $this->conn->prepare($sql);
    $get_patient->bindValue(":id", $id, PDO::PARAM_INT);

    if ($get_patient->execute()) return $get_patient->fetch(PDO::FETCH_ASSOC);

    return null;
  }

  public function getPatientHobbies($id)
  {
    $patient = $this->getPatientById($id);

    if (!$patient) return null;

    $sql = "SELECT * FROM paciente_hobbies
            WHERE pac_id = :id";
    $get_patient_hobbies = $this->conn->prepare($sql);
    $get_patient_hobbies->bindValue(':id', $id, PDO::PARAM_INT);

    if ($get_patient_hobbies->execute()) return $get_patient_hobbies->fetchAll(PDO::FETCH_ASSOC);

    return null;
  }

  public function updatePatient($id, $name, $surname, $email, $address, $phone, $gender, $stratums, $hobbies)
  {
    $patient = $this->getPatientById($id);

    if (!$patient) return ['error' => 'patient doesnt exist'];

    try {
      $this->conn->beginTransaction();

      $update_sql = "UPDATE {$this->patients_table}
            SET pac_nombre = :name, pac_apellido = :surname, pac_correo = :email, pac_direccion = :address, pac_telefono = :phone, gen_id = :gender, estr_id = :stratums
            WHERE pac_id = :id";
      $update_patient = $this->conn->prepare($update_sql);
      $update_patient->bindValue(':name', $name, PDO::PARAM_STR);
      $update_patient->bindValue(':surname', $surname, PDO::PARAM_STR);
      $update_patient->bindValue(':email', $email, PDO::PARAM_STR);
      $update_patient->bindValue(':address', $address, PDO::PARAM_STR);
      $update_patient->bindValue(':phone', $phone, PDO::PARAM_INT);
      $update_patient->bindValue(':gender', $gender, PDO::PARAM_INT);
      $update_patient->bindValue(':stratums', $stratums, PDO::PARAM_INT);
      $update_patient->bindValue(':id', $id, PDO::PARAM_INT);

      if (!$update_patient->execute()) {
        $this->conn->rollBack();
        throw new PDOException("update patient error");
      }

      if (!empty($hobbies)) {
        $delete_sql = "DELETE FROM paciente_hobbies
                      WHERE pac_id = :pac_id";
        $delete_hobbies = $this->conn->prepare($delete_sql);
        $delete_hobbies->bindValue(':pac_id', $id, PDO::PARAM_INT);

        if (!$delete_hobbies->execute()) {
          $this->conn->rollBack();
          throw new PDOException("update hobbies error");
        }

        foreach ($hobbies as $hobbie) {
          $insert_sql = "INSERT INTO paciente_hobbies (pac_id, hob_id)
                        VALUES (:pac_id, :hob_id)";
          $create_hobbie = $this->conn->prepare($insert_sql);
          $create_hobbie->bindValue(':pac_id', $id, PDO::PARAM_INT);
          $create_hobbie->bindValue(':hob_id', $hobbie, PDO::PARAM_INT);

          if (!$create_hobbie->execute()) {
            $this->conn->rollBack();
            throw new PDOException("update hobbies error");
          }
        }
      }

      $this->conn->commit();
      return ['success' => 'patient updated'];
    } catch (PDOException $e) {
      return ['error' => $e->getMessage()];
    }
  }

  public function nullifyPatient($id)
  {
    $patient = $this->getPatientById($id);

    if (!$patient) return ['error' => 'patient doesnt exist'];

    $state = "inactivo";
    $sql = "UPDATE pacientes
            SET pac_estado = :state
            WHERE pac_id = :id";
    $nullify_patient = $this->conn->prepare($sql);
    $nullify_patient->bindValue(':state', $state, PDO::PARAM_STR);
    $nullify_patient->bindValue(':id', $id, PDO::PARAM_INT);

    if ($nullify_patient->execute()) return ['success' => 'patient nullified'];

    return ['error' => 'nullifying error'];
  }
}
