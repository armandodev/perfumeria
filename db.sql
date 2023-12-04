CREATE DATABASE IF NOT EXISTS `perfumeria` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;

USE `perfumeria`;

-- --------------------------------------------------------

-- Estructura de tabla para la tabla `perfumes`

CREATE TABLE IF NOT EXISTS `perfumes` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `marca` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `categoria` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcado de datos para la tabla `perfumes`

INSERT INTO `perfumes` (`nombre`, `marca`, `precio`, `categoria`) VALUES
('Perfume 1', 'Marca 1', '10.00', 'Caballero'),
('Perfume 2', 'Marca 2', '20.00', 'Caballero'),
('Perfume 3', 'Marca 3', '30.00', 'Caballero'),
('Perfume 4', 'Marca 4', '40.00', 'Caballero'),
('Perfume 5', 'Marca 5', '50.00', 'Caballero'),
('Perfume 6', 'Marca 6', '60.00', 'Caballero'),
('Perfume 7', 'Marca 7', '70.00', 'Caballero'),
('Perfume 8', 'Marca 8', '80.00', 'Caballero'),
('Perfume 9', 'Marca 9', '90.00', 'Caballero'),
('Perfume 10', 'Marca 10', '100.00', 'Caballero'),
('Perfume 11', 'Marca 11', '110.00', 'Caballero'),
('Perfume 12', 'Marca 12', '120.00', 'Caballero'),
('Perfume 13', 'Marca 13', '130.00', 'Caballero'),
('Perfume 14', 'Marca 14', '140.00', 'Caballero'),
('Perfume 15', 'Marca 15', '150.00', 'Dama'),
('Perfume 16', 'Marca 16', '160.00', 'Dama'),
('Perfume 17', 'Marca 17', '170.00', 'Dama'),
('Perfume 18', 'Marca 18', '180.00', 'Dama'),
('Perfume 19', 'Marca 19', '190.00', 'Dama'),
('Perfume 20', 'Marca 20', '200.00', 'Dama'),
('Perfume 21', 'Marca 21', '210.00', 'Dama'),
('Perfume 22', 'Marca 22', '220.00', 'Dama'),
('Perfume 23', 'Marca 23', '230.00', 'Dama'),
('Perfume 24', 'Marca 24', '240.00', 'Dama'),
('Perfume 25', 'Marca 25', '250.00', 'Dama'),
('Perfume 26', 'Marca 26', '260.00', 'Dama'),
('Perfume 27', 'Marca 27', '270.00', 'Dama'),
('Perfume 28', 'Marca 28', '280.00', 'Dama');


-- --------------------------------------------------------

-- Estructura de tabla para la tabla `usuarios`

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `usuario` varchar(255) COLLATE utf8_spanish_ci NOT NULL UNIQUE,
  `password` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `rol` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcado de datos para la tabla `usuarios`

INSERT INTO `usuarios` (`usuario`, `password`, `rol`) VALUES
('admin', 'admin', 'admin'),
('user', 'user', 'user');

-- --------------------------------------------------------

-- Estructura de tabla para la tabla `comentarios`

CREATE TABLE IF NOT EXISTS `comentarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_usuario` int(11) NOT NULL,
  `comentario` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
