<?php
require_once './session.php'; // Se incluye el archivo session.php que contiene la lógica de la sesión
require_once './../conexion.php'; // Se incluye el archivo conexion.php que contiene la lógica de conexión a la base de datos

try {
  if (!isset($_GET['id']))  throw new Exception("No se recibió el id del perfume"); // Si no se recibe el parámetro 'id' en la URL, se lanza una excepción
  $id = $_GET['id']; // Se obtiene el valor del parámetro 'id' de la URL
  $conn = mysqli_connect($hostname, $username, $password, $database); // Se establece la conexión a la base de datos utilizando los datos de conexión
  if (!$conn) throw new Exception("No se pudo conectar a la base de datos"); // Si no se pudo establecer la conexión, se lanza una excepción
  $sql = "DELETE FROM perfumes WHERE id = $id"; // Se construye la consulta SQL para eliminar el perfume con el id especificado
  $resultado = mysqli_query($conn, $sql); // Se ejecuta la consulta SQL
  if (!$resultado) throw new Exception("No se pudo eliminar el perfume"); // Si no se pudo ejecutar la consulta, se lanza una excepción
  mysqli_close($conn); // Se cierra la conexión a la base de datos
} catch (Exception $e) {
  echo $e->getMessage(); // Se muestra el mensaje de la excepción en caso de que ocurra un error
} finally {
  header('Location: ./productos.php'); // Se redirige al usuario a la página productos.php
  exit(); // Se finaliza la ejecución del script
}
