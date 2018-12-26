-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Mer 26 Décembre 2018 à 11:38
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

-- --------------------------------------------------------

--
-- Structure de la table `auditoires`
--

CREATE TABLE `auditoires` (
  `idauditoires` int(10) UNSIGNED NOT NULL,
  `lib` varchar(65) COLLATE utf8_unicode_ci NOT NULL,
  `abbr` varchar(65) COLLATE utf8_unicode_ci NOT NULL,
  `idfacultes` int(10) UNSIGNED NOT NULL,
  `idpromotions` int(10) UNSIGNED NOT NULL,
  `idsections` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `auditoires`
--

INSERT INTO `auditoires` (`idauditoires`, `lib`, `abbr`, `idfacultes`, `idpromotions`, `idsections`) VALUES
(1, 'PRÉPARATOIRE A', 'PRÉPO A', 1, 1, 1),
(2, 'PRÉPARATOIRE B', 'PRÉPO B', 1, 1, 1),
(3, 'G1 INFORMATIQUE INDUSTRIELLE ET RESEAUX', 'G1 IIR', 2, 2, 2),
(4, 'G1 INFORMATIQUE DE GESTION', 'G1 IG', 8, 2, 2),
(5, 'G2 INFORMATIQUE INDUSTRIELLE ET RESEAUX', 'G2 IIR', 2, 3, 2),
(6, 'G2 INFORMATIQUE DE GESTION', 'G2 IG', 8, 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `bulletins`
--

CREATE TABLE `bulletins` (
  `idbulletins` int(10) UNSIGNED NOT NULL,
  `file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `matricule_etudiant` int(10) UNSIGNED NOT NULL,
  `idcodes` int(10) UNSIGNED NOT NULL,
  `idpublications` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `bulletins`
--

INSERT INTO `bulletins` (`idbulletins`, `file`, `matricule_etudiant`, `idcodes`, `idpublications`, `created_at`, `updated_at`) VALUES
(1, '201515_DIALUNDAMA_1', 201515, 1, 1, NULL, NULL),
(2, '201515_DIALUNDAMA_1', 201515, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `codes`
--

CREATE TABLE `codes` (
  `idcodes` int(10) UNSIGNED NOT NULL,
  `code` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `matricule_etudiant` int(10) UNSIGNED NOT NULL,
  `idsessions` int(10) UNSIGNED NOT NULL,
  `idsections` int(10) UNSIGNED NOT NULL,
  `idauditoires` int(10) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `statut` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `codes`
--

INSERT INTO `codes` (`idcodes`, `code`, `matricule_etudiant`, `idsessions`, `idsections`, `idauditoires`, `active`, `statut`, `created_at`, `updated_at`) VALUES
(1, 'AZERTY', 201515, 1, 2, 5, 1, 1, NULL, '2018-12-11 21:07:12'),
(2, 'code', 201516, 1, 3, 2, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `etudiants`
--

CREATE TABLE `etudiants` (
  `matricule` int(10) UNSIGNED NOT NULL,
  `nom` varchar(65) COLLATE utf8_unicode_ci NOT NULL,
  `postnom` varchar(65) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prenom` varchar(65) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idpromotions` int(10) UNSIGNED NOT NULL,
  `idfacultes` int(10) UNSIGNED NOT NULL,
  `idsections` int(10) UNSIGNED NOT NULL,
  `idauditoires` int(10) UNSIGNED NOT NULL,
  `annee_acad` int(10) UNSIGNED NOT NULL,
  `statut` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `etudiants`
--

INSERT INTO `etudiants` (`matricule`, `nom`, `postnom`, `prenom`, `idpromotions`, `idfacultes`, `idsections`, `idauditoires`, `annee_acad`, `statut`, `created_at`, `updated_at`) VALUES
(201515, 'DIALUNDAMA', 'KRISA', 'PENIEL', 3, 2, 2, 5, 1, 1, '2018-12-25 12:34:42', '2018-12-25 12:34:42'),
(201516, 'ETUDIAN1', 'ETUDIAN1', 'ETUDIAN1', 1, 1, 1, 1, 1, 1, '2018-12-25 12:34:42', '2018-12-25 12:34:42'),
(201517, 'ETUDIANT2', '', 'ETUDIANT2', 2, 2, 2, 2, 1, 1, '2018-12-25 12:34:42', '2018-12-25 12:34:42'),
(201518, 'ETUDIANT3', 'ETUDIANT3', '', 3, 3, 3, 3, 1, 1, '2018-12-25 12:34:42', '2018-12-25 12:34:42'),
(201519, 'ETUDIANT4', 'ETUDIANT4', '', 4, 4, 4, 1, 1, 1, '2018-12-25 12:34:42', '2018-12-25 12:34:42'),
(201520, 'ETUDIANT5', 'ETUDIANT5', 'ETUDIANT5', 5, 5, 4, 2, 1, 1, '2018-12-25 12:34:42', '2018-12-25 12:34:42'),
(201521, 'ETUDIANT6', 'ETUDIANT6', 'ETUDIANT6', 6, 6, 1, 3, 1, 1, '2018-12-25 12:34:42', '2018-12-25 12:34:42'),
(201525, 'KAY', 'KUNGUDI', 'MARDOCHE', 3, 2, 2, 5, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `etudiants_succes`
--

CREATE TABLE `etudiants_succes` (
  `matricule_etudiant` int(10) UNSIGNED NOT NULL,
  `idsessions` int(10) UNSIGNED NOT NULL,
  `idgestion_annees` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `facultes`
--

CREATE TABLE `facultes` (
  `idfacultes` int(10) UNSIGNED NOT NULL,
  `lib` varchar(65) COLLATE utf8_unicode_ci NOT NULL,
  `abbr` varchar(65) COLLATE utf8_unicode_ci NOT NULL,
  `idsections` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `facultes`
--

INSERT INTO `facultes` (`idfacultes`, `lib`, `abbr`, `idsections`) VALUES
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
  `idgestion_annees` int(10) UNSIGNED NOT NULL,
  `annee_debut` year(4) NOT NULL,
  `annee_fin` year(4) NOT NULL,
  `annee_format` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `gestion_annees`
--

INSERT INTO `gestion_annees` (`idgestion_annees`, `annee_debut`, `annee_fin`, `annee_format`, `created_at`, `updated_at`) VALUES
(1, 2018, 2019, '2018-2019', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2018_12_18_001532_creation_des_tables', 1);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `promotions`
--

CREATE TABLE `promotions` (
  `idpromotions` int(10) UNSIGNED NOT NULL,
  `lib` varchar(65) COLLATE utf8_unicode_ci NOT NULL,
  `abbr` varchar(65) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
-- Structure de la table `publications`
--

CREATE TABLE `publications` (
  `idpublications` int(10) UNSIGNED NOT NULL,
  `idsessions` int(10) UNSIGNED NOT NULL,
  `idauditoires` int(10) UNSIGNED NOT NULL,
  `annee` int(10) UNSIGNED NOT NULL,
  `statut` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `publications`
--

INSERT INTO `publications` (`idpublications`, `idsessions`, `idauditoires`, `annee`, `statut`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, NULL, NULL),
(3, 2, 1, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `sections`
--

CREATE TABLE `sections` (
  `idsections` int(10) UNSIGNED NOT NULL,
  `lib` varchar(65) COLLATE utf8_unicode_ci NOT NULL,
  `abbr` varchar(65) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `idsessions` int(10) UNSIGNED NOT NULL,
  `lib` varchar(65) COLLATE utf8_unicode_ci NOT NULL,
  `abbr` varchar(65) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `sessions`
--

INSERT INTO `sessions` (`idsessions`, `lib`, `abbr`) VALUES
(1, 'PREMIÈRE SESSION', '1ère  Session'),
(2, 'PREMIÈRE SESSION RECOURS', '1ère Session/R'),
(3, 'DEUXIÈME SESSION', '2e Session'),
(4, 'DEUXIÈME SESSION RECOURS', '2e Session/R');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `idusers` int(10) UNSIGNED NOT NULL,
  `username` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(65) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(65) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(65) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `idsections` int(10) UNSIGNED DEFAULT NULL,
  `idusers_roles` int(10) UNSIGNED NOT NULL,
  `statut` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`idusers`, `username`, `name`, `first_name`, `email`, `email_verified_at`, `password`, `idsections`, `idusers_roles`, `statut`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'bilwifi', 'Dialu', 'Peniel', 'bilwifi9@gmail.com', NULL, '$2y$10$FXHR6JC3.aJzTvGE8prLROZA1S5fmPjAVRH8t4BoA/jT0GA1BjWn6', 1, 1, 1, '53b01f5d49a6f0aDDbc6a0b3977b2158dd1bf0fc5e73fcb592c2546d5b5353ff0e', '2018-12-21 13:13:59', '2018-12-21 13:13:59'),
(2, 'bil', 'DIALUNDAMA', 'Peniel', 'bil@gmail.com', NULL, '$2y$10$68C8zoKwIy9B8d55n12Or.xfahYrbfMmCuR3SjpGJ4drJ.j8CO/VG', 2, 1, 1, 'ODsOzMLFQW5Dyx4fa1OKMPExT6X7Kjim7qCqO8pltq0U0xSkzNJ2LBC2v2Y1', '2018-12-21 15:08:47', '2018-12-21 15:08:47'),
(3, 'secinformatique', 'informatique', 'informatique', 'info@ispt.com', NULL, '$2y$10$FXHR6JC3.aJzTvGE8prLROZA1S5fmPjAVRH8t4BoA/jT0GA1BjWn6', 2, 1, 1, 'IXQbDCSNG6fM2mzbWUwrbnbJzFTWpcjFCO4msYsTYjw1XF24RSpagnV3I2Yh', '2018-12-22 19:36:52', '2018-12-22 19:36:52'),
(4, 'secmecanique', 'mecanique', 'mecanique', 'mec@ispt.com', NULL, '$2y$10$FXHR6JC3.aJzTvGE8prLROZA1S5fmPjAVRH8t4BoA/jT0GA1BjWn6', 4, 1, 1, 'YBKCNFtv617aQs9ag341rkvhSPFUfm8cGJQ3hPFo8lKFXXUCx6ueIfM9G7cC', '2018-12-22 19:41:44', '2018-12-22 19:41:44'),
(5, 'secelectricite', 'electricite', 'electricite', 'elect@ispt.com', NULL, '$2y$10$FXHR6JC3.aJzTvGE8prLROZA1S5fmPjAVRH8t4BoA/jT0GA1BjWn6', 3, 1, 1, 'h5Y02QQiaG3EMC0WhXsDXj0zwy0hM6bSxcyI23Jlpdc38GnYoBJ2AupCiG45', NULL, NULL),
(6, 'secjury', 'jury', 'jury', 'jury@ispt.kin', NULL, '$2y$10$FXHR6JC3.aJzTvGE8prLROZA1S5fmPjAVRH8t4BoA/jT0GA1BjWn6', NULL, 2, 1, 'y4DjJupAFwa9wb7fKL9D4O45igJ8AuJsbmXqSqXNlAnlOGk9QjddQEzguQ0s', NULL, NULL),
(7, 'admin', 'admin', 'admin', 'admin@ispt.com', NULL, '$2y$10$FXHR6JC3.aJzTvGE8prLROZA1S5fmPjAVRH8t4BoA/jT0GA1BjWn6', NULL, 3, 1, '2mN9rAkx2yreGdIv0dZFl9L13NZVmfp1aEvqzmkO8io7GdWG6JBobsIZAf9v', NULL, NULL),
(8, 'secprepo', 'secprepo', '', 'prepo@ispt-kin.com', NULL, '$2y$10$FXHR6JC3.aJzTvGE8prLROZA1S5fmPjAVRH8t4BoA/jT0GA1BjWn6', 1, 1, 1, 'u2VeGGC1Eji4MsVykhwKa1959KGgk5KOyKyGupIz2SLuzf5Ti8LOnZC4BEhB', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users_roles`
--

CREATE TABLE `users_roles` (
  `idusers_roles` int(10) UNSIGNED NOT NULL,
  `lib` varchar(65) COLLATE utf8_unicode_ci NOT NULL,
  `level` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `users_roles`
--

INSERT INTO `users_roles` (`idusers_roles`, `lib`, `level`) VALUES
(1, 'section', 2),
(2, 'jury', 4),
(3, 'admin', 10);

-- --------------------------------------------------------

--
-- Structure de la table `ventes`
--

CREATE TABLE `ventes` (
  `idventes` int(10) UNSIGNED NOT NULL,
  `idusers` int(10) UNSIGNED NOT NULL,
  `matricule_etudiant` int(10) UNSIGNED NOT NULL,
  `idcodes` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `auditoires`
--
ALTER TABLE `auditoires`
  ADD PRIMARY KEY (`idauditoires`),
  ADD KEY `auditoires_idfacultes_foreign` (`idfacultes`),
  ADD KEY `auditoires_idpromotions_foreign` (`idpromotions`),
  ADD KEY `auditoires_idsections_foreign` (`idsections`);

--
-- Index pour la table `bulletins`
--
ALTER TABLE `bulletins`
  ADD PRIMARY KEY (`idbulletins`),
  ADD KEY `bulletins_matricule_etudiant_foreign` (`matricule_etudiant`),
  ADD KEY `bulletins_idcodes_foreign` (`idcodes`),
  ADD KEY `bulletins_idpublications_foreign` (`idpublications`);

--
-- Index pour la table `codes`
--
ALTER TABLE `codes`
  ADD PRIMARY KEY (`idcodes`),
  ADD UNIQUE KEY `codes_code_unique` (`code`),
  ADD KEY `codes_matricule_etudiant_foreign` (`matricule_etudiant`),
  ADD KEY `codes_idsessions_foreign` (`idsessions`),
  ADD KEY `codes_idsections_foreign` (`idsections`),
  ADD KEY `codes_idauditoires_foreign` (`idauditoires`);

--
-- Index pour la table `etudiants`
--
ALTER TABLE `etudiants`
  ADD PRIMARY KEY (`matricule`),
  ADD KEY `etudiants_idpromotions_foreign` (`idpromotions`),
  ADD KEY `etudiants_idfacultes_foreign` (`idfacultes`),
  ADD KEY `etudiants_idsections_foreign` (`idsections`),
  ADD KEY `etudiants_idauditoires_foreign` (`idauditoires`),
  ADD KEY `etudiants_annee_acad_foreign` (`annee_acad`);

--
-- Index pour la table `etudiants_succes`
--
ALTER TABLE `etudiants_succes`
  ADD PRIMARY KEY (`matricule_etudiant`,`idgestion_annees`),
  ADD KEY `etudiants_succes_idsessions_foreign` (`idsessions`),
  ADD KEY `etudiants_succes_idgestion_annees_foreign` (`idgestion_annees`);

--
-- Index pour la table `facultes`
--
ALTER TABLE `facultes`
  ADD PRIMARY KEY (`idfacultes`),
  ADD KEY `facultes_idsections_foreign` (`idsections`);

--
-- Index pour la table `gestion_annees`
--
ALTER TABLE `gestion_annees`
  ADD PRIMARY KEY (`idgestion_annees`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`idpromotions`);

--
-- Index pour la table `publications`
--
ALTER TABLE `publications`
  ADD PRIMARY KEY (`idpublications`),
  ADD KEY `publications_annee_foreign` (`annee`),
  ADD KEY `publications_idsessions_foreign` (`idsessions`),
  ADD KEY `publications_idauditoires_foreign` (`idauditoires`);

--
-- Index pour la table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`idsections`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`idsessions`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idusers`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_idsections_foreign` (`idsections`),
  ADD KEY `users_idusers_roles_foreign` (`idusers_roles`);

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
  ADD KEY `ventes_idusers_foreign` (`idusers`),
  ADD KEY `ventes_matricule_etudiant_foreign` (`matricule_etudiant`),
  ADD KEY `ventes_idcodes_foreign` (`idcodes`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `auditoires`
--
ALTER TABLE `auditoires`
  MODIFY `idauditoires` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `bulletins`
--
ALTER TABLE `bulletins`
  MODIFY `idbulletins` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `codes`
--
ALTER TABLE `codes`
  MODIFY `idcodes` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `facultes`
--
ALTER TABLE `facultes`
  MODIFY `idfacultes` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `gestion_annees`
--
ALTER TABLE `gestion_annees`
  MODIFY `idgestion_annees` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `idpromotions` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `publications`
--
ALTER TABLE `publications`
  MODIFY `idpublications` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `sections`
--
ALTER TABLE `sections`
  MODIFY `idsections` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `idsessions` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `idusers` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `users_roles`
--
ALTER TABLE `users_roles`
  MODIFY `idusers_roles` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `ventes`
--
ALTER TABLE `ventes`
  MODIFY `idventes` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `auditoires`
--
ALTER TABLE `auditoires`
  ADD CONSTRAINT `auditoires_idfacultes_foreign` FOREIGN KEY (`idfacultes`) REFERENCES `facultes` (`idfacultes`),
  ADD CONSTRAINT `auditoires_idpromotions_foreign` FOREIGN KEY (`idpromotions`) REFERENCES `promotions` (`idpromotions`),
  ADD CONSTRAINT `auditoires_idsections_foreign` FOREIGN KEY (`idsections`) REFERENCES `sections` (`idsections`);

--
-- Contraintes pour la table `bulletins`
--
ALTER TABLE `bulletins`
  ADD CONSTRAINT `bulletins_idcodes_foreign` FOREIGN KEY (`idcodes`) REFERENCES `codes` (`idcodes`),
  ADD CONSTRAINT `bulletins_idpublications_foreign` FOREIGN KEY (`idpublications`) REFERENCES `publications` (`idpublications`),
  ADD CONSTRAINT `bulletins_matricule_etudiant_foreign` FOREIGN KEY (`matricule_etudiant`) REFERENCES `etudiants` (`matricule`);

--
-- Contraintes pour la table `codes`
--
ALTER TABLE `codes`
  ADD CONSTRAINT `codes_idauditoires_foreign` FOREIGN KEY (`idauditoires`) REFERENCES `auditoires` (`idauditoires`),
  ADD CONSTRAINT `codes_idsections_foreign` FOREIGN KEY (`idsections`) REFERENCES `sections` (`idsections`),
  ADD CONSTRAINT `codes_idsessions_foreign` FOREIGN KEY (`idsessions`) REFERENCES `sessions` (`idsessions`),
  ADD CONSTRAINT `codes_matricule_etudiant_foreign` FOREIGN KEY (`matricule_etudiant`) REFERENCES `etudiants` (`matricule`);

--
-- Contraintes pour la table `etudiants`
--
ALTER TABLE `etudiants`
  ADD CONSTRAINT `etudiants_annee_acad_foreign` FOREIGN KEY (`annee_acad`) REFERENCES `gestion_annees` (`idgestion_annees`),
  ADD CONSTRAINT `etudiants_idauditoires_foreign` FOREIGN KEY (`idauditoires`) REFERENCES `auditoires` (`idauditoires`),
  ADD CONSTRAINT `etudiants_idfacultes_foreign` FOREIGN KEY (`idfacultes`) REFERENCES `facultes` (`idfacultes`),
  ADD CONSTRAINT `etudiants_idpromotions_foreign` FOREIGN KEY (`idpromotions`) REFERENCES `promotions` (`idpromotions`),
  ADD CONSTRAINT `etudiants_idsections_foreign` FOREIGN KEY (`idsections`) REFERENCES `sections` (`idsections`);

--
-- Contraintes pour la table `etudiants_succes`
--
ALTER TABLE `etudiants_succes`
  ADD CONSTRAINT `etudiants_succes_idgestion_annees_foreign` FOREIGN KEY (`idgestion_annees`) REFERENCES `gestion_annees` (`idgestion_annees`),
  ADD CONSTRAINT `etudiants_succes_idsessions_foreign` FOREIGN KEY (`idsessions`) REFERENCES `sessions` (`idsessions`),
  ADD CONSTRAINT `etudiants_succes_matricule_etudiant_foreign` FOREIGN KEY (`matricule_etudiant`) REFERENCES `etudiants` (`matricule`);

--
-- Contraintes pour la table `facultes`
--
ALTER TABLE `facultes`
  ADD CONSTRAINT `facultes_idsections_foreign` FOREIGN KEY (`idsections`) REFERENCES `sections` (`idsections`);

--
-- Contraintes pour la table `publications`
--
ALTER TABLE `publications`
  ADD CONSTRAINT `publications_annee_foreign` FOREIGN KEY (`annee`) REFERENCES `gestion_annees` (`idgestion_annees`),
  ADD CONSTRAINT `publications_idauditoires_foreign` FOREIGN KEY (`idauditoires`) REFERENCES `auditoires` (`idauditoires`),
  ADD CONSTRAINT `publications_idsessions_foreign` FOREIGN KEY (`idsessions`) REFERENCES `sessions` (`idsessions`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_idsections_foreign` FOREIGN KEY (`idsections`) REFERENCES `sections` (`idsections`),
  ADD CONSTRAINT `users_idusers_roles_foreign` FOREIGN KEY (`idusers_roles`) REFERENCES `users_roles` (`idusers_roles`);

--
-- Contraintes pour la table `ventes`
--
ALTER TABLE `ventes`
  ADD CONSTRAINT `ventes_idcodes_foreign` FOREIGN KEY (`idcodes`) REFERENCES `codes` (`idcodes`),
  ADD CONSTRAINT `ventes_idusers_foreign` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`),
  ADD CONSTRAINT `ventes_matricule_etudiant_foreign` FOREIGN KEY (`matricule_etudiant`) REFERENCES `etudiants` (`matricule`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;