<?php
require_once 'session.php'; // Se incluye el archivo session.php que contiene la lógica de manejo de sesiones
require_once 'conexion.php'; // Se incluye el archivo conexion.php que contiene la lógica de conexión a la base de datos

try {
  if (isset($_SESSION['usuario'])) throw new Exception('Ya has iniciado sesión'); // Se verifica si ya se ha iniciado sesión

  $conn = mysqli_connect($hostname, $username, $password, $database); // Se establece la conexión a la base de datos utilizando los datos de conexión

  if (!$conn) throw new Exception('Error de conexión'); // Se verifica si hay un error en la conexión

  if (!$_SERVER['REQUEST_METHOD'] === 'POST') throw new Exception('Método no permitido'); // Se verifica si el método de la solicitud es POST

  if (!isset($_POST['usuario']) || !isset($_POST['contrasenia'])) throw new Exception('Faltan datos'); // Se verifica si faltan datos en la solicitud

  $usuario = $_POST['usuario']; // Se obtiene el valor del campo 'usuario' enviado en la solicitud
  $password = $_POST['contrasenia']; // Se obtiene el valor del campo 'contrasenia' enviado en la solicitud

  $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND password = '$password'"; // Se construye la consulta SQL para obtener los datos del usuario

  $user = mysqli_query($conn, $sql); // Se ejecuta la consulta SQL

  if (!$user) throw new Exception('Error al obtener datos'); // Se verifica si hay un error al obtener los datos del usuario

  $user = mysqli_fetch_assoc($user); // Se obtienen los datos del usuario como un arreglo asociativo

  if ($user['activo'] == 0) throw new Exception('Usuario inactivo, tiene que ser autorizado por un administrador'); // Se verifica si el usuario está inactivo

  $_SESSION['usuario'] = $user; // Se guarda la información del usuario en la sesión
} catch (Exception $e) {
  $error = $e->getMessage(); // Se captura el mensaje de error
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio de sesión</title>

  <link rel="stylesheet" href="./css/global.css">
  <link rel="stylesheet" href="./css/estilos-menu.css">
  <link rel="stylesheet" href="./css/estilos-pie-pagina.css">
  <link rel="stylesheet" href="./css/estilos-sesion.css">
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
          <?php if (isLogged()) { ?> <!-- // Se verifica si el usuario ha iniciado sesión -->
            <li class="menu-item">
              <a class="menu-link" href="./confirmacion.php">Cerrar sesión</a>
            </li>
            <?php if (isAdmin()) { ?> <!-- // Se verifica si el usuario es un administrador -->
              <li class="menu-item">
                <a class="menu-link" href="./admin/usuarios.php">Admin</a>
              </li>
            <?php }
          } else { ?>
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
      <?php if (isset($error)) { ?> <!-- // Se verifica si hay un error en el inicio de sesión -->
        <p class="error">
          <?php echo $error; ?> <!-- // Se muestra el mensaje de error -->
        </p>

        <section class="contenedor-btn">
          <a href="./">Ir al inicio</a>
        </section>
      <?php } else { ?>
        <p class="ok">
          Inicio de sesión exitoso, bienvenido(a) <?php echo $usuario; ?> <!-- // Se muestra un mensaje de inicio de sesión exitoso -->
        </p>

        <section class="contenedor-btn">
          <a href="./">Ir al inicio</a>
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