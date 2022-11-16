-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-11-2022 a las 01:30:52
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tpe_especial`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `ID` int(11) NOT NULL,
  `comentario` varchar(255) NOT NULL,
  `ID_Juego` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`ID`, `comentario`, `ID_Juego`) VALUES
(24, 'Buen juego', 28),
(25, 'Mal juego', 28),
(26, 'El juego mas aburrido de mi vida', 28),
(27, 'Aburrido Juego', 28),
(32, 'Buen juego', 33),
(33, 'Mal juego', 33),
(34, 'Aburrido Juego', 33);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--

CREATE TABLE `generos` (
  `Genero_ID` int(11) NOT NULL,
  `Edad` int(11) NOT NULL,
  `Genero` varchar(45) NOT NULL,
  `Particularidad` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `generos`
--

INSERT INTO `generos` (`Genero_ID`, `Edad`, `Genero`, `Particularidad`) VALUES
(2, 9, 'Deportivo', 'Fútbol, tenis, baloncesto, conducción y demás deportes... Recrean diversos deportes. Requieren habilidad, rapidez y precisión.'),
(15, 12, 'Estrategia', 'Aventuras, rol, juegos de guerra, etc. Consisten en trazar una estrategia para superar al contrincante. Exigen concentración, saber administrar recursos, pensar y definir estrategias. Saga icónica de estrategia como el Age Of Empires.'),
(16, 4, 'Arcade', 'Plataformas, laberintos, aventuras. El usuario debe superar pantallas para seguir jugando. Imponen un ritmo rápido y requieren tiempos de reacción mínimos... Tetris, Sonic y demas históricos juegos.'),
(17, 160, 'Simulaaaaaaador', 'Aviones, simuladores de una situación o instrumentales. Permiten experimentar e investigar el funcionamiento de máquinas, fenómenos, situaciones y asumir el mando.\r\n'),
(18, 14, 'Acción', 'Lucha y peleas. Basados en ejercicios de repetición (por ejemplo, pulsar un botón para que el personaje ejecute una acción).'),
(28, 2, 'Musicales', 'Se trata de juegos que involucran la interacción con alguna melodía. En algunos casos involucran periféricos especiales que imitan instrumentos musicales o alfombras para bailar pisando botones.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juegos`
--

CREATE TABLE `juegos` (
  `ID_Juego` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Fecha` varchar(45) NOT NULL,
  `Precio` int(11) NOT NULL,
  `Descripcion` varchar(5000) NOT NULL,
  `Genero_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `juegos`
--

INSERT INTO `juegos` (`ID_Juego`, `Nombre`, `Fecha`, `Precio`, `Descripcion`, `Genero_ID`) VALUES
(26, 'Assassin\'s Creed 4', 'Oct 29, 2013', 7000, 'Cuarta entrega numerada de la popular saga de acción y aventuras Assassin\'s Creed, que se ambienta en el mundo de los piratas. En el juego asumiremos el rol del capitán Edward Kenway, padre de Haytham Kenway y abuelo de Connor Kenway, protagonista de Assassin\'s Creed III.', 18),
(28, 'Age of Empires IV', 'Oct 28, 2021', 16000, 'Da una mayor importancia a los asedios en las batallas más grandes que se han librado jamás en esta veterana serie de Microsoft. Las tropas pueden apostarse sobre las murallas y los atacantes pueden recurrir a una gran variedad de máquinas de asedio. Las empalizadas son algunas de las medidas defensivas que podemos usar para protegernos de estos ataques, pero hay otras novedades importantes en AoE IV, como la asimetría entre las civilizaciones.', 15),
(29, 'Microsoft Flight Simulator', 'Ago 17, 2020', 5000, 'Microsoft Flight Simulator es la nueva entrega de la reputada saga de simulación de vuelo de Microsoft. En esta ocasión, y a cargo de Asobo Studio, tenemos una secuela más realista, con mejores gráficos y un buen número de modelos comerciales y personales de aviones y avionetas, más que en ninguna ocasión anterior. Con un sistema de físicas y simulación meteorológica más complejo, con nubes volumétricas y cambios de luz inimaginables hace unos años, aprovechará la tecnología en la nube de Azure, mostrándose a la máxima calidad en PC y Xbox One.', 17),
(30, 'Los Sims 4', 'Sep 9, 2014', 3000, 'Es la nueva entrega de la serie de simulación social de Maxis que nos propone controlar a estos seres virtuales y hacer que evolucionen en sus vidas. Esta cuarta entrega incluye mayor libertad que nunca para construir la vivienda de nuestros Sims, con más opciones de diseño, y un sistema de elecciones que hará que las decisiones que tomen nuestros seres virtuales afecten a su vida.', 17),
(31, 'Tony Hawk\'s Pro Skater 1 + 2', 'Mar 3, 2022', 12000, 'Supone el regreso de la leyenda del skate al mundo de los videojuegos. En esta nueva entrega para Xbox One, PS4 y PC veremos una profunda actualización de los dos primeros juegos con gráficos mejorados, mientras que ofrecerá una modalidad multijugador online y la música original.', 2),
(32, 'FIFA 19', 'Sep 28, 2019', 2000, 'Saga de videojuegos de fútbol de EA Sports, diseñada para consolas como Xbox One, PS4, Nintendo Switch y plataformas como PC. En esta ocasión, mejorando los avances visto en su más reciente secuela, nos presenta novedades a niveles jugables en términos tácticos y de control, gráficos más realistas y la entrada de la esperada licencia de la UEFA Champions League. ', 2),
(33, 'Snow bros', 'Aug 21, 1990', 150, 'Es uno de los juegos más importantes en el formato plataforma, y en mi opinión es el mejor que he jugado en este estilo de juego. Este arcade tiene como protagonista un muñeco de nieve que deberá matar a todos sus oponentes en cada plataforma lanzando bolas de nieve y convirtiéndolos en una gran bola que puedes lanzar a los demás monstruos del juego.\r\n\r\nEl carismático juego se caracteriza por la utilización de pociones de colores que le darán al personaje principal una mejora de sus habilidades', 16),
(34, 'Pac-Man', 'May 10, 1980', 10, 'El diseñador de videojuegos Toru Iwatani de la empresa nipona Namco, crea en 1980 lo que después de 40 años sigue siendo uno de los mejores juegos arcades de la historia de los videojuegos ostentando un récord guinness como la máquina arcade más vendida. Pac-Man es el divertido personaje amarillo en forma de redonda que se dedica a comer puntitos y frutas a través de un pequeño laberinto donde unos fantasmas de colores harán lo imposible por llevarte al cementerio.', 16),
(79, 'Mu Online', 'Aug 15, 2021', 1200, 'Juego RPG blablabla...', 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `name` varchar(245) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `name`) VALUES
(1, 'joacopavon@hotmail.com', '$2a$12$PvwHHXVRkDviHGI/NDLANuMtNXwb4x6hD0C1BmlbcM2PnD8INBuTS', 'Pavel');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_Juego` (`ID_Juego`);

--
-- Indices de la tabla `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`Genero_ID`);

--
-- Indices de la tabla `juegos`
--
ALTER TABLE `juegos`
  ADD PRIMARY KEY (`ID_Juego`),
  ADD KEY `Genero_ID` (`Genero_ID`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `generos`
--
ALTER TABLE `generos`
  MODIFY `Genero_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `juegos`
--
ALTER TABLE `juegos`
  MODIFY `ID_Juego` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`ID_Juego`) REFERENCES `juegos` (`ID_Juego`);

--
-- Filtros para la tabla `juegos`
--
ALTER TABLE `juegos`
  ADD CONSTRAINT `juegos_idfk_1` FOREIGN KEY (`Genero_ID`) REFERENCES `generos` (`Genero_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
