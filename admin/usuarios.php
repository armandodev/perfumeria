<?php
require_once './session.php'; // Se incluye el archivo de sesión para verificar la autenticación del usuario.
require_once './../conexion.php'; // Se incluye el archivo de conexión a la base de datos.

try {
  $conn = mysqli_connect($hostname, $username, $password, $database); // Se establece la conexión a la base de datos.

  if (!$conn) throw new Exception("No se pudo conectar a la base de datos"); // Si no se pudo establecer la conexión, se lanza una excepción.

  $sql = "SELECT * FROM usuarios ORDER BY activo ASC, id DESC"; // Consulta SQL para obtener todos los usuarios ordenados por estado y ID.

  $usuarios = mysqli_query($conn, $sql); // Se ejecuta la consulta SQL.

  if (!$usuarios) throw new Exception("No se pudo realizar la consulta"); // Si no se pudo ejecutar la consulta, se lanza una excepción.

  if (mysqli_num_rows($usuarios) === 0) throw new Exception("No se encontraron usuarios"); // Si no se encontraron usuarios, se lanza una excepción.

  $usuarios = mysqli_fetch_all($usuarios, MYSQLI_ASSOC); // Se obtienen todos los resultados de la consulta como un array asociativo.
  mysqli_close($conn); // Se cierra la conexión a la base de datos.
} catch (Exception $e) {
  $error = $e->getMessage(); // Se captura el mensaje de la excepción en caso de error.
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Usuarios</title>

  <link rel="stylesheet" href="./../css/global.css"> <!-- Se incluye el archivo CSS global. -->
  <link rel="stylesheet" href="./../css/estilos-menu.css"> <!-- Se incluye el archivo CSS para los estilos del menú. -->
  <link rel="stylesheet" href="./../css/estilos-pie-pagina.css"> <!-- Se incluye el archivo CSS para los estilos del pie de página. -->
  <link rel="stylesheet" href="./../css/estilos-usuarios.css"> <!-- Se incluye el archivo CSS para los estilos de la página de usuarios. -->
</head>

<body>
  <header id="cabecera">
    <div class="contenido">
      <h1>Chick</h1>

      <nav class="navegacion">
        <ul class="menu">
          <li class="menu-item">
            <a class="menu-link" href="./../">Inicio</a> <!-- Enlace para ir a la página de inicio. -->
          </li>
          <li class="menu-item">
            <a class="menu-link" href="./usuarios.php">Usuarios</a> <!-- Enlace para ir a la página de usuarios (página actual). -->
          </li>
          <li class="menu-item">
            <a class="menu-link" href="./productos.php">Productos</a> <!-- Enlace para ir a la página de productos. -->
          </li>
          <li class="menu-item">
            <a class="menu-link" href="./comentarios.php">Comentarios</a> <!-- Enlace para ir a la página de comentarios. -->
          </li>
          <li class="menu-item">
            <a class="menu-link" href="./../confirmacion.php">Cerrar sesión</a> <!-- Enlace para cerrar sesión. -->
          </li>
        </ul>
      </nav>
    </div>
  </header>

  <main id="principal" class="contenido">
    <div class="contenedor">
      <h2>Usuarios</h2>

      <?php if (isset($error)) { ?> <!-- Si hay un error, se muestra un mensaje de error. -->
        <p class="error"><?php echo $error; ?></p>
      <?php } else { ?>
        <div class="usuarios">
          <?php foreach ($usuarios as $usuario) { ?> <!-- Se itera sobre cada usuario obtenido de la base de datos. -->
            <div class="usuario">
              <div class="usuario-info">
                <p class="usuario-nombre"><?php echo $usuario['usuario']; ?></p> <!-- Se muestra el nombre del usuario. -->
                <p class="usuario-correo"><?php echo $usuario['rol']; ?></p> <!-- Se muestra el rol del usuario. -->
                <p class="usuario-activo <?php echo $usuario['activo'] ? 'true' : 'false' ?>"><?php echo $usuario['activo'] ? 'Activo' : 'Inactivo'; ?></p> <!-- Se muestra el estado del usuario (activo o inactivo). -->
              </div>
              <div class="usuario-acciones">
                <?php if ($usuario['activo']) { ?> <!-- Si el usuario está activo, se muestra el enlace para desactivarlo. -->
                  <a class="usuario-accion" href="./autorizar-usuarios.php?id=<?php echo $usuario['id']; ?>">Desactivar</a>
                <?php } else { ?> <!-- Si el usuario está inactivo, se muestra el enlace para activarlo. -->
                  <a class="usuario-accion" href="./autorizar-usuarios.php?id=<?php echo $usuario['id']; ?>">Activar</a>
                <?php } ?>
              </div>
            </div>
          <?php } ?>
        </div>
      <?php } ?>
    </div>
  </main>

  <footer id="pie-pagina">
    <div class="derechos">
      <p>Chick &copy; 2021</p> <!-- Texto de derechos de autor. -->
    </div>
  </footer>
</body>

</html>