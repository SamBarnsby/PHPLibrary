-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-07-2018 a las 12:39:56
-- Versión del servidor: 10.1.25-MariaDB
-- Versión de PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `library`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `author`
--

CREATE TABLE `author` (
  `ID` int(3) NOT NULL,
  `Name` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `author`
--

INSERT INTO `author` (`ID`, `Name`) VALUES
(1, 'John R.R. Tolkien'),
(2, 'George R. R. Martin'),
(3, 'J. K. Rowling'),
(4, 'Derek Landy');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `book`
--

CREATE TABLE `book` (
  `ISBN` varchar(13) COLLATE utf8_spanish_ci NOT NULL,
  `Name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Author` int(3) DEFAULT NULL,
  `Year` int(4) DEFAULT NULL,
  `Editorial` int(3) NOT NULL,
  `Language` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `Genre` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `book`
--

INSERT INTO `book` (`ISBN`, `Name`, `Author`, `Year`, `Editorial`, `Language`, `Genre`) VALUES
('343434343', 'A Game Of Thrones', 2, 1998, 1, 'English', 'Medieval'),
('5-1948-0501-0', 'Skulduggery Pleasant', 4, 2007, 3, 'English', 'Fantasy'),
('676767676', 'my book', 4, 2018, 3, 'english', 'action'),
('9-5698-2651-0', 'Harry Potter and the Phillosofer Stone', 3, 1997, 2, 'English', 'Adventure');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `book_copy`
--

CREATE TABLE `book_copy` (
  `ID` int(4) NOT NULL,
  `original_ISBN` varchar(13) COLLATE utf8_spanish_ci NOT NULL,
  `Name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Language` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `state` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `book_copy`
--

INSERT INTO `book_copy` (`ID`, `original_ISBN`, `Name`, `Language`, `state`) VALUES
(24, '343434343', 'Un Joc de Trons', 'Catalan', 'good'),
(25, '343434343', 'Un Juego de Tronos', 'Spanish', 'used'),
(26, '343434343', 'A Game of Thrones', 'English', 'good'),
(27, '9-5698-2651-0', 'Harry potter y la piedra filosofal', 'Spanish', 'bad'),
(29, '9-5698-2651-0', 'Harry potter y la piedra filosofal', 'Spanish', 'used'),
(30, '676767676', 'mi libro', 'spanish', 'bad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editorial`
--

CREATE TABLE `editorial` (
  `ID` int(3) NOT NULL,
  `Name` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `editorial`
--

INSERT INTO `editorial` (`ID`, `Name`) VALUES
(1, 'Pearson'),
(2, 'ThomsonReuters'),
(3, 'RELX Group'),
(4, 'Wolters Kluwer');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservation`
--

CREATE TABLE `reservation` (
  `ID` int(10) NOT NULL,
  `userID` int(5) NOT NULL,
  `bookID` int(4) NOT NULL,
  `DateReservation` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `PickUpDate` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `DateReturn` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `reservation`
--

INSERT INTO `reservation` (`ID`, `userID`, `bookID`, `DateReservation`, `PickUpDate`, `DateReturn`) VALUES
(58, 49, 24, '01-02-2018', '12-02-2018', '12-02-2018'),
(59, 49, 25, '20-01-2018', '21-01-2018', '12-02-2018'),
(60, 49, 30, '12-02-2018', NULL, NULL),
(61, 35, 24, '17-02-2013', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `ID` int(5) NOT NULL,
  `Name` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `Email` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `User_type` int(1) NOT NULL,
  `password` varchar(15) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`ID`, `Name`, `Email`, `User_type`, `password`) VALUES
(1, 'Sam', 'sambarnsby@gmail.com', 1, 'Dequa16.'),
(35, 'Shaq', 'bigshaq@gmail.com', 3, 'nothot'),
(36, 'Ander', 'alunaucete@gmail.com', 3, 'ander'),
(39, 'Antonio', 'totti619@gmail.com', 1, 'totti'),
(41, 'Jason', 'jasonluna@gmail.com', 2, 'jasonluna'),
(48, 'sepe', 'sepe@gmail.com', 2, 'sepe'),
(49, 'claire', 'claire@gmail.com', 3, 'Dequa16.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_type`
--

CREATE TABLE `user_type` (
  `ID` int(1) NOT NULL,
  `Name` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `user_type`
--

INSERT INTO `user_type` (`ID`, `Name`) VALUES
(1, 'Administrator'),
(2, 'Librarian'),
(3, 'User');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`ISBN`),
  ADD KEY `author_id` (`Author`),
  ADD KEY `editorialid_id` (`Editorial`);

--
-- Indices de la tabla `book_copy`
--
ALTER TABLE `book_copy`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `originalisbn_isbn` (`original_ISBN`);

--
-- Indices de la tabla `editorial`
--
ALTER TABLE `editorial`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`ID`,`bookID`),
  ADD KEY `bookid_id` (`bookID`),
  ADD KEY `userid_id` (`userID`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`,`Email`),
  ADD KEY `usertype_id` (`User_type`);

--
-- Indices de la tabla `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `author`
--
ALTER TABLE `author`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `book_copy`
--
ALTER TABLE `book_copy`
  MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT de la tabla `editorial`
--
ALTER TABLE `editorial`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `reservation`
--
ALTER TABLE `reservation`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT de la tabla `user_type`
--
ALTER TABLE `user_type`
  MODIFY `ID` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `author_id` FOREIGN KEY (`Author`) REFERENCES `author` (`ID`),
  ADD CONSTRAINT `editorialid_id` FOREIGN KEY (`Editorial`) REFERENCES `editorial` (`ID`);

--
-- Filtros para la tabla `book_copy`
--
ALTER TABLE `book_copy`
  ADD CONSTRAINT `originalisbn_isbn` FOREIGN KEY (`original_ISBN`) REFERENCES `book` (`ISBN`);

--
-- Filtros para la tabla `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `bookid_id` FOREIGN KEY (`bookID`) REFERENCES `book_copy` (`ID`),
  ADD CONSTRAINT `userid_id` FOREIGN KEY (`userID`) REFERENCES `user` (`ID`);

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `usertype_id` FOREIGN KEY (`User_type`) REFERENCES `user_type` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
