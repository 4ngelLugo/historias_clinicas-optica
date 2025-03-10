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
    <?php include_once './sideBar.php';

    if (isset($_GET['page'])) {
      switch ($_GET['page']) {
        case 'listUsers':
          include_once './listUsers.php';
          break;

        case 'listPatients':
          include_once './listPatients.php';
          break;

        case 'createPatient':
          include_once './createPatient.php';
          break;

        case 'editPatient':
          include_once './editPatient.php';
          break;

        case 'createRecord':
          include_once './createRecord.php';
          break;

        default:
          include_once './404.php';
          break;
      }
    } ?>
  </main>

  <script src="../logic/js/dropDownMenu.js"></script>
</body>

</html>