-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-07-2024 a las 05:24:28
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
-- Base de datos: `icb-system`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customer_supplier_data_table`
--

CREATE TABLE `customer_supplier_data_table` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `tipo` int(11) NOT NULL,
  `codigo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customer_supplier_type_data_table`
--

CREATE TABLE `customer_supplier_type_data_table` (
  `id` int(11) NOT NULL,
  `tiposujeto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `department_data_table`
--

CREATE TABLE `department_data_table` (
  `id` int(11) NOT NULL,
  `department` varchar(50) NOT NULL,
  `position` int(11) NOT NULL,
  `detail` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `department_data_table`
--

INSERT INTO `department_data_table` (`id`, `department`, `position`, `detail`) VALUES
(1, 'Ventas', 0, 'Departamento dedicado al area de ventas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `department_role_permissions_data_table`
--

CREATE TABLE `department_role_permissions_data_table` (
  `id` int(11) NOT NULL,
  `department` int(11) NOT NULL,
  `user_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `department_role_permissions_data_table`
--

INSERT INTO `department_role_permissions_data_table` (`id`, `department`, `user_rol`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventory_operations_data_table`
--

CREATE TABLE `inventory_operations_data_table` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventory_operations_detail_data_table`
--

CREATE TABLE `inventory_operations_detail_data_table` (
  `id` int(11) NOT NULL,
  `codigo_producto` int(11) NOT NULL,
  `codigo_tmovi` int(11) NOT NULL,
  `fecha_movimiento` datetime NOT NULL,
  `comentario` varchar(150) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `cant_ant` float NOT NULL,
  `nueva_cant` float NOT NULL,
  `valor_inventario_actual` decimal(28,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventory_operations_type_data_table`
--

CREATE TABLE `inventory_operations_type_data_table` (
  `id` int(11) NOT NULL,
  `Movimiento` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_category_data_table`
--

CREATE TABLE `product_category_data_table` (
  `id` int(11) NOT NULL,
  `categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_data_table`
--

CREATE TABLE `product_data_table` (
  `id_producto` int(11) NOT NULL,
  `Descripcion` varchar(100) NOT NULL,
  `Categoria` int(11) NOT NULL,
  `Familia` int(11) NOT NULL,
  `Ubicacion` int(11) NOT NULL,
  `Unidad` int(11) NOT NULL,
  `Cantidad` float DEFAULT NULL,
  `Costo_unidad` decimal(28,4) DEFAULT NULL,
  `valor_inventario` decimal(28,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_location_data_table`
--

CREATE TABLE `product_location_data_table` (
  `id` int(11) NOT NULL,
  `ubicacion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_units_data_table`
--

CREATE TABLE `product_units_data_table` (
  `id` int(11) NOT NULL,
  `unidad` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_data_table`
--

CREATE TABLE `user_data_table` (
  `id` int(11) NOT NULL,
  `user` varchar(20) NOT NULL,
  `user_name` varchar(15) NOT NULL,
  `user_last_name` varchar(15) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_email` varchar(35) NOT NULL,
  `user_phone` varchar(20) NOT NULL,
  `user_rol` int(11) NOT NULL,
  `user_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user_data_table`
--

INSERT INTO `user_data_table` (`id`, `user`, `user_name`, `user_last_name`, `user_password`, `user_email`, `user_phone`, `user_rol`, `user_status`) VALUES
(7, 'jfranco', 'jovanni Daniel', 'Franco', '$2y$10$byen6Q.DcB1S5.XVe92BP.rsXBrEQsRYFBaojJ.4OIFT0cXazJFQO', 'Jovannifranco@gmail.com', '4249265304', 2, 1),
(8, 'admin', 'admin', 'admin', '$2y$10$3XBvkpWRaW4p5LzBDZiffedEJHl0cIsJoi2H62aaZXy0uxUkzmpS6', 'admin@admin.com', '0000 000 00 00', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_roles_data_table`
--

CREATE TABLE `user_roles_data_table` (
  `id` int(11) NOT NULL,
  `user_rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user_roles_data_table`
--

INSERT INTO `user_roles_data_table` (`id`, `user_rol`) VALUES
(1, 'Super User'),
(2, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_status_data_table`
--

CREATE TABLE `user_status_data_table` (
  `id` tinyint(1) NOT NULL,
  `user_status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user_status_data_table`
--

INSERT INTO `user_status_data_table` (`id`, `user_status`) VALUES
(0, 'Inactivo'),
(1, 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vat_data_table`
--

CREATE TABLE `vat_data_table` (
  `id` int(11) NOT NULL,
  `tax` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `customer_supplier_data_table`
--
ALTER TABLE `customer_supplier_data_table`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `customer_supplier_type_data_table`
--
ALTER TABLE `customer_supplier_type_data_table`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `department_data_table`
--
ALTER TABLE `department_data_table`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `department_role_permissions_data_table`
--
ALTER TABLE `department_role_permissions_data_table`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inventory_operations_data_table`
--
ALTER TABLE `inventory_operations_data_table`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inventory_operations_detail_data_table`
--
ALTER TABLE `inventory_operations_detail_data_table`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inventory_operations_type_data_table`
--
ALTER TABLE `inventory_operations_type_data_table`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `product_category_data_table`
--
ALTER TABLE `product_category_data_table`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `product_data_table`
--
ALTER TABLE `product_data_table`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `product_location_data_table`
--
ALTER TABLE `product_location_data_table`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `product_units_data_table`
--
ALTER TABLE `product_units_data_table`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user_data_table`
--
ALTER TABLE `user_data_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_rol_fk` (`user_rol`),
  ADD KEY `user_status_fk` (`user_status`);

--
-- Indices de la tabla `user_roles_data_table`
--
ALTER TABLE `user_roles_data_table`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user_status_data_table`
--
ALTER TABLE `user_status_data_table`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vat_data_table`
--
ALTER TABLE `vat_data_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `department_data_table`
--
ALTER TABLE `department_data_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `department_role_permissions_data_table`
--
ALTER TABLE `department_role_permissions_data_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `inventory_operations_data_table`
--
ALTER TABLE `inventory_operations_data_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventory_operations_detail_data_table`
--
ALTER TABLE `inventory_operations_detail_data_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventory_operations_type_data_table`
--
ALTER TABLE `inventory_operations_type_data_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `product_category_data_table`
--
ALTER TABLE `product_category_data_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `product_data_table`
--
ALTER TABLE `product_data_table`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `product_location_data_table`
--
ALTER TABLE `product_location_data_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `product_units_data_table`
--
ALTER TABLE `product_units_data_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `user_data_table`
--
ALTER TABLE `user_data_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `user_roles_data_table`
--
ALTER TABLE `user_roles_data_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `user_status_data_table`
--
ALTER TABLE `user_status_data_table`
  MODIFY `id` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `user_data_table`
--
ALTER TABLE `user_data_table`
  ADD CONSTRAINT `user_rol_fk` FOREIGN KEY (`user_rol`) REFERENCES `user_roles_data_table` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_status_fk` FOREIGN KEY (`user_status`) REFERENCES `user_status_data_table` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
