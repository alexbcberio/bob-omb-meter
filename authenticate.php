<?php
session_start();

if (isset($_SESSION["authenticated"])) {
  session_destroy();
  session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $valid = true;

  if (isset($_POST["email"])) {
    $email = $_POST["email"];

    if (strlen($email) < 10) {
      $valid = false;
      $emailError = "El email debe tener al menos 10 caracteres.";

    } else if (strlen($email) > 50) {
      $valid = false;
      $emailError = "El email debe tener menos de 50 caracteres.";

    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $valid = false;
      $emailError = "La dirección de email no es válida.";
    }

  } else {
    $valid = false;
    $emailError = "Este campo es obligatorio";
    $email = "";
  }

  if (isset($_POST["pass"])) {
    $pass = $_POST["pass"];

    if (strlen($pass) < 6) {
      $valid = false;
      $passError = "La clave debe tener al menos 6 caracteres.";

    } else if (strlen($pass) > 20) {
      $valid = false;
      $passError = "La clave debe tener menos de 20 caracteres.";
    }

  } else {
    $valid = false;
    $passError = "Este campo es obligatorio";
    $username = "";
  }

  if ($valid) {
    require_once __DIR__ . "/includes/helper/authFunc.php";

    if (isset($_POST["register"])) {
      if (!addUser($email, $pass)) {
        $emailError = "El email indicado está en uso";

      } else {
        $_SESSION["authenticated"] = true;
        $_SESSION["email"] = $email;
        $_SESSION["alertShown"] = false;
        header("Location: /");
      }

    } else if (isset($_POST["login"])) {
      if (checkUser($email, $pass)) {
        $_SESSION["authenticated"] = true;
        $_SESSION["email"] = $email;
        $_SESSION["alertShown"] = false;
        header("Location: /");

      } else {
        $emailError = "La combinación de email y contraseña no son válidas.";
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <?php require_once __DIR__ . "/includes/template/head.php"; ?>

  <title>Autenticación</title>
</head>
<body>
<?php require_once __DIR__ . "/includes/template/header.php"; ?>

  <div id="content">
    <aside class="aside-left"></aside>

    <main class="<?php echo substr(explode(".", $_SERVER["REQUEST_URI"])[0], 1) ?>">

    <form action="#" method="POST" enctype="multipart/form-data" novalidate>
        <div>
          <label for="email">
            Email: *
          </label>
          <p class="validation text-error" id="emailError"><?php echo $emailError ?? "" ?></p>
          <input type="text" name="email" id="email" placeholder="Introduzca el correo electrónico" value="<?php echo $email ?? "" ?>" autofocus>
        </div>
        <div>
          <label for="pass">
            Contraseña: *
          </label>
          <p class="validation text-error" id="passError"><?php echo $passError ?? "" ?></p>
          <input type="password" name="pass" id="pass" placeholder="Introduzca la contraseña">
        </div>
        <div>
          <p>* Campos obligatorios</p>
        </div>
        <div>
        <input type="submit" name="register" value="Registrarse">
        <input type="submit" name="login" value="Iniciar Sesión">
        </div>
      </form>

    </main>

    <aside class="aside-right"></aside>
  </div>

  <?php require_once __DIR__ . "/includes/template/footer.php"; ?>
</body>
</html>