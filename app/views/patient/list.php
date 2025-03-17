<?php
include_once '../../controllers/PatientController.php';
require_once '../../models/Database.php';

try {
  $database = new Database;
  $db = $database->getConnection();

  if ($db) {
    $patientController = new PatientController($db);
    $patients = $patientController->getAllPatients();
  }
} catch (Exception $e) {
  error_log("Error de conexión a la base de datos: " . $e->getMessage());
}
?>

<section class="h-full flex-grow p-8 bg-white rounded-xl flex flex-col gap-10 shadow-xl z-10">
  <h1 class="text-4xl font-bold text-blue-800">Lista de pacientes</h1>
  <table class="rounded-xl overflow-hidden shadow-lg text-xl">
    <thead class="bg-blue-400 text-white font-bold">
      <tr class="divide-x-2">
        <th class="py-2">Id</th>
        <th class="py-2">Nombre</th>
        <th class="py-2">Teléfono</th>
        <th class="py-2">Género</th>
        <th class="py-2">Estrato</th>
        <th class="py-2">Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($patients as $index => $patient) {
        $even_row = ($index % 2 == 1) ? 'bg-slate-100' : '';
        $patientName = htmlspecialchars($patient['pac_nombre'] . " " . $patient['pac_apellido']);
      ?>
        <tr class="divide-x-2 divide-slate-200 <?= $even_row ?>">
          <td class="px-4 py-2"><?= htmlspecialchars($patient['pac_id']) ?></td>
          <td class="px-4 py-2"><?= $patientName ?></td>
          <td class="px-4 py-2"><?= htmlspecialchars($patient['pac_telefono']) ?></td>
          <td class="px-4 py-2"><?= htmlspecialchars($patient['gen_nombre']) ?></td>
          <td class="px-4 py-2"><?= htmlspecialchars($patient['estr_nombre']) ?></td>
          <td class="px-4 py-2 flex justify-evenly">
            <a
              href="?page=createRecord&patient=<?= htmlspecialchars($patient['pac_id']) ?>"
              class="font-semibold p-3 bg-emerald-400 hover:bg-emerald-600 cursor-pointer transition-all rounded-lg">
              <img src="../../../public/assets/icons/create-document.svg" alt="Crear historia clínica" width="24" height="24">
            </a>
            <a
              href="?page=editPatient&patient=<?= htmlspecialchars($patient['pac_id']) ?>"
              class="font-semibold p-3 bg-amber-300 hover:bg-amber-500 cursor-pointer rounded-lg">
              <img src="../../../public/assets/icons/edit-user.svg" alt="Editar paciente" width="24" height="24">
            </a>
            <a
              href="#"
              onclick="openModal(<?= htmlspecialchars($patient['pac_id']) ?>, '<?= addslashes($patientName) ?>')"
              class="font-semibold p-3 bg-rose-500 hover:bg-rose-700 cursor-pointer rounded-lg">
              <img src="../../../public/assets/icons/trash-bin.svg" alt="Eliminar paciente" width="24" height="24">
            </a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</section>

<section id="modalNullify" class="absolute w-full h-full bg-slate-800/50 z-50 top-0 left-0 place-content-center hidden">
  <article id="modalNullifyContent" class="p-5 bg-white rounded-xl display flex flex-col space-y-5">
    <header class="text-4xl font-bold text-blue-800">
      Anular paciente
    </header>
    <hr class="border-slate-300">
    <p id="modalNullifyText" class="text-xl flex flex-col gap-2"></p>
    <hr class="border-slate-300">
    <footer class="flex justify-end gap-3 text-xl">
      <button type="button" id="modalNullifyCancel" class="font-semibold p-3 bg-slate-100 hover:bg-slate-300 cursor-pointer rounded-lg">Cancelar</button>
      <button type="button" id="modalNullifyAccept" class="font-semibold p-3 text-white bg-rose-500 hover:bg-rose-700 cursor-pointer rounded-lg">Anular</button>
    </footer>
  </article>
</section>

<div id="alert" class="p-6 pr-20 backdrop-blur-xl text-3xl xl:text-5xl font-bold border-l-8 absolute -right-150 xl:-right-200 bottom-32 transition-all z-50"></div>

<script type="module" src="../../../public/js/nullifyPatient.js"></script>