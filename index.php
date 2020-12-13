<!DOCTYPE html>
<html lang="es">
<head>
  <?php require_once __DIR__ . "/includes/template/head.php"; ?>

  <title>Bob-omb meter</title>
</head>
<body>
<?php require_once __DIR__ . "/includes/template/header.php"; ?>

  <div id="content">
    <aside class="aside-left" id="categories">
      <h1>Categorías</h1>

      <ul>
        <li>
          <a href="?tags=electronica" class="<?php echo $_GET["tags"] == "electronica" ? "active" : "" ?>">
            <i class="fas fa-fw fa-bolt"></i>
            Electrónica
          </a>
        </li>
        <li>
          <a href="?tags=gaming" class="<?php echo $_GET["tags"] == "gaming" ? "active" : "" ?>">
            <i class="fas fa-fw fa-gamepad"></i>
            Gaming
          </a>
        </li>
        <li>
          <a href="?tags=moda y complementos" class="<?php echo $_GET["tags"] == "moda y complementos" ? "active" : "" ?>">
            <i class="fas fa-fw fa-tshirt"></i>
            Moda y complementos
          </a>
        </li>
        <li>
          <a href="?tags=coches y motos" class="<?php echo $_GET["tags"] == "coches y motos" ? "active" : "" ?>">
            <i class="fas fa-fw fa-motorcycle"></i>
            Coches y motos
          </a>
        </li>
        <li>
          <a href="?tags=viajes" class="<?php echo $_GET["tags"] == "viajes" ? "active" : "" ?>">
            <i class="fas fa-fw fa-plane-departure"></i>
            Viajes
          </a>
        </li>
        <li>
          <a href="?tags=otros" class="<?php echo $_GET["tags"] == "otros" ? "active" : "" ?>">
          <i class="fas fa-fw fa-list-alt"></i>
            Otros
          </a>
        </li>

      </ul>
    </aside>

    <main class="index">

      <?php
      require_once __DIR__ . "/includes/helper/salesFunc.php";
      showSales();
      ?>

    </main>

    <aside class="aside-right" id="promoted">
      <h1>Promocionado</h1>

      <p>Promocionado 1</p>
      <p>Promocionado 2</p>
      <p>Promocionado 3</p>
      <p>Promocionado 4</p>
    </aside>
  </div>

  <?php require_once __DIR__ . "/includes/template/footer.php"; ?>
</body>
</html>