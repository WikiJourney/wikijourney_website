-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u2
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 09 Novembre 2015 à 15:38
-- Version du serveur: 5.5.46
-- Version de PHP: 5.4.45-0+deb7u2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `wikijourney_cache`
--

-- --------------------------------------------------------

--
-- Structure de la table `cache_en`
--

CREATE TABLE IF NOT EXISTS `cache_en` (
  `id` bigint(9) NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `name` text COLLATE utf8_bin NOT NULL,
  `sitelink` text COLLATE utf8_bin NOT NULL,
  `type_name` text COLLATE utf8_bin NOT NULL,
  `type_id` bigint(9) NOT NULL,
  `image_url` text COLLATE utf8_bin NOT NULL,
  `lastupdate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `cache_fr`
--

CREATE TABLE IF NOT EXISTS `cache_fr` (
  `id` bigint(9) NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `name` text COLLATE utf8_bin NOT NULL,
  `sitelink` text COLLATE utf8_bin NOT NULL,
  `type_name` text COLLATE utf8_bin NOT NULL,
  `type_id` bigint(9) NOT NULL,
  `image_url` text COLLATE utf8_bin NOT NULL,
  `lastupdate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `cache_zh`
--

CREATE TABLE IF NOT EXISTS `cache_zh` (
  `id` bigint(9) NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `name` text COLLATE utf8_bin NOT NULL,
  `sitelink` text COLLATE utf8_bin NOT NULL,
  `type_name` text COLLATE utf8_bin NOT NULL,
  `type_id` bigint(9) NOT NULL,
  `image_url` text COLLATE utf8_bin NOT NULL,
  `lastupdate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
