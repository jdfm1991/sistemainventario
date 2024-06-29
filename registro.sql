-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-06-2024 a las 01:11:45
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
-- Base de datos: `registro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `categoria`) VALUES
(1, 'Alimentos'),
(2, 'Bebidas'),
(3, 'Utensilios');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `consulta de producto`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `consulta de producto` (
`Descripcion` varchar(100)
,`categoria` varchar(50)
,`familia` varchar(50)
,`ubicacion` varchar(100)
,`unidad` varchar(20)
,`Cantidad` float
,`Costo_unidad` decimal(28,4)
,`valor_inventario` decimal(28,4)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatus`
--

CREATE TABLE `estatus` (
  `id` tinyint(1) NOT NULL,
  `estatus` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estatus`
--

INSERT INTO `estatus` (`id`, `estatus`) VALUES
(0, 'Bloqueado'),
(1, 'Desbloqueado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familia`
--

CREATE TABLE `familia` (
  `id` int(11) NOT NULL,
  `familia` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `familia`
--

INSERT INTO `familia` (`id`, `familia`) VALUES
(1, 'Granos'),
(2, 'Verduras'),
(3, 'Frutas'),
(4, 'Lacteos'),
(5, 'Proteina'),
(6, 'Alcoholicas'),
(7, 'Gaseosas'),
(8, 'Calientes'),
(9, 'De madera'),
(10, 'De metal'),
(11, 'De plasticos'),
(12, 'De vidrio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `impuesto`
--

CREATE TABLE `impuesto` (
  `id` int(11) NOT NULL,
  `impuesto` int(11) NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `impuesto`
--

INSERT INTO `impuesto` (`id`, `impuesto`, `estatus`) VALUES
(1, 8, 0),
(2, 12, 1),
(3, 14, 0),
(4, 16, 0),
(6, 22, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimiento_inventario`
--

CREATE TABLE `movimiento_inventario` (
  `id` int(11) NOT NULL,
  `codigo_producto` int(11) NOT NULL,
  `codigo_tmovi` int(11) NOT NULL,
  `fecha_movimiento` datetime NOT NULL,
  `comentario` varchar(150) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `cant_ant` float NOT NULL,
  `nueva_cant` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `movimiento_inventario`
--

INSERT INTO `movimiento_inventario` (`id`, `codigo_producto`, `codigo_tmovi`, `fecha_movimiento`, `comentario`, `id_usuario`, `cantidad`, `cant_ant`, `nueva_cant`) VALUES
(1, 2, 1, '2024-06-18 10:06:32', '', 1, 20, 65, 85),
(2, 2, 2, '2024-06-18 10:06:54', '', 1, 40, 85, 45),
(3, 2, 3, '2024-06-18 10:06:11', '', 1, 20, 45, 20),
(4, 8, 1, '2024-06-18 11:06:30', 'gftgfvdf', 1, 3, 24, 27),
(5, 8, 1, '2024-06-18 11:06:32', 'gftgfvdf', 1, 3, 27, 30),
(6, 8, 1, '2024-06-18 11:06:35', 'gftgfvdf', 1, 3, 30, 33),
(7, 8, 1, '2024-06-18 11:06:35', 'gftgfvdf', 1, 3, 33, 36),
(8, 8, 2, '2024-06-18 11:06:22', 'dfdfbv', 1, 2, 36, 34),
(9, 8, 2, '2024-06-18 11:06:22', 'dfdfbv', 1, 2, 34, 32),
(10, 8, 2, '2024-06-18 11:06:34', 'jhvhv', 1, 4, 32, 28),
(11, 8, 1, '2024-06-18 11:06:42', 'sddwe', 1, 6, 28, 34);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `Descripcion` varchar(100) NOT NULL,
  `Categoria` int(11) NOT NULL,
  `Familia` int(11) NOT NULL,
  `Ubicacion` int(11) NOT NULL,
  `Unidad` int(11) NOT NULL,
  `Cantidad` float NOT NULL,
  `Costo_unidad` decimal(28,4) NOT NULL,
  `valor_inventario` decimal(28,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `Descripcion`, `Categoria`, `Familia`, `Ubicacion`, `Unidad`, `Cantidad`, `Costo_unidad`, `valor_inventario`) VALUES
(1, 'Arroz integral', 1, 1, 1, 1, 40, 22.0000, 880.0000),
(2, 'Papas', 1, 2, 2, 1, 20, 2.0000, 40.0000),
(3, 'Piñas', 1, 3, 2, 1, 10, 2.0000, 12.0000),
(4, 'Requeson', 1, 4, 3, 1, 15, 3.0000, 45.0000),
(5, 'Pollo congelado', 1, 5, 3, 3, 15, 4.0000, 60.0000),
(6, 'Tequila (GA 60°)\r\n', 2, 6, 4, 1, 8, 5.0000, 40.0000),
(7, 'Whisky (GA 40°)', 2, 6, 4, 1, 6, 8.0000, 48.0000),
(8, 'Coca-Cola 2', 3, 3, 4, 1, 34, 2.0000, 68.0000),
(9, 'Pumpkin Spice Latte', 2, 8, 5, 2, 40, 2.0000, 80.0000),
(10, 'Tabla de picar 25cm * 40cm', 3, 9, 6, 2, 15, 3.0000, 45.0000),
(11, 'Cubiertos de 12 cm', 3, 10, 6, 2, 100, 1.0000, 85.0000),
(12, 'Envases desechaples 10cm * 9cm', 3, 11, 6, 3, 500, 0.0000, 125.0000),
(13, 'Platos de 23cm ', 3, 12, 6, 3, 95, 1.0000, 119.0000),
(15, 'otra mas', 2, 2, 1, 2, 478, 47.5800, 22743.2400),
(17, 'lalala', 1, 3, 1, 2, 45, 475.0000, 21375.0000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_usuario`
--

CREATE TABLE `rol_usuario` (
  `id` int(11) NOT NULL,
  `rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol_usuario`
--

INSERT INTO `rol_usuario` (`id`, `rol`) VALUES
(1, 'Super usuario'),
(2, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sujeto`
--

CREATE TABLE `sujeto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `tipo` int(11) NOT NULL,
  `codigo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sujeto`
--

INSERT INTO `sujeto` (`id`, `nombre`, `tipo`, `codigo`) VALUES
(1, 'Proveedor 1', 2, '20975447'),
(2, 'Proveedor 2', 2, '2547896');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sujetotipo`
--

CREATE TABLE `sujetotipo` (
  `id` int(11) NOT NULL,
  `tiposujeto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sujetotipo`
--

INSERT INTO `sujetotipo` (`id`, `tiposujeto`) VALUES
(1, 'Cliente'),
(2, 'Proveedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_movimiento`
--

CREATE TABLE `tipo_movimiento` (
  `id` int(11) NOT NULL,
  `Movimiento` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_movimiento`
--

INSERT INTO `tipo_movimiento` (`id`, `Movimiento`) VALUES
(1, 'Cargo'),
(2, 'Descargo'),
(3, 'Ajuste');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacion`
--

CREATE TABLE `ubicacion` (
  `id` int(11) NOT NULL,
  `ubicacion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ubicacion`
--

INSERT INTO `ubicacion` (`id`, `ubicacion`) VALUES
(1, 'Almacen de granos'),
(2, 'Almacen de hortalizas'),
(3, 'Refrigeradores'),
(4, 'Bar'),
(5, 'Cafeteria'),
(6, 'Cocina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad`
--

CREATE TABLE `unidad` (
  `id` int(11) NOT NULL,
  `unidad` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `unidad`
--

INSERT INTO `unidad` (`id`, `unidad`) VALUES
(1, 'Kilo'),
(2, 'Litro'),
(3, 'Und');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_cliente` int(11) NOT NULL,
  `nom_usuario` varchar(15) NOT NULL,
  `ape_usuario` varchar(15) NOT NULL,
  `contrasenna` varchar(100) NOT NULL,
  `correo` varchar(35) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `rol` int(11) NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT 1,
  `bloqueo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_cliente`, `nom_usuario`, `ape_usuario`, `contrasenna`, `correo`, `telefono`, `rol`, `estatus`, `bloqueo`) VALUES
(1, 'Catherine', 'Aponte', '$2y$10$LRUYJcNFwLvBYeCOURrB..DW3n.1pOsqiNBvABrRGJSFjX8v4lzaG', 'catherine021000@gmail.com', '04149862552', 1, 1, 1),
(2, 'jose', 'vargas', '$2y$10$KMNBgUwNvbwO.W3Ss/Zwh.kpyri6e2Uo50JscMufv3pNNL2IlNt4i', 'jose@jose.com', '04241820143', 2, 0, 1),
(3, 'administrador', 'sistema', '$2y$10$9lWXxyDkSW/ocE3SmubAoO7g4.TWroQfN.o5QSaW3REQjCa9ruBwq', 'admin@admin.com', '142lkjoi', 1, 1, 0),
(7, 'carlos', 'rios', '$2y$10$97o3xtuLTVvpS.Gt1BKWZ.nlBC/GBK/vgbgZZqL57BwDjA6fgVqLO', 'carlor@carlos.com', '534654', 2, 0, 1),
(8, 'jesus', 'campos', '$2y$10$KYlps2xCZkq2ffIFjwDkQuzl/uFDyY8GKq8QnQHodAtFDqLji9gp6', 'jesus@jesus.com', '65484', 2, 1, 1);

-- --------------------------------------------------------

--
-- Estructura para la vista `consulta de producto`
--
DROP TABLE IF EXISTS `consulta de producto`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `consulta de producto`  AS SELECT `a`.`Descripcion` AS `Descripcion`, `b`.`categoria` AS `categoria`, `c`.`familia` AS `familia`, `d`.`ubicacion` AS `ubicacion`, `e`.`unidad` AS `unidad`, `a`.`Cantidad` AS `Cantidad`, `a`.`Costo_unidad` AS `Costo_unidad`, `a`.`valor_inventario` AS `valor_inventario` FROM ((((`producto` `a` join `categoria` `b` on(`a`.`Categoria` = `b`.`id`)) join `familia` `c` on(`a`.`Familia` = `c`.`id`)) join `ubicacion` `d` on(`a`.`Ubicacion` = `d`.`id`)) join `unidad` `e` on(`a`.`Unidad` = `e`.`id`)) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estatus`
--
ALTER TABLE `estatus`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `familia`
--
ALTER TABLE `familia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `impuesto`
--
ALTER TABLE `impuesto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `movimiento_inventario`
--
ALTER TABLE `movimiento_inventario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `codigo_productofk` (`codigo_producto`),
  ADD KEY `codigo_tmovifk` (`codigo_tmovi`),
  ADD KEY `id_usuariofk` (`id_usuario`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `Familiafk` (`Familia`),
  ADD KEY `Ubicacionfk` (`Ubicacion`),
  ADD KEY `Categoriafk` (`Categoria`),
  ADD KEY `Unidadfk` (`Unidad`);

--
-- Indices de la tabla `rol_usuario`
--
ALTER TABLE `rol_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sujeto`
--
ALTER TABLE `sujeto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sujetotipo`
--
ALTER TABLE `sujetotipo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_movimiento`
--
ALTER TABLE `tipo_movimiento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `unidad`
--
ALTER TABLE `unidad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `rol_usuariofk` (`rol`),
  ADD KEY `estatusfk` (`estatus`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `estatus`
--
ALTER TABLE `estatus`
  MODIFY `id` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `familia`
--
ALTER TABLE `familia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `impuesto`
--
ALTER TABLE `impuesto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `movimiento_inventario`
--
ALTER TABLE `movimiento_inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `rol_usuario`
--
ALTER TABLE `rol_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `sujeto`
--
ALTER TABLE `sujeto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sujetotipo`
--
ALTER TABLE `sujetotipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_movimiento`
--
ALTER TABLE `tipo_movimiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `unidad`
--
ALTER TABLE `unidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `movimiento_inventario`
--
ALTER TABLE `movimiento_inventario`
  ADD CONSTRAINT `codigo_productofk` FOREIGN KEY (`codigo_producto`) REFERENCES `producto` (`id_producto`) ON UPDATE CASCADE,
  ADD CONSTRAINT `codigo_tmovifk` FOREIGN KEY (`codigo_tmovi`) REFERENCES `tipo_movimiento` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `id_usuariofk` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_cliente`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `Categoriafk` FOREIGN KEY (`Categoria`) REFERENCES `categoria` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Familiafk` FOREIGN KEY (`Familia`) REFERENCES `familia` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Ubicacionfk` FOREIGN KEY (`Ubicacion`) REFERENCES `ubicacion` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Unidadfk` FOREIGN KEY (`Unidad`) REFERENCES `unidad` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `estatusfk` FOREIGN KEY (`estatus`) REFERENCES `estatus` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `rol_usuariofk` FOREIGN KEY (`rol`) REFERENCES `rol_usuario` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
