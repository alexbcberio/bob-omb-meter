<!DOCTYPE html>
<html lang="es">
<head>
  <?php require_once __DIR__ . "/includes/template/head.php"; ?>

  <title>Plantilla</title>
</head>
<body>
<?php require_once __DIR__ . "/includes/template/header.php"; ?>

  <div id="content">
    <aside class="aside-left"></aside>

    <main class="<?php echo substr(explode(".", $_SERVER["REQUEST_URI"])[0], 1) ?>">

      <h1 style="text-align:center;">
        Página en construcción
      </h1>
      <img src="/assets/img/loading.gif" alt="Logo" style="display:block;margin:auto;transform:rotateY(180deg);">

    </main>

    <aside class="aside-right"></aside>
  </div>

  <?php require_once __DIR__ . "/includes/template/footer.php"; ?>
</body>
</html>