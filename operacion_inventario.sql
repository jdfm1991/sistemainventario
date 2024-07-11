-- phpMyAdmin SQL Dump
-- version 6.0.0-dev+20240523.2997b5272e
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 11-07-2024 a las 18:18:12
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
-- Base de datos: `icb-system`
--

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `operacion_inventario`
--

INSERT INTO `operacion_inventario` (`id`, `sujeto`, `usuario`, `tipo_operacion`, `documento`, `fecha_o`, `fecha_r`, `cant_items`, `cant_producto`, `subtotal`, `excento`, `base`, `impuesto`, `iva`, `total`) VALUES
(1, 1, 1, 5, '1', '2024-07-11', '2024-07-11 12:07:16', 1, 1, 1.0000, 0.0000, 1.0000, 1, 1.0000, 1.0000),
(2, 1, 1, 5, '1', '2024-07-11', '2024-07-11 12:07:29', 1, 1, 1.0000, 0.0000, 0.0000, 0, 0.0000, 1.0000),
(3, 2, 2, 5, '2', '2024-07-11', '2024-07-11 13:07:08', 0, 0, 0.0000, 0.0000, 0.0000, 0, 0.0000, 0.0000),
(4, 2, 2, 5, '2', '2024-07-11', '2024-07-11 13:07:47', 0, 0, 0.0000, 0.0000, 0.0000, 0, 0.0000, 0.0000),
(5, 2, 2, 5, '2', '2024-07-11', '2024-07-11 14:07:30', 0, 0, 0.0000, 0.0000, 0.0000, 0, 0.0000, 0.0000);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `operacion_inventario`
--
ALTER TABLE `operacion_inventario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sujetofk` (`sujeto`),
  ADD KEY `usuariofk` (`usuario`),
  ADD KEY `tipo_operacionfk` (`tipo_operacion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `operacion_inventario`
--
ALTER TABLE `operacion_inventario`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `operacion_inventario`
--
ALTER TABLE `operacion_inventario`
  ADD CONSTRAINT `sujetofk` FOREIGN KEY (`sujeto`) REFERENCES `sujeto` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `tipo_operacionfk` FOREIGN KEY (`tipo_operacion`) REFERENCES `tipo_movimiento` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `usuariofk` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id_cliente`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
