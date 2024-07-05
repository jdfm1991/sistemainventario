-- phpMyAdmin SQL Dump
-- version 6.0.0-dev+20240523.2997b5272e
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 03-07-2024 a las 18:27:44
-- Versión del servidor: 8.0.19
-- Versión de PHP: 8.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `registro2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int NOT NULL,
  `categoria` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
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
-- Estructura de tabla para la tabla `estatus`
--

CREATE TABLE `estatus` (
  `id` tinyint(1) NOT NULL,
  `estatus` varchar(15) COLLATE utf8mb4_general_ci NOT NULL
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
  `id` int NOT NULL,
  `familia` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
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
  `id` int NOT NULL,
  `impuesto` int NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '0'
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
  `id` int NOT NULL,
  `codigo_producto` int NOT NULL,
  `codigo_tmovi` int NOT NULL,
  `fecha_movimiento` datetime NOT NULL,
  `comentario` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_usuario` int DEFAULT NULL,
  `cantidad` int NOT NULL,
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
(11, 8, 1, '2024-06-18 11:06:42', 'sddwe', 1, 6, 28, 34),
(12, 1, 4, '2024-07-02 13:07:13', NULL, 3, 3, 43, 46),
(13, 12, 4, '2024-07-02 13:07:13', NULL, 3, 2, 502, 504),
(14, 8, 4, '2024-07-02 13:07:13', NULL, 3, 5, 39, 44),
(15, 1, 4, '2024-07-02 14:07:38', NULL, 3, 3, 46, 49),
(16, 12, 4, '2024-07-02 14:07:38', NULL, 3, 2, 504, 506),
(17, 8, 4, '2024-07-02 14:07:38', NULL, 3, 5, 44, 49),
(18, 8, 4, '2024-07-02 16:07:11', NULL, 3, 1, 49, 50),
(19, 8, 4, '2024-07-02 16:07:16', NULL, 3, 4, 50, 54),
(20, 5, 4, '2024-07-02 17:07:28', NULL, 3, 3, 15, 18),
(21, 10, 4, '2024-07-02 17:07:28', NULL, 3, 3, 15, 18),
(22, 12, 4, '2024-07-02 17:07:34', NULL, 3, 3, 506, 509),
(23, 17, 4, '2024-07-02 17:07:34', NULL, 3, 3, 45, 48),
(24, 8, 4, '2024-07-02 17:07:34', NULL, 3, 3, 54, 57),
(25, 8, 4, '2024-07-02 18:07:28', NULL, 3, 5, 57, 62),
(26, 1, 4, '2024-07-02 18:07:28', NULL, 3, 2, 49, 51),
(27, 13, 4, '2024-07-02 18:07:28', NULL, 3, 3, 95, 98),
(28, 13, 4, '2024-07-02 18:07:28', NULL, 3, 4, 98, 102),
(29, 3, 4, '2024-07-02 18:07:28', NULL, 3, 2, 10, 12),
(30, 1, 4, '2024-07-02 18:07:58', NULL, 3, 4, 51, 55),
(31, 11, 4, '2024-07-02 18:07:58', NULL, 3, 2, 100, 102),
(32, 15, 4, '2024-07-02 18:07:58', NULL, 3, 4, 478, 482);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operacion_inventario`
--

CREATE TABLE `operacion_inventario` (
  `id` int NOT NULL,
  `sujeto` int NOT NULL,
  `usuario` int NOT NULL,
  `tipo_operacion` int NOT NULL,
  `documento` varchar(20) NOT NULL,
  `fecha_o` date NOT NULL,
  `fecha_r` datetime NOT NULL,
  `cant_items` int NOT NULL,
  `cant_producto` int NOT NULL,
  `subtotal` decimal(28,4) NOT NULL,
  `excento` decimal(28,4) NOT NULL DEFAULT '0.0000',
  `base` decimal(28,4) NOT NULL DEFAULT '0.0000',
  `impuesto` int NOT NULL DEFAULT '0',
  `iva` decimal(28,4) NOT NULL DEFAULT '0.0000',
  `total` decimal(28,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `operacion_inventario`
--

INSERT INTO `operacion_inventario` (`id`, `sujeto`, `usuario`, `tipo_operacion`, `documento`, `fecha_o`, `fecha_r`, `cant_items`, `cant_producto`, `subtotal`, `excento`, `base`, `impuesto`, `iva`, `total`) VALUES
(2, 1, 3, 4, 'F-0001-2024', '2024-06-20', '2024-07-01 21:07:09', 3, 10, 196.7400, 44.0000, 152.7400, 16, 24.4400, 221.1800),
(3, 1, 3, 4, '45782', '2024-06-20', '2024-07-01 17:07:09', 3, 10, 196.7400, 44.0000, 152.7400, 16, 24.4400, 221.1800),
(4, 2, 3, 4, '77445', '2024-07-01', '2024-07-01 17:07:10', 4, 4, 21.2900, 4.0000, 17.2900, 12, 2.0700, 23.3600),
(5, 1, 3, 4, '587', '2024-07-01', '2024-07-01 17:07:47', 3, 6, 28.0600, 14.9000, 13.1600, 12, 1.5800, 29.6400),
(6, 1, 3, 4, '654', '2024-07-01', '2024-07-01 18:07:34', 2, 2, 9.4500, 2.0000, 7.4500, 12, 0.8900, 10.3400),
(7, 1, 3, 4, '8754', '2024-07-01', '2024-07-01 18:07:18', 1, 1, 7.4500, 0.0000, 7.4500, 12, 0.8900, 8.3400),
(8, 1, 3, 4, '54', '2024-07-01', '2024-07-01 18:07:05', 1, 1, 7.4500, 0.0000, 7.4500, 12, 0.8900, 8.3400),
(9, 1, 3, 4, '57', '2024-07-01', '2024-07-01 18:07:24', 3, 3, 14.0300, 0.0000, 14.0300, 12, 1.6800, 15.7100),
(10, 1, 3, 4, '4546', '2024-07-01', '2024-07-01 18:07:08', 2, 2, 12.7100, 0.0000, 12.7100, 14, 1.7800, 14.4900),
(11, 2, 3, 4, '54654', '2024-07-01', '2024-07-01 18:07:25', 2, 2, 12.7100, 0.0000, 12.7100, 12, 1.5300, 14.2400),
(12, 2, 3, 4, '54654', '2024-07-01', '2024-07-01 18:07:27', 2, 2, 12.7100, 0.0000, 12.7100, 12, 1.5300, 14.2400),
(13, 1, 3, 4, '545', '2024-07-01', '2024-07-01 18:07:36', 2, 2, 12.0300, 0.0000, 12.0300, 12, 1.4400, 13.4700),
(14, 1, 3, 4, '54', '2024-07-01', '2024-07-01 18:07:38', 2, 2, 12.0300, 0.0000, 12.0300, 12, 1.4400, 13.4700),
(15, 2, 3, 4, '5585', '2024-07-02', '2024-07-02 09:07:38', 3, 10, 41.5100, 10.0000, 31.5100, 16, 5.0400, 46.5500),
(16, 2, 3, 4, '5585', '2024-07-02', '2024-07-02 13:07:13', 3, 10, 41.5100, 10.0000, 31.5100, 16, 5.0400, 46.5500),
(17, 2, 3, 4, '5585', '2024-07-02', '2024-07-02 14:07:38', 3, 10, 41.5100, 10.0000, 31.5100, 16, 5.0400, 46.5500),
(18, 1, 3, 4, '4578', '2024-07-02', '2024-07-02 16:07:11', 1, 1, 2.0000, 0.0000, 2.0000, 12, 0.2400, 2.2400),
(19, 1, 3, 4, '5487', '2024-07-02', '2024-07-02 16:07:16', 1, 4, 8.0000, 0.0000, 8.0000, 12, 0.9600, 8.9600),
(20, 1, 3, 4, '4878', '2024-07-02', '2024-07-02 17:07:28', 2, 6, 21.0000, 9.0000, 12.0000, 12, 1.4400, 22.4400),
(21, 1, 3, 4, '45782', '2024-07-01', '2024-07-02 17:07:34', 3, 9, 34.7400, 15.0000, 19.7400, 12, 2.3700, 37.1100),
(22, 2, 3, 4, '458', '2024-07-02', '2024-07-02 18:07:28', 5, 16, 67.6700, 0.0000, 67.6700, 14, 9.4700, 77.1400),
(23, 2, 3, 4, '784', '2024-07-01', '2024-07-02 18:07:58', 13, 10, 70.6400, 10.5200, 60.1200, 22, 13.2300, 83.8700);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int NOT NULL,
  `Descripcion` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `Categoria` int NOT NULL,
  `Familia` int NOT NULL,
  `Ubicacion` int NOT NULL,
  `Unidad` int NOT NULL,
  `Cantidad` float NOT NULL DEFAULT '0',
  `Costo_unidad` decimal(28,4) NOT NULL,
  `precio_unidad` decimal(28,4) NOT NULL,
  `valor_inventario` decimal(28,4) NOT NULL DEFAULT '0.0000',
  `excento` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `Descripcion`, `Categoria`, `Familia`, `Ubicacion`, `Unidad`, `Cantidad`, `Costo_unidad`, `precio_unidad`, `valor_inventario`, `excento`) VALUES
(1, 'Arroz integral', 1, 1, 1, 1, 55, 20.7500, 29.0500, 409.7500, 1),
(2, '25', 2, 1, 1, 2, 20, 4.0000, 14.0000, 40.0000, 0),
(3, '25', 2, 1, 1, 2, 12, 4.0000, 14.0000, 63.8400, 0),
(4, 'Requeson', 1, 4, 3, 1, 15, 3.4580, 0.0000, 45.0000, 0),
(5, 'Pollo congelado', 1, 5, 3, 3, 18, 4.0000, 0.0000, 72.0000, 0),
(6, 'Tequila (GA 60°)\r\n', 2, 6, 4, 1, 8, 5.0000, 0.0000, 40.0000, 0),
(7, 'Whisky (GA 40°)', 2, 6, 4, 1, 6, 8.0000, 0.0000, 48.0000, 0),
(8, 'Coca-Cola 2', 3, 3, 4, 1, 62, 2.0000, 0.0000, 124.0000, 1),
(9, 'Pumpkin Spice Latte', 2, 8, 5, 2, 40, 2.0000, 0.0000, 80.0000, 0),
(10, 'Tabla de picar 25cm * 40cm', 3, 9, 6, 2, 18, 3.0000, 0.0000, 54.0000, 0),
(11, 'Cubiertos de 12 cm', 3, 10, 6, 2, 102, 5.2560, 0.0000, 536.5200, 0),
(12, 'Envases desechaples 10cm * 9cm', 3, 11, 6, 3, 509, 4.5840, 0.0000, 2331.2200, 0),
(13, 'Platos de 23cm ', 3, 12, 6, 3, 102, 4.5870, 0.0000, 468.1800, 0),
(15, 'otra mas', 2, 2, 1, 2, 482, 7.5800, 0.0000, 3653.5600, 0),
(17, 'lalala', 1, 3, 1, 2, 48, 5.0000, 0.0000, 240.0000, 0),
(21, 'prueba', 1, 2, 1, 1, 0, 50.0000, 65.0000, 0.0000, 0),
(22, 'test 2', 1, 2, 2, 2, 0, 45.0000, 58.5000, 0.0000, 0),
(23, 'otras mas', 2, 4, 2, 2, 0, 80.0000, 104.0000, 0.0000, 0),
(24, 'caosde', 1, 4, 4, 2, 0, 45.0000, 58.5000, 0.0000, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_precio_costo`
--

CREATE TABLE `producto_precio_costo` (
  `id` int NOT NULL,
  `producto` int NOT NULL,
  `costo` decimal(28,4) NOT NULL,
  `precio_1` decimal(28,4) NOT NULL,
  `precio_2` decimal(28,4) NOT NULL,
  `precio_3` decimal(28,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_usuario`
--

CREATE TABLE `rol_usuario` (
  `id` int NOT NULL,
  `rol` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
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
  `id` int NOT NULL,
  `nombre` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `tipo` int NOT NULL,
  `codigo` varchar(20) COLLATE utf8mb4_general_ci NOT NULL
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
  `id` int NOT NULL,
  `tiposujeto` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
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
  `id` int NOT NULL,
  `Movimiento` varchar(20) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_movimiento`
--

INSERT INTO `tipo_movimiento` (`id`, `Movimiento`) VALUES
(1, 'Cargo'),
(2, 'Descargo'),
(3, 'Ajuste'),
(4, 'Compra'),
(5, 'Venta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacion`
--

CREATE TABLE `ubicacion` (
  `id` int NOT NULL,
  `ubicacion` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
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
  `id` int NOT NULL,
  `unidad` varchar(20) COLLATE utf8mb4_general_ci NOT NULL
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
  `id_cliente` int NOT NULL,
  `nom_usuario` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `ape_usuario` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `contrasenna` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `correo` varchar(35) COLLATE utf8mb4_general_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `rol` int NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  `bloqueo` tinyint(1) NOT NULL DEFAULT '1'
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
-- Indices de la tabla `operacion_inventario`
--
ALTER TABLE `operacion_inventario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sujetofk` (`sujeto`),
  ADD KEY `usuariofk` (`usuario`),
  ADD KEY `tipo_operacionfk` (`tipo_operacion`);

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
-- Indices de la tabla `producto_precio_costo`
--
ALTER TABLE `producto_precio_costo`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `estatus`
--
ALTER TABLE `estatus`
  MODIFY `id` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `familia`
--
ALTER TABLE `familia`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `impuesto`
--
ALTER TABLE `impuesto`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `movimiento_inventario`
--
ALTER TABLE `movimiento_inventario`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `operacion_inventario`
--
ALTER TABLE `operacion_inventario`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `producto_precio_costo`
--
ALTER TABLE `producto_precio_costo`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol_usuario`
--
ALTER TABLE `rol_usuario`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `sujeto`
--
ALTER TABLE `sujeto`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sujetotipo`
--
ALTER TABLE `sujetotipo`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_movimiento`
--
ALTER TABLE `tipo_movimiento`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `unidad`
--
ALTER TABLE `unidad`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_cliente` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
-- Filtros para la tabla `operacion_inventario`
--
ALTER TABLE `operacion_inventario`
  ADD CONSTRAINT `sujetofk` FOREIGN KEY (`sujeto`) REFERENCES `sujeto` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `tipo_operacionfk` FOREIGN KEY (`tipo_operacion`) REFERENCES `tipo_movimiento` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `usuariofk` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id_cliente`) ON DELETE RESTRICT ON UPDATE CASCADE;

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
