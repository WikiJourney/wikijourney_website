-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u2
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Sam 26 Décembre 2015 à 15:41
-- Version du serveur: 5.5.46
-- Version de PHP: 5.4.45-0+deb7u2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `wikijourney_users`
--

-- --------------------------------------------------------

--
-- Structure de la table `savedpaths`
--

CREATE TABLE IF NOT EXISTS `savedpaths` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `usermail` text NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `path` text NOT NULL,
  `image_url` text NOT NULL,
  `mean_lat` float NOT NULL,
  `mean_long` float NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
