-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-05-2019 a las 08:30:29
-- Versión del servidor: 10.1.34-MariaDB
-- Versión de PHP: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_systembar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_categoria`
--

CREATE TABLE `tbl_categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_categoria`
--

INSERT INTO `tbl_categoria` (`id_categoria`, `nombre`) VALUES
(1, 'Refrescos'),
(2, 'cocteles'),
(3, 'Licores');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dlle_producto_pedido`
--

CREATE TABLE `tbl_dlle_producto_pedido` (
  `id` int(11) NOT NULL,
  `id_producto` int(2) NOT NULL,
  `id_pedido` int(2) NOT NULL,
  `cantidad` int(5) DEFAULT NULL,
  `precioAcumulado` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_dlle_producto_pedido`
--

INSERT INTO `tbl_dlle_producto_pedido` (`id`, `id_producto`, `id_pedido`, `cantidad`, `precioAcumulado`) VALUES
(12, 26, 8, 1, 50000),
(13, 27, 8, 1, 7000),
(14, 26, 9, 1, 50000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_mesa`
--

CREATE TABLE `tbl_mesa` (
  `num_mesa` int(2) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_mesa`
--

INSERT INTO `tbl_mesa` (`num_mesa`, `nombre`, `estado`) VALUES
(1, 'mesa 1', 0),
(2, 'mesa 2', 1),
(3, 'mesa 3', 1),
(4, 'mesa 4', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pedido`
--

CREATE TABLE `tbl_pedido` (
  `id_pedido` int(2) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `num_mesa` int(2) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `responsable` int(20) NOT NULL,
  `total` double DEFAULT NULL,
  `descuento` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_pedido`
--

INSERT INTO `tbl_pedido` (`id_pedido`, `fecha`, `num_mesa`, `estado`, `responsable`, `total`, `descuento`, `subtotal`) VALUES
(8, '2019-05-23 00:58:33', 4, 1, 123, 55000, 2000, 57000),
(9, '2019-05-23 01:28:23', 1, 1, 75034284, 50000, 0, 50000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_producto`
--

CREATE TABLE `tbl_producto` (
  `id_producto` int(2) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `precio` double NOT NULL,
  `foto` varchar(45) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `categoria` int(11) NOT NULL,
  `unidadMedida` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_producto`
--

INSERT INTO `tbl_producto` (`id_producto`, `nombre`, `precio`, `foto`, `estado`, `categoria`, `unidadMedida`) VALUES
(26, 'Aguardiente', 50000, '../../public/img/aguardiente.jpg', 1, 3, 1),
(27, 'Ron', 7000, '../../public/img/medellin.jpg', 1, 3, 3),
(28, 'Gaseosa Manzana', 2000, '../../public/img/gaseosa.jpg', 1, 1, 3),
(29, 'Coctel Naranja', 8000, '../../public/img/coctel.jpg', 1, 2, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_documento`
--

CREATE TABLE `tbl_tipo_documento` (
  `id_tipoDocumento` int(2) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_tipo_documento`
--

INSERT INTO `tbl_tipo_documento` (`id_tipoDocumento`, `nombre`) VALUES
(1, 'CC'),
(2, 'CE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_usuario`
--

CREATE TABLE `tbl_tipo_usuario` (
  `id_tipoUsuario` int(2) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_tipo_usuario`
--

INSERT INTO `tbl_tipo_usuario` (`id_tipoUsuario`, `nombre`) VALUES
(1, 'administrador'),
(2, 'mesero'),
(3, 'barman');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_unidad_de_medida`
--

CREATE TABLE `tbl_unidad_de_medida` (
  `id_unidad_medida` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_unidad_de_medida`
--

INSERT INTO `tbl_unidad_de_medida` (`id_unidad_medida`, `nombre`) VALUES
(1, 'media'),
(2, 'garrafa'),
(3, 'litro'),
(5, 'Unidad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario`
--

CREATE TABLE `tbl_usuario` (
  `cedula` int(20) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `telefono` int(10) NOT NULL,
  `celular` int(20) NOT NULL,
  `foto` varchar(45) DEFAULT NULL,
  `correo` varchar(45) NOT NULL,
  `tipo_usuario` int(2) NOT NULL,
  `tipo_documento` int(2) NOT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `usuario` varchar(45) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `FechaRecuperacion` datetime DEFAULT NULL,
  `RestablecerPass` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_usuario`
--

INSERT INTO `tbl_usuario` (`cedula`, `nombre`, `apellido`, `telefono`, `celular`, `foto`, `correo`, `tipo_usuario`, `tipo_documento`, `estado`, `usuario`, `pass`, `FechaRecuperacion`, `RestablecerPass`) VALUES
(123, 'Juano', 'Perez', 123, 213234, 'caca.jpg', 'tatiana.gomez.galvis@gmail.com', 1, 1, 1, 'juan', '202cb962ac59075b964b07152d234b70', '2019-05-23 22:45:17', '1558557917BCDE'),
(75034284, 'hola', 'Zapata', 4263, 552, 'caca.jpg', 'gfgkm@g.com', 3, 1, 1, 'hola', '202cb962ac59075b964b07152d234b70', NULL, NULL),
(1002878805, 'Carolina', 'Gomez', 6037390, 2147483647, 'caca.jpg', 'caritogomez0109200@gmail.com', 2, 1, 1, 'caro', '202cb962ac59075b964b07152d234b70', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_categoria`
--
ALTER TABLE `tbl_categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `tbl_dlle_producto_pedido`
--
ALTER TABLE `tbl_dlle_producto_pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ped_pro` (`id_pedido`),
  ADD KEY `fk_pro_ped` (`id_producto`);

--
-- Indices de la tabla `tbl_mesa`
--
ALTER TABLE `tbl_mesa`
  ADD PRIMARY KEY (`num_mesa`);

--
-- Indices de la tabla `tbl_pedido`
--
ALTER TABLE `tbl_pedido`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `fk_ped_me` (`num_mesa`),
  ADD KEY `fk_ped_usu` (`responsable`);

--
-- Indices de la tabla `tbl_producto`
--
ALTER TABLE `tbl_producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`categoria`),
  ADD KEY `fk_um_pro` (`unidadMedida`);

--
-- Indices de la tabla `tbl_tipo_documento`
--
ALTER TABLE `tbl_tipo_documento`
  ADD PRIMARY KEY (`id_tipoDocumento`);

--
-- Indices de la tabla `tbl_tipo_usuario`
--
ALTER TABLE `tbl_tipo_usuario`
  ADD PRIMARY KEY (`id_tipoUsuario`);

--
-- Indices de la tabla `tbl_unidad_de_medida`
--
ALTER TABLE `tbl_unidad_de_medida`
  ADD PRIMARY KEY (`id_unidad_medida`);

--
-- Indices de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD PRIMARY KEY (`cedula`),
  ADD KEY `fk_usu_td` (`tipo_documento`),
  ADD KEY `fk_usu_tu` (`tipo_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_categoria`
--
ALTER TABLE `tbl_categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tbl_dlle_producto_pedido`
--
ALTER TABLE `tbl_dlle_producto_pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `tbl_mesa`
--
ALTER TABLE `tbl_mesa`
  MODIFY `num_mesa` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tbl_pedido`
--
ALTER TABLE `tbl_pedido`
  MODIFY `id_pedido` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tbl_producto`
--
ALTER TABLE `tbl_producto`
  MODIFY `id_producto` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_documento`
--
ALTER TABLE `tbl_tipo_documento`
  MODIFY `id_tipoDocumento` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_usuario`
--
ALTER TABLE `tbl_tipo_usuario`
  MODIFY `id_tipoUsuario` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tbl_unidad_de_medida`
--
ALTER TABLE `tbl_unidad_de_medida`
  MODIFY `id_unidad_medida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_dlle_producto_pedido`
--
ALTER TABLE `tbl_dlle_producto_pedido`
  ADD CONSTRAINT `fk_ped_pro` FOREIGN KEY (`id_pedido`) REFERENCES `tbl_pedido` (`id_pedido`),
  ADD CONSTRAINT `fk_pro_ped` FOREIGN KEY (`id_producto`) REFERENCES `tbl_producto` (`id_producto`);

--
-- Filtros para la tabla `tbl_pedido`
--
ALTER TABLE `tbl_pedido`
  ADD CONSTRAINT `fk_ped_me` FOREIGN KEY (`num_mesa`) REFERENCES `tbl_mesa` (`num_mesa`),
  ADD CONSTRAINT `fk_ped_usu` FOREIGN KEY (`responsable`) REFERENCES `tbl_usuario` (`cedula`);

--
-- Filtros para la tabla `tbl_producto`
--
ALTER TABLE `tbl_producto`
  ADD CONSTRAINT `tbl_producto_ibfk_1` FOREIGN KEY (`unidadMedida`) REFERENCES `tbl_unidad_de_medida` (`id_unidad_medida`),
  ADD CONSTRAINT `tbl_producto_ibfk_2` FOREIGN KEY (`categoria`) REFERENCES `tbl_categoria` (`id_categoria`);

--
-- Filtros para la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD CONSTRAINT `fk_usu_td` FOREIGN KEY (`tipo_documento`) REFERENCES `tbl_tipo_documento` (`id_tipoDocumento`),
  ADD CONSTRAINT `fk_usu_tu` FOREIGN KEY (`tipo_usuario`) REFERENCES `tbl_tipo_usuario` (`id_tipoUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
