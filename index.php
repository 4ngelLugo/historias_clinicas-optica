<?php
require_once './app/models/Database.php';
require_once './app/Controllers/SecondaryTableController.php';

$roles = [];

try {
  $database = new Database();
  $db = $database->getConnection();

  if ($db) {
    $tables = new SecondaryTableController($db);
    $roles = $tables->getAllRoles();
  }
} catch (Exception $e) {
  error_log("Error de conexión a la base de datos: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="./public/styles/output.css" rel="stylesheet">
  <title>Inicio de Sesión</title>
</head>

<body>
  <main class="w-screen h-screen flex login-bg overflow-hidden relative">
    <form
      id="login_form"
      class="h-full md:w-2/5 p-15 shadow-2xl shadow-slate-400 bg-slate-100/70 backdrop-blur-xl flex flex-col justify-between">

      <section class="flex flex-col gap-6">
        <div class="w-full flex mb-5">
          <img src="./public/assets/logo.svg" alt="Logo" width="100">
        </div>

        <h1 class="mb-12 text-4xl font-bold text-blue-900">Inicio de Sesión</h1>

        <div class="flex flex-col relative mb-10">
          <input
            type="number"
            id="id"
            name="id"
            placeholder=""
            class="input"
            autocomplete="username">
          <label for="id" class="label">Documento</label>
        </div>

        <div class="flex flex-col relative">
          <input
            type="password"
            id="password"
            name="password"
            placeholder=""
            class="input"
            autocomplete="current-password">
          <label for="password" class="label">Contraseña</label>
        </div>

        <div class="flex flex-col mt-4">
          <label for="role" class="text-2xl font-semibold">Rol</label>
          <select
            name="role"
            id="role"
            class="appearance-none bg-transparent p-2 border-b-2 text-2xl cursor-pointer outline-none transition-all border-blue-800 focus:border-blue-400">
            <option value="" selected hidden disabled>Seleccione un rol</option>

            <?php foreach ($roles as $rol) { ?>
              <option value="<?= htmlspecialchars($rol['rol_id']) ?>" class="bg-transparent hover:bg-slate-400/50 cursor-pointer">
                <?= htmlspecialchars($rol['rol_nombre']) ?>
              </option>
            <?php } ?>

          </select>
        </div>
      </section>

      <button class="py-3 mt-4 bg-blue-600 text-white text-2xl font-bold rounded-2xl hover:cursor-pointer hover:bg-blue-800 transition-colors" type="submit">
        Iniciar Sesión
      </button>

    </form>

    <div id="alert" class="p-6 pr-20 backdrop-blur-xl text-3xl xl:text-5xl font-bold border-l-8 absolute -right-150 xl:-right-200 bottom-20 transition-all z-50"></div>
  </main>

  <script type="module" src="./public/js/login.js"></script>
</body>

</html>