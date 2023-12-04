<?php
require_once './session.php'; // Se incluye el archivo de sesión para verificar la autenticación del usuario.
require_once './../conexion.php'; // Se incluye el archivo de conexión a la base de datos.

try {
  if (!isset($_GET['id'])) throw new Exception("No se recibió el id del usuario"); // Se verifica si se recibió el parámetro 'id' en la URL.

  $id = $_GET['id']; // Se obtiene el valor del parámetro 'id'.

  $conn = mysqli_connect($hostname, $username, $password, $database); // Se establece la conexión a la base de datos.

  if (!$conn) throw new Exception("No se pudo conectar a la base de datos"); // Se verifica si la conexión a la base de datos fue exitosa.

  $sql = "SELECT activo FROM usuarios WHERE id = $id"; // Se construye la consulta SQL para obtener el estado 'activo' del usuario.

  $usuario = mysqli_query($conn, $sql); // Se ejecuta la consulta SQL.

  if (!$usuario) throw new Exception("No se pudo realizar la consulta"); // Se verifica si la consulta fue exitosa.

  if (mysqli_num_rows($usuario) === 0) throw new Exception("No se encontró el usuario"); // Se verifica si se encontró el usuario en la base de datos.

  $usuario = mysqli_fetch_assoc($usuario); // Se obtiene el resultado de la consulta como un array asociativo.

  $activo = $usuario['activo'] === '1' ? '0' : '1'; // Se obtiene el valor contrario del estado 'activo' del usuario.

  $sql = "UPDATE usuarios SET activo = $activo WHERE id = $id"; // Se construye la consulta SQL para actualizar el estado 'activo' del usuario.

  $resultado = mysqli_query($conn, $sql); // Se ejecuta la consulta SQL para actualizar el estado 'activo' del usuario.

  if (!$resultado) throw new Exception("No se pudo actualizar el usuario"); // Se verifica si la actualización fue exitosa.

  mysqli_close($conn); // Se cierra la conexión a la base de datos.
} catch (Exception $e) {
  echo $e->getMessage(); // Se muestra el mensaje de error en caso de que ocurra una excepción.
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />

  <title>Usuarios</title>

  <link rel="stylesheet" href="./../css/global.css"> <!-- Se incluyen los estilos CSS para la página. -->
  <link rel="stylesheet" href="./../css/estilos-menu.css"> <!-- Se incluyen los estilos CSS para el menú. -->
  <link rel="stylesheet" href="./../css/estilos-pie-pagina.css"> <!-- Se incluyen los estilos CSS para el pie de página. -->
  <link rel="stylesheet" href="./../css/estilos-usuarios.css"> <!-- Se incluyen los estilos CSS para la sección de usuarios. -->
</head>

<body>
  <header id="cabecera">
    <div class="contenido">
      <h1>Chick</h1>

      <nav class="navegacion">
        <ul class="menu">
          <li class="menu-item">
            <a class="menu-link" href="./../">Inicio</a> <!-- Enlace al inicio del sitio. -->
          </li>
          <li class="menu-item">
            <a class="menu-link" href="./usuarios.php">Usuarios</a> <!-- Enlace a la página de usuarios. -->
          </li>
          <li class="menu-item">
            <a class="menu-link" href="./productos.php">Productos</a> <!-- Enlace a la página de productos. -->
          </li>
          <li class="menu-item">
            <a class="menu-link" href="./comentarios.php">Comentarios</a> <!-- Enlace a la página de comentarios. -->
          </li>
          <li class="menu-item">
            <a class="menu-link" href="./../confirmacion.php">Cerrar sesión</a> <!-- Enlace para cerrar sesión. -->
          </li>
        </ul>
      </nav>
    </div>
  </header>

  <main id="principal" class="contenido">
    <article id="resultado">
      <?php if (isset($error)) { ?> <!-- Se verifica si existe la variable $error. -->
        <h2><?php echo $error; ?></h2> <!-- Se muestra el mensaje de error. -->

        <section class="contenedor-btn">
          <a href="./iniciar-sesion.html" class="button">Iniciar sesión</a> <!-- Enlace para iniciar sesión. -->
        </section>
      <?php } else { ?>
        <h2>Usuario actualizado</h2> <!-- Título para indicar que el usuario ha sido actualizado. -->

        <section class="contenedor-btn">
          <a href="./usuarios.php" class="button">Regresar</a> <!-- Enlace para regresar a la página de usuarios. -->
        </section>
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