-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-01-2015 a las 20:42:57
-- Versión del servidor: 5.5.16
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `costa_humboldt`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `buceos`
--

CREATE TABLE IF NOT EXISTS `buceos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `latitud` double NOT NULL,
  `longitud` double NOT NULL,
  `localidad` varchar(45) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `tipo` enum('Autónomo deportivo','Semi-Autónomo','Apnea','Técnico') DEFAULT NULL,
  `temp_superficie` int(11) DEFAULT NULL COMMENT 'Temperatura de superficie registrada en grados celcius',
  `temp_fondo` int(11) DEFAULT NULL COMMENT 'Temperatura de fondo registrada en grados celcius',
  `tiempo` int(11) DEFAULT NULL COMMENT 'Tiempo de buceo medido en minutos',
  `profundidad_media` int(11) DEFAULT NULL COMMENT 'Metros',
  `profundidad_maxima` int(11) DEFAULT NULL COMMENT 'Metros',
  `visibilidad` enum('Menos de 1 metro','1 - 3 metros','3 - 5 metros','5 - 10 metros','10 - 15 metros','15 - 20 metros','20 - 30 metros','Más de 30 metros') DEFAULT NULL,
  `corriente` enum('Ninguna','Suave','Fuerte') DEFAULT NULL COMMENT '0 - Ninguna\n1 - Suave\n2 - Fuerte',
  `nombre_usuario` varchar(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_registro_buceo_usuario1_idx` (`nombre_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=74 ;

--
-- Volcado de datos para la tabla `buceos`
--

INSERT INTO `buceos` (`id`, `latitud`, `longitud`, `localidad`, `fecha`, `tipo`, `temp_superficie`, `temp_fondo`, `tiempo`, `profundidad_media`, `profundidad_maxima`, `visibilidad`, `corriente`, `nombre_usuario`) VALUES
(40, -42, -60, 'Lorem Ipsum Chigua', '2015-01-28', 'Semi-Autónomo', 20, 10, NULL, 10, 10, '3 - 5 metros', 'Suave', 'develop'),
(41, -41, -60, 'Lorea ipsum', '2015-01-21', 'Apnea', 15, 10, NULL, 10, 10, '20 - 30 metros', 'Fuerte', 'develop'),
(42, -41.5, -60, 'Chigua', '2015-01-05', 'Técnico', 10, 10, NULL, 10, 10, '20 - 30 metros', NULL, 'develop'),
(43, -41.2, -60, 'Chigua', '2015-01-05', 'Técnico', 10, 10, NULL, 10, 10, '20 - 30 metros', NULL, 'develop'),
(44, -41.2, -60, 'Chigua', '2015-01-05', 'Técnico', 10, 10, NULL, 10, 10, '20 - 30 metros', NULL, 'develop'),
(45, -41.2, -60, 'Chigua', '2015-01-05', 'Técnico', 10, 10, NULL, 10, 10, '20 - 30 metros', NULL, 'develop'),
(46, -41.2, -60, 'Chigua', '2014-12-09', 'Técnico', 10, 10, NULL, 10, 10, '20 - 30 metros', NULL, 'develop'),
(47, -41.2, -60, 'Chigua', '2015-01-05', 'Técnico', 10, 10, NULL, 10, 10, '20 - 30 metros', NULL, 'develop'),
(48, -41.2, -60, 'Chigua', '2014-12-01', 'Técnico', 10, 10, NULL, 10, 10, '20 - 30 metros', NULL, 'develop'),
(49, -41.2, -60, 'Chigua', '2015-01-05', 'Técnico', 10, 10, NULL, 10, 10, '20 - 30 metros', NULL, 'develop'),
(50, -41.2, -60, 'Chigua', '2015-01-05', 'Técnico', 10, 10, NULL, 10, 10, '20 - 30 metros', NULL, 'develop'),
(51, -41.2, -60, 'Chigua', '2015-01-05', 'Técnico', 10, 10, NULL, 10, 10, '20 - 30 metros', NULL, 'develop'),
(52, -41.2, -60, 'Chigua', '2015-01-05', 'Técnico', 10, 10, NULL, 10, 10, '20 - 30 metros', NULL, 'develop'),
(53, -41.2, -60, 'Chigua', '2015-01-05', 'Técnico', 10, 10, NULL, 10, 10, '20 - 30 metros', NULL, 'develop'),
(54, -41.2, -60, 'Chigua', '2015-01-05', 'Técnico', 10, 10, NULL, 10, 10, '20 - 30 metros', NULL, 'develop'),
(55, -41.2, -60, 'Chigua', '2015-01-05', 'Técnico', 10, 10, NULL, 10, 10, '20 - 30 metros', NULL, 'develop'),
(56, -32.990235559651055, -67.6318359375, '', '2015-01-30', 'Autónomo deportivo', 10, 10, 10, 10, 10, 'Menos de 1 metro', 'Ninguna', 'develop'),
(57, -33.13755119234615, -71.8505859375, '', '2015-01-30', 'Técnico', 10, 10, 19, 10, 10, 'Menos de 1 metro', 'Ninguna', 'develop'),
(58, -29.036960648558257, -70.9716796875, '', '2015-01-30', 'Autónomo deportivo', 10, 10, 10, 10, 10, '1 - 3 metros', 'Ninguna', 'develop'),
(59, -32.21280106801518, -69.1259765625, '', '2015-01-30', 'Semi-Autónomo', 10, 10, 10, 10, 10, 'Menos de 1 metro', 'Ninguna', 'develop'),
(60, -32.58384932565661, -75.498046875, '', '2015-01-30', 'Semi-Autónomo', 10, 10, 10, 10, 10, 'Menos de 1 metro', 'Ninguna', 'develop');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `buceo_especie`
--

CREATE TABLE IF NOT EXISTS `buceo_especie` (
  `id_buceo` int(11) NOT NULL,
  `id_especie` int(11) NOT NULL,
  `abundancia` enum('Único','Poco abundante','Abundante','Muy abundante') DEFAULT NULL,
  `presente` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_buceo`,`id_especie`),
  KEY `fk_registro_especie_registro_buceo1_idx` (`id_buceo`),
  KEY `fk_registro_especie_especie1_idx` (`id_especie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `buceo_especie`
--

INSERT INTO `buceo_especie` (`id_buceo`, `id_especie`, `abundancia`, `presente`) VALUES
(40, 1, 'Único', 1),
(40, 3, 'Único', 1),
(40, 6, 'Muy abundante', 1),
(40, 12, 'Único', 1),
(41, 3, 'Abundante', 1),
(41, 5, NULL, 0),
(41, 13, 'Muy abundante', 1),
(42, 1, 'Poco abundante', 0),
(42, 3, 'Único', 0),
(42, 5, 'Poco abundante', 0),
(43, 101, 'Poco abundante', 1),
(44, 32, 'Poco abundante', 1),
(45, 34, 'Abundante', 1),
(46, 33, 'Poco abundante', 1),
(47, 44, 'Abundante', 1),
(48, 55, 'Poco abundante', 1),
(49, 66, 'Abundante', 1),
(50, 77, 'Abundante', 1),
(51, 65, 'Abundante', 1),
(52, 43, 'Poco abundante', 1),
(53, 42, 'Muy abundante', 1),
(54, 36, 'Abundante', 1),
(55, 67, 'Muy abundante', 1),
(56, 68, 'Abundante', 1),
(57, 69, 'Poco abundante', 1),
(58, 71, 'Poco abundante', 1),
(59, 99, 'Poco abundante', 1),
(60, 101, 'Abundante', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `buceo_habitat`
--

CREATE TABLE IF NOT EXISTS `buceo_habitat` (
  `idhabitat` int(11) NOT NULL,
  `idbuceo` int(11) NOT NULL,
  PRIMARY KEY (`idhabitat`,`idbuceo`),
  KEY `fk_buceo_habitat_habitat1_idx` (`idhabitat`),
  KEY `fk_buceo_habitat_registro_buceo1_idx` (`idbuceo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centro_buceo`
--

CREATE TABLE IF NOT EXISTS `centro_buceo` (
  `id` int(11) NOT NULL,
  `data` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `centro_buceo`
--

INSERT INTO `centro_buceo` (`id`, `data`) VALUES
(1, 'ValpoSub'),
(2, 'Otros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especies`
--

CREATE TABLE IF NOT EXISTS `especies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_comun` varchar(30) DEFAULT NULL,
  `nombre_cientifico` varchar(35) DEFAULT NULL,
  `kingdom` varchar(25) DEFAULT NULL,
  `phylum` varchar(25) DEFAULT NULL,
  `class` varchar(25) DEFAULT NULL,
  `order` varchar(25) DEFAULT NULL,
  `family` varchar(25) DEFAULT NULL,
  `genus` varchar(45) DEFAULT NULL,
  `aphia` int(11) DEFAULT NULL,
  `distribucion_geografica` varchar(200) NOT NULL,
  `descripcion` text NOT NULL,
  `ecologia` text NOT NULL,
  `importancia_economica` text NOT NULL,
  `biologia_reproductiva` text NOT NULL,
  `referencias` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `ruta` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=215 ;

--
-- Volcado de datos para la tabla `especies`
--

INSERT INTO `especies` (`id`, `nombre_comun`, `nombre_cientifico`, `kingdom`, `phylum`, `class`, `order`, `family`, `genus`, `aphia`, `distribucion_geografica`, `descripcion`, `ecologia`, `importancia_economica`, `biologia_reproductiva`, `referencias`, `ruta`) VALUES
(1, 'Acha', 'Medialuna ancietae', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Kyphosidae', 'Medialuna', 281540, '', '', '', '', '', '', ''),
(2, 'Agujilla', 'Scomberesox saurus scombroides', 'Animalia', 'Chordata', 'Actinopterygii', 'Beloniformes', 'Scomberesocidae', 'Scomberesox', 293736, '', '', '', '', '', '', ''),
(3, 'Albacora', 'Xiphias gladius', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Xiphiidae', 'Xiphias', 127094, '', '', '', '', '', '', ''),
(4, 'Alfonsino', 'Beryx splendens', 'Animalia', 'Chordata', 'Actinopterygii', 'Beryciformes', 'Berycidae', 'Beryx', 126395, '', '', '', '', '', '', ''),
(5, 'Anchoveta', 'Engraulis ringens', 'Animalia', 'Chordata', 'Actinopterygii', 'Clupeiformes', 'Engraulidae', 'Engraulis', 272287, '', '', '', '', '', '', ''),
(6, 'Anguila', 'Ophichthus remiger', 'Animalia', 'Chordata', 'Actinopterygii', 'Anguilliformes', 'Ophichthidae', 'Ophichthus', 271976, '', '', '', '', '', '', ''),
(7, 'Anguila', 'Ophichthus spp.', 'Animalia', 'Chordata', 'Actinopterygii', 'Anguilliformes', 'Ophichthidae', 'Ophichthus', 0, '', '', '', '', '', '', ''),
(8, 'Apañado', 'Hemilutjanus macrophthalmos', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Serranidae', 'Hemilutjanus', 281028, '', '', '', '', '', '', ''),
(9, 'Atún Aleta amarilla', 'Thunnus albacares', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Scombridae', 'Thunnus', 127027, '', '', '', '', '', '', ''),
(10, 'Atún aleta larga', 'Thunnus alalunga', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Scombridae', 'Thunnus', 127026, '', '', '', '', '', '', ''),
(11, 'Atún de ojos grandes', 'Thunnus obesus', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Scombridae', 'Thunnus', 127028, '', '', '', '', '', '', ''),
(12, 'Ayanque', 'Cynoscion analis', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Sciaenidae', 'Cynoscion', 276076, '', '', '', '', '', '', ''),
(13, 'Ayanque, Cachema', 'Cynoscion analis', 'Animalia', 'Chordata', '', 'Perciformes', 'Sciaenidae', 'Cynoscion', 276076, '', '', '', '', '', '', ''),
(32, 'Azulejo', 'Prionace glauca', 'Animalia', 'Chordata', 'Elasmobranchii', 'Carcharhiniformes', 'Carcharhinidae', 'Prionace', 105801, '', '', '', '', '', '', ''),
(33, 'Bacaladillo o Mote', 'Normanichthys crockeri', 'Animalia', 'Chordata', 'Actinopterygii', 'Scorpaeniformes', 'Normanichthyidae', 'Normanichthys', 281762, '', '', '', '', '', '', ''),
(34, 'Bacalao de Juan Fernández', 'Polyprion oxygeneios', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Polyprionidae', 'Polyprion', 221430, '', '', '', '', '', '', ''),
(35, 'Bacalao de profundidad', 'Dissostichus eleginoides', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Nototheniidae', 'Dissostichus', 234700, '', '', '', '', '', '', ''),
(36, 'Bagre pintado', 'Trichomycterus areolatus', 'Animalia', 'Chordata', 'Actinopterygii', 'Siluriformes', 'Trichomycteridae', 'Trichomycterus', 0, '', '', '', '', '', '', ''),
(37, 'Bagrecillo', 'Nematogenys inermis', 'Animalia', 'Chordata', 'Actinopterygii', 'Siluriformes', 'Nematogenyidae', 'Nematogenys', 0, '', '', '', '', '', '', ''),
(38, 'Bagrecito', 'Bullockia maldonadoi', 'Animalia', 'Chordata', 'Actinopterygii', 'Siluriformes', 'Trichomycteridae', 'Bullockia', 0, '', '', '', '', '', '', ''),
(39, 'Bagrecito', 'Trichomycterus chiltoni', 'Animalia', 'Chordata', 'Actinopterygii', 'Siluriformes', 'Trichomycteridae', 'Trichomycterus', 0, '', '', '', '', '', '', ''),
(40, 'Bagrecito', 'Trichomycterus chungaraensis', 'Animalia', 'Chordata', 'Actinopterygii', 'Siluriformes', 'Trichomycteridae', 'Trichomycterus', 0, '', '', '', '', '', '', ''),
(41, 'Bagrecito', 'Trichomycterus laucaensis', 'Animalia', 'Chordata', 'Actinopterygii', 'Siluriformes', 'Trichomycteridae', 'Trichomycterus', 0, '', '', '', '', '', '', ''),
(42, 'Bagrecito', 'Trichomycterus rivulatus', 'Animalia', 'Chordata', 'Actinopterygii', 'Siluriformes', 'Trichomycteridae', 'Trichomycterus', 0, '', '', '', '', '', '', ''),
(43, 'Barrilete negro', 'Auxis rochei rochei', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Scombridae', 'Auxis', 236487, '', '', '', '', '', '', ''),
(44, 'Besugo', 'Epigonus crassicaudus', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Epigonidae', 'Epigonus', 273404, '', '', '', '', '', '', ''),
(45, 'Bilagay', 'Cheilodactylus variegatus', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Cheilodactylidae', 'Cheilodactylus', 278156, 'Desde Paita en Perú hasta bahía Metri en Chile (41º36’S, 72º43’W) (Pequeño & Vargas 2001).', 'Cuerpo oblongo, comprimido y de dorso algo elevado. Aleta pectoral entera con los 5 ó 6 radios inferiores engrosados y no ramificados, con sólo los extremos libres; una aleta dorsal hendida o muesqueada entre las porciones espinosas y blandas pero no separadas. Labios moderadamente gruesos. En la coloración resaltan  de 6 a 7 bandas verticales. Los rebordes y los vértices de las aletas caudal, anal, ventrales y pectorales, resaltan en ejemplares frescos por el vivo color rojo-anaranjado (Medina et al. 2003).', 'Forma pequeños cardúmenes en las inmediaciones de bosques de huiro con fondo rocoso, en esta ambiente obtiene una gran variedad de presas como moluscos, crustáceos, poliquetos y equinodermos, clasificándose como una especie carnívora (Moreno & Flores 2002).', 'Económicamente para el país no es importante ya que aún no aparece en las estadísticas pesqueras, debido a su regionalidad y al poco volumen de su captura, se encuentra rara vez en los mercados por su ocasional pesquería artesanal.', 'Temporada de desove aparentemente parcial en Chile entre Enero y Mayo, talla de primera madurez sexual 27 cm de longitud total para hembras (Data no publicada).', 'González J & F Balbontín. Estudio de desarrollo gonadal y talla media de madurez sexual en el Bilagay Cheilodactylus variegatus (Valenciennes, 1883) (Osteichthyes: Cheilodactylidae) del área de Valparaíso, (Data no publicado).\r\n\r\nMoreno M & H Flores. 2002. Contenido estomacal de Cheilodactylus variegatus Valenciennes 1833, Pinguipes chilensis Valenciennes 1833 y Prolatilus jugularis Valenciennes 1833 en la Bahía de la Herradura, Coquimbo, durante primavera del 2001. Gayana, Concepción 66(2): 213-217.\r\n\r\nMedina M, C Vega & M Araya. 2003. Guía de peces marinos de la zona norte de Chile. Mecesup Unap/001\r\nVargas L & G Pequeño. 2001. Hallazgo del bilagai (Cheilodactylus variegatus Valenciennes, 1833),  en la bahía Metri, Chile  (Osteichthyes: Cheilodactylidae) Investigaciones Marinas 29(2): 29-33.\r\n', 'img/especies/Bilagay.jpg'),
(46, 'Blanquillo', 'Prolatilus jugularis', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Pinguipedidae', 'Prolatilus', 282360, '', '', '', '', '', '', ''),
(47, 'Bonito', 'Sarda chiliensis', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Scombridae', 'Sarda', 293729, '', '', '', '', '', '', ''),
(48, 'Borrachilla', 'Scartichthys gigas', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Blenniidae', 'Scartichthys', 282674, '', '', '', '', '', '', 'img/especies/Borrachilla.jpg'),
(49, 'Borracho verde', 'Scartichthys viridis', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Blenniidae', 'Scartichthys', 282676, '', '', '', '', '', '', ''),
(50, 'Breca', 'Cheilodactylus variegatus', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Cheilodactylidae', 'Cheilodactylus', 278156, '', '', '', '', '', '', ''),
(51, 'Breca de Juan Fernandez', 'Nemadactylus gayi', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Cheilodactylidae', 'Nemadactylus', 281652, '', '', '', '', '', '', ''),
(52, 'Brótola', 'Salilota australis', 'Animalia', 'Chordata', 'Actinopterygii', 'Gadiformes', 'Moridae', 'Salilota', 282654, '', '', '', '', '', '', ''),
(53, 'Brótula', 'Salilota australis', 'Animalia', 'Chordata', 'Actinopterygii', 'Gadiformes', 'Moridae', 'Salilota', 282654, '', '', '', '', '', '', ''),
(54, 'Brútola', 'Salilota australis', 'Animalia', 'Chordata', 'Actinopterygii', 'Gadiformes', 'Moridae', 'Salilota', 282654, '', '', '', '', '', '', ''),
(55, 'Caballa', 'Scomber japonicus', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Scombridae', 'Scomber', 127022, '', '', '', '', '', '', ''),
(56, 'Cabeza de acero', 'Oncorhynchus mykiss', 'Animalia', 'Chordata', 'Actinopterygii', 'Salmoniformes', 'Salmonidae', 'Oncorhynchus', 127185, '', '', '', '', '', '', ''),
(57, 'Cabinza', 'Isacia conceptionis', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Haemulidae', 'Isacia', 281184, '', '', '', '', '', '', ''),
(58, 'Cabrilla', 'Sebastes capensis', 'Animalia', 'Chordata', 'Actinopterygii', 'Scorpaeniformes', 'Sebastidae', 'Sebastes', 221446, '', '', '', '', '', '', 'img/especies/Cabrilla_comun.jpg'),
(59, 'Cabrilla común', 'Paralabrax humeralis', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Serranidae', 'Paralabrax', 282056, '', '', '', '', '', '', ''),
(60, 'Cabrilla española', 'Sebastes capensis', 'Animalia', 'Chordata', 'Actinopterygii', 'Scorpaeniformes', 'Sebastidae', 'Sebastes', 221446, '', '', '', '', '', '', 'img/especies/Cabrilla_espanola.jpg'),
(61, 'Cachurreta', 'Katsuwonus pelamis', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Scombridae', 'Katsuwonus', 127018, '', '', '', '', '', '', ''),
(62, 'Cacique', 'Congiopodus peruvianus', 'Animalia', 'Chordata', 'Actinopterygii', 'Scorpaeniformes', 'Congiopodidae', 'Congiopodus', 278357, '', '', '', '', '', '', ''),
(63, 'Carmelita', 'Percilia gillissi', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Perciliidae ', 'Percilia', 0, '', '', '', '', '', '', ''),
(64, 'Carmelita común', 'Percilia gillissi', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Perciliidae ', 'Percilia', 0, '', '', '', '', '', '', ''),
(65, 'Carmelita de Concepción', 'Percilia irwini', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Perciliidae ', 'Percilia', 0, '', '', '', '', '', '', ''),
(66, 'Carpa', 'Cyprinus carpio', 'Animalia', 'Chordata', 'Actinopterygii', 'Cypriniformes', 'Cyprinidae', 'Cyprinus', 154582, '', '', '', '', '', '', ''),
(67, 'Carpín', 'Carassius carassius', 'Animalia', 'Chordata', 'Actinopterygii', 'Cypriniformes', 'Cyprinidae', 'Carassius', 154297, '', '', '', '', '', '', ''),
(68, 'Castañeta', 'Nexilosus latifrons', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Pomacentridae', 'Nexilosus', 281746, '', '', '', '', '', '', ''),
(69, 'Castañeta común', 'Chromis crusma', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Pomacentridae', 'Chromis', 273717, '', '', '', '', '', '', 'img/especies/Castañeta.jpg'),
(70, 'Cauque del Maule', 'Odontesthes mauleanum', 'Animalia', 'Chordata', 'Actinopterygii', 'Atheriniformes', 'Atherinidae ', 'Odontesthes', 0, '', '', '', '', '', '', ''),
(71, 'Cauque del Norte', 'Odontesthes brevianalis', 'Animalia', 'Chordata', 'Actinopterygii', 'Atheriniformes', 'Atherinidae ', 'Odontesthes', 0, '', '', '', '', '', '', ''),
(72, 'Pejerey de cola corta', 'Odontesthes brevianalis', 'Animalia', 'Chordata', 'Actinopterygii', 'Atheriniformes', 'Atherinidae ', 'Odontesthes', 0, '', '', '', '', '', '', ''),
(73, 'Cazón', 'Galeorhinus galeus', 'Animalia', 'Chordata', 'Elasmobranchii', 'Carcharhiniformes', 'Triakidae', 'Galeorhinus', 105820, '', '', '', '', '', '', ''),
(74, 'Chancharro', 'Helicolenus lengerichi', 'Animalia', 'Chordata', 'Actinopterygii', 'Scorpaeniformes', 'Sebastidae', 'Helicolenus', 274768, '', '', '', '', '', '', ''),
(75, 'Chanchito', 'Congiopodus peruvianus', 'Animalia', 'Chordata', 'Actinopterygii', 'Scorpaeniformes', 'Congiopodidae', 'Congiopodus', 278357, '', '', '', '', '', '', ''),
(76, 'Chanchito de agua dulce', 'Australoheros facetus', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Cichlidae', 'Australoheros', 0, '', '', '', '', '', '', ''),
(77, 'Cochinilla', 'Thamnaconus paschalis', 'Animalia', 'Chordata', 'Actinopterygii', 'Tetraodontiformes', 'Monacanthidae ', 'Thamnaconus', 277211, '', '', '', '', '', '', ''),
(78, 'Cojinoba del norte', 'Seriolella violacea', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Centrolophidae', 'Seriolella', 282760, '', '', '', '', '', '', ''),
(79, 'Cojinoba del sur', 'Seriolella caerulea', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Centrolophidae', 'Seriolella', 282756, '', '', '', '', '', '', ''),
(80, 'Cojinoba moteada', 'Seriolella punctata', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Centrolophidae', 'Seriolella', 282758, '', '', '', '', '', '', ''),
(81, 'Cojinova', 'Seriolella porosa', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Centrolophidae', 'Seriolella', 282757, '', '', '', '', '', '', ''),
(82, 'Congrio colorado', 'Genypterus chilensis', 'Animalia', 'Chordata', 'Actinopterygii', 'Ophidiiformes', 'Ophidiidae', 'Genypterus', 278704, '', '', '', '', '', '', 'img/especies/Congrio_colorado.jpg'),
(83, 'Congrio dorado', 'Genypterus blacodes', 'Animalia', 'Chordata', 'Actinopterygii', 'Ophidiiformes', 'Ophidiidae', 'Genypterus', 278702, '', '', '', '', '', '', ''),
(84, 'Congrio negro', 'Genypterus maculatus', 'Animalia', 'Chordata', 'Actinopterygii', 'Ophidiiformes', 'Ophidiidae', 'Genypterus', 278705, '', '', '', '', '', '', ''),
(85, 'Corvina', 'Cilus gilberti', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Sciaenidae', 'Cilus', 280187, '', '', '', '', '', '', 'img/especies/Corvina.jpg'),
(86, 'Corvina rubia', 'Micropogonias furnieri', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Sciaenidae', 'Micropogonias', 275307, '', '', '', '', '', '', ''),
(87, 'Corvinilla', 'Micropogonias furnieri', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Sciaenidae', 'Micropogonias', 275307, '', '', '', '', '', '', ''),
(88, 'Dorado', 'Coryphaena hippurus', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Coryphaenidae', 'Coryphaena', 126846, '', '', '', '', '', '', ''),
(89, 'Dorado', 'Seriola lalandi', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Carangidae', 'Seriola', 218436, '', '', '', '', '', '', ''),
(90, 'Draco rayado', 'Champsocephalus gunnari', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Channichthyidae', 'Champsocephalus', 234797, '', '', '', '', '', '', ''),
(91, 'Hacha', 'Kyphosus analogus', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Kyphosidae', 'Kyphosus', 273519, '', '', '', '', '', '', ''),
(92, 'Huaiquil', 'Micropogonias furnieri', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Sciaenidae', 'Micropogonias', 275307, '', '', '', '', '', '', ''),
(93, 'Jerguilla', 'Aplodactylus punctatus', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Aplodactylidae', 'Aplodactylus', 279659, '', '', '', '', '', '', 'img/especies/Jerguilla.jpg'),
(94, 'Jurel', 'Trachurus murphyi', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Carangidae', 'Trachurus', 273303, '', '', '', '', '', '', 'img/especies/Jurel.jpg'),
(95, 'Lamprea chilena', 'Mordacia lapicida', 'Animalia', 'Chordata', 'Cephalaspidomorphi', 'Petromyzontiformes', 'Mordaciidae', 'Mordacia', 281594, '', '', '', '', '', '', ''),
(96, 'Lamprea de bolsa', 'Geotria australis', 'Animalia', 'Chordata', 'Cephalaspidomorphi', 'Petromyzontiformes', 'Geotriidae', 'Geotria', 234686, '', '', '', '', '', '', ''),
(97, 'Lenguado chileno', 'Paralichthys adspersus', 'Animalia', 'Chordata', 'Actinopterygii', 'Pleuronectiformes', 'Paralichthyidae', 'Paralichthys', 275806, '', '', '', '', '', '', ''),
(98, 'Lenguado de la Patagonia', 'Paralichthys patagonicus', 'Animalia', 'Chordata', 'Actinopterygii', 'Pleuronectiformes', 'Paralichthyidae', 'Paralichthys', 275818, '', '', '', '', '', '', ''),
(99, 'Lenguado de ojos chicos', 'Paralichthys microps', 'Animalia', 'Chordata', 'Actinopterygii', 'Pleuronectiformes', 'Paralichthyidae', 'Paralichthys', 275815, '', '', '', '', '', '', 'img/especies/Lenguado_ojoschicos.gif'),
(100, 'Lenguado de ojos grandes', 'Hippoglossina macrops', 'Animalia', 'Chordata', 'Actinopterygii', 'Pleuronectiformes', 'Paralichthyidae', 'Hippoglossina', 275824, '', '', '', '', '', '', 'img/especies/Lenguado_ojosgrandes.jpg'),
(101, 'Lenguado de Patagonia', 'Paralichthys patagonicus', 'Animalia', 'Chordata', 'Actinopterygii', 'Pleuronectiformes', 'Paralichthyidae', 'Paralichthys', 275818, '', '', '', '', '', '', ''),
(102, 'Lisa', 'Mugil cephalus', 'Animalia', 'Chordata', 'Actinopterygii', 'Mugiliformes', 'Mugilidae', 'Mugil', 126983, '', '', '', '', '', '', ''),
(103, 'Machete', 'Brevoortia maculata', 'Animalia', 'Chordata', 'Actinopterygii', 'Clupeiformes', 'Clupeidae', 'Brevoortia', 308313, '', '', '', '', '', '', ''),
(104, 'Machuelo', 'Ethmidium maculatum', 'Animalia', 'Chordata', 'Actinopterygii', 'Clupeiformes', 'Clupeidae', 'Ethmidium', 280726, '', '', '', '', '', '', ''),
(105, 'Marlín', 'Tetrapturus audax', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Istiophoridae', 'Tetrapturus', 219733, '', '', '', '', '', '', ''),
(106, 'Marrajo', 'Isurus oxyrinchus', 'Animalia', 'Chordata', 'Elasmobranchii', 'Lamniformes', 'Lamnidae', 'Isurus', 105839, '', '', '', '', '', '', ''),
(107, 'Matahuira', 'Heteropriacanthus cruentatus', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Priacanthidae', 'Heteropriacanthus', 127004, '', '', '', '', '', '', ''),
(108, 'Merluza', 'Merluccius gayi gayi', 'Animalia', 'Chordata', 'Actinopterygii', 'Gadiformes', 'Merlucciidae', 'Merluccius', 272453, '', '', '', '', '', '', ''),
(109, 'Merluza argentina', 'Merluccius hubbsi', 'Animalia', 'Chordata', 'Actinopterygii', 'Gadiformes', 'Merlucciidae', 'Merluccius', 272455, '', '', '', '', '', '', ''),
(110, 'Merluza austral', 'Merluccius australis', 'Animalia', 'Chordata', 'Actinopterygii', 'Gadiformes', 'Merlucciidae', 'Merluccius', 272452, '', '', '', '', '', '', ''),
(111, 'Merluza chilena', 'Merluccius gayi gayi', 'Animalia', 'Chordata', 'Actinopterygii', 'Gadiformes', 'Merlucciidae', 'Merluccius', 272453, '', '', '', '', '', '', ''),
(112, 'Merluza común', 'Merluccius gayi gayi', 'Animalia', 'Chordata', 'Actinopterygii', 'Gadiformes', 'Merlucciidae', 'Merluccius', 272453, '', '', '', '', '', '', ''),
(113, 'Merluza de cola', 'Macruronus magellanicus', 'Animalia', 'Chordata', 'Actinopterygii', 'Gadiformes', 'Merlucciidae', 'Macruronus', 272449, '', '', '', '', '', '', ''),
(114, 'Merluza de tres aletas', 'Micromesistius australis', 'Animalia', 'Chordata', 'Actinopterygii', 'Gadiformes', 'Gadidae', 'Micromesistius', 234781, '', '', '', '', '', '', ''),
(115, 'Merluza de tres colas', 'Micromesistius australis', 'Animalia', 'Chordata', 'Actinopterygii', 'Gadiformes', 'Gadidae', 'Micromesistius', 234781, '', '', '', '', '', '', ''),
(116, 'Merluza del sur', 'Merluccius australis', 'Animalia', 'Chordata', 'Actinopterygii', 'Gadiformes', 'Merlucciidae', 'Merluccius', 272452, '', '', '', '', '', '', ''),
(117, 'Mojarrilla común', 'Stellifer minor', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Sciaenidae', 'Stellifer', 276164, '', '', '', '', '', '', ''),
(118, 'Mulata', 'Graus nigra', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Kyphosidae', 'Graus', 280941, '', '', '', '', '', '', ''),
(119, 'Nanue', 'Girellops nebulosus', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Kyphosidae', 'Girellops', 318180, '', '', '', '', '', '', ''),
(120, 'Nototenia', 'Patagonotothen ramsayi', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Nototheniidae', 'Patagonotothen', 234633, '', '', '', '', '', '', ''),
(121, 'Nudibranquio', 'Acanthodoris falklandica', 'Animalia', 'Mollusca', 'Gastropoda', 'Nudibranchia', 'Onchidorididae', 'Acanthodoris', 532318, '', '', '', '', '', '', ''),
(122, 'Nudibranquio', 'Acanthodoris falklandica', 'Animalia', 'Mollusca', 'Gastropoda', 'Nudibranchia', 'Onchidorididae', 'Acanthodoris', 532318, '', '', '', '', '', '', ''),
(123, 'Nudibranquio', 'Cadlina sparsa', 'Animalia', 'Mollusca', 'Gastropoda', 'Nudibranchia', 'Cadlinidae', 'Cadlina', 430397, '', '', '', '', '', '', ''),
(124, 'Nudibranquio', 'Diaulula hispida', 'Animalia', 'Mollusca', 'Gastropoda', 'Nudibranchia', 'Discodorididae', 'Diaulula', 536811, '', '', '', '', '', '', ''),
(125, 'Nudibranquio', 'Diaulula hispida', 'Animalia', 'Mollusca', 'Gastropoda', 'Nudibranchia', 'Discodorididae', 'Diaulula', 536811, '', '', '', '', '', '', ''),
(126, 'Nudibranquio', 'Diaulula hispida', 'Animalia', 'Mollusca', 'Gastropoda', 'Nudibranchia', 'Discodorididae', 'Diaulula', 536811, '', '', '', '', '', '', ''),
(127, 'Nudibranquio', 'Diaulula hispida', 'Animalia', 'Mollusca', 'Gastropoda', 'Nudibranchia', 'Discodorididae', 'Diaulula', 536811, '', '', '', '', '', '', ''),
(128, 'Nudibranquio', 'Diaulula punctuolata', 'Animalia', 'Mollusca', 'Gastropoda', 'Nudibranchia', 'Discodorididae', 'Diaulula', 532734, '', '', '', '', '', '', ''),
(129, 'Nudibranquio', 'Diaulula punctuolata', 'Animalia', 'Mollusca', 'Gastropoda', 'Nudibranchia', 'Discodorididae', 'Diaulula', 532734, '', '', '', '', '', '', ''),
(130, 'Nudibranquio', 'Doris fontainii', 'Animalia', 'Mollusca', 'Gastropoda', 'Nudibranchia', 'Dorididae', 'Doris', 536827, '', '', '', '', '', '', ''),
(131, 'Nudibranquio', 'Gargamella immaculata', 'Animalia', 'Mollusca', 'Gastropoda', 'Nudibranchia', 'Discodorididae', 'Gargamella', 536809, '', '', '', '', '', '', ''),
(132, 'Nudibranquio', 'Gargamella immaculata', 'Animalia', 'Mollusca', 'Gastropoda', 'Nudibranchia', 'Discodorididae', 'Gargamella', 536809, '', '', '', '', '', '', ''),
(133, 'Nudibranquio', 'Gargamella immaculata', 'Animalia', 'Mollusca', 'Gastropoda', 'Nudibranchia', 'Discodorididae', 'Gargamella', 536809, '', '', '', '', '', '', ''),
(134, 'Nudibranquio', 'Tyrinna delicata', 'Animalia', 'Mollusca', 'Gastropoda', 'Nudibranchia', 'Chromodorididae', 'Tyrinna', 536910, '', '', '', '', '', '', ''),
(135, 'Nudibranquio', 'Tyrinna delicata', 'Animalia', 'Mollusca', 'Gastropoda', 'Nudibranchia', 'Chromodorididae', 'Tyrinna', 536910, '', '', '', '', '', '', ''),
(136, 'Nudibranquio', 'Tyrinna delicata', 'Animalia', 'Mollusca', 'Gastropoda', 'Nudibranchia', 'Chromodorididae', 'Tyrinna', 536910, '', '', '', '', '', '', ''),
(137, 'Orange roughy', 'Hoplosthethus atlanticus', 'Animalia', 'Chordata', 'Actinopterygii', 'Beryciformes', 'Trachichthyidae', 'Hoplosthethus', 400863, '', '', '', '', '', '', ''),
(138, 'Palometa', 'Coryphaena hippurus', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Coryphaenidae', 'Coryphaena', 126846, '', '', '', '', '', '', ''),
(139, 'Palometa', 'Seriola lalandi', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Carangidae', 'Seriola', 218436, '', '', '', '', '', '', ''),
(140, 'Palometa pintada', 'Parona signata', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Carangidae', 'Parona', 282169, '', '', '', '', '', '', ''),
(141, 'Pampanito de J.Fernández ', 'Scorpis chilensis', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Kyphosidae', 'Scorpis', 282729, '', '', '', '', '', '', ''),
(142, 'Peje sapo común', 'Sicyases sanguineus', 'Animalia', 'Chordata', 'Actinopterygii', 'Gobiesociformes', 'Gobiesocidae', 'Sicyases', 282773, '', '', '', '', '', '', ''),
(143, 'Peje-bagre', 'Aphos porosus', 'Animalia', 'Chordata', 'Actinopterygii', 'Batrachoidiformes', 'Batrachoididae', 'Aphos', 279640, '', '', '', '', '', '', ''),
(144, 'Peje-diablo', 'Scorpaena histrio', 'Animalia', 'Chordata', 'Actinopterygii', 'Scorpaeniformes', 'Scorpaenidae', 'Scorpaena', 274716, '', '', '', '', '', '', ''),
(145, 'Pejegallo', 'Callorhinchus callorynchus', 'Animalia', 'Chordata', 'Holocephali', 'Chimaeriformes', 'Callorhinchidae', 'Callorhinchus', 278468, '', '', '', '', '', '', ''),
(146, 'Pejeperro', 'Semicossyphus darwini', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Labridae', 'Semicossyphus', 282752, '', '', '', '', '', '', ''),
(147, 'Pejerrata', 'Coelorhynchus fasciatus', 'Animalia', 'Chordata', 'Actinopterygii', 'Gadiformes', 'Macrouridae', 'Coelorhynchus', 400513, '', '', '', '', '', '', ''),
(148, 'Pejerrata', 'Coelorhynchus spp.', 'Animalia', 'Chordata', 'Actinopterygii', 'Gadiformes', 'Macrouridae', 'Coelorhynchus', 0, '', '', '', '', '', '', ''),
(149, 'Pejerrey chileno', 'Basilichthys australis', 'Animalia', 'Chordata', 'Actinopterygii', 'Atheriniformes ', 'Atherinopsidae', 'Basilichthys', 0, '', '', '', '', '', '', ''),
(150, 'Pejerrey de mar', 'Odontesthes regia', 'Animalia', 'Chordata', 'Actinopterygii', 'Atheriniformes', 'Atherinidae', 'Odontesthes', 281830, '', '', '', '', '', '', ''),
(151, 'Pejerrey del norte chico', 'Basilichthys microlepidotus', 'Animalia', 'Chordata', 'Actinopterygii', 'Atheriniformes ', 'Atherinopsidae', 'Basilichthys', 0, '', '', '', '', '', '', ''),
(152, 'Pejesapo', 'Sicyases sanguineus', 'Animalia', 'Chordata', 'Actinopterygii', 'Gobiesociformes', 'Gobiesocidae', 'Sicyases', 282773, '', '', '', '', '', '', 'img/especies/Pejesapo_comun.jpg'),
(153, 'Peje-sapo veteado', 'Gobiesox marmoratus', 'Animalia', 'Chordata', 'Actinopterygii', 'Gobiesociformes', 'Gobiesocidae', 'Gobiesox', 275673, '', '', '', '', '', '', ''),
(154, 'Pejezorro', 'Alopias vulpinus', 'Animalia', 'Chordata', 'Elasmobranchii', 'Lamniformes', 'Alopiidae', 'Alopias', 105836, '', '', '', '', '', '', ''),
(155, 'Peladilla', 'Brachygalaxias bullocki', 'Animalia', 'Chordata', 'Actinopterygii', 'Osmeriformes', 'Galaxiidae', 'Brachygalaxias', 0, '', '', '', '', '', '', ''),
(156, 'Perca', 'Percichthys trucha', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Percichthyidae ', 'Percichthys', 0, '', '', '', '', '', '', ''),
(157, 'Pescada', 'Merluccius gayi gayi', 'Animalia', 'Chordata', 'Actinopterygii', 'Gadiformes', 'Merlucciidae', 'Merluccius', 272453, '', '', '', '', '', '', ''),
(158, 'Pez aguja', 'Leptonotus blainvilleanus', 'Animalia', 'Chordata', 'Actinopterygii', 'Syngnathiformes', 'Syngnathidae', 'Leptonotus', 281324, '', '', '', '', '', '', ''),
(159, 'Pez espada', 'Xiphias gladius', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Xiphiidae', 'Xiphias', 127094, '', '', '', '', '', '', ''),
(160, 'Pintacha', 'Cheilodactylus variegatus', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Cheilodactylidae', 'Cheilodactylus', 278156, '', '', '', '', '', '', ''),
(161, 'Pocha', 'Cheirodon kiliani', 'Animalia', 'Chordata', 'Actinopterygii', 'Characiformes', 'Characidae', 'Cheirodon ', 0, '', '', '', '', '', '', ''),
(162, 'Pocha de los lagos', 'Cheirodon galgusdae', 'Animalia', 'Chordata', 'Actinopterygii', 'Characiformes', 'Characidae', 'Cheirodon ', 0, '', '', '', '', '', '', ''),
(163, 'Pocha del sur', 'Cheirodon australe', 'Animalia', 'Chordata', 'Actinopterygii', 'Characiformes', 'Characidae', 'Cheirodon ', 0, '', '', '', '', '', '', ''),
(164, 'Pochita', 'Gambusia holbrooki', 'Animalia', 'Chordata', 'Actinopterygii', 'Cyprinodontiformes', 'Poeciliidae', 'Gambusia', 276134, '', '', '', '', '', '', ''),
(165, 'Puye', 'Galaxias globiceps', 'Animalia', 'Chordata', 'Actinopterygii', 'Osmeriformes', 'Galaxiidae', 'Galaxias', 0, '', '', '', '', '', '', ''),
(166, 'Puye', 'Galaxias maculatus', 'Animalia', 'Chordata', 'Actinopterygii', 'Osmeriformes', 'Galaxiidae', 'Galaxias', 280811, '', '', '', '', '', '', ''),
(167, 'Puye', 'Galaxias spp.', 'Animalia', 'Chordata', 'Actinopterygii', 'Osmeriformes', 'Galaxiidae', 'Galaxias', 0, '', '', '', '', '', '', ''),
(168, 'Raya chilena', 'Zearaja chilensis', 'Animalia', 'Chordata', 'Elasmobranchii', 'Rajiformes', 'Rajidae', 'Zearaja', 315953, '', '', '', '', '', '', ''),
(169, 'Raya eléctrica', 'Discopyge tschudii', 'Animalia', 'Chordata', 'Elasmobranchii', 'Torpediniformes', 'Narcinidae', 'Discopyge', 280568, '', '', '', '', '', '', ''),
(170, 'Reineta', 'Brama australis', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Bramidae', 'Brama', 273146, '', '', '', '', '', '', ''),
(171, 'Reloj anaranjado', 'Hoplostethus atlanticus', 'Animalia', 'Chordata', 'Actinopterygii', 'Beryciformes', 'Trachichthyidae', 'Hoplostethus', 126402, '', '', '', '', '', '', ''),
(172, 'Remoremo', 'Elagatis bipinnulatus', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Carangidae', 'Elagatis', 302473, '', '', '', '', '', '', ''),
(173, 'Róbalo', 'Eleginops maclovinus', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Eleginopsidae', 'Eleginops', 280634, '', '', '', '', '', '', ''),
(174, 'Róbalo patagónico', 'Eleginops maclovinus', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Eleginopsidae', 'Eleginops', 280634, '', '', '', '', '', '', ''),
(175, 'Rococo', 'Paralonchurus peruanus', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Sciaenidae', 'Paralonchurus', 282066, '', '', '', '', '', '', ''),
(176, 'Rollizo', 'Pinguipes chilensis', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Pinguipedidae', 'Pinguipes', 279407, '', '', '', '', '', '', 'img/especies/Rollizo.jpg'),
(177, 'Roncacho', 'Sciaena deliciosa', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Sciaenidae', 'Sciaena', 273790, '', '', '', '', '', '', ''),
(178, 'Salmón del Atlántico', 'Salmo salar', 'Animalia', 'Chordata', 'Actinopterygii', 'Salmoniformes', 'Salmonidae', 'Salmo', 127186, '', '', '', '', '', '', ''),
(179, 'Salmón plateado', 'Oncorhynchus kisutch', 'Animalia', 'Chordata', 'Actinopterygii', 'Salmoniformes', 'Salmonidae', 'Oncorhynchus', 127184, '', '', '', '', '', '', ''),
(180, 'Salmón rey', 'Oncorhynchus tshawytscha', 'Animalia', 'Chordata', 'Actinopterygii', 'Salmoniformes', 'Salmonidae', 'Oncorhynchus', 158075, '', '', '', '', '', '', ''),
(181, 'San Pedro', 'Oplegnathus insignis', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Oplegnathidae', 'Oplegnathus', 277893, '', '', '', '', '', '', ''),
(182, 'Sardina', 'Sardinops sagax', 'Animalia', 'Chordata', 'Actinopterygii', 'Clupeiformes', 'Clupeidae', 'Sardinops', 217452, '', '', '', '', '', '', ''),
(183, 'Sardina austral', 'Sprattus fuegensis', 'Animalia', 'Chordata', 'Actinopterygii', 'Clupeiformes', 'Clupeidae', 'Sprattus', 272281, '', '', '', '', '', '', ''),
(184, 'Sardina común', 'Clupea bentincki', 'Animalia', 'Chordata', 'Actinopterygii', 'Clupeiformes', 'Clupeidae', 'Clupea', 300368, '', '', '', '', '', '', ''),
(185, 'Sardina española', 'Sardinops sagax', 'Animalia', 'Chordata', 'Actinopterygii', 'Clupeiformes', 'Clupeidae', 'Sardinops', 217452, '', '', '', '', '', '', ''),
(186, 'Sargo', 'Anisotremus scapularis', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Haemulidae', 'Anisotremus', 279622, '', '', '', '', '', '', ''),
(187, 'Sargo de peña', 'Sciaena fasciata', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Sciaenidae', 'Sciaena', 273791, '', '', '', '', '', '', ''),
(188, 'Sierra', 'Thyrsites atun', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Gempylidae', 'Thyrsites', 219697, '', '', '', '', '', '', ''),
(189, 'Tembladera', 'Discopyge tschudii', 'Animalia', 'Chordata', 'Elasmobranchii', 'Torpediniformes', 'Narcinidae', 'Discopyge', 280568, '', '', '', '', '', '', ''),
(190, 'Tenca', 'Tinca tinca', 'Animalia', 'Chordata', 'Actinopterygii', 'Cypriniformes', 'Cyprinidae', 'Tinca', 154343, '', '', '', '', '', '', ''),
(191, 'Tiburón', 'Isurus oxyrinchus', 'Animalia', 'Chordata', 'Elasmobranchii', 'Lamniformes', 'Lamnidae', 'Isurus', 105839, '', '', '', '', '', '', ''),
(192, 'Tiburón azulejo', 'Prionace glauca', 'Animalia', 'Chordata', 'Elasmobranchii', 'Carcharhiniformes', 'Carcharhinidae', 'Prionace', 105801, '', '', '', '', '', '', ''),
(193, 'Tiburón de aleta corta', 'Isurus oxyrinchus', 'Animalia', 'Chordata', 'Elasmobranchii', 'Lamniformes', 'Lamnidae', 'Isurus', 105839, '', '', '', '', '', '', ''),
(194, 'Tiburón martillo', 'Sphyrna Zygaena', 'Animalia', 'Chordata', 'Elasmobranchii', 'Carcharhiniformes', 'Sphyrnidae', 'Sphyrna', 105819, '', '', '', '', '', '', ''),
(195, 'Tiburón zorro', 'Alopias vulpinus', 'Animalia', 'Chordata', 'Elasmobranchii', 'Lamniformes', 'Alopiidae', 'Alopias', 105836, '', '', '', '', '', '', ''),
(196, 'Tollo', 'Mustelus mento', 'Animalia', 'Chordata', 'Elasmobranchii', 'Carcharhiniformes', 'Triakidae', 'Mustelus', 271390, '', '', '', '', '', '', ''),
(197, 'Tollo de cachos', 'Squalus acanthias', 'Animalia', 'Chordata', 'Elasmobranchii', 'Squaliformes', 'Squalidae', 'Squalus', 105923, '', '', '', '', '', '', ''),
(198, 'Tomollo de tres aletas', 'Tripterygion chilensis', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Tripterygiidae', 'Tripterygion', 305431, '', '', '', '', '', '', ''),
(199, 'Tomoyo', 'Labrisomus philippii', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Labrisomidae', 'Labrisomus', 281261, '', '', '', '', '', '', ''),
(200, 'Toremo', 'Seriola lalandi', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Carangidae', 'Seriola', 218436, '', '', '', '', '', '', ''),
(201, 'Torito', 'Hypsoblennius sordidus', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Blenniidae', 'Hypsoblennius', 276332, '', '', '', '', '', '', 'img/especies/Torito.jpg'),
(202, 'Torito de los canales', 'Cottoperca gobio', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Bovichtidae', 'Cottoperca', 280409, '', '', '', '', '', '', ''),
(203, 'Tritre', 'Ethmidium maculatum', 'Animalia', 'Chordata', 'Actinopterygii', 'Clupeiformes', 'Clupeidae', 'Ethmidium', 280726, '', '', '', '', '', '', ''),
(204, 'Trucha arcoiris', 'Oncorhynchus mykiss', 'Animalia', 'Chordata', 'Actinopterygii', 'Salmoniformes', 'Salmonidae', 'Oncorhynchus', 127185, '', '', '', '', '', '', ''),
(205, 'Trucha arcoíris', 'Oncorhynchus mykiss', 'Animalia', 'Chordata', 'Actinopterygii', 'Salmoniformes', 'Salmonidae', 'Oncorhynchus', 127185, '', '', '', '', '', '', ''),
(206, 'Trucha común', 'Salmo trutta', 'Animalia', 'Chordata', 'Actinopterygii', 'Salmoniformes', 'Salmonidae', 'Salmo', 127187, '', '', '', '', '', '', ''),
(207, 'Trucha criolla', 'Percichthys trucha', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Percichthyidae ', 'Percichthys', 0, '', '', '', '', '', '', ''),
(208, 'Trucha negra', 'Percichthys melanops', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Percichthyidae ', 'Percichthys', 0, '', '', '', '', '', '', ''),
(209, 'Turbot', 'Scophthalmus maximus', 'Animalia', 'Chordata', 'Actinopterygii', 'Pleuronectiformes', 'Scophthalmidae', 'Scophthalmus', 127149, '', '', '', '', '', '', ''),
(210, 'Vidriola', 'Seriola lalandi', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Carangidae', 'Seriola', 218436, '', '', '', '', '', '', ''),
(211, 'Vieja', 'Graus nigra', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Kyphosidae', 'Graus', 280941, '', '', '', '', '', '', 'img/especies/Vieja.jpg'),
(212, 'Vieja colorada', 'Acanthistius pictus', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Serranidae', 'Acanthistius', 278727, '', '', '', '', '', '', ''),
(213, 'Vieja, Mulata', 'Graus nigra', 'Animalia', 'Chordata', 'Actinopterygii', 'Perciformes', 'Kyphosidae', 'Graus', 280941, '', '', '', '', '', '', ''),
(214, '', 'Notocheirus hubbsi', 'Animalia', 'Chordata', 'Actinopterygii', 'Atheriniformes', 'Notocheiridae', 'Notocheirus', 281775, '', '', '', '', '', '', 'img/especies/Vieja.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitat`
--

CREATE TABLE IF NOT EXISTS `habitat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` varchar(45) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `habitat`
--

INSERT INTO `habitat` (`id`, `data`, `descripcion`) VALUES
(1, 'Bolones / Roca', ' Zona con dominancia de rocas de mediano a gran tamaño sobrepuestas en el fondo marino.'),
(2, 'Fondo blando', ' Zondo marino dominado por material arenoso, fango o limo.'),
(3, 'Pared rocosa', ' Pared vertical con caida de mas de 7 metros de altura.'),
(4, 'Bolones / Roca', ' Zona con dominancia de rocas de mediano a gran tamaño sobrepuestas en el fondo marino.'),
(5, 'Fondo blando', ' Zondo marino dominado por material arenoso, fango o limo.'),
(6, 'Pared rocosa', ' Pared vertical con caida de mas de 7 metros de altura.'),
(7, 'Acantilado', ' Zona de buceo contigua a acantilados, con una gran pendiente o gradiente de profundidad en una corta distancia.'),
(8, 'Motu', ' Gran roca o grupo de rocas con empinadas laderas que se levanta de las aguas profundas hacia la superficie.'),
(9, 'Bosque de macroalgas', ' Bosques o praderas de algas de gran tamaño.'),
(10, 'Oceano abierto', ' Buceo desarrollado en un area de gran profundidad, donde no es posible reconocer el fondo '),
(11, 'Pasto marino', ' Zonas con precencia de pasto marino sobre fondo blando.'),
(12, 'Estructura artificial', ' Estructura contruida por el hombre como muelles, naufragios, rompeolas o cualquier estructura no natural.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regiones`
--

CREATE TABLE IF NOT EXISTS `regiones` (
  `id` int(11) NOT NULL,
  `data` varchar(46) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `regiones`
--

INSERT INTO `regiones` (`id`, `data`) VALUES
(1, 'Arica y Parinacota\r'),
(2, 'Tarapacá\r'),
(3, 'Antofagasta\r'),
(4, 'Atacama\r'),
(5, 'Coquimbo\r'),
(6, 'Valparaíso\r'),
(7, 'Región del Libertador Bernardo O''higgins\r'),
(8, 'Región del Maule\r'),
(9, 'Región del BioBío\r'),
(10, 'Región de la Araucanía\r'),
(11, 'Región de los Ríos\r'),
(12, 'Región de los Lagos\r'),
(13, 'Región Aisén del Gral. Carlos Ibañez del Campo'),
(14, 'Región de Magallanes y de la Antártica Chilena'),
(15, 'Región Metropolitana de Santiago\r');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `nombre` varchar(45) DEFAULT NULL,
  `apellido_pat` varchar(45) DEFAULT NULL,
  `apellido_mat` varchar(45) DEFAULT NULL,
  `fecha_nac` date DEFAULT NULL,
  `genero` enum('Masculino','Femenino') DEFAULT NULL,
  `nombre_usuario` varchar(11) NOT NULL DEFAULT '',
  `email` varchar(45) NOT NULL,
  `pass` varchar(45) NOT NULL,
  `anios_buceo` int(11) DEFAULT NULL,
  `hrs_buceo` enum('Menos de 10 horas','11 - 30 horas','31 - 60 horas','61 - 100 horas','101 - 300 horas','300 + horas') DEFAULT NULL,
  `ciudad` varchar(45) DEFAULT NULL,
  `educacion` enum('Básica','Media','Superior','Postítulo') DEFAULT NULL,
  `experiencia` enum('Novato','Experto') DEFAULT NULL,
  `region` int(11) DEFAULT NULL,
  `centro_buceo` int(11) DEFAULT NULL,
  PRIMARY KEY (`nombre_usuario`),
  KEY `fk_usuario_region1_idx` (`region`),
  KEY `fk_usuario_centro_buceo1_idx` (`centro_buceo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`nombre`, `apellido_pat`, `apellido_mat`, `fecha_nac`, `genero`, `nombre_usuario`, `email`, `pass`, `anios_buceo`, `hrs_buceo`, `ciudad`, `educacion`, `experiencia`, `region`, `centro_buceo`) VALUES
('laskdjl', 'jlaksd', 'jkjalsd', '0000-00-00', 'Masculino', 'alsdkj', 'asldk@alsd.cl', '59742fa4e6291f354bb2004aa8ab42d2', 0, 'Menos de 10 horas', '', 'Básica', 'Novato', 1, 1),
('kaslkd', 'ljdalksjk', 'jlaksdj', '0000-00-00', 'Masculino', 'asdjlk', 'laskdjl@lkasjd.cl', '01f7c88fafaa5fcdcf58ec48a183eb06', 0, 'Menos de 10 horas', '', 'Básica', 'Novato', 1, 1),
('', NULL, NULL, NULL, NULL, 'develop', 'develop', 'a19ea622182c63ddc19bb22cde982b82', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('jldasdjlk', 'jdlkasjd', 'daksdj', '0000-00-00', 'Masculino', 'laksdj', 'ljalskdj@alksjd.cl', 'd273d776eef481e675aa9f31d04a8f63', 0, 'Menos de 10 horas', '', 'Básica', 'Novato', 1, 1),
('jjasdj', 'jdaksjdk', 'jdkjaksd', '0000-00-00', 'Masculino', 'lkasdl', 'kjlasjdl@aksld.cl', '6610ec1efcdf40b6dbffe20b50bff02b', 0, 'Menos de 10 horas', '', 'Básica', 'Novato', 1, 1),
('prod', NULL, NULL, NULL, NULL, 'prod', 'prod@prod.cl', 'd6e4a9b6646c62fc48baa6dd6150d1f7', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('test', 'test', 'test', '2015-01-29', 'Masculino', 'test', 'test', '098f6bcd4621d373cade4e832627b4f6', 2, '11 - 30 horas', 'test', 'Básica', 'Novato', 1, 2);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `buceos`
--
ALTER TABLE `buceos`
  ADD CONSTRAINT `buceos_ibfk_1` FOREIGN KEY (`nombre_usuario`) REFERENCES `usuarios` (`nombre_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `buceo_especie`
--
ALTER TABLE `buceo_especie`
  ADD CONSTRAINT `buceo_especie_ibfk_1` FOREIGN KEY (`id_buceo`) REFERENCES `buceos` (`id`),
  ADD CONSTRAINT `buceo_especie_ibfk_2` FOREIGN KEY (`id_especie`) REFERENCES `especies` (`id`);

--
-- Filtros para la tabla `buceo_habitat`
--
ALTER TABLE `buceo_habitat`
  ADD CONSTRAINT `buceo_habitat_ibfk_2` FOREIGN KEY (`idbuceo`) REFERENCES `buceos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `buceo_habitat_ibfk_1` FOREIGN KEY (`idhabitat`) REFERENCES `habitat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`centro_buceo`) REFERENCES `centro_buceo` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`region`) REFERENCES `regiones` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
