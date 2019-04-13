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


--
-- Contenu de la table `sections`
--

INSERT INTO `sections` (`idsections`, `lib`, `abbr`) VALUES
(1, 'PREPARATOIRE', 'PREPO'),
(2, 'INFORMATIQUE', 'INFO'),
(3, 'ELECTRICITE', 'ELECT'),
(4, 'MECANIQUE', 'MEC');

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






--
-- Contenu de la table `auditoires`
--

INSERT INTO `auditoires` (`idauditoires`, `lib`, `abbr`, `idfacultes`, `idpromotions`, `idsections`) VALUES
(1, 'PRÉPARATOIRE A', 'PRÉPO A', 1, 1, 1),
(2, 'PRÉPARATOIRE B', 'PRÉPO B', 1, 1, 1),
(3, 'G1 INFORMATIQUE INDUSTRIELLE ET RESEAUX', 'G1 IIR', 2, 2, 2),
(4, 'G1 INFORMATIQUE DE GESTION', 'G1 IG', 8, 2, 2),
(5, 'G1 ELECRONIQUE', 'G1 EN', 3, 2, 3),
(6, 'G1 ELECTROTECHNIQUE', 'G1 ET', 4, 2, 3),
(7, 'G1 ELECTOMECANIQUE', 'G1 EM', 5, 2, 4),
(8, 'G1 CONSTRUCTION METALLIQUE ET NAVALE', 'G1 CMN', 6, 2, 4),
(9, 'G1 MÉCANIQUE AGRICOLE ET AUTOMOBILE', 'G1 MAA', 7, 2, 4),

(10, 'G2 INFORMATIQUE INDUSTRIELLE ET RESEAUX', 'G2 IIR', 2, 3, 2),
(11, 'G2 INFORMATIQUE DE GESTION', 'G2 IG', 8, 3, 2),
(12, 'G2 ELECRONIQUE', 'G2 EN', 3, 3, 3),
(13, 'G2 ELECTROTECHNIQUE', 'G2 ET', 4, 3, 3),
(14, 'G2 ELECTOMECANIQUE', 'G2 EM', 5, 3, 4),
(15, 'G2 CONSTRUCTION METALLIQUE ET NAVALE', 'G2 CMN', 6, 3, 4),
(16, 'G2 MÉCANIQUE AGRICOLE ET AUTOMOBILE', 'G2 MAA', 7, 3, 4),

(17, 'G3 INFORMATIQUE INDUSTRIELLE ET RESEAUX', 'G3 IIR', 2, 4, 2),
(18, 'G3 INFORMATIQUE DE GESTION', 'G3 IG', 8, 4, 2),
(19, 'G3 ELECRONIQUE', 'G3 EN', 3, 4, 3),
(20, 'G3 ELECTROTECHNIQUE', 'G3 ET', 4, 4, 3),
(21, 'G3 ELECTOMECANIQUE', 'G3 EM', 5, 4, 4),
(22, 'G3 CONSTRUCTION METALLIQUE ET NAVALE', 'G3 CMN', 6, 4, 4),
(23, 'G3 MÉCANIQUE AGRICOLE ET AUTOMOBILE', 'G3 MAA', 7, 4, 4),


(24, 'L1 INFORMATIQUE INDUSTRIELLE', 'L1 II', 9, 5, 2),
(25, 'L1 TELECOMMUNICATION', 'L1 TEL', 10, 5, 3),
(26, 'L1 ELECTRO-ENERGETIQUE', 'L1 EE', 11, 5, 3),
(27, 'L1 MECANIQUE DE PRODUCTION', 'L1 MP', 12, 5, 4),
(28, 'L1 MECANIQUE APPLIQUEE', 'L1 MA', 13, 5, 4),

(29, 'L2 INFORMATIQUE INDUSTRIELLE', 'L2 II', 9, 6, 2),
(30, 'L2 TELECOMMUNICATION', 'L2 TEL', 10, 6, 3),
(31, 'L2 ELECTRO-ENERGETIQUE', 'L2 EE', 11, 6, 3),
(32, 'L2 MECANIQUE DE PRODUCTION', 'L2 MP', 12, 6, 4),
(33, 'L2 MECANIQUE APPLIQUEE', 'L2 MA', 13, 6, 4),
(34, 'PRÉPARATOIRE C', 'PRÉPO C', 1, 1, 1);



--
-- Contenu de la table `gestion_annees`
--

INSERT INTO `gestion_annees` (`idgestion_annees`, `annee_debut`, `annee_fin`, `annee_format`) VALUES
(1, 2018, 2019, '2018-2019');

--
-- Contenu de la table `etudiants`
--

-- INSERT INTO `etudiants` (`matricule`, `nom`, `postnom`, `prenom`, `idauditoires`, `annee_acad`, `statut`) VALUES
-- (201515, 'DIALUNDAMA', 'KRISA', 'Peniel', 5, 1, '1'),
-- (201520, 'KAY', 'KUNGUDI', 'Mardoche', 1, 1, '1');




--
-- Contenu de la table `sessions`
--

INSERT INTO `sessions` (`idsessions`, `lib`, `abbr`) VALUES
(1, 'PREMIÈRE SESSION', '1ère  Session'),
(2, 'PREMIÈRE SESSION RECOURS', '1ère Session/R'),
(3, 'DEUXIÈME SESSION', '2e Session'),
(4, 'DEUXIÈME SESSION RECOURS', '2e Session/R');

--
-- Contenu de la table `publications`
--

INSERT INTO `publications` (`idpublications`, `idsessions`, `idauditoires`, `annee`, `statut`) VALUES
(1, 1, 1, 1, '1'),
(3, 2, 1, 1, '1');


	INSERT INTO `etudiants` (`matricule`, `nom`, `postnom`, `prenom`, `idpromotions`, `idfacultes`, `idsections`, `idauditoires`, `annee_acad`, `statut`, `created_at`, `updated_at`) 
					VALUES 
					('201515', 'DIALUNDAMA', 'KRISA', 'PENIEL', '3', '2', '2', '5', '1', '1', CURRENT_TIME(), CURRENT_TIME()),
					('201516', 'ETUDIAN1', 'ETUDIAN1', 'ETUDIAN1', '1', '1', '1', '1', '1', '1', CURRENT_TIME(), CURRENT_TIME()),
					('201517', 'ETUDIANT2', '', 'ETUDIANT2', '2', '2', '2', '2', '1', '1', CURRENT_TIME(), CURRENT_TIME()),
					('201518', 'ETUDIANT3', 'ETUDIANT3', '', '3', '3', '3', '3', '1', '1', CURRENT_TIME(), CURRENT_TIME()),
					('201519', 'ETUDIANT4', 'ETUDIANT4', '', '4', '4', '4', '1', '1', '1', CURRENT_TIME(), CURRENT_TIME()),
					('201520', 'ETUDIANT5', 'ETUDIANT5', 'ETUDIANT5', '5', '5', '4', '2', '1', '1', CURRENT_TIME(), CURRENT_TIME()),
					('201521', 'ETUDIANT6', 'ETUDIANT6', 'ETUDIANT6', '6', '6', '1', '3', '1', '1', CURRENT_TIME(), CURRENT_TIME());




	
--
-- Contenu de la table `codes`
	--

	INSERT INTO `codes` (`idcodes`, `code`, `matricule_etudiant`, `idsessions`,`idsections`,`idauditoires`, `active`, `statut`, `updated_at`) VALUES
	(1, 'AZERTY', 201515, 1, 2, 5, '1', '1', '2018-12-11 22:07:12');


	--
	-- Contenu de la table `bulletins`
		--
		
		INSERT INTO `bulletins` (`idbulletins`, `file`, `matricule_etudiant`, `idcodes`, `idpublications`, `created_at`, `updated_at`) 
		VALUES (NULL, '201515_DIALUNDAMA_1', '201515', '1', '1', NULL, NULL);



	INSERT INTO `users_roles` (`idusers_roles`, `lib`, `level`) VALUES
	(1, 'section', 2),
	(2, 'jury', 4),
	(3, 'admin', 10);


	--
-- Contenu de la table `users`
--

INSERT INTO `users` (`idusers`, `username`, `name`, `first_name`, `email`, `email_verified_at`, `password`, `idsections`, `idusers_roles`, `statut`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'bilwifi', 'Dialu', 'Peniel', 'bilwifi9@gmail.com', NULL, '$2y$10$FXHR6JC3.aJzTvGE8prLROZA1S5fmPjAVRH8t4BoA/jT0GA1BjWn6', 1, 1, 1, '53b01f5d49a6f0aDDbc6a0b3977b2158dd1bf0fc5e73fcb592c2546d5b5353ff0e', '2018-12-21 14:13:59', '2018-12-21 14:13:59'),
(2, 'bil', 'DIALUNDAMA', 'Peniel', 'bil@gmail.com', NULL, '$2y$10$68C8zoKwIy9B8d55n12Or.xfahYrbfMmCuR3SjpGJ4drJ.j8CO/VG', 2, 1, 1, 'ODsOzMLFQW5Dyx4fa1OKMPExT6X7Kjim7qCqO8pltq0U0xSkzNJ2LBC2v2Y1', '2018-12-21 16:08:47', '2018-12-21 16:08:47'),
(3, 'secinformatique', 'informatique', 'informatique', 'info@ispt.com', NULL, '$2y$10$FXHR6JC3.aJzTvGE8prLROZA1S5fmPjAVRH8t4BoA/jT0GA1BjWn6', 2, 1, 1, 'kbQaTcIJLRBM0yp1o3CbkV8pTF1orzGpTGJtHtDgDsCaJjW7ufYXT1HF0D3w', '2018-12-22 20:36:52', '2018-12-22 20:36:52'),
(4, 'secmecanique', 'mecanique', 'mecanique', 'mec@ispt.com', NULL, '$2y$10$FXHR6JC3.aJzTvGE8prLROZA1S5fmPjAVRH8t4BoA/jT0GA1BjWn6', 4, 1, 1, 'MTThzkVeqxRigVdhpzCRfPCEvhRqcIfIE1nokzmVNwB2w3eTLXWTBerWxVze', '2018-12-22 20:41:44', '2018-12-22 20:41:44'),
(5, 'secelectricite', 'electricite', 'electricite', 'elect@ispt.com', NULL, '$2y$10$FXHR6JC3.aJzTvGE8prLROZA1S5fmPjAVRH8t4BoA/jT0GA1BjWn6', 3, 1, 1, 'Q14opnKeCfTR6tEvD8widpUwdPHUAV7gniPE35SKeViXvFATH8y5xk7VyMv0', NULL, NULL),
(6, 'secprepo', 'secprepo', 'secprepo', 'secprepo@ispt.kin', NULL, '$2y$10$FXHR6JC3.aJzTvGE8prLROZA1S5fmPjAVRH8t4BoA/jT0GA1BjWn6', 1, 1, 1, 'y4DjJupAFwa9wb7fKL9D4O45igJ8AuJsbmXqSqXNlAnlOGk9QjddQEzguQ0s', NULL, NULL),
(7, 'secjury', 'jury', 'jury', 'jury@ispt.kin', NULL, '$2y$10$FXHR6JC3.aJzTvGE8prLROZA1S5fmPjAVRH8t4BoA/jT0GA1BjWn6', NULL, 2, 1, 'y4DjJupAFwa9wb7fKL9D4O45igJ8AuJsbmXqSqXNlAnlOGk9QjddQEzguQ0s', NULL, NULL),
(8, 'admin', 'admin', 'admin', 'admin@ispt.com', NULL, '$2y$10$FXHR6JC3.aJzTvGE8prLROZA1S5fmPjAVRH8t4BoA/jT0GA1BjWn6', NULL, 3, 1, '2mN9rAkx2yreGdIv0dZFl9L13NZVmfp1aEvqzmkO8io7GdWG6JBobsIZAf9v', NULL, NULL);
