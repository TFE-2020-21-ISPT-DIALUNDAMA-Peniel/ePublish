SELECT * FROM etudiants 
	left JOIN etudiants_succes 
		on etudiants.matricule=etudiants_succes.matricule_etudiant 
		WHERE (etudiants_succes.matricule_etudiant is NULL) OR etudiants_succes.idsessions >= $idsessions

		Etudiant::leftJoin('etudiants_succes ', 'etudiants.matricule', '=', 'etudiants_succes.matricule_etudiant ')
				->where('etudiants_succes.matricule_etudiant',is Null )->orWhere('etudiants_succes.idsessions', '>=', '$idsessions')->get();