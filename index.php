<!DOCTYPE html>
<html lang="es">
<head>
  <?php require_once "./includes/template/head.php"; ?>

  <title>Bob-omb meter</title>
</head>
<body>
<?php require_once "./includes/template/header.php"; ?>

  <div id="content">
    <aside class="aside-left" id="categories">
      <h1>Categorías</h1>

      <ul>
        <li>
          <a href="#">Categoría 1</a>
        </li>
        <li>
          <a href="#">Categoría 2</a>
        </li>
        <li>
          <a href="#">Categoría 3</a>
        </li>
        <li>
          <a href="#">Categoría 4</a>
        </li>
      </ul>
    </aside>

    <main class="index">

      <div class="user-sale transition">
        <div class="product default-image">
          <span class="fa-stack fa-2x">
            <i class="far fa-image fa-stack-2x"></i>
            <i class="fas fa-slash fa-stack-1x fa-2x"></i>
          </span>
        </div>
        <div class="sale-body">
          <div class="header">
            <h1 class="elipsis">
              Todo hasta el 70% 🙊
            </h1>
            <p class="sale-date">
              <i class="fas fa-calendar"></i>
              2020/11/27
            </p>
          </div>
          <div class="categories">
            <a href="#" class="category">Black Friday</a>
          </div>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi eaque ipsam expedita molestias deserunt nobis fugiat a natus commodi, similique dolorum optio error dolores fugit nihil obcaecati? Alias, dolorum quae!
          </p>
          <div class="footer">
            <a href="#" class="transition-fast">
              <i class="fas fa-bomb"></i>
              Ver Oferta
            </a>
          </div>
        </div>
      </div>

      <div class="user-sale transition">
        <div class="product default-image">
          <span class="fa-stack fa-2x">
            <i class="far fa-image fa-stack-2x"></i>
            <i class="fas fa-slash fa-stack-1x fa-2x"></i>
          </span>
        </div>
        <div class="sale-body">
          <div class="header">
            <h1 class="elipsis">
              Electrodomesticos cocina 20%
            </h1>
            <p class="sale-date">
              <i class="fas fa-calendar"></i>
              2020/11/27
            </p>
          </div>
          <div class="categories">
            <a href="#" class="category">Hogar</a>
            <a href="#" class="category">Electrodomésticos</a>
          </div>
          <p>El cinturón de asteroides es una región del sistema solar comprendida aproximadamente entre las órbitas de Marte y Júpiter. Alberga multitud de objetos irregulares denominados asteroides o planetas menoreS.</p>
          <div class="footer">
            <a href="#" class="transition-fast">
              <i class="fas fa-bomb"></i>
              Ver Oferta
            </a>
          </div>
        </div>
      </div>

      <div class="user-sale transition">
        <div class="product default-image">
          <span class="fa-stack fa-2x">
            <i class="far fa-image fa-stack-2x"></i>
            <i class="fas fa-slash fa-stack-1x fa-2x"></i>
          </span>
        </div>
        <div class="sale-body">
          <div class="header">
            <h1 class="elipsis">
              Cyberpunk 2077
            </h1>
            <p class="sale-date">
              <i class="fas fa-calendar"></i>
              2020/11/24
            </p>
          </div>
          <div class="categories">
            <a href="#" class="category">Electrónica</a>
            <a href="#" class="category">Juegos</a>
          </div>
          <p>
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Impedit harum minus autem sed error placeat adipisci doloribus at veniam inventore culpa rem sunt rerum, voluptates dignissimos facilis cupiditate corrupti dolores.
          </p>
          <div class="footer">
            <a href="#" class="transition-fast">
              <i class="fas fa-bomb"></i>
              Ver Oferta
            </a>
          </div>
        </div>
      </div>
    </main>

    <aside class="aside-right" id="promoted">
      <h1>Promocionado</h1>

      <p>Promocionado 1</p>
      <p>Promocionado 2</p>
      <p>Promocionado 3</p>
      <p>Promocionado 4</p>
    </aside>
  </div>

  <?php require_once "./includes/template/footer.php"; ?>
</body>
</html>