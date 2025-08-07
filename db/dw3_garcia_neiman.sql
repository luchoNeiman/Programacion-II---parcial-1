-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-08-2025 a las 21:08:45
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
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `usuario_fk` int(10) UNSIGNED NOT NULL,
  `producto_fk` int(10) UNSIGNED NOT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`usuario_fk`, `producto_fk`, `cantidad`) VALUES
(4, 47, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `categoria_id` int(10) UNSIGNED NOT NULL,
  `nombre_categoria` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`categoria_id`, `nombre_categoria`) VALUES
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
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `compra_id` int(10) UNSIGNED NOT NULL,
  `usuario_fk` int(10) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `total_compra` decimal(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`compra_id`, `usuario_fk`, `fecha`, `total_compra`) VALUES
(10, 2, '2025-08-06', 670696.77),
(11, 2, '2025-08-06', 11997.00),
(12, 2, '2025-08-06', 57999.98),
(13, 2, '2025-08-06', 28999.99),
(14, 2, '2025-08-06', 19995.00),
(15, 2, '2025-08-06', 28999.99),
(16, 2, '2025-08-07', 144999.95);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras_tienen_productos`
--

CREATE TABLE `compras_tienen_productos` (
  `producto_fk` int(10) UNSIGNED NOT NULL,
  `compra_fk` int(10) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(9,2) NOT NULL,
  `total` decimal(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `compras_tienen_productos`
--

INSERT INTO `compras_tienen_productos` (`producto_fk`, `compra_fk`, `cantidad`, `precio_unitario`, `total`) VALUES
(1, 10, 2, 3999.00, 7998.00),
(1, 11, 3, 3999.00, 11997.00),
(1, 14, 5, 3999.00, 19995.00),
(2, 10, 3, 900.00, 2700.00),
(41, 10, 1, 24999.00, 24999.00),
(42, 10, 1, 24999.99, 24999.99),
(43, 10, 7, 25999.99, 181999.93),
(45, 10, 7, 27999.99, 195999.93),
(47, 10, 8, 28999.99, 231999.92),
(47, 12, 2, 28999.99, 57999.98),
(47, 13, 1, 28999.99, 28999.99),
(47, 15, 1, 28999.99, 28999.99),
(47, 16, 5, 28999.99, 144999.95);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `franquicias`
--

CREATE TABLE `franquicias` (
  `franquicia_id` int(10) UNSIGNED NOT NULL,
  `nombre_franquicia` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `franquicias`
--

INSERT INTO `franquicias` (`franquicia_id`, `nombre_franquicia`) VALUES
(1, 'Dragon Ball Z'),
(2, 'One piece'),
(3, 'Naruto'),
(4, 'Attack on Titan'),
(5, 'Pokémon'),
(6, 'My Hero Academia'),
(7, 'Backugan'),
(8, 'Demon slayer'),
(9, 'Full Metal Alchemist'),
(18, 'Dragon Ball'),
(19, 'Death Note');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `producto_id` int(10) UNSIGNED NOT NULL,
  `franquicia_fk` int(10) UNSIGNED NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(9,2) NOT NULL,
  `imagen` text DEFAULT NULL,
  `imagen_descripcion` varchar(50) DEFAULT NULL,
  `caracteristicas` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`producto_id`, `franquicia_fk`, `fecha_ingreso`, `titulo`, `descripcion`, `precio`, `imagen`, `imagen_descripcion`, `caracteristicas`) VALUES
(1, 1, '2025-07-15', 'Muñeco de Goku SSJ', 'Figura coleccionable de Goku en su forma Super Saiyan, con detalles de alta calidad.', 3999.00, 'gokuSSY.jpg', 'Figura de Goku Super Saiyan', 'Esta figura coleccionable de Goku en su forma Super Saiyan tiene una altura de 18 cm y está fabricada en PVC de alta resistencia. Posee articulaciones móviles en brazos, piernas y torso, y un acabado detallado en el cabello y vestimenta. Incluye una base para exhibición y ha sido pintada a mano.'),
(2, 8, '2025-06-15', 'Pines de Demon Slayer', 'Set de pines metálicos con diseños de los personajes principales.', 900.00, 'pines_demonSlayer.webp', 'Set de pines de Demon Slayer', 'Incluye 5 pines metálicos con diseño chibi de los personajes Nezuko, Tanjiro, Inosuke, Zenitsu y Rengoku. Cada pin mide aproximadamente 3 cm y tiene acabado brillante con cierre de mariposa. Es una edición limitada ideal para mochilas o ropa.'),
(3, 3, '2025-06-15', 'Taza de Naruto Uzumaki', 'Taza de cerámica con diseño de Naruto Uzumaki', 4500.00, 'tazaNaruto.webp', 'Taza de Naruto Uzumaki', 'Cuenta con una capacidad de 350 ml y está fabricada en cerámica de alta calidad. Es apta para microondas y lavavajillas, y posee una estampa envolvente con el diseño del Equipo 7 (Naruto, Sasuke, Sakura y Kakashi). Tiene un acabado brillante y colores resistentes al desgaste.'),
(4, 2, '2025-06-15', 'Remera de Luffy - One Piece', 'Camiseta de algodón con diseño de Luffy, el protagonista de One Piece.', 9999.99, 'camisetaLuffy.jpg', 'Camiseta de Luffy', 'Confeccionada en 100% algodón, esta camiseta presenta una estampa frontal con diseño Wanted de Monkey D. Luffy. Tiene cuello redondo reforzado, costuras dobles para mayor durabilidad y un tacto suave y liviano. Está disponible en talles S a XXL.'),
(5, 5, '2025-05-15', 'Llavero de Pikachu', 'Llavero metálico con diseño de Pikachu, ideal para fans de Pokémon.', 3500.00, 'llaveroPikachu.webp', 'Llavero de Pikachu', 'Fabricado en silicona y metal, incluye una figura 3D de Pikachu junto con una correa con el logo de Pokémon. Su anillo metálico es resistente y tiene un tamaño aproximado de 8 cm. Es suave al tacto e ideal para mochilas, llaves o bolsos.'),
(6, 4, '2025-05-15', 'Figura de Levi Ackerman', 'Figura articulada de Levi Ackerman con accesorios intercambiables.', 12000.00, 'leviAckerman.webp', 'Figura de Levi Ackerman', 'Tiene una altura de 10 cm y está fabricado en vinilo premium. Su estilo es chibi y representa a Levi en su versión de limpieza (Cleaning Levi). Incluye una caja ilustrada para colección, detalles pintados a mano y pertenece a la edición de coleccionista YouTooz.'),
(7, 6, '2025-06-15', 'Buzo de My Hero Academia', 'Sudadera con capucha con diseño de la UA Academy.', 15999.00, 'buzoMyHeroAcademy.jpg', 'Sudadera de My Hero Academia', 'Está confeccionado en una mezcla de algodón y poliéster, con una estampa frontal que muestra personajes de la UA Academy (Deku, Todoroki, Bakugo). Tiene interior frizado, capucha con cordones ajustables, puños y cintura elastizados, y está disponible en talles S a XXL.'),
(8, 4, '2025-05-15', 'Póster de Attack on Titan', 'Póster de alta calidad con diseño del Escuadrón de Reconocimiento.', 1399.00, 'posterAttackOnTitan.webp', 'Póster de Attack on Titan', 'Este póster de Attack on Titan muestra a Eren, Mikasa y Armin en una escena cargada de acción y dramatismo, ideal para fanáticos del anime. Está impreso en papel ilustración de alta calidad, con un acabado brillante que resalta los colores y detalles. Su diseño vibrante lo convierte en una excelente opción para decorar tu habitación, estudio o cualquier rincón otaku con estilo.'),
(9, 7, '2025-05-15', 'Juguete de backugan', 'Juguete de backugan con diseño de los personajes de la serie.', 5700.00, 'backugan_juguete.jpg', 'Juguete de backugan', 'Modelo Ultimate Viloch, este juguete incluye 2 bakuganes y 8 cartas exclusivas. Las figuras son transformables de acción, ideales tanto para batallas como para colección. Está fabricado en plástico resistente y es apto para mayores de 6 años.'),
(10, 9, '2025-05-15', 'Reloj Fullmetal Alchemist', 'Réplica del reloj de bolsillo de Edward Elric.', 14500.00, 'reloj_fullmental.jpg', 'Reloj de bolsillo Fullmetal Alchemist', 'Esta réplica oficial del reloj de Edward Elric está fabricada en aleación metálica con un color plateado envejecido. Tiene grabado el símbolo de los alquimistas estatales, apertura con botón de resorte, incluye una cadena desmontable y es parte de una edición de coleccionista.'),
(11, 8, '2025-05-15', 'Almohada de Nezuko Kamado', 'Almohada decorativa con diseño de Nezuko Kamado.', 6000.00, 'almohada_nezukoKamado.jpg', 'Almohada de Nezuko Kamado', 'Tiene un tamaño de 40 x 40 cm e incluye funda con cierre y relleno. La estampa muestra a Nezuko con fondo de flores de sakura. Está confeccionada en poliéster suave, es apta para lavarropas y resulta ideal para decorar tu cama o sillón.'),
(12, 5, '2025-05-15', 'Gorra de Ash Ketchum', 'Gorra oficial con diseño de Ash Ketchum de Pokémon.', 10500.00, 'gorra_ash.jpg', 'Gorra de Ash Ketchum', 'Fabricada en poliéster y red tipo trucker, esta gorra tiene talle único con cierre ajustable. Su diseño es liviano y cómodo, con estilo clásico y logo blanco. Es ideal tanto para cosplay como para uso diario, e inspirada en la gorra original de Ash.'),
(41, 4, '2025-07-27', 'Figura Eren Jaeger', 'Figura coleccionable de Eren Jaeger, protagonista de Attack on Titan', 24999.00, '20250627143705_eren.png', 'Figura de eren jeager', 'Esta figura coleccionable de Eren Jaeger muestra una pose de batalla inspirada en Attack on Titan y mide aproximadamente 25 cm de altura. Está fabricada en PVC de alta calidad y cuenta con un acabado detallado en el uniforme y el equipo de maniobras. Incluye una base con rocas para exhibición y las espadas son desmontables. La figura ha sido pintada a mano para resaltar cada detalle.'),
(42, 6, '2025-07-27', 'Izuku Midoriya Figura', 'Protagonista de My Hero Academia, en una pose lista para el combate.', 24999.99, '20250627150608_deku.png', 'Figura coleccionable de Izuku Midoriya', 'Esta figura coleccionable de Izuku Midoriya muestra su clásico uniforme de héroe verde y mide aproximadamente 24 cm de altura. Está fabricada en PVC de alta calidad y cuenta con un acabado detallado en su traje y expresiones faciales. Incluye una base con rocas para exhibición y ha sido pintada a mano para resaltar los detalles de su diseño.'),
(43, 18, '2025-06-27', 'Goku Niño Nube Figura', 'Figura coleccionable de Goku en su versión niño', 25999.99, '20250627150950_goku-kid-nube.png', 'Figura Goku Niño Nube', 'Esta figura coleccionable de Goku niño lo muestra sobre la Nube Voladora y mide aproximadamente 20 cm de altura. Está fabricada en PVC de alta calidad y cuenta con un acabado detallado en el traje, el báculo sagrado y su expresión alegre. Incluye una base para exhibición y ha sido pintada a mano para lograr un aspecto vibrante y lleno de color.'),
(44, 2, '2025-06-27', 'Chopper Figura One Piece', 'Figura coleccionable de Tony Tony Chopper, el adorable médico de los Sombrero de Paja', 19999.99, '20250627151207_chopper.png', 'Chopper Figura One Piece  Precio:', 'Esta figura coleccionable de Chopper lo muestra con su característico sombrero rosa y mide aproximadamente 15 cm de altura. Está fabricada en PVC de alta calidad y presenta un acabado detallado en sus cuernos, ropa y expresión simpática. Incluye una base para exhibición y ha sido pintada a mano para capturar la esencia del personaje.'),
(45, 3, '2025-06-27', 'Naruto Rasengan Figura', 'Naruto Uzumaki en su clásica pose con el Rasengan listo para atacar.', 27999.99, '20250627151601_naruto-rasengan.png', 'Figura de Naruto con el Rasengan', 'Esta figura coleccionable de Naruto Uzumaki lo muestra con su traje naranja característico y sosteniendo un Rasengan en la mano. Mide aproximadamente 26 cm de altura y está fabricada en PVC de alta calidad. Incluye una base con diseño de roca para exhibición y presenta un acabado detallado en su ropa, cabello y expresión decidida. Ha sido pintada a mano para resaltar cada detalle épico.'),
(46, 19, '2025-06-27', 'Ryuk Figura Death Note', 'Figura coleccionable de Ryuk, el shinigami de Death Note', 26999.99, '20250627151729_ryuk.png', 'Figura Ryuk sosteniendo una manzana', 'Esta figura coleccionable de Ryuk lo muestra sosteniendo una manzana y mide aproximadamente 28 cm de altura. Fabricada en PVC de alta calidad, presenta un acabado detallado en su rostro, alas y atuendo oscuro. Incluye una base para exhibición y ha sido pintada a mano para capturar su aura inquietante.'),
(47, 8, '2025-07-27', 'Tanjiro Danza Fuego', 'Figura coleccionable de Tanjiro Kamado', 28999.99, '20250627151940_tanjiro-danza.png', 'Tanjiro en plena Danza del Dios del Fuego', 'Esta figura coleccionable de Tanjiro lo muestra en plena Danza del Dios del Fuego, rodeado de llamas, y mide aproximadamente 24 cm de altura. Está fabricada en PVC de alta calidad con detalles precisos en su kimono y katana. Incluye base con efecto rocas y ha sido pintada a mano para resaltar la intensidad del ataque.'),
(48, 1, '2025-06-27', 'Vegeta Figura DBZ', 'Figura coleccionable de Vegeta en su clásica armadura Saiyajin', 26999.99, '20250627152233_vegeta.png', 'Figura de vegeta', 'Esta figura coleccionable de Vegeta lo muestra con su traje Saiyajin y mide aproximadamente 24 cm de altura. Está fabricada en PVC de alta calidad y cuenta con un acabado detallado en el cabello, armadura y expresión desafiante. Incluye base con diseño rocoso para exhibición y ha sido pintada a mano para destacar cada músculo y detalle épico.');

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
(1, 6),
(2, 7),
(3, 3),
(4, 2),
(5, 7),
(6, 1),
(6, 6),
(7, 2),
(8, 9),
(9, 6),
(10, 8),
(11, 9),
(12, 2),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `rol_id` tinyint(3) UNSIGNED NOT NULL,
  `nombre_rol` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`rol_id`, `nombre_rol`) VALUES
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
  `password` varchar(255) NOT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  `apellido` varchar(60) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario_id`, `rol_fk`, `email`, `password`, `nombre`, `apellido`, `avatar`) VALUES
(1, 1, 'lucianoneiman@gmail.com', '$2y$10$Njo1/KMCWjWLqaXwhSLJteRiDunyKNw1zyxBm7v6EHLfmdy1K5X.y', 'Luciano', 'Neiman', 'luciano.webp'),
(2, 1, 'ricardogarcia@gmail.com', '$2y$10$Njo1/KMCWjWLqaXwhSLJteRiDunyKNw1zyxBm7v6EHLfmdy1K5X.y', 'Ricardo', 'Garcia', 'ricardo.webp'),
(4, 2, 'ricardogarci4@gmail.com', '$2y$10$KRh1tkNj6eiw67IV/xmgKOfxUz4bubieKU8CFow.cd0VV4xpheGJ6', 'Ricardo', 'Garcia', 'avatar_4_1754522433.png'),
(7, 2, 'ricardogarcia2@gmail.com', '$2y$10$hNOrDT75cZ.tW4VIwh7aROezet5KD.qw/QAq/jUVmPpnCC41ahkuS', 'Ricardo', 'Rodolfo', 'avatar_7_1754522103.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`usuario_fk`,`producto_fk`),
  ADD KEY `fk_usuarios_has_productos_productos1_idx` (`producto_fk`),
  ADD KEY `fk_usuarios_has_productos_usuarios1_idx` (`usuario_fk`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`categoria_id`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`compra_id`,`usuario_fk`),
  ADD KEY `fk_compras_usuarios1_idx` (`usuario_fk`);

--
-- Indices de la tabla `compras_tienen_productos`
--
ALTER TABLE `compras_tienen_productos`
  ADD PRIMARY KEY (`producto_fk`,`compra_fk`),
  ADD KEY `fk_productos_has_compras_productos1_idx` (`producto_fk`),
  ADD KEY `fk_productos_has_compras_compras1_idx` (`compra_fk`);

--
-- Indices de la tabla `franquicias`
--
ALTER TABLE `franquicias`
  ADD PRIMARY KEY (`franquicia_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`producto_id`),
  ADD KEY `fk_productos_franquicias1_idx` (`franquicia_fk`);

--
-- Indices de la tabla `productos_tienen_categorias`
--
ALTER TABLE `productos_tienen_categorias`
  ADD PRIMARY KEY (`producto_fk`,`categoria_fk`),
  ADD KEY `fk_producto_has_categoria_categoria1_idx` (`categoria_fk`);

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
  MODIFY `categoria_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `compra_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `franquicias`
--
ALTER TABLE `franquicias`
  MODIFY `franquicia_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `producto_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `rol_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuario_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `fk_usuarios_has_productos_productos1` FOREIGN KEY (`producto_fk`) REFERENCES `productos` (`producto_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuarios_has_productos_usuarios1` FOREIGN KEY (`usuario_fk`) REFERENCES `usuarios` (`usuario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `fk_compras_usuarios1` FOREIGN KEY (`usuario_fk`) REFERENCES `usuarios` (`usuario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `compras_tienen_productos`
--
ALTER TABLE `compras_tienen_productos`
  ADD CONSTRAINT `fk_productos_has_compras_compras1` FOREIGN KEY (`compra_fk`) REFERENCES `compras` (`compra_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_productos_has_compras_productos1` FOREIGN KEY (`producto_fk`) REFERENCES `productos` (`producto_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_productos_franquicias1` FOREIGN KEY (`franquicia_fk`) REFERENCES `franquicias` (`franquicia_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
