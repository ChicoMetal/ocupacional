-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 31-07-2012 a las 16:21:12
-- Versión del servidor: 5.0.95
-- Versión de PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `ottsinc_motosob`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Clientes`
--

CREATE TABLE IF NOT EXISTS `Clientes` (
  `tipodeinden` varchar(1) default NULL,
  `numedeiden` varchar(11) NOT NULL,
  `expedida` varchar(20) default NULL,
  `nombre` varchar(40) default NULL,
  `telefono` varchar(20) default NULL,
  `direccion` varchar(40) default NULL,
  `email` varchar(60) default NULL,
  `estado` varchar(60) default NULL,
  `ciudad` varchar(50) default NULL,
  `departamento` varchar(60) default NULL,
  `campo2` varchar(60) default NULL,
  `codempresacreadora` varchar(15) default NULL,
  PRIMARY KEY  (`numedeiden`),
  KEY `codempresacreadora` (`codempresacreadora`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Clientes`
--

INSERT INTO `Clientes` (`tipodeinden`, `numedeiden`, `expedida`, `nombre`, `telefono`, `direccion`, `email`, `estado`, `ciudad`, `departamento`, `campo2`, `codempresacreadora`) VALUES
('1', '84079067', 'RIOHACHA', 'OSVALDO JOSE SERRA CAMARGO', '3216875203', 'CERRITO LA PALMA', '', 'activo', 'SINCELEJO', 'SUCRE', '', ''),
('1', '64695994', 'sincelejo', 'yolima del socorro baquero martinez', '3205305307', 'cr 21 #42a-25 B/Trinidad', '', 'activo', 'sincelejo', 'sucre', '', ''),
('1', '64550343', 'SINCELEJO', 'GILMA GONZALEZ BELLO', '2802082', 'CLL 27F #9A-33', '', 'activo', 'SINCELEJO', 'SUCRE', '', ''),
('1', '1102816511', 'sincelejo', 'luis enrique nieva gonzalez', '3167553713', 'C 27F #9A-33 B/TACALOA', '', 'activo', 'SINCELEJO', 'SUCRE', '', ''),
('1', '64588054', 'SINCELEJO', 'NORMA ROSA ACOSTA BOHORQUEZ', '3145657763', 'CALLE 42 Nº 24 - 64 LA TRINIDAD', '', 'activo', 'SINCELEJO', 'SUCRE', '', ''),
('1', '0', 'XXXXXXXXX', 'XXXXXXXXX', 'XXXXXXX', 'XX', '', 'activo', 'X', 'X', '', ''),
('1', '1099991076', 'SINCELEJO', 'ERIC VERGARA BALDOVINO', '3216786236', 'CL 13 # 36- 8 DULCE NOMBRE', '', 'activo', 'SINCELEJO', 'SUCRE', '', ''),
('1', '50895581', 'SINCELEJO', 'BLASINA MARIA ARROYO ARROYO', '2741741', 'CRA 12 N 14A 36 SEVILLA ', '', 'activo', 'SINCELEJO', 'SUCRE', '', ''),
('1', '64553809', 'SINCELEJO', 'ANA MERCEDES MONTERROZA CUELLO', '2741460', 'CLL 13 N 12-69 APTO 2 SEVILLA I', '', 'activo', 'SINCELEJO', 'SUCRE', '', ''),
('1', '50875000', 'SINCELEJO', 'NERY LUZ PADILLA ESQUIVEL', '3215826501', 'CLL 3 N 2-20 LAGUNA FLOR', '', 'activo', 'SINCELEJO', 'SUCRE', '', ''),
('1', '11057200', 'SINCELEJO', 'VICTOR ANTONIO PEÑATE OROZCO', '3168637486', 'CLL 3 N 2-20 LAGUNA FLOR ', '', 'activo', 'SINCELEJO', 'SUCRE', '', ''),
('1', '92227774', 'SINCELEJO', 'HERNANDO DE JESUS LOPEZ LOPEZ', '3215143168', 'MNA 14 LOTE 10 VILLA NAZARETH', '', 'activo', 'TOLU', 'SUCRE', '', ''),
('1', '64894218', 'SINCELEJO', 'YANIRIS MARIA CANOLES GUERRA', '3126318254', 'CRA 21 N 42-35 LA TRINIDAD', '', 'activo', 'SINCELEJO', 'SUCRE', '', ''),
('1', '64583920', 'SINCELEJO', 'LIVY LUZ PEREZ OZUNA', '3008810091', 'CLL 28 N 12-15 MAJAGUAL', '', 'activo', 'SINCELEJO', 'SUCRE', '', ''),
('1', '92517529', 'SINCELEJO', 'PEDRO NEL CORRALES SANTOS|', '3145244057', 'CLL PRINCIPAL COSTA DE ORO', '', 'activo', 'SINCELEJO', 'SUCRE', '', ''),
('1', '123456', 'SINCELEJO', 'JOSE PEREZ', '1456', 'CRA45654', '', 'activo', 'SINCELEJO', 'SUCRE', '', ''),
('1', '6814744', 'SINCELEJO', 'MIGUEL IGNACIO CARRASCAL BLANCO', '3015766137', 'TRANSV 23B#23A-68', '', 'activo', 'SINCELEJO', 'SUCRE', '', ''),
('c', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('1', '92548910', 'Sincelejo', 'WILSON DAVID FLOREZ BARBOZA', '3016570141', 'CALLE 36 A # 12 - 21 SAN VICENTE', 'WILSON_FLOREZ@CUN.EDU.CO', 'activo', 'SINCELEJO', 'SUCER', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `EMPLEADOS`
--

CREATE TABLE IF NOT EXISTS `EMPLEADOS` (
  `tipodeinden1` varchar(1) default NULL,
  `numedeiden1` varchar(11) NOT NULL,
  `nombre1` varchar(40) default NULL,
  `telefonoemp` varchar(20) default NULL,
  `direccion1` varchar(40) default NULL,
  `login1` varchar(40) default NULL,
  `password1` varchar(40) default NULL,
  `estado1` enum('ACTIVO','INACTIVO') NOT NULL,
  `codempresa1` varchar(15) default NULL,
  `permisos1` varchar(15) default NULL,
  PRIMARY KEY  (`numedeiden1`),
  KEY `codempresa1` (`codempresa1`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `EMPLEADOS`
--

INSERT INTO `EMPLEADOS` (`tipodeinden1`, `numedeiden1`, `nombre1`, `telefonoemp`, `direccion1`, `login1`, `password1`, `estado1`, `codempresa1`, `permisos1`) VALUES
('C', '5555', 'JAMER HERNANDEZ', '28222', 'KRA', 'jamer', '1234', 'ACTIVO', '900.414.272-9', 'us'),
('c', '92548910', 'WILSON DAVID  BARRETO PEREZ', '2827584', 'CALLE LAS PEÑITAS', 'wilson', 'wilson1234', 'ACTIVO', '900.414.272-9', 'us'),
('c', '64702662', 'ANA K. GONZALEZ HOYOS', '0', '0', 'anak', '1234', 'ACTIVO', '900.414.272-9', 'us'),
('c', '64587558', 'LUZ MILA CANTILLO', '0', '0', 'luzm', '12345', 'ACTIVO', '900.414.272-9', 'us');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE IF NOT EXISTS `empresas` (
  `nit` varchar(15) NOT NULL,
  `razonsocial` varchar(100) default NULL,
  `cedularepresentante` varchar(15) default NULL,
  `expediciondecedula` varchar(30) default NULL,
  `nombrerepresentante` varchar(40) default NULL,
  `ciudadempresa` varchar(100) default NULL,
  `telefono1` varchar(100) default NULL,
  `telefono2` varchar(100) default NULL,
  `direccion` varchar(100) default NULL,
  `celular1` varchar(100) default NULL,
  `celular2` varchar(100) default NULL,
  `campo1` varchar(100) default NULL,
  `campo2` varchar(100) default NULL,
  PRIMARY KEY  (`nit`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`nit`, `razonsocial`, `cedularepresentante`, `expediciondecedula`, `nombrerepresentante`, `ciudadempresa`, `telefono1`, `telefono2`, `direccion`, `celular1`, `celular2`, `campo1`, `campo2`) VALUES
('900.414.272-9', 'Moto K OB S.A.S.', '641234569', 'Sincelejo', 'AUDREY ALICIA ARRIENTA PALENCIA', 'Sincelejo', '2825099', '333', 'calle 365', '3205418503', '3126606463', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturaVentas`
--

CREATE TABLE IF NOT EXISTS `facturaVentas` (
  `codigo` int(11) NOT NULL auto_increment,
  `valor_total` varchar(20) NOT NULL,
  `totaliva` varchar(20) NOT NULL,
  `fecha` date NOT NULL,
  `codcliente` varchar(15) NOT NULL,
  `coddeudor` varchar(15) NOT NULL,
  `saldo` varchar(20) NOT NULL,
  `coutaini` varchar(20) NOT NULL,
  `comentario` varchar(300) NOT NULL,
  `tipo` enum('CREDITO','CONTADO','TCREDITO','TDEBITO') NOT NULL,
  `codusuario` varchar(11) NOT NULL,
  `codempresa` varchar(15) default NULL,
  `codempleado` varchar(11) default NULL,
  `recibocaja` varchar(15) default NULL,
  `ncuotas` varchar(15) default NULL,
  `vcuotas` varchar(15) default NULL,
  `clase` varchar(40) default NULL,
  `marca` varchar(40) default NULL,
  `tipovehiculo` varchar(15) default NULL,
  `color` varchar(15) default NULL,
  `modelo` varchar(15) default NULL,
  `nmotor` varchar(30) default NULL,
  `nserie` varchar(40) default NULL,
  `placa` varchar(15) default NULL,
  `linea` varchar(15) default NULL,
  `cilindraje` varchar(15) default NULL,
  `servicio` varchar(15) default NULL,
  `carroceria` varchar(15) default NULL,
  `npuertas` varchar(15) default NULL,
  `capacidad` varchar(15) default NULL,
  `cascos` varchar(15) default NULL,
  `chalecos` varchar(15) default NULL,
  `soat` varchar(15) default NULL,
  `placareflectivo` varchar(15) default NULL,
  `bateria` varchar(15) default NULL,
  `retrovisores` varchar(15) default NULL,
  `herramietas` varchar(15) default NULL,
  `consecutivodefactura` int(11) default NULL,
  `fechalimite` varchar(15) default NULL,
  `estado` varchar(15) default NULL,
  `nplaca` varchar(10) default NULL,
  `campo2` varchar(15) default NULL,
  PRIMARY KEY  (`codigo`),
  KEY `codempresa` (`codempresa`),
  KEY `codcliente` (`codcliente`),
  KEY `codempleado` (`codempleado`),
  KEY `coddeudor` (`coddeudor`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=86 ;

--
-- Volcado de datos para la tabla `facturaVentas`
--

INSERT INTO `facturaVentas` (`codigo`, `valor_total`, `totaliva`, `fecha`, `codcliente`, `coddeudor`, `saldo`, `coutaini`, `comentario`, `tipo`, `codusuario`, `codempresa`, `codempleado`, `recibocaja`, `ncuotas`, `vcuotas`, `clase`, `marca`, `tipovehiculo`, `color`, `modelo`, `nmotor`, `nserie`, `placa`, `linea`, `cilindraje`, `servicio`, `carroceria`, `npuertas`, `capacidad`, `cascos`, `chalecos`, `soat`, `placareflectivo`, `bateria`, `retrovisores`, `herramietas`, `consecutivodefactura`, `fechalimite`, `estado`, `nplaca`, `campo2`) VALUES
(41, '2490000', '0', '2012-07-07', '6814744', '1', '0', '0', ' Todo bien LIVI', 'CONTADO', '64587558', '900.414.272-9', '64587558', '7828', '0', '0', '', 'BAJAJ', '', 'ROJO', '2013', 'PFMBVA89309', '9FLPFC2ZXDAF029', '15000', 'BOXER BM 100 CL', '100', 'particular', 'no', '0', '2', '1', '1', '245000', '15000', '1', '2', '0', 12, '2012-08-06', '0', '', '0'),
(42, '2.490.000', '0', '2012-07-07', '6814744', '123456', '0', '2000000', 'LISTO ', 'CREDITO', '64587558', '900.414.272-9', '64587558', '7828', '2', '246000', 'MOTO', 'BAJAJ', '', 'ROJO', '2013', 'PFMBVA89309', '9FLPFC2ZXDAF029', '0', 'BOXER BM 100 CL', '100', 'particular', 'no', '0', '2', '1', '1', '245000', '0', '1', '2', '0', 12, '2012-08-06', '0', '', '0'),
(43, '3990000', '0', '2012-07-09', '92548910', '123456', '0', '2000000', 'CREDITO REALIZADO CORRECTAMENTE', 'CREDITO', '5555', '900.414.272-9', '5555', '46', '2', '300000', 'MOTO', 'BAJAJ', '', 'NEGRO', '2013', 'MDU45678*9', 'MM00112', '0', 'BOXER BM 150', '100', 'particular', 'no', '0', '2', '1', '1', '245000', '0', '1', '2', '0', 45, '2012-08-10', '0', '', '0'),
(44, '10000', '0', '2012-07-09', '6814744', '92548910', '0', '100', ' Todo bien ', 'CONTADO', '5555', '900.414.272-9', '5555', '325', '10', '10000', 'especial', 'BAJAJ', '', 'AZUL', '2011', '787987987987', '5844646464', '15000', 'BOXER BM 150', '125', 'particular', 'no', '0', '2', '2', '1', '245000', '15000', '1', '2', '15000', 123, '2012-07-10', '0', '1254', '15000'),
(45, '7500000', '0', '2012-07-09', '123456', '92548910', '0', '3000000', 'LISTO EL CREDICONTADO', 'TCREDITO', '5555', '900.414.272-9', '5555', '78', '8', '562500', 'MOTO', 'BAJAJ', '', 'AZUL', '2013', 'BREEEE123', 'BREDERD1234544', '0', 'PULSAR 220 S', '220', 'particular', 'no', '0', '2', '1', '1', '245000', '0', '1', '2', '0', 77, '2012-08-09', '0', '', '0'),
(46, '2790000', '0', '2012-07-11', '92517529', '1', '0', '0', 'MOTO VENDIDA A ELECTROSUR ', 'CONTADO', '64587558', '900.414.272-9', '64587558', '7992', '1', '1990000', 'MOTO', 'BAJAJ', '', 'NEGRO', '2012', 'DUMBUM86152', '9FLDUC4Z8DAE499', '0', 'BOXER BM 150', '100', 'particular', 'no', '0', '2', '1', '1', '0', '0', '1', '2', '0', 0, '2012-10-11', '0', '', '0'),
(47, '878', '0', '2012-07-12', '92517529', '6814744', '0', '87', ' Todo bien ', 'CREDITO', '5555', '900.414.272-9', '5555', '787', '8', '8888', '', 'BAJAJ', '', 'NEGRO ROJO', '2011', '', '', '15000', 'BOXER BM 150', '125', 'particular', 'no', '0', '2', '2', '1', '245000', '15000', '1', '2', '15000', 121, '2012-02-20', '0', '', '15000'),
(48, '2900000', '0', '2012-07-12', '6814744', '1', '0', '0', ' Todo bien ', 'CONTADO', '5555', '900.414.272-9', '5555', '255', '23', '0', 'moto', 'BAJAJ', '', 'ROJO', '2013', 'JAB123456789', 'JEB789569', '0', 'BOXER BM 150', '100', 'particular', 'no', '0', '2', '1', '1', '245000', '0', '1', '2', '0', 88, '2012-07-12', '0', '', '0'),
(49, '0', '0', '2012-07-14', '64894218', '1', '0', '0', 'MOTO BOXER CONTADO', 'CONTADO', '64587558', '900.414.272-9', '64587558', '0', '0', '0', 'MOTO', 'BAJAJ', '', 'BLANCA', '2013', 'DUMBUM51166', '9FLDUC4Z3DAF533', '134000', 'BOXER BM 150', '100', 'particular', 'no', '0', '2', '2', '1', '236000', '134000', '1', '2', '0', 0, '2012-07-14', '0', '0', '0'),
(50, '300000', '0', '2012-07-14', '6814744', '1', '0', '0', ' Todo bien ', 'CONTADO', '5555', '900.414.272-9', '5555', '123', '0', '0', 'moto', 'BAJAJ', '', 'AMARILLO', '2013', '', '', '15000', 'BOXER BM 150', '100', 'particular', 'no', '0', '2', '2', '1', '245000', '15000', '1', '2', '0', 14, '2012-07-14', '0', '', '0'),
(51, '300000', '0', '2012-07-14', '6814744', '1', '0', '0', ' Todo bien hhhhhhh', 'CONTADO', '5555', '900.414.272-9', '5555', '123', '0', '0', 'moto', 'BAJAJ', '', 'AMARILLO', '2013', '', 'sdfsfd44444', '15000', 'BOXER BM 150', '100', 'particular', 'no', '45454ffff', '2', '2', '1', '245000', '15000', '1', '2', '0', 14, '2012-07-14', '0', '', '0'),
(52, '0', '0', '2012-07-14', '92227774', '1', '0', '0', 'CON RESERVA DE DOMINIO A FAVO0R DE GUILLERMO BONILLA', 'CONTADO', '64587558', '900.414.272-9', '64587558', '0', '0', '0', 'MOTO', 'BAJAJ', '', 'NEGRO', '2013', 'DUMBVA66152', '9FLDUC4Z9DAG549', '190000', 'BOXER BM 150', '100', 'particular', 'no', '0', '2', '2', '1', '236000', '190000', '1', '2', '0', 0, '2012-07-14', '0', '0', '0'),
(53, '0', '0', '2012-07-16', '6814744', '1', '0', '0', ' Todo bien ', 'CONTADO', '5555', '900.414.272-9', '5555', '0', '0', '0', 'moto', 'BAJAJ', '', 'AZUL', '2013', 'ssss123456', 'eeee7894561231', '0', 'BOXER BM 150', '100', 'particular', 'no', '0', '2', '1', '1', '0', '0', '1', '2', '0', 456, '2012-07-16', '0', '', '0'),
(54, '0', '0', '2012-07-16', '6814744', '1', '0', '0', ' Todo bien ', 'CONTADO', '5555', '900.414.272-9', '5555', '0', '0', '0', 'moto', 'KYMCO', '', 'BLANCA', '2013', 'iiii123456', 'yyy7894561231', '0', 'AGILITY RS NAKE', '125', 'particular', 'no', '0', '2', '1', '1', '0', '0', '1', '2', '0', 456, '2012-07-16', '0', '', '0'),
(55, '0', '0', '2012-07-16', '6814744', '1', '0', '0', ' Todo bien ', 'CONTADO', '5555', '900.414.272-9', '5555', '0', '0', '0', 'moto', 'KAWASAKI', '', 'ROJO', '2013', 'iuiui123456', 'fffff7894561231', '0', 'ER 6n 650', '650', 'particular', 'no', '0', '2', '1', '1', '0', '0', '1', '2', '0', 458, '2012-07-16', '0', '', '0'),
(56, '0', '0', '2012-07-16', '6814744', '1', '0', '0', ' Todo bien ', 'CONTADO', '5555', '900.414.272-9', '5555', '0', '0', '0', 'moto', 'BAJAJ', '', 'AMARILLO', '2013', 'kkkk123456', 'fkl?klk89456123', '0', 'PLATINO 100', '650', 'particular', 'no', '0', '2', '1', '1', '0', '0', '1', '2', '0', 458, '2012-07-16', '0', '', '0'),
(57, '0', '0', '2012-07-16', '6814744', '1', '0', '0', ' Todo bien ', 'CONTADO', '5555', '900.414.272-9', '5555', '0', '0', '0', 'moto', 'BAJAJ', '', 'AZUL', '2013', 'kkkk458487', 'fkl?klk65654654', '0', 'BOXER BM 150', '650', 'particular', 'no', '0', '2', '1', '1', '0', '0', '1', '2', '0', 459, '2012-07-16', '0', '', '0'),
(58, '0', '0', '2012-07-16', '6814744', '1', '0', '0', ' Todo bien ', 'CONTADO', '5555', '900.414.272-9', '5555', '0', '0', '0', 'moto', 'BAJAJ', '', 'AZUL', '2013', 'kkkk458487', 'fkl?klk65654654', '0', 'BOXER BM 150', '650', 'particular', 'no', '0', '2', '1', '1', '0', '0', '1', '2', '0', 459, '2012-07-16', '0', '', '0'),
(59, '3200000', '0', '2012-07-19', '92227774', '1', '0', '0', ' Todo bien ', 'CONTADO', '5555', '900.414.272-9', '5555', '456', '0', '0', 'moto', 'BAJAJ', '', 'NEGRO', '2013', 'dfere1234', 'sdfer1111222', '0', 'BOXER BM 100', '100', 'particular', 'no', '0', '2', '1', '1', '245000', '0', '1', '2', '15000', 222, '2012-07-19', '0', '', '15000'),
(60, '2900000', '0', '2012-07-19', '64894218', '92227774', '0', '1000000', ' Todo bien ', 'CREDITO', '64587558', '900.414.272-9', '64587558', '457', '5', '25', 'moto', 'BAJAJ', '', 'ROJO', '2013', 'MDU456789', 'dm45612312222', '0', 'BOXER BM 100 CL', '100', 'particular', 'no', '0', '2', '2', '1', '0', '0', '1', '2', '0', 0, '2012-08-19', '0', '', '0'),
(61, '2990000', '0', '2012-07-23', '11057200', '50875000', '0', '800000', ' Todo bien ', 'CREDITO', '64587558', '900.414.272-9', '64587558', '8199', '18', '194000', 'M', 'BAJAJ', '', 'NEGRO', '2013', '', '', '15000', 'PLATINO 100', '125', 'particular', 'no', '0', '2', '2', '1', '245000', '15000', '1', '2', '15000', 0, '2012-09-19', '0', '0', '15000'),
(62, '2990000', '0', '2012-07-23', '11057200', '50875000', '0', '800000', 'CANCELA SALDO DE LA INICIAL 24 JULIO 2012.\r\nCANCELA LA PRIMERA LETRA EL DIA 19 DE SEPTIEMBRE.', 'CREDITO', '64587558', '900.414.272-9', '64587558', '8199', '18', '194000', 'MOTO', 'BAJAJ', '', 'NEGRO', '2013', 'DZMBVA40121', '9FLDZC4Z2DAG206', '160000', '', '100', 'particular', 'no', '0', '2', '1', '1', '236000', '160000', '1', '2', '5000', 0, '2012-09-19', '0', '0', '80000'),
(63, '0', '0', '2012-07-23', '92227774', '11057200', '0', '0', ' Todo bien ', 'CONTADO', '5555', '900.414.272-9', '5555', '0', '0', '0', 'jknjkh', 'BAJAJ', '', 'VERDE', '2011', '78797987', '1212121212', '15000', 'PLATINO 125 SPE', '125', 'particular', 'no', '0', '2', '2', '1', '245000', '15000', '1', '2', '15000', 5432, '2012-07-23', '0', '542', '15000'),
(64, '0', '0', '2012-07-23', '92227774', '11057200', '0', '0', ' Todo bien ', 'CONTADO', '5555', '900.414.272-9', '5555', '0', '0', '0', 'jknjkh', 'BAJAJ', '', 'VERDE', '2011', '78797987', '1212121212', '15000', '', '125', 'particular', 'no', '0', '2', '2', '1', '245000', '15000', '1', '2', '15000', 5432, '2012-07-23', '0', '542', '15000'),
(65, '0', '0', '2012-07-23', '50875000', '1', '0', '0', ' Todo bien ', 'CONTADO', '5555', '900.414.272-9', '5555', '0', '0', '0', '', 'BAJAJ', '', '0', '2011', '78787', '8787878', '15000', '', '125', 'particular', 'no', '0', '2', '2', '1', '245000', '15000', '1', '2', '15000', 55, '2012-07-09', '0', '', '15000'),
(66, '0', '0', '2012-07-23', '50875000', '11057200', '0', '0', ' Todo bien ', '', '5555', '900.414.272-9', '5555', '0', '0', '0', '', 'BAJAJ', '', '0', '2011', '545', '74587', '15000', 'PLATINO 100', '125', 'particular', 'no', '0', '2', '2', '1', '245000', '15000', '1', '2', '15000', 0, '2012-07-18', '0', '', '15000'),
(67, '0', '0', '2012-07-23', '92227774', '6814744', '0', '0', ' Todo bien ', '', '5555', '900.414.272-9', '5555', '0', '0', '0', 'gfh', 'BAJAJ', '', '0', '2011', '', '', '15000', '', '125', 'particular', 'no', '0', '2', '2', '1', '245000', '15000', '1', '2', '15000', 0, '2012-07-10', '0', '', '15000'),
(68, '0', '0', '2012-07-23', '92227774', '6814744', '0', '0', ' Todo bien ', '', '5555', '900.414.272-9', '5555', '0', '0', '0', 'gfh', 'KYMCO', '', 'AMARILLO', '2011', '7878', '12121', '15000', 'LIKED 125', '125', 'particular', 'no', '0', '2', '2', '1', '245000', '15000', '1', '2', '15000', 0, '2012-07-10', '0', '', '15000'),
(69, '2.990.000', '0', '2012-07-28', '50875000', '11057200', '0', '1.000.000', '  Todo bien prueva formatos ', 'CREDITO', '5555', '900.414.272-9', '5555', '212', '5', '265.000', 'moto', 'BAJAJ', '', 'NEGRO', '2013', 'du1231332', 'bzks122333445', '0', 'PLATINO 100', '100', 'particular', 'no', '0', '2', '1', '1', '245000', '0', '1', '2', '15000', 0, '2012-08-24', '0', ' ', '15000'),
(70, '2.990.000', '0', '2012-07-25', '92227774', '6814744', '0', '1.000.000', ' Todo bien ', 'CREDITO', '5555', '900.414.272-9', '5555', '23', '4', '265.000', 'MOTO', 'KYMCO', '', 'NEGRO ROJO', '2013', '', '', '0', 'ACTIV 110', '125', 'particular', 'no', '0', '2', '2', '1', '245000', '0', '1', '2', '15000', 0, '2012-07-26', '0', '', '15000'),
(71, '2.990.000', '0', '2012-07-25', '92227774', '6814744', '0', '1.000.000', ' Todo bien ', 'CREDITO', '5555', '900.414.272-9', '5555', '23', '4', '265.000', 'MOTO', 'KYMCO', '', 'NEGRO ROJO', '2013', '', '', '0', 'ACTIV 110', '125', 'particular', 'no', '0', '2', '2', '1', '245000', '0', '1', '2', '15000', 0, '2012-07-26', '0', '', '15000'),
(72, '2.990.000', '0', '2012-07-25', '92227774', '6814744', '0', '1.000.000', ' Todo bien ', 'CREDITO', '5555', '900.414.272-9', '5555', '23', '4', '265.000', 'MOTO', 'KYMCO', '', 'NEGRO ROJO', '2013', '', '', '0', 'ACTIV 110', '125', 'particular', 'no', '0', '2', '2', '1', '245000', '0', '1', '2', '15000', 0, '2012-07-26', '0', '', '15000'),
(73, '2.990.000', '0', '2012-07-25', '92227774', '6814744', '0', '1.000.000', ' Todo bien ', 'CREDITO', '5555', '900.414.272-9', '5555', '23', '4', '265.000', 'MOTO', 'KYMCO', '', 'NEGRO ROJO', '2013', '', '', '0', 'ACTIV 110', '125', 'particular', 'no', '0', '2', '2', '1', '245000', '0', '1', '2', '15000', 0, '2012-07-26', '0', '', '15000'),
(74, '2.990.000', '0', '2012-07-25', '92227774', '6814744', '0', '1.000.000', ' Todo bien ', 'CREDITO', '5555', '900.414.272-9', '5555', '23', '4', '265.000', 'MOTO', 'KYMCO', '', 'NEGRO ROJO', '2013', 'DDDD', 'WEWE3WEEED', '0', '', '125', 'particular', 'no', '0', '2', '2', '1', '245000', '0', '1', '2', '15000', 0, '2012-07-26', '0', '', '15000'),
(75, '2.990.000', '0', '2012-07-25', '92227774', '6814744', '0', '1.000.000', ' Todo bien ', 'CREDITO', '5555', '900.414.272-9', '5555', '23', '4', '265.000', 'MOTO', 'KYMCO', '', 'NEGRO ROJO', '2013', 'DDDD', 'WEWE3WEEED', '0', 'ACTIV 110', '125', 'particular', 'no', '0', '2', '2', '1', '245000', '0', '1', '2', '15000', 0, '2012-07-26', '0', '', '15000'),
(76, '3000000', '0', '2012-07-28', '92227774', '64894218', '0', '1000000', '     Todo bien  hjhjhjh   ', 'CREDITO', '5555', '900.414.272-9', '5555', '232', '12', '500000', 'moto', 'KYMCO', '', 'NEGRO', '2013', 'gfhgfgfg0000', '45555555555', '0', 'AGILITY RS NAKE', '100', 'particular', 'no', '0', '2', '2', '1', '245000', '0', '1', '2', '15000', 0, '2012-08-24', '0', ' ', '15000'),
(77, '0', '0', '2012-07-28', '64894218', '1', '0', '0', ' Todo bien ', 'CONTADO', '5555', '900.414.272-9', '5555', '0', '0', '0', 'moto', 'KYMCO', '', 'ROJO', '2013', '452454', '5454545', '15000', 'LIKED 125', '125', 'particular', 'no', '0', '2', '2', '1', '245000', '15000', '1', '2', '15000', 0, '', '0', '', '15000'),
(78, '2990000', '0', '2012-07-28', '64553809', '50895581', '0', '1800000', 'CREDICONTADO A 4 MESES', 'TCREDITO', '5555', '900.414.272-9', '5555', '  ', '4', '462000', 'MOTO', 'BAJAJ', '', 'AZUL', '2013', 'DZMBUM54273', '9FLDZC4Z5DCF196', '160000', 'PLATINO 100', '100', 'particular', 'no', '0', '2', '1', '1', '236000', '160000', '1', '2', '5000', 0, '2012-08-28', '0', '0', '80000'),
(79, '2790000', '0', '2012-07-28', '1099991076', '1', '0', '2200000', '  Todo bien  ', 'TCREDITO', '64702662', '900.414.272-9', '64702662', '8410', '3', '356000', 'MOTO', 'BAJAJ', '', 'NEGRO', '2013', 'DUMBVA80701', '9FLDUC4Z3DAG562', '160000', 'BOXER CT 100', '100', 'particular', 'no', '0', '2', '1', '1', '236000', '160000', '1', '2', '0', 0, '2012-08-28', '0', ' ', '0'),
(80, '2790000', '0', '2012-07-28', '64588054', '1', '0', '2500000', '  Todo bien  ', 'TCREDITO', '64587558', '900.414.272-9', '64587558', '8432', '3', '248000', 'MOTO', 'BAJAJ', '', 'AZUL', '2013', 'DUMBUM61336', '9FLDUC4Z7DAF54069', '160000', 'BOXER CT 100', '100', 'PARTICULAR', 'NO', '0', '2', '1', '1', '236000', '160000', '1', '2', '0', 0, '2012-08-28', '0', ' ', '0'),
(81, '2790000', '0', '2012-07-28', '64588054', '1', '0', '2500000', ' Todo bien ', 'TCREDITO', '64587558', '900.414.272-9', '64587558', '8432', '3', '248000', 'MOTO', 'BAJAJ', '', 'AZUL', '2013', 'DUMBUM61336', '9FLDUC4Z7DAF540', '160000', '', '100', 'PARTICULAR', 'NO', '0', '2', '1', '1', '236000', '160000', '1', '2', '0', 0, '2012-08-28', '0', ' ', '0'),
(82, '4390000', '0', '2012-07-28', '1102816511', '64550343', '0', '1000000', ' Todo bien ', 'CREDITO', '64587558', '900.414.272-9', '64587558', '0', '24', '246000', 'MOTO', 'BAJAJ', '', 'NEGRO', '2013', 'JEGBUH16673', '9FLJDC1Z0DCE519', '220.000', 'PULSAR 135', '135', 'particular', 'no', '0', '2', '1', '1', '316.000', '220.000', '1', '2', '5000', 0, '2012-07-30', '0', '', '80.000'),
(83, '4390000', '0', '2012-07-28', '11057200', '1', '0', '', ' Todo bien ', 'CONTADO', '5555', '900.414.272-9', '5555', '55', '', '', 'MOTO', 'BAJAJ', '', '4', '2013', 'DUMBVA80701', '9FLDZC4Z5DCF19665', '15000', 'PULSAR 135', '125', 'particular', 'no', '0', '2', '2', '1', '245000', '15000', '1', '2', '15000', 0, '', '0', '', '15000'),
(84, '4390000', '0', '2012-07-28', '11057200', '1', '0', '', ' Todo bien ', 'CONTADO', '5555', '900.414.272-9', '5555', '55', '', '', 'MOTO', 'BAJAJ', '', '4', '2013', 'DUMBVA80701', '9FLDZC4Z5DCF19665', '15000', 'PULSAR 135', '125', 'particular', 'no', '0', '2', '2', '1', '245000', '15000', '1', '2', '15000', 0, '', '0', '', '15000'),
(85, '2790000', '0', '2012-07-31', '84079067', '1', '0', '', '  Todo bien  ', 'CONTADO', '64587558', '900.414.272-9', '64587558', '8439-8488', '', '', 'MOTO', 'BAJAJ', '', 'NEGRO', '2013', 'DUMBVA648872', '9FLDUC4Z9DAG55078', '160000', 'BOXER CT 100', '100', 'particular', 'no', '0', '2', '1', '1', '236000', '160000', '1', '2', '0', 0, '2012-07-31', '0', ' ', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `referencias`
--

CREATE TABLE IF NOT EXISTS `referencias` (
  `codigo` int(11) NOT NULL auto_increment,
  `nombre` varchar(40) default NULL,
  `telefono` varchar(20) default NULL,
  `direccion` varchar(40) default NULL,
  `email` varchar(60) default NULL,
  `campo1` varchar(60) default NULL,
  `campo2` varchar(60) default NULL,
  `codempresacreadora` varchar(15) default NULL,
  PRIMARY KEY  (`codigo`),
  KEY `codempresacreadora` (`codempresacreadora`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=66 ;

--
-- Volcado de datos para la tabla `referencias`
--

INSERT INTO `referencias` (`codigo`, `nombre`, `telefono`, `direccion`, `email`, `campo1`, `campo2`, `codempresacreadora`) VALUES
(59, 'NOHEMI IBARRA', '3126463627', 'CALLE 42 Nº 24 - 64', NULL, NULL, NULL, '900.414.272-9'),
(58, 'JORGE VERGARA', '3114163095', 'BARRIO LA FORD', NULL, NULL, NULL, '900.414.272-9'),
(57, 'ANA ORTEGA', '3116610826', 'BARRIO PABLO SEXTO', NULL, NULL, NULL, '900.414.272-9'),
(56, 'JOSE LUIS VARGAS', '3112040473', 'NUEVA ESPERANZA el roble', NULL, NULL, NULL, '900.414.272-9'),
(55, 'MARIA ELENA BALDOVINO', '3135081878', 'BARRIO PADILLA el roble', NULL, NULL, NULL, '900.414.272-9'),
(54, 'CRISTIAN VERBEL ARROYO', '3002642206', 'CALLE SUCRE', NULL, NULL, NULL, '900.414.272-9'),
(53, 'ADELMO QUIROZ CUELLO', '3008611594', 'SEVILLA PRIMERA ETAPA', NULL, NULL, NULL, '900.414.272-9'),
(52, 'ADELMO QUIROZ CUELLO', '3008611594', 'SEVILLA PRIMERA ETAPA', NULL, NULL, NULL, '900.414.272-9'),
(51, 'ADELMO QUIROZ CUELLO', '3008611594', 'SEVILLA PRIMERA ETAPA', NULL, NULL, NULL, '900.414.272-9'),
(50, 'ADELMO QUIROZ CUELLO', '3008611594', 'SEVILLA PRIMERA ETAPA', NULL, NULL, NULL, '900.414.272-9'),
(49, 'ADELMO QUIROZ CUELLO', '3008611594', 'SEVILLA PRIMERA ETAPA', NULL, NULL, NULL, '900.414.272-9'),
(48, 'ADELMO QUIROZ CUELLO', '3008611594', 'SEVILLA PRIMERA ETAPA', NULL, NULL, NULL, '900.414.272-9'),
(47, 'LUIS MONTERROZA CUELLO', '3012441846', 'SEVILLA', NULL, NULL, NULL, '900.414.272-9'),
(46, 'ROBERT LOPEZ MONTERROZA', '3012201102', 'SEVILLA', NULL, NULL, NULL, '900.414.272-9'),
(45, 'URIEL PEÑATE', '3168637486', 'LOS LAURELES', NULL, NULL, NULL, '900.414.272-9'),
(44, 'ADELFINA PEREZ', '3106423555', 'LA PRIMAVERA ', NULL, NULL, NULL, '900.414.272-9'),
(31, 'ADRIANA NARANJO', '3017672848', 'CL 40D#14-15', NULL, NULL, NULL, '900.414.272-9'),
(32, 'CARMEN VITAL', '3145134742', 'BARRIO LIBERTAD', NULL, NULL, NULL, '900.414.272-9'),
(33, 'JOHANA SIERRA CARDENAS', '3006499250', 'CR 10 # 25 C -28 PIONEROS', NULL, NULL, NULL, '900.414.272-9'),
(34, 'SEBASTIAN SIERRA ', '3012994273', 'CL 24 # 6-16 SELVA', NULL, NULL, NULL, '900.414.272-9'),
(35, 'CARLOS CARRASCAL SIERRA', '3003443842', 'BARRIO FLORENCIA', NULL, NULL, NULL, '900.414.272-9'),
(36, 'MIGUEL CARRASCAL', '3017122150', 'TRANSV. 23B#23A-68', NULL, NULL, NULL, '900.414.272-9'),
(37, 'DIANA CARRASCAL', '3106579268', 'TRANSV. 23B#23A-68', NULL, NULL, NULL, '900.414.272-9'),
(38, 'JORGE FERNANDEZ OROZCO', '3017542704', 'BARRIO MOCHILA', NULL, NULL, NULL, '900.414.272-9'),
(39, 'HIL', 'HKIH', 'HJHKIH', NULL, NULL, NULL, '900.414.272-9'),
(40, 'JAMER HERNANDEZ', '252522', 'CRA 6#12', NULL, NULL, NULL, '900.414.272-9'),
(41, 'JOSE MARIA', '123456', 'CRA 56', NULL, NULL, NULL, '900.414.272-9'),
(42, 'MARIA', '1223', 'VSVS', NULL, NULL, NULL, '900.414.272-9'),
(43, 'MARIA', '1223', 'VSVS', NULL, NULL, NULL, '900.414.272-9'),
(60, 'NOHEMI IBARRA', '3215357910', 'CALLE 42 Nº 24 - 64', NULL, NULL, NULL, '900.414.272-9'),
(61, 'EVER IBARRA', '3126463627', 'CALLE 42 Nº 24 - 64', NULL, NULL, NULL, '900.414.272-9'),
(62, 'JOSE HERRERA', '3006722379', 'BARRIO GRANCOLOMBIA', NULL, NULL, NULL, '900.414.272-9'),
(63, 'LASIDES MORALES', '3107129440', 'BARRIO DIVINO NIÑO', NULL, NULL, NULL, '900.414.272-9'),
(64, 'MARGARITA GONZALEZ', '2810917', 'CLL 15B #12A-91', NULL, NULL, NULL, '900.414.272-9'),
(65, 'NORMELINA FIGUEROA', '3173522700', 'CR 9A #27D-40', NULL, NULL, NULL, '900.414.272-9');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `refporfecturas`
--

CREATE TABLE IF NOT EXISTS `refporfecturas` (
  `codfact` int(11) NOT NULL,
  `codref` int(11) NOT NULL,
  `tipo` varchar(20) default NULL,
  `nota` varchar(255) default NULL,
  `campo1` varchar(60) default NULL,
  `campo2` varchar(60) default NULL,
  KEY `codfact` (`codfact`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `refporfecturas`
--

INSERT INTO `refporfecturas` (`codfact`, `codref`, `tipo`, `nota`, `campo1`, `campo2`) VALUES
(79, 58, 'personal', '', NULL, NULL),
(80, 60, 'familiar', '', NULL, NULL),
(79, 56, 'familiar', '', NULL, NULL),
(79, 57, 'personal', '', NULL, NULL),
(78, 54, 'personal', '', NULL, NULL),
(79, 55, 'familiar', '', NULL, NULL),
(78, 46, 'familiar', '', NULL, NULL),
(78, 47, 'familiar', '', NULL, NULL),
(78, 53, 'personal', '', NULL, NULL),
(77, 36, 'personal', '', NULL, NULL),
(76, 32, 'personal', '', NULL, NULL),
(76, 34, 'personal', '', NULL, NULL),
(76, 36, 'familiar', '', NULL, NULL),
(76, 36, 'familiar', '', NULL, NULL),
(75, 40, 'personal', '', NULL, NULL),
(75, 34, 'personal', '', NULL, NULL),
(70, 40, 'personal', '', NULL, NULL),
(75, 45, 'familiar', '', NULL, NULL),
(75, 40, 'familiar', '', NULL, NULL),
(74, 40, 'personal', '', NULL, NULL),
(74, 34, 'personal', '', NULL, NULL),
(74, 45, 'familiar', '', NULL, NULL),
(74, 40, 'familiar', '', NULL, NULL),
(73, 40, 'personal', '', NULL, NULL),
(73, 34, 'personal', '', NULL, NULL),
(73, 45, 'familiar', '', NULL, NULL),
(73, 40, 'familiar', '', NULL, NULL),
(72, 40, 'personal', '', NULL, NULL),
(72, 34, 'personal', '', NULL, NULL),
(72, 45, 'familiar', '', NULL, NULL),
(72, 40, 'familiar', '', NULL, NULL),
(71, 34, 'personal', '', NULL, NULL),
(71, 40, 'personal', '', NULL, NULL),
(71, 45, 'familiar', '', NULL, NULL),
(71, 40, 'familiar', '', NULL, NULL),
(70, 34, 'personal', '', NULL, NULL),
(70, 45, 'familiar', '', NULL, NULL),
(70, 40, 'familiar', '', NULL, NULL),
(69, 34, 'personal', '', NULL, NULL),
(69, 45, 'familiar', '', NULL, NULL),
(69, 38, 'familiar', '', NULL, NULL),
(68, 44, 'personal', '', NULL, NULL),
(67, 44, 'personal', '', NULL, NULL),
(66, 32, 'personal', '', NULL, NULL),
(22, 19, 'personal', '', NULL, NULL),
(66, 34, 'familiar', '', NULL, NULL),
(66, 45, 'familiar', '', NULL, NULL),
(65, 33, 'personal', '', NULL, NULL),
(65, 31, 'personal', '', NULL, NULL),
(65, 44, 'familiar', '', NULL, NULL),
(64, 33, 'personal', '', NULL, NULL),
(64, 35, 'personal', '', NULL, NULL),
(64, 33, 'familiar', '', NULL, NULL),
(64, 45, 'familiar', '', NULL, NULL),
(63, 33, 'personal', '', NULL, NULL),
(63, 35, 'personal', '', NULL, NULL),
(63, 33, 'familiar', '', NULL, NULL),
(63, 45, 'familiar', '', NULL, NULL),
(62, 45, 'familiar', '', NULL, NULL),
(62, 44, 'familiar', '', NULL, NULL),
(61, 45, 'familiar', '', NULL, NULL),
(61, 44, 'familiar', '', NULL, NULL),
(60, 38, 'personal', 'listo', NULL, NULL),
(60, 33, 'familiar', 'ok...', NULL, NULL),
(60, 40, 'familiar', 'listo', NULL, NULL),
(47, 40, 'personal', '', NULL, NULL),
(47, 38, 'personal', '', NULL, NULL),
(47, 32, 'familiar', '', NULL, NULL),
(47, 31, 'familiar', '', NULL, NULL),
(45, 37, 'personal', '', NULL, NULL),
(45, 35, 'personal', '', NULL, NULL),
(45, 31, 'familiar', '', NULL, NULL),
(45, 33, 'familiar', '', NULL, NULL),
(44, 36, 'personal', '', NULL, NULL),
(44, 33, 'personal', '', NULL, NULL),
(44, 32, 'familiar', '', NULL, NULL),
(44, 31, 'familiar', '', NULL, NULL),
(43, 34, 'personal', '', NULL, NULL),
(43, 36, 'personal', '', NULL, NULL),
(43, 40, 'familiar', '', NULL, NULL),
(43, 33, 'familiar', 'LISTOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO', NULL, NULL),
(42, 42, 'personal', '', NULL, NULL),
(42, 40, 'familiar', '', NULL, NULL),
(42, 32, 'familiar', 'OK', NULL, NULL),
(80, 61, 'familiar', '', NULL, NULL),
(80, 62, 'personal', '', NULL, NULL),
(80, 63, 'personal', '', NULL, NULL),
(81, 60, 'familiar', '', NULL, NULL),
(81, 61, 'familiar', '', NULL, NULL),
(81, 62, 'personal', '', NULL, NULL),
(81, 63, 'personal', '', NULL, NULL),
(82, 64, 'familiar', '', NULL, NULL),
(82, 65, 'personal', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USUARIOS`
--

CREATE TABLE IF NOT EXISTS `USUARIOS` (
  `tipodeinden` varchar(1) default NULL,
  `numedeiden` varchar(11) NOT NULL,
  `nombre` varchar(40) default NULL,
  `telefono` varchar(20) default NULL,
  `direccion` varchar(40) default NULL,
  `login` varchar(40) default NULL,
  `password` varchar(40) default NULL,
  `estado` enum('ACTIVO','INACTIVO') NOT NULL,
  `codempresa` varchar(15) default NULL,
  `permisos` varchar(15) default NULL,
  PRIMARY KEY  (`numedeiden`),
  KEY `codempresa` (`codempresa`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `USUARIOS`
--

INSERT INTO `USUARIOS` (`tipodeinden`, `numedeiden`, `nombre`, `telefono`, `direccion`, `login`, `password`, `estado`, `codempresa`, `permisos`) VALUES
('C', '64000', 'claudia lenguas', '28222', 'KRA', 'claudia1', '1234', 'ACTIVO', '900.414.272-9', 'us'),
('C', '92548', 'WILSON FLOREZ', '28222', 'KRA', 'WILSON', '0000', 'ACTIVO', '900.414.272-9', 'ad'),
('C', '92000', 'raul morales', '28222', 'KRA', 'raul1', '1234', 'ACTIVO', '900.414.272-9', 'us');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
