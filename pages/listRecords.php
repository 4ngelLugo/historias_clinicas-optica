<?php
$records = getAllRecords($conn);
?>

<section class="h-full flex-grow p-8 bg-white rounded-xl flex flex-col gap-10 shadow-xl z-10">
  <h1 class="text-4xl font-bold text-blue-800">Lista de Historias clinicas</h1>
  <table class="rounded-xl overflow-hidden shadow-lg text-xl">
    <thead class="bg-blue-400 text-white font-bold">
      <tr class="divide-x-2">
        <th class="py-2">N° Historia</th>
        <th class="py-2">Paciente</th>
        <th class="py-2">Motivo de visita</th>
        <th class="py-2">Recomendaciones</th>
        <th class="py-2">Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($records as $index => $record) {
        $even_row = ($index % 2 == 1) ? 'bg-slate-100' : '';
        $patientName = htmlspecialchars($record['pac_nombre'] . " " . $record['pac_apellido']);
      ?>
        <tr class="divide-x-2 divide-slate-200 <?= $even_row ?>">
          <td class="px-4 py-2"><?= htmlspecialchars($record['hist_id']) ?></td>
          <td class="px-4 py-2"><?= $patientName ?></td>
          <td class="px-4 py-2"><?= htmlspecialchars($record['hist_motv']) ?></td>
          <td class="px-4 py-2"><?= htmlspecialchars($record['hist_recom']) ?></td>
          <td class="px-4 py-2 flex justify-evenly">
            <a
              href="#"
              onclick='openModal(<?= json_encode($record, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>)'
              class="font-semibold p-3 bg-blue-400 hover:bg-blue-600 cursor-pointer rounded-lg text-white flex gap-2 justify-center items-center">
              <img src="../assets/icons/eye.svg" alt="Eliminar paciente" width="24" height="24">
              <span>Ver detalles</span>
            </a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</section>

<section id="modalRecord" class="absolute w-full h-full bg-slate-800/50 z-50 top-0 left-0 place-content-center hidden">
  <article id="modalRecordContent" class="p-5 bg-white rounded-xl display flex flex-col space-y-5">
    <header class="text-2xl font-bold text-blue-800">
      Historia Clinica
    </header>
    <hr class="border-slate-300">
    <div class="text-xl grid grid-cols-3 gap-6 gap-x-20">

      <div class="flex flex-col">
        <span class="font-bold">N° Historia:</span>
        <p id="numHistoria"></p>
      </div>
      <div class="flex flex-col">
        <span class="font-bold">Paciente:</span>
        <p id="pacHistoria"></p>
      </div>
      <div class="flex flex-col">
        <span class="font-bold">Genero:</span>
        <p id="genHistoria"></p>
      </div>

      <hr class="border-slate-300 col-span-full">

      <div class="flex flex-col col-span-full">
        <span class="font-bold">Motivo:</span>
        <p id="motv"></p>
      </div>
      <div class="flex flex-col">
        <span class="font-bold">Esfera OD:</span>
        <p id="esfod"></p>
      </div>
      <div class="flex flex-col">
        <span class="font-bold">Cilindro OD:</span>
        <p id="cilod"></p>
      </div>
      <div class="flex flex-col">
        <span class="font-bold">Eje OD:</span>
        <p id="ejeod"></p>
      </div>
      <div class="flex flex-col">
        <span class="font-bold">Esfera OI:</span>
        <p id="esfoi"></p>
      </div>
      <div class="flex flex-col">
        <span class="font-bold">Cilindro OI:</span>
        <p id="ciloi"></p>
      </div>
      <div class="flex flex-col">
        <span class="font-bold">Eje OI:</span>
        <p id="ejeoi"></p>
      </div>

      <div class="flex flex-col">
        <span class="font-bold">Diagnostico OD:</span>
        <p id="diaod"></p>
      </div>
      <div class="flex flex-col">
        <span class="font-bold">Diagnostico OI:</span>
        <p id="diaoi"></p>
      </div>

      <div class="flex flex-col col-span-full">
        <span class="font-bold">Recomendaciones:</span>
        <p id="recom"></p>
      </div>
    </div>
  </article>
</section>

<script type="module" src="../logic/js/seeRecord.js"></script>