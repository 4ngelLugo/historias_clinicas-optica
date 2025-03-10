<?php
$patientId = $_GET['patient'] ?? null;

$patient = getPatientById($conn, $patientId);
?>

<section class="h-full flex-grow p-8 bg-white rounded-xl flex flex-col gap-8 shadow-xl z-10 overflow-y-scroll">
  <h1 class="text-4xl font-bold text-blue-800">Crear historia clinica</h1>

  <article class="grid grid-cols-3 gap-3">

    <div class="flex flex-col text-xl">
      <p><b>Documento</b></p>
      <span><?= $patient['pac_id'] ?></span>
    </div>
    <div class="flex flex-col text-xl">
      <p><b>Nombre</b></p>
      <span><?= $patient['pac_nombre'] . " " . $patient['pac_apellido'] ?></span>
    </div>
    <div class="flex flex-col text-xl">
      <p><b>Dirección</b></p>
      <span><?= $patient['pac_direccion'] ?></span>
    </div>
    <div class="flex flex-col text-xl">
      <p><b>Telefono</b></p>
      <span><?= $patient['pac_telefono'] ?></span>
    </div>
    <div class="flex flex-col text-xl">
      <p><b>Genero</b></p>
      <span><?= $patient['gen_nombre'] ?></span>
    </div>
    <div class="flex flex-col text-xl">
      <p><b>Estrato</b></p>
      <span><?= $patient['estr_nombre'] ?></span>
    </div>

  </article>

  <hr class="border-slate-300">

  <form id="createRecord_form" class="h-full flex flex-col justify-between">
    <input type="text" class="hidden" name="paciente" value="<?= $patientId ?>">

    <div class="flex flex-col relative">
      <textarea id="motivo" name="motivo" placeholder="" class="input resize-none"></textarea>
      <label for="motivo" class="label">Motivo de visita <span class="text-sm text-slate-500">(opcional)</span></label>
    </div>

    <div class="grid grid-cols-3 gap-8">

      <?php
      $fields = [
        ['esfod', 'Esfera OD'],
        ['cilod', 'Cilindro OD'],
        ['ejeod', 'Eje OD'],
        ['esfoi', 'Esfera OI'],
        ['ciloi', 'Cilindro OI'],
        ['ejeoi', 'Eje OI'],
      ];

      foreach ($fields as [$id, $label]) { ?>
        <div class="flex flex-col relative">
          <input type="text" id="<?= $id ?>" name="<?= $id ?>" placeholder="" class="input">
          <label for="<?= $id ?>" class="label"><?= $label ?></label>
        </div>
      <?php } ?>
    </div>

    <div class="grid grid-cols-2 gap-8">
      <?php
      $fields = [
        ['diagod', 'Diagnostico ojo derecho'],
        ['diagoi', 'Diagnostico ojo izquierdo']
      ];

      foreach ($fields as [$id, $label]) { ?>
        <div class="flex flex-col relative">
          <input type="text" id="<?= $id ?>" name="<?= $id ?>" placeholder="" class="input">
          <label for="<?= $id ?>" class="label"><?= $label ?></label>
        </div>

      <?php } ?>
    </div>

    <div class="flex flex-col relative">
      <textarea id="recom" name="recom" placeholder="" class="input resize-none"></textarea>
      <label for="recom" class="label">Recomendaciones <span class="text-sm text-slate-500">(opcional)</span></label>
    </div>

    <button type="submit" class="py-3 mt-4 bg-blue-600 text-white text-2xl font-bold rounded-xl hover:cursor-pointer hover:bg-blue-800 transition-colors">Crear Historia Clinica</button>

  </form>

</section>

<div id="alert" class="p-6 pr-20 backdrop-blur-xl text-3xl xl:text-5xl font-bold border-l-8 absolute -right-150 xl:-right-200 bottom-32 transition-all z-50"></div>

<script type="module" src="../logic/js/createRecord.js"></script>