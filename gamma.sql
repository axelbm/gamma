-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 20 Janvier 2016 à 04:53
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `gamma`
--

-- --------------------------------------------------------

--
-- Structure de la table `answer`
--

CREATE TABLE IF NOT EXISTS `answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page` int(11) NOT NULL,
  `destination` int(11) NOT NULL,
  `content` text NOT NULL,
  `creator` int(11) NOT NULL,
  `publication_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `answer`
--

INSERT INTO `answer` (`id`, `page`, `destination`, `content`, `creator`, `publication_date`) VALUES
(1, 1, 2, 'Nullam vitae augue nibh. Suspendisse eget congue purus. Nullam fringilla purus at sapien tincidunt, nec malesuada ex sodales.', 1, '2016-01-20 02:58:44'),
(2, 1, 3, 'Phasellus condimentum viverra maximus. Sed congue ultricies facilisis. In hac habitasse platea dictumst. ', 1, '2016-01-20 02:58:44'),
(4, 1, 3, 'Vestibulum ut sagittis nisi.', 1, '2016-01-20 02:59:44');

-- --------------------------------------------------------

--
-- Structure de la table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `language` varchar(2) NOT NULL,
  `starting_page` int(11) NOT NULL,
  `creator` int(11) NOT NULL,
  `publication_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `permition` varchar(3) NOT NULL,
  `group` int(11) DEFAULT NULL,
  `adult` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `books`
--

INSERT INTO `books` (`id`, `title`, `description`, `language`, `starting_page`, `creator`, `publication_date`, `permition`, `group`, `adult`) VALUES
(1, 'Mon premier livre!', 'Ce livre n''est pas un vrai livre, ce n''est qu''un test. Integer a condimentum nunc. Curabitur condimentum mi sed justo placerat ultrices sit amet vitae sapien. Ut malesuada placerat mi, quis fringilla risus sagittis id. Suspendisse dignissim eget risus vel convallis. Integer turpis neque, auctor id est ac, dictum euismod metus. Vestibulum accumsan, sem id pellentesque consectetur, sem nibh pretium ligula, sed aliquet lectus turpis vitae diam. Proin ut nibh sodales, eleifend neque ac, tempor elit.', 'FR', 1, 1, '2016-01-19 04:33:31', '000', NULL, 0),
(2, 'C''est la suite du Temps', 'C''est un autre test, je veux avoir un peu de contenu sur la page d''accueille, alors je crée des faux livres! Quisque lacus diam, hendrerit sit amet luctus sed, sagittis sed velit. Suspendisse sit amet ipsum lobortis, iaculis ex in, molestie dolor. Morbi lacinia elit eu arcu pharetra ultricies. Fusce egestas bibendum dui a dignissim. Aenean imperdiet leo quis suscipit aliquam. Mauris tempor bibendum enim fermentum feugiat. Pellentesque pretium commodo urna et scelerisque.', 'FR', 0, 2, '2016-01-19 04:36:05', '000', NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `global`
--

CREATE TABLE IF NOT EXISTS `global` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(32) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Contenu de la table `global`
--

INSERT INTO `global` (`id`, `title`, `description`) VALUES
(1, 'Test', 'rien de special, ouais, c''est pas génial :/'),
(2, 'Test n2', 'un autre test et encore une fois, ce n''est pas très génial...'),
(3, 'test3', 'test par requet sql sur php'),
(4, 'test4', 'test sans erreur'),
(5, 'testproute', 'oulala comme c''est joli'),
(22, 'testproute', 'oulala comme c''est joli'),
(23, 'testproute', 'oulala comme c''est joli'),
(24, 'testproute', 'oulala comme c''est joli'),
(25, 'testproute', 'oulala comme c''est joli'),
(26, 'testproute', 'oulala comme c''est joli'),
(27, 'testproute', 'oulala comme c''est joli'),
(28, 'testproute', 'oulala comme c''est joli'),
(29, 'testproute', 'oulala comme c''est joli');

-- --------------------------------------------------------

--
-- Structure de la table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(64) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `birtdate` date NOT NULL,
  `country` varchar(64) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `confirmation_token` varchar(32) NOT NULL,
  `connection_token` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `member`
--

INSERT INTO `member` (`id`, `email`, `username`, `password`, `birtdate`, `country`, `registration_date`, `confirmed`, `confirmation_token`, `connection_token`) VALUES
(1, 'axel@gmail.com', 'Axel', '5473e3f141e0328ce87dac9366e0aace', '0000-00-00', 'CA', '2016-01-13 15:15:07', 1, '', ''),
(2, 'bog@gmail.com', 'Bob', '5473e3f141e0328ce87dac9366e0aace', '0000-00-00', 'CA', '2016-01-13 15:19:42', 1, '', ''),
(3, 'bog2@gmail.com', 'Boob', '5473e3f141e0328ce87dac9366e0aace', '2000-01-01', 'CA', '2016-01-13 15:20:34', 0, 'e5b7127101b6a882d2ac1cf3f5598642', ''),
(4, 'superpatate@gmail.com', 'SuperPapate', '5473e3f141e0328ce87dac9366e0aace', '1996-07-20', 'CA', '2016-01-13 16:10:30', 1, '', '');

-- --------------------------------------------------------

--
-- Structure de la table `member_connection`
--

CREATE TABLE IF NOT EXISTS `member_connection` (
  `id` int(11) NOT NULL,
  `ip` varchar(32) NOT NULL,
  `connection_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `disconnect_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book` int(11) NOT NULL,
  `title` varchar(256) DEFAULT NULL,
  `content` text NOT NULL,
  `creator` int(11) NOT NULL,
  `updator` int(11) DEFAULT NULL,
  `publication_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `pages`
--

INSERT INTO `pages` (`id`, `book`, `title`, `content`, `creator`, `updator`, `publication_date`, `update_date`) VALUES
(1, 1, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque egestas eu mi et dictum. Maecenas auctor pretium congue. Sed egestas aliquam sagittis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec in felis tempus, consectetur odio fermentum, malesuada ipsum. Morbi pretium dapibus facilisis. Aenean in tempor mi. Donec convallis turpis in dolor porttitor rutrum. Suspendisse mollis quis urna eget efficitur. Nunc semper convallis bibendum. Aliquam erat volutpat. Donec ultrices ante ut arcu rhoncus consectetur. Donec sit amet ligula in augue suscipit fermentum at nec metus.', 1, NULL, '2016-01-20 02:36:17', NULL),
(2, 1, NULL, 'Etiam varius aliquet turpis non rhoncus. Donec vulputate facilisis lacus. Cras blandit scelerisque finibus. Cras sed scelerisque erat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In hac habitasse platea dictumst. Nunc consectetur purus vitae risus vehicula, sed feugiat nulla semper. Maecenas placerat enim elit, scelerisque finibus dolor consequat sit amet.', 1, NULL, '2016-01-20 02:36:56', NULL),
(3, 1, NULL, 'Fusce laoreet, ligula sed tristique pellentesque, sapien elit condimentum odio, non dignissim lorem ipsum nec sem. Quisque gravida at sem vitae posuere. Donec a cursus lectus. Proin eu nulla sit amet metus malesuada tincidunt quis id quam. Donec eget arcu metus. Proin feugiat purus id velit gravida varius. Integer et velit eu ipsum malesuada tincidunt. Fusce quis nisi risus. Quisque a efficitur elit. Sed viverra neque in ante ornare, eget efficitur justo tempor. Sed vitae mi viverra nisl lacinia tristique vehicula vitae nibh. Nulla vitae ipsum id nunc congue vestibulum. Morbi id mauris eu quam semper eleifend. Nunc tempor tortor eu quam aliquet ultrices.', 1, NULL, '2016-01-20 02:37:17', NULL),
(4, 1, NULL, 'Interdum et malesuada fames ac ante ipsum primis in faucibus. Donec volutpat lorem sed purus porttitor semper. Etiam eget ipsum ac nisl vulputate laoreet. Nulla in eleifend nunc, vitae cursus magna. Etiam varius, arcu sit amet laoreet laoreet, ex purus lobortis dui, sed interdum nulla nisi a turpis. Quisque porttitor scelerisque massa, et placerat libero blandit in. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce id erat ac nisi egestas scelerisque. Fusce sed volutpat lorem.', 1, NULL, '2016-01-20 02:37:17', NULL),
(5, 1, NULL, 'Vivamus molestie interdum fringilla. Donec commodo, diam eu consequat ornare, tellus lacus porttitor ante, dictum viverra magna nisl eget ante. Praesent aliquam lacinia velit, eu varius tellus feugiat ut. Curabitur quis nulla lobortis, sollicitudin erat vitae, semper lectus. Integer facilisis vestibulum mi, vitae fermentum dolor laoreet sit amet. Vestibulum ut nisi ac leo sagittis feugiat. Vivamus gravida diam ex, eu feugiat augue placerat sit amet. Maecenas iaculis augue non orci porta, eget malesuada mauris semper. Pellentesque eget enim tortor. Sed condimentum rutrum volutpat. Duis accumsan lectus velit, id convallis urna molestie vitae.', 1, NULL, '2016-01-20 02:37:42', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
