/*comentario multilinea

*/


-- creacion de la base de datos
CREATE DATABASE `dw3_garcia_neiman` COLLATE utf8mb4_general_ci;
-- muestra todos los esquemas
SHOW DATABASES;

-- usar la base de datos
USE dw3_garcia_neiman;

--  cargar datos a la tabla roles
INSERT INTO roles
VALUES (NULL,'Administrador');

INSERT INTO roles
VALUES (NULL,'Cliente');

SELECT * FROM roles;

-- cargar datos de la tabla usuarios

INSERT INTO usuarios  (rol_fk, email, contraseña, nombre,  apellido)
VALUES (1, 'lucianoneiman@gmail.com', '1234', 'Luciano', 'Neiman');

INSERT INTO usuarios  (rol_fk, email, contraseña, nombre,  apellido)
VALUES (1, 'ricardogarcia@gmail.com', '1234', 'Ricardo', 'Garcia');

SELECT * FROM usuarios;

-- FRANQUICIAS
INSERT INTO franquicias(producto_id, nombre)
VALUES 
(1, 'Dragon Ball Z'),
(2, 'One piece'),
(3, 'Naruto'),
(4, 'Attack on Titan'),
(5, 'Pokémon'),
(6, 'Attack on Titan'),
(7, 'My Hero Academia'),
(8, 'Backugan'),
(9, 'Demon slayer'),
(10, 'Full Metal Alchemist'),
(11, 'Demon Slayer'),
(12, 'Pokémon');

SELECT * FROM franquicias;

-- CATEGORIAS
INSERT INTO categorias(nombre)
VALUE ('Figura de acción'),('Ropa'),('Taza'),('Poster'),('Llavero'),('Juguete'),('Accesorios'),('Reloj'),('Decoración');

SELECT * FROM categorias;

-- PRODUCTOS-CATEGORIAS
INSERT INTO productos_tienen_categorias(producto_fk, categoria_fk)
VALUE 
(1,1),
(2,2),
(3,3),
(4,4),
(5,5),
(6,1),
(7,2),
(8,6),
(9,7),
(10,8),
(11,9),
(12,2);

INSERT INTO productos_tienen_categorias(producto_fk, categoria_fk)
VALUE (5,7);

SELECT * FROM productos_tienen_categorias;

-- productos
INSERT INTO productos (usuarios_fk, fecha_ingreso, titulo, descripcion, precio,
  imagen, imagen_descripcion, caracteristicas) 
VALUES
(1, '2025-05-15', 'Muñeco de Goku Super Saiyan', 'Figura coleccionable de Goku en su forma Super Saiyan, con detalles de alta calidad.', 3999.99, 'gokuSSY.jpg', 'Figura de Goku Super Saiyan', 'Esta figura coleccionable de Goku en su forma Super Saiyan tiene una altura de 18 cm y está fabricada en PVC de alta resistencia. Posee articulaciones móviles en brazos, piernas y torso, y un acabado detallado en el cabello y vestimenta. Incluye una base para exhibición y ha sido pintada a mano.'),

(1, '2025-05-15', 'Remera de Luffy - One Piece', 'Camiseta de algodón con diseño de Luffy, el protagonista de One Piece.', 9999.99, 'camisetaLuffy.jpg', 'Camiseta de Luffy', 'Confeccionada en 100% algodón, esta camiseta presenta una estampa frontal con diseño Wanted de Monkey D. Luffy. Tiene cuello redondo reforzado, costuras dobles para mayor durabilidad y un tacto suave y liviano. Está disponible en talles S a XXL.'),

(1, '2025-05-15', 'Taza de Naruto Uzumaki', 'Taza de cerámica con diseño de Naruto Uzumaki', 4500, 'tazaNaruto.webp', 'Taza de Naruto Uzumaki', 'Cuenta con una capacidad de 350 ml y está fabricada en cerámica de alta calidad. Es apta para microondas y lavavajillas, y posee una estampa envolvente con el diseño del Equipo 7 (Naruto, Sasuke, Sakura y Kakashi). Tiene un acabado brillante y colores resistentes al desgaste.'),

(1, '2025-05-15', 'Póster de Attack on Titan', 'Póster de alta calidad con diseño del Escuadrón de Reconocimiento.', 1399, 'posterAttackOnTitan.webp', 'Póster de Attack on Titan', 'Este póster de alta calidad presenta una estampa envolvente con diseño del Equipo 7 (Naruto, Sasuke, Sakura y Kakashi), tiene un acabado brillante, está hecho en cerámica de alta calidad y es apto para microondas y lavavajillas.'),

(2, '2025-05-15', 'Llavero de Pikachu', 'Llavero metálico con diseño de Pikachu, ideal para fans de Pokémon.', 3500, 'llaveroPikachu.webp', 'Llavero de Pikachu', 'Fabricado en silicona y metal, incluye una figura 3D de Pikachu junto con una correa con el logo de Pokémon. Su anillo metálico es resistente y tiene un tamaño aproximado de 8 cm. Es suave al tacto e ideal para mochilas, llaves o bolsos.'),

(2, '2025-05-15', 'Coleccionable de Levi Ackerman', 'Figura articulada de Levi Ackerman con accesorios intercambiables.', 12000, 'leviAckerman.webp', 'Figura de Levi Ackerman', 'Tiene una altura de 10 cm y está fabricado en vinilo premium. Su estilo es chibi y representa a Levi en su versión de limpieza (Cleaning Levi). Incluye una caja ilustrada para colección, detalles pintados a mano y pertenece a la edición de coleccionista YouTooz.'),

(2, '2025-05-15', 'Buzo de My Hero Academia', 'Sudadera con capucha con diseño de la UA Academy.', 15999, 'buzoMyHeroAcademy.jpg', 'Sudadera de My Hero Academia', 'Está confeccionado en una mezcla de algodón y poliéster, con una estampa frontal que muestra personajes de la UA Academy (Deku, Todoroki, Bakugo). Tiene interior frizado, capucha con cordones ajustables, puños y cintura elastizados, y está disponible en talles S a XXL.'),

(1, '2025-05-15', 'Juguete de backugan', 'Juguete de backugan con diseño de los personajes de la serie.', 5700, 'backugan_juguete.jpg', 'Juguete de backugan', 'Modelo Ultimate Viloch, este juguete incluye 2 bakuganes y 8 cartas exclusivas. Las figuras son transformables de acción, ideales tanto para batallas como para colección. Está fabricado en plástico resistente y es apto para mayores de 6 años.'),

(1, '2025-05-15', 'Set de pines de Demon Slayer', 'Set de pines metálicos con diseños de los personajes principales de Demon Slayer.', 900, 'pines_demonSlayer.webp', 'Set de pines de Demon Slayer', 'Incluye 5 pines metálicos con diseño chibi de los personajes Nezuko, Tanjiro, Inosuke, Zenitsu y Rengoku. Cada pin mide aproximadamente 3 cm y tiene acabado brillante con cierre de mariposa. Es una edición limitada ideal para mochilas o ropa.'),

(2, '2025-05-15', 'Reloj de bolsillo Fullmetal Alchemist', 'Réplica del reloj de bolsillo de Edward Elric.', 14500, 'reloj_fullmental.jpg', 'Reloj de bolsillo Fullmetal Alchemist', 'Esta réplica oficial del reloj de Edward Elric está fabricada en aleación metálica con un color plateado envejecido. Tiene grabado el símbolo de los alquimistas estatales, apertura con botón de resorte, incluye una cadena desmontable y es parte de una edición de coleccionista.'),

(1, '2025-05-15', 'Almohada de Nezuko Kamado', 'Almohada decorativa con diseño de Nezuko Kamado.', 6000, 'almohada_nezukoKamado.jpg', 'Almohada de Nezuko Kamado', 'Tiene un tamaño de 40 x 40 cm e incluye funda con cierre y relleno. La estampa muestra a Nezuko con fondo de flores de sakura. Está confeccionada en poliéster suave, es apta para lavarropas y resulta ideal para decorar tu cama o sillón.'),

(2, '2025-05-15', 'Gorra de Ash Ketchum', 'Gorra oficial con diseño de Ash Ketchum de Pokémon.', 10500, 'gorra_ash.jpg', 'Gorra de Ash Ketchum', 'Fabricada en poliéster y red tipo trucker, esta gorra tiene talle único con cierre ajustable. Su diseño es liviano y cómodo, con estilo clásico y logo blanco. Es ideal tanto para cosplay como para uso diario, e inspirada en la gorra original de Ash.');

SELECT * FROM productos;





