-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-10-2023 a las 19:28:44
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
-- Base de datos: `db_ies_contreras`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_profesores`
--

CREATE DATABASE 'db_ies_contreras';
USE 'db_ies_contreras';

CREATE TABLE `tbl_profesores` (
  `id` int(11) NOT NULL,
  `nombre_profe` varchar(45) NOT NULL,
  `contra_profe` varchar(450) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_profesores`
--

INSERT INTO `tbl_profesores` (`id`, `nombre_profe`, `contra_profe`) VALUES
(1, 'Alberto', '7a9a93a93e4f3824b7be8f9acd43894f76b2776e4c33bbb5eb1cf1ba4beaaf01'),
(2, 'admin', '15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_profesores`
--
ALTER TABLE `tbl_profesores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_profesores`
--
ALTER TABLE `tbl_profesores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
