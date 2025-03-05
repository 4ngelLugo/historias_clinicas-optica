<?php
$get_users = $conn->prepare("SELECT * FROM usuarios INNER JOIN roles ON usuarios.rol_id = roles.rol_id");
$get_users->execute();

$users = $get_users->fetchAll(PDO::FETCH_ASSOC);

$userNumber = 1;
?>

<section class="h-full flex-grow p-8 bg-white rounded-xl flex flex-col gap-10 shadow-xl z-10">
  <h1 class="text-4xl font-bold text-blue-800">Lista de usuarios</h1>
  <table class="rounded-xl overflow-hidden shadow-lg">
    <thead class="bg-blue-400 text-white text-xl font-bold">
      <tr class="divide-x-2">
        <th class="py-2">Id</th>
        <th class="py-2">Documento</th>
        <th class="py-2">Nombre</th>
        <th class="py-2">Apellido</th>
        <th class="py-2">Rol</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $user) {
        $even_row = ($userNumber % 2 == 0) ? 'bg-slate-100' : '';
      ?>
        <tr class="divide-x-2 divide-slate-200 <?= $even_row ?>">
          <td class="px-4 py-2"><?= htmlspecialchars($user['usu_id']) ?></td>
          <td class="px-4 py-2"><?= htmlspecialchars($user['usu_docum']) ?></td>
          <td class="px-4 py-2"><?= htmlspecialchars($user['usu_nombre']) ?></td>
          <td class="px-4 py-2"><?= htmlspecialchars($user['usu_apellido']) ?></td>
          <td class="px-4 py-2"><?= htmlspecialchars($user['rol_nombre']) ?></td>
        </tr>
      <?php
        $userNumber++;
      } ?>
    </tbody>
  </table>
</section>