<?php
require_once './session.php'; // Se incluye el archivo de sesión para verificar la autenticación del usuario.
require_once './../conexion.php'; // Se incluye el archivo de conexión a la base de datos.

try {
  $conn = mysqli_connect($hostname, $username, $password, $database); // Se establece la conexión a la base de datos.

  if (!$conn) throw new Exception("No se pudo conectar a la base de datos"); // Si no se puede establecer la conexión, se lanza una excepción.

  $sql = "SELECT c.*, u.usuario 
    FROM comentarios AS c
    INNER JOIN usuarios AS u ON c.id_usuario = u.id
    ORDER BY c.id DESC"; // Consulta SQL para obtener los comentarios y los nombres de usuario asociados.

  $comentarios = mysqli_query($conn, $sql); // Se ejecuta la consulta SQL.

  if (!$comentarios) throw new Exception("No se pudo realizar la consulta"); // Si no se puede ejecutar la consulta, se lanza una excepción.

  if (mysqli_num_rows($comentarios) === 0) throw new Exception("No se encontraron comentarios"); // Si no se encuentran comentarios, se lanza una excepción.

  $comentarios = mysqli_fetch_all($comentarios, MYSQLI_ASSOC); // Se obtienen todos los comentarios como un array asociativo.
  mysqli_close($conn); // Se cierra la conexión a la base de datos.
} catch (Exception $e) {
  $error = $e->getMessage(); // Se captura el mensaje de error en caso de excepción.
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Comentarios</title>

  <!-- Se incluye el archivo CSS global. -->
  <link rel="stylesheet" href="./../css/global.css">
  <!-- Se incluye el archivo CSS para los estilos del menú. -->
  <link rel="stylesheet" href="./../css/estilos-menu.css">
  <!-- Se incluye el archivo CSS para los estilos del pie de página. -->
  <link rel="stylesheet" href="./../css/estilos-pie-pagina.css">

  <style>
    /* Estilos para la sección de comentarios */
    .comentarios {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .comentario {
      display: flex;
      flex-direction: row;
      gap: 1rem;
      padding: 1rem;
      border: 1px solid #ccc;
      border-radius: 0.5rem;
    }

    .comentario-info {
      flex: 1;
    }

    .comentario-acciones {
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
    }

    .comentario-accion {
      padding: 0.5rem;
      border: 1px solid #ccc;
      border-radius: 0.5rem;
      text-align: center;
    }
  </style>
</head>

<body>
  <header id="cabecera">
    <div class="contenido">
      <h1>Chick</h1>

      <nav class="navegacion">
        <ul class="menu">
          <li class="menu-item">
            <a class="menu-link" href="./../">Inicio</a>
          </li>
          <li class="menu-item">
            <a class="menu-link" href="./usuarios.php">Usuarios</a>
          </li>
          <li class="menu-item">
            <a class="menu-link" href="./productos.php">Productos</a>
          </li>
          <li class="menu-item">
            <a class="menu-link" href="./comentarios.php">Comentarios</a>
          </li>
          <li class="menu-item">
            <a class="menu-link" href="./../confirmacion.php">Cerrar sesión</a>
          </li>
        </ul>
      </nav>
    </div>
  </header>

  <main id="principal" class="contenido">
    <div class="contenedor">
      <h2>Comentarios</h2>

      <?php if (isset($error)) { ?>
        <p class="error"><?php echo $error; ?></p> <!-- Si hay un error, se muestra un mensaje de error. -->
      <?php } else { ?>
        <div class="comentarios">
          <?php foreach ($comentarios as $comentario) { ?>
            <div class="comentario">
              <div class="comentario-info">
                <p class="comentario-nombre"><?php echo $comentario['usuario']; ?></p> <!-- Se muestra el nombre de usuario asociado al comentario. -->
                <p class="comentario-email"><?php echo $comentario['comentario']; ?></p> <!-- Se muestra el contenido del comentario. -->
              </div>
              <div class="comentario-acciones">
                <a class="comentario-accion" href="./eliminar-comentario.php?id=<?php echo $comentario['id']; ?>">Eliminar</a> <!-- Se muestra un enlace para eliminar el comentario. -->
              </div>
            </div>
          <?php } ?>
        </div>
      <?php } ?>
    </div>
  </main>

  <footer id="pie-pagina">
    <div class="derechos">
      <p>Chick &copy; 2021</p> <!-- Se muestra el año de derechos de autor. -->
    </div>
  </footer>
</body>

</html>