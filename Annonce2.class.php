<?php
class Annonce {
	//Info concernant l'annonce
	private $Id_Annonce;
	private $Id_Fonction;
	private $Id_NiveauSouhaite;
	private $TitreAnnonce;
	private $DescriptionAnnonce;
	private $ProfilRecherche;
	private $Id_TypeContrat;
	private $DureeContrat;
	private $Horaire;
	private $NbHeure;
	private $Salaire;
	private $Avantages;
	private $Id_Departement;
	private $GrandeVille;
	private $Id_Recruteur;
	private $Id_Candidat;
	private $Message;
	private $ReferenceRecruteur;
	private $DeptLimitrophe;
	//Parametre pour la recherche
	private $RechFonction;
	private $RechMotCle;
	private $RechContrat;
	private $RechDepartement;
	private $RechRegion;
	private $DescriptionEmployeur;
	private $Id_Formule;
	private $DescriptionRecruteurProfil;
	private $AdresseReponse;
	private $FlagIndeed;
	private $FlagPmeJob;
	private $TexteIndeed;
	private $ReferencePoleEmploi;
	
	


	//Permet de retourner l'annonce demandée
	public function CreationAnnonce($Publication = -2,$Webservice = 0) {
		if($Webservice==0){
			$TitreAnnonce = ($this->TitreAnnonce != "Titre poste *") ? $this->TitreAnnonce : "Titre mal enregistré";
			$DescriptionAnnonce = ($this->DescriptionAnnonce != "Description annonce * (Si vous êtes un cabinet, décrivez votre client sans le nommer)") ? $this->DescriptionAnnonce : "Description à reprendre";
			$ProfilRecherche = ($this->ProfilRecherche != "Profil recherché *") ? $this->ProfilRecherche : "";
			$DureeContrat = ($this->DureeContrat != "Durée du contrat (sauf CDI)") ? $this->DureeContrat : "";
			$NbHeure = ($this->NbHeure != "Nb d`heure") ? $this->NbHeure : "/";
			$Salaire = ($this->Salaire != "Salaire *") ? $this->Salaire : "";
			$Avantages = ($this->Salaire != "Avantages") ? $this->Avantages : "";
			$GrandeVille = ($this->GrandeVille != "GrandeVille *") ? $this->GrandeVille : "";
			$RefRecruteur = ($this->ReferenceRecruteur != "Votre référence") ? $this->ReferenceRecruteur : "";
			$DescriptionEmployeur = ($this->DescriptionEmployeur != "Description de l`employeur (Décrivez votre client sans le nommer)" && $this->DescriptionEmployeur != "Description de l`employeur (Vous pouvez décrire votre société sans la nommer)" ) ? $this->DescriptionEmployeur: "";
			$DescriptionRecruteurProfil = $this->DescriptionRecruteurProfil;
			$DeptLimitrophe = $this->DeptLimitrophe;
			$TexteIndeed = $this->TexteIndeed ;
			$ReferencePoleEmploi = $this->ReferencePoleEmploi;
		}else{
			$TitreAnnonce = ($this->TitreAnnonce != "Titre poste *") ? $this->TitreAnnonce : "Titre mal enregistré";
			$DescriptionAnnonce = ($this->DescriptionAnnonce != "Description annonce * (Si vous êtes un cabinet, décrivez votre client sans le nommer)") ? $this->DescriptionAnnonce : "Description à reprendre";
			$ProfilRecherche = ($this->ProfilRecherche != "Profil recherché *") ? $this->ProfilRecherche : "";
			$DureeContrat = ($this->DureeContrat != "Durée du contrat (sauf CDI)") ? $this->DureeContrat : "";
			$NbHeure = ($this->NbHeure != "Nb d`heure") ? $this->NbHeure: "/";
			$Salaire = ($this->Salaire != "Salaire *") ? $this->Salaire : "";
			$Avantages = ($this->Salaire != "Avantages") ? $this->Avantages : "";
			$GrandeVille = ($this->GrandeVille != "GrandeVille *") ? $this->GrandeVille : "";
			$RefRecruteur = ($this->ReferenceRecruteur != "Votre référence") ? $this->ReferenceRecruteur : "";
			$DescriptionEmployeur = ($this->DescriptionEmployeur != "Description de l`employeur (Décrivez votre client sans le nommer)" && $this->DescriptionEmployeur != "Description de l`employeur (Vous pouvez décrire votre société sans la nommer)" ) ? $this->DescriptionEmployeur : "";
			$DescriptionRecruteurProfil = $this->DescriptionRecruteurProfil;
			$DeptLimitrophe = $this->DeptLimitrophe;
			$TexteIndeed = $this->TexteIndeed ;
			$ReferencePoleEmploi = $this->ReferencePoleEmploi;
		}
		$FonctionDeux = (is_numeric($this->FonctionDeux)) ? $this->FonctionDeux : 0;
		$Id_Fonction = (is_numeric($this->Id_Fonction)) ? $this->Id_Fonction : 4;
		$Id_Formule = (is_numeric($this->Id_Formule)) ? $this->Id_Formule : 1;
		$Id_NiveauSouhaite = (is_numeric($this->Id_NiveauSouhaite)) ? $this->Id_NiveauSouhaite : 4;
		$Id_TypeContrat = (is_numeric($this->Id_TypeContrat)) ? $this->Id_TypeContrat : 4;
		$Horaire = (is_numeric($this->Horaire)) ? $this->Horaire : 1;
		$Id_Departement = (is_numeric($this->Id_Departement)) ? $this->Id_Departement : 0;
		$Id_Recruteur = (is_numeric($this->Id_Recruteur)) ? $this->Id_Recruteur : 0;
		$AdresseReponse = ($this->AdresseReponse != "" && VerifierAdresseMail($this->AdresseReponse)) ? $this->AdresseReponse : "";
		$FlagIndeed=(is_numeric($this->FlagIndeed)) ? $this->FlagIndeed : 0;//
		$FlagPmeJob=(is_numeric($this->FlagPmeJob)) ? $this->FlagPmeJob : 0;//
		$RefTF = $this->creerIdentifiant();
		$Bdd = new Bdd();
		
		
		$Bdd->setRequete("SELECT MAX(Id) FROM annonce");
		$ResultMaxId = $Bdd->RequeteSelect();
		$Id_Annonce = $ResultMaxId[0]["MAX(Id)"] + 1;
		$this->Id_Annonce = $Id_Annonce;

		$Bdd->setRequete("
			INSERT INTO `annonce` 
			(
				`Id`, `TitreAnnonce`, `DescriptifAnnonce`, `ProfilRecherche`, `DateDebut`, `Remuneration`, `Id_TypeContrat`, `DureeContrat`, `id_niveau_souhaite_id`, `id_departement_id`, `id_recruteur_id`, `DateCreation`, `DatePublication`, `DateFinPublication`, `Suspension`, `GrandeVilleProche`, `Avantage`, `Id_Horaire`, `NbHeure`, `NbVues`, `DatePublicationRss`, `ReferenceRecruteur`, `Reference`, `DescriptionEmployeur`, `Id_Formule`, `FlagIndeed`, `DescriptionRecruteurProfil`, `AdresseReponse`, `DeptLimitrophe`, `FlagPmeJob`, `TexteIndeed`, `ReferencePoleEmploi`
			) 
			VALUES (
				$Id_Annonce, '$TitreAnnonce', '$DescriptionAnnonce', '$ProfilRecherche', '" . date("Y-m-d") . "', '$Salaire', '$Id_TypeContrat', '$DureeContrat', '$Id_NiveauSouhaite', '$Id_Departement', 
				'$Id_Recruteur', '" . date("Y-m-d H:i:s") . "','$DatePublication', '" . date("Y-m-d", time() + (60 * 60 * 24 * 60)) . "', '$Publication', '$GrandeVille', '$Avantages', '$Horaire', '$NbHeure',
				'0','" . date("Y-m-d H:i:s") . "','$RefRecruteur','$RefTF','$DescriptionEmployeur','$Id_Formule',$FlagIndeed,'$DescriptionRecruteurProfil','$AdresseReponse','$DeptLimitrophe',$FlagPmeJob,'$TexteIndeed','$ReferencePoleEmploi'
			)
		");
		
		if ($Bdd->RequeteUpDel()) {
			$Crecruteur = new Recruteur();
			$Crecruteur->setIdRecruteur($Id_Recruteur);
			$InfoRecruteur = $Crecruteur->RecupInfoRecruteur();
			$RequeteInsertFct = "
				INSERT INTO annoncefonction
				VALUE (NULL,$Id_Annonce,$Id_Fonction)
			";
			$Bdd->setRequete($RequeteInsertFct);
			$Bdd->RequeteUpDel();
			if($FonctionDeux!=0){
				$RequeteInsertFct2 = "
					INSERT INTO annoncefonction
					VALUE (NULL,$Id_Annonce,$FonctionDeux)
				";
				$Bdd->setRequete($RequeteInsertFct2);
				$Bdd->RequeteUpDel();
			}
			if($InfoRecruteur[0]["Etat"]==0){
				$Crecruteur->setEtat(1);
				$Crecruteur->ModificationEtatRecruteur(1); //on le compte comme nouvel inscrit sur le site puisqu'il a validé son compte
			}
			return true;
		} else {
			return false;
		}
	}
	
	//Permet de retourner l'annonce demandée
	public function AffichageAnnonce($Visiteur = "Candidat", $historique = 0) {
		$Id_Annonce = (is_numeric($this->Id_Annonce)) ? $this->Id_Annonce : 0;
		if ($Visiteur == "Recruteur" && is_numeric($this->Id_Recruteur)) {
			$ReqRecruteur = "AND annonce.Id_Recruteur_Id=" . $this->Id_Recruteur;
			$ReqEnLigne = "";
		} elseif ($Visiteur == "Admin") {
			$ReqRecruteur = "";
			$ReqEnLigne = "";
		} else {
			$ReqRecruteur = "";
			//Si c'est un candidat qui vient alors il ne peut pas lire l'annonce si elle n'est plus active. ()
			if ($historique == 0) {
				//					echo "ok";
				$ReqEnLigne = "
					AND Suspension = 0
					AND DateFinPublication >= '" . date("Y-m-d") . "'
				";
			} else {
				//					echo "nok";
				$ReqEnLigne = "";
			}
		}
		$RequeteAnnonce = "
			SELECT	annonce.*, typecontrat.IntituleTypeContrat, 
			departement.dept,departement.num, recruteur.Societe, recruteur.Adresse, recruteur.Ville, recruteur.Cp ,PrenomContactComm,NomContactComm,
			recruteur.Tel, recruteur.MailSourcing,recruteur.Description, horaire.IntituleHoraire,recruteur.Description AS DescriptionRecruteur, recruteur.Logo, MailComm_login,
			recruteur.MailComm_login, recruteur.PrenomContactComm, recruteur.NomContactComm
			FROM	annonce, horaire,typecontrat, departement,recruteur, niveausouhaite
			WHERE	annonce.Id = $Id_Annonce
			AND niveausouhaite.Id = annonce.Id_NiveauSouhaite_Id
			$ReqRecruteur
			$ReqEnLigne
			AND		annonce.Id_TypeContrat = typecontrat.Id_TypeContrat
			AND		annonce.Id_Departement_Id = departement.Id
			AND		annonce.Id_Recruteur_Id = recruteur.Id
			AND		annonce.Id_Horaire = horaire.Id_Horaire

		";
		$Bdd = new Bdd();
		
		$Bdd->setRequete($RequeteAnnonce);
		$ResultAnnonce = $Bdd->RequeteSelect();
		if($ResultAnnonce!="kenini"){
			return $ResultAnnonce[0];
		}else{
			return "kenini";
		}
	}
	
	//Créer la référence internee  pour Agro-Recrutement, en partant de la derniére créée
	public function creerIdentifiant() {
		//*** on calcule la nouvelle référence de tourneurs fraiseurs ***//
		// Nouvel objet base de données
		$Bdd = new Bdd();
		$Bdd->setRequete("SELECT MAX(Id) FROM annonce");
		$ResultMaxId = $Bdd->RequeteSelect();
		//*** on calcule la nouvelle référence de tourneurs fraiseurs ***//
		$Bdd->setRequete("SELECT Reference FROM annonce WHERE Id=" . $ResultMaxId[0]["MAX(Id)"]);
		$ResultMaxRef = $Bdd->RequeteSelect();
		$TabCaractere = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "Q", "P", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "1", "2", "3", "4", "5", "6", "7", "8", "9", "0"); //liste des caractéres qui vont faire la ref
		$TabCaractereInvers = array_flip($TabCaractere); //on prend l'inverse pour connaitre la ref précedente
		$Precedent = ($ResultMaxRef!="kenini")? $ResultMaxRef[0]["ReferenceTF"]:"AAAA";
		if ($Precedent == "") {
			$C1 = $C2 = $C3 = $C4 = 0; //Chaque Variable correspond a un caractere du code. (Chaque variable va etre incrémenter, + ou - souvent en fonction de sa position)
		} else {
			//Pour savoir ou partir on récupére la valeur actuelle
			$C1 = $TabCaractereInvers[substr($Precedent, 0, 1)];
			$C2 = $TabCaractereInvers[substr($Precedent, 1, 1)];
			$C3 = $TabCaractereInvers[substr($Precedent, 2, 1)];
			$C4 = $TabCaractereInvers[substr($Precedent, 3, 1)];
			if ($C4 == 35) {//Si la variable C6 (derniere dans le code) est superieur a la taille du tableau alors on incrémente C5 et on réinitialise C6
				$C3++;
				$C4 = 0;
				if ($C3 == 35) {
					$C2++;
					$C3 = 0;
					if ($C2 == 35) {
						$C1++;
						$C2 = 0;
						if ($C1 == 33) { //Si a premiere valeur se rapproche de la fin du tableau alros on envoi un mail au webmaster pour le prévenir (logiquement le cas ne devrait pas arriver avant 2050 !!!)
							$headers = 'From: "'.NomSite.'"<'.MailContact.'>' . "\n";
							$headers.='Reply-To: '.MailContact.'\n';
							$headers.='Content-Type: text/html; charset="iso-8859-1"' . "\n";
							$headers.='Content-Transfer-Encoding: 8bit';
							$Ecart = diffJour("2012-03-16 15:00:00", date("Y-m-d H:i:s"), "annee", "exacteUnite");
							mail(MailAlex, "SE.com : vers la fin de la numérotation des annonces. Il va falloir rajouter un caractère de plus !", "Attention L'identifiant des annonces se rapproche dangeureusement de la fin de la numérotation ! <br/><br/>Mais félicitation vous avez rentré (sauf erreur de calcul) 1 586 304 annonces depuis mars 2012. $Ecart", $headers);
						}
					}
				}
			} else {
				$C4++; //on reprend une valeur aprés le dernier et si 
			}
		}
		$RefTF = ""; //on declare la reference
		$f = 1; //compteur pour savoir combien de caractère on va mettre dans l'identifiant.
		while ($f <= 4) { //On char
			$cNiveau = "C$f"; //La valeur que l'on va ajouter
			$RefTF .= $TabCaractere[$$cNiveau];
			$f++;
		}
		return $RefTF;
//ĤĠFIN DE LA CREATION DE LA REFERENCE Ĥį/
	}
	
	//Mettre ࡪour le fichier rss
//On rꤵp鳥 l'entete (en modifiant date Maj) et le pied de page et on rꪣrit le reste. 
//retourne si 1 si pas d'erreur sinon le num곯 de l'erruer (nombre nꨡtif)
// On met a jour les fichiers suivants : 
//		Agro-RecrutementAgro-Recrutement.com.xml (rss principal qui alimente facebook viadeo twitter)
//		Agro-Recrutement.indeed.com.xml (xml qui alimente le flux indeed)
	public function MajRss($HauteurChemin = "", $Id_AncienRecrut = 0) {
		//$this->lectureFluxXML(); //on commence par lire les flux XML pour ajouter les annonces qui ne seraient pas encore en ligne !
		$noerreur = 1;
		
		//on ecrit pour mettre a jour le RSS a jour
		if ($ouvre = fopen("/kunden/homepages/14/d422478032/htdocs/rss/recrutic.xml", "r+")) { // ouverture en lecture et ꤲiture sans vider le fichier ( r+)
			if ($contenuFichier = fread($ouvre, filesize("/kunden/homepages/14/d422478032/htdocs/rss/recrutic.xml"))) { //on rꤵp鳥 l'ensemble du texte
				fclose($ouvre); //on ferme le fichier pendant que l'on travaille dessus	
				$explodeItem = explode("<item>", $contenuFichier);
				$enTeteFichier = $explodeItem[0]; //on rꤵp鳥 l'en t뵥 du fichier
				$explodeDateMaj = explode("<lastBuildDate>", $enTeteFichier); //on supprime l'ancienne heure de Maj en s걡rant le dꣵt du fichier de la balise lastBuildDate
				unset($explodeDateMaj[1]);
				$DateMaj = date(DATE_RFC822);
				$enTeteFichier = $explodeDateMaj[0] . "<lastBuildDate>$DateMaj</lastBuildDate>\n";
				$DernierElement = $explodeItem[sizeof($explodeItem) - 1]; // on rꤵp鳥 le dernier item plus la fin du fichier
				$explodeFinItem = explode("</item>", $DernierElement);
				unset($DernierElement);
				$piedPageFichier = $explodeFinItem[1];
				$this->setId_Recruteur(0); //Il faut que l'on mettent a jour les annonces de tous le monde donc juste pour la requete suivante il faut faire sauter l'id recruteur
				$ResultAnnonce = $this->RechercheAnnonce("annonce.Id_Annonce DESC");

				$this->setId_Recruteur($Id_AncienRecrut); //on remet l'id recruteur pour ne pas causer d'erreur sur la suite du script

				$Item = "";
				$minute = 1;
				for ($i = 0; $i < sizeof($ResultAnnonce); $i++) {

					$Item .="<item>\n";
					//$Item .="<id>".trim($ResultAnnonce[$i]["Id_Annonce"])."</id>\n";
					$Item .="<title>" . str_replace("&",".",str_replace("&#039;","'",trim(html_entity_decode(str_replace("<", "", str_replace(">", "", str_replace("\\", "", $ResultAnnonce[$i]["TitreAnnonce"]))))))) . "</title>\n";
					$Item .="<description>" . str_replace("&",".",str_replace("&#039;","'",trim(html_entity_decode(str_replace("<", "", str_replace(">", "", str_replace("\\", "", $ResultAnnonce[$i]["DescriptifAnnonce"]))))))) . "</description>\n";
					//		$date = date_create($ResultNbAnnonce[$i]["DateCreation"]);
					//		$dateCreation = date_format($date, 'D, d M Y');
					$ExplodeDateHeure = explode(" ", $ResultAnnonce[$i]["DatePublicationRss"]);
					//print_tab($ExplodeDateHeure);
					$ExplodeDate = explode("-", $ExplodeDateHeure[0]);
					$ExplodeHeure = explode(":", $ExplodeDateHeure[1]);
					$Year = $ExplodeDate[0];
					$Month = $ExplodeDate[1];
					$Day = $ExplodeDate[2];
					$Hour = $ExplodeHeure[0];
					$Minute = $ExplodeHeure[1];
					$Seconde = $ExplodeHeure[2];

					$DateRss = date(DATE_RFC822, mktime($Hour, $Minute, $Seconde, $Month, $Day, $Year));
					$Item .="<pubDate>" . $DateRss . "</pubDate>\n";
					$remplace = array('à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'è' => 'e', '&eacute;' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ÿ' => 'y', 'ñ' => 'n', 'ç' => 'c', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', '?' => 'Y', 'Ñ' => 'N', 'Ç' => 'C', 'ø' => '0');
					$TitreAnnonce = stripslashes((strtr(($ResultAnnonce[$i]["TitreAnnonce"]), $remplace)));
					$TitreAnnonceUrl = strtolower(str_replace(')','-',str_replace('(','-',str_replace('---','-',str_replace('/','-',str_replace(' ','-',$TitreAnnonce))))));
					$Item .="<link>".$ResultAnnonce[$i]["UrlSiteEmploi"]."/offre-".$ResultAnnonce[$i]["Id_Annonce"]."-".$TitreAnnonceUrl.".html</link>\n";
//					$Item .="<link>".$ResultAnnonce[$i]["UrlSiteEmploi"]."/offre.php?Id_Annonce=".$ResultAnnonce[$i]["Id_Annonce"]. "</link>\n";
					$Item .="</item>\n";
				}
				//echo $enTeteFichier.$Item.$piedPageFichier;
				if ($ouvre = fopen("/kunden/homepages/14/d422478032/htdocs/rss/recrutic.xml", "w+")) { //on rouvre le fichier en le vidant pour remettre ࡪour son contenu
					if (!fwrite($ouvre, $enTeteFichier . $Item . $piedPageFichier)) { // ꤲiture fichier
						$noerreur = -3;
					}
					fclose($ouvre);
				} else {
					$noerreur = -2;
				}
			} else {
				$noerreur = -4;
			}
		} else {
			$noerreur = -1;
		}
		return $noerreur;
	}
	
	//Permet de modifier l'anonnce demandꥍ
	public function ModificationAnnonce($HauteurChemin = "", $Admin = 0) {
		$Id_Annonce = (is_numeric($this->Id_Annonce)) ? $this->Id_Annonce : 0;
		$ListeFonction = (is_array($this->Id_Fonction)) ? $this->Id_Fonction : array();
		$Id_NiveauSouhaite = (is_numeric($this->Id_NiveauSouhaite)) ? $this->Id_NiveauSouhaite : 4;
		if ($Admin == 1) {
			$TitreAnnonce = ($this->TitreAnnonce != "Titre poste *" && $this->TitreAnnonce != "") ? $this->TitreAnnonce : "";
			$ReqTitreAnnonce = ($TitreAnnonce != "") ? "`TitreAnnonce`='$TitreAnnonce'," : "";
		
		} else {
			$ResultAncienAnnonce = $this->AffichageAnnonce();
			if (intval($ResultAncienAnnonce["Suspension"]) < 0) { //Si jamais l'annonce n'est pas encore validꥠalors on tol鳥 que le titre soit modifier
				$TitreAnnonce = ($this->TitreAnnonce != "Titre poste *" && $this->TitreAnnonce != "") ? $this->TitreAnnonce: "";
				$ReqTitreAnnonce = ($TitreAnnonce != "") ? "`TitreAnnonce`='$TitreAnnonce'," : "";
			} else {
				$ReqTitreAnnonce = "";
			}
		}
		$DescriptionAnnonce = ($this->DescriptionAnnonce != "Description annonce * (Si vous êtes un cabinet, décrivez votre client sans le nommer)") ? $this->DescriptionAnnonce: "Description à reprendre";
		$ProfilRecherche = ($this->ProfilRecherche != "Profil recherché *") ? $this->ProfilRecherche : "";
		$Id_TypeContrat = (is_numeric($this->Id_TypeContrat)) ? $this->Id_TypeContrat : 4;
		$DureeContrat = ($this->DureeContrat != "Durée du contrat (sauf CDI)") ? $this->DureeContrat : "";
		$Horaire = (is_numeric($this->Horaire)) ? $this->Horaire : 1;
		$NbHeure = ($this->NbHeure != "Nb d`heure") ? $this->NbHeure : "/";
		$Salaire = ($this->Salaire != "Salaire *") ? $this->Salaire : "";
		$Avantages = ($this->Salaire != "Avantages") ? $this->Avantages : "";
		$Id_Departement = (is_numeric($this->Id_Departement)) ? $this->Id_Departement : 0;
		$GrandeVille = ($this->GrandeVille != "GrandeVille *") ? $this->GrandeVille : "";
		$Id_Recruteur = (is_numeric($this->Id_Recruteur)) ? $this->Id_Recruteur : 0;
		$RefRecruteur = ($this->ReferenceRecruteur != "Votre référence") ? $this->ReferenceRecruteur : "";
		$DescriptionEmployeur = ($this->DescriptionEmployeur != "Description de l`employeur (Décrivez votre client sans le nommer)" && $this->DescriptionEmployeur != "Description de l`employeur (Vous pouvez décrire votre société sans la nommer)" ) ? $this->DescriptionEmployeur : "";
		$DescriptionRecruteurProfil = $this->DescriptionRecruteurProfil;
		$DeptLimitrophe = $this->DeptLimitrophe;
		$AdresseReponse = ($this->AdresseReponse != "" && VerifierAdresseMail($this->AdresseReponse)) ? $this->AdresseReponse : "";
		$Bdd = new Bdd();

		$Bdd->setRequete("
					UPDATE `annonce` 
					SET 
					$ReqTitreAnnonce `DescriptifAnnonce`='$DescriptionAnnonce', `ProfilRecherche`='$ProfilRecherche', `Remuneration`='$Salaire', `Id_TypeContrat`='$Id_TypeContrat', 
					`DureeContrat`='$DureeContrat', `Id_NiveauSouhaite_Id`='$Id_NiveauSouhaite', `Id_Departement_Id`='$Id_Departement', `Id_Recruteur_Id`= '$Id_Recruteur',`GrandeVilleProche`='$GrandeVille', 
					`Avantage`='$Avantages', `Id_Horaire`='$Horaire', `NbHeure`='$NbHeure', `ReferenceRecruteur`='$RefRecruteur', `DescriptionEmployeur`='$DescriptionEmployeur', 
					DescriptionRecruteurProfil='$DescriptionRecruteurProfil',DeptLimitrophe='$DeptLimitrophe', AdresseReponse = '$AdresseReponse'
					WHERE Id='$Id_Annonce'
					");
		if ($Bdd->RequeteUpDel()) {
			$ResultFonctionAnnonce = $this->ListeFonctionAnnonce($Id_Annonce);
			if($ResultFonctionAnnonce!="kenini"){
				for($m=0;$m<sizeof($ResultFonctionAnnonce);$m++){
					$FonctionAnnonceOld[$ResultFonctionAnnonce[$m]["Id_SiteEmploi"]]=$ResultFonctionAnnonce[$m]["Id_Fonction"];
				}
			}
			foreach ($ListeFonction AS $Id_SE=>$Id_Fonction){
				if(isset($FonctionAnnonceOld[$Id_SE]) && $FonctionAnnonceOld[$Id_SE]==$Id_Fonction){ //on fait rien
					unset($FonctionAnnonceOld[$Id_SE]); //on supprime la ligne pour ne garder que les sites qui ne sont plus l͊				}elseif(isset($FonctionAnnonceOld[$Id_SE])){ //on fait un update
					$RequeteMajFct = "
						UPDATE annoncefonction, fonction
						SET annoncefonction.Id_Fonction = $Id_Fonction
						WHERE Id_Annonce='$Id_Annonce'
						AND fonction.Id_SiteEmploi = ".$Id_SE."	
						AND fonction.Id = annoncefonction.Id_Fonction
					";
					unset($FonctionAnnonceOld[$Id_SE]);
				}else{ //on fait un insert
					$RequeteMajFct = "
						INSERT INTO annoncefonction
						VALUE (NULL, $Id_Annonce ,$Id_Fonction)
					";
				}
				$Bdd->setRequete($RequeteMajFct);
				$Bdd->RequeteUpDel();
			}

			if(isset($FonctionAnnonceOld) && is_array($FonctionAnnonceOld)){
				foreach ($FonctionAnnonceOld AS $Id_SE=>$Id_Fonction){
					$RequeteDelFct = "
						DELETE FROM annoncefonction
						WHERE Id_Annonce='$Id_Annonce'
						AND Id_Fonction = $Id_Fonction
					";
					$Bdd->setRequete($RequeteDelFct);
					$Bdd->RequeteUpDel();	
				}
			}
			return true;
		} else {
			return false;
		}
	}

	//Publier ou d걵blier l'annonce. 
	//$Action : 3 valeurs possible : Republier ou Suspendre ou AdminSuspension
	public function PublicationAnnonce($Action, $HauteurChemin = "", $Admin = 0,$Id_NewFormule = 1,$RaisonRejet=0) {
		$Id_Annonce = $this->Id_Annonce;
		$Id_Recruteur = $this->Id_Recruteur;
		if(is_numeric($Id_Annonce) && $Id_Annonce!=0){
			$Bdd = new Bdd();
			$Bdd->setRequete("SELECT Suspension, Id_Formule FROM annonce WHERE Id = $Id_Annonce");
			$InfoAnnonce = $Bdd->RequeteSelect();
			$Bdd->setRequete("
				SELECT *
				FROM formule
				WHERE Id_Formule = '$Id_NewFormule'
			");
			$FormuleTF = $Bdd->RequeteSelect();

			$Bdd->setRequete("
				SELECT *
				FROM recruteurformule, recruteur
				WHERE recruteur.Id = '$Id_Recruteur'
				AND recruteurformule.Id_RecruteurFormule = recruteur.Id_RecruteurFormule
			");
			
			$HistoriqueFormuleTF = $Bdd->RequeteSelect();
			$ChampsHistorique = $FormuleTF[0]["NomChampsHistorique"]; //Le nom du champs
			$ChampsNbRestant = $FormuleTF[0]["NomChampsRecruteurFormule"]; //Le nom du champs
			$NbAnnnonceHistorique  =  $HistoriqueFormuleTF[0][$ChampsHistorique]; //on rꤵp鳥 le nombre d'annonce dꫠ pass顤ans ce mode lࡰour savoir l'incrꮥnter
			$NbAnnnonceRestant  =  $HistoriqueFormuleTF[0][$ChampsNbRestant]; //on rꤵp鳥 le nombre d'annonce dꫠ pass顤ans ce mode lࡰour savoir l'incrꮥnter
			//On v곩fie les champs obligatoires

			if ($Action == "Republier") {
				//
				if ($InfoAnnonce[0]["Suspension"] != 2 && $InfoAnnonce[0]["Suspension"] != -1 && $InfoAnnonce[0]["Suspension"] != -2  && $InfoAnnonce[0]["Suspension"] != 3 && $InfoAnnonce[0]["Id_Formule"]>1) {
						$RequetePublication = "
							UPDATE annonce
							SET DatePublication = '" . date("Y-m-d") . "', DateFinPublication = '" . date("Y-m-d", time() + ($FormuleTF[0]["NbJoursEnLigne"] * 24 * 60 * 60)) . "', Suspension=0, `DatePublicationRss`='" . date("Y-m-d H:i:s") . "'
							WHERE Id = $Id_Annonce
						";
						$Bdd = new Bdd();
						$Bdd->setRequete($RequetePublication);
						if ($Bdd->RequeteUpDel()) {
							//Mise ࡪour du rss
//							$Rss = $this->MajRss($HauteurChemin, $Id_Recruteur);
//							if ($Rss != 1) { //Permet de mettre ࡪour le flux rss 
//								//Ĥœi il y a une erreur on l'enregistre dans un fichier texte
//								$ouvre = fopen($HauteurChemin . "Erreur/Erreur.txt", "a+"); // ouverture en lecture ( a+)
//								fwrite($ouvre, "\n\n\n\nErreur ".NomSite." RSS le " . date("d-m-Y G:i") . " La mise ࡪour du flux ࡩchou頭 NumErreur : $Rss - Annonce : $Id_Annonce"); // ꤲiture fichier
//								fclose($ouvre);
//							}
							return true;
						} else {
							return "Votre action n a pas pu 뵲e 깩cutꥬ merci de recommencer plus tard.";
						}
	//				} else {
	//					return "Vous n avez plus le droit de poster d'annonce, vous ne pouvez pas republier l annonce";
	//				}
				}elseif($InfoAnnonce[0]["Id_Formule"]==1 && $Id_NewFormule>1 && $NbAnnnonceRestant>0){//Si on veut la republier en l'upgradant. Possible si la formule de base est gratuite, si la formule a l'arrive est payante et si il reste du crꥩt.
					$NewNbAnnnonceHistorique = $NbAnnnonceHistorique+1;
					$NewNbAnnnonceRestant = $NbAnnnonceRestant-1;
					$RequetePublication = "
						UPDATE annonce,recruteurformule, recruteur
						SET		DatePublication = '" . date("Y-m-d") . "', DateFinPublication = '" . date("Y-m-d", time() + ($FormuleTF[0]["NbJoursEnLigne"] * 24 * 60 * 60)) . "', Suspension=0, 
								`DatePublicationRss`='" . date("Y-m-d H:i:s") . "', Id_Formule='$Id_NewFormule', recruteurformule.$ChampsHistorique='$NewNbAnnnonceHistorique'
						WHERE Id = $Id_Annonce
						AND annonce.Id_Recruteur_Id = recruteur.Id
						AND recruteur.Id_RecruteurFormule = recruteurformule.Id_RecruteurFormule
					";
					$Bdd = new Bdd();
					$Bdd->setRequete($RequetePublication);
					if ($Bdd->RequeteUpDel()) {
						//Mise ࡪour du rss
//						$Rss = $this->MajRss($HauteurChemin, $Id_Recruteur);
						//echo $Rss;
//						if ($Rss != 1) { //Permet de mettre ࡪour le flux rss 
//							//Ĥœi il y a une erreur on l'enregistre dans un fichier texte
//							$ouvre = fopen($HauteurChemin . "Erreur/Erreur.txt", "a+"); // ouverture en lecture ( a+)
//							fwrite($ouvre, "\n\n\n\nErreur ".NomSite." RSS le " . date("d-m-Y G:i") . " La mise ࡪour du flux ࡩchou頭 NumErreur : $Rss - Annonce : $Id_Annonce"); // ꤲiture fichier
//							fclose($ouvre);
//						}
						return true;
					} else {
						return "Votre action n a pas pu 뵲e 깩cutꥬ merci de recommencer plus tard.";
					}
				}elseif($InfoAnnonce[0]["Suspension"]== 3){ //si l'annonce est annulꥠalors on la pr頭 publie (soumie a l'admin) car pour le moment l'admin en a pas pris connaissance
					$RequetePublication = "
							UPDATE annonce
							SET DatePublication = '" . date("Y-m-d") . "', DateFinPublication = '" . date("Y-m-d", time() + ($FormuleTF[0]["NbJoursEnLigne"] * 24 * 60 * 60)) . "', Suspension=-1, `DatePublicationRss`='" . date("Y-m-d H:i:s") . "'
							WHERE Id = $Id_Annonce
						";
						$Bdd = new Bdd();
						$Bdd->setRequete($RequetePublication);
						if ($Bdd->RequeteUpDel()) {
							//Mise ࡪour du rss
//							$Rss = $this->MajRss($HauteurChemin, $Id_Recruteur);

//							if ($Rss != 1) { //Permet de mettre ࡪour le flux rss 
//								//Ĥœi il y a une erreur on l'enregistre dans un fichier texte
//								$ouvre = fopen($HauteurChemin . "Erreur/Erreur.txt", "a+"); // ouverture en lecture ( a+)
//								fwrite($ouvre, "\n\n\n\nErreur ".NomSite." RSS le " . date("d-m-Y G:i") . " La mise ࡪour du flux ࡩchou頭 NumErreur : $Rss - Annonce : $Id_Annonce"); // ꤲiture fichier
//								fclose($ouvre);
//							}
							return true;
						} else {
							return "Votre action n a pas pu 뵲e 깩cutꥬ merci de recommencer plus tard.";
						}
				}else {
					if ($Admin == 1) {
						$RequetePublication = "
							UPDATE annonce
							SET DatePublication = '" . date("Y-m-d") . "', DateFinPublication = '" . date("Y-m-d", time() + ($FormuleTF[0]["NbJoursEnLigne"] * 24 * 60 * 60)) . "', Suspension=0, `DatePublicationRss`='" . date("Y-m-d H:i:s") . "'
							WHERE Id = $Id_Annonce
						";
						echo $RequetePublication;
						$Bdd = new Bdd();
						$Bdd->setRequete($RequetePublication);
						if ($Bdd->RequeteUpDel()) {
							//Mise ࡪour du rss
//							$Rss = $this->MajRss($HauteurChemin, $Id_Recruteur);

//							if ($Rss != 1) { //Permet de mettre ࡪour le flux rss 
//								//Ĥœi il y a une erreur on l'enregistre dans un fichier texte
//								$ouvre = fopen($HauteurChemin . "Erreur/Erreur.txt", "a+"); // ouverture en lecture ( a+)
//								fwrite($ouvre, "\n\n\n\nErreur ".NomSite." RSS le " . date("d-m-Y G:i") . " La mise ࡪour du flux ࡩchou頭 NumErreur : $Rss - Annonce : $Id_Annonce"); // ꤲiture fichier
//								fclose($ouvre);
//							}
							return true;
						} else {
							return "Cette annonce a été suspendu par les administrateurs du site, vous ne pouvez pas republier l annonce";
						}
					}
				}
			} elseif ($Action == "Suspendre") {
				$RequetePublication = "
						UPDATE annonce
						SET Suspension=1
						WHERE Id = $Id_Annonce
						";
				$Bdd = new Bdd();
				$Bdd->setRequete($RequetePublication);
				if ($Bdd->RequeteUpDel()) {
					//Mise ࡪour du rss
//					$Rss = $this->MajRss($HauteurChemin, $Id_Recruteur);

//					if ($Rss != 1) { //Permet de mettre ࡪour le flux rss 
//						//Ĥœi il y a une erreur on l'enregistre dans un fichier texte
//						$ouvre = fopen($HauteurChemin . "Erreur/Erreur.txt", "a+"); // ouverture en lecture ( a+)
//						fwrite($ouvre, "\n\n\n\nErreur ".NomSite." RSS le " . date("d-m-Y G:i") . " La mise ࡪour du flux ࡩchou頭 NumErreur : $Rss - Annonce : $Id_Annonce"); // ꤲiture fichier
//						fclose($ouvre);
//					}
					return true;
				} else {
					return "Votre action n a pas pu être éxécutée correctement, merci de recommencer plus tard.";
				}
			} elseif ($Action == "AdminSuspension") {
				$RequetePublication = "
						UPDATE annonce
						SET Suspension=2, Id_RejetAnnonce=$RaisonRejet
						WHERE Id = $Id_Annonce
						";
				$Bdd = new Bdd();
				$Bdd->setRequete($RequetePublication);
				if ($Bdd->RequeteUpDel($RequetePublication)) {
					//Mise ࡪour du rss
//					$Rss = $this->MajRss($HauteurChemin, $Id_Recruteur);

//					if ($Rss != 1) { //Permet de mettre ࡪour le flux rss 
//						//Ĥœi il y a une erreur on l'enregistre dans un fichier texte
//						$ouvre = fopen($HauteurChemin . "Erreur/Erreur.txt", "a+"); // ouverture en lecture ( a+)
//						fwrite($ouvre, "\n\n\n\nErreur ".NomSite." RSS le " . date("d-m-Y G:i") . " La mise ࡪour du flux ࡩchou頭 NumErreur : $Rss - Annonce : $Id_Annonce"); // ꤲiture fichier
//						fclose($ouvre);
//					}
					return true;
				} else {
					return "Votre action n a pas puêtre éxécutée correctement, merci de recommencer plus tard.";
				}
			}elseif($Action=="Publication"){
				if($InfoAnnonce[0]["Suspension"]==-2 || $InfoAnnonce[0]["Suspension"]==3){ //Pr顰ublication par le recruteur
					//Soit il reste du crꥩt pour l'offre soit on est sur de l'ilimit顤onc la valeur est -1 (vraie pour le mode gratuit)
					if($NbAnnnonceRestant>0 ){
						$NewNbAnnnonceHistorique = $NbAnnnonceHistorique+1;
						$NewNbAnnnonceRestant = $NbAnnnonceRestant-1;
						//, recruteurformule.$ChampsHistorique='$NewNbAnnnonceHistorique'
						//A ce moment la on ne change pas le nombre d'annonce autoris顰our le recruteur. On le changera au moment ou l'admin la publiera
						$RequetePublication = "
							UPDATE annonce,recruteurformule,recruteur
							SET 
								DatePublication = '" . date("Y-m-d") . "', DateFinPublication = '" . date("Y-m-d", time() + ($FormuleTF[0]["NbJoursEnLigne"] * 24 * 60 * 60)) . "', 
								Suspension=-1, `DatePublicationRss`='" . date("Y-m-d H:i:s") . "', annonce.Id_Formule=$Id_NewFormule
							WHERE Id = $Id_Annonce
							AND annonce.Id_Recruteur_Id = recruteur.Id
							AND recruteurformule.Id_RecruteurFormule = recruteur.Id_RecruteurFormule
						";
						$Bdd = new Bdd();
						$Bdd->setRequete($RequetePublication);
						if($Bdd->RequeteUpDel()){
							return true;
						}else{
							return "Votre action n a pas pu être éxécutée correctement, merci de recommencer dans quelques minutes.";
						}
					}elseif($NbAnnnonceRestant==-1){
						$NewNbAnnnonceHistorique = $NbAnnnonceHistorique+1;

						$RequetePublication = "
							UPDATE annonce,recruteurformule,recruteur
							SET 
								DatePublication = '" . date("Y-m-d") . "', DateFinPublication = '" . date("Y-m-d", time() + ($FormuleTF[0]["NbJoursEnLigne"] * 24 * 60 * 60)) . "', 
								Suspension=-1, `DatePublicationRss`='" . date("Y-m-d H:i:s") . "', annonce.Id_Formule=$Id_NewFormule
							WHERE Id = $Id_Annonce
							AND annonce.Id_Recruteur_Id = recruteur.Id
							AND recruteurformule.Id_RecruteurFormule = recruteur.Id_RecruteurFormule
						";
						$Bdd = new Bdd();
						$Bdd->setRequete($RequetePublication);
						if($Bdd->RequeteUpDel()){
							return true;
						}else{
							return "Votre action n a pas pu être éxécutée correctement, merci de recommencer dans quelques minutes.";
						}
					}else{
						return "Vous ne disposez d'aucun crédit permettant la mise en avant de vos offres";
					}
				}elseif($InfoAnnonce[0]["Suspension"]==-1 && $Admin==1){ //Premiere publication par les mod곡teurs
					
					//Soit il reste du crꥩt pour l'offre soit on est sur de l'ilimit顤onc la valeur est -1 (vraie pour le mode gratuit)
					if($NbAnnnonceRestant>0 ){
						$NewNbAnnnonceHistorique = $NbAnnnonceHistorique+1;
						$NewNbAnnnonceRestant = $NbAnnnonceRestant-1;
						//, recruteurformule.$ChampsHistorique='$NewNbAnnnonceHistorique'
						//A ce moment la on ne change pas le nombre d'annonce autoris顰our le recruteur. On le changera au moment ou l'admin la publiera
						$RequetePublication = "
							UPDATE annonce,recruteurformule,recruteur
							SET 
								DatePublication = '" . date("Y-m-d") . "', DateFinPublication = '" . date("Y-m-d", time() + ($FormuleTF[0]["NbJoursEnLigne"] * 24 * 60 * 60)) . "', 
								Suspension=0, `DatePublicationRss`='" . date("Y-m-d H:i:s") . "', annonce.Id_Formule=$Id_NewFormule, recruteurformule.$ChampsHistorique='$NewNbAnnnonceHistorique'
							WHERE Id = $Id_Annonce
							AND annonce.Id_Recruteur_Id = recruteur.Id
							AND recruteurformule.Id_RecruteurFormule = recruteur.Id_RecruteurFormule
						";
						$Bdd = new Bdd();
						$Bdd->setRequete($RequetePublication);
						if($Bdd->RequeteUpDel()){
							NbNouvelleAnnonces(date("Y-m-d"));
							//Mise ࡪour du rss
//							$Rss = $this->MajRss($HauteurChemin, $Id_Recruteur);
							return true;
						}else{
							return "Votre action n a pas pu être éxécutée correctement, merci de recommencer dans quelques minutes.";
						}
					}elseif($NbAnnnonceRestant==-1){ //Si on est en illimit顡lors on peut avoir un compte
						$NewNbAnnnonceHistorique = $NbAnnnonceHistorique+1;

						$RequetePublication = "
							UPDATE annonce,recruteurformule,recruteur
							SET 
								DatePublication = '" . date("Y-m-d") . "', DateFinPublication = '" . date("Y-m-d", time() + ($FormuleTF[0]["NbJoursEnLigne"] * 24 * 60 * 60)) . "', 
								Suspension=0, `DatePublicationRss`='" . date("Y-m-d H:i:s") . "', annonce.Id_Formule=$Id_NewFormule, recruteurformule.$ChampsHistorique='$NewNbAnnnonceHistorique'
							WHERE Id = $Id_Annonce
							AND annonce.Id_Recruteur_Id = recruteur.Id
							AND recruteurformule.Id_RecruteurFormule = recruteur.Id_RecruteurFormule
						";
						$Bdd = new Bdd();
						$Bdd->setRequete($RequetePublication);
						if($Bdd->RequeteUpDel()){
							NbNouvelleAnnonces(date("Y-m-d"));
//							$Rss = $this->MajRss($HauteurChemin, $Id_Recruteur);
							return true;
						}else{
							return "Votre action n a pas pu être éxécutée correctement, merci de recommencer dans quelques minutes.";
						}
					}else{
						return "Ce recruteur ne possède pas les crédits nécessaires";
					}
				}elseif($InfoAnnonce[0]["Suspension"]==2 && $Admin==1){ //Republication par les mod곡teurs
					$RequetePublication = "
						UPDATE annonce,recruteurformule,recruteur
						SET 
							DatePublication = '" . date("Y-m-d") . "', DateFinPublication = '" . date("Y-m-d", time() + ($FormuleTF[0]["NbJoursEnLigne"] * 24 * 60 * 60)) . "', 
							Suspension=0, `DatePublicationRss`='" . date("Y-m-d H:i:s") . "', annonce.Id_Formule=$Id_NewFormule, recruteurformule.$ChampsHistorique='$NewNbAnnnonceHistorique'
						WHERE Id = $Id_Annonce
						AND annonce.Id_Recruteur_Id = recruteur.Id
						AND recruteurformule.Id_RecruteurFormule = recruteur.Id_RecruteurFormule
					";
					$Bdd = new Bdd();
					$Bdd->setRequete($RequetePublication);
					if($Bdd->RequeteUpDel()){
						return true;
					}else{
						return "L'annonce ne peut pas être publié à cause d'une erreur SQL";
					}
				}else{
					return "Votre annonce ne peut pas étre publiée car elle n'est pas en attente. Vous avez du cliquez sur le mauvais lien";
				}

			}elseif($Action=="Annulation"){
				if($InfoAnnonce[0]["Suspension"]==-2){
					//Soit il reste du crꥩt pour l'offre soit on est sur de l'ilimit顤onc la valeur est -1 (vraie pour le mode gratuit)
				
					$RequetePublication = "
						UPDATE annonce
						SET DatePublication = '" . date("Y-m-d") . "', DateFinPublication = '" . date("Y-m-d") . "', Suspension=3, annonce.Id_Formule=1
						WHERE Id = $Id_Annonce
					";
					$Bdd = new Bdd();
					$Bdd->setRequete($RequetePublication);
					if($Bdd->RequeteUpDel()){
						return true;
					}else{
						return "Votre action n a pas pu être éxécutée correctement, merci de recommencer dans quelques minutes.";
					}

				} else {
					return "Une erreur s est produite, merci de recommencer plus tard";
				}
			}  else {
				return "Une erreur s est produite, merci de recommencer plus tard";
			}
		}else{
			return "Oups, nous ne trouvons pas l'annonce. Merci de recommencer l'opération ";
		}
	}

//Recherche des annonces 
//3 parametres : 
//$tri = critere de tri des annonces,  doit etre le nom exact du champs
//$Suspension = permet de trier si annonce est autoriser ࡥtre en ligne ou non 
// si $Suspension = -3 on recherche toute les annonces sans le critere suspension
// si $Suspension = -2 on ne recherche que les annonces qui ne sont pas en ligne ou en attente !!!!!!!! cette valeur est a combin顡vec $EnLigne = 0 pour ne pas tenir compte de la date !!!!!!!!
//$Enligne = Si oui alors on compare date du jour et date de fin publication
//On peut afficher toute les annonce pour un cabinet en appelant setIdCabinet()
//Le parametre Gratuit : -1 on n'en tient pas compte, 1 que les gratuites, 0 toutes les payantes sinon correspond ࡵne offre en particulier
//Le parametre stage : Si c'est ࠭1 alors on cherche tout stage ou non, si c'est a 0 on exclu les stages, si c'est a 1 alors on ne cherche que 衠!
//
	//Retourne la liste des annonces dans un tableau a 2 dimensions ou kenini si aucun r괵ltat
	public function RechercheAnnonce($tri = "recruteur.FlagEnHaut DESC, annonce.DatePublication DESC, annonce.Id", $Suspension = 0, $EnLigne = 1, $Limit = 0, $Last = 0, $HauteurChemin = "", $DepartementRss = "", $RegionTF = "",$FluxIndeed=-1, $APartir=0,$Gratuit=-1, $Reference = "", $Stage=-1, $Id_Candidat=0, $Compter=0, $Id_SiteEmploi=0) {
		
		$ReqRecruteur = (is_numeric($this->Id_Recruteur) && $this->Id_Recruteur != 0) ? "AND recruteur.Id=" . $this->Id_Recruteur : "";
		$ReqDepartementRss = (is_numeric($DepartementRss) && $DepartementRss != "") ? "AND departement.num LIKE '" . $DepartementRss . "%'" : ""; //on ne recherche qu'un d걡rtement en particulier contrairement ࡲeqDepartement
		if($Stage==-1){
			$ReqStage = "";
		}elseif($Stage==0){
			$ReqStage = "AND annonce.Id_TypeContrat<6";
		}else{
			$ReqStage = "AND annonce.Id_TypeContrat>=6";
		}
		if ($Suspension == -3) {
			$ReqSuspension = "";
		} elseif ($Suspension == -2) {
			$ReqSuspension = "AND ((annonce.Suspension != 0 AND annonce.Suspension!=-1 AND annonce.Suspension!=-2) OR DateFinPublication < '" . date("Y-m-d") . "')";
		}  elseif ($Suspension == -4) { //on veut afficher celle qui sont en attente de  validation par le recruteur (-4 car -2 et -3 굡it dꫠ pris ...)
			$ReqSuspension = "AND annonce.Suspension='-2' ";
		}else {
			$ReqSuspension = "AND annonce.Suspension =" . $Suspension;
		}
		if ($EnLigne == 1) {
			$ReqDate = "AND DateFinPublication >= '" . date("Y-m-d") . "'";
		} else {
			$ReqDate = "";
		}
		if ($FluxIndeed != -1) {
			$ReqIndeed = "AND annonce.FlagIndeed = 1";
		} else {
			$ReqIndeed = "";
		}
		if ($Limit != 0 || $APartir!=0) {
			$Limit = ($Limit==0)? 500:$Limit; //Si limit n'est pas renseign顯n met un gros nombre pour 
			$ReqLimit = "LIMIT $APartir,$Limit";
		} else {
			$ReqLimit = "";
		}
		if ($Last != 0) {
			$ReqLast = "AND annonce.Id > $Last";
		} else {
			$ReqLast = "";
		}
		if($Gratuit==0){
			$ReqGratuit = "AND annonce.Id_Formule > 1"; //on ne prend que les payants
		}elseif($Gratuit!=-1 && is_numeric($Gratuit)){
			$ReqGratuit = "AND annonce.Id_Formule = $Gratuit"; //on prend un type d'offre en particulier
		}else{
			$ReqGratuit = ""; //on ne tient pas compte de ce parametre
		}
		$ReqContrat = (is_numeric($this->RechContrat) && $this->RechContrat != 0) ? "AND annonce.Id_TypeContrat=" . $this->RechContrat : "";
		$ReqFonction = (is_numeric($this->RechFonction) && $this->RechFonction != 0) ? "AND annoncefonction.Id_Fonction=" . $this->RechFonction : "";
		$ReqReference = ($Reference!="") ? "AND (annonce.ReferenceRecruteur='%" . $Reference."%' OR annonce.Reference='$Reference' OR annonce.ReferencePoleEmploi LIKE '%".strtoupper($Reference)."%')  " : "";
//			$ReqDepartement = (is_numeric($this->RechDepartement) && $this->RechDepartement!=0)? "AND (annonce.Id_Departement=".$this->RechDepartement." OR annonce.Id_Departement=0)":"";
		if (is_numeric($this->RechRegion) && $this->RechRegion != 0) {
			$Bdd = new Bdd();
//				echo $this->RechRegion;
			$Bdd->setRequete("
					SELECT * 
					FROM groupementregiondepartement
					WHERE Id_GroupementRegionDepartement = " . $this->RechRegion
			);
			$ResultRegion = $Bdd->RequeteSelect();
			if ($ResultRegion != "kenini") {
				$explodeDepartement = explode(";", $ResultRegion[0]["NumDepartement"]);
				$i = 0;
				$ReqDepartement = "";
				foreach ($explodeDepartement AS $key => $value) {
					if ($i == 0) {
						$ReqDepartement .= " AND ( departement.num='" . $value . "'";
					} else {
						$ReqDepartement .= " OR departement.num='" . $value . "'";
					}
					$i++;
				}
				$ReqDepartement .= ")";
			} else {
				$ReqDepartement = "annonce.Id_Departement_Id=0"; //Si on ne trouve pas la region alors on affiche que les toutes france. 
			}
		} else {
			$ReqDepartement = "";
		}
		if($Id_Candidat>0){
			$tableCandidature = ", annoncecandidat";
			$whereCandidature = " AND annonce.Id = annoncecandidat.Id_Annonce AND Id_Candidat=$Id_Candidat ";
		}else{
			$tableCandidature = "";
			$whereCandidature = "";
		}
//			echo "-$ReqDepartement-";
		$ReqMotCle = ($this->RechMotCle != "Mots clés" && $this->RechMotCle != "") ? "AND (annonce.TitreAnnonce LIKE '%" . $this->RechMotCle . "%' OR annonce.DescriptifAnnonce LIKE '%" . $this->RechMotCle . "%' OR annonce.ProfilRecherche LIKE '%" . $this->RechMotCle . "%' OR annonce.GrandeVilleProche LIKE '%" . $this->RechMotCle . "%' OR departement.num LIKE '" . $this->RechMotCle . "%' OR departement.dept LIKE '%" . $this->RechMotCle . "%')" : "";
		$ReqSE = ($Id_SiteEmploi!=0)? "AND fonction.Id_SiteEmploi = ".$Id_SiteEmploi:"";
		$Bdd = new Bdd();

		if($Compter==0){
			$RequeteAnnonce = "
				SELECT	annonce.*, horaire.IntituleHoraire,departement.*, recruteur.`Id`, recruteur.`Societe`, recruteur.`Id_CiviliteContactComm`, recruteur.`NomContactComm`,
				recruteur.`PrenomContactComm`, recruteur.`MailComm_login`, recruteur.`Id_CiviliteContactSourcing`, recruteur.`NomContactSourcing`, recruteur.`PrenomContactSourcing`, recruteur.`MailSourcing`,
				recruteur.`Adresse`, recruteur.`Cp`, recruteur.`Ville`, recruteur.`Description`, recruteur.`Site`, recruteur.`Tel`, recruteur.`Fax`, recruteur.`Pwd`, recruteur.`Blacklist`,recruteur.`DateMaj`,
				recruteur.`Logo`, recruteur.`Id_TypeRecruteur`, recruteur.`Newsletter`, recruteur.`FlagEnHaut`, recruteur.DateCreation AS DateCreationRecruteur,typecontrat.IntituleTypeContrat, fonction.IntituleFonction,
				formule.IntituleFormule,UrlSiteEmploi
				FROM annonce,horaire,annoncefonction,siteemploi,fonction,departement,recruteur,typecontrat,formule $tableCandidature
				WHERE annonce.Id_Horaire = horaire.Id_Horaire
				AND fonction.Id_SiteEmploi = siteemploi.Id_SiteEmploi
				AND annonce.Id_Formule = formule.Id_Formule
				AND annonce.Id_Departement_Id = departement.Id
				AND annonce.Id_Recruteur_Id = recruteur.Id
				AND annonce.Id_TypeContrat = typecontrat.Id_TypeContrat
				AND annonce.Id = annoncefonction.Id_Annonce
				AND annoncefonction.Id_Fonction = fonction.Id
				$ReqSE
				$ReqRecruteur
				$ReqDate
				$ReqSuspension
				$ReqContrat
				$ReqFonction
				$ReqDepartement
				$ReqDepartementRss
				$ReqMotCle
				$ReqLast
				$ReqIndeed
				$ReqGratuit
				$ReqReference
				$ReqStage
				$whereCandidature
				GROUP BY annonce.Id
				ORDER BY $tri
				$ReqLimit
			";
		}else{
			$RequeteAnnonce = "
				SELECT	COUNT(annonce.Id)
				FROM annonce,horaire,annoncefonction,fonction,departement,recruteur,typecontrat,formule $tableCandidature
				WHERE annonce.Id_Horaire = horaire.Id_Horaire
				AND annonce.Id_Formule = formule.Id_Formule
				AND annonce.Id_Departement_Id = departement.Id
				AND annonce.Id_Recruteur_Id = recruteur.Id
				AND annonce.Id_TypeContrat = typecontrat.Id_TypeContrat
				AND annonce.Id = annoncefonction.Id_Annonce
				AND annoncefonction.Id_Fonction = fonction.Id
				$ReqSE
				$ReqRecruteur
				$ReqDate
				$ReqSuspension
				$ReqContrat
				$ReqFonction
				$ReqDepartement
				$ReqDepartementRss
				$ReqMotCle
				$ReqLast
				$ReqIndeed
				$ReqGratuit
				$ReqReference
				$ReqStage
				$whereCandidature
				ORDER BY $tri
				$ReqLimit
			";
		}
//		print_tab($RequeteAnnonce);
		$Bdd->setRequete($RequeteAnnonce);
		$Bdd->setHauteurChemin($HauteurChemin);
		return $Bdd->RequeteSelect();
	}
	public function ListeFonctionAnnonce($Id_Annonce){
		$RequeteListeFonction = "
			SELECT fonction.Id, Id_Annonce, IntituleSiteEmploi, Initiales, FlagMetier,siteemploi.Id_SiteEmploi, IntituleFonction
			FROM annoncefonction, fonction, siteemploi
			WHERE annoncefonction.Id_Fonction = fonction.Id
			AND fonction.Id_SiteEmploi = siteemploi.Id_SiteEmploi
			AND annoncefonction.Id_Annonce = $Id_Annonce
			ORDER BY siteemploi.Id_SiteEmploi
		";
		$Bdd = new Bdd();
		$Bdd->setRequete($RequeteListeFonction);
		return $Bdd->RequeteSelect();
	}
	public function setId_Annonce($Value) {
		$this->Id_Annonce = $Value;
	}
	
	public function setId_Fonction($Value) {
		$this->Id_Fonction = $Value;
	}

	public function setId_NiveauSouhaite($Value) {
		$this->Id_NiveauSouhaite = $Value;
	}

	public function setTitreAnnonce($Value) {
		$this->TitreAnnonce = $Value;
	}

	public function setDescriptionAnnonce($Value) {
		$this->DescriptionAnnonce = $Value;
	}

	public function setProfilRecherche($Value) {
		$this->ProfilRecherche = $Value;
	}

	public function setId_TypeContrat($Value) {
		$this->Id_TypeContrat = $Value;
	}

	public function setDureeContrat($Value) {
		$this->DureeContrat = $Value;
	}

	public function setSalaire($Value) {
		$this->Salaire = $Value;
	}

	public function setAvantages($Value) {
		$this->Avantages = $Value;
	}

	public function setId_Departement($Value) {
		$this->Id_Departement = $Value;
	}

	public function setId_Recruteur($Value) {
		$this->Id_Recruteur = $Value;
	}

	public function setHoraire($Value) {
		$this->Horaire = $Value;
	}

	public function setNbHeure($Value) {
		$this->NbHeure = $Value;
	}

	public function setGrandeVille($Value) {
		$this->GrandeVille = $Value;
	}

	public function setId_Candidat($Value) {
		$this->Id_Candidat = $Value;
	}

	public function setMessage($Value) {
		$this->Message = $Value;
	}

	public function setReferenceRecruteur($Value) {
		$this->ReferenceRecruteur = $Value;
	}

//Renseigner les parametres de recherche
	public function setRechFonction($Value) {
		$this->RechFonction = $Value;
	}

	public function setRechContrat($Value) {
		$this->RechContrat = $Value;
	}

	public function setRechDepartement($Value) {
		$this->RechDepartement = $Value;
	}

	public function setRechRegion($Value) {
		$this->RechRegion = $Value;
	}

	public function setRechMotCle($Value) {
		$this->RechMotCle = $Value;
	}
	public function setDescriptionEmployeur($Value) {
		$this->DescriptionEmployeur = $Value;
	}
	public function setDescriptionRecruteurProfil($Value) {
		$this->DescriptionRecruteurProfil = $Value;
	}
	public function setId_Formule($Value) {
		$this->Id_Formule = $Value;
	}
	public function setAdresseReponse($Value) {
		$this->AdresseReponse = $Value;
	}
	public function setFlagIndeed($Value) {
		$this->FlagIndeed= $Value;
	}
	public function setFlagPmeJob($Value) {
		$this->FlagPmeJob = $Value;
	}
	public function setTexteIndeed($Value) {
		$this->TexteIndeed= $Value;
	}
	public function setReferencePoleEmploi($Value) {
		$this->ReferencePoleEmploi= $Value;
	}
	public function getId_Annonce() {
		return $this->Id_Annonce;
	}

	public function getId_NiveauSouhaite() {
		return $this->Id_NiveauSouhaite;
	}
	public function getDescriptionEmployeur() {
		return $this->DescriptionEmployeur;
	}
	public function setDeptLimitrophe($Value) {
		$this->DeptLimitrophe = $Value;
	}
	public function getReferencePoleEmploi() {
		return $this->ReferencePoleEmploi;
	}
}

?>