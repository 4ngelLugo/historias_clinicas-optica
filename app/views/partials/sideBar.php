<aside class="h-full lg:min-w-96 p-4 bg-white rounded-xl flex flex-col justify-between shadow-xl z-10">
  <div class="flex flex-col gap-4">
    <div class="p-4">
      <p class="text-4xl mb-2 text-blue-800"><strong><?= $_SESSION['user']['name'] ?></strong></p>
      <span class="text-xl text-slate-400"><?= $_SESSION['user']['role'] ?></span>
    </div>
    <hr class="border-t-2 border-blue-200">
    <div class="mt-4 relative flex flex-col gap-3">
      <?php if ($_SESSION['user']['role_id'] === 1) { ?>
        <button id="usersMenuBtn" class="p-4 block w-full text-left text-2xl bg-blue-50 cursor-pointer hover:bg-blue-500 hover:text-white hover:shadow-lg rounded-xl transition-all relative">
          Usuarios
          <div id="usersMenu" class="absolute right-0 mt-4 bg-white text-black rounded-md shadow-xl hidden z-10">
            <a href="?page=listUsers" class="block text-xl p-4 rounded-md transition-colors hover:bg-slate-100">Consultar Usuarios</a>
            <a href="?page=createUser" class="block text-xl p-4 rounded-md transition-colors border-t border-slate-200 hover:bg-slate-100">Crear Usuarios</a>
          </div>
        </button>

      <?php } ?>
      <button id="pacientsMenuBtn" class="p-4 block w-full text-left text-2xl bg-blue-50 cursor-pointer hover:bg-blue-500 hover:text-white hover:shadow-lg rounded-xl transition-all relative">
        Pacientes
        <div id="pacientsMenu" class="absolute right-0 bg-white mt-4 text-black rounded-md shadow-xl hidden z-10">
          <a href="?page=listPatients" class="block text-xl p-4 rounded-md transition-colors hover:bg-slate-100">Consultar Pacientes</a>
          <a href="?page=createPatient" class="block text-xl p-4 rounded-md transition-colors border-t border-slate-200 hover:bg-slate-100">Crear Pacientes</a>
        </div>
      </button>

      <a href="?page=listRecords" class="p-4 block w-full text-left text-2xl bg-blue-50 cursor-pointer hover:bg-blue-500 hover:text-white hover:shadow-lg rounded-xl transition-all relative">Historias clinicas</a>

    </div>
  </div>
  </article>
  <button
    onclick="window.location = '../logic/php/logOut.php'"
    class="p-2 bg-red-500 font-bold text-xl text-white rounded-md cursor-pointer hover:bg-red-800 transition-all">
    Cerrar Sesión</button>
</aside>