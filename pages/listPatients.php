<?php
$estado = 'activo';
$get_patients = $conn->prepare("SELECT * FROM pacientes INNER JOIN generos ON pacientes.gen_id = generos.gen_id INNER JOIN estratos ON pacientes.estr_id = estratos.estr_id WHERE pac_estado = :estado ORDER BY pac_id ASC");
$get_patients->bindParam(':estado', $estado, PDO::PARAM_STR);
$get_patients->execute();

$patients = $get_patients->fetchAll(PDO::FETCH_ASSOC);

$patientNumber = 1;
?>

<aside class="h-full flex-grow p-8 bg-white rounded-xl flex flex-col gap-10 shadow-xl z-10">
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
      <?php foreach ($patients as $patient) {
        $even_row = ($patientNumber % 2 == 0) ? 'bg-slate-100' : '';
        $patientName = htmlspecialchars($patient['pac_nombre'] . " " . $patient['pac_apellido']);
      ?>
        <tr class="divide-x-2 divide-slate-200 <?= $even_row ?>">
          <td class="px-4 py-2"><?= htmlspecialchars($patient['pac_id']) ?></td>
          <td class="px-4 py-2"><?= $patientName ?></td>
          <td class="px-4 py-2"><?= htmlspecialchars($patient['pac_telefono']) ?></td>
          <td class="px-4 py-2"><?= htmlspecialchars($patient['gen_nombre']) ?></td>
          <td class="px-4 py-2"><?= htmlspecialchars($patient['estr_nombre']) ?></td>
          <td class="px-4 py-2 flex justify-evenly">
            <a class="font-semibold p-3 bg-blue-400 hover:bg-blue-600 cursor-pointer transition-all rounded-lg text-white">
              <img src="../assets/icons/create-document.svg" alt="Crear historia clínica" width="24" height="24">
            </a>
            <a href="?page=editPatient&patient=<?= $patient['pac_id'] ?>" class="font-semibold p-3 bg-amber-300 hover:bg-amber-500 cursor-pointer rounded-lg">
              <img src="../assets/icons/edit-user.svg" alt="Editar paciente" width="24" height="24">
            </a>
            <a class="font-semibold p-3 bg-rose-400 hover:bg-rose-600 cursor-pointer rounded-lg text-white">
              <img src="../assets/icons/trash-bin.svg" alt="Eliminar paciente" width="24" height="24">
            </a>
          </td>
        </tr>
      <?php
        $patientNumber++;
      } ?>
    </tbody>
  </table>
</aside>