<?php
require_once './session.php'; // Se incluye el archivo session.php que contiene funciones relacionadas con la sesión del usuario.
require_once './conexion.php'; // Se incluye el archivo conexion.php que establece la conexión con la base de datos.

try {
	$conn = mysqli_connect($hostname, $username, $password, $database); // Se establece la conexión con la base de datos utilizando los datos de conexión proporcionados.

	if (!$conn) throw new Exception('Error de conexión'); // Si no se pudo establecer la conexión, se lanza una excepción.

	$sql = 'SELECT * FROM perfumes WHERE categoria = "Dama"'; // Se define la consulta SQL para obtener los perfumes de la categoría "Dama".

	$perfumes = mysqli_query($conn, $sql); // Se ejecuta la consulta SQL y se obtiene el resultado.

	if (!$perfumes) throw new Exception('Ocurrió un error al obtener los productos'); // Si ocurrió un error al ejecutar la consulta, se lanza una excepción.

	if (mysqli_num_rows($perfumes) === 0) throw new Exception('No hay productos registrados'); // Si no se encontraron productos, se lanza una excepción.

	$perfumes = mysqli_fetch_all($perfumes, MYSQLI_ASSOC); // Se obtienen todos los resultados de la consulta y se almacenan en un arreglo asociativo.

	mysqli_close($conn); // Se cierra la conexión con la base de datos.
} catch (Exception $e) {
	$error = $e->getMessage(); // Se captura la excepción y se almacena el mensaje de error.
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Perfumes de Dama</title>

	<link rel="stylesheet" href="./css/global.css"> <!-- Se incluyen los estilos CSS para la página. -->
	<link rel="stylesheet" href="./css/estilos-menu.css"> <!-- Se incluyen los estilos CSS para el menú. -->
	<link rel="stylesheet" href="./css/estilos-pie-pagina.css"> <!-- Se incluyen los estilos CSS para el pie de página. -->
	<link rel="stylesheet" href="./css/estilos-catalogo.css"> <!-- Se incluyen los estilos CSS para el catálogo de productos. -->
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
					<?php if (isLogged()) { ?> <!-- Si el usuario ha iniciado sesión -->
						<li class="menu-item">
							<a class="menu-link" href="./confirmacion.php">Cerrar sesión</a>
						</li>
						<?php if (isAdmin()) { ?> <!-- Si el usuario es administrador -->
							<li class="menu-item">
								<a class="menu-link" href="./admin/usuarios.php">Admin</a>
							</li>
						<?php }
					} else { ?> <!-- Si el usuario no ha iniciado sesión -->
						<li class="menu-item">
							<a class="menu-link" href="iniciar-sesion.html">Iniciar sesión</a>
						</li>
					<?php } ?>
				</ul>
			</nav>
		</div>
	</header>

	<main id="contenido">
		<div class="contenido">
			<h2 class="titulo">Perfumes de Dama</h2>

			<?php if (isset($error)) { ?> <!-- // Si hay un error al obtener los productos -->
				<p class="error"><?php echo $error; ?></p> <!-- // Se muestra el mensaje de error. -->
			<?php } else { ?>
				<div class="catalogo">
					<?php foreach ($perfumes as $perfume) { ?> <!-- // Se itera sobre cada perfume obtenido -->
						<div class="producto">
							<?php
							$img_path = $perfume['id'] . "-" . $perfume['categoria']; // Se construye la ruta de la imagen del perfume.

							if (file_exists("./img/$img_path.jpg")) { // Si existe una imagen con extensión .jpg
								$perfume['imagen'] = "./img/$img_path.jpg"; // Se asigna la ruta de la imagen al perfume.
							} elseif (file_exists("./img/$img_path.png")) { // Si existe una imagen con extensión .png
								$perfume['imagen'] = "./img/$img_path.png"; // Se asigna la ruta de la imagen al perfume.
							} elseif (file_exists("./img/$img_path.gif")) { // Si existe una imagen con extensión .gif
								$perfume['imagen'] = "./img/$img_path.gif"; // Se asigna la ruta de la imagen al perfume.
							} elseif (file_exists("./img/$img_path.jpeg")) { // Si existe una imagen con extensión .jpeg
								$perfume['imagen'] = "./img/$img_path.jpeg"; // Se asigna la ruta de la imagen al perfume.
							} else { // Si no se encontró ninguna imagen
								$perfume['imagen'] = "./img/default.webp"; // Se asigna la ruta de la imagen por defecto al perfume.
							}
							?>
							<img class="producto-imagen" src="<?php echo $perfume['imagen']; ?>" alt="<?php echo $perfume['nombre']; ?>"> <!-- // Se muestra la imagen del perfume. -->

							<div class="producto-informacion">
								<h3 class="producto-nombre"><?php echo $perfume['nombre']; ?></h3> <!-- // Se muestra el nombre del perfume. -->
								<p class="producto-descripcion"><?php echo $perfume['descripcion']; ?></p> <!-- // Se muestra la descripción del perfume. -->
								<p class="producto-precio">$<?php echo $perfume['precio']; ?></p> <!-- // Se muestra el precio del perfume. -->
							</div>
						</div>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	</main>

	<footer id="pie-pagina">
		<p class="derechos">
			<small>&copy; 2023 - Perfumería Chick</small>
		</p>
	</footer>
</body>

</html>