-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-04-2019 a las 06:12:00
-- Versión del servidor: 10.1.34-MariaDB
-- Versión de PHP: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;`
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
(55, 1, 38, 123232, 2464640000),
(56, 1, 39, 23, 460000),
(57, 1, 40, 2, 40000),
(58, 2, 40, 3, 150000),
(59, 1, 41, 1, 20000),
(60, 1, 41, 2, 40000),
(61, 1, 41, 3, 60000),
(62, 1, 41, 4, 80000),
(63, 1, 42, 2, 40000),
(64, 2, 42, 4, 200000),
(65, 7, 42, 2, 4000);

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
(1, 'mesa 1', 1),
(2, 'mesa 2', 0);

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
  `total` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_pedido`
--

INSERT INTO `tbl_pedido` (`id_pedido`, `fecha`, `num_mesa`, `estado`, `responsable`, `total`) VALUES
(38, '2019-04-05 15:10:35', 1, 1, 123, 2464640000),
(39, '2019-04-05 15:12:12', 1, 0, 123, 460000),
(40, '2019-04-05 15:48:08', 1, 0, 123, 190000),
(41, '2019-04-07 21:39:17', 1, 0, 123, 200000),
(42, '2019-04-07 23:06:05', 1, 1, 123, 244000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_producto`
--

CREATE TABLE `tbl_producto` (
  `id_producto` int(2) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `precio` double NOT NULL,
  `foto` varchar(45) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_producto`
--

INSERT INTO `tbl_producto` (`id_producto`, `nombre`, `precio`, `foto`, `estado`) VALUES
(1, 'cerveza corona', 20000, 'gdfgf', 1),
(2, 'media de aguardiente', 50000, 'khghb', 1),
(7, 'trago de aguardinete', 2000, '', 1);

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
(1, 'cc'),
(2, 'CE'),
(3, 'TI');

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
(1, 'admin'),
(2, 'mesero'),
(3, 'barman');

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
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_usuario`
--

INSERT INTO `tbl_usuario` (`cedula`, `nombre`, `apellido`, `telefono`, `celular`, `foto`, `correo`, `tipo_usuario`, `tipo_documento`, `estado`, `usuario`, `pass`) VALUES
(123, 'juan', 'perez', 123, 213234, '2efdf', 'fdik@dhw', 1, 1, 1, 'juan', '202cb962ac59075b964b07152d234b70'),
(1234, 'simonnn', 'gomez', 45678, 3456789, NULL, 'gfgkm@g.com', 2, 1, 0, 'simon', 'b58c50e209762c24adb9f29daffe249c'),
(34556, 'fgbgbg', 'gbggg', 654, 76543, NULL, 'kkjfd@g.g', 2, 1, 1, 'kjf', '821fa74b50ba3f7cba1e6c53e8fa6845'),
(35467, 'gbfvcdx', 'nhbgvfc', 7654, 6543, NULL, 'juyhtg@fkj.f', 2, 1, 0, 'jf', '123'),
(63463, 'carla', 'fbgfbgh', 7654, 76543, NULL, 'gbgf@f.f', 2, 1, 0, 'vsrls', '2f00b307460a56b1569ee888035c6397'),
(74646, 'simon', 'gomez', 878786, 56464645, NULL, 'caro@g.c', 2, 1, 1, 'simon', '202cb962ac59075b964b07152d234b70'),
(87654, 'caro', 'gomez', 3216548, 2147483647, NULL, 'caro@g.c', 2, 1, 1, 'caro', '202cb962ac59075b964b07152d234b70'),
(100287, 'caro', 'gomez', 6037390, 2147483647, NULL, 'gfgkm@g.com', 2, 1, 1, 'caro', '202cb962ac59075b964b07152d234b70'),
(75034284, 'hola', 'ghfhfg', 4263, 552, NULL, 'gfgkm@g.com', 2, 1, 1, 'hola', '202cb962ac59075b964b07152d234b70'),
(1002878805, 'Carolina', 'Gomez', 6037390, 2147483647, NULL, 'carito@kf.dd', 2, 1, 1, 'caro', '202cb962ac59075b964b07152d234b70'),
(1152700958, 'leon alexis', 'zapata', 56546, 5415451, NULL, 'hgsd@dkjv.f', 2, 1, 1, 'alexis', '202cb962ac59075b964b07152d234b70');

--
-- Índices para tablas volcadas
--

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
  ADD PRIMARY KEY (`id_producto`);

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
-- AUTO_INCREMENT de la tabla `tbl_dlle_producto_pedido`
--
ALTER TABLE `tbl_dlle_producto_pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT de la tabla `tbl_mesa`
--
ALTER TABLE `tbl_mesa`
  MODIFY `num_mesa` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_pedido`
--
ALTER TABLE `tbl_pedido`
  MODIFY `id_pedido` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `tbl_producto`
--
ALTER TABLE `tbl_producto`
  MODIFY `id_producto` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_documento`
--
ALTER TABLE `tbl_tipo_documento`
  MODIFY `id_tipoDocumento` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_usuario`
--
ALTER TABLE `tbl_tipo_usuario`
  MODIFY `id_tipoUsuario` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- Filtros para la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD CONSTRAINT `fk_usu_td` FOREIGN KEY (`tipo_documento`) REFERENCES `tbl_tipo_documento` (`id_tipoDocumento`),
  ADD CONSTRAINT `fk_usu_tu` FOREIGN KEY (`tipo_usuario`) REFERENCES `tbl_tipo_usuario` (`id_tipoUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
