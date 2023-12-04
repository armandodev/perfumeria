<?php
require_once "session.php"; // Se incluye el archivo "session.php" que contiene funciones relacionadas con la sesión del usuario.
require_once "conexion.php"; // Se incluye el archivo "conexion.php" que contiene la configuración de la conexión a la base de datos.

try {
  if (!isLogged()) throw new Exception("No has iniciado sesión, inicia sesión para comentar"); // Si el usuario no ha iniciado sesión, se lanza una excepción con un mensaje de error.
  if (!$_SERVER["REQUEST_METHOD"] == "POST") throw new Exception("No se recibieron datos"); // Si el método de solicitud no es POST, se lanza una excepción con un mensaje de error.
  if (!isset($_POST["comentario"])) throw new Exception("El comentario esta vacío"); // Si el campo de comentario no está definido en la solicitud, se lanza una excepción con un mensaje de error.

  $idUsuario = $_SESSION["usuario"]["id"]; // Se obtiene el ID del usuario actualmente logueado.
  $comentario = $_POST["comentario"]; // Se obtiene el contenido del comentario enviado en la solicitud POST.

  $conn = mysqli_connect($hostname, $username, $password, $database); // Se establece la conexión a la base de datos utilizando los datos de conexión proporcionados.

  if (!$conn) throw new Exception("No se pudo conectar a la base de datos"); // Si no se pudo establecer la conexión a la base de datos, se lanza una excepción con un mensaje de error.

  $sql = "INSERT INTO comentarios (comentario, id_usuario) VALUES ('$comentario', '$idUsuario')"; // Se construye la consulta SQL para insertar el comentario en la tabla "comentarios".
  $result = mysqli_query($conn, $sql); // Se ejecuta la consulta SQL.

  if (!$result) throw new Exception("Ocurrió un error al guardar el comentario"); // Si no se pudo ejecutar la consulta SQL, se lanza una excepción con un mensaje de error.
} catch (Exception $e) {
  $error = $e->getMessage(); // Se captura la excepción y se guarda el mensaje de error en la variable "$error".
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Comentario</title>

  <link rel="stylesheet" href="./css/global.css">
  <link rel="stylesheet" href="./css/estilos-menu.css">
  <link rel="stylesheet" href="./css/estilos-pie-pagina.css">
  <link rel="stylesheet" href="./css/estilos-agregar-comentario.css">
</head>

<body>
  <header id="cabecera">
    <div class="contenido">
      <h1>Chick</h1>

      <nav class="navegacion">
        <ul class="menu">
          <li class="menu-item">
            <a class="menu-link" href="./">Inicio</a>
          </li>
          <li class="menu-item">
            <a class="menu-link" href="dama.php">Dama</a>
          </li>
          <li class="menu-item">
            <a class="menu-link" href="caballero.php">Caballero</a>
          </li>
          <li class="menu-item">
            <a class="menu-link" href="comentarios.php">Comentarios</a>
          </li>
          <?php if (isLogged()) { ?>
            <!-- Si el usuario ha iniciado sesión -->
            <li class="menu-item">
              <a class="menu-link" href="./confirmacion.php">Cerrar sesión</a>
            </li>
            <?php if (isAdmin()) { ?>
              <!-- Si el usuario es un administrador -->
              <li class="menu-item">
                <a class="menu-link" href="./admin/usuarios.php">Admin</a>
              </li>
            <?php } ?>
          <?php } else { ?>
            <!-- Si el usuario no ha iniciado sesión -->
            <li class="menu-item">
              <a class="menu-link" href="iniciar-sesion.html">Iniciar sesión</a>
            </li>
          <?php } ?>
        </ul>
      </nav>
    </div>
  </header>
  <main id="principal" class="contenido">
    <article>
      <?php if (isset($error)) { ?>
        <!-- Si se ha producido un error al guardar el comentario -->
        <p class="error">
          <?php echo $error; ?>
        </p>

        <section class="contenedor-btn">
          <a href="./agregar-comentario.html" class="btn">
            Intentar de nuevo
          </a>
        </section>
      <?php } else { ?>
        <!-- Si no se ha producido ningún error -->
        <p class="ok">
          El comentario ha sido agregado correctamente, gracias por tu opinión.
        </p>

        <section class="contenedor-btn">
          <a href="./" class="btn">Ir al inicio</a>
        </section>
      <?php } ?>
    </article>
  </main>

  <footer id="pie-pagina">
    <p class="derechos">
      <small>&copy; 2023 - Perfumería Chick</small>
    </p>
  </footer>
</body>

</html>