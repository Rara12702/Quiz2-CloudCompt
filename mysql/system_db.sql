-- phpMyAdmin SQL Dump


SET time_zone = "Europe/Madrid";

--
-- Database: `system_db`
--
-- --------------------------------------------------------
--
-- Table structure for table `Contacts`
--

CREATE TABLE `Contacts` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(255) NOT NULL,
  `SURNAME` varchar(255) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `PHONENUMBER` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `Contacts`
--

INSERT INTO `Contacts` (`ID`, `NAME`, `SURNAME`, `EMAIL`, `PHONENUMBER`) VALUES
(1, 'Alberto', 'Lasheras', 'alberto@gmail.com', '791-804-955'),
(2, 'Antonio', 'Toledo', 'antonio@dominio.com', '791-804-195'),
(3, 'Claudia', 'Monreal', 'claudia@yahoo.es', '791-804-196');


-- --------------------------------------------------------

--
-- Table structure for table `Admins`
--

CREATE TABLE `Admins` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(255) NOT NULL,
  `SURNAME` varchar(255) NOT NULL,
  `USERNAME` varchar(255) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `Admins`
--

INSERT INTO `Admins` (`ID`, `NAME`, `SURNAME`, `USERNAME`, `PASSWORD`, `EMAIL`) VALUES
(1, 'Nombre', 'Apellido', 'User', 'P4ssw0rd', 'info@tudominio.com');


-- --------------------------------------------------------

