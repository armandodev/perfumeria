<?php
require_once './session.php'; // Se incluye el archivo de sesión para verificar la autenticación del usuario.
require_once './../conexion.php'; // Se incluye el archivo de conexión a la base de datos.

try {
  $conn = mysqli_connect($hostname, $username, $password, $database); // Se establece la conexión a la base de datos.

  if (!$conn) throw new Exception("No se pudo conectar a la base de datos"); // Si no se puede establecer la conexión, se lanza una excepción.

  $sql = "SELECT * FROM perfumes ORDER BY id DESC"; // Consulta SQL para obtener todos los perfumes ordenados por ID de forma descendente.

  $perfumes = mysqli_query($conn, $sql); // Se ejecuta la consulta SQL.

  if (!$perfumes) throw new Exception("No se pudo realizar la consulta"); // Si no se puede ejecutar la consulta, se lanza una excepción.

  if (mysqli_num_rows($perfumes) === 0) throw new Exception("No se encontraron perfumes"); // Si no se encontraron resultados, se lanza una excepción.

  $perfumes = mysqli_fetch_all($perfumes, MYSQLI_ASSOC); // Se obtienen todos los resultados de la consulta como un array asociativo.
  mysqli_close($conn); // Se cierra la conexión a la base de datos.
} catch (Exception $e) {
  $error = $e->getMessage(); // Se captura el mensaje de la excepción en caso de que ocurra un error.
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Perfumes</title>

  <link rel="stylesheet" href="./../css/global.css"> <!-- Se incluye el archivo CSS global. -->
  <link rel="stylesheet" href="./../css/estilos-menu.css"> <!-- Se incluye el archivo CSS para los estilos del menú. -->
  <link rel="stylesheet" href="./../css/estilos-pie-pagina.css"> <!-- Se incluye el archivo CSS para los estilos del pie de página. -->
  <link rel="stylesheet" href="./../css/estilos-perfumes.css"> <!-- Se incluye el archivo CSS para los estilos de la página de perfumes. -->
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
            <a class="menu-link" href="./usuarios.php">Usuarios</a> <!-- Enlace para ir a la página de usuarios. -->
          </li>
          <li class="menu-item">
            <a class="menu-link" href="./productos.php">Productos</a> <!-- Enlace para ir a la página de productos (actual). -->
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
      <h2>Perfumes</h2> <!-- Título de la página de perfumes. -->

      <a href="./agregar-perfume.php">Agregar perfume</a> <!-- Enlace para agregar un nuevo perfume. -->

      <?php if (isset($error)) { ?> <!-- Si hay un error, se muestra un mensaje de error. -->
        <p class="error"><?php echo $error; ?></p>
      <?php } else { ?>
        <div class="perfumes">
          <?php foreach ($perfumes as $perfume) { ?> <!-- Se itera sobre cada perfume obtenido de la base de datos. -->
            <div class="perfume">
              <div class="perfume-info">
                <p class="perfume-nombre"><?php echo $perfume['nombre']; ?></p> <!-- Se muestra el nombre del perfume. -->
                <p class="perfume-marca"><?php echo $perfume['marca']; ?></p> <!-- Se muestra la marca del perfume. -->
                <p class="perfume-precio"><?php echo $perfume['precio']; ?></p> <!-- Se muestra el precio del perfume. -->
              </div>
              <div class="perfume-acciones">
                <a class="perfume-accion" href="./editar-perfume.php?id=<?php echo $perfume['id']; ?>">Editar</a> <!-- Enlace para editar el perfume. -->
                <a class="perfume-accion" href="./eliminar-perfume.php?id=<?php echo $perfume['id']; ?>">Eliminar</a> <!-- Enlace para eliminar el perfume. -->
              </div>
            </div>
          <?php } ?>
        </div>
      <?php } ?>
    </div>
  </main>

  <footer id="pie-pagina">
    <div class="derechos">
      <p>Chick &copy; 2021</p> <!-- Derechos de autor del sitio web. -->
    </div>
  </footer>
</body>

</html>