<?php require_once './session.php' ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    />

    <title>Confirmación</title>

    <link rel="stylesheet" href="./css/global.css" />
    <!-- Estilos globales -->
    <link rel="stylesheet" href="./css/estilos-menu.css" />
    <!-- Estilos del menú -->
    <link rel="stylesheet" href="./css/estilos-pie-pagina.css" />
    <!-- Estilos del pie de página -->
    <link rel="stylesheet" href="./css/estilos-cerrar-sesion.css" />
    <!-- Estilos del botón de cerrar sesión -->
  </head>

  <body>
    <header id="cabecera">
      <div class="contenido">
        <h1>Chick</h1>

        <nav class="navegacion">
          <ul class="menu">
            <li class="menu-item">
              <a class="menu-link" href="./">Inicio</a>
              <!-- Enlace a la página de inicio -->
            </li>
            <li class="menu-item">
              <a class="menu-link" href="dama.php">Dama</a>
              <!-- Enlace a la página de productos para damas -->
            </li>
            <li class="menu-item">
              <a class="menu-link" href="caballero.php">Caballero</a>
              <!-- Enlace a la página de productos para caballeros -->
            </li>
            <li class="menu-item">
              <a class="menu-link" href="comentarios.php">Comentarios</a>
              <!-- Enlace a la página de comentarios -->
            </li>
            <?php if (isLogged()) { ?>
            <!-- Verifica si el usuario ha iniciado sesión -->
            <li class="menu-item">
              <a class="menu-link" href="./confirmacion.php">Cerrar sesión</a>
              <!-- Enlace para cerrar sesión -->
            </li>
            <?php if (isAdmin()) { ?>
            <!-- Verifica si el usuario es un administrador -->
            <li class="menu-item">
              <a class="menu-link" href="./admin/usuarios.php">Admin</a>
              <!-- Enlace a la página de administración de usuarios -->
            </li>
            <?php }
          } else { ?>
            <li class="menu-item">
              <a class="menu-link" href="iniciar-sesion.html">Iniciar sesión</a>
              <!-- Enlace a la página de inicio de sesión -->
            </li>
            <?php } ?>
          </ul>
        </nav>
      </div>
    </header>

    <main id="principal" class="contenido">
      <article id="confirmacion">
        <h1>¿Estas seguro(a) de que quieres cerrar sesión?</h1>

        <section class="contenedor-btn">
          <a href="./cerrar-sesion.php" class="button">Si</a>
          <!-- Enlace para confirmar el cierre de sesión -->
          <a href="./inicio.html" class="button">No</a>
          <!-- Enlace para cancelar el cierre de sesión -->
        </section>
      </article>
    </main>

    <footer id="pie-pagina">
      <p class="derechos">
        <small>&copy; 2023 - Perfumería Chick</small>
        <!-- Derechos de autor -->
      </p>
    </footer>
  </body>
</html>
