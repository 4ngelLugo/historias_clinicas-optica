<?php

include_once '../../controllers/PatientController.php';
include_once '../../controllers/SecondaryTableController.php';
require_once '../../models/Database.php';

try {
  $database = new Database;
  $db = $database->getConnection();

  if ($db) {
    $patient_id = $_GET['patient'] ?? null;

    $secondaryTables = new SecondaryTableController($db);

    $patientController = new PatientController($db);
    $patient = $patientController->getPatientById($patient_id);

    $patientHobbies = $patientController->getPatientHobbies($patient_id);
    $patientHobbyIds = array_column($patientHobbies, 'hob_id');

    $genders = $secondaryTables->getAllGenders();
    $hobbies = $secondaryTables->getAllHobbies();
    $stratums = $secondaryTables->getAllStratums();
  }
} catch (Exception $e) {
  error_log("Error de conexión a la base de datos: " . $e->getMessage());
}
?>

<section class="h-full flex-grow p-8 bg-white rounded-xl flex flex-col gap-10 shadow-xl z-10">
  <h1 class="text-4xl font-bold text-blue-800">Editar Paciente <?= $patient_id ?></h1>

  <form id="createPatient_form" class="h-full flex flex-col justify-between">
    <div class="grid grid-cols-3 gap-8">
      <?php
      $fields = [
        ["name", "Nombre", "text", $patient['pac_nombre']],
        ["surname", "Apellido", "text", $patient['pac_apellido']],
        ["email", "Correo electrónico", "email", $patient['pac_correo']],
        ["address", "Dirección", "text", $patient['pac_direccion']],
        ["phone", "Teléfono", "tel", $patient['pac_telefono']]
      ];
      ?>

      <div class="flex flex-col relative mb-10">
        <input type="text" name="id" placeholder="" value="<?= $patient_id ?>" hidden>
        <input type="text" id="id" placeholder="" class="input text-slate-400" value="<?= $patient_id ?>" disabled>
        <label for="id" class="label">Identificación</label>
      </div>

      <?php foreach ($fields as [$id, $label, $type, $value]) { ?>
        <div class="flex flex-col relative mb-10">
          <input type="<?= $type ?>" id="<?= $id ?>" name="<?= $id ?>" placeholder="" class="input" value="<?= $value ?>">
          <label for="<?= $id ?>" class="label"><?= $label ?></label>
        </div>
      <?php } ?>

      <!-- Hobbies -->
      <div class="flex flex-col gap-2">
        <span class="text-2xl font-semibold">Hobbies</span>
        <div class="grid grid-cols-3 gap-2 mt-2">
          <?php foreach ($hobbies as $hobbie) { ?>
            <label class="flex flex-col text-center justify-start items-center gap-2 cursor-pointer relative rounded-lg overflow-hidden">
              <input
                type="checkbox"
                name="hobbie[]"
                value="<?= htmlspecialchars($hobbie['hob_id']) ?>"
                class="hidden peer"
                <?= in_array($hobbie['hob_id'], $patientHobbyIds) ? 'checked' : '' ?>>
              <div class="p-4 w-full h-full rounded-lg bg-slate-100 border-2 border-transparent hover:border-blue-800 hover:text-blue-800 hover:peer-checked:bg-transparent peer-checked:bg-blue-800 peer-checked:text-white peer-checked:shadow-xl transition-all">
                <span class="text-[clamp(.8rem,1.2vw,1.3rem)] font-semibold xl:font-bold z-20"><?= htmlspecialchars($hobbie['hob_nombre']) ?></span>
              </div>
            </label>
          <?php } ?>
        </div>
      </div>

      <!-- Género -->
      <div class="flex flex-col">
        <label for="gender" class="text-2xl font-semibold">Género</label>
        <select
          name="gender"
          id="gender"
          class="text-[clamp(.8rem,1.5vw,1.5rem)] appearance-none bg-transparent p-2 border-b-2 cursor-pointer outline-none transition-all border-blue-800 focus:border-blue-400">

          <?php foreach ($genders as $gender) { ?>
            <option
              value="<?= htmlspecialchars($gender['gen_id']) ?>"
              class="bg-transparent hover:bg-slate-400/50 cursor-pointer"
              <?= ($patient['gen_id'] === $gender['gen_id']) ? 'selected' : '' ?>>
              <?= htmlspecialchars($gender['gen_nombre']) ?>
            </option>
          <?php } ?>

        </select>
      </div>

      <!-- Estrato -->
      <div class="flex flex-col gap-2">
        <span class="text-2xl font-semibold">Estrato</span>
        <div class="grid grid-cols-2 gap-4 mt-2 p-2">
          <?php foreach ($stratums as $estr) { ?>
            <label class="flex items-center gap-2 cursor-pointer">
              <input
                type="radio"
                name="estr"
                value="<?= htmlspecialchars($estr['estr_id']) ?>"
                class="hidden peer"
                <?= ($patient['estr_id'] === $estr['estr_id']) ? 'checked' : '' ?>>
              <div class="w-5 h-5 border-2 border-slate-300 rounded-full grid place-content-center outline-offset-2 peer-checked:outline-2 peer-checked:outline-blue-400 peer-checked:bg-blue-400 peer-checked:border-none"></div>
              <span class="text-[clamp(.8rem,1.2vw,2rem)] font-semibold"><?= htmlspecialchars($estr['estr_nombre']) ?></span>
            </label>
          <?php } ?>
        </div>
      </div>
    </div>

    <button type="submit" class="py-3 mt-4 bg-blue-600 text-white text-2xl font-bold rounded-xl hover:cursor-pointer hover:bg-blue-800 transition-colors">Editar paciente</button>
  </form>
</section>

<div id="alert" class="p-6 pr-20 backdrop-blur-xl text-3xl xl:text-5xl font-bold border-l-8 absolute -right-150 xl:-right-200 bottom-32 transition-all z-50"></div>

<script type="module" src="../../../public/js/editPatient.js"></script>