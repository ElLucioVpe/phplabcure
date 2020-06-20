-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-06-2020 a las 01:25:45
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `memmet`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `meme`
--

CREATE TABLE `meme` (
  `idMeme` int(11) NOT NULL,
  `tituloMeme` varchar(300) NOT NULL,
  `fechaMeme` datetime DEFAULT NULL,
  `rutaMeme` varchar(500) DEFAULT NULL,
  `User_correoUser` varchar(320) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `meme`
--

INSERT INTO `meme` (`idMeme`, `tituloMeme`, `fechaMeme`, `rutaMeme`, `User_correoUser`) VALUES
(1, 'Jojo', '2020-05-22 00:00:00', '2020-05-22 04-56-44estebanleivas103-gmail-com.png', 'estebanleivas103@gmail.com'),
(3, 'MemeTest1', '2020-06-19 21:58:38', '2020-06-19 21-58-38test-test-com.png', 'test@test.com'),
(4, 'MemeTest2', '2020-06-19 21:59:24', '2020-06-19 21-59-24test-test-com.png', 'test@test.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntuacion`
--

CREATE TABLE `puntuacion` (
  `User_correoUser` varchar(320) NOT NULL,
  `Meme_idMeme` int(11) NOT NULL,
  `valorPuntuacion` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `puntuacion`
--

INSERT INTO `puntuacion` (`User_correoUser`, `Meme_idMeme`, `valorPuntuacion`) VALUES
('test@test.com', 3, 1),
('test@test.com', 1, 1),
('test@test.com', 4, 1),
('test2@test.com', 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suscripcion`
--

CREATE TABLE `suscripcion` (
  `User_correoUser` varchar(320) NOT NULL,
  `Tag_nombreTag` varchar(230) NOT NULL,
  `ignora` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `suscripcion`
--

INSERT INTO `suscripcion` (`User_correoUser`, `Tag_nombreTag`, `ignora`) VALUES
('estebanleivas103@gmail.com', 'videojuegos', 0),
('test2@test.com', 'tas loco estos varchar son re locos no se que escribir para llenar este tag pero bueno hay que usar bien lo que tenemos, aprovechar, me entendes.', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tag`
--

CREATE TABLE `tag` (
  `nombreTag` varchar(320) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tag`
--

INSERT INTO `tag` (`nombreTag`) VALUES
('tag_Creado2'),
('tas loco estos varchar son re locos no se que escribir para llenar este tag pero bueno hay que usar bien lo que tenemos, aprovechar, me entendes.'),
('videojuegos'),
('warframe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tag_has_meme`
--

CREATE TABLE `tag_has_meme` (
  `Tag_nombreTag` varchar(320) NOT NULL,
  `Meme_idMeme` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tag_has_meme`
--

INSERT INTO `tag_has_meme` (`Tag_nombreTag`, `Meme_idMeme`) VALUES
('tag_Creado2', 3),
('tag_Creado2', 4),
('tas loco estos varchar son re locos no se que escribir para llenar este tag pero bueno hay que usar bien lo que tenemos, aprovechar, me entendes.', 3),
('tas loco estos varchar son re locos no se que escribir para llenar este tag pero bueno hay que usar bien lo que tenemos, aprovechar, me entendes.', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `correoUser` varchar(320) NOT NULL,
  `nickUser` varchar(45) NOT NULL,
  `passwordUser` varchar(200) DEFAULT NULL,
  `tipoUser` varchar(10) DEFAULT NULL,
  `experienciaUser` int(11) DEFAULT 0,
  `avatarUser` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`correoUser`, `nickUser`, `passwordUser`, `tipoUser`, `experienciaUser`, `avatarUser`) VALUES
('estebanleivas103@gmail.com', 'esteby', 'lpmconesto', 'Admin', 55, 'ninguno.png'),
('estonoesuntest@notest.com', 'No testeador', '$2y$10$M8j4ONwWkAE5CZtw9zYlvOahqckkCNyGQQGtepYTCLic9ZeoTFKy6', 'Usuario', 0, 'estonoesuntest@notest.com.png'),
('test2@test.com', 'Testeador2', '$2y$10$Qtc92r61ju9I2A0xDzWiB.411Jk5VhdHgiIe2fHj0yXrZkl0ILveW', 'normy', 0, 'ninguno.png'),
('test3@test.com', 'Testeador3', '$2y$10$2jpL4GCX.kC9nM7VNSQR7.lDacULcRcNsWRSOPc9HV11odEEiPKbu', 'normy', 0, 'ninguno.png'),
('test@test.com', 'Testeador', '$2y$10$WKH9KDkRItQCM4GeKyy1Z.reyxjb60xuGp0yPtvhmggkqE371p0Wy', 'normy', 65, 'test@test.com.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `meme`
--
ALTER TABLE `meme`
  ADD PRIMARY KEY (`idMeme`),
  ADD KEY `fk_Meme_User_idx` (`User_correoUser`);

--
-- Indices de la tabla `puntuacion`
--
ALTER TABLE `puntuacion`
  ADD KEY `fk_Puntuacion_User1_idx` (`User_correoUser`),
  ADD KEY `fk_Puntuacion_Meme1_idx` (`Meme_idMeme`);

--
-- Indices de la tabla `suscripcion`
--
ALTER TABLE `suscripcion`
  ADD PRIMARY KEY (`User_correoUser`,`Tag_nombreTag`),
  ADD KEY `fk_Ignorados_User1_idx` (`User_correoUser`),
  ADD KEY `fk_Ignorados_Tag1_idx` (`Tag_nombreTag`);

--
-- Indices de la tabla `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`nombreTag`);

--
-- Indices de la tabla `tag_has_meme`
--
ALTER TABLE `tag_has_meme`
  ADD PRIMARY KEY (`Tag_nombreTag`,`Meme_idMeme`),
  ADD KEY `fk_Tag_has_Meme_Meme1_idx` (`Meme_idMeme`),
  ADD KEY `fk_Tag_has_Meme_Tag1_idx` (`Tag_nombreTag`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`correoUser`),
  ADD UNIQUE KEY `nickUser_UNIQUE` (`nickUser`),
  ADD UNIQUE KEY `correoUser_UNIQUE` (`correoUser`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `meme`
--
ALTER TABLE `meme`
  MODIFY `idMeme` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `meme`
--
ALTER TABLE `meme`
  ADD CONSTRAINT `fk_Meme_User` FOREIGN KEY (`User_correoUser`) REFERENCES `user` (`correoUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `puntuacion`
--
ALTER TABLE `puntuacion`
  ADD CONSTRAINT `fk_Puntuacion_Meme1` FOREIGN KEY (`Meme_idMeme`) REFERENCES `meme` (`idMeme`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Puntuacion_User1` FOREIGN KEY (`User_correoUser`) REFERENCES `user` (`correoUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `suscripcion`
--
ALTER TABLE `suscripcion`
  ADD CONSTRAINT `fk_Ignorados_Tag1` FOREIGN KEY (`Tag_nombreTag`) REFERENCES `tag` (`nombreTag`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Ignorados_User1` FOREIGN KEY (`User_correoUser`) REFERENCES `user` (`correoUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tag_has_meme`
--
ALTER TABLE `tag_has_meme`
  ADD CONSTRAINT `fk_Tag_has_Meme_Meme1` FOREIGN KEY (`Meme_idMeme`) REFERENCES `meme` (`idMeme`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Tag_has_Meme_Tag1` FOREIGN KEY (`Tag_nombreTag`) REFERENCES `tag` (`nombreTag`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
