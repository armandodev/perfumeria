<?php
require_once './session.php'; // Se incluye el archivo session.php que contiene funciones relacionadas con la sesión del usuario.
require_once './conexion.php'; // Se incluye el archivo conexion.php que contiene la configuración de la conexión a la base de datos.

try {
  $conn = new mysqli($hostname, $username, $password, $database); // Se crea una nueva instancia de la clase mysqli para establecer la conexión a la base de datos.

  if ($conn->connect_errno) throw new Exception('Error de conexión'); // Si hay un error al conectar a la base de datos, se lanza una excepción.

  $sql = "SELECT * FROM comentarios INNER JOIN usuarios ON comentarios.id_usuario = usuarios.id ORDER BY comentarios.fecha DESC"; // Se define una consulta SQL para obtener los comentarios de la base de datos.

  $comentarios = $conn->query($sql); // Se ejecuta la consulta SQL y se guarda el resultado en la variable $comentarios.

  if (!$comentarios || mysqli_num_rows($comentarios) === 0) throw new Exception('No hay comentarios'); // Si no se obtienen resultados de la consulta o no hay comentarios, se lanza una excepción.

  $comentarios = $comentarios->fetch_all(MYSQLI_ASSOC); // Se obtienen todos los comentarios como un array asociativo y se guarda en la variable $comentarios.
  $conn->close(); // Se cierra la conexión a la base de datos.
} catch (Exception $e) {
  $error = $e->getMessage(); // Si se produce una excepción, se guarda el mensaje de error en la variable $error.
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Comentarios</title>

  <link rel="stylesheet" href="./css/global.css"> <!-- Se incluyen archivos CSS para dar estilo a la página. -->
  <link rel="stylesheet" href="./css/estilos-menu.css">
  <link rel="stylesheet" href="./css/estilos-pie-pagina.css">
  <link rel="stylesheet" href="./css/estilos-comentarios.css">
</head>

<body>
  <header id="cabecera">
    <div class="contenido">
      <h1>Chick</h1>

      <nav class="navegacion">
        <ul class="menu">
          <li class="menu-item">
            <a class="menu-link" href="./">Inicio</a> <!-- Enlace al inicio de la página. -->
          </li>
          <li class="menu-item">
            <a class="menu-link" href="dama.php">Dama</a> <!-- Enlace a la sección de productos para damas. -->
          </li>
          <li class="menu-item">
            <a class="menu-link" href="caballero.php">Caballero</a> <!-- Enlace a la sección de productos para caballeros. -->
          </li>
          <li class="menu-item">
            <a class="menu-link" href="comentarios.php">Comentarios</a> <!-- Enlace a la página de comentarios. -->
          </li>
          <?php if (isLogged()) { ?> <!-- Si el usuario ha iniciado sesión. -->
            <li class="menu-item">
              <a class="menu-link" href="./confirmacion.php">Cerrar sesión</a> <!-- Enlace para cerrar sesión. -->
            </li>
            <?php if (isAdmin()) { ?> <!-- Si el usuario es administrador. -->
              <li class="menu-item">
                <a class="menu-link" href="./admin/usuarios.php">Admin</a> <!-- Enlace a la sección de administración. -->
              </li>
            <?php }
          } else { ?> <!-- Si el usuario no ha iniciado sesión. -->
            <li class="menu-item">
              <a class="menu-link" href="iniciar-sesion.html">Iniciar sesión</a> <!-- Enlace para iniciar sesión. -->
            </li>
          <?php } ?>
        </ul>
      </nav>
    </div>
  </header>

  <main id="principal" class="contenido">
    <article>
      <a href="./agregar-comentario.html" class="btn"> <!-- Enlace para agregar un nuevo comentario. -->
        Agregar comentario
      </a>
      <?php if (isset($error)) { ?> <!-- Si hay un error al obtener los comentarios. -->
        <p class="error"><?php echo $error; ?></p> <!-- Se muestra el mensaje de error. -->
      <?php } else { ?>
        <h2>Comentarios</h2>

        <div class="comentarios">
          <?php foreach ($comentarios as $comentario) { ?> <!-- Se itera sobre cada comentario. -->
            <div class="comentario">
              <p class="usuario">@<?php echo $comentario['usuario'] ?></p> <!-- Se muestra el nombre de usuario del comentario. -->
              <p class="contenido-comentario"><?php echo $comentario['comentario'] ?></p> <!-- Se muestra el contenido del comentario. -->
            </div>
          <?php } ?>
        </div>
      <?php } ?>
    </article>
  </main>

  <footer id="pie-pagina">
    <p class="derechos">
      <small>&copy; 2023 - Perfumería Chick</small> <!-- Texto de derechos de autor. -->
    </p>
  </footer>
</body>

</html>