<?php
session_start();

if (!file_exists(__DIR__ . "/captcha.key")) {
  die("Missing captcha.key file");
}

$captchaCredentials = explode(",", file_get_contents(__DIR__ . "/captcha.key"));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (!$_SESSION["authenticated"]) {
    header("Status: 403");
    die("Debes iniciar sesión.");
  }
  $valid = true;

  // setting
  if (isset($_POST['name'])) {
    $name = $_POST['name'];

    // nombre muy corto
    if (strlen($name) < 5) {
      $valid = false;
      $nameError = "El nombre debe tener al menos 5 caracteres.";

    // nombre muy largo
    } else if (strlen($name) > 70) {
      $valid = false;
      $nameError = "El nombre debe tener menos de 70 caracteres.";
    }

  } else {
    $valid = false;
    $nameError = "Este campo es obligatorio";
    $name = "";
  }

  if (isset($_POST['url'])) {
    $url = $_POST['url'];

    if (!filter_var($url, FILTER_VALIDATE_URL)) {
      $valid = false;
      $urlError = "Url no válido.";
    }

  } else {
    $valid = false;
    $urlError = "Este campo es obligatorio";
    $url = "";
  }

  if (isset($_FILES['file']) && !empty($_FILES['file']['tmp_name'])) {
    $file = $_FILES['file']['tmp_name'];
    $fileType = @getimagesize($file)[2];
    if ((filesize($file) / pow(2, 20)) > 1) {
      $valid = false;
      $fileError = "El archivo supera el límite máximo, 1MB.";

    } else if (!in_array($fileType, [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_WEBP])) {
      $valid = false;
      $fileError = "El archivo debe ser una imagen JPG, JPEG, PNG o WEBP";
    }

  } else {
    $file = null;
  }

  if (isset($_POST['tags'])) {
    $tags = $_POST['tags'];

  } else {
    $valid = false;
    $tagsError = "Debes elegir al menos una categoría.";
    $tags = [];
  }

  if (isset($_POST['description'])){
    $description = $_POST['description'];

    // descripción muy corta
    if (strlen($description) < 30) {
      $valid = false;
      $descriptionError = "La descripción debe tener al menos 30 caracteres.";

    // descripción muy larga
    } else if (strlen($description) > 500) {
      $valid = false;
      $descriptionError = "La descripción debe tener menos de 500 caracteres.";
    }

  } else {
    $valid = false;
    $descriptionError = "La descripción es obligatoria";
    $description = "";
  }

  // seguridad
  $name = htmlspecialchars($name, ENT_HTML5);

  $url = strip_tags($url);
  $url = htmlspecialchars($url, ENT_HTML5);

  $description = htmlspecialchars($description, ENT_HTML5);

  if ($valid) {
    $captcha = $_POST["frc-captcha-solution"];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://friendlycaptcha.com/api/v1/siteverify");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,
      "solution=" . $captcha .
      "&secret=" . $captchaCredentials[1] .
      "&sitekey=" . $captchaCredentials[0]
    );

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $captchaSolution = json_decode(curl_exec($ch));
    $valid = $captchaSolution->success;
  }

  if ($valid) {
    require_once __DIR__ . "/includes/helper/salesFunc.php";
    addSale($name, $url, $tags, $description, isset($_FILES['file']) ? $_FILES['file'] : null);

    // resetear valores
    $name = "";
    $url = "";
    $tags = [];
    $description = "";

  }

} else {
  $name = "";
  $url = "";
  $tags = [];
  $description = "";
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <?php
  require_once __DIR__ . "/includes/template/head.php";

  if ($_SERVER["REQUEST_METHOD"] == "POST" && $valid) {
    ?>
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      swal({
        icon: "success",
        title: "Producto añadido",
        text: " ",
        button: false,
        timer: 1000,
      });
    });
  </script>
    <?php
  }

  ?>
  <script type="module" src="https://cdn.jsdelivr.net/npm/friendly-challenge@0.6.1/widget.module.min.js" async defer></script>
  <script nomodule src="https://cdn.jsdelivr.net/npm/friendly-challenge@0.6.1/widget.min.js" async defer></script>
  <title>Añadir chollo</title>
</head>
<body>
<?php require_once __DIR__ . "/includes/template/header.php"; ?>

  <div id="content">
    <aside class="aside-left"></aside>

    <main class="<?php echo substr(explode(".", $_SERVER["REQUEST_URI"])[0], 1) ?>">
      <form action="#" method="POST" enctype="multipart/form-data" novalidate>
        <div>
          <label for="name">
            Nombre del chollo: *
          </label>
          <?php
          if (isset($nameError)) {
            echo '<p class="validation text-error">' . $nameError . '</p>';
          }
          ?>
          <input type="text" name="name" id="name" placeholder="Introduce el nombre del chollo" value="<?php echo $name ?>" autofocus>
        </div>
        <div>
          <label for="url">
            Enlace al chollo: *
          </label>
          <?php
          if (isset($urlError)) {
            echo '<p class="validation text-error">' . $urlError . '</p>';
          }
          ?>
          <input type="url" name="url" id="url" placeholder="Enlace directo al chollo" value="<?php echo $url ?>">
        </div>
        <div>
          <label for="file">
            Imagen:
          </label>
          <?php
          if (isset($fileError)) {
            echo '<p class="validation text-error">' . $fileError . '</p>';
          }
          ?>
          <input type="file" name="file" id="file" type="image/*">
        </div>
        <div>
          <label for="tags">
            Categorías: *
          </label>
          <?php
          if (isset($tagsError)) {
            echo '<p class="validation text-error">' . $tagsError . '</p>';
          }
          ?>
          <select name="tags[]" id="tags" multiple>
            <option value="electronica" <?php echo in_array("electronica", $tags) ? "selected" : "" ?>>Electrónica</option>
            <option value="gaming" <?php echo in_array("gaming", $tags) ? "selected" : "" ?>>Gaming</option>
            <option value="moda y complementos" <?php echo in_array("moda y complementos", $tags) ? "selected" : "" ?>>Moda y complementos</option>
            <option value="coches y motos" <?php echo in_array("coches y motos", $tags) ? "selected" : "" ?>>Coches y motos</option>
            <option value="viajes" <?php echo in_array("viajes", $tags) ? "selected" : "" ?>>Viajes</option>
            <option value="otros" <?php echo in_array("otros", $tags) ? "selected" : "" ?>>Otros</option>
          </select>
        </div>
        <div>
          <label for="description">
            Descripción: *
          </label>
          <?php
          if (isset($descriptionError)) {
            echo '<p class="validation text-error">' . $descriptionError . '</p>';
          }
          ?>
          <textarea name="description" id="description" placeholder="Describe de que trata este chollo"><?php echo $description ?></textarea>
        </div>
        <div>
          <?php
          if (isset($captchaSolution) && !empty($captchaSolution->errors)) {
            echo '<p class="validation text-error">Debe completar el captcha para añadir un producto ('. $captchaSolution->errors[0] . ').</p>';
          }
          ?>
          <div class="frc-captcha dark" data-sitekey="<?php echo $captchaCredentials[0] ?>"></div>
        </div>
        <div>
          <p class="validation text-error">Debes iniciar sesión para poder añadir ofertas.</p>
          <input type="submit" id="addSale" class="transition-fast" value="Añadir" <?php echo !isset($_SESSION["authenticated"]) ? "disabled" : "" ?>>
          <p>* Campos obligatorios</p>
        </div>
      </form>
    </main>
    <aside class="aside-right"></aside>
  </div>
  <?php require_once __DIR__ . "/includes/template/footer.php"; ?>
</body>
</html>
