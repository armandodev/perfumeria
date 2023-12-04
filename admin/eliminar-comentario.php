
<?php
require_once './session.php';
require_once './../conexion.php';

try {
  // Verificar si se recibió el id del comentario
  if (!isset($_GET['id']))  throw new Exception("No se recibió el id del comentario");
  $id = $_GET['id'];

  // Conectar a la base de datos
  $conn = mysqli_connect($hostname, $username, $password, $database);
  if (!$conn) throw new Exception("No se pudo conectar a la base de datos");

  // Eliminar el comentario de la base de datos
  $sql = "DELETE FROM comentarios WHERE id = $id";
  $resultado = mysqli_query($conn, $sql);
  if (!$resultado) throw new Exception("No se pudo eliminar el comentario");

  // Cerrar la conexión a la base de datos
  mysqli_close($conn);
} catch (Exception $e) {
  // Mostrar mensaje de error en caso de excepción
  echo $e->getMessage();
} finally {
  // Redirigir a la página de comentarios
  header('Location: ./comentarios.php');
  exit();
}
