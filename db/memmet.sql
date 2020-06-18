-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2020 at 01:48 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `memmet`
--

-- --------------------------------------------------------

--
-- Table structure for table `meme`
--

CREATE TABLE `meme` (
  `idMeme` int(11) NOT NULL,
  `fechaMeme` varchar(45) DEFAULT NULL,
  `rutaMeme` varchar(500) DEFAULT NULL,
  `User_correoUser` varchar(320) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `meme`
--

INSERT INTO `meme` (`idMeme`, `fechaMeme`, `rutaMeme`, `User_correoUser`) VALUES
(1, '2020-05-22 04-56-44', '2020-05-22 04-56-44estebanleivas103-gmail-com.png', 'estebanleivas103@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `puntuacion`
--

CREATE TABLE `puntuacion` (
  `User_correoUser` varchar(320) NOT NULL,
  `Meme_idMeme` int(11) NOT NULL,
  `valorPuntuacion` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `suscripcion`
--

CREATE TABLE `suscripcion` (
  `User_correoUser` varchar(320) NOT NULL,
  `Tag_nombreTag` varchar(230) NOT NULL,
  `ignora` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `suscripcion`
--

INSERT INTO `suscripcion` (`User_correoUser`, `Tag_nombreTag`, `ignora`) VALUES
('estebanleivas103@gmail.com', 'videojuegos', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `nombreTag` varchar(320) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`nombreTag`) VALUES
('tas loco estos varchar son re locos no se que escribir para llenar este tag pero bueno hay que usar bien lo que tenemos, aprovechar, me entendes.'),
('videojuegos');

-- --------------------------------------------------------

--
-- Table structure for table `tag_has_meme`
--

CREATE TABLE `tag_has_meme` (
  `Tag_nombreTag` varchar(320) NOT NULL,
  `Meme_idMeme` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
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
-- Dumping data for table `user`
--

INSERT INTO `user` (`correoUser`, `nickUser`, `passwordUser`, `tipoUser`, `experienciaUser`, `avatarUser`) VALUES
('estebanleivas103@gmail.com', 'esteby', 'lpmconesto', 'Admin', 50, 'ninguno.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `meme`
--
ALTER TABLE `meme`
  ADD PRIMARY KEY (`idMeme`),
  ADD KEY `fk_Meme_User_idx` (`User_correoUser`);

--
-- Indexes for table `puntuacion`
--
ALTER TABLE `puntuacion`
  ADD KEY `fk_Puntuacion_User1_idx` (`User_correoUser`),
  ADD KEY `fk_Puntuacion_Meme1_idx` (`Meme_idMeme`);

--
-- Indexes for table `suscripcion`
--
ALTER TABLE `suscripcion`
  ADD PRIMARY KEY (`User_correoUser`,`Tag_nombreTag`),
  ADD KEY `fk_Ignorados_User1_idx` (`User_correoUser`),
  ADD KEY `fk_Ignorados_Tag1_idx` (`Tag_nombreTag`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`nombreTag`);

--
-- Indexes for table `tag_has_meme`
--
ALTER TABLE `tag_has_meme`
  ADD PRIMARY KEY (`Tag_nombreTag`,`Meme_idMeme`),
  ADD KEY `fk_Tag_has_Meme_Meme1_idx` (`Meme_idMeme`),
  ADD KEY `fk_Tag_has_Meme_Tag1_idx` (`Tag_nombreTag`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`correoUser`),
  ADD UNIQUE KEY `nickUser_UNIQUE` (`nickUser`),
  ADD UNIQUE KEY `correoUser_UNIQUE` (`correoUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `meme`
--
ALTER TABLE `meme`
  MODIFY `idMeme` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `meme`
--
ALTER TABLE `meme`
  ADD CONSTRAINT `fk_Meme_User` FOREIGN KEY (`User_correoUser`) REFERENCES `user` (`correoUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `puntuacion`
--
ALTER TABLE `puntuacion`
  ADD CONSTRAINT `fk_Puntuacion_Meme1` FOREIGN KEY (`Meme_idMeme`) REFERENCES `meme` (`idMeme`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Puntuacion_User1` FOREIGN KEY (`User_correoUser`) REFERENCES `user` (`correoUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `suscripcion`
--
ALTER TABLE `suscripcion`
  ADD CONSTRAINT `fk_Ignorados_Tag1` FOREIGN KEY (`Tag_nombreTag`) REFERENCES `tag` (`nombreTag`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Ignorados_User1` FOREIGN KEY (`User_correoUser`) REFERENCES `user` (`correoUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tag_has_meme`
--
ALTER TABLE `tag_has_meme`
  ADD CONSTRAINT `fk_Tag_has_Meme_Meme1` FOREIGN KEY (`Meme_idMeme`) REFERENCES `meme` (`idMeme`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Tag_has_Meme_Tag1` FOREIGN KEY (`Tag_nombreTag`) REFERENCES `tag` (`nombreTag`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
