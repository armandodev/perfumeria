<?php require_once './session.php' ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    />

    <title>Perfumes Chick</title>

    <link rel="stylesheet" href="./css/global.css" />
    <!-- Estilos globales -->
    <link rel="stylesheet" href="./css/estilos-menu.css" />
    <!-- Estilos del menú -->
    <link rel="stylesheet" href="./css/estilos-pie-pagina.css" />
    <!-- Estilos del pie de página -->
    <link rel="stylesheet" href="./css/estilos-index.css" />
    <!-- Estilos específicos de la página index -->
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
              <!-- Enlace a la página de productos para dama -->
            </li>
            <li class="menu-item">
              <a class="menu-link" href="caballero.php">Caballero</a>
              <!-- Enlace a la página de productos para caballero -->
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
            <!-- Verifica si el usuario es administrador -->
            <li class="menu-item">
              <a class="menu-link" href="./admin/usuarios.php">Admin</a>
              <!-- Enlace a la página de administración -->
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
      <section>
        <article id="acerca">
          <h2 class="subtitulo">Acerca de Nosotros</h2>
          <p class="parrafo">
            Somos una perfumería dedicada a ofrecer fragancias de alta calidad
            para todos los gustos. Con una amplia variedad de perfumes para
            hombres y mujeres, nos esforzamos por brindar a nuestros clientes
            una experiencia de compra excepcional. Nuestros productos son
            seleccionados cuidadosamente para garantizar que cada aroma que
            ofrecemos sea único y atractivo.
          </p>
        </article>

        <article id="productos">
          <h2 class="subtitulo">Nuestros Productos</h2>
          <p class="parrafo">
            Descubre nuestra amplia gama de perfumes para hombres y mujeres.
            Cada uno de nuestros productos ha sido seleccionado cuidadosamente
            para ofrecerte solo las fragancias de la más alta calidad.
          </p>
          <section class="contenedor-btn">
            <a href="./caballero.php" class="caballero">
              Perfumes para Caballero
            </a>
            <a href="./dama.php" class="dama"> Perfumes para Dama </a>
          </section>
        </article>

        <article id="comentarios">
          <h2 class="subtitulo">Comentarios</h2>
          <p class="parrafo">
            Lee lo que nuestros clientes satisfechos tienen que decir sobre
            nuestros productos y servicios. Estamos orgullosos de la confianza
            que nuestros clientes depositan en nosotros.
          </p>
          <section class="contenedor-btn">
            <a href="comentarios.php">Ver Comentarios</a>
          </section>
        </article>
      </section>
    </main>

    <footer id="pie-pagina">
      <p class="derechos">
        <small>&copy; 2023 - Perfumería Chick</small>
      </p>
    </footer>
  </body>
</html>
