<?php
require_once '../logic/php/verifySession.php';
require_once '../config/database.php';
require_once '../logic/php/functions.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../styles/output.css" rel="stylesheet">
  <title>Document</title>
</head>

<body>
  <main class="h-screen p-4 bg-slate-200 flex gap-4 relative overflow-hidden">
    <?php
    $pages = [
      "listRecords" => "listRecords.php",
      "listUsers" => "listUsers.php",
      "listPatients" => "listPatients.php",
      "createRecords" => "createRecords.php",
      "createPatients" => "createPatients.php",
      "editPatients" => "editPatients.php"
    ];

    $page = $_GET['page'];
    $file = $pages[$page] ?? '404.php';

    include_once './sideBar.php';
    include_once './' . $file;
    ?>
  </main>

  <script src="../logic/js/dropDownMenu.js"></script>
</body>

</html>