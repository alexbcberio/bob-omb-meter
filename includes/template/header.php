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
        <a href="/" class="<?php echo "/" == $_SERVER["REQUEST_URI"] ? "active" : ""; ?>">Inicio</a>
      </li>
      <li>
        <a href="/addUserSale.php" class="<?php echo "/addUserSale.php" == $_SERVER["REQUEST_URI"] ? "active" : ""; ?>">Añadir producto</a>
      </li>
    </ul>
    <ul class="nav-right">
      <li>
        <a href="#">
          <i class="fas fa-user"></i>
          Iniciar Sesión
        </a>
      </li>
    </ul>
  </nav>
</header>