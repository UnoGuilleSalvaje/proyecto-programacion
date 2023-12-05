-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-12-2023 a las 03:32:17
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
-- Base de datos: `baseinventario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `artista` varchar(100) NOT NULL,
  `hashed_password` varchar(255) NOT NULL,
  `rol` varchar(20) NOT NULL DEFAULT 'user',
  `intentos_fallidos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `username`, `email`, `artista`, `hashed_password`, `rol`, `intentos_fallidos`) VALUES
(2, 'Lalo', 'Garcia', 'Tamal079', 'trestamal@gmail.com', 'Deorro', '$2y$10$7SbQMGPwB8gtbZ7if91PLuOAtvt5OGFupwInttsl47wRpu5rsEBSW', 'user', 0),
(3, 'Oaxaco', 'Castellanos', 'Tamal_rojo', 'Oaxaco@gmail.com', 'Molotov', '$2y$10$oCJr14mPEsKSVGIDxV1hE.gF5bsulE3m2TsITdQi.77M0J0ezcmmO', 'user', 0),
(5, 'Coca', 'Cola', 'Navidad', 'navidad@gmail.com', 'Santa', '$2y$10$X4x7hrUcNsCsin2IMb9QTeg87kwfDJ7wiQYlb3f5g5RsNwf.10taS', 'user', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
