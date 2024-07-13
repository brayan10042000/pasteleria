-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-07-2024 a las 23:11:54
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pasteleria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_categoria`
--

CREATE TABLE `tbl_categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tbl_categoria`
--

INSERT INTO `tbl_categoria` (`id_categoria`, `nombre_categoria`) VALUES
(15, 'Pastel'),
(16, 'Pan'),
(17, 'Postre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cliente`
--

CREATE TABLE `tbl_cliente` (
  `id_cliente` int(11) NOT NULL,
  `nombre_cliente` varchar(255) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `contraseña` text DEFAULT NULL,
  `foto` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tbl_cliente`
--

INSERT INTO `tbl_cliente` (`id_cliente`, `nombre_cliente`, `correo`, `contraseña`, `foto`) VALUES
(8, 'aisyah', 'aisyah@gmail.com', 'ini1234', NULL),
(7, 'siti', 'siti@gmail.com', '12345', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_configuracion`
--

CREATE TABLE `tbl_configuracion` (
  `id` int(1) NOT NULL,
  `nombre_tienda` varchar(255) DEFAULT NULL,
  `ubicacion` int(11) DEFAULT NULL,
  `direccion_tienda` text DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tbl_configuracion`
--

INSERT INTO `tbl_configuracion` (`id`, `nombre_tienda`, `ubicacion`, `direccion_tienda`, `telefono`) VALUES
(1, 'PASTELERIA SAM', 501, 'CC Paseo Villa Del Rio Piso 1 - Bogotá.', '300 5394832');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cuenta`
--

CREATE TABLE `tbl_cuenta` (
  `id_cuenta` int(11) NOT NULL,
  `nombre_banco` varchar(25) DEFAULT NULL,
  `numero_cuenta` varchar(25) DEFAULT NULL,
  `a_nombre_de` varchar(25) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tbl_cuenta`
--

INSERT INTO `tbl_cuenta` (`id_cuenta`, `nombre_banco`, `numero_cuenta`, `a_nombre_de`) VALUES
(3, 'BRI', '6754 0898 7643 567', 'Aisyah');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_detalle_transaccion`
--

CREATE TABLE `tbl_detalle_transaccion` (
  `id_detalle` int(11) NOT NULL,
  `numero_orden` varchar(25) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tbl_detalle_transaccion`
--

INSERT INTO `tbl_detalle_transaccion` (`id_detalle`, `numero_orden`, `id_producto`, `cantidad`) VALUES
(37, '20230119KV86Y9AI', 17, 1),
(36, '20230119KV86Y9AI', 16, 1),
(35, '20230119KLBRQNGY', 10, 1),
(34, '20230119KLBRQNGY', 16, 1),
(33, '20230119KLBRQNGY', 11, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_imagen`
--

CREATE TABLE `tbl_imagen` (
  `id_imagen` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `imagen` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tbl_imagen`
--

INSERT INTO `tbl_imagen` (`id_imagen`, `id_producto`, `descripcion`, `imagen`) VALUES
(35, 11, 'Blanco', 'Macaron_12.png'),
(33, 11, 'Amarillo', 'Macaron_13.png'),
(32, 11, 'Naranja', 'Macaron_3.png'),
(36, 23, 'helado', 'dessert_1-foto.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_producto`
--

CREATE TABLE `tbl_producto` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(255) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `precio` int(11) DEFAULT NULL,
  `descripcion` mediumtext DEFAULT NULL,
  `imagen` text DEFAULT NULL,
  `peso` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tbl_producto`
--

INSERT INTO `tbl_producto` (`id_producto`, `nombre_producto`, `id_categoria`, `precio`, `descripcion`, `imagen`, `peso`) VALUES
(8, 'Pastel de Cumpleaños de Chocolate', 15, 100000, 'Pastel de cumpleaños de chocolate con escritura que puede solicitar según el gusto', 'kue_ultah_wafer.jpg', 1000),
(10, 'Brownies', 15, 20000, 'Brownies con cobertura de queso y chispas de chocolate', 'coklat-foto.jpg', 50),
(11, 'Macaron', 15, 50000, 'Macaron con varios sabores en 1 caja', 'Macaron_14.png', 75),
(12, 'Donut', 15, 25000, 'Donuts con varias variantes de cobertura que se pueden solicitar según el gusto', 'Pastry_4.png', 10),
(13, 'Pastel + Cobertura de Crema', 15, 25000, 'Pastel con cobertura de crema', 'Cupcake_9.png', 25),
(14, 'Pastel de Terciopelo Rojo', 15, 25000, 'Pastel de terciopelo rojo con cobertura de crema', 'red_velvet_cupcake_pic.png', 25),
(15, 'Pastel Arcoíris', 15, 125000, 'Pasteles coloridos, puede solicitar colores según el gusto', 'Cake_1.png', 1000),
(16, 'Pan Seco', 16, 50000, 'Pan seco con varias formas y sabores', 'Pastry_9.png', 100),
(17, 'Pan', 16, 40000, 'Pan seco con una forma pero con varios sabores', 'Pastry_7.png', 100),
(18, 'Bollos de Azúcar', 16, 25000, 'Pan espolvoreado con azúcar y relleno de chocolate por dentro', 'Pastry_81.png', 50),
(19, 'Galletas', 16, 25000, 'Galletas con crema más una pizca de caramelos de chocolate', 'Cookie_8.png', 25),
(20, 'Galletas Originales', 16, 20000, 'Galletas originales sin ninguna cobertura adicional', 'Cookie_1.png', 25),
(21, 'Postre de Frutas', 17, 28000, 'Postre de frutas con frutas frescas y de calidad', 'product-big-3.jpg', 15),
(22, 'Postre de Caramelo', 17, 35000, 'Postre con cobertura de caramelo con muchas capas de frutas molidas, caramelos o chocolate', 'dessert-foto.jpg', 20),
(23, 'Helado', 17, 24000, 'Helado con su elección de sabor a vainilla, chocolate o fresa', 'dessert_1-foto.jpg', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_transaccion`
--

CREATE TABLE `tbl_transaccion` (
  `id_transaccion` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `numero_orden` varchar(25) NOT NULL,
  `fecha_orden` date DEFAULT NULL,
  `nombre_receptor` varchar(25) DEFAULT NULL,
  `telefono_receptor` varchar(15) DEFAULT NULL,
  `provincia` varchar(25) DEFAULT NULL,
  `ciudad` varchar(25) DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `codigo_postal` varchar(8) DEFAULT NULL,
  `empresa_envio` varchar(255) DEFAULT NULL,
  `paquete` varchar(255) DEFAULT NULL,
  `estimacion` varchar(255) DEFAULT NULL,
  `costo_envio` int(11) DEFAULT NULL,
  `peso` int(11) DEFAULT NULL,
  `total_general` int(11) DEFAULT NULL,
  `total_pago` int(11) DEFAULT NULL,
  `estado_pago` int(1) DEFAULT NULL,
  `comprobante_pago` text DEFAULT NULL,
  `a_nombre_de` varchar(25) DEFAULT NULL,
  `nombre_banco` varchar(25) DEFAULT NULL,
  `numero_cuenta` varchar(25) DEFAULT NULL,
  `estado_orden` int(1) DEFAULT NULL,
  `numero_rastreo` varchar(25) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tbl_transaccion`
--

INSERT INTO `tbl_transaccion` (`id_transaccion`, `id_cliente`, `numero_orden`, `fecha_orden`, `nombre_receptor`, `telefono_receptor`, `provincia`, `ciudad`, `direccion`, `codigo_postal`, `empresa_envio`, `paquete`, `estimacion`, `costo_envio`, `peso`, `total_general`, `total_pago`, `estado_pago`, `comprobante_pago`, `a_nombre_de`, `nombre_banco`, `numero_cuenta`, `estado_orden`, `numero_rastreo`) VALUES
(27, 7, '20230119KV86Y9AI', '2023-01-19', 'kk', '77985', 'Java Oriental', '251', 'nn', '77', 'jne', 'REG', '4-5 Días', 20000, 200, 90000, 110000, 0, NULL, NULL, NULL, NULL, 0, NULL),
(26, 7, '20230119KLBRQNGY', '2023-01-19', 'Siti Aisyah', '086453456246', 'DI Yogyakarta', '419', 'Sleman', '55511', 'jne', 'CTC', '1-2 Días', 6000, 225, 120000, 126000, 1, 'noimage.png', 'Siti Aisyah', 'BRI', '0091863525126', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario`
--

CREATE TABLE `tbl_usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(25) DEFAULT NULL,
  `username` varchar(25) DEFAULT NULL,
  `contraseña` varchar(25) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tbl_usuario`
--

INSERT INTO `tbl_usuario` (`id_usuario`, `nombre_usuario`, `username`, `contraseña`) VALUES
(1, 'Super Admin', 'superadmin', '12345');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_categoria`
--
ALTER TABLE `tbl_categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `tbl_cliente`
--
ALTER TABLE `tbl_cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `tbl_configuracion`
--
ALTER TABLE `tbl_configuracion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_cuenta`
--
ALTER TABLE `tbl_cuenta`
  ADD PRIMARY KEY (`id_cuenta`);

--
-- Indices de la tabla `tbl_detalle_transaccion`
--
ALTER TABLE `tbl_detalle_transaccion`
  ADD PRIMARY KEY (`id_detalle`);

--
-- Indices de la tabla `tbl_imagen`
--
ALTER TABLE `tbl_imagen`
  ADD PRIMARY KEY (`id_imagen`);

--
-- Indices de la tabla `tbl_producto`
--
ALTER TABLE `tbl_producto`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `tbl_transaccion`
--
ALTER TABLE `tbl_transaccion`
  ADD PRIMARY KEY (`id_transaccion`);

--
-- Indices de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_categoria`
--
ALTER TABLE `tbl_categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `tbl_cliente`
--
ALTER TABLE `tbl_cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tbl_cuenta`
--
ALTER TABLE `tbl_cuenta`
  MODIFY `id_cuenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_detalle_transaccion`
--
ALTER TABLE `tbl_detalle_transaccion`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `tbl_imagen`
--
ALTER TABLE `tbl_imagen`
  MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `tbl_producto`
--
ALTER TABLE `tbl_producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `tbl_transaccion`
--
ALTER TABLE `tbl_transaccion`
  MODIFY `id_transaccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
