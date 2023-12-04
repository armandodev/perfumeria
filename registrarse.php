<?php
require_once 'session.php'; // Se incluye el archivo session.php que contiene funciones relacionadas con la sesión del usuario.
require_once 'conexion.php'; // Se incluye el archivo conexion.php que contiene la configuración de la conexión a la base de datos.

try {
  $conn = mysqli_connect($hostname, $username, $password, $database); // Se establece la conexión a la base de datos utilizando los datos de configuración.

  if (!$conn) throw new Exception('Error de conexión'); // Si no se pudo establecer la conexión, se lanza una excepción.

  if (!$_SERVER['REQUEST_METHOD'] === 'POST') throw new Exception('Método no permitido'); // Si el método de la solicitud no es POST, se lanza una excepción.

  if (
    !isset($_POST['usuario']) // Si no se ha enviado el campo 'usuario' en la solicitud, se lanza una excepción.
    || !isset($_POST['contrasenia']) // Si no se ha enviado el campo 'contrasenia' en la solicitud, se lanza una excepción.
    || !isset($_POST['rol']) // Si no se ha enviado el campo 'rol' en la solicitud, se lanza una excepción.
  ) throw new Exception('Faltan datos'); // Si faltan datos en la solicitud, se lanza una excepción.

  $usuario = $_POST['usuario']; // Se obtiene el valor del campo 'usuario' enviado en la solicitud.
  $password = $_POST['contrasenia']; // Se obtiene el valor del campo 'contrasenia' enviado en la solicitud.
  $rol = $_POST['rol']; // Se obtiene el valor del campo 'rol' enviado en la solicitud.

  $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'"; // Se construye la consulta SQL para verificar si el usuario ya existe en la base de datos.

  $user = mysqli_query($conn, $sql); // Se ejecuta la consulta SQL.

  if (mysqli_num_rows($user) != 0) throw new Exception('El usuario ya existe'); // Si se encontró algún resultado en la consulta, significa que el usuario ya existe y se lanza una excepción.

  $sql = "INSERT INTO usuarios (usuario, password, rol) VALUES ('$usuario', '$password', '$rol')"; // Se construye la consulta SQL para insertar un nuevo usuario en la base de datos.

  if (!mysqli_query($conn, $sql)) throw new Exception('Error al registrar'); // Si no se pudo ejecutar la consulta SQL, se lanza una excepción.
} catch (Exception $e) {
  $error = $e->getMessage(); // Se captura el mensaje de la excepción y se guarda en la variable $error.
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro</title>

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
          <?php if (isLogged()) { ?>
            <li class="menu-item">
              <a class="menu-link" href="./confirmacion.php">Cerrar sesión</a>
            </li>
            <?php if (isAdmin()) { ?>
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
      <?php if (isset($error)) { ?>
        <p class="error">
          <?php echo $error; ?>
        </p>

        <section class="contenedor-btn">
          <a href="./">Ir al inicio</a>
        </section>
      <?php } else { ?>
        <p class="ok">
          Solicitud de registro exitoso, espere a que un administrador lo apruebe
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