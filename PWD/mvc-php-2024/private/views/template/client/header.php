<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="msapplication-config" content="none" />
  <meta name="description" content="Descripcion...">

  <title>MVC-PHP-2024</title>

  <?php if (!isset($_SESSION)) {
    session_name(APP_NAME);
    // session_name('Aries');
    session_set_cookie_params(0);
    session_cache_expire(0);
    // session_start();
    session_start();
  } ?>
  <link href=<?= Helpers::media() . "css/reset.css" ?> rel="stylesheet">
</head>

<body>
  <!-- MAIN -->
  <header class="header">
    <div class="logo">
      <div class="img-logo"></div>
      <h4>Aries v1.0 Gestión de Stock</h4>
    </div>
    <div class="nav">
      <ul>
        <li><a class="nav-medicamentos" href=<?= Helpers::base_url() . "home/medicamento" ?>>Medicamentos</a></li>
        <li><a class="nav-stock" href=<?= Helpers::base_url() . "home/stock" ?>>Stock</a></li>
        <li><a class="nav-pacientes" href=<?= Helpers::base_url() . "home/paciente" ?>>Pacientes</a></li>
      </ul>
    </div>
  </header>