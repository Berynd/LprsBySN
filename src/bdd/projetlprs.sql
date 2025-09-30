-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Sep 30, 2025 at 08:00 AM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `projetlprs`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidature`
--

CREATE TABLE `candidature` (
  `id_candidature` int(11) NOT NULL,
  `motivation` text COLLATE latin1_bin,
  `date_candidature` date DEFAULT NULL,
  `ref_offre` int(11) NOT NULL,
  `ref_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Table structure for table `categorie_forum`
--

CREATE TABLE `categorie_forum` (
  `id_categorie_forum` int(11) NOT NULL,
  `nom` varchar(100) COLLATE latin1_bin NOT NULL,
  `description` text COLLATE latin1_bin,
  `categorie` varchar(100) COLLATE latin1_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Table structure for table `entreprise`
--

CREATE TABLE `entreprise` (
  `id_entreprise` int(11) NOT NULL,
  `nom` varchar(255) COLLATE latin1_bin NOT NULL,
  `adresse` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  `site_web` varchar(255) COLLATE latin1_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Table structure for table `evenement`
--

CREATE TABLE `evenement` (
  `id_evenement` int(11) NOT NULL,
  `type` varchar(100) COLLATE latin1_bin DEFAULT NULL,
  `titre` varchar(255) COLLATE latin1_bin NOT NULL,
  `description` text COLLATE latin1_bin,
  `lieu` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  `element_requis` text COLLATE latin1_bin,
  `nombre_place` int(11) DEFAULT NULL,
  `date_creation` date DEFAULT NULL,
  `etat` varchar(50) COLLATE latin1_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Table structure for table `formation`
--

CREATE TABLE `formation` (
  `id_formation` int(11) NOT NULL,
  `nom_formation` varchar(255) COLLATE latin1_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Table structure for table `inscrire`
--

CREATE TABLE `inscrire` (
  `ref_utilisateur` int(11) NOT NULL,
  `ref_evenement` int(11) NOT NULL,
  `est_valide` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Table structure for table `offre`
--

CREATE TABLE `offre` (
  `id_offre` int(11) NOT NULL,
  `titre` varchar(255) COLLATE latin1_bin NOT NULL,
  `description` text COLLATE latin1_bin,
  `mission` text COLLATE latin1_bin,
  `salaire` decimal(10,2) DEFAULT NULL,
  `type_offre` varchar(50) COLLATE latin1_bin DEFAULT NULL,
  `date_creation` date DEFAULT NULL,
  `etat` varchar(50) COLLATE latin1_bin DEFAULT NULL,
  `ref_entreprise` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Table structure for table `organisation`
--

CREATE TABLE `organisation` (
  `ref_utilisateur` int(11) NOT NULL,
  `ref_evenement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Table structure for table `post_forum`
--

CREATE TABLE `post_forum` (
  `id_post` int(11) NOT NULL,
  `titre` varchar(255) COLLATE latin1_bin NOT NULL,
  `contenu` text COLLATE latin1_bin,
  `date_creation` date DEFAULT NULL,
  `ref_categorie_forum` int(11) NOT NULL,
  `ref_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Table structure for table `reponse_forum`
--

CREATE TABLE `reponse_forum` (
  `id_reponse_forum` int(11) NOT NULL,
  `contenu` text COLLATE latin1_bin,
  `date_creation` date DEFAULT NULL,
  `ref_post_forum` int(11) NOT NULL,
  `ref_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_utilisateur` int(11) NOT NULL,
  `nom` varchar(100) COLLATE latin1_bin NOT NULL,
  `prenom` varchar(100) COLLATE latin1_bin NOT NULL,
  `email` varchar(150) COLLATE latin1_bin NOT NULL,
  `mdp` varchar(255) COLLATE latin1_bin NOT NULL,
  `role` varchar(50) COLLATE latin1_bin DEFAULT NULL,
  `specialite` varchar(100) COLLATE latin1_bin DEFAULT NULL,
  `matiere` varchar(100) COLLATE latin1_bin DEFAULT NULL,
  `poste` varchar(100) COLLATE latin1_bin DEFAULT NULL,
  `annee_promo` year(4) DEFAULT NULL,
  `cv` blob,
  `promo` varchar(50) COLLATE latin1_bin DEFAULT NULL,
  `motif_partenariat` text COLLATE latin1_bin,
  `est_verifie` tinyint(1) DEFAULT '0',
  `ref_entreprise` int(11) DEFAULT NULL,
  `ref_formation` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidature`
--
ALTER TABLE `candidature`
  ADD PRIMARY KEY (`id_candidature`),
  ADD KEY `ref_offre` (`ref_offre`),
  ADD KEY `ref_utilisateur` (`ref_utilisateur`);

--
-- Indexes for table `categorie_forum`
--
ALTER TABLE `categorie_forum`
  ADD PRIMARY KEY (`id_categorie_forum`);

--
-- Indexes for table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`id_entreprise`);

--
-- Indexes for table `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`id_evenement`);

--
-- Indexes for table `formation`
--
ALTER TABLE `formation`
  ADD PRIMARY KEY (`id_formation`);

--
-- Indexes for table `inscrire`
--
ALTER TABLE `inscrire`
  ADD PRIMARY KEY (`ref_utilisateur`,`ref_evenement`),
  ADD KEY `ref_evenement` (`ref_evenement`);

--
-- Indexes for table `offre`
--
ALTER TABLE `offre`
  ADD PRIMARY KEY (`id_offre`),
  ADD KEY `ref_entreprise` (`ref_entreprise`);

--
-- Indexes for table `organisation`
--
ALTER TABLE `organisation`
  ADD PRIMARY KEY (`ref_utilisateur`,`ref_evenement`),
  ADD KEY `ref_evenement` (`ref_evenement`);

--
-- Indexes for table `post_forum`
--
ALTER TABLE `post_forum`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `ref_categorie_forum` (`ref_categorie_forum`),
  ADD KEY `ref_utilisateur` (`ref_utilisateur`);

--
-- Indexes for table `reponse_forum`
--
ALTER TABLE `reponse_forum`
  ADD PRIMARY KEY (`id_reponse_forum`),
  ADD KEY `ref_post_forum` (`ref_post_forum`),
  ADD KEY `ref_utilisateur` (`ref_utilisateur`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`),
  ADD KEY `ref_entreprise` (`ref_entreprise`),
  ADD KEY `ref_formation` (`ref_formation`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidature`
--
ALTER TABLE `candidature`
  MODIFY `id_candidature` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categorie_forum`
--
ALTER TABLE `categorie_forum`
  MODIFY `id_categorie_forum` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `id_entreprise` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `id_evenement` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `formation`
--
ALTER TABLE `formation`
  MODIFY `id_formation` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offre`
--
ALTER TABLE `offre`
  MODIFY `id_offre` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_forum`
--
ALTER TABLE `post_forum`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reponse_forum`
--
ALTER TABLE `reponse_forum`
  MODIFY `id_reponse_forum` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `candidature`
--
ALTER TABLE `candidature`
  ADD CONSTRAINT `candidature_ibfk_1` FOREIGN KEY (`ref_offre`) REFERENCES `offre` (`id_offre`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `candidature_ibfk_2` FOREIGN KEY (`ref_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inscrire`
--
ALTER TABLE `inscrire`
  ADD CONSTRAINT `inscrire_ibfk_1` FOREIGN KEY (`ref_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inscrire_ibfk_2` FOREIGN KEY (`ref_evenement`) REFERENCES `evenement` (`id_evenement`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `offre`
--
ALTER TABLE `offre`
  ADD CONSTRAINT `offre_ibfk_1` FOREIGN KEY (`ref_entreprise`) REFERENCES `entreprise` (`id_entreprise`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `organisation`
--
ALTER TABLE `organisation`
  ADD CONSTRAINT `organisation_ibfk_1` FOREIGN KEY (`ref_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `organisation_ibfk_2` FOREIGN KEY (`ref_evenement`) REFERENCES `evenement` (`id_evenement`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post_forum`
--
ALTER TABLE `post_forum`
  ADD CONSTRAINT `post_forum_ibfk_1` FOREIGN KEY (`ref_categorie_forum`) REFERENCES `categorie_forum` (`id_categorie_forum`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_forum_ibfk_2` FOREIGN KEY (`ref_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reponse_forum`
--
ALTER TABLE `reponse_forum`
  ADD CONSTRAINT `reponse_forum_ibfk_1` FOREIGN KEY (`ref_post_forum`) REFERENCES `post_forum` (`id_post`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reponse_forum_ibfk_2` FOREIGN KEY (`ref_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`ref_entreprise`) REFERENCES `entreprise` (`id_entreprise`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `utilisateur_ibfk_2` FOREIGN KEY (`ref_formation`) REFERENCES `formation` (`id_formation`) ON DELETE SET NULL ON UPDATE CASCADE;
