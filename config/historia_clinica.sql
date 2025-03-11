-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-03-2025 a las 22:28:37
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
-- Base de datos: `historia_clinica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estratos`
--

CREATE TABLE `estratos` (
  `estr_id` int(11) NOT NULL,
  `estr_nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estratos`
--

INSERT INTO `estratos` (`estr_id`, `estr_nombre`) VALUES
(1, 'Estrato 1'),
(2, 'Estrato 2'),
(3, 'Estrato 3'),
(4, 'Estrato 4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--

CREATE TABLE `generos` (
  `gen_id` int(11) NOT NULL,
  `gen_nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `generos`
--

INSERT INTO `generos` (`gen_id`, `gen_nombre`) VALUES
(1, 'Masculino'),
(2, 'Femenino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historias`
--

CREATE TABLE `historias` (
  `hist_id` int(11) NOT NULL,
  `hist_motv` text DEFAULT NULL,
  `hist_esfod` varchar(50) NOT NULL,
  `hist_cilod` varchar(50) NOT NULL,
  `hist_ejeod` varchar(50) NOT NULL,
  `hist_esfoi` varchar(50) NOT NULL,
  `hist_ciloi` varchar(50) NOT NULL,
  `hist_ejeoi` varchar(50) NOT NULL,
  `hist_diaod` varchar(50) NOT NULL,
  `hist_diaoi` varchar(50) NOT NULL,
  `hist_recom` text DEFAULT NULL,
  `pac_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historias`
--

INSERT INTO `historias` (`hist_id`, `hist_motv`, `hist_esfod`, `hist_cilod`, `hist_ejeod`, `hist_esfoi`, `hist_ciloi`, `hist_ejeoi`, `hist_diaod`, `hist_diaoi`, `hist_recom`, `pac_id`) VALUES
(1, 'asdasd', 'asd', 'asdasd', 'asd', 'asd', 'asd', 'asd', 'asdas', 'asda', 'asdasd', 1005980123),
(2, 'asdasd', 'asd', 'asdasd', 'asd', 'asd', 'asd', 'asd', 'asdas', 'asda', 'asdasd', 1234234213),
(3, 'qwqwe', 'qweq', 'qweqw', 'qwe', 'weqwrf', 'eq', 'qw', 'afgas', 'df', 'asdfasdf', 1005980123),
(4, 'Paciente visita por enrojecimiento de ambos ojos', '-5.00', '-0.50', '180', '-4.00', '-0.25', '180', 'Astigmatismo leve', 'Sin patologia', 'Aplicar gotas 3 veces al día', 5678);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hobbies`
--

CREATE TABLE `hobbies` (
  `hob_id` int(11) NOT NULL,
  `hob_nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `hobbies`
--

INSERT INTO `hobbies` (`hob_id`, `hob_nombre`) VALUES
(1, 'Ir al cine'),
(2, 'Ir a la playa'),
(3, 'Salir a comer');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `pac_id` int(11) NOT NULL,
  `pac_nombre` varchar(50) NOT NULL,
  `pac_apellido` varchar(50) NOT NULL,
  `pac_correo` varchar(50) NOT NULL,
  `pac_direccion` varchar(70) NOT NULL,
  `pac_telefono` bigint(20) NOT NULL,
  `gen_id` int(11) NOT NULL,
  `estr_id` int(11) NOT NULL,
  `pac_estado` enum('activo','inactivo') NOT NULL DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`pac_id`, `pac_nombre`, `pac_apellido`, `pac_correo`, `pac_direccion`, `pac_telefono`, `gen_id`, `estr_id`, `pac_estado`) VALUES
(234, 'lolololo', '234', '234@gmal.com', '23413212', 234, 2, 4, 'activo'),
(345, '345', '345', '345@gmail.com', '345', 345, 2, 1, 'inactivo'),
(5678, 'Juan', 'Perez', 'JuanPerez@gmail.com', 'Calle 1 # 1-1', 3154071267, 1, 3, 'activo'),
(12334, '123', '123', '123@123.com', '123', 123, 2, 3, 'activo'),
(1005980123, 'Miguel', 'Lugo', 'example@example.com', '*************', 3128466492, 1, 2, 'activo'),
(1234234213, 'Carlos', 'Perez', 'example@example.com', 'Calle*******', 3122131233, 1, 4, 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente_hobbies`
--

CREATE TABLE `paciente_hobbies` (
  `pac_hob_id` int(11) NOT NULL,
  `pac_id` int(11) NOT NULL,
  `hob_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paciente_hobbies`
--

INSERT INTO `paciente_hobbies` (`pac_hob_id`, `pac_id`, `hob_id`) VALUES
(6, 12334, 2),
(7, 12334, 3),
(12, 1005980123, 3),
(13, 234, 1),
(14, 234, 3),
(15, 345, 1),
(16, 345, 2),
(17, 345, 3),
(18, 5678, 1),
(19, 5678, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `rol_id` int(11) NOT NULL,
  `rol_nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`rol_id`, `rol_nombre`) VALUES
(1, 'Administrador'),
(2, 'Optometra');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usu_id` int(11) NOT NULL,
  `usu_docum` int(11) NOT NULL,
  `usu_nombre` varchar(50) NOT NULL,
  `usu_apellido` varchar(50) NOT NULL,
  `usu_clave` varchar(20) NOT NULL,
  `rol_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usu_id`, `usu_docum`, `usu_nombre`, `usu_apellido`, `usu_clave`, `rol_id`) VALUES
(1, 123, 'Angel', 'Lugo', '123', 1),
(2, 456, '456', '456', '456', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `estratos`
--
ALTER TABLE `estratos`
  ADD PRIMARY KEY (`estr_id`);

--
-- Indices de la tabla `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`gen_id`);

--
-- Indices de la tabla `historias`
--
ALTER TABLE `historias`
  ADD PRIMARY KEY (`hist_id`),
  ADD KEY `pac_id` (`pac_id`);

--
-- Indices de la tabla `hobbies`
--
ALTER TABLE `hobbies`
  ADD PRIMARY KEY (`hob_id`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`pac_id`),
  ADD KEY `gen_id` (`gen_id`),
  ADD KEY `estr_id` (`estr_id`);

--
-- Indices de la tabla `paciente_hobbies`
--
ALTER TABLE `paciente_hobbies`
  ADD PRIMARY KEY (`pac_hob_id`),
  ADD KEY `pac_id` (`pac_id`),
  ADD KEY `hob_id` (`hob_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usu_id`),
  ADD UNIQUE KEY `usu_docum` (`usu_docum`),
  ADD KEY `rol_id` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estratos`
--
ALTER TABLE `estratos`
  MODIFY `estr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `generos`
--
ALTER TABLE `generos`
  MODIFY `gen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `historias`
--
ALTER TABLE `historias`
  MODIFY `hist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `hobbies`
--
ALTER TABLE `hobbies`
  MODIFY `hob_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `pac_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1234234215;

--
-- AUTO_INCREMENT de la tabla `paciente_hobbies`
--
ALTER TABLE `paciente_hobbies`
  MODIFY `pac_hob_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `rol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `historias`
--
ALTER TABLE `historias`
  ADD CONSTRAINT `historias_ibfk_1` FOREIGN KEY (`pac_id`) REFERENCES `pacientes` (`pac_id`);

--
-- Filtros para la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD CONSTRAINT `pacientes_ibfk_1` FOREIGN KEY (`gen_id`) REFERENCES `generos` (`gen_id`),
  ADD CONSTRAINT `pacientes_ibfk_2` FOREIGN KEY (`estr_id`) REFERENCES `estratos` (`estr_id`);

--
-- Filtros para la tabla `paciente_hobbies`
--
ALTER TABLE `paciente_hobbies`
  ADD CONSTRAINT `paciente_hobbies_ibfk_1` FOREIGN KEY (`pac_id`) REFERENCES `pacientes` (`pac_id`),
  ADD CONSTRAINT `paciente_hobbies_ibfk_2` FOREIGN KEY (`hob_id`) REFERENCES `hobbies` (`hob_id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`rol_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
