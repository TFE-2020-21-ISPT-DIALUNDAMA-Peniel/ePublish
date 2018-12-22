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

INSERT INTO `auditoires` (`idauditoires`, `lib`, `abbr`, `idfacultes`, `idpromotions`) VALUES
(1, 'PRÉPARATOIRE A', 'PRÉPO A', 1, 1),
(2, 'PRÉPARATOIRE B', 'PRÉPO B', 1, 1),
(3, 'G1 INFORMATIQUE INDUSTRIELLE ET RESEAU', 'G1 IIR', 2, 2),
(4, 'G1 INFORMATIQUE DE GESTION', 'G1 IG', 8, 2),
(5, 'G2 INFORMATIQUE INDUSTRIELLE ET RESEAUX', 'G2 IIR', 2, 3),
(6, 'G2 INFORMATIQUE DE GESTION', 'G2 IG', 8, 2);


--
-- Contenu de la table `gestion_annees`
--

INSERT INTO `gestion_annees` (`idgestion_annees`, `annee_debut`, `annee_fin`, `annee_format`) VALUES
(1, 2018, 2019, '2018-2019');

--
-- Contenu de la table `etudiants`
--

INSERT INTO `etudiants` (`matricule`, `nom`, `postnom`, `prenom`, `idauditoires`, `annee_acad`, `statut`) VALUES
(201515, 'DIALUNDAMA', 'KRISA', 'Peniel', 1, 1, '1'),
(201520, 'KAY', 'KUNGUDI', 'Mardoche', 1, 1, '1');





--
-- Contenu de la table `sessions`
--

INSERT INTO `sessions` (`idsessions`, `lib`, `abbr`) VALUES
(3, 'DEUXIEME SESSION', '2e Session'),
(4, 'DEUXIÈME SESSION RECOURS', '2e Session/R'),
(1, 'PREMIÈRE SESSION', '1ère  Session'),
(2, 'PREMIÈRE SESSION RECOURS', '1ère Session/R');


--
-- Contenu de la table `session_actives`
--

INSERT INTO `session_actives` (`idsession_actives`, `idsessions`, `idauditoires`, `annee`, `statut`) VALUES
(1, 1, 1, 1, '1'),
(3, 2, 1, 1, '1');


--
-- Contenu de la table `codes`
--

INSERT INTO `codes` (`idcodes`, `code`, `matricule_etudiant`, `idsession_actives`, `active`, `statut`, `updated_at`) VALUES
(3, 'AZERTY', 201515, 1, '1', '1', '2018-12-11 22:07:12');


--
-- Contenu de la table `bulletins`
--

INSERT INTO `bulletins` (`idbulletins`, `file`, `matricule_etudiant`, `idcodes`, `idsession_actives`) VALUES
(1, '201515_DIALUNDAMA_1', 201515, 3, 1);




	