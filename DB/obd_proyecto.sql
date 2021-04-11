-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-04-2021 a las 17:56:43
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `obd_proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `idContacto` int(25) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `primerApellido` varchar(50) DEFAULT NULL,
  `segundoApellido` varchar(50) DEFAULT NULL,
  `telefono` int(9) DEFAULT NULL,
  `nota` text DEFAULT NULL,
  `idEquipo` int(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contrato`
--

CREATE TABLE `contrato` (
  `idContrato` int(50) NOT NULL,
  `fechaInicio` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  `nombreDocumento` varchar(100) NOT NULL,
  `estado` enum('borrador','final') NOT NULL,
  `ruta` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE `equipo` (
  `idEquipo` int(25) NOT NULL,
  `nombre` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadistica`
--

CREATE TABLE `estadistica` (
  `idEstadistica` int(50) NOT NULL,
  `equipo` varchar(100) DEFAULT NULL,
  `nombreLiga` varchar(100) NOT NULL,
  `PPP` decimal(3,2) DEFAULT NULL,
  `APP` decimal(3,2) DEFAULT NULL,
  `RPP` decimal(3,2) DEFAULT NULL,
  `%2P` decimal(3,2) DEFAULT NULL,
  `%3P` decimal(3,2) DEFAULT NULL,
  `MIN` int(2) DEFAULT NULL,
  `%TL` decimal(3,2) DEFAULT NULL,
  `ROB` decimal(3,2) DEFAULT NULL,
  `TAP` decimal(3,2) DEFAULT NULL,
  `temporada` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formulariocontacto`
--

CREATE TABLE `formulariocontacto` (
  `idFormulario` int(50) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correoElectronico` varchar(320) NOT NULL,
  `asunto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE `imagen` (
  `idImagen` int(50) NOT NULL,
  `tipo` enum('principal','galeria') NOT NULL,
  `ruta` varchar(255) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `alt` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugador`
--

CREATE TABLE `jugador` (
  `idJugador` int(25) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `primerApellido` varchar(50) NOT NULL,
  `segundoApellido` varchar(50) DEFAULT NULL,
  `altura` int(3) DEFAULT NULL,
  `extracomunitario` tinyint(1) DEFAULT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `telefono` int(6) DEFAULT NULL,
  `estado` enum('disponible','fichado') NOT NULL,
  `biografia` text DEFAULT NULL,
  `informe` text DEFAULT NULL,
  `idEquipo` int(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores_contratos`
--

CREATE TABLE `jugadores_contratos` (
  `idJugador` int(25) NOT NULL,
  `idContrato` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores_estadisticas`
--

CREATE TABLE `jugadores_estadisticas` (
  `idJugador` int(25) NOT NULL,
  `idEstadistica` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores_imagenes`
--

CREATE TABLE `jugadores_imagenes` (
  `idJugador` int(25) NOT NULL,
  `idImagen` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores_nacionalidades`
--

CREATE TABLE `jugadores_nacionalidades` (
  `idJugador` int(25) NOT NULL,
  `idNacionalidad` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores_posiciones`
--

CREATE TABLE `jugadores_posiciones` (
  `idJugador` int(25) NOT NULL,
  `idPosicion` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores_videos`
--

CREATE TABLE `jugadores_videos` (
  `idJugador` int(25) NOT NULL,
  `idVideo` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nacionalidad`
--

CREATE TABLE `nacionalidad` (
  `idNacionalidad` int(25) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posicion`
--

CREATE TABLE `posicion` (
  `idPosicion` int(1) NOT NULL,
  `nombre` enum('Base','Escolta','Alero','Ala-Pivot','Pivot') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idRol` int(20) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idRol`, `nombre`) VALUES
(1, 'administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `primerApellido` varchar(50) DEFAULT NULL,
  `segundoApellido` varchar(50) DEFAULT NULL,
  `telefono` int(9) DEFAULT NULL,
  `correoElectronico` varchar(320) NOT NULL,
  `contraseña` varchar(25) NOT NULL,
  `usuario` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombre`, `primerApellido`, `segundoApellido`, `telefono`, `correoElectronico`, `contraseña`, `usuario`) VALUES
(1, 'sandra', NULL, NULL, NULL, 'sandraguerreror1995@gmail.com', 'e8dc8ccd5e5f9e3a54f07350c', 'OBD_Sandra');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_roles`
--

CREATE TABLE `usuarios_roles` (
  `idUsuario` int(20) NOT NULL,
  `idRol` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios_roles`
--

INSERT INTO `usuarios_roles` (`idUsuario`, `idRol`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `video`
--

CREATE TABLE `video` (
  `idVideo` int(50) NOT NULL,
  `tipoVideo` enum('highlight','partido') NOT NULL,
  `ruta` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`idContacto`),
  ADD KEY `idEquipo` (`idEquipo`);

--
-- Indices de la tabla `contrato`
--
ALTER TABLE `contrato`
  ADD PRIMARY KEY (`idContrato`);

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`idEquipo`);

--
-- Indices de la tabla `estadistica`
--
ALTER TABLE `estadistica`
  ADD PRIMARY KEY (`idEstadistica`);

--
-- Indices de la tabla `formulariocontacto`
--
ALTER TABLE `formulariocontacto`
  ADD PRIMARY KEY (`idFormulario`);

--
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD PRIMARY KEY (`idImagen`);

--
-- Indices de la tabla `jugador`
--
ALTER TABLE `jugador`
  ADD PRIMARY KEY (`idJugador`),
  ADD KEY `idEquipo` (`idEquipo`);

--
-- Indices de la tabla `jugadores_contratos`
--
ALTER TABLE `jugadores_contratos`
  ADD PRIMARY KEY (`idJugador`,`idContrato`),
  ADD KEY `idContrato` (`idContrato`);

--
-- Indices de la tabla `jugadores_estadisticas`
--
ALTER TABLE `jugadores_estadisticas`
  ADD PRIMARY KEY (`idJugador`,`idEstadistica`),
  ADD KEY `idEstadistica` (`idEstadistica`);

--
-- Indices de la tabla `jugadores_imagenes`
--
ALTER TABLE `jugadores_imagenes`
  ADD PRIMARY KEY (`idJugador`,`idImagen`),
  ADD KEY `idImagen` (`idImagen`);

--
-- Indices de la tabla `jugadores_nacionalidades`
--
ALTER TABLE `jugadores_nacionalidades`
  ADD PRIMARY KEY (`idJugador`,`idNacionalidad`),
  ADD KEY `idNacionalidad` (`idNacionalidad`);

--
-- Indices de la tabla `jugadores_posiciones`
--
ALTER TABLE `jugadores_posiciones`
  ADD PRIMARY KEY (`idJugador`,`idPosicion`),
  ADD KEY `idPosicion` (`idPosicion`);

--
-- Indices de la tabla `jugadores_videos`
--
ALTER TABLE `jugadores_videos`
  ADD KEY `idJugador` (`idJugador`),
  ADD KEY `idVideo` (`idVideo`);

--
-- Indices de la tabla `nacionalidad`
--
ALTER TABLE `nacionalidad`
  ADD PRIMARY KEY (`idNacionalidad`);

--
-- Indices de la tabla `posicion`
--
ALTER TABLE `posicion`
  ADD PRIMARY KEY (`idPosicion`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Indices de la tabla `usuarios_roles`
--
ALTER TABLE `usuarios_roles`
  ADD PRIMARY KEY (`idUsuario`,`idRol`),
  ADD KEY `idRol` (`idRol`);

--
-- Indices de la tabla `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`idVideo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `idContacto` int(25) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contrato`
--
ALTER TABLE `contrato`
  MODIFY `idContrato` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `idEquipo` int(25) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estadistica`
--
ALTER TABLE `estadistica`
  MODIFY `idEstadistica` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `formulariocontacto`
--
ALTER TABLE `formulariocontacto`
  MODIFY `idFormulario` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
  MODIFY `idImagen` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jugador`
--
ALTER TABLE `jugador`
  MODIFY `idJugador` int(25) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `nacionalidad`
--
ALTER TABLE `nacionalidad`
  MODIFY `idNacionalidad` int(25) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `posicion`
--
ALTER TABLE `posicion`
  MODIFY `idPosicion` int(1) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idRol` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `video`
--
ALTER TABLE `video`
  MODIFY `idVideo` int(50) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD CONSTRAINT `contacto_ibfk_1` FOREIGN KEY (`idEquipo`) REFERENCES `equipo` (`idEquipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `jugador`
--
ALTER TABLE `jugador`
  ADD CONSTRAINT `jugador_ibfk_1` FOREIGN KEY (`idEquipo`) REFERENCES `equipo` (`idEquipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `jugadores_contratos`
--
ALTER TABLE `jugadores_contratos`
  ADD CONSTRAINT `jugadores_contratos_ibfk_1` FOREIGN KEY (`idContrato`) REFERENCES `contrato` (`idContrato`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jugadores_contratos_ibfk_2` FOREIGN KEY (`idJugador`) REFERENCES `jugador` (`idJugador`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `jugadores_estadisticas`
--
ALTER TABLE `jugadores_estadisticas`
  ADD CONSTRAINT `jugadores_estadisticas_ibfk_1` FOREIGN KEY (`idEstadistica`) REFERENCES `estadistica` (`idEstadistica`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jugadores_estadisticas_ibfk_2` FOREIGN KEY (`idJugador`) REFERENCES `jugador` (`idJugador`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `jugadores_imagenes`
--
ALTER TABLE `jugadores_imagenes`
  ADD CONSTRAINT `jugadores_imagenes_ibfk_1` FOREIGN KEY (`idJugador`) REFERENCES `jugador` (`idJugador`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jugadores_imagenes_ibfk_2` FOREIGN KEY (`idImagen`) REFERENCES `imagen` (`idImagen`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `jugadores_nacionalidades`
--
ALTER TABLE `jugadores_nacionalidades`
  ADD CONSTRAINT `jugadores_nacionalidades_ibfk_1` FOREIGN KEY (`idJugador`) REFERENCES `jugador` (`idJugador`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jugadores_nacionalidades_ibfk_2` FOREIGN KEY (`idNacionalidad`) REFERENCES `nacionalidad` (`idNacionalidad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `jugadores_posiciones`
--
ALTER TABLE `jugadores_posiciones`
  ADD CONSTRAINT `jugadores_posiciones_ibfk_1` FOREIGN KEY (`idJugador`) REFERENCES `jugador` (`idJugador`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jugadores_posiciones_ibfk_2` FOREIGN KEY (`idPosicion`) REFERENCES `posicion` (`idPosicion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `jugadores_videos`
--
ALTER TABLE `jugadores_videos`
  ADD CONSTRAINT `jugadores_videos_ibfk_1` FOREIGN KEY (`idJugador`) REFERENCES `jugador` (`idJugador`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jugadores_videos_ibfk_2` FOREIGN KEY (`idVideo`) REFERENCES `video` (`idVideo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios_roles`
--
ALTER TABLE `usuarios_roles`
  ADD CONSTRAINT `usuarios_roles_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `rol` (`idRol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_roles_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
