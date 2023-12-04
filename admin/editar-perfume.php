<?php
require_once './session.php'; // Se incluye el archivo de sesión para verificar la autenticación del usuario.
require_once './../conexion.php'; // Se incluye el archivo de conexión a la base de datos.

$id = $_GET['id']; // Se obtiene el ID del perfume a editar.

$conn = mysqli_connect($hostname, $username, $password, $database); // Se establece la conexión a la base de datos.

$sql = "SELECT * FROM perfumes WHERE id = $id"; // Se construye la consulta SQL para obtener los datos del perfume.

$perfume = mysqli_query($conn, $sql); // Se ejecuta la consulta SQL.

$perfume = mysqli_fetch_assoc($perfume); // Se obtienen los datos del perfume.

mysqli_close($conn); // Se cierra la conexión a la base de datos.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nombre = $_POST['nombre']; // Se obtiene el nombre del perfume desde el formulario.
  $marca = $_POST['marca']; // Se obtiene la marca del perfume desde el formulario.
  $precio = $_POST['precio']; // Se obtiene el precio del perfume desde el formulario.

  $conn = mysqli_connect($hostname, $username, $password, $database); // Se establece la conexión a la base de datos.

  $sql = "UPDATE perfumes SET nombre = '$nombre', marca = '$marca', precio = $precio WHERE id = $id"; // Se construye la consulta SQL para actualizar los datos del perfume.

  $resultado = mysqli_query($conn, $sql); // Se ejecuta la consulta SQL.

  header('Location: ./productos.php'); // Se redirige al usuario a la página de productos.
  exit(); // Se finaliza la ejecución del script.
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Perfume</title>

  <link rel="stylesheet" href="./../css/global.css"> <!-- Se incluye el archivo CSS global. -->
  <link rel="stylesheet" href="./../css/estilos-menu.css"> <!-- Se incluye el archivo CSS para los estilos del menú. -->
  <link rel="stylesheet" href="./../css/estilos-perfumes.css"> <!-- Se incluye el archivo CSS para los estilos de los perfumes. -->
  <link rel="stylesheet" href="./../css/estilos-pie-pagina.css"> <!-- Se incluye el archivo CSS para los estilos del pie de página. -->
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
    <div class="contenedor">
      <h1>Editar Perfume</h1>

      <form method="POST" action="">
        <label for="nombre">Nombre:</label> <!-- Etiqueta para el campo de nombre del perfume. -->
        <input type="text" name="nombre" value="<?php echo $perfume['nombre']; ?>" class="input-field"><br> <!-- Campo de texto para ingresar el nombre del perfume. -->

        <label for="marca">Marca:</label> <!-- Etiqueta para el campo de marca del perfume. -->
        <input type="text" name="marca" value="<?php echo $perfume['marca']; ?>" class="input-field"><br> <!-- Campo de texto para ingresar la marca del perfume. -->

        <label for="precio">Precio:</label> <!-- Etiqueta para el campo de precio del perfume. -->
        <input type="number" name="precio" step="0.01" value="<?php echo $perfume['precio']; ?>" class="input-field"><br> <!-- Campo numérico para ingresar el precio del perfume. -->

        <input type="submit" value="Guardar cambios" class="submit-button"> <!-- Botón para guardar los cambios del perfume. -->
      </form>
    </div>
  </main>

  <footer id="pie-pagina">
    <div class="derechos">
      <p>Chick &copy; 2020</p> <!-- Texto de derechos de autor. -->
    </div>
  </footer>
</body>

</html>