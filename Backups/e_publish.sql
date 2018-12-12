-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Mar 11 Décembre 2018 à 22:48
-- Version du serveur :  5.7.24-0ubuntu0.18.04.1
-- Version de PHP :  7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `e_publish`
--
CREATE DATABASE IF NOT EXISTS `e_publish` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `e_publish`;

-- --------------------------------------------------------

--
-- Structure de la table `auditoires`
--

CREATE TABLE `auditoires` (
  `idauditoires` int(11) NOT NULL,
  `lib` varchar(45) NOT NULL,
  `abbr` varchar(45) DEFAULT NULL,
  `id_facultes` int(11) NOT NULL,
  `id_promotions` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS POUR LA TABLE `auditoires`:
--   `id_facultes`
--       `facultes` -> `idfacultes`
--   `id_promotions`
--       `promotions` -> `idpromotions`
--

--
-- Contenu de la table `auditoires`
--

-- INSERT INTO `auditoires` (`idauditoires`, `lib`, `abbr`, `id_facultes`, `id_promotions`) VALUES
-- (1, 'G2 INFORMATIQUE INDUSTRIELLE ET RESEAUX', 'G2 IIR', 2, 3);

-- --------------------------------------------------------

--
-- Structure de la table `bulletins`
--

CREATE TABLE `bulletins` (
  `idbulletins` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `matricule_etudiants` int(11) NOT NULL,
  `id_code` int(11) NOT NULL,
  `id_session_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS POUR LA TABLE `bulletins`:
--   `id_code`
--       `codes` -> `idcodes`
--   `matricule_etudiants`
--       `etudiants` -> `matricule`
--   `id_session_active`
--       `session_actives` -> `idsession_active`
--

--
-- Contenu de la table `bulletins`
--

-- INSERT INTO `bulletins` (`idbulletins`, `file`, `matricule_etudiants`, `id_code`, `id_session_active`) VALUES
-- (1, '201515_DIALUNDAMA_1', 201515, 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `codes`
--

CREATE TABLE `codes` (
  `idcodes` int(11) NOT NULL,
  `code` varchar(45) NOT NULL,
  `matricule_etudiant` int(11) NOT NULL,
  `id_sessions` int(11) NOT NULL,
  `active` enum('0','1') DEFAULT NULL,
  `statut` enum('0','1') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS POUR LA TABLE `codes`:
--   `matricule_etudiant`
--       `etudiants` -> `matricule`
--   `id_sessions`
--       `session_actives` -> `idsession_active`
--

--
-- Contenu de la table `codes`
--

-- INSERT INTO `codes` (`idcodes`, `code`, `matricule_etudiant`, `id_sessions`, `active`, `statut`) VALUES
-- (3, 'AZERTY', 201515, 1, '1', '1');

-- --------------------------------------------------------

--
-- Structure de la table `etudiants`
--

CREATE TABLE `etudiants` (
  `matricule` int(11) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `postnom` varchar(45) DEFAULT NULL,
  `prenom` varchar(45) DEFAULT NULL,
  `id_auditoires` int(11) NOT NULL,
  `annee_acad` int(11) NOT NULL,
  `statut` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS POUR LA TABLE `etudiants`:
--   `id_auditoires`
--       `auditoires` -> `idauditoires`
--   `annee_acad`
--       `gestion_annees` -> `idgestion_annees`
--

--
-- Contenu de la table `etudiants`
--

INSERT INTO `etudiants` (`matricule`, `nom`, `postnom`, `prenom`, `id_auditoires`, `annee_acad`, `statut`) VALUES
(201515, 'DIALUNDAMA', 'KRISA', 'Peniel', 1, 1, '1');

-- --------------------------------------------------------

--
-- Structure de la table `facultes`
--

CREATE TABLE `facultes` (
  `idfacultes` int(11) NOT NULL,
  `lib` varchar(45) DEFAULT NULL,
  `abbr` varchar(45) DEFAULT NULL,
  `id_section` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS POUR LA TABLE `facultes`:
--   `id_section`
--       `sections` -> `idsections`
--

--
-- Contenu de la table `facultes`
--

INSERT INTO `facultes` (`idfacultes`, `lib`, `abbr`, `id_section`) VALUES
(1, 'PREPARATOIRE', 'PREPO', 1),
(2, 'INFORMATIQUE INDUSTRIELLE ET RESEAU', 'IIR', 2),
(3, 'ELECRONIQUE', 'EN', 3),
(4, 'ELECTROTECHNIQUE', 'ET', 3),
(5, 'ELECTOMECANIQUE', 'EM', 4),
(6, 'CONSTRUCTION METALLIQUE ET NAVALE', 'CMN', 4),
(7, 'MÉCANIQUE AGRICOLE ET AUTOMOBILE', 'MAA', 4),
(8, 'INFORMATIQUE DE GESTION', 'IG', 2),
(9, 'INFORMATIQUE INDUSTRIELLE', 'II', 2),
(10, 'TELECOMMUNICATION', 'TEL', 3),
(11, 'ELECTRO-ENERGETIQUE', 'EE', 4),
(12, 'MECANIQUE DE PRODUCTION', 'MP', 4),
(13, 'MECANIQUE APPLIQUEE', 'MA', 4);

-- --------------------------------------------------------

--
-- Structure de la table `gestion_annees`
--

CREATE TABLE `gestion_annees` (
  `idgestion_annees` int(11) NOT NULL,
  `annee_debut` year(4) DEFAULT NULL,
  `annee_fin` year(4) DEFAULT NULL,
  `annee_format` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS POUR LA TABLE `gestion_annees`:
--

--
-- Contenu de la table `gestion_annees`
--

INSERT INTO `gestion_annees` (`idgestion_annees`, `annee_debut`, `annee_fin`, `annee_format`) VALUES
(1, 2018, 2019, '2018-2019');

-- --------------------------------------------------------

--
-- Structure de la table `promotions`
--

CREATE TABLE `promotions` (
  `idpromotions` int(11) NOT NULL,
  `lib` varchar(45) DEFAULT NULL,
  `abbr` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS POUR LA TABLE `promotions`:
--

--
-- Contenu de la table `promotions`
--

INSERT INTO `promotions` (`idpromotions`, `lib`, `abbr`) VALUES
(1, 'Préparatoire', 'PREPO'),
(2, 'Prémier Graduat', 'G1'),
(3, 'Deuxième Graduant', 'G2'),
(4, 'Troisième Graduat', 'G3'),
(5, 'Prémier License ', 'L1'),
(6, 'Deuxième License ', 'L2');

-- --------------------------------------------------------

--
-- Structure de la table `sections`
--

CREATE TABLE `sections` (
  `idsections` int(11) NOT NULL,
  `lib` varchar(45) DEFAULT NULL,
  `abbr` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS POUR LA TABLE `sections`:
--

--
-- Contenu de la table `sections`
--

INSERT INTO `sections` (`idsections`, `lib`, `abbr`) VALUES
(1, 'PREPARATOIRE', 'PREPO'),
(2, 'INFORMATIQUE', 'INFO'),
(3, 'ELECTRICITE', 'ELECT'),
(4, 'MECANIQUE', 'MEC');

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `idsessions` int(11) NOT NULL,
  `lib` varchar(45) NOT NULL,
  `abbr` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS POUR LA TABLE `sessions`:
--

--
-- Contenu de la table `sessions`
--

INSERT INTO `sessions` (`idsessions`, `lib`, `abbr`) VALUES
(3, 'DEUXIEME SESSION', '2e Session'),
(4, 'DEUXIÈME SESSION RECOURS', '2e Session/R'),
(1, 'PREMIÈRE SESSION', '1ère  Session'),
(2, 'PREMIÈRE SESSION RECOURS', '1ère Session/R');

-- --------------------------------------------------------

--
-- Structure de la table `session_actives`
--

CREATE TABLE `session_actives` (
  `idsession_active` int(11) NOT NULL,
  `id_sessions` int(11) NOT NULL,
  `annee` int(11) NOT NULL,
  `statut` enum('0','1') DEFAULT NULL,
  `date_active` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS POUR LA TABLE `session_actives`:
--   `annee`
--       `gestion_annees` -> `idgestion_annees`
--   `id_sessions`
--       `sessions` -> `idsessions`
--

--
-- Contenu de la table `session_actives`
--

INSERT INTO `session_actives` (`idsession_active`, `id_sessions`, `annee`, `statut`, `date_active`) VALUES
(1, 1, 1, '1', '2018-11-19 10:05:47'),
(3, 2, 1, '1', '2018-11-19 11:02:18');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `idusers` int(11) NOT NULL,
  `user_name` varchar(45) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `id_section` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `statut` enum('0','1') DEFAULT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS POUR LA TABLE `users`:
--   `id_section`
--       `sections` -> `idsections`
--   `id_role`
--       `users_roles` -> `idusers_roles`
--

-- --------------------------------------------------------

--
-- Structure de la table `users_roles`
--

CREATE TABLE `users_roles` (
  `idusers_roles` int(11) NOT NULL,
  `lib` varchar(45) DEFAULT NULL,
  `slug` varchar(45) DEFAULT NULL,
  `level` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS POUR LA TABLE `users_roles`:
--

-- --------------------------------------------------------

--
-- Structure de la table `ventes`
--

CREATE TABLE `ventes` (
  `idventes` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_code` int(11) NOT NULL,
  `date_vente` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS POUR LA TABLE `ventes`:
--   `id_code`
--       `codes` -> `idcodes`
--   `id_users`
--       `users` -> `idusers`
--

--
-- Index pour les tables exportées
--

--
-- Index pour la table `auditoires`
--
ALTER TABLE `auditoires`
  ADD PRIMARY KEY (`idauditoires`),
  ADD KEY `fk_auditoires_facultes_idx` (`id_facultes`),
  ADD KEY `fk_auditoires_promotions1_idx` (`id_promotions`);

--
-- Index pour la table `bulletins`
--
ALTER TABLE `bulletins`
  ADD PRIMARY KEY (`idbulletins`),
  ADD KEY `fk_bulletins_codes1_idx` (`id_code`),
  ADD KEY `fk_bulletins_etudiants1_idx` (`matricule_etudiants`),
  ADD KEY `fk_bulletins_session_actives` (`id_session_active`);

--
-- Index pour la table `codes`
--
ALTER TABLE `codes`
  ADD PRIMARY KEY (`idcodes`),
  ADD UNIQUE KEY `code_UNIQUE` (`code`),
  ADD KEY `fk_codes_session_actives1_idx` (`id_sessions`),
  ADD KEY `fk_codes_etudiants1_idx` (`matricule_etudiant`);

--
-- Index pour la table `etudiants`
--
ALTER TABLE `etudiants`
  ADD PRIMARY KEY (`matricule`),
  ADD KEY `fk_etudiants_auditoires1_idx` (`id_auditoires`),
  ADD KEY `fk_etudiants_gestion_annees1_idx` (`annee_acad`);

--
-- Index pour la table `facultes`
--
ALTER TABLE `facultes`
  ADD PRIMARY KEY (`idfacultes`),
  ADD KEY `fk_facultes_sections1_idx` (`id_section`);

--
-- Index pour la table `gestion_annees`
--
ALTER TABLE `gestion_annees`
  ADD PRIMARY KEY (`idgestion_annees`);

--
-- Index pour la table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`idpromotions`);

--
-- Index pour la table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`idsections`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`idsessions`),
  ADD KEY `lib` (`lib`,`abbr`);

--
-- Index pour la table `session_actives`
--
ALTER TABLE `session_actives`
  ADD PRIMARY KEY (`idsession_active`),
  ADD KEY `fk_session_actives_sessions1_idx` (`id_sessions`),
  ADD KEY `fk_session_actives_gestion_annees1_idx` (`annee`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idusers`),
  ADD KEY `fk_users_users_roles1_idx` (`id_role`),
  ADD KEY `fk_users_sections1_idx` (`id_section`);

--
-- Index pour la table `users_roles`
--
ALTER TABLE `users_roles`
  ADD PRIMARY KEY (`idusers_roles`);

--
-- Index pour la table `ventes`
--
ALTER TABLE `ventes`
  ADD PRIMARY KEY (`idventes`),
  ADD KEY `fk_ventes_codes1_idx` (`id_code`),
  ADD KEY `fk_ventes_users1_idx` (`id_users`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `auditoires`
--
ALTER TABLE `auditoires`
  MODIFY `idauditoires` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `bulletins`
--
ALTER TABLE `bulletins`
  MODIFY `idbulletins` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `codes`
--
ALTER TABLE `codes`
  MODIFY `idcodes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `facultes`
--
ALTER TABLE `facultes`
  MODIFY `idfacultes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `gestion_annees`
--
ALTER TABLE `gestion_annees`
  MODIFY `idgestion_annees` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `idpromotions` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `sections`
--
ALTER TABLE `sections`
  MODIFY `idsections` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `idsessions` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `session_actives`
--
ALTER TABLE `session_actives`
  MODIFY `idsession_active` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `idusers` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `users_roles`
--
ALTER TABLE `users_roles`
  MODIFY `idusers_roles` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `ventes`
--
ALTER TABLE `ventes`
  MODIFY `idventes` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `auditoires`
--
ALTER TABLE `auditoires`
  ADD CONSTRAINT `fk_auditoires_facultes` FOREIGN KEY (`id_facultes`) REFERENCES `facultes` (`idfacultes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_auditoires_promotions1` FOREIGN KEY (`id_promotions`) REFERENCES `promotions` (`idpromotions`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `bulletins`
--
ALTER TABLE `bulletins`
  ADD CONSTRAINT `fk_bulletins_codes1` FOREIGN KEY (`id_code`) REFERENCES `codes` (`idcodes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bulletins_etudiants1` FOREIGN KEY (`matricule_etudiants`) REFERENCES `etudiants` (`matricule`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bulletins_session_actives` FOREIGN KEY (`id_session_active`) REFERENCES `session_actives` (`idsession_active`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `codes`
--
ALTER TABLE `codes`
  ADD CONSTRAINT `fk_codes_etudiants1` FOREIGN KEY (`matricule_etudiant`) REFERENCES `etudiants` (`matricule`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_codes_session_actives1` FOREIGN KEY (`id_sessions`) REFERENCES `session_actives` (`idsession_active`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `etudiants`
--
ALTER TABLE `etudiants`
  ADD CONSTRAINT `fk_etudiants_auditoires1` FOREIGN KEY (`id_auditoires`) REFERENCES `auditoires` (`idauditoires`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_etudiants_gestion_annees1` FOREIGN KEY (`annee_acad`) REFERENCES `gestion_annees` (`idgestion_annees`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `facultes`
--
ALTER TABLE `facultes`
  ADD CONSTRAINT `fk_facultes_sections1` FOREIGN KEY (`id_section`) REFERENCES `sections` (`idsections`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `session_actives`
--
ALTER TABLE `session_actives`
  ADD CONSTRAINT `fk_session_actives_gestion_annees1` FOREIGN KEY (`annee`) REFERENCES `gestion_annees` (`idgestion_annees`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_session_actives_sessions1` FOREIGN KEY (`id_sessions`) REFERENCES `sessions` (`idsessions`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_sections1` FOREIGN KEY (`id_section`) REFERENCES `sections` (`idsections`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_users_roles1` FOREIGN KEY (`id_role`) REFERENCES `users_roles` (`idusers_roles`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `ventes`
--
ALTER TABLE `ventes`
  ADD CONSTRAINT `fk_ventes_codes1` FOREIGN KEY (`id_code`) REFERENCES `codes` (`idcodes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ventes_users1` FOREIGN KEY (`id_users`) REFERENCES `users` (`idusers`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
