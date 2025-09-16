-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 16 sep. 2025 à 08:37
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
-- Structure de la table `candidature`
--

DROP TABLE IF EXISTS `candidature`;
CREATE TABLE IF NOT EXISTS `candidature` (
  `id_candidature` int NOT NULL AUTO_INCREMENT,
  `motivation` text COLLATE latin1_bin,
  `date_candidature` date DEFAULT NULL,
  `ref_offre` int NOT NULL,
  `ref_utilisateur` int NOT NULL,
  PRIMARY KEY (`id_candidature`),
  KEY `ref_offre` (`ref_offre`),
  KEY `ref_utilisateur` (`ref_utilisateur`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Structure de la table `categorie_forum`
--

DROP TABLE IF EXISTS `categorie_forum`;
CREATE TABLE IF NOT EXISTS `categorie_forum` (
  `id_categorie_forum` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE latin1_bin NOT NULL,
  `description` text COLLATE latin1_bin,
  `categorie` varchar(100) COLLATE latin1_bin DEFAULT NULL,
  PRIMARY KEY (`id_categorie_forum`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

DROP TABLE IF EXISTS `entreprise`;
CREATE TABLE IF NOT EXISTS `entreprise` (
  `id_entreprise` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE latin1_bin NOT NULL,
  `adresse` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  `site_web` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  PRIMARY KEY (`id_entreprise`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

DROP TABLE IF EXISTS `evenement`;
CREATE TABLE IF NOT EXISTS `evenement` (
  `id_evenement` int NOT NULL AUTO_INCREMENT,
  `type` varchar(100) COLLATE latin1_bin DEFAULT NULL,
  `titre` varchar(255) COLLATE latin1_bin NOT NULL,
  `description` text COLLATE latin1_bin,
  `lieu` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  `element_requis` text COLLATE latin1_bin,
  `nombre_place` int DEFAULT NULL,
  `date_création` date DEFAULT NULL,
  `etat` varchar(50) COLLATE latin1_bin DEFAULT NULL,
  PRIMARY KEY (`id_evenement`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

DROP TABLE IF EXISTS `formation`;
CREATE TABLE IF NOT EXISTS `formation` (
  `id_formation` int NOT NULL AUTO_INCREMENT,
  `nom_formation` varchar(255) COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`id_formation`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Structure de la table `inscrire`
--

DROP TABLE IF EXISTS `inscrire`;
CREATE TABLE IF NOT EXISTS `inscrire` (
  `ref_utilisateur` int NOT NULL,
  `ref_evenement` int NOT NULL,
  `est_valide` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`ref_utilisateur`,`ref_evenement`),
  KEY `ref_evenement` (`ref_evenement`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Structure de la table `offre`
--

DROP TABLE IF EXISTS `offre`;
CREATE TABLE IF NOT EXISTS `offre` (
  `id_offre` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE latin1_bin NOT NULL,
  `description` text COLLATE latin1_bin,
  `mission` text COLLATE latin1_bin,
  `salaire` decimal(10,2) DEFAULT NULL,
  `type_offre` varchar(50) COLLATE latin1_bin DEFAULT NULL,
  `date_creation` date DEFAULT NULL,
  `etat` varchar(50) COLLATE latin1_bin DEFAULT NULL,
  `ref_entreprise` int NOT NULL,
  PRIMARY KEY (`id_offre`),
  KEY `ref_entreprise` (`ref_entreprise`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Structure de la table `organisation`
--

DROP TABLE IF EXISTS `organisation`;
CREATE TABLE IF NOT EXISTS `organisation` (
  `ref_utilisateur` int NOT NULL,
  `ref_evenement` int NOT NULL,
  PRIMARY KEY (`ref_utilisateur`,`ref_evenement`),
  KEY `ref_evenement` (`ref_evenement`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Structure de la table `post_forum`
--

DROP TABLE IF EXISTS `post_forum`;
CREATE TABLE IF NOT EXISTS `post_forum` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE latin1_bin NOT NULL,
  `contenu` text COLLATE latin1_bin,
  `date_creation` date DEFAULT NULL,
  `ref_categorie_forum` int NOT NULL,
  `ref_utilisateur` int NOT NULL,
  PRIMARY KEY (`id_post`),
  KEY `ref_categorie_forum` (`ref_categorie_forum`),
  KEY `ref_utilisateur` (`ref_utilisateur`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Structure de la table `reponse_forum`
--

DROP TABLE IF EXISTS `reponse_forum`;
CREATE TABLE IF NOT EXISTS `reponse_forum` (
  `id_reponse_forum` int NOT NULL AUTO_INCREMENT,
  `contenu` text COLLATE latin1_bin,
  `date_creation` date DEFAULT NULL,
  `ref_post_forum` int NOT NULL,
  `ref_utilisateur` int NOT NULL,
  PRIMARY KEY (`id_reponse_forum`),
  KEY `ref_post_forum` (`ref_post_forum`),
  KEY `ref_utilisateur` (`ref_utilisateur`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_utilisateur` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE latin1_bin NOT NULL,
  `prenom` varchar(100) COLLATE latin1_bin NOT NULL,
  `email` varchar(150) COLLATE latin1_bin NOT NULL,
  `mdp` varchar(255) COLLATE latin1_bin NOT NULL,
  `role` varchar(50) COLLATE latin1_bin DEFAULT NULL,
  `spécialité` varchar(100) COLLATE latin1_bin DEFAULT NULL,
  `matière` varchar(100) COLLATE latin1_bin DEFAULT NULL,
  `poste` varchar(100) COLLATE latin1_bin DEFAULT NULL,
  `annee_promo` year DEFAULT NULL,
  `cv` blob,
  `promo` varchar(50) COLLATE latin1_bin DEFAULT NULL,
  `motif_partenariat` text COLLATE latin1_bin,
  `est_vérifié` tinyint(1) DEFAULT '0',
  `ref_entreprise` int DEFAULT NULL,
  `ref_formation` int DEFAULT NULL,
  PRIMARY KEY (`id_utilisateur`),
  KEY `ref_entreprise` (`ref_entreprise`),
  KEY `ref_formation` (`ref_formation`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
