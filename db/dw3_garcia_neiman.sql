-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-06-2025 a las 04:52:56
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dw3_garcia_neiman`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `categoria_id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`categoria_id`, `nombre`) VALUES
(1, 'Figura de acción'),
(2, 'Ropa'),
(3, 'Taza'),
(4, 'Poster'),
(5, 'Llavero'),
(6, 'Juguete'),
(7, 'Accesorios'),
(8, 'Reloj'),
(9, 'Decoración');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `franquicias`
--

CREATE TABLE `franquicias` (
  `franquicia_id` int(10) UNSIGNED NOT NULL,
  `producto_id` int(10) UNSIGNED NOT NULL,
  `nombreFranquicia` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `franquicias`
--

INSERT INTO `franquicias` (`franquicia_id`, `producto_id`, `nombreFranquicia`) VALUES
(49, 1, 'Dragon Ball Z'),
(50, 2, 'One piece'),
(51, 3, 'Naruto'),
(52, 4, 'Attack on Titan'),
(53, 5, 'Pokémon'),
(54, 6, 'Attack on Titan'),
(55, 7, 'My Hero Academia'),
(56, 8, 'Backugan'),
(57, 9, 'Demon slayer'),
(58, 10, 'Full Metal Alchemist'),
(59, 11, 'Demon Slayer'),
(60, 12, 'Pokémon');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `producto_id` int(10) UNSIGNED NOT NULL,
  `usuarios_fk` int(10) UNSIGNED NOT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `titulo` varchar(50) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(7,2) DEFAULT NULL,
  `imagen` text DEFAULT NULL,
  `imagen_descripcion` varchar(50) DEFAULT NULL,
  `caracteristicas` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`producto_id`, `usuarios_fk`, `fecha_ingreso`, `titulo`, `descripcion`, `precio`, `imagen`, `imagen_descripcion`, `caracteristicas`) VALUES
(1, 1, '2025-05-15', 'Muñeco de Goku Super Saiyan', 'Figura coleccionable de Goku en su forma Super Saiyan, con detalles de alta calidad.', 3999.99, 'gokuSSY.jpg', 'Figura de Goku Super Saiyan', 'Esta figura coleccionable de Goku en su forma Super Saiyan tiene una altura de 18 cm y está fabricada en PVC de alta resistencia. Posee articulaciones móviles en brazos, piernas y torso, y un acabado detallado en el cabello y vestimenta. Incluye una base para exhibición y ha sido pintada a mano.'),
(2, 1, '2025-05-15', 'Remera de Luffy - One Piece', 'Camiseta de algodón con diseño de Luffy, el protagonista de One Piece.', 9999.99, 'camisetaLuffy.jpg', 'Camiseta de Luffy', 'Confeccionada en 100% algodón, esta camiseta presenta una estampa frontal con diseño Wanted de Monkey D. Luffy. Tiene cuello redondo reforzado, costuras dobles para mayor durabilidad y un tacto suave y liviano. Está disponible en talles S a XXL.'),
(3, 1, '2025-05-15', 'Taza de Naruto Uzumaki', 'Taza de cerámica con diseño de Naruto Uzumaki', 4500.00, 'tazaNaruto.webp', 'Taza de Naruto Uzumaki', 'Cuenta con una capacidad de 350 ml y está fabricada en cerámica de alta calidad. Es apta para microondas y lavavajillas, y posee una estampa envolvente con el diseño del Equipo 7 (Naruto, Sasuke, Sakura y Kakashi). Tiene un acabado brillante y colores resistentes al desgaste.'),
(4, 1, '2025-05-15', 'Póster de Attack on Titan', 'Póster de alta calidad con diseño del Escuadrón de Reconocimiento.', 1399.00, 'posterAttackOnTitan.webp', 'Póster de Attack on Titan', 'Este póster de alta calidad presenta una estampa envolvente con diseño del Equipo 7 (Naruto, Sasuke, Sakura y Kakashi), tiene un acabado brillante, está hecho en cerámica de alta calidad y es apto para microondas y lavavajillas.'),
(5, 2, '2025-05-15', 'Llavero de Pikachu', 'Llavero metálico con diseño de Pikachu, ideal para fans de Pokémon.', 3500.00, 'llaveroPikachu.webp', 'Llavero de Pikachu', 'Fabricado en silicona y metal, incluye una figura 3D de Pikachu junto con una correa con el logo de Pokémon. Su anillo metálico es resistente y tiene un tamaño aproximado de 8 cm. Es suave al tacto e ideal para mochilas, llaves o bolsos.'),
(6, 2, '2025-05-15', 'Coleccionable de Levi Ackerman', 'Figura articulada de Levi Ackerman con accesorios intercambiables.', 12000.00, 'leviAckerman.webp', 'Figura de Levi Ackerman', 'Tiene una altura de 10 cm y está fabricado en vinilo premium. Su estilo es chibi y representa a Levi en su versión de limpieza (Cleaning Levi). Incluye una caja ilustrada para colección, detalles pintados a mano y pertenece a la edición de coleccionista YouTooz.'),
(7, 2, '2025-05-15', 'Buzo de My Hero Academia', 'Sudadera con capucha con diseño de la UA Academy.', 15999.00, 'buzoMyHeroAcademy.jpg', 'Sudadera de My Hero Academia', 'Está confeccionado en una mezcla de algodón y poliéster, con una estampa frontal que muestra personajes de la UA Academy (Deku, Todoroki, Bakugo). Tiene interior frizado, capucha con cordones ajustables, puños y cintura elastizados, y está disponible en talles S a XXL.'),
(8, 1, '2025-05-15', 'Juguete de backugan', 'Juguete de backugan con diseño de los personajes de la serie.', 5700.00, 'backugan_juguete.jpg', 'Juguete de backugan', 'Modelo Ultimate Viloch, este juguete incluye 2 bakuganes y 8 cartas exclusivas. Las figuras son transformables de acción, ideales tanto para batallas como para colección. Está fabricado en plástico resistente y es apto para mayores de 6 años.'),
(9, 1, '2025-05-15', 'Set de pines de Demon Slayer', 'Set de pines metálicos con diseños de los personajes principales de Demon Slayer.', 900.00, 'pines_demonSlayer.webp', 'Set de pines de Demon Slayer', 'Incluye 5 pines metálicos con diseño chibi de los personajes Nezuko, Tanjiro, Inosuke, Zenitsu y Rengoku. Cada pin mide aproximadamente 3 cm y tiene acabado brillante con cierre de mariposa. Es una edición limitada ideal para mochilas o ropa.'),
(10, 2, '2025-05-15', 'Reloj de bolsillo Fullmetal Alchemist', 'Réplica del reloj de bolsillo de Edward Elric.', 14500.00, 'reloj_fullmental.jpg', 'Reloj de bolsillo Fullmetal Alchemist', 'Esta réplica oficial del reloj de Edward Elric está fabricada en aleación metálica con un color plateado envejecido. Tiene grabado el símbolo de los alquimistas estatales, apertura con botón de resorte, incluye una cadena desmontable y es parte de una edición de coleccionista.'),
(11, 1, '2025-05-15', 'Almohada de Nezuko Kamado', 'Almohada decorativa con diseño de Nezuko Kamado.', 6000.00, 'almohada_nezukoKamado.jpg', 'Almohada de Nezuko Kamado', 'Tiene un tamaño de 40 x 40 cm e incluye funda con cierre y relleno. La estampa muestra a Nezuko con fondo de flores de sakura. Está confeccionada en poliéster suave, es apta para lavarropas y resulta ideal para decorar tu cama o sillón.'),
(12, 2, '2025-05-15', 'Gorra de Ash Ketchum', 'Gorra oficial con diseño de Ash Ketchum de Pokémon.', 10500.00, 'gorra_ash.jpg', 'Gorra de Ash Ketchum', 'Fabricada en poliéster y red tipo trucker, esta gorra tiene talle único con cierre ajustable. Su diseño es liviano y cómodo, con estilo clásico y logo blanco. Es ideal tanto para cosplay como para uso diario, e inspirada en la gorra original de Ash.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_tienen_categorias`
--

CREATE TABLE `productos_tienen_categorias` (
  `producto_fk` int(10) UNSIGNED NOT NULL,
  `categoria_fk` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos_tienen_categorias`
--

INSERT INTO `productos_tienen_categorias` (`producto_fk`, `categoria_fk`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(5, 7),
(6, 1),
(7, 2),
(8, 6),
(9, 7),
(10, 8),
(11, 9),
(12, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `rol_id` tinyint(3) UNSIGNED NOT NULL,
  `nombre` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`rol_id`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario_id` int(10) UNSIGNED NOT NULL,
  `rol_fk` tinyint(3) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  `apellido` varchar(60) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario_id`, `rol_fk`, `email`, `contraseña`, `nombre`, `apellido`, `avatar`) VALUES
(1, 1, 'lucianoneiman@gmail.com', '1234', 'Luciano', 'Neiman', NULL),
(2, 1, 'ricardogarcia@gmail.com', '1234', 'Ricardo', 'Garcia', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`categoria_id`);

--
-- Indices de la tabla `franquicias`
--
ALTER TABLE `franquicias`
  ADD PRIMARY KEY (`franquicia_id`),
  ADD KEY `fk_franquicia_producto_idx` (`producto_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`producto_id`),
  ADD KEY `fk_producto_usuarios1_idx` (`usuarios_fk`);

--
-- Indices de la tabla `productos_tienen_categorias`
--
ALTER TABLE `productos_tienen_categorias`
  ADD PRIMARY KEY (`producto_fk`,`categoria_fk`),
  ADD KEY `fk_producto_has_categoria_categoria1_idx` (`categoria_fk`),
  ADD KEY `fk_producto_has_categoria_producto1_idx` (`producto_fk`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario_id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD KEY `usuarios_roles_fk_idx` (`rol_fk`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `categoria_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `franquicias`
--
ALTER TABLE `franquicias`
  MODIFY `franquicia_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `producto_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `rol_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuario_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `franquicias`
--
ALTER TABLE `franquicias`
  ADD CONSTRAINT `fk_franquicia_producto` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`producto_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_producto_usuarios` FOREIGN KEY (`usuarios_fk`) REFERENCES `usuarios` (`usuario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productos_tienen_categorias`
--
ALTER TABLE `productos_tienen_categorias`
  ADD CONSTRAINT `fk_producto_has_categoria_categoria` FOREIGN KEY (`categoria_fk`) REFERENCES `categorias` (`categoria_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_producto_has_categoria_producto` FOREIGN KEY (`producto_fk`) REFERENCES `productos` (`producto_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_tiene_roles_fk` FOREIGN KEY (`rol_fk`) REFERENCES `roles` (`rol_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
