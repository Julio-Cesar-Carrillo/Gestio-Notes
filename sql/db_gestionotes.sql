-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-11-2023 a las 20:06:46
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_gestionotes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_administradores`
--

CREATE TABLE `tbl_administradores` (
  `id` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_administradores`
--

INSERT INTO `tbl_administradores` (`id`, `email`, `pass`) VALUES
(1, 'oscar@contreras.com', 'qweQWE123'),
(2, 'iker@contreras.com', 'qweQWE123'),
(3, 'julio@contreras.com', 'qweQWE123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_alumnos`
--

CREATE TABLE `tbl_alumnos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_alumnos`
--

INSERT INTO `tbl_alumnos` (`id`, `nombre`, `apellido`, `email`, `pass`, `telefono`, `id_curso`) VALUES
(1, 'Juan', 'García', 'juan@contreras.com', 'qweQWE123', '123456789', 1),
(2, 'María', 'López', 'maria@contreras.com', 'qweQWE123', '987654321', 2),
(3, 'Pedro', 'Martínez', 'pedro@contreras.com', 'qweQWE123', '564738291', 3),
(4, 'Laura', 'Fernández', 'laura@contreras.com', 'qweQWE123', '192837465', 4),
(5, 'Carlos', 'Pérez', 'carlos@contreras.com', 'qweQWE123', '293847165', 5),
(6, 'Ana', 'Ramírez', 'ana@contreras.com', 'qweQWE123', '384927165', 1),
(7, 'José', 'Gómez', 'jose@contreras.com', 'qweQWE123', '123487692', 2),
(8, 'Sofía', 'Díaz', 'sofia@contreras.com', 'qweQWE123', '567823491', 3),
(9, 'Miguel', 'Hernández', 'miguel@contreras.com', 'qweQWE123', '987165432', 4),
(10, 'Lucía', 'Torres', 'lucia@contreras.com', 'qweQWE123', '218746935', 5),
(11, 'David', 'Vargas', 'david@contreras.com', 'qweQWE123', '394817625', 1),
(12, 'Elena', 'Sánchez', 'elena@contreras.com', 'qweQWE123', '238746591', 2),
(13, 'Luis', 'Molina', 'luis@contreras.com', 'qweQWE123', '947216538', 3),
(14, 'Carmen', 'Ortega', 'carmen@contreras.com', 'qweQWE123', '284731965', 4),
(15, 'Pablo', 'Jiménez', 'pablo@contreras.com', 'qweQWE123', '672934851', 5),
(16, 'Isabel', 'Reyes', 'isabel@contreras.com', 'qweQWE123', '384965172', 1),
(17, 'Javier', 'Mendoza', 'javier@contreras.com', 'qweQWE123', '493716582', 2),
(18, 'Raquel', 'Guerrero', 'raquel@contreras.com', 'qweQWE123', '192847365', 3),
(19, 'Diego', 'Vega', 'diego@contreras.com', 'qweQWE123', '284765139', 4),
(20, 'Paula', 'Campos', 'paula@contreras.com', 'qweQWE123', '129473856', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_asignaturas`
--

CREATE TABLE `tbl_asignaturas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `id_profesor` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_asignaturas`
--

INSERT INTO `tbl_asignaturas` (`id`, `nombre`, `id_profesor`, `id_curso`) VALUES
(1, 'Matemáticas Avanzadas', 1, 1),
(2, 'Historia del Mundo', 2, 1),
(3, 'Literatura Universal', 3, 1),
(4, 'Biología y Ecología', 4, 2),
(5, 'Física Aplicada', 5, 2),
(6, 'Química Orgánica', 1, 2),
(7, 'Gramática Española', 2, 3),
(8, 'Redacción Creativa', 3, 3),
(9, 'Oratoria y Debate', 4, 3),
(10, 'Astronomía', 5, 4),
(11, 'Educación Física Avanzada', 1, 4),
(12, 'Geografía Mundial', 2, 4),
(13, 'Educación Artística', 3, 5),
(14, 'Tecnología e Informática', 4, 5),
(15, 'Educación Cívica', 5, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cursos`
--

CREATE TABLE `tbl_cursos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_cursos`
--

INSERT INTO `tbl_cursos` (`id`, `nombre`) VALUES
(1, 'Matemáticas'),
(2, 'Historia'),
(3, 'Lengua Española'),
(4, 'Ciencias Naturales'),
(5, 'Educación Física');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_notas`
--

CREATE TABLE `tbl_notas` (
  `id` int(11) NOT NULL,
  `id_alumno` int(11) DEFAULT NULL,
  `id_asignatura` int(11) DEFAULT NULL,
  `nota` decimal(4,2) DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_notas`
--

INSERT INTO `tbl_notas` (`id`, `id_alumno`, `id_asignatura`, `nota`, `fecha_registro`) VALUES
(1, 1, 1, '8.50', '2023-11-09'),
(2, 1, 2, '7.20', '2023-11-10'),
(3, 1, 3, '6.80', '2023-11-11'),
(4, 2, 1, '9.20', '2023-11-09'),
(5, 2, 2, '4.80', '2023-11-10'),
(6, 2, 3, '4.00', '2023-11-11'),
(7, 3, 1, '4.00', '2023-11-09'),
(8, 3, 2, '4.50', '2023-11-10'),
(9, 3, 3, '7.20', '2023-11-11'),
(10, 4, 1, '8.70', '2023-11-09'),
(11, 4, 2, '10.50', '2023-11-10'),
(12, 4, 3, '3.30', '2023-11-11'),
(13, 5, 1, '10.00', '2023-11-09'),
(14, 5, 2, '7.00', '2023-11-10'),
(15, 5, 3, '8.50', '2023-11-11'),
(16, 6, 1, '8.80', '2023-11-09'),
(17, 6, 2, '7.40', '2023-11-10'),
(18, 6, 3, '8.20', '2023-11-11'),
(19, 7, 1, '7.50', '2023-11-09'),
(20, 7, 2, '3.90', '2023-11-10'),
(21, 7, 3, '7.00', '2023-11-11'),
(22, 8, 1, '9.50', '2023-11-09'),
(23, 8, 2, '0.70', '2023-11-10'),
(24, 8, 3, '8.80', '2023-11-11'),
(25, 9, 1, '5.00', '2023-11-09'),
(26, 9, 2, '7.50', '2023-11-10'),
(27, 9, 3, '7.20', '2023-11-11'),
(28, 10, 1, '8.50', '2023-11-09'),
(29, 10, 2, '0.20', '2023-11-10'),
(30, 10, 3, '7.80', '2023-11-11'),
(31, 11, 1, '1.80', '2023-11-12'),
(32, 11, 2, '0.50', '2023-11-13'),
(33, 11, 3, '2.00', '2023-11-14'),
(34, 12, 1, '8.20', '2023-11-12'),
(35, 12, 2, '3.00', '2023-11-13'),
(36, 12, 3, '9.50', '2023-11-14'),
(37, 13, 1, '6.10', '2023-11-12'),
(38, 13, 2, '5.30', '2023-11-13'),
(39, 13, 3, '5.20', '2023-11-14'),
(40, 14, 1, '7.00', '2023-11-12'),
(41, 14, 2, '8.00', '2023-11-13'),
(42, 14, 3, '7.50', '2023-11-14'),
(43, 15, 1, '8.50', '2023-11-12'),
(44, 15, 2, '7.70', '2023-11-13'),
(45, 15, 3, '8.90', '2023-11-14'),
(46, 16, 1, '8.00', '2023-11-16'),
(47, 16, 2, '7.50', '2023-11-17'),
(48, 16, 3, '9.20', '2023-11-18'),
(49, 17, 1, '4.20', '2023-11-16'),
(50, 17, 2, '4.60', '2023-11-17'),
(51, 17, 3, '7.80', '2023-11-18'),
(52, 18, 1, '2.50', '2023-11-16'),
(53, 18, 2, '1.20', '2023-11-17'),
(54, 18, 3, '3.00', '2023-11-18'),
(55, 19, 1, '7.80', '2023-11-16'),
(56, 19, 2, '9.00', '2023-11-17'),
(57, 19, 3, '0.00', '2023-11-18'),
(58, 20, 1, '8.30', '2023-11-16'),
(59, 20, 2, '9.90', '2023-11-17'),
(60, 20, 3, '1.10', '2023-11-18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_profesores`
--

CREATE TABLE `tbl_profesores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_profesores`
--

INSERT INTO `tbl_profesores` (`id`, `nombre`, `apellido`, `email`, `pass`, `id_curso`) VALUES
(1, 'Juan', 'García', 'juan.garcia@contreras.com', 'qweQWE123', 1),
(2, 'María', 'Martínez', 'maria.martinez@contreras.com', 'qweQWE123', 2),
(3, 'José', 'Rodríguez', 'jose.rodriguez@contreras.com', 'qweQWE123', 3),
(4, 'Ana', 'López', 'ana.lopez@contreras.com', 'qweQWE123', 4),
(5, 'Carlos', 'Pérez', 'carlos.perez@contreras.com', 'qweQWE123', 5),
(6, 'Laura', 'Gómez', 'laura.gomez@contreras.com', 'qweQWE123', 1),
(7, 'Javier', 'Fernández', 'javier.fernandez@contreras.com', 'qweQWE123', 2),
(8, 'Sandra', 'Díaz', 'sandra.diaz@contreras.com', 'qweQWE123', 3),
(9, 'Pablo', 'Martín', 'pablo.martin@contreras.com', 'qweQWE123', 4),
(10, 'Luis', 'Torres', 'luis.torres@contreras.com', 'qweQWE123', 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_administradores`
--
ALTER TABLE `tbl_administradores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_alumnos`
--
ALTER TABLE `tbl_alumnos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Indices de la tabla `tbl_asignaturas`
--
ALTER TABLE `tbl_asignaturas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_profesor` (`id_profesor`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Indices de la tabla `tbl_cursos`
--
ALTER TABLE `tbl_cursos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_notas`
--
ALTER TABLE `tbl_notas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_alumno` (`id_alumno`),
  ADD KEY `id_asignatura` (`id_asignatura`);

--
-- Indices de la tabla `tbl_profesores`
--
ALTER TABLE `tbl_profesores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_curso` (`id_curso`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_administradores`
--
ALTER TABLE `tbl_administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_alumnos`
--
ALTER TABLE `tbl_alumnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `tbl_asignaturas`
--
ALTER TABLE `tbl_asignaturas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `tbl_cursos`
--
ALTER TABLE `tbl_cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tbl_notas`
--
ALTER TABLE `tbl_notas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `tbl_profesores`
--
ALTER TABLE `tbl_profesores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_alumnos`
--
ALTER TABLE `tbl_alumnos`
  ADD CONSTRAINT `tbl_alumnos_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `tbl_cursos` (`id`);

--
-- Filtros para la tabla `tbl_asignaturas`
--
ALTER TABLE `tbl_asignaturas`
  ADD CONSTRAINT `tbl_asignaturas_ibfk_1` FOREIGN KEY (`id_profesor`) REFERENCES `tbl_profesores` (`id`),
  ADD CONSTRAINT `tbl_asignaturas_ibfk_2` FOREIGN KEY (`id_curso`) REFERENCES `tbl_cursos` (`id`);

--
-- Filtros para la tabla `tbl_notas`
--
ALTER TABLE `tbl_notas`
  ADD CONSTRAINT `tbl_notas_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `tbl_alumnos` (`id`),
  ADD CONSTRAINT `tbl_notas_ibfk_2` FOREIGN KEY (`id_asignatura`) REFERENCES `tbl_asignaturas` (`id`);

--
-- Filtros para la tabla `tbl_profesores`
--
ALTER TABLE `tbl_profesores`
  ADD CONSTRAINT `tbl_profesores_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `tbl_cursos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
