/*comentario multilinea

*/


-- creacion de la base de datos
CREATE
DATABASE `dw3_garcia_neiman` COLLATE utf8mb4_general_ci;
-- muestra todos los esquemas

-- usar la base de datos
USE
dw3_garcia_neiman;

--  cargar datos a la tabla roles
INSERT INTO roles
VALUES (NULL, 'Administrador');

INSERT INTO roles
VALUES (NULL, 'Cliente');

SELECT *
FROM roles;


-- cargar datos de la tabla usuarios

INSERT INTO usuarios (rol_fk, email, password, nombre, apellido)
VALUES (1, 'lucianoneiman@gmail.com', '1234', 'Luciano', 'Neiman');

INSERT INTO usuarios (rol_fk, email, password, nombre, apellido)
VALUES (1, 'ricardogarcia@gmail.com', '1234', 'Ricardo', 'Garcia');

SELECT *
FROM usuarios;

-- FRANQUICIAS
INSERT INTO franquicias(nombre_franquicia)
VALUES ('Dragon Ball Z'),
       ('One piece'),
       ('Naruto'),
       ('Attack on Titan'),
       ('Pokémon'),
       ('My Hero Academia'),
       ('Backugan'),
       ('Demon slayer'),
       ('Full Metal Alchemist');

SELECT *
FROM franquicias;

-- CATEGORIAS
INSERT INTO categorias(nombre_categoria)
VALUES ('Figura de acción'),
       ('Ropa'),
       ('Taza'),
       ('Poster'),
       ('Llavero'),
       ('Juguete'),
       ('Accesorios'),
       ('Reloj'),
       ('Decoración');

SELECT *
FROM categorias;

-- productos
INSERT INTO productos (usuarios_fk, franquicia_fk, fecha_ingreso, titulo, descripcion, precio,
                       imagen, imagen_descripcion, caracteristicas)
VALUES (1, 1, '2025-05-15', 'Muñeco de Goku Super Saiyan',
        'Figura coleccionable de Goku en su forma Super Saiyan, con detalles de alta calidad.', 3999.99, 'gokuSSY.jpg',
        'Figura de Goku Super Saiyan',
        'Esta figura coleccionable de Goku en su forma Super Saiyan tiene una altura de 18 cm y está fabricada en PVC de alta resistencia. Posee articulaciones móviles en brazos, piernas y torso, y un acabado detallado en el cabello y vestimenta. Incluye una base para exhibición y ha sido pintada a mano.'),

       (1, 8, '2025-05-15', 'Set de pines de Demon Slayer',
        'Set de pines metálicos con diseños de los personajes principales de Demon Slayer.', 900,
        'pines_demonSlayer.webp', 'Set de pines de Demon Slayer',
        'Incluye 5 pines metálicos con diseño chibi de los personajes Nezuko, Tanjiro, Inosuke, Zenitsu y Rengoku. Cada pin mide aproximadamente 3 cm y tiene acabado brillante con cierre de mariposa. Es una edición limitada ideal para mochilas o ropa.'),


       (1, 3, '2025-05-15', 'Taza de Naruto Uzumaki', 'Taza de cerámica con diseño de Naruto Uzumaki', 4500,
        'tazaNaruto.webp', 'Taza de Naruto Uzumaki',
        'Cuenta con una capacidad de 350 ml y está fabricada en cerámica de alta calidad. Es apta para microondas y lavavajillas, y posee una estampa envolvente con el diseño del Equipo 7 (Naruto, Sasuke, Sakura y Kakashi). Tiene un acabado brillante y colores resistentes al desgaste.'),

       (1, 2, '2025-05-15', 'Remera de Luffy - One Piece',
        'Camiseta de algodón con diseño de Luffy, el protagonista de One Piece.', 9999.99, 'camisetaLuffy.jpg',
        'Camiseta de Luffy',
        'Confeccionada en 100% algodón, esta camiseta presenta una estampa frontal con diseño Wanted de Monkey D. Luffy. Tiene cuello redondo reforzado, costuras dobles para mayor durabilidad y un tacto suave y liviano. Está disponible en talles S a XXL.'),


       (2, 5, '2025-05-15', 'Llavero de Pikachu', 'Llavero metálico con diseño de Pikachu, ideal para fans de Pokémon.',
        3500, 'llaveroPikachu.webp', 'Llavero de Pikachu',
        'Fabricado en silicona y metal, incluye una figura 3D de Pikachu junto con una correa con el logo de Pokémon. Su anillo metálico es resistente y tiene un tamaño aproximado de 8 cm. Es suave al tacto e ideal para mochilas, llaves o bolsos.'),

       (2, 4, '2025-05-15', 'Coleccionable de Levi Ackerman',
        'Figura articulada de Levi Ackerman con accesorios intercambiables.', 12000, 'leviAckerman.webp',
        'Figura de Levi Ackerman',
        'Tiene una altura de 10 cm y está fabricado en vinilo premium. Su estilo es chibi y representa a Levi en su versión de limpieza (Cleaning Levi). Incluye una caja ilustrada para colección, detalles pintados a mano y pertenece a la edición de coleccionista YouTooz.'),

       (2, 6, '2025-05-15', 'Buzo de My Hero Academia', 'Sudadera con capucha con diseño de la UA Academy.', 15999,
        'buzoMyHeroAcademy.jpg', 'Sudadera de My Hero Academia',
        'Está confeccionado en una mezcla de algodón y poliéster, con una estampa frontal que muestra personajes de la UA Academy (Deku, Todoroki, Bakugo). Tiene interior frizado, capucha con cordones ajustables, puños y cintura elastizados, y está disponible en talles S a XXL.'),

       (1, 4, '2025-05-15', 'Póster de Attack on Titan',
        'Póster de alta calidad con diseño del Escuadrón de Reconocimiento.', 1399, 'posterAttackOnTitan.webp',
        'Póster de Attack on Titan',
        'Este póster de alta calidad presenta una estampa envolvente con diseño del Equipo 7 (Naruto, Sasuke, Sakura y Kakashi), tiene un acabado brillante, está hecho en cerámica de alta calidad y es apto para microondas y lavavajillas.'),

       (1, 7, '2025-05-15', 'Juguete de backugan', 'Juguete de backugan con diseño de los personajes de la serie.',
        5700,
        'backugan_juguete.jpg', 'Juguete de backugan',
        'Modelo Ultimate Viloch, este juguete incluye 2 bakuganes y 8 cartas exclusivas. Las figuras son transformables de acción, ideales tanto para batallas como para colección. Está fabricado en plástico resistente y es apto para mayores de 6 años.'),


       (2, 9, '2025-05-15', 'Reloj de bolsillo Fullmetal Alchemist', 'Réplica del reloj de bolsillo de Edward Elric.',
        14500, 'reloj_fullmental.jpg', 'Reloj de bolsillo Fullmetal Alchemist',
        'Esta réplica oficial del reloj de Edward Elric está fabricada en aleación metálica con un color plateado envejecido. Tiene grabado el símbolo de los alquimistas estatales, apertura con botón de resorte, incluye una cadena desmontable y es parte de una edición de coleccionista.'),

       (1, 8, '2025-05-15', 'Almohada de Nezuko Kamado', 'Almohada decorativa con diseño de Nezuko Kamado.', 6000,
        'almohada_nezukoKamado.jpg', 'Almohada de Nezuko Kamado',
        'Tiene un tamaño de 40 x 40 cm e incluye funda con cierre y relleno. La estampa muestra a Nezuko con fondo de flores de sakura. Está confeccionada en poliéster suave, es apta para lavarropas y resulta ideal para decorar tu cama o sillón.'),

       (2, 5, '2025-05-15', 'Gorra de Ash Ketchum', 'Gorra oficial con diseño de Ash Ketchum de Pokémon.', 10500,
        'gorra_ash.jpg', 'Gorra de Ash Ketchum',
        'Fabricada en poliéster y red tipo trucker, esta gorra tiene talle único con cierre ajustable. Su diseño es liviano y cómodo, con estilo clásico y logo blanco. Es ideal tanto para cosplay como para uso diario, e inspirada en la gorra original de Ash.');

SELECT *
FROM productos;

-- PRODUCTOS-CATEGORIAS
INSERT INTO productos_tienen_categorias(producto_fk, categoria_fk)
VALUES (1, 1),
       (2, 7),
       (3, 3),
       (4, 2),      
       (5, 7),
       (6, 1),
       (7, 2),
       (8, 9),
       (9, 6),
       (10, 8),
       (11, 9),
       (12, 2);
      


SELECT *
FROM productos_tienen_categorias;

SELECT 
  p.producto_id,
  p.titulo,
  p.descripcion,
  p.precio,
  p.imagen,
  p.imagen_descripcion,
  p.caracteristicas,
  f.nombre_franquicia
FROM productos p
INNER JOIN franquicias f ON p.franquicia_fk = f.franquicia_id
WHERE p.producto_id = 1;



SELECT p.producto_id,
  p.titulo,
  p.precio,
  p.imagen,
  p.imagen_descripcion
FROM productos p
INNER JOIN productos_tienen_categorias pc ON p.producto_id = pc.producto_fk
INNER JOIN categorias c ON pc.categoria_fk = c.categoria_id
WHERE c.nombre_categoria = 'Ropa';

SELECT 
                          p.producto_id,
                          p.titulo,
                          p.descripcion,
                          p.precio,
                          p.imagen,
                          p.imagen_descripcion,
                          p.caracteristicas,
                          f.nombre_franquicia,
                          GROUP_CONCAT(c.nombre_categoria SEPARATOR ', ') AS categorias
                        FROM productos p
                        JOIN franquicias f ON p.franquicia_fk = f.franquicia_id
                        JOIN productos_tienen_categorias ptc ON p.producto_id = ptc.producto_fk
                        JOIN categorias c ON ptc.categoria_fk = c.categoria_id
                        WHERE p.producto_id = 1
                        GROUP BY p.producto_id;                        
                        
                        SELECT 
                          p.producto_id,
                          p.titulo,
                          p.precio,
                          p.imagen,
                          p.imagen_descripcion
                        FROM productos p
                        INNER JOIN productos_tienen_categorias pc ON p.producto_id = pc.producto_fk
                        INNER JOIN categorias c ON pc.categoria_fk = c.categoria_id
                        WHERE c.nombre_categoria IN (1)
                        GROUP BY p.producto_id
                        LIMIT 10;
                        
                        SELECT p.producto_id,
                          p.titulo,
                          p.descripcion,
                          p.precio,
                          p.imagen,
                          p.imagen_descripcion,
                          p.caracteristicas,
                          f.nombre_franquicia AS franquicia,
                          GROUP_CONCAT(c.nombre_categoria SEPARATOR ', ') AS categorias
        FROM productos p
        JOIN franquicias f ON p.franquicia_fk = f.franquicia_id
        JOIN productos_tienen_categorias ptc ON p.producto_id = ptc.producto_fk
        JOIN categorias c ON ptc.categoria_fk = c.categoria_id
        GROUP BY p.producto_id;






