<?php
require_once "session.php";

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
  $error = "Debes iniciar sesión para poder cerrarla";
} else {
  // Cerrar la sesión actual
  session_unset();
  session_destroy();

  // Iniciar una nueva sesión
  session_start();
}

// Establecer el título de la página
$title = isset($error) ? "Error al cerrar sesión" : "Cerrar sesión";

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />

  <title>
    <?php echo $title; ?>
  </title>

  <link rel="stylesheet" href="./css/global.css">
  <link rel="stylesheet" href="./css/estilos-menu.css">
  <link rel="stylesheet" href="./css/estilos-pie-pagina.css">
  <link rel="stylesheet" href="./css/estilos-cerrar-sesion.css">
</head>

<body>
  <header id="cabecera">
    <div class="contenido">
      <h1>Chick</h1>

      <nav class="navegacion">
        <ul class="menu">
          <li class="menu-item">
            <a class="menu-link" href="./">Inicio</a>
          </li>
          <li class="menu-item">
            <a class="menu-link" href="dama.php">Dama</a>
          </li>
          <li class="menu-item">
            <a class="menu-link" href="caballero.php">Caballero</a>
          </li>
          <li class="menu-item">
            <a class="menu-link" href="comentarios.php">Comentarios</a>
          </li>
          <?php if (isLogged()) { ?>
            <li class="menu-item">
              <a class="menu-link" href="./confirmacion.php">Cerrar sesión</a>
            </li>
            <?php if (isAdmin()) { ?>
              <li class="menu-item">
                <a class="menu-link" href="./admin/usuarios.php">Admin</a>
              </li>
            <?php }
          } else { ?>
            <li class="menu-item">
              <a class="menu-link" href="iniciar-sesion.html">Iniciar sesión</a>
            </li>
          <?php } ?>
        </ul>
      </nav>
    </div>
  </header>

  <main id="principal" class="contenido">
    <article id="resultado">
      <?php if (isset($error)) { ?>
        <h2><?php echo $error; ?></h2>

        <section class="contenedor-btn">
          <a href="./iniciar-sesion.html" class="button">Iniciar sesión</a>
        </section>
      <?php } else { ?>
        <h2>¡Hasta pronto!</h2>

        <section class="contenedor-btn">
          <a href="./" class="button">Ir al inicio</a>
        </section>
      <?php } ?>
    </article>
  </main>

  <footer id="pie-pagina">
    <p class="derechos">
      <small>&copy; 2023 - Perfumería Chick</small>
    </p>
  </footer>
</body>

</html>