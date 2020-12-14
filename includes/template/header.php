<header>
  <nav>
    <ul class="nav-left">
      <li>
        <a href="/">
          <img src="/assets/img/logo.png" alt="Logo de la web">
        </a>
      </li>
    </ul>
    <ul class="nav-center">
      <li>
        <a href="/" class="<?php echo "/" == $_SERVER["REQUEST_URI"] ? "active" : ""; ?>">Ver bombazos</a>
      </li>
      <li>
        <a href="/addUserSale.php" class="<?php echo "/addUserSale.php" == $_SERVER["REQUEST_URI"] ? "active" : ""; ?>">Añadir producto</a>
      </li>
    </ul>
    <ul class="nav-right">
      <li>
        <a href="/authenticate.php">
        <?php
          if (isset($_SESSION["email"])) {
            ?>
            <i class="fas fa-sign-out-alt"></i>
            <?php
            echo 'Cerrar sesión (' . $_SESSION["email"] . ")";
          } else {
            ?>
            <i class="fas fa-user"></i>
            Autenticarse
            <?php
          }
          ?>
        </a>
      </li>
    </ul>
  </nav>
</header>