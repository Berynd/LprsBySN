-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 18 nov. 2025 à 09:00
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
  `motivation` text CHARACTER SET latin1 COLLATE latin1_bin,
  `date_candidature` date DEFAULT NULL,
  `ref_offre` int NOT NULL,
  `ref_utilisateur` int NOT NULL,
  PRIMARY KEY (`id_candidature`),
  KEY `ref_offre` (`ref_offre`),
  KEY `ref_utilisateur` (`ref_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Structure de la table `categorie_forum`
--

DROP TABLE IF EXISTS `categorie_forum`;
CREATE TABLE IF NOT EXISTS `categorie_forum` (
  `id_categorie_forum` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_bin,
  `categorie` varchar(100) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  PRIMARY KEY (`id_categorie_forum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

DROP TABLE IF EXISTS `entreprise`;
CREATE TABLE IF NOT EXISTS `entreprise` (
  `id_entreprise` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `adresse` varchar(255) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `site_web` varchar(255) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  PRIMARY KEY (`id_entreprise`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`id_entreprise`, `nom`, `adresse`, `site_web`) VALUES
(1, 'ANCV', '36 Bd Henri Bergson, 95200 Sarcelles', 'https://www.ancv.com/');

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
  `nombre_place` int DEFAULT NULL,
  `date_evenement` date DEFAULT NULL,
  `etat` varchar(50) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `validation` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_evenement`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`id_evenement`, `type`, `titre`, `description`, `lieu`, `element_requis`, `nombre_place`, `date_evenement`, `etat`, `validation`) VALUES
(1, 'Caritatifs', 'pupuce', 'ad laurent ', 'pupuce land', 'des cameras et des capotes durex', 69, '2025-10-29', 'à venir', 0);

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

DROP TABLE IF EXISTS `formation`;
CREATE TABLE IF NOT EXISTS `formation` (
  `id_formation` int NOT NULL AUTO_INCREMENT,
  `nom_formation` varchar(255) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`id_formation`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `formation`
--

INSERT INTO `formation` (`id_formation`, `nom_formation`) VALUES
(1, 'BTS SIO SLAM'),
(3, 'BTS SIO SISR'),
(5, 'BAC PRO MSPC'),
(6, 'BAC PRO SN');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Structure de la table `offre`
--

DROP TABLE IF EXISTS `offre`;
CREATE TABLE IF NOT EXISTS `offre` (
  `id_offre` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_bin,
  `mission` text CHARACTER SET latin1 COLLATE latin1_bin,
  `salaire` decimal(10,2) DEFAULT NULL,
  `type_offre` varchar(50) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `date_creation` date DEFAULT NULL,
  `etat` varchar(50) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `ref_entreprise` int NOT NULL,
  PRIMARY KEY (`id_offre`),
  KEY `ref_entreprise` (`ref_entreprise`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Structure de la table `post_forum`
--

DROP TABLE IF EXISTS `post_forum`;
CREATE TABLE IF NOT EXISTS `post_forum` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `contenu` text CHARACTER SET latin1 COLLATE latin1_bin,
  `date_creation` date DEFAULT NULL,
  `ref_categorie_forum` int NOT NULL,
  `ref_utilisateur` int NOT NULL,
  PRIMARY KEY (`id_post`),
  KEY `ref_categorie_forum` (`ref_categorie_forum`),
  KEY `ref_utilisateur` (`ref_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Structure de la table `reponse_forum`
--

DROP TABLE IF EXISTS `reponse_forum`;
CREATE TABLE IF NOT EXISTS `reponse_forum` (
  `id_reponse_forum` int NOT NULL AUTO_INCREMENT,
  `contenu` text CHARACTER SET latin1 COLLATE latin1_bin,
  `date_creation` date DEFAULT NULL,
  `ref_post_forum` int NOT NULL,
  `ref_utilisateur` int NOT NULL,
  PRIMARY KEY (`id_reponse_forum`),
  KEY `ref_post_forum` (`ref_post_forum`),
  KEY `ref_utilisateur` (`ref_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_utilisateur` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `prenom` varchar(100) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `email` varchar(150) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `mdp` varchar(255) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `role` varchar(50) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT 'utilisateur',
  `specialite` varchar(100) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `poste` varchar(100) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `annee_promo` year DEFAULT NULL,
  `cv` blob,
  `motif_partenariat` text CHARACTER SET latin1 COLLATE latin1_bin,
  `est_verifie` tinyint(1) DEFAULT '0',
  `ref_entreprise` int DEFAULT NULL,
  `ref_formation` int DEFAULT NULL,
  PRIMARY KEY (`id_utilisateur`),
  KEY `ref_entreprise` (`ref_entreprise`),
  KEY `ref_formation` (`ref_formation`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `nom`, `prenom`, `email`, `mdp`, `role`, `specialite`, `poste`, `annee_promo`, `cv`, `motif_partenariat`, `est_verifie`, `ref_entreprise`, `ref_formation`) VALUES
(1, 'langui', 'thomas', 'toxi.tv971@gmail.com', '$2y$10$aOdOqBx.6rWiJYuanpsC9.fpOTnMzfnyeFfWXMwQzpbuH6213TJQC', 'utilisateur', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(2, 'Passard', 'Ethan', 'e.passard@lprs.fr', '$2y$10$x9TwEqz5cId4SCvrDjdmweNOuI5I4fgcawAMZ5WG5KXWYp2IfJ212', 'utilisateur', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(3, 'Berinde', 'Gabi', 'g.berinde@lprs.fr', '$2y$10$3EWXvtI4.VOforKAx9L0Se.P00J5ecuUPgPbd59WGEoDkGbMow/za', 'utilisateur', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(4, 'admin', 'admin', 'admin@gmail.com', '$2y$10$eZI8uoU4cNy/2ncPoz1nyu3W6G2tN4/weZ1UaLDL1vcr2Auazmdje', 'admin', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(5, 'nicolas', 'charpentier', 'ncharpentier@lprs.fr', '$2y$10$LzPHeDKCOB0bqHOxpGD0eunmo0QIo8N8V9zEDti2ozGKYFIL/U9jW', 'utilisateur', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'test', 'test', 'test@gmail.com', '$2y$10$k2H3dKxLpniN/cKRducuLuuTxAlWJG/RRKJ7QM.YPWE3u2Vp9fG4e', 'utilisateur', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(8, 'prof', 'prof', 'prof@gmail.com', '$2y$10$lmpnPde0dxk86sACU.OJi.7FKGkw7m4Cvode6cPfgkH5U7PUKC55W', 'prof', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `candidature`
--
ALTER TABLE `candidature`
  ADD CONSTRAINT `candidature_ibfk_1` FOREIGN KEY (`ref_offre`) REFERENCES `offre` (`id_offre`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `candidature_ibfk_2` FOREIGN KEY (`ref_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `inscrire`
--
ALTER TABLE `inscrire`
  ADD CONSTRAINT `inscrire_ibfk_1` FOREIGN KEY (`ref_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inscrire_ibfk_2` FOREIGN KEY (`ref_evenement`) REFERENCES `evenement` (`id_evenement`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `offre`
--
ALTER TABLE `offre`
  ADD CONSTRAINT `offre_ibfk_1` FOREIGN KEY (`ref_entreprise`) REFERENCES `entreprise` (`id_entreprise`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `organisation`
--
ALTER TABLE `organisation`
  ADD CONSTRAINT `organisation_ibfk_1` FOREIGN KEY (`ref_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `organisation_ibfk_2` FOREIGN KEY (`ref_evenement`) REFERENCES `evenement` (`id_evenement`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `post_forum`
--
ALTER TABLE `post_forum`
  ADD CONSTRAINT `post_forum_ibfk_1` FOREIGN KEY (`ref_categorie_forum`) REFERENCES `categorie_forum` (`id_categorie_forum`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_forum_ibfk_2` FOREIGN KEY (`ref_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reponse_forum`
--
ALTER TABLE `reponse_forum`
  ADD CONSTRAINT `reponse_forum_ibfk_1` FOREIGN KEY (`ref_post_forum`) REFERENCES `post_forum` (`id_post`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reponse_forum_ibfk_2` FOREIGN KEY (`ref_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`ref_entreprise`) REFERENCES `entreprise` (`id_entreprise`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `utilisateur_ibfk_2` FOREIGN KEY (`ref_formation`) REFERENCES `formation` (`id_formation`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
