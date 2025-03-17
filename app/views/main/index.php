<?php
require_once '../../logic/verifySession.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../../../public/styles/output.css" rel="stylesheet">
  <title>Optica</title>
</head>

<body>
  <main class="h-screen p-4 bg-slate-200 flex gap-4 relative overflow-hidden">
    <?php
    $pages = [
      "listRecords" => "../record/list.php",
      "listUsers" => "../user/list.php",
      "listPatients" => "../patient/list.php",
      "createRecord" => "../record/create.php",
      "createPatient" => "../patient/create.php",
      "editPatient" => "../patient/edit.php"
    ];

    include_once '../partials/sideBar.php';

    if (isset($_GET['page'])) {
      $page = $_GET['page'];
      $file = $pages[$page] ?? '../errors/404.php';

      if (!file_exists($file)) $file = '../errors/404.php';

      include_once $file;
    }
    ?>
  </main>

  <script src="../../../public/js/dropDownMenu.js"></script>
</body>

</html>