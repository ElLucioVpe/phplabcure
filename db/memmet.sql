-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-06-2020 a las 22:31:31
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
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `commenter_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commenter_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guest_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guest_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commentable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentable_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT 1,
  `child_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`id`, `commenter_id`, `commenter_type`, `guest_name`, `guest_email`, `commentable_type`, `commentable_id`, `comment`, `approved`, `child_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'estonoesuntest@notest.com', 'App\\User', NULL, NULL, 'App\\Meme', '6', 'ez rewards', 1, NULL, '2020-06-24 05:14:52', '2020-06-21 06:38:24', '2020-06-24 05:14:52'),
(2, NULL, NULL, '123', '123@123', 'App\\Meme', '1', '123', 1, NULL, NULL, '2020-06-26 01:50:54', '2020-06-26 01:50:54'),
(3, 'admin@admins.com', 'App\\User', NULL, NULL, 'App\\Meme', '1', '456', 1, 2, NULL, '2020-06-29 06:20:54', '2020-06-29 06:20:54'),
(4, 'admin@admins.com', 'App\\User', NULL, NULL, 'App\\Meme', '1', 'test', 1, NULL, NULL, '2020-06-29 06:22:12', '2020-06-29 06:22:12'),
(5, 'admin@admins.com', 'App\\User', NULL, NULL, 'App\\Meme', '1', 'test2', 1, NULL, NULL, '2020-06-29 06:22:20', '2020-06-29 06:22:20');

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
(1, 'Jojo Edited', '2020-05-22 00:00:00', '2020-05-22 04-56-44admin@admins.com.png', 'admin@admins.com'),
(3, 'MemeTest1', '2020-06-19 21:58:38', '2020-06-19 21-58-38test-test-com.png', 'test@test.com'),
(4, 'MemeTest2', '2020-06-19 21:59:24', '2020-06-19 21-59-24test-test-com.png', 'test@test.com'),
(7, 'wf', '2020-06-29 18:06:58', '2020-06-29 18-06-58admin-admins-com.png', 'admin@admins.com'),
(8, 'titulo', '2020-06-29 15:12:07', '2020-06-29 15-12-07admin-admins-com.png', 'admin@admins.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2018_06_30_113500_create_comments_table', 1),
(2, '2020_05_15_034924_create_momins_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `momins`
--

CREATE TABLE `momins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('test2@test.com', 4, 1),
('estonoesuntest@notest.com', 1, 1),
('estonoesuntest@notest.com', 3, 1),
('admin@admins.com', 7, 1),
('admin@admins.com', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recompensa`
--

CREATE TABLE `recompensa` (
  `id` int(11) NOT NULL,
  `nivel` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `contenido` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `recompensa`
--

INSERT INTO `recompensa` (`id`, `nivel`, `tipo`, `contenido`) VALUES
(1, 10, 'Titulo', 'Novato'),
(2, 20, 'Titulo', 'Experimentado'),
(3, 40, 'Medalla', '<span class=\"badge badge-pill badge-secondary\"><i class=\"fa fa-angle-double-down\"></i>Veterano</span>'),
(4, 50, 'Titulo', 'Sabio'),
(5, 90, 'Medalla', '<span class=\"badge badge-pill badge-warning\"><i class=\"fa fa-chess-king\"></i>Rey</span>'),
(6, 100, 'Titulo', 'Meme Lord');

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
('admin@admins.com', 'jojo', 0),
('admin@admins.com', 'tas loco estos varchar son re locos no se que escribir para llenar este tag pero bueno hay que usar bien lo que tenemos, aprovechar, me entendes.', 1),
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
('interesting'),
('jojo'),
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
('jojo', 1),
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
('admin@admins.com', 'Admin', '$2y$12$g1XJAsCpw9gJn27wUZJh/.akeq1FQ5EHjj9nPvpxYloHQmVEs82Xi', 'Admin', 100000109, 'admin@admins.com.png'),
('estonoesuntest@notest.com', 'No testeador', '$2y$12$g1XJAsCpw9gJn27wUZJh/.akeq1FQ5EHjj9nPvpxYloHQmVEs82Xi', 'Usuario', 50, 'estonoesuntest@notest.com.png'),
('test2@test.com', 'Testeador2', '$2y$10$Qtc92r61ju9I2A0xDzWiB.411Jk5VhdHgiIe2fHj0yXrZkl0ILveW', 'Usuario', 0, 'ninguno.png'),
('test3@test.com', 'Testeador3', '$2y$10$2jpL4GCX.kC9nM7VNSQR7.lDacULcRcNsWRSOPc9HV11odEEiPKbu', 'Usuario', 0, 'ninguno.png'),
('test@test.com', 'Nuevo Testeador', '$2y$12$g1XJAsCpw9gJn27wUZJh/.akeq1FQ5EHjj9nPvpxYloHQmVEs82Xi', 'Usuario', 75, 'test@test.com.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_has_recompensas`
--

CREATE TABLE `user_has_recompensas` (
  `correoUser` varchar(320) CHARACTER SET utf8 NOT NULL,
  `idRecompensa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `user_has_recompensas`
--

INSERT INTO `user_has_recompensas` (`correoUser`, `idRecompensa`) VALUES
('admin@admins.com', 1),
('admin@admins.com', 2),
('admin@admins.com', 3),
('admin@admins.com', 4),
('admin@admins.com', 5),
('admin@admins.com', 6),
('estonoesuntest@notest.com', 4),
('test@test.com', 4),
('test@test.com', 6);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_commenter_id_commenter_type_index` (`commenter_id`,`commenter_type`),
  ADD KEY `comments_commentable_type_commentable_id_index` (`commentable_type`,`commentable_id`),
  ADD KEY `comments_child_id_foreign` (`child_id`);

--
-- Indices de la tabla `meme`
--
ALTER TABLE `meme`
  ADD PRIMARY KEY (`idMeme`),
  ADD KEY `fk_Meme_User_idx` (`User_correoUser`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `momins`
--
ALTER TABLE `momins`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `puntuacion`
--
ALTER TABLE `puntuacion`
  ADD KEY `fk_Puntuacion_User1_idx` (`User_correoUser`),
  ADD KEY `fk_Puntuacion_Meme1_idx` (`Meme_idMeme`);

--
-- Indices de la tabla `recompensa`
--
ALTER TABLE `recompensa`
  ADD PRIMARY KEY (`id`);

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
-- Indices de la tabla `user_has_recompensas`
--
ALTER TABLE `user_has_recompensas`
  ADD PRIMARY KEY (`correoUser`,`idRecompensa`) USING BTREE,
  ADD KEY `idRecompensa` (`idRecompensa`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `meme`
--
ALTER TABLE `meme`
  MODIFY `idMeme` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `momins`
--
ALTER TABLE `momins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `recompensa`
--
ALTER TABLE `recompensa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_child_id_foreign` FOREIGN KEY (`child_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE;

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

--
-- Filtros para la tabla `user_has_recompensas`
--
ALTER TABLE `user_has_recompensas`
  ADD CONSTRAINT `user_has_recompensas_ibfk_1` FOREIGN KEY (`correoUser`) REFERENCES `user` (`correoUser`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_has_recompensas_ibfk_2` FOREIGN KEY (`idRecompensa`) REFERENCES `recompensa` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
