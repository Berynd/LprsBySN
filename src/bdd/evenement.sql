-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 02 déc. 2025 à 08:54
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projetlprs`
--

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

DROP TABLE IF EXISTS `evenement`;
CREATE TABLE IF NOT EXISTS `evenement` (
  `id_evenement` int NOT NULL AUTO_INCREMENT,
  `type` varchar(100) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `titre` varchar(255) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_bin,
  `lieu` varchar(255) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `element_requis` text CHARACTER SET latin1 COLLATE latin1_bin,
  `places_totales` int DEFAULT NULL,
  `places_restantes` int DEFAULT NULL,
  `date_debut` datetime DEFAULT NULL,
  `date_fin` datetime DEFAULT NULL,
  `etat` varchar(50) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `validation` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_evenement`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`id_evenement`, `type`, `titre`, `description`, `lieu`, `element_requis`, `places_totales`, `places_restantes`, `date_debut`, `date_fin`, `etat`, `validation`) VALUES
(1, 'Caritatifs', 'pupuce', 'ad laurent ', 'pupuce land', 'des cameras et des capotes durex', 69, 0, '2025-10-29 00:00:00', '0000-00-00 00:00:00', 'à venir', 1),
(4, 'Sportif', 'Match Amical', 'Paris SG - Paris FC', 'Parc des princes', 'Rien', 65, 0, '2025-11-21 00:00:00', '0000-00-00 00:00:00', 'à venir', 1),
(5, 'Citoyens_Solidaire', 'test', 'test', 'test', 'test', 666, 0, '2025-12-05 00:00:00', '0000-00-00 00:00:00', 'à venir', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
