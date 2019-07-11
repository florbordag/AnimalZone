-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-07-2019 a las 05:11:18
-- Versión del servidor: 10.1.35-MariaDB
-- Versión de PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `animalzone`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `ID_USUARIO` int(11) NOT NULL,
  `USERNAME` varchar(200) NOT NULL,
  `PASSWORD` varchar(200) NOT NULL,
  `ESTADO` int(1) DEFAULT NULL,
  `USUARIO_ALTA` varchar(200) NOT NULL,
  `FECHA_ALTA` datetime NOT NULL,
  `USUARIO_ULT_MOD` varchar(200) DEFAULT NULL,
  `FECHA_ULT_MOD` datetime DEFAULT NULL,
  `MAIL` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amigo`
--

CREATE TABLE `amigo` (
  `ID_USUARIO_S` int(11) NOT NULL,
  `ID_USUARIO_R` int(11) NOT NULL,
  `ESTADO` int(1) NOT NULL,
  `FECHA` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `ID_COMENTARIO` int(11) NOT NULL,
  `ID_POST` int(11) NOT NULL,
  `ID_USUARIO` int(11) NOT NULL,
  `DESCRIPCION` varchar(200) DEFAULT NULL,
  `FECHA` datetime DEFAULT NULL,
  `ESTADO` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `denuncia_post`
--

CREATE TABLE `denuncia_post` (
  `ID_POST` int(11) NOT NULL,
  `ID_USUARIO` int(11) NOT NULL,
  `FECHA_DENUNCIA` datetime NOT NULL,
  `ID_USUARIO_MOD` int(11) NOT NULL,
  `MOTIVO` varchar(200) NOT NULL,
  `FECHA_MODERACION` datetime DEFAULT NULL,
  `ID_COMENTARIO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `moderador`
--

CREATE TABLE `moderador` (
  `ID_USUARIO_MOD` int(11) NOT NULL,
  `USERNAME` varchar(200) NOT NULL,
  `PASSWORD` varchar(200) NOT NULL,
  `ESTADO` int(1) DEFAULT NULL,
  `USUARIO_ALTA` varchar(200) NOT NULL,
  `FECHA_ALTA` datetime NOT NULL,
  `USUARIO_ULT_MOD` varchar(200) DEFAULT NULL,
  `FECHA_ULT_MOD` datetime DEFAULT NULL,
  `MAIL` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `codigo` varchar(2) NOT NULL,
  `pais` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`codigo`, `pais`) VALUES
('A1', 'Anonymous Proxy'),
('A2', 'Satellite Provider'),
('AD', 'Andorra'),
('AE', 'United Arab Emirates'),
('AF', 'Afghanistan'),
('AG', 'Antigua and Barbuda'),
('AI', 'Anguilla'),
('AL', 'Albania'),
('AM', 'Armenia'),
('AO', 'Angola'),
('AP', 'Asia/Pacific Region'),
('AQ', 'Antarctica'),
('AR', 'Argentina'),
('AS', 'American Samoa'),
('AT', 'Austria'),
('AU', 'Australia'),
('AW', 'Aruba'),
('AX', 'Aland Islands'),
('AZ', 'Azerbaijan'),
('BA', 'Bosnia and Herzegovina'),
('BB', 'Barbados'),
('BD', 'Bangladesh'),
('BE', 'Belgium'),
('BF', 'Burkina Faso'),
('BG', 'Bulgaria'),
('BH', 'Bahrain'),
('BI', 'Burundi'),
('BJ', 'Benin'),
('BL', 'Saint Barthelemy'),
('BM', 'Bermuda'),
('BN', 'Brunei Darussalam'),
('BO', 'Bolivia'),
('BQ', 'Bonair'),
('BR', 'Brazil'),
('BS', 'Bahamas'),
('BT', 'Bhutan'),
('BW', 'Botswana'),
('BY', 'Belarus'),
('BZ', 'Belize'),
('CA', 'Canada'),
('CC', 'Cocos (Keeling) Islands'),
('CD', 'Cong'),
('CF', 'Central African Republic'),
('CG', 'Congo'),
('CH', 'Switzerland'),
('CI', 'Cote D\'Ivoire'),
('CK', 'Cook Islands'),
('CL', 'Chile'),
('CM', 'Cameroon'),
('CN', 'China'),
('CO', 'Colombia'),
('CR', 'Costa Rica'),
('CU', 'Cuba'),
('CV', 'Cape Verde'),
('CW', 'Curacao'),
('CX', 'Christmas Island'),
('CY', 'Cyprus'),
('CZ', 'Czech Republic'),
('DE', 'Germany'),
('DJ', 'Djibouti'),
('DK', 'Denmark'),
('DM', 'Dominica'),
('DO', 'Dominican Republic'),
('DZ', 'Algeria'),
('EC', 'Ecuador'),
('EE', 'Estonia'),
('EG', 'Egypt'),
('EH', 'Western Sahara'),
('ER', 'Eritrea'),
('ES', 'Spain'),
('ET', 'Ethiopia'),
('EU', 'Europe'),
('FI', 'Finland'),
('FJ', 'Fiji'),
('FK', 'Falkland Islands (Malvinas)'),
('FM', 'Micronesi'),
('FO', 'Faroe Islands'),
('FR', 'France'),
('GA', 'Gabon'),
('GB', 'United Kingdom'),
('GD', 'Grenada'),
('GE', 'Georgia'),
('GF', 'French Guiana'),
('GG', 'Guernsey'),
('GH', 'Ghana'),
('GI', 'Gibraltar'),
('GL', 'Greenland'),
('GM', 'Gambia'),
('GN', 'Guinea'),
('GP', 'Guadeloupe'),
('GQ', 'Equatorial Guinea'),
('GR', 'Greece'),
('GS', 'South Georgia and the South Sandwich Islands'),
('GT', 'Guatemala'),
('GU', 'Guam'),
('GW', 'Guinea-Bissau'),
('GY', 'Guyana'),
('HK', 'Hong Kong'),
('HN', 'Honduras'),
('HR', 'Croatia'),
('HT', 'Haiti'),
('HU', 'Hungary'),
('ID', 'Indonesia'),
('IE', 'Ireland'),
('IL', 'Israel'),
('IM', 'Isle of Man'),
('IN', 'India'),
('IO', 'British Indian Ocean Territory'),
('IQ', 'Iraq'),
('IR', 'Ira'),
('IS', 'Iceland'),
('IT', 'Italy'),
('JE', 'Jersey'),
('JM', 'Jamaica'),
('JO', 'Jordan'),
('JP', 'Japan'),
('KE', 'Kenya'),
('KG', 'Kyrgyzstan'),
('KH', 'Cambodia'),
('KI', 'Kiribati'),
('KM', 'Comoros'),
('KN', 'Saint Kitts and Nevis'),
('KP', 'Kore'),
('KR', 'Kore'),
('KW', 'Kuwait'),
('KY', 'Cayman Islands'),
('KZ', 'Kazakhstan'),
('LA', 'Lao People\'s Democratic Republic'),
('LB', 'Lebanon'),
('LC', 'Saint Lucia'),
('LI', 'Liechtenstein'),
('LK', 'Sri Lanka'),
('LR', 'Liberia'),
('LS', 'Lesotho'),
('LT', 'Lithuania'),
('LU', 'Luxembourg'),
('LV', 'Latvia'),
('LY', 'Libya'),
('MA', 'Morocco'),
('MC', 'Monaco'),
('MD', 'Moldov'),
('ME', 'Montenegro'),
('MF', 'Saint Martin'),
('MG', 'Madagascar'),
('MH', 'Marshall Islands'),
('MK', 'Macedonia'),
('ML', 'Mali'),
('MM', 'Myanmar'),
('MN', 'Mongolia'),
('MO', 'Macau'),
('MP', 'Northern Mariana Islands'),
('MQ', 'Martinique'),
('MR', 'Mauritania'),
('MS', 'Montserrat'),
('MT', 'Malta'),
('MU', 'Mauritius'),
('MV', 'Maldives'),
('MW', 'Malawi'),
('MX', 'Mexico'),
('MY', 'Malaysia'),
('MZ', 'Mozambique'),
('NA', 'Namibia'),
('NC', 'New Caledonia'),
('NE', 'Niger'),
('NF', 'Norfolk Island'),
('NG', 'Nigeria'),
('NI', 'Nicaragua'),
('NL', 'Netherlands'),
('NO', 'Norway'),
('NP', 'Nepal'),
('NR', 'Nauru'),
('NU', 'Niue'),
('NZ', 'New Zealand'),
('OM', 'Oman'),
('PA', 'Panama'),
('PE', 'Peru'),
('PF', 'French Polynesia'),
('PG', 'Papua New Guinea'),
('PH', 'Philippines'),
('PK', 'Pakistan'),
('PL', 'Poland'),
('PM', 'Saint Pierre and Miquelon'),
('PN', 'Pitcairn Islands'),
('PR', 'Puerto Rico'),
('PS', 'Palestinian Territory'),
('PT', 'Portugal'),
('PW', 'Palau'),
('PY', 'Paraguay'),
('QA', 'Qatar'),
('RE', 'Reunion'),
('RO', 'Romania'),
('RS', 'Serbia'),
('RU', 'Russian Federation'),
('RW', 'Rwanda'),
('SA', 'Saudi Arabia'),
('SB', 'Solomon Islands'),
('SC', 'Seychelles'),
('SD', 'Sudan'),
('SE', 'Sweden'),
('SG', 'Singapore'),
('SH', 'Saint Helena'),
('SI', 'Slovenia'),
('SJ', 'Svalbard and Jan Mayen'),
('SK', 'Slovakia'),
('SL', 'Sierra Leone'),
('SM', 'San Marino'),
('SN', 'Senegal'),
('SO', 'Somalia'),
('SR', 'Suriname'),
('SS', 'South Sudan'),
('ST', 'Sao Tome and Principe'),
('SV', 'El Salvador'),
('SX', 'Sint Maarten (Dutch part)'),
('SY', 'Syrian Arab Republic'),
('SZ', 'Swaziland'),
('TC', 'Turks and Caicos Islands'),
('TD', 'Chad'),
('TF', 'French Southern Territories'),
('TG', 'Togo'),
('TH', 'Thailand'),
('TJ', 'Tajikistan'),
('TK', 'Tokelau'),
('TL', 'Timor-Leste'),
('TM', 'Turkmenistan'),
('TN', 'Tunisia'),
('TO', 'Tonga'),
('TR', 'Turkey'),
('TT', 'Trinidad and Tobago'),
('TV', 'Tuvalu'),
('TW', 'Taiwan'),
('TZ', 'Tanzani'),
('UA', 'Ukraine'),
('UG', 'Uganda'),
('UM', 'United States Minor Outlying Islands'),
('US', 'United States'),
('UY', 'Uruguay'),
('UZ', 'Uzbekistan'),
('VA', 'Holy See (Vatican City State)'),
('VC', 'Saint Vincent and the Grenadines'),
('VE', 'Venezuela'),
('VG', 'Virgin Island'),
('VI', 'Virgin Island'),
('VN', 'Vietnam'),
('VU', 'Vanuatu'),
('WF', 'Wallis and Futuna'),
('WS', 'Samoa'),
('YE', 'Yemen'),
('YT', 'Mayotte'),
('ZA', 'South Africa'),
('ZM', 'Zambia'),
('ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post`
--

CREATE TABLE `post` (
  `ID_POST` int(11) NOT NULL,
  `ID_USUARIO` int(11) NOT NULL,
  `DESCRIPCION` varchar(200) DEFAULT NULL,
  `FECHA` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `TITULO` varchar(200) DEFAULT NULL,
  `IMAGEN1` varchar(200) DEFAULT NULL,
  `IMAGEN2` varchar(200) DEFAULT NULL,
  `IMAGEN3` varchar(200) DEFAULT NULL,
  `ADJUNTO` varchar(200) DEFAULT NULL,
  `PALABRA1` varchar(200) DEFAULT NULL,
  `PALABRA2` varchar(200) DEFAULT NULL,
  `PALABRA3` varchar(200) DEFAULT NULL,
  `ESTADO` int(1) NOT NULL,
  `PUBLICO` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `post`
--

INSERT INTO `post` (`ID_POST`, `ID_USUARIO`, `DESCRIPCION`, `FECHA`, `TITULO`, `IMAGEN1`, `IMAGEN2`, `IMAGEN3`, `ADJUNTO`, `PALABRA1`, `PALABRA2`, `PALABRA3`, `ESTADO`, `PUBLICO`) VALUES
(1, 171, 'descripciones del post', '2019-07-18 00:00:00', 'titulo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0),
(2, 171, 'yfikyv', '2019-07-09 08:08:14', 'titulo 2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0),
(9, 172, 'wertyuiop', '2019-07-09 09:45:49', 'qwe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `ID_USUARIO` int(11) NOT NULL,
  `USERNAME` varchar(200) NOT NULL,
  `PASSWORD` varchar(200) NOT NULL,
  `SALT` varchar(500) DEFAULT NULL,
  `ESTADO` int(1) DEFAULT NULL,
  `USUARIO_ALTA` varchar(200) DEFAULT NULL,
  `FECHA_ALTA` datetime DEFAULT NULL,
  `USUARIO_ULT_MOD` varchar(200) DEFAULT NULL,
  `FECHA_ULT_MOD` datetime DEFAULT CURRENT_TIMESTAMP,
  `NOMBRE` varchar(200) NOT NULL,
  `APELLIDO` varchar(200) NOT NULL,
  `SEXO` varchar(20) DEFAULT NULL,
  `MAIL` varchar(200) NOT NULL,
  `IMAGEN_PERFIL` varchar(200) DEFAULT 'https://image.freepik.com/iconos-gratis/usuario_318-10541.jpg',
  `ANIMAL_FAV` varchar(30) DEFAULT NULL,
  `PAIS` varchar(2) DEFAULT NULL,
  `CP` varchar(30) DEFAULT NULL,
  `NACIMIENTO` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ID_USUARIO`, `USERNAME`, `PASSWORD`, `SALT`, `ESTADO`, `USUARIO_ALTA`, `FECHA_ALTA`, `USUARIO_ULT_MOD`, `FECHA_ULT_MOD`, `NOMBRE`, `APELLIDO`, `SEXO`, `MAIL`, `IMAGEN_PERFIL`, `ANIMAL_FAV`, `PAIS`, `CP`, `NACIMIENTO`) VALUES
(171, '', 'flor', '', 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '', 'Femenino', 'elmismo@gmail.com', '', '', 'AR', '', '0000-00-00'),
(172, 'santisepu', '85dcc0c39100c66b34c585c3e24bcfb2eb905a876c0a94305f61cc5a9bd0ce4f', 'c164693150e2657ec1cc487ff0482e1170cdd55819d41317b8410cc7891e4877', NULL, NULL, NULL, NULL, NULL, 'Mark', 'Otto', NULL, 'santi@gmail.com', 'https://image.freepik.com/iconos-gratis/usuario_318-10541.jpg', NULL, 'AT', NULL, NULL),
(235, 'florbordag', '8396e7a683693e773db774646f42ce2362b2276036365511e287dfc204eff468', '299bd432fd29d873ed89a13d3e7c8abce2b10fcb7b2d43202e60515fd3e1994a', 0, '', '0000-00-00 00:00:00', '2019-07-11-03-40-37', '0000-00-00 00:00:00', 'Florencia', 'Flores', 'Femenino', 'florbordag@gmail.com', '', 'Tigre', 'AR', '5700', '1990-07-26'),
(236, 'florbordag', 'f8a3fecd398761713ce8339cef8b308cf05f29ab4c0133a5a0fad710900e83d6', '3034afa67716b5050a26c5d7fe66cbd8e4d5b5532e48f621e9d81d82885f4602', 0, '', '0000-00-00 00:00:00', '2019-07-11-03-46-01', '0000-00-00 00:00:00', 'Lola', 'Reeves', 'Femenino', 'elmismo@dd', 'http://localhost/AnimalZone/appmvc/public/img/profile/', 'Tigre', 'AO', '5700', '2012-03-08'),
(237, 'florbordag', '5586a296130fbd0ca8de32eede6b085bd41c3d69b1d9e1fbcc0503ff0ae468c1', 'ccab8ece2ba8c5a784a0226596f4731949f192189e6f6034f290d72f7b4dd3b0', NULL, NULL, NULL, NULL, NULL, 'Mark', 'Otto', NULL, 'lolita@gmail.com', 'https://image.freepik.com/iconos-gratis/usuario_318-10541.jpg', NULL, 'AR', NULL, NULL),
(238, 'florbordag', '834f1ad5e0de2dd3a51b59db804519f049ab0fe64277a5630f76a192e45db5cd', 'ec16b5a5a4975378c8799b2bb71d55afd9af0cdf8a1fc8346840be9f9dc662a3', 0, '', '0000-00-00 00:00:00', '2019-07-11-04-13-49', '0000-00-00 00:00:00', 'Florencia', 'Otto', 'Femenino', 'santi@gmail.coma', 'http://localhost/AnimalZone/appmvc/public/img/profile/portada.png', '', 'AM', '', '0000-00-00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`ID_USUARIO`),
  ADD KEY `AI_ID_USUARIO` (`ID_USUARIO`);

--
-- Indices de la tabla `amigo`
--
ALTER TABLE `amigo`
  ADD PRIMARY KEY (`ID_USUARIO_S`,`ID_USUARIO_R`),
  ADD KEY `ID_USUARIO_R` (`ID_USUARIO_R`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`ID_COMENTARIO`),
  ADD KEY `AI_ID_COMENTARIO` (`ID_COMENTARIO`),
  ADD KEY `ID_USUARIO` (`ID_USUARIO`),
  ADD KEY `ID_POST` (`ID_POST`);

--
-- Indices de la tabla `denuncia_post`
--
ALTER TABLE `denuncia_post`
  ADD PRIMARY KEY (`ID_POST`,`ID_USUARIO`,`FECHA_DENUNCIA`),
  ADD KEY `ID_USUARIO` (`ID_USUARIO`),
  ADD KEY `ID_USUARIO_MOD` (`ID_USUARIO_MOD`),
  ADD KEY `ID_COMENTARIO` (`ID_COMENTARIO`);

--
-- Indices de la tabla `moderador`
--
ALTER TABLE `moderador`
  ADD PRIMARY KEY (`ID_USUARIO_MOD`),
  ADD KEY `AI_ID_USUARIO_MOD` (`ID_USUARIO_MOD`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`ID_POST`),
  ADD KEY `AI_ID_POST` (`ID_POST`),
  ADD KEY `ID_USUARIO` (`ID_USUARIO`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID_USUARIO`),
  ADD UNIQUE KEY `MAIL` (`MAIL`),
  ADD KEY `AI_ID_USUARIO` (`ID_USUARIO`),
  ADD KEY `PAIS` (`PAIS`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `ID_USUARIO` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `ID_COMENTARIO` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `moderador`
--
ALTER TABLE `moderador`
  MODIFY `ID_USUARIO_MOD` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `post`
--
ALTER TABLE `post`
  MODIFY `ID_POST` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID_USUARIO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=239;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `amigo`
--
ALTER TABLE `amigo`
  ADD CONSTRAINT `amigo_ibfk_1` FOREIGN KEY (`ID_USUARIO_S`) REFERENCES `usuario` (`ID_USUARIO`),
  ADD CONSTRAINT `amigo_ibfk_2` FOREIGN KEY (`ID_USUARIO_R`) REFERENCES `usuario` (`ID_USUARIO`);

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuario` (`ID_USUARIO`),
  ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`ID_POST`) REFERENCES `post` (`ID_POST`);

--
-- Filtros para la tabla `denuncia_post`
--
ALTER TABLE `denuncia_post`
  ADD CONSTRAINT `denuncia_post_ibfk_1` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuario` (`ID_USUARIO`),
  ADD CONSTRAINT `denuncia_post_ibfk_2` FOREIGN KEY (`ID_USUARIO_MOD`) REFERENCES `moderador` (`ID_USUARIO_MOD`),
  ADD CONSTRAINT `denuncia_post_ibfk_3` FOREIGN KEY (`ID_POST`) REFERENCES `post` (`ID_POST`),
  ADD CONSTRAINT `denuncia_post_ibfk_4` FOREIGN KEY (`ID_COMENTARIO`) REFERENCES `comentario` (`ID_COMENTARIO`);

--
-- Filtros para la tabla `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuario` (`ID_USUARIO`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`PAIS`) REFERENCES `pais` (`codigo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
