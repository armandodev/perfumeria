<?php

/**
 * Este archivo se encarga de agregar un nuevo perfume a la base de datos.
 * Maneja el envío del formulario y la carga de archivos.
 */

require_once './session.php'; // Incluir el archivo de sesión para manejar las sesiones de usuario
require_once './../conexion.php'; // Incluir el archivo de conexión a la base de datos

$conn = mysqli_connect($hostname, $username, $password, $database); // Conectar a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nombre = $_POST["nombre"]; // Obtener el nombre del perfume del envío del formulario
  $marca = $_POST["marca"]; // Obtener la marca del perfume del envío del formulario
  $precio = $_POST["precio"]; // Obtener el precio del perfume del envío del formulario
  $categoria = $_POST["categoria"]; // Obtener la categoría del perfume del envío del formulario
  $imagen = $_FILES["imagen"]; // Obtener el archivo de imagen cargado del envío del formulario

  $sql = "INSERT INTO perfumes (nombre, marca, precio, categoria) VALUES ('$nombre', '$marca', '$precio', '$categoria')"; // Consulta SQL para insertar los detalles del perfume en la base de datos
  mysqli_query($conn, $sql); // Ejecutar la consulta SQL

  $currentDirectory = __DIR__; // Obtener la ruta del directorio actual
  $targetDirectory = $currentDirectory . "/../img/"; // Establecer el directorio de destino para almacenar la imagen cargada
  $imageName = mysqli_insert_id($conn) . "-$categoria." . pathinfo($imagen["name"], PATHINFO_EXTENSION); // Generar un nombre de imagen único basado en el ID del perfume insertado y la categoría
  $targetFilePath = $targetDirectory . $imageName; // Establecer la ruta del archivo de destino para almacenar la imagen cargada
  $imageFileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); // Obtener la extensión del archivo de imagen cargado

  if (move_uploaded_file($imagen["tmp_name"], $targetFilePath)) {
    echo "El archivo " . htmlspecialchars(basename($imagen["name"])) . " ha sido subido con éxito."; // Mostrar mensaje de éxito si la imagen se carga correctamente
  } else {
    echo "Lo siento, hubo un error al subir tu archivo. Detalles del error: " . json_encode(error_get_last()); // Mostrar mensaje de error si hay un error al cargar la imagen
  }

  echo "Directorio de destino: $targetDirectory<br>"; // Mostrar la ruta del directorio de destino
  echo "Nombre de la imagen: $imageName<br>"; // Mostrar el nombre de imagen generado
  echo "Ruta del archivo de destino: $targetFilePath<br>"; // Mostrar la ruta del archivo de destino

  mysqli_close($conn); // Cerrar la conexión a la base de datos
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Agregar Perfume</title>
</head>

<body>
  <h2>Agregar Perfume</h2>
  <form method="POST" enctype="multipart/form-data">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" required><br><br>

    <label for="marca">Marca:</label>
    <input type="text" name="marca" required><br><br>

    <label for="precio">Precio:</label>
    <input type="number" name="precio" required><br><br>

    <label for="categoria">Categoría:</label>
    <input type="text" name="categoria" required><br><br>

    <label for="imagen">Imagen:</label>
    <input type="file" name="imagen" required><br><br>

    <input type="submit" value="Agregar Perfume">
  </form>
</body>

</html>