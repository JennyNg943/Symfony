<?php
header('Content-type: text/html; charset=utf-8'); 
//require_once("../Fonctions/FonctionsVariees.php");
require_once("Bdd.php");
require_once('Recruteurformule.class.php');


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
	private $SeDeux;
	private $FonctionDeux;
	
	//Permet de retourner l'annonce demand�e
	public function CreationAnnonce($Publication = -2,$Webservice = 0) {
		if($Webservice==0){
			$TitreAnnonce = ($this->TitreAnnonce != "Titre poste *") ? htmlentities($this->TitreAnnonce, ENT_QUOTES) : "Titre mal enregistr�";
			$DescriptionAnnonce = ($this->DescriptionAnnonce != "Description annonce * (Si vous �tes un cabinet, d�crivez votre client sans le nommer)") ? htmlentities($this->DescriptionAnnonce, ENT_QUOTES) : "Description � reprendre";
			$ProfilRecherche = ($this->ProfilRecherche != "Profil recherch� *") ? htmlentities($this->ProfilRecherche, ENT_QUOTES) : "";
			$DureeContrat = ($this->DureeContrat != "Dur�e du contrat (sauf CDI)") ? htmlentities($this->DureeContrat, ENT_QUOTES) : "";
			$NbHeure = ($this->NbHeure != "Nb d`heure") ? htmlentities($this->NbHeure, ENT_QUOTES) : "/";
			$Salaire = ($this->Salaire != "Salaire *") ? htmlentities($this->Salaire, ENT_QUOTES) : "";
			$Avantages = ($this->Salaire != "Avantages") ? htmlentities($this->Avantages, ENT_QUOTES) : "";
			$GrandeVille = ($this->GrandeVille != "GrandeVille *") ? htmlentities($this->GrandeVille, ENT_QUOTES) : "";
			$RefRecruteur = ($this->ReferenceRecruteur != "Votre r�f�rence") ? htmlentities($this->ReferenceRecruteur, ENT_QUOTES) : "";
			$DescriptionEmployeur = ($this->DescriptionEmployeur != "Description de l`employeur (D�crivez votre client sans le nommer)" && $this->DescriptionEmployeur != "Description de l`employeur (Vous pouvez d�crire votre soci�t� sans la nommer)" ) ? htmlentities($this->DescriptionEmployeur, ENT_QUOTES) : "";
			$DescriptionRecruteurProfil = htmlentities($this->DescriptionRecruteurProfil, ENT_QUOTES);
			$DeptLimitrophe = htmlentities($this->DeptLimitrophe, ENT_QUOTES);
			$TexteIndeed = htmlentities($this->TexteIndeed , ENT_QUOTES);
			$ReferencePoleEmploi = htmlentities($this->ReferencePoleEmploi, ENT_QUOTES);
		}else{
			$TitreAnnonce = ($this->TitreAnnonce != "Titre poste *") ? htmlentities($this->TitreAnnonce, ENT_QUOTES,"ISO-8859-1") : "Titre mal enregistr�";
			$DescriptionAnnonce = ($this->DescriptionAnnonce != "Description annonce * (Si vous �tes un cabinet, d�crivez votre client sans le nommer)") ? htmlentities($this->DescriptionAnnonce, ENT_QUOTES,"ISO-8859-1") : "Description � reprendre";
			$ProfilRecherche = ($this->ProfilRecherche != "Profil recherch� *") ? htmlentities($this->ProfilRecherche, ENT_QUOTES,"ISO-8859-1") : "";
			$DureeContrat = ($this->DureeContrat != "Dur�e du contrat (sauf CDI)") ? htmlentities($this->DureeContrat, ENT_QUOTES,"ISO-8859-1") : "";
			$NbHeure = ($this->NbHeure != "Nb d`heure") ? htmlentities($this->NbHeure, ENT_QUOTES,"ISO-8859-1") : "/";
			$Salaire = ($this->Salaire != "Salaire *") ? htmlentities($this->Salaire, ENT_QUOTES,"ISO-8859-1") : "";
			$Avantages = ($this->Salaire != "Avantages") ? htmlentities($this->Avantages, ENT_QUOTES,"ISO-8859-1") : "";
			$GrandeVille = ($this->GrandeVille != "GrandeVille *") ? htmlentities($this->GrandeVille, ENT_QUOTES,"ISO-8859-1") : "";
			$RefRecruteur = ($this->ReferenceRecruteur != "Votre r�f�rence") ? htmlentities($this->ReferenceRecruteur, ENT_QUOTES,"ISO-8859-1") : "";
			$DescriptionEmployeur = ($this->DescriptionEmployeur != "Description de l`employeur (D�crivez votre client sans le nommer)" && $this->DescriptionEmployeur != "Description de l`employeur (Vous pouvez d�crire votre soci�t� sans la nommer)" ) ? htmlentities($this->DescriptionEmployeur, ENT_QUOTES,"ISO-8859-1") : "";
			$DescriptionRecruteurProfil = htmlentities($this->DescriptionRecruteurProfil, ENT_QUOTES,"ISO-8859-1");
			$DeptLimitrophe = htmlentities($this->DeptLimitrophe, ENT_QUOTES,"ISO-8859-1");
			$TexteIndeed = htmlentities($this->TexteIndeed , ENT_QUOTES,"ISO-8859-1");
			$ReferencePoleEmploi = htmlentities($this->ReferencePoleEmploi, ENT_QUOTES,"ISO-8859-1");
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
				`Id`, `TitreAnnonce`, `DescriptifAnnonce`, `ProfilRecherche`, `DateDebut`, `Remuneration`, `Id_TypeContrat`, `DureeContrat`, `id_niveau_souhaite_id`, `id_departement_id`, `id_recruteur_id`, `DateCreation`, `DatePublication`, `DateFinPublication`, `Suspension`, `GrandeVilleProche`, `Avantage`, `Id_Horaire`, `NbHeure`, `NbVues`, `DatePublicationRss`, `ReferenceRecruteur`, `Reference`, `DescriptionEmployeur`, `Id_Formule`, `FlagIndeed`, `DescriptionRecruteurProfil`, `AdresseReponse`, `DeptLimitrophe`, `FlagPmeJob`, `TexteIndeed`, `ReferencePoleEmploi'
			) 
			VALUES (
				'$Id_Annonce', '$TitreAnnonce', '$DescriptionAnnonce', '$ProfilRecherche', '" . date("Y-m-d") . "', '$Salaire', '$Id_TypeContrat', '$DureeContrat', '$Id_NiveauSouhaite', '$Id_Departement', 
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
				$Crecruteur->ModificationEtatRecruteur(1); //on le compte comme nouvel inscrit sur le site puisqu'il a valid� son compte
			}
			return true;
		} else {
			return false;
		}
	}


//Cr�er la r�f�rence internee  pour Agro-Recrutement, en partant de la derni�re cr��e
	public function creerIdentifiant() {
		//��� on calcule la nouvelle r�f�rence de tourneurs fraiseurs ���//
		// Nouvel objet base de donn�es
		$Bdd = new Bdd();
		$Bdd->setRequete("SELECT MAX(Id) FROM annonce");
		$ResultMaxId = $Bdd->RequeteSelect();
		//��� on calcule la nouvelle r�f�rence de tourneurs fraiseurs ���//
		$Bdd->setRequete("SELECT Reference FROM annonce WHERE Id=" . $ResultMaxId[0]["MAX(Id)"]);
		$ResultMaxRef = $Bdd->RequeteSelect();
		$TabCaractere = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "Q", "P", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "1", "2", "3", "4", "5", "6", "7", "8", "9", "0"); //liste des caract�res qui vont faire la ref
		$TabCaractereInvers = array_flip($TabCaractere); //on prend l'inverse pour connaitre la ref pr�cedente
		$Precedent = ($ResultMaxRef!="kenini")? $ResultMaxRef[0]["ReferenceTF"]:"AAAA";
		if ($Precedent == "") {
			$C1 = $C2 = $C3 = $C4 = 0; //Chaque Variable correspond a un caractere du code. (Chaque variable va etre incr�menter, + ou - souvent en fonction de sa position)
		} else {
			//Pour savoir ou partir on r�cup�re la valeur actuelle
			$C1 = $TabCaractereInvers[substr($Precedent, 0, 1)];
			$C2 = $TabCaractereInvers[substr($Precedent, 1, 1)];
			$C3 = $TabCaractereInvers[substr($Precedent, 2, 1)];
			$C4 = $TabCaractereInvers[substr($Precedent, 3, 1)];
			if ($C4 == 35) {//Si la variable C6 (derniere dans le code) est superieur a la taille du tableau alors on incr�mente C5 et on r�initialise C6
				$C3++;
				$C4 = 0;
				if ($C3 == 35) {
					$C2++;
					$C3 = 0;
					if ($C2 == 35) {
						$C1++;
						$C2 = 0;
						if ($C1 == 33) { //Si a premiere valeur se rapproche de la fin du tableau alros on envoi un mail au webmaster pour le pr�venir (logiquement le cas ne devrait pas arriver avant 2050 !!!)
							$headers = 'From: "'.NomSite.'"<'.MailContact.'>' . "\n";
							$headers.='Reply-To: '.MailContact.'\n';
							$headers.='Content-Type: text/html; charset="iso-8859-1"' . "\n";
							$headers.='Content-Transfer-Encoding: 8bit';
							$Ecart = diffJour("2012-03-16 15:00:00", date("Y-m-d H:i:s"), "annee", "exacteUnite");
							mail(MailAlex, "SE.com : vers la fin de la num�rotation des annonces. Il va falloir rajouter un caract�re de plus !", "Attention L'identifiant des annonces se rapproche dangeureusement de la fin de la num�rotation ! <br/><br/>Mais f�licitation vous avez rentr� (sauf erreur de calcul) 1 586 304 annonces depuis mars 2012. $Ecart", $headers);
						}
					}
				}
			} else {
				$C4++; //on reprend une valeur apr�s le dernier et si 
			}
		}
		$RefTF = ""; //on declare la reference
		$f = 1; //compteur pour savoir combien de caract�re on va mettre dans l'identifiant.
		while ($f <= 4) { //On char
			$cNiveau = "C$f"; //La valeur que l'on va ajouter
			$RefTF .= $TabCaractere[$$cNiveau];
			$f++;
		}
		return $RefTF;
//��� FIN DE LA CREATION DE LA REFERENCE ���//
	}

//Permet de retourner l'annonce demand�e
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
			SELECT	annonce.*, typecontrat.IntituleTypeContrat, fonction.IntituleFonction, 
			departement.dept,departement.num, recruteur.Societe, recruteur.Adresse, recruteur.Ville, recruteur.Cp ,PrenomContactComm,NomContactComm,
			recruteur.Tel, recruteur.MailSourcing,recruteur.Description, horaire.IntituleHoraire,recruteur.Description AS DescriptionRecruteur, recruteur.Logo, MailComm_login,
			recruteur.MailComm_login, recruteur.PrenomContactComm, recruteur.NomContactComm, fonction.Id
			FROM	annonce, horaire,typecontrat, fonction,annoncefonction, departement,recruteur, niveausouhaite
			WHERE	annonce.Id = $Id_Annonce
			AND niveausouhaite.Id = annonce.Id_Niveau_Souhaite_Id
			AND annonce.Id = annoncefonction.Id_Annonce
			AND fonction.Id = annoncefonction.Id_Fonction
			$ReqRecruteur
			$ReqEnLigne
			AND		annonce.Id_TypeContrat = typecontrat.Id_TypeContrat
			AND		annonce.Id_Departement_Id = departement.Id
			AND		annonce.Id_Recruteur_Id = recruteur.Id
			AND		annonce.Id_Horaire = horaire.Id_Horaire


		";
//		print_tab($RequeteAnnonce);
		$Bdd = new Bdd();
		$Bdd->setRequete($RequeteAnnonce);
		$ResultAnnonce = $Bdd->RequeteSelect();
		if($ResultAnnonce!="kenini"){
			return $ResultAnnonce[0];
		}else{
			return "kenini";
		}
	}

//��� Fonction pour lire et enregistrer les annonces d'un flux RSS.
// Lit la table fluxxml, teste et enregistre les annonces.
// IL RESTE ENCORE A FAIRE LES CHOSES SUIVANTES : 
// - Tester encodage du document pour eviter les erreurs. (pour l'instant le Flux doit etre dans le format XML et encod� en iso-8855-1)
// - Tester si tous les champs obligatoires sont renseign�s.
//Tant que l'automatisme d'execution d'un script ne fonctionne pas cette fonctoin sera appeler par la page d'accueil du site pour etre tout le temps a jour ! 
//Pour les tests la fonction est appel�e dans le fichier Admini/test.php
	public function lectureFluxXML() {
		$RequeteAllFlux = "
			SELECT recruteur.Id, LienXML ,recruteurformule.*, recruteur.Societe
			FROM fluxxml,recruteur ,recruteurformule
			WHERE recruteur.Id = fluxxml.Id_Recruteur 
			AND recruteur.Id_RecruteurFormule = recruteurformule.Id_RecruteurFormule
		";
		$Bdd = new Bdd();
		$Bdd->setRequete($RequeteAllFlux);
		$ResultAllFlux = $Bdd->RequeteSelect();
		
		if($ResultAllFlux!="kenini"){
			for ($a = 0; $a < sizeof($ResultAllFlux); $a++) {
				$annonceFlux = simplexml_load_file($ResultAllFlux[$a]["LienXML"]);

				for ($i = 0; $i < sizeof($annonceFlux->jobs->job); $i++) {
					$RequeteDoublon = "
						SELECT * FROM annonce WHERE Id_Recruteur_Id='" . $ResultAllFlux[$a]["Id"] . "' 
						AND ReferenceRecruteur='" . str_replace("'","''",utf8_decode($annonceFlux->jobs->job[$i]->reference)) . "'
					";
					$Bdd->setRequete($RequeteDoublon);
					$ResultDoublon = $Bdd->RequeteSelect();

					if ($ResultDoublon == "kenini") { //Si ce n'est on ne connait pas la r�f�rence alors on rentre l'annonce
						//on cherche la correspondance du contrat. 
						if (preg_match("/cdi/", strtolower($annonceFlux->jobs->job[$i]->contrat))) { //Transformer en numerique
							$contrat = 4;
						} else {
							$contrat = 5;
						}

						//on cherche le departement correspondant �a ce que le flux nous fourni
						$Val_Departement = ($annonceFlux->jobs->job[$i]->departement) ? intval(substr($annonceFlux->jobs->job[$i]->departement, 0, 2)) : "0"; //on caste en int. Si c'est du texte alors il sera �gal � 0.
						$Bdd->setRequete("SELECT Id as Id_Departement FROM departement WHERE num LIKE '$Val_Departement'");
						$ResultDepartement = $Bdd->RequeteSelect();
						$Id_Dep = ($ResultDepartement != "kenini") ? $ResultDepartement[0]["Id_Departement"] : 0;
						//on trouve le num�ro du niveau
						$niveau = utf8_decode($annonceFlux->jobs->job[$i]->niveau);
						if(strtolower($niveau)=="aucune connaissance")
							$Id_Niveau = 1;
						elseif(strtolower($niveau)=="d�butant" || strtolower($niveau)=="debutant")
							$Id_Niveau = 2;
						elseif(strtolower($niveau)=="confirm�" || strtolower($niveau)=="confirme")
							$Id_Niveau = 3;
						elseif(strtolower($niveau)=="expert")
							$Id_Niveau = 4;
						else
							$Id_Niveau = 1;

						//on trouve le num�ro de la fonction
						$fonction = utf8_decode($annonceFlux->jobs->job[$i]->fonction);
						//on trouve le num�ro de la fonction
						
						if(strtolower($fonction)=="Agro")
							$Id_Fonction = 1;
						else
							$Id_Fonction = 2;

						//premium
						$premium = $annonceFlux->jobs->job[$i]->premium;
						if($premium=="non"){ //Si la soci�t� ne demande pas le premium alors lui passe en premium sans rien de particulier
							$Id_Formule=1;
						}else{
							if($ResultAllFlux[$a]["NbAnnonceDispoVisibilite"]>0){
								$recruteurPremium=true;
								$Id_Formule=2;
							}elseif($ResultAllFlux[$a]["NbAnnonceDispoPerformance"]>0){
								$recruteurPremium=true;
								$Id_Formule=3;
							}elseif($ResultAllFlux[$a]["NbAnnonceDispoReussite"]>0){
								$recruteurPremium=true;
								$Id_Formule=4;
							}else{
								$recruteurPremium=false;
								$Id_Formule=1;
							}
							if($recruteurPremium==false){ //Si le recruteur a demand� du premium mais que son compte ne le permet pas, alors on lui envoi un mail pour le pr�venir
								$MsgPremium = "
									Vous avez demand� � passer votre annonce en premium, malheureusement vous n'avez pas de cr�dit premium. 
									Elle sera donc diffus�e selon notre formule gratuite. 
									<br/>
									<br/>
									Si vous souhaitez connaitre le d�tail de nos formules et souscrire � l'une d'elle, nous vous invitons � visiter notre site, ou � nous contacter directement au ".TelephoneSite." ou par mail � l'adresse ".MailContact.".
								";
							}else{
								$MsgPremium = "";
							}
						}

						//on commence a renseigner les valeurs de la table
						$this->TitreAnnonce=($annonceFlux->jobs->job[$i]->titre);
						$this->DescriptionAnnonce=($annonceFlux->jobs->job[$i]->description);
						$this->ProfilRecherche=($annonceFlux->jobs->job[$i]->profil);
						$this->AdresseReponse=($annonceFlux->jobs->job[$i]->reponse);
						$this->DescriptionEmployeur=($annonceFlux->jobs->job[$i]->recruteur);
						$this->Salaire=($annonceFlux->jobs->job[$i]->salaire);
						$this->Avantages=($annonceFlux->jobs->job[$i]->avantages);
						$this->Id_TypeContrat=$contrat;
						$this->Id_NiveauSouhaite=$Id_Niveau;
						$this->Id_Fonction=$Id_Fonction;
						$this->Id_Formule=$Id_Formule;
						$this->DureeContrat="";
						$this->Id_Departement=$Id_Dep;
						$this->Id_Recruteur=$ResultAllFlux[$a]["Id_Recruteur"];
						$this->Horaire="";
						$this->NbHeure=($annonceFlux->jobs->job[$i]->nbheure);
						$this->GrandeVille=($annonceFlux->jobs->job[$i]->ville);
						$this->ReferenceRecruteur = ($annonceFlux->jobs->job[$i]->reference);
						
						//on exectute la requete et on test le retoru
						
						if (!$this->CreationAnnonce(-1)) {//l'admin doit valider l'annonce
							$headers ='From: "'.NomSite.'"<'.MailAlex.'>'."\n";
							$headers .='Reply-To: '.MailAlex."\n";
							$headers .='Content-Type: text/html; charset="iso-8859-1"'."\n";
							$headers .='Content-Transfer-Encoding: 8bit';
							$MailErreur = "
								Erreur lecture auto Flux XML, ajout annonce. Ref de l'annonce : ".$annonceFlux->jobs->job[$i]->reference."<br/><br/>
								Id Recruteur : ".$ResultAllFlux[$a]["Id"]."
							";
							@mail ( MailAlex , "[".Initiales." - erreur lecture flux RSS]" , $MailErreur, $headers);
							$Erreur[$a]=1;
						}else{
							$Erreur[$a]=0;
						}
					}else{
						$Erreur[$a]=2;
					}
				}
			}
		}else{
			$Erreur[-1]=3;
		}
		return $Erreur;
	}
	
//����Cette fonction permettra de de connaitre quel candidat correspond � une annonce en remplissant la table
//���� NE renvoi rien
//���Par defaut on ne lie que les annonces payantes, 
public function LierAnnonceCandidat($FormulePayante=1) {
		//On recherche les annonces en cours sur le $FormulePayante
		if($FormulePayante>0){
			$ReqFormulePayante = "AND Id_Formule > 1";
		}elseif($FormulePayante==0){
			$ReqFormulePayante = "AND Id_Formule=0";
		}else{
			$ReqFormulePayante = "";
		}
		//on liste les annonce en ligne gratuites ou non en fonction de la demande
		$RequeteListeAnnonce = "
			SELECT annonce.Id, ProfilRecherche,Id_TypeContrat,fonction.Id,num,DeptLimitrophe
			FROM annonce, departement,fonction, annoncefonction
			WHERE Suspension = 0
			AND annoncefonction.Id_Annonce = annonce.Id
			AND annoncefonction.Id_Fonction = fonction.Id
			AND siteemploi.id = ".Id_SiteEmploi."
			$ReqFormulePayante
			AND annonce.Id_Departement_Id = departement.Id
			AND DateFinPublication >= '" . date("Y-m-d") . "'
		";
		$Bdd = new Bdd();
		$Bdd->setRequete($RequeteListeAnnonce);
		$ResultListeAnnonce = $Bdd->RequeteSelect();
		if ($ResultListeAnnonce != "kenini") {
			//on g�nère un tableau de cnadidat interdit pour la requete finale (ceux ayant d�jà reçu l'information)
			$RequeteListeCoupleEnCours = "
				SELECT Id_Candidat, annonce.Id, FlagEnvoi
				FROM annoncecandidatmailing, annonce
				WHERE Suspension = 0
				$ReqFormulePayante
				AND DateFinPublication >= '" . date("Y-m-d") . "'
				AND annoncecandidatmailing.Id_Annonce = annonce.Id_Annonce
				ORDER BY annonce.Id_Annonce
			";
			$Bdd->setRequete($RequeteListeCoupleEnCours);
			$ResultListeCoupleEnCours = $Bdd->RequeteSelect();
			if($ResultListeCoupleEnCours!="kenini"){
				$Id_AnnoncePrecedent = -1;
				for($i=0;$i<sizeof($ResultListeCoupleEnCours);$i++){
					$data = $ResultListeCoupleEnCours[$i];
					if($Id_AnnoncePrecedent!=$data["Id_Annonce"]){
						$m=0;
					}
					$ListeCouple[$data["Id_Annonce"]][$m] = $data["Id_Candidat"];
					$Id_AnnoncePrecedent=$data["Id_Annonce"]; //l'annonce actuelle passe sur le tableau precedent
					$m++;
				}
			}
			unset($data);
			unset($Id_AnnoncePrecedent);
			//on continue le tableau en ajoutant les candidats ayant d�jà postul� ! 
			$RequeteCandidatNonPostules = "
				SELECT Id_AnnonceCandidat, annonce.Id as Id_Annonce, Id_Candidat
				FROM annoncecandidat, annonce
				WHERE Suspension = 0
				$ReqFormulePayante
				AND DateFinPublication >= '" . date("Y-m-d") . "'
				AND Type = 1
				AND annonce.Id = annoncecandidat.Id_Annonce
				ORDER BY Id_Annonce
			";
			$Bdd->setRequete($RequeteCandidatNonPostules);
			$ResultCandidatNonPostules = $Bdd->RequeteSelect();
			
//			Faire un for qui complete $ListeCouple 
			if($ResultCandidatNonPostules){
				$Id_AnnoncePrecedent = 0;
				for($i=0;$i<sizeof($ResultCandidatNonPostules);$i++){
					$data = $ResultCandidatNonPostules[$i];
					if($Id_AnnoncePrecedent!=$data["Id_Annonce"]){
						if(isset($ListeCouple[$data["Id_Annonce"]])){ //si l'annonce est d�jà dans le tableau
							$m=sizeof($ListeCouple[$data["Id_Annonce"]])+1; //alors on compte le nombre d'element et on rajoute 1 
						}else{
							$m=0;
						}
					}
					$ListeCouple[$data["Id_Annonce"]][$m] = $data["Id_Candidat"];
					$Id_AnnoncePrecedent=$data["Id_Annonce"]; //l'annonce actuelle passe sur le tableau precedent
				}
			}
			unset($data);
			unset($Id_AnnoncePrecedent);
			//on commence la recherche de candidat
			for($i=0;$i<sizeof($ResultListeAnnonce);$i++){
				$data = $ResultListeAnnonce[$i];
				if(isset($ListeCouple[$data["Id_Annonce"]])){
					$ReqCandExclu = "";
					foreach($ListeCouple[$data["Id_Annonce"]] AS $key=>$value){
							$ReqCandExclu .= " AND candidat.Id_Candidat!=$value";
					}
//					$ReqCandExclu .= ")";
				}else{
					$ReqCandExclu = "";
				}
				$Departement = (strlen($data["num"])==2)? $data["num"]:"0".$data["num"]; //si le code postal est entre 1 et 9 alors on rajoute un 0 pour ne pas poser de problème
				if($data["DeptLimitrophe"]!=""){
					$DeptLimitrophe = explode(";",$data["DeptLimitrophe"]);
					$ReqComplementaireDepartement = "";
					foreach($DeptLimitrophe AS $idUseLess => $Dept){
						if(is_numeric($Dept)){
							$Dept = (strlen($Dept)==2)? $Dept:"0".$Dept;
							$ReqComplementaireDepartement .= " OR CpCandidat LIKE '$Dept%' ";
						}
					}
				}else{
					$ReqComplementaireDepartement = "";
				}
				$ReqFonction = "AND Id_Fonction = '".$data["Id_Fonction"]."'";
				
				if($Departement!="In") //si on est a l'international alors on contact toute la bdd (en tenant quand meme compte de la fontion)
					$ReqDepartementVivier = "AND (CpCandidat LIKE '$Departement%' $ReqComplementaireDepartement)"; //Soit le d�partement pr�cis soit toute france
				else
					$ReqDepartementVivier = ""; //Soit le d�partement pr�cis soit toute france
				//on cherche en fonction du code postal, de la fonction
				$RequeteListeCandidat = "
					SELECT candidat.Id_Candidat, CpCandidat
					FROM candidat, candidatfonction
					WHERE candidat.Id_Candidat = candidatfonction.Id_Candidat
					AND (
						candidat.Newsletter = 1 
						OR (
							candidat.Newsletter = 0 
							AND (candidat.DateNewsletter < CURDATE())
						)
					)
					AND candidat.FlagStatut != 0
					$ReqDepartementVivier
					$ReqFonction
					$ReqCandExclu
				";
				$Bdd->setRequete($RequeteListeCandidat);
				$ResultListeCandidat = $Bdd->RequeteSelect();

				if($ResultListeCandidat!="kenini"){
					for($toto=0;$toto<sizeof($ResultListeCandidat);$toto++){
						if($ResultListeCandidat[$toto]["CpCandidat"]=="00000"){
							$ReqEtatGeographique = -1; //on ne mettra pas de message particulier dans le mail
						}elseif($Departement=="In"){
							$ReqEtatGeographique = 2; //on dira au candidat : "H� mec regarde c'est dans ton d�partement !"
						}elseif(substr($ResultListeCandidat[$toto]["CpCandidat"],0,2)==$Departement){
							$ReqEtatGeographique = 0; //on dira au candidat : "H� mec regarde c'est dans ton d�partement !"
						}else{
							$ReqEtatGeographique = 1; //on dira au candidat : "Bouge tes fesses jusqu'au d�partement voisin !"
						}
						$RequeteInsert = "
							INSERT INTO annoncecandidatmailing
							VALUE(NULL,'" . $data["Id_Annonce"] . "','" . $ResultListeCandidat[$toto]["Id_Candidat"] . "','0','0000-00-00',$ReqEtatGeographique)
						";
						$Bdd->setRequete($RequeteInsert);
						$Bdd->RequeteUpDel();
					}
				}
			}
			//on indique le nombre d'annonce dans la boucle
			$Retour["NbAnnonce"]=sizeof($ResultListeAnnonce);
			return $Retour;
		} else {
			$Retour["NbAnnonce"]=0;
			return $Retour;
		}
	}
	
	
	// on cherche le nombre de profils totals sur la bdd
	public function CvTechNbProfilTotal (){
		$RequeteAnnonce = "
			SELECT COUNT(Id_CandidatFonction)
			FROM candidatfonction
		";
		$Bdd = new Bdd();
		$Bdd->setRequete($RequeteAnnonce);
		$ResultAnnonce = $Bdd->RequeteSelect();
		if($ResultAnnonce!="kenini") return $ResultAnnonce[0]["COUNT(Id_CandidatFonction)"];
		else return 0;
	}
	//pour une annonce, on va chercher le nombre de profil touch� sur notre site.
	
	public function CvTechNbProfil ($Id_Fonction=0, $Id_Departement=0, $MotCle="", $DepartementLimitrophe=""){
		$Id_Annonce = ($this->Id_Annonce!="" && is_numeric($this->Id_Annonce))? $this->Id_Annonce:0;
		
		if($Id_Annonce!=0){
			$RequeteAnnonce = "
				SELECT Id_Annonce, ProfilRecherche,Id_TypeContrat,Id_Fonction,num
				FROM annonce, departement
				WHERE Id_Annonce = $Id_Annonce
				AND annonce.Id_Departement = departement.Id_Departement
			";
			$Bdd = new Bdd();
			$Bdd->setRequete($RequeteAnnonce);
			$ResultAnnonce = $Bdd->RequeteSelect();

			if ($ResultAnnonce != "kenini") {
				$Fonction = $ResultAnnonce[0]["Id_Fonction"];
				$Contrat = $ResultAnnonce[0]["Id_TypeContrat"];
				$Departement = (strlen($ResultAnnonce[0]["num"])==2)? $ResultAnnonce[0]["num"]:"0".$ResultAnnonce[0]["num"]; //si le code postal est entre 1 et 9 alors on rajoute un 0 pour ne pas poser de probl�me
				$ReqFonction = "AND fonction.Id_Fonction = '$Fonction'";
				
				if ($Contrat == 5) {
					$ReqContrat = "AND (Id_TypeContrat = '$Contrat' OR Id_TypeContrat='4')"; // si c'est un CDD on recherche aussi le CDD (quelqu'un a la recherche pourrait surement prendre un poste meme pour 6mois !)
				} else {
					$ReqContrat = "AND Id_TypeContrat = '$Contrat'";
				}
				if($MotCle!=""){
					$ChampsMotCle = ", TextCv, DateIndexation";
					$TableMotCle = ", cvtheque";
					$WhereMotCle = " AND candidat.Id_Candidat = cvtheque.Id_Candidat AND cvtheque.TextCv LIKE '%$MotCle%'";
					$ReqFonction = "";
				}else{
					$ChampsMotCle = "";
					$TableMotCle = "";
					$WhereMotCle = "";
				}
				//$ReqDepartement = "AND (Id_Departement = '$Departement' OR Id_Departement='0')"; //Soit le d�partement pr�cis soit toute france
				$ReqDepartementVivier = "AND (CpCandidat LIKE '$Departement%' OR CpCandidat='00000')"; //Soit le d�partement pr�cis soit toute france
				$RequeteListeCandidat = "
					SELECT NomCandidat, PrenomCandidat,CpCandidat,IntituleFonction, CvCandidat,DateCreation,candidat.Id_Candidat, DateMaj $ChampsMotCle
					FROM candidat, candidatfonction, fonction $TableMotCle
					WHERE candidat.Id_Candidat = candidatfonction.Id_Candidat
					AND fonction.Id_Fonction = candidatfonction.Id_Fonction
					$WhereMotCle
					$ReqDepartementVivier
					$ReqFonction
					ORDER BY RAND()
				";

				$Bdd->setRequete($RequeteListeCandidat);
				$ResultListeCandidat = $Bdd->RequeteSelect();
				$ResultListeCandidat["NbCandidat"] = ($ResultListeCandidat!="kenini")? sizeof($ResultListeCandidat):0;
				return $ResultListeCandidat;
			}
		}else{ //si l'on a renseign� les parametres alors on peut retourner le nombre
			if($MotCle!="" || ($Id_Departement!=-1 && $Id_Departement!=0)){
				$Fonction = $Id_Fonction;
				$Contrat = 0;
				
				if($Fonction == 6){ //si on cherche un tourneur-fraiseur, alors on cherche un Agro-Recrutement, ou un tourneur ET fraiseur
					$ReqFonction = "AND (fonction.Id_Fonction='6'  OR (fonction.Id_Fonction = '4' AND fonction.Id_Fonction='5'))";
				}elseif($Fonction == 4){ //on cherche un fraiseur ou un Agro-Recrutement
					$ReqFonction = "AND (fonction.Id_Fonction='6'  OR fonction.Id_Fonction = '4')";
				}elseif($Fonction == 5){ //on cherche un tourneur ou un Agro-Recrutement
					$ReqFonction = "AND (fonction.Id_Fonction='6'  OR fonction.Id_Fonction = '5')";
				}else{ //pour le reste on cherche la bonne fonction
					$ReqFonction = "AND fonction.Id_Fonction = '$Fonction'";
				}
				if ($Contrat == 5) {
					$ReqContrat = "AND (Id_TypeContrat = '$Contrat' OR Id_TypeContrat='4')"; // si c'est un CDD on recherche aussi le CDD (quelqu'un a la recherche pourrait surement prendre un poste meme pour 6mois !)
				} else {
					$ReqContrat = "AND Id_TypeContrat = '$Contrat'";
				}
				if($MotCle!=""){
					$ChampsMotCle = ", TextCv, DateIndexation";
					$TableMotCle = ", cvtheque";
					$ExplodeMotCleCv = explode("+",$MotCle);
					if(count($ExplodeMotCleCv)>1){
						$WhereMotCle = "AND candidat.Id_Candidat = cvtheque.Id_Candidat AND ";
						$compteurCvUnique = 0;
						foreach($ExplodeMotCleCv AS $key=>$value){
							if($compteurCvUnique==0)
								$WhereMotCle.=" cvtheque.TextCv LIKE '%".str_replace("'","''",trim($value))."%'";
							else
								$WhereMotCle.=" AND cvtheque.TextCv LIKE '%".str_replace("'","''",trim($value))."%'";
							$compteurCvUnique++;
						}
					}else{
						$WhereMotCle = " AND candidat.Id_Candidat = cvtheque.Id_Candidat AND cvtheque.TextCv LIKE '%".str_replace("'","''",trim($MotCle))."%'";
					}
					//$WhereMotCle = " AND candidat.Id_Candidat = cvtheque.Id_Candidat AND cvtheque.TextCv LIKE '%$MotCle%'";
					$ReqFonction = "";
				}else{
					$ChampsMotCle = "";
					$TableMotCle = "";
					$WhereMotCle = "";
				}
				//$ReqDepartement = "AND (Id_Departement = '$Departement' OR Id_Departement='0')"; //Soit le d�partement pr�cis soit toute france
				$ReqDptLimitrophe="";
				if($DepartementLimitrophe!=""){
					$ListeDepartement = explode(";",$DepartementLimitrophe);
					foreach ($ListeDepartement AS $key=>$value){
						$ReqDptLimitrophe .= " OR CpCandidat LIKE '$value%'";
					}
				}
				if($Id_Departement!=-1 && $Id_Departement!=0){
					$ReqDepartementVivier = (strlen($Id_Departement)==2)? "AND (CpCandidat LIKE '$Id_Departement%' $ReqDptLimitrophe)":"AND (CpCandidat LIKE '0$Id_Departement%' $ReqDptLimitrophe)"; //si le code postal est entre 1 et 9 alors on rajoute un 0 pour ne pas poser de probl�me
				}else{
					$ReqDepartementVivier = "";
				}
				
				$RequeteListeCandidat = "
					SELECT NomCandidat, PrenomCandidat,CpCandidat, CvCandidat,DateCreation,candidat.Id_Candidat, DateMaj $ChampsMotCle
					FROM candidat $TableMotCle
					WHERE 1
					$WhereMotCle
					$ReqDepartementVivier
					ORDER BY RAND()
				";
			}else{
				$RequeteListeCandidat = "
					SELECT NomCandidat, PrenomCandidat,CpCandidat,IntituleFonction, CvCandidat,DateCreation,candidat.Id_Candidat, DateMaj , TextCv, DateIndexation
					FROM candidat, candidatfonction, fonction , cvtheque
					WHERE candidat.Id_Candidat = candidatfonction.Id_Candidat
					AND fonction.Id_Fonction = candidatfonction.Id_Fonction
					AND candidat.Id_Candidat = cvtheque.Id_Candidat
					AND TextCv!=''
					ORDER BY RAND()
					LIMIT 0, 20
				";
			}
			$Bdd = new Bdd();
//			print_tab($RequeteListeCandidat);
			$Bdd->setRequete($RequeteListeCandidat);
			$ResultListeCandidat = $Bdd->RequeteSelect();
			if($ResultListeCandidat!="kenini"){
				$ResultListeCandidat["NbCandidat"] = sizeof($ResultListeCandidat);
				return $ResultListeCandidat;
			}else{
				return "kenini";
			}
		}
	}
//Mettre � jour le fichier rss
//On r�cup�re l'entete (en modifiant date Maj) et le pied de page et on r��crit le reste. 
//retourne si 1 si pas d'erreur sinon le num�ro de l'erruer (nombre n�gatif)
// On met a jour les fichiers suivants : 
//		Agro-RecrutementAgro-Recrutement.com.xml (rss principal qui alimente facebook viadeo twitter)
//		Agro-Recrutement.indeed.com.xml (xml qui alimente le flux indeed)
	public function MajRss($HauteurChemin = "", $Id_AncienRecrut = 0) {
		$this->lectureFluxXML(); //on commence par lire les flux XML pour ajouter les annonces qui ne seraient pas encore en ligne !
		$noerreur = 1;
		
		//on ecrit pour mettre a jour le RSS a jour
		if ($ouvre = fopen($HauteurChemin . "rss/".NomFichierRss, "r+")) { // ouverture en lecture et �criture sans vider le fichier ( r+)
			if ($contenuFichier = fread($ouvre, filesize($HauteurChemin . "rss/".NomFichierRss))) { //on r�cup�re l'ensemble du texte
				fclose($ouvre); //on ferme le fichier pendant que l'on travaille dessus	
				$explodeItem = explode("<item>", $contenuFichier);
				$enTeteFichier = $explodeItem[0]; //on r�cup�re l'en t�te du fichier
				$explodeDateMaj = explode("<lastBuildDate>", $enTeteFichier); //on supprime l'ancienne heure de Maj en s�parant le d�but du fichier de la balise lastBuildDate
				unset($explodeDateMaj[1]);
				$DateMaj = date(DATE_RFC822);
				$enTeteFichier = $explodeDateMaj[0] . "<lastBuildDate>$DateMaj</lastBuildDate>\n";
				$DernierElement = $explodeItem[sizeof($explodeItem) - 1]; // on r�cup�re le dernier item plus la fin du fichier
				$explodeFinItem = explode("</item>", $DernierElement);
				unset($DernierElement);
				$piedPageFichier = $explodeFinItem[1];
				$this->setId_Recruteur(0); //Il faut que l'on mettent a jour les annonces de tous le monde donc juste pour la requete suivante il faut faire sauter l'id recruteur
				$ResultAnnonce = $this->RechercheAnnonce();

				$this->setId_Recruteur($Id_AncienRecrut); //on remet l'id recruteur pour ne pas causer d'erreur sur la suite du script

				$Item = "";
				$minute = 1;
				for ($i = 0; $i < sizeof($ResultAnnonce); $i++) {

					$Item .="<item>\n";
					//$Item .="<id>".trim($ResultAnnonce[$i]["Id_Annonce"])."</id>\n";
					$Item .="<title>" . str_replace("&",".",str_replace("&#039;","'",trim(html_entity_decode(str_replace("<", "", str_replace(">", "", str_replace("\\", "", $ResultAnnonce[$i]["TitreAnnonce"]))))))) . " - " . $ResultAnnonce[$i]["Reference"] . "</title>\n";
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
					$Item .="<link>".UrlSite."offre.php?Id_Annonce=" . $ResultAnnonce[$i]["Id_Annonce"] . "</link>\n";
					$Item .="</item>\n";
				}
				//echo $enTeteFichier.$Item.$piedPageFichier;
				if ($ouvre = fopen($HauteurChemin . "rss/".NomFichierRss, "w+")) { //on rouvre le fichier en le vidant pour remettre � jour son contenu
					if (!fwrite($ouvre, $enTeteFichier . $Item . $piedPageFichier)) { // �criture fichier
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

	//Permet de modifier l'anonnce demand�e
	public function ModificationAnnonce($HauteurChemin = "", $Admin = 0) {
		$Id_Annonce = (is_numeric($this->Id_Annonce)) ? $this->Id_Annonce : 0;
		$Id_Fonction = (is_numeric($this->Id_Fonction)) ? $this->Id_Fonction : 4;
		$Id_NiveauSouhaite = (is_numeric($this->Id_NiveauSouhaite)) ? $this->Id_NiveauSouhaite : 4;
		if ($Admin == 1) {
			$TitreAnnonce = ($this->TitreAnnonce != "Titre poste *" && $this->TitreAnnonce != "") ? str_replace("'","''",$this->TitreAnnonce) : "";
			$ReqTitreAnnonce = ($TitreAnnonce != "") ? "`TitreAnnonce`='$TitreAnnonce'," : "";
		
		} else {
			$ResultAncienAnnonce = $this->AffichageAnnonce();
			if (intval($ResultAncienAnnonce["Suspension"]) < 0) { //Si jamais l'annonce n'est pas encore valid�e alors on tol�re que le titre soit modifier
				$TitreAnnonce = ($this->TitreAnnonce != "Titre poste *" && $this->TitreAnnonce != "") ? str_replace("'","''",$this->TitreAnnonce) : "";
				$ReqTitreAnnonce = ($TitreAnnonce != "") ? "`TitreAnnonce`='$TitreAnnonce'," : "";
			} else {
				$ReqTitreAnnonce = "";
			}
		}
		$DescriptionAnnonce = ($this->DescriptionAnnonce != "Description annonce * (Si vous �tes un cabinet, d�crivez votre client sans le nommer)") ? str_replace("'","''",$this->DescriptionAnnonce) : "Description � reprendre";
		$ProfilRecherche = ($this->ProfilRecherche != "Profil recherch� *") ? str_replace("'","''",$this->ProfilRecherche) : "";
		$Id_TypeContrat = (is_numeric($this->Id_TypeContrat)) ? $this->Id_TypeContrat : 4;
		$DureeContrat = ($this->DureeContrat != "Dur�e du contrat (sauf CDI)") ? str_replace("'","''",$this->DureeContrat) : "";
		$Horaire = (is_numeric($this->Horaire)) ? $this->Horaire : 1;
		$NbHeure = ($this->NbHeure != "Nb d`heure") ? str_replace("'","''",$this->NbHeure) : "/";
		$Salaire = ($this->Salaire != "Salaire *") ? str_replace("'","''",$this->Salaire) : "";
		$Avantages = ($this->Salaire != "Avantages") ? str_replace("'","''",$this->Avantages) : "";
		$Id_Departement = (is_numeric($this->Id_Departement)) ? $this->Id_Departement : 0;
		$GrandeVille = ($this->GrandeVille != "GrandeVille *") ? str_replace("'","''",$this->GrandeVille) : "";
		$Id_Recruteur = (is_numeric($this->Id_Recruteur)) ? $this->Id_Recruteur : 0;
		$RefRecruteur = ($this->ReferenceRecruteur != "Votre r�f�rence") ? str_replace("'","''",$this->ReferenceRecruteur) : "";
		$DescriptionEmployeur = ($this->DescriptionEmployeur != "Description de l`employeur (D�crivez votre client sans le nommer)" && $this->DescriptionEmployeur != "Description de l`employeur (Vous pouvez d�crire votre soci�t� sans la nommer)" ) ? str_replace("'","''",$this->DescriptionEmployeur) : "";
		$DescriptionRecruteurProfil = str_replace("'","''",$this->DescriptionRecruteurProfil);
		$DeptLimitrophe = str_replace("'","''",$this->DeptLimitrophe);
		$AdresseReponse = ($this->AdresseReponse != "" && VerifierAdresseMail($this->AdresseReponse)) ? $this->AdresseReponse : "";
		$Bdd = new Bdd();

		$Bdd->setRequete("
					UPDATE `annonce` 
					SET 
					$ReqTitreAnnonce `DescriptifAnnonce`='$DescriptionAnnonce', `ProfilRecherche`='$ProfilRecherche', `Remuneration`='$Salaire', `Id_TypeContrat`='$Id_TypeContrat', 
					`DureeContrat`='$DureeContrat', `Id_NiveauSouhaite`='$Id_NiveauSouhaite', `Id_Departement`='$Id_Departement', `Id_Recruteur`= '$Id_Recruteur',`GrandeVilleProche`='$GrandeVille', 
					`Avantage`='$Avantages', `Id_Horaire`='$Horaire', `NbHeure`='$NbHeure', `ReferenceRecruteur`='$RefRecruteur', `DescriptionEmployeur`='$DescriptionEmployeur', 
					DescriptionRecruteurProfil='$DescriptionRecruteurProfil',DeptLimitrophe='$DeptLimitrophe', AdresseReponse = '$AdresseReponse'
					WHERE Id_Annonce='$Id_Annonce'
					");
		print_tab("UPDATE `annonce` 
					SET 
					$ReqTitreAnnonce `DescriptifAnnonce`='$DescriptionAnnonce', `ProfilRecherche`='$ProfilRecherche', `Remuneration`='$Salaire', `Id_TypeContrat`='$Id_TypeContrat', 
					`DureeContrat`='$DureeContrat', `Id_NiveauSouhaite`='$Id_NiveauSouhaite', `Id_Departement`='$Id_Departement', `Id_Recruteur`= '$Id_Recruteur',`GrandeVilleProche`='$GrandeVille', 
					`Avantage`='$Avantages', `Id_Horaire`='$Horaire', `NbHeure`='$NbHeure', `ReferenceRecruteur`='$RefRecruteur', `DescriptionEmployeur`='$DescriptionEmployeur', 
					DescriptionRecruteurProfil='$DescriptionRecruteurProfil',DeptLimitrophe='$DeptLimitrophe', AdresseReponse = '$AdresseReponse'
					WHERE Id_Annonce='$Id_Annonce'");
		if ($Bdd->RequeteUpDel()) {
			$RequeteMajFct = "
				UPDATE annoncefonction, fonction
				SET annoncefonction.Id_Fonction = $Id_Fonction
				WHERE Id_Annonce='$Id_Annonce'
				AND fonction.Id_SiteEmploi = ".Id_SiteEmploi."	
				AND fonction.Id_Fonction = annoncefonction.Id_Fonction
			";
			$Bdd->setRequete($RequeteMajFct);
			$Bdd->RequeteUpDel();
			$Rss = $this->MajRss($HauteurChemin, $Id_Recruteur);
			//echo $Rss;
			if ($Rss != 1) { //Permet de mettre � jour le flux rss 
				//���Si il y a une erreur on l'enregistre dans un fichier texte
				$ouvre = fopen($HauteurChemin . "Erreur/Erreur.txt", "a+"); // ouverture en lecture ( a+)
				fwrite($ouvre, "\n\n\n\nErreur RSS le " . date("d-m-Y G:i") . " La mise � jour du flux � �chou� - NumErreur : $Rss - Annonce : $Id_Annonce"); // �criture fichier
				fclose($ouvre);
			}
			return true;
		} else {
			return false;
		}
	}
	
	public function ModificationAnnonceDiffusion() {
		$Id_Annonce = (is_numeric($this->Id_Annonce))? $this->Id_Annonce:0;
		$FlagIndeed = (is_numeric($this->FlagIndeed))? $this->FlagIndeed:0;
		$FlagPmeJob = (is_numeric($this->FlagPmeJob))? $this->FlagPmeJob:0;
		$TexteIndeed = str_replace("'","''",$this->TexteIndeed);
		$ReferencePoleEmploi = str_replace("'","''",$this->ReferencePoleEmploi);
		$Id_Recruteur = (is_numeric($this->Id_Recruteur)) ? $this->Id_Recruteur : 0;
		$RequeteModif = "
			UPDATE annonce
			SET FlagIndeed = '$FlagIndeed', FlagPmeJob='$FlagPmeJob', TexteIndeed='$TexteIndeed', ReferencePoleEmploi='$ReferencePoleEmploi'
			WHERE Id_Annonce = '$Id_Annonce'
		";
		$Bdd = new Bdd();
		$Bdd->setRequete($RequeteModif);
		$Rss = $this->MajRss("../", $Id_Recruteur);
		return $Bdd->RequeteUpDel();
	}

	public function NbCandidatAnnonce($Type = "Tous", $RegroupAnnonce = false, $Premium=-1,$EtatQualification="") {
		$ReqAnnonce = (is_numeric($this->Id_Annonce) && $this->Id_Annonce != 0) ? "AND annoncecandidat.Id_Annonce=" . $this->Id_Annonce : "";
		$Id_Recruteur = (is_numeric($this->Id_Recruteur)) ? $this->Id_Recruteur : 0;
		$ReqRecruteur = ($Id_Recruteur != 0) ? "AND annonce.Id_Recruteur=$Id_Recruteur" : "";
		$ReqType = ($Type == "Distinct") ? "GROUP BY annoncecandidat.Id_Candidat" : "";
		$ReqRegroupAnnonce = ($RegroupAnnonce == true && $Type != "Distinct") ? "GROUP BY annoncecandidat.Id_Annonce" : "";
		if($Premium==1){
			$ReqPremium=" AND annonce.Id_Formule>1 ";
		}elseif($Premium==0){
			$ReqPremium=" AND annonce.Id_Formule=1 ";
		}else{
			$ReqPremium="";
		}
		$ReqQualification = ($EtatQualification!="")? "AND flagBonneCandidature=$EtatQualification":"";
		if ($Type == "InscritEtNonInscrit") {
//Attention cette requete rel�ve les candidats qui ont postul� pas ce qui ont lu l'annonce mais tous (vivier qualifi� ou non inscrit naturel ou postulant !)
			$RequeteNbCandidatAnnonce = "
					SELECT annoncecandidat.Id_Candidat, NomCandidat, PrenomCandidat, AdresseCandidat, CpCandidat,annonce.*,candidat.DateCreation,candidat.VilleCandidat,candidat.CvCandidat
					FROM annoncecandidat,annonce,candidat,annoncefonction,fonction
					WHERE annoncecandidat.Type=1
					AND annonce.Id_Annonce = annoncefonction.Id_Annonce
					AND fonction.Id_Fonction = annoncefonction.Id_Fonction
					AND Id_SiteEmploi = ".Id_SiteEmploi."
					$ReqRecruteur
					AND annoncecandidat.Id_Candidat=candidat.Id_Candidat
					$ReqPremium
					$ReqAnnonce
					$ReqQualification
					AND annonce.Id_Annonce = annoncecandidat.Id_Annonce
					$ReqRegroupAnnonce
					ORDER BY Suspension, annonce.TitreAnnonce,NomCandidat
					$ReqType
					";
		} else {
//Attention cette requete rel�ve les candidats qui ont postul� pas ce qui ont lu l'annonce et qui sont inscrit naturellement !
			$RequeteNbCandidatAnnonce = "
				SELECT annoncecandidat.Id_Candidat, NomCandidat, PrenomCandidat, AdresseCandidat, CpCandidat,annonce.*,candidat.DateCreation,candidatsouhait.GrandeVilleProche,candidat.CvCandidat
				FROM annoncecandidat,annonce,candidat,candidatsouhait,annoncefonction,fonction
				WHERE annoncecandidat.Type=1
				$ReqRecruteur
				AND annonce.Id_Annonce = annoncefonction.Id_Annonce
				AND fonction.Id_Fonction = annoncefonction.Id_Fonction
				AND Id_SiteEmploi = ".Id_SiteEmploi."
				AND candidatsouhait.Id_Candidat = candidat.Id_Candidat
				AND annoncecandidat.Id_Candidat=candidat.Id_Candidat
				$ReqAnnonce
				$ReqPremium
				AND annonce.Id_Annonce = annoncecandidat.Id_Annonce
				$ReqRegroupAnnonce
				ORDER BY Suspension, annonce.TitreAnnonce,NomCandidat
				$ReqType
			";
		}
		$Bdd = new Bdd();
		$Bdd->setRequete($RequeteNbCandidatAnnonce);
//print_tab($RequeteNbCandidatAnnonce);
		$ResultListeCandidat = $Bdd->RequeteSelect();
		if ($ResultListeCandidat != "kenini") {
			$ResultListeCandidat["NbCandidat"] = sizeof($ResultListeCandidat);

			return $ResultListeCandidat;
		} else {
			unset($ResultListeCandidat);
			$ResultListeCandidat["NbCandidat"]=0;
			return $ResultListeCandidat;
		}
	}
	//connaitre pour une annonce le nombre de candidat qui ont re�u un mail avec l'annonce
	public function NbPushCandidatAnnonce (){
		$Id_Annonce = (is_numeric($this->Id_Annonce) && $this->Id_Annonce>0)? $this->Id_Annonce:"";
		if($Id_Annonce!=""){
			$RequeteNbPush = "
				SELECT Id_Annonce
				FROM annoncecandidatmailing
				WHERE Id_Annonce=$Id_Annonce
				AND FlagEnvoi = 1
			";
			$Bdd = new Bdd();
			$Bdd->setRequete($RequeteNbPush);
			$ResultNbPush = $Bdd->RequeteSelect();
			$NbPush = ($ResultNbPush!="kenini")? sizeof($ResultNbPush):0;
			return $NbPush;
		}else{
			return 0;
		}
	}
// cette fonction permet de savoir combien de fois l'annonce a �t� ouverte (candidat connect� ou non !)
// 2 valeurs:	Lecture ->on ajoute +1 au nombre de lecture d'une annonce
//				RecuperationValeur on rel�ve le nombre de fois ou l'annonce a �t� lue
//	Si on renseigne le num�ro du recruteur alors on on ne peut que connaitre le nombre de lecture et pour un recruteur entier et non pas une annonce
	public function nbLecture($Action = "Lecture", $Id_Recruteur="", $Premium=-1) {
		$Id_Annonce = (is_numeric($this->Id_Annonce)) ? $this->Id_Annonce : 0;
		$Id_Recruteur = (is_numeric($Id_Recruteur) && $Id_Recruteur!="") ? $Id_Recruteur : "";
		if($Premium==1){
			$ReqPremium=" AND annonce.Id_Formule>1 ";
		}elseif($Premium==0){
			$ReqPremium=" AND annonce.Id_Formule=1 ";
		}else{
			$ReqPremium="";
		}
		if($Id_Recruteur ==""){
			//On fait la recherceh pour savoir combien de fois l'annonce a �t� lu
			$Bdd = new Bdd();
			$Bdd->setRequete("SELECT NbVues FROM annonce WHERE Id_Annonce = '$Id_Annonce'");
			$ResultNbVueAnnonce = $Bdd->RequeteSelect();
			if ($ResultNbVueAnnonce != "kenini") {
				if ($Action == "Lecture") { //Si on ajoute une vue
					$NbVue = $ResultNbVueAnnonce[0]["NbVues"] + 1; //On r�cup�re le nombvre de fois ou l'aonnce a �t� lue et on ajoute 1
					$Bdd->setRequete("UPDATE annonce SET NbVues='$NbVue' WHERE Id_Annonce='$Id_Annonce'"); //on r�insert la nouvelle valeur dans la bdd
					$Bdd->RequeteUpDel();
					//Si il y a un probl�me on sera averti dans le fichier d'erreur donc pas besoin d'avertir l'utilisateur de cette erreur. On ne renvoit donc rien
				} else { //sinon on retourne le nombre de lecture
					return $ResultNbVueAnnonce[0]["NbVues"];
				}
			} else {
				return 0;
			}
		}else{
			$Bdd = new Bdd();
			$Bdd->setRequete("SELECT SUM(NbVues) FROM annonce WHERE Id_Recruteur = '$Id_Recruteur' $ReqPremium");
			$ResultNbVueAnnonce = $Bdd->RequeteSelect();
			if($ResultNbVueAnnonce!="kenini"){
				return $ResultNbVueAnnonce[0]["SUM(NbVues)"];
			}else{
				return "0";
			}
		}
	}

//Posutler ou lire une annonce pour un candidat
//On enregistre le message du candidat au recruteur si il existe sinon on enregistre uniquement l'id du candidat et de l'annonce a laquelle il a postuler
//Si type == lecture alors le candidat n'a fait que lire
//Si type == MettreAttente : c'est une pr�inscription, on fait comme si il avait postul� dans qu'il l'ai fait !
	public function PostulerAnnonce($Type = "Postuler",$Qui="Normal") {
		$Id_Candidat = (is_numeric($this->Id_Candidat)) ? $this->Id_Candidat : 0;
		$Id_Annonce = (is_numeric($this->Id_Annonce)) ? $this->Id_Annonce : 0;
		$Id_Recruteur = (is_numeric($this->Id_Recruteur)) ? $this->Id_Recruteur : 0;
		$Message = ($this->Message != "Message au recruteur") ? str_replace("'","''",$this->Message) : "";

//�������������������������//
//��� Le candidat postule //
//�����������������������//
		$Bdd = new Bdd();
		if ($Type == "Postuler") {
//��� Test si le candidat a postuler ou lu l'annonce.
			$Bdd->setRequete("
					SELECT Id_AnnonceCandidat
					FROM annoncecandidat
					WHERE Id_Annonce = $Id_Annonce
					AND Id_Candidat = $Id_Candidat
					");
			$Connu = $Bdd->RequeteSelect();
//Si le couple annonce/candidat n'existe pas alors on le cr�e
			if ($Connu == "kenini") {
				//Lancer la requete insertion dans AnnonceCandidat
				$Bdd->setRequete("
					INSERT INTO annoncecandidat
					(Id_AnnonceCandidat, Id_Annonce, Id_Candidat,Type, DateAction, flagBonneCandidature,FlagEnvoi)
					VALUE(NULL, $Id_Annonce, $Id_Candidat,1,'" . date("Y-m-d") . "',-2,1)
					");
				//Sinon on le modifie
			} else {
				$Bdd->setRequete("
					UPDATE annoncecandidat
					SET Type=1, DateAction='" . date("Y-m-d") . "', FlagEnvoi=1
					WHERE Id_Annonce = $Id_Annonce
					AND Id_Candidat = $Id_Candidat
					");
			}
			if ($Bdd->RequeteUpDel()) {
				candidat_inscrit_admin($Qui); //appel la fonction qui permet d'indiquer que l'on a un candidat de plus qui a postuler (fonctions/fonctions_statistiques.php)
//Lancer la requete insertion MessageRecruteurCandidat UNIQUEMENT SI IL Y A UN MESSAGE A ENREGISTRER sinon on valide la proc�dure
				if ($Message != "") {
					$Bdd->setRequete("
					INSERT INTO `messagerecruteurcandidat` 
					(`Id_MessageRecruteurCandidat`,`Message`,`Objet`,`Id_Recruteur`,`Id_Candidat`,`Sens`,`DateCreation`,`Id_Reponse`,`Id_Annonce`)
					VALUES (NULL, '" . $Message . "', 'Candidature � l annonce', '" . $Id_Recruteur . "', '" . $Id_Candidat . "', '1', '" . date("Y-m-d") . "', '0', '$Id_Annonce');
					");
					if ($Bdd->RequeteUpDel()) {
						return 1;
					} else {
						return -4;
					}
				} else {
					return 1;
				}
			} else {
				return -3;
			}
//�����������������������������//
//��� Le candidat pr�postul� (mettre en attente) //
//���������������������������//
		}elseif($Type == "MettreAttente"){
			//��� Test si le candidat a postuler ou lu l'annonce.
			$Bdd->setRequete("
					SELECT Id_AnnonceCandidat
					FROM annoncecandidat
					WHERE Id_Annonce = $Id_Annonce
					AND Id_Candidat = $Id_Candidat
					");
			$Connu = $Bdd->RequeteSelect();
//Si le couple annonce/candidat n'existe pas alors on le cr�e
			if ($Connu == "kenini") {
				//Lancer la requete insertion dans AnnonceCandidat
				$Bdd->setRequete("
					INSERT INTO annoncecandidat
					(Id_AnnonceCandidat, Id_Annonce, Id_Candidat,Type, DateAction, flagBonneCandidature,FlagEnvoi)
					VALUE(NULL, $Id_Annonce, $Id_Candidat,-1,'" . date("Y-m-d") . "',-2,0)
					");
				//Sinon on le modifie
			} else {
				$Bdd->setRequete("
					UPDATE annoncecandidat
					SET Type=-1, DateAction='" . date("Y-m-d") . "'
					WHERE Id_Annonce = $Id_Annonce
					AND Id_Candidat = $Id_Candidat
					");
			}
			if ($Bdd->RequeteUpDel()) {
//Lancer la requete insertion MessageRecruteurCandidat UNIQUEMENT SI IL Y A UN MESSAGE A ENREGISTRER sinon on valide la proc�dure
				if ($Message != "") {
					$Bdd->setRequete("
					INSERT INTO `messagerecruteurcandidat` 
					(`Id_MessageRecruteurCandidat`,`Message`,`Objet`,`Id_Recruteur`,`Id_Candidat`,`Sens`,`DateCreation`,`Id_Reponse`,`Id_Annonce`)
					VALUES (NULL, '" . $Message . "', 'Candidature � l annonce', '" . $Id_Recruteur . "', '" . $Id_Candidat . "', '1', '" . date("Y-m-d") . "', '0', '$Id_Annonce');
					");
					if ($Bdd->RequeteUpDel()) {
						return 1;
					} else {
						return -4;
					}
				} else {
					return 1;
				}
			} else {
				return -3;
			}
//�����������������������������//
//��� Le candidat lit annonce //
//���������������������������//
		} else {
//��� Test si le candidat a postuler ou lu l'annonce.
			$Bdd->setRequete("
					SELECT Id_AnnonceCandidat, Type
					FROM annoncecandidat
					WHERE Id_Annonce = $Id_Annonce
					AND Id_Candidat = $Id_Candidat
					");
			$Connu = $Bdd->RequeteSelect();
//Si le couple annonce/candidat n'existe pas alors on le cr�e
			if ($Connu == "kenini") {
				//Lancer la requete insertion dans AnnonceCandidat
				$Bdd->setRequete("
					INSERT INTO annoncecandidat
					(Id_AnnonceCandidat, Id_Annonce, Id_Candidat,Type, DateAction, flagBonneCandidature,FlagEnvoi)
					VALUE(NULL, $Id_Annonce, $Id_Candidat,2,'" . date("Y-m-d") . "',-2,0)
					");
				//Si le couple annonce/candidat ne correspond pas � une postulation
			} elseif ($Connu[0]["Type"] != 1) {
				$Bdd->setRequete("
					UPDATE annoncecandidat
					SET Type=2, DateAction='" . date("Y-m-d") . "'
					WHERE Id_AnnonceCandidat = " . $Connu[0]["Id_AnnonceCandidat"] . "
					");
			} else {
				return 1;
			}
			if ($Bdd->RequeteUpDel()) {
				return 1;
			} else {
				return -5;
			}
		}
	}
	// cette fonction permet de v�rifier si le candidat a d�j� postuler ou consult� cette annonce et donc comme �a il ne peut pas recommencer
	public function TestQualificationCandidature() {
		$Id_Candidat = (is_numeric($this->Id_Candidat)) ? $this->Id_Candidat : 0;
		$Id_Annonce = (is_numeric($this->Id_Annonce)) ? $this->Id_Annonce : 0;

		$Bdd = new Bdd();
//��� Test si le candidat a postuler ou lu l'annonce.
		$Bdd->setRequete("
			SELECT Id_AnnonceCandidat, flagBonneCandidature
			FROM annoncecandidat
			WHERE Id_Annonce = $Id_Annonce
			AND Id_Candidat = $Id_Candidat
		");
		
		$Qualif = $Bdd->RequeteSelect();
		if ($Qualif != "kenini") {
			return $Qualif[0]["flagBonneCandidature"];
		} else {
			return "kenini";
		}
	}
	// cette fonction permet de qualifier une candidature
	public function QualifierCandidature($Etat) {
		$Id_Candidat = (is_numeric($this->Id_Candidat)) ? $this->Id_Candidat : 0;
		$Id_Annonce = (is_numeric($this->Id_Annonce)) ? $this->Id_Annonce : 0;

		$Bdd = new Bdd();
//��� Test si le candidat a postuler ou lu l'annonce.
		$Bdd->setRequete("
			UPDATE annoncecandidat
			SET flagBonneCandidature=$Etat
			WHERE Id_Annonce = $Id_Annonce
			AND Id_Candidat = $Id_Candidat
		");
		
		return $Bdd->RequeteUpDel();
	}
// cette fonction permet de v�rifier si le candidat a d�j� postuler ou consult� cette annonce et donc comme �a il ne peut pas recommencer
	public function TestPostulerAnnonce() {
		$Id_Candidat = (is_numeric($this->Id_Candidat)) ? $this->Id_Candidat : 0;
		$Id_Annonce = (is_numeric($this->Id_Annonce)) ? $this->Id_Annonce : 0;

		$Bdd = new Bdd();
//��� Test si le candidat a postuler ou lu l'annonce.
		$Bdd->setRequete("
					SELECT Type, Id_AnnonceCandidat, flagBonneCandidature
					FROM annoncecandidat
					WHERE Id_Annonce = $Id_Annonce
					AND Id_Candidat = $Id_Candidat
					");
		$Connu = $Bdd->RequeteSelect();
		if ($Connu != "kenini") {
			return $Connu[0]["Type"];
		} else {
			return 0;
		}
	}

// cette fonction permet de v�rifier si le candidat a d�j� postuler ou consult� cette annonce et donc comme �a il ne peut pas recommencer
	public function TestPostulerCandidat() {
		$Id_Candidat = (is_numeric($this->Id_Candidat)) ? $this->Id_Candidat : 0;
		$Bdd = new Bdd();
//��� Test si le candidat a postuler ou lu l'annonce.
		$Bdd->setRequete("
					SELECT Id_AnnonceCandidat
					FROM annoncecandidat
					WHERE Id_Candidat = $Id_Candidat
					AND Type=1
					");
		$Connu = $Bdd->RequeteSelect();
		if ($Connu != "kenini") {
			return true;
		} else {
			return false;
		}
	}

//Publier ou d�publier l'annonce. 
//$Action : 3 valeurs possible : Republier ou Suspendre ou AdminSuspension
	public function PublicationAnnonce($Action, $HauteurChemin = "", $Admin = 0,$Id_NewFormule = 1,$RaisonRejet=0) {
		$Id_Annonce = $this->Id_Annonce;
		$Id_Recruteur = $this->Id_Recruteur;
		if(is_numeric($Id_Annonce) && $Id_Annonce!=0){
			$Bdd = new Bdd();
			$Bdd->setRequete("SELECT Suspension, Id_Formule FROM annonce WHERE Id_Annonce = $Id_Annonce");
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
				WHERE Id_Recruteur = '$Id_Recruteur'
				AND recruteurformule.Id_RecruteurFormule = recruteur.Id_RecruteurFormule
			");
			
			$HistoriqueFormuleTF = $Bdd->RequeteSelect();
			$ChampsHistorique = $FormuleTF[0]["NomChampsHistorique"]; //Le nom du champs
			$ChampsNbRestant = $FormuleTF[0]["NomChampsRecruteurFormule"]; //Le nom du champs
			$NbAnnnonceHistorique  =  $HistoriqueFormuleTF[0][$ChampsHistorique]; //on r�cup�re le nombre d'annonce d�j� pass� dans ce mode l� pour savoir l'incr�menter
			$NbAnnnonceRestant  =  $HistoriqueFormuleTF[0][$ChampsNbRestant]; //on r�cup�re le nombre d'annonce d�j� pass� dans ce mode l� pour savoir l'incr�menter
			//On v�rifie les champs obligatoires

			if ($Action == "Republier") {
				//
				if ($InfoAnnonce[0]["Suspension"] != 2 && $InfoAnnonce[0]["Suspension"] != -1 && $InfoAnnonce[0]["Suspension"] != -2  && $InfoAnnonce[0]["Suspension"] != 3 && $InfoAnnonce[0]["Id_Formule"]>1) {
						$RequetePublication = "
							UPDATE annonce
							SET DatePublication = '" . date("Y-m-d") . "', DateFinPublication = '" . date("Y-m-d", time() + ($FormuleTF[0]["NbJoursEnLigne"] * 24 * 60 * 60)) . "', Suspension=0, `DatePublicationRss`='" . date("Y-m-d H:i:s") . "'
							WHERE Id_Annonce = $Id_Annonce
						";
						$Bdd = new Bdd();
						$Bdd->setRequete($RequetePublication);
						if ($Bdd->RequeteUpDel()) {
							//Mise � jour du rss
							$Rss = $this->MajRss($HauteurChemin, $Id_Recruteur);
							if ($Rss != 1) { //Permet de mettre � jour le flux rss 
								//���Si il y a une erreur on l'enregistre dans un fichier texte
								$ouvre = fopen($HauteurChemin . "Erreur/Erreur.txt", "a+"); // ouverture en lecture ( a+)
								fwrite($ouvre, "\n\n\n\nErreur ".NomSite." RSS le " . date("d-m-Y G:i") . " La mise � jour du flux � �chou� - NumErreur : $Rss - Annonce : $Id_Annonce"); // �criture fichier
								fclose($ouvre);
							}
							return true;
						} else {
							return "Votre action n a pas pu �tre �x�cut�e, merci de recommencer plus tard.";
						}
	//				} else {
	//					return "Vous n avez plus le droit de poster d'annonce, vous ne pouvez pas republier l annonce";
	//				}
				}elseif($InfoAnnonce[0]["Id_Formule"]==1 && $Id_NewFormule>1 && $NbAnnnonceRestant>0){//Si on veut la republier en l'upgradant. Possible si la formule de base est gratuite, si la formule a l'arrive est payante et si il reste du cr�dit.
					$NewNbAnnnonceHistorique = $NbAnnnonceHistorique+1;
					$NewNbAnnnonceRestant = $NbAnnnonceRestant-1;
					$RequetePublication = "
						UPDATE annonce,recruteurformule, recruteur
						SET		DatePublication = '" . date("Y-m-d") . "', DateFinPublication = '" . date("Y-m-d", time() + ($FormuleTF[0]["NbJoursEnLigne"] * 24 * 60 * 60)) . "', Suspension=0, 
								`DatePublicationRss`='" . date("Y-m-d H:i:s") . "', Id_Formule='$Id_NewFormule', recruteurformule.$ChampsHistorique='$NewNbAnnnonceHistorique'
						WHERE Id_Annonce = $Id_Annonce
						AND annonce.Id_Recruteur = recruteur.Id_Recruteur
						AND recruteur.Id_RecruteurFormule = recruteurformule.Id_RecruteurFormule
					";
					$Bdd = new Bdd();
					$Bdd->setRequete($RequetePublication);
					if ($Bdd->RequeteUpDel()) {
						//Mise � jour du rss
						$Rss = $this->MajRss($HauteurChemin, $Id_Recruteur);
						//echo $Rss;
						if ($Rss != 1) { //Permet de mettre � jour le flux rss 
							//���Si il y a une erreur on l'enregistre dans un fichier texte
							$ouvre = fopen($HauteurChemin . "Erreur/Erreur.txt", "a+"); // ouverture en lecture ( a+)
							fwrite($ouvre, "\n\n\n\nErreur ".NomSite." RSS le " . date("d-m-Y G:i") . " La mise � jour du flux � �chou� - NumErreur : $Rss - Annonce : $Id_Annonce"); // �criture fichier
							fclose($ouvre);
						}
						return true;
					} else {
						return "Votre action n a pas pu �tre �x�cut�e, merci de recommencer plus tard.";
					}
				}elseif($InfoAnnonce[0]["Suspension"]== 3){ //si l'annonce est annul�e alors on la pr� - publie (soumie a l'admin) car pour le moment l'admin en a pas pris connaissance
					$RequetePublication = "
							UPDATE annonce
							SET DatePublication = '" . date("Y-m-d") . "', DateFinPublication = '" . date("Y-m-d", time() + ($FormuleTF[0]["NbJoursEnLigne"] * 24 * 60 * 60)) . "', Suspension=-1, `DatePublicationRss`='" . date("Y-m-d H:i:s") . "'
							WHERE Id_Annonce = $Id_Annonce
						";
						$Bdd = new Bdd();
						$Bdd->setRequete($RequetePublication);
						if ($Bdd->RequeteUpDel()) {
							//Mise � jour du rss
							$Rss = $this->MajRss($HauteurChemin, $Id_Recruteur);

							if ($Rss != 1) { //Permet de mettre � jour le flux rss 
								//���Si il y a une erreur on l'enregistre dans un fichier texte
								$ouvre = fopen($HauteurChemin . "Erreur/Erreur.txt", "a+"); // ouverture en lecture ( a+)
								fwrite($ouvre, "\n\n\n\nErreur ".NomSite." RSS le " . date("d-m-Y G:i") . " La mise � jour du flux � �chou� - NumErreur : $Rss - Annonce : $Id_Annonce"); // �criture fichier
								fclose($ouvre);
							}
							return true;
						} else {
							return "Votre action n a pas pu �tre �x�cut�e, merci de recommencer plus tard.";
						}
				}else {
					if ($Admin == 1) {
						$RequetePublication = "
							UPDATE annonce
							SET DatePublication = '" . date("Y-m-d") . "', DateFinPublication = '" . date("Y-m-d", time() + ($FormuleTF[0]["NbJoursEnLigne"] * 24 * 60 * 60)) . "', Suspension=0, `DatePublicationRss`='" . date("Y-m-d H:i:s") . "'
							WHERE Id_Annonce = $Id_Annonce
						";
						$Bdd = new Bdd();
						$Bdd->setRequete($RequetePublication);
						if ($Bdd->RequeteUpDel()) {
							//Mise � jour du rss
							$Rss = $this->MajRss($HauteurChemin, $Id_Recruteur);

							if ($Rss != 1) { //Permet de mettre � jour le flux rss 
								//���Si il y a une erreur on l'enregistre dans un fichier texte
								$ouvre = fopen($HauteurChemin . "Erreur/Erreur.txt", "a+"); // ouverture en lecture ( a+)
								fwrite($ouvre, "\n\n\n\nErreur ".NomSite." RSS le " . date("d-m-Y G:i") . " La mise � jour du flux � �chou� - NumErreur : $Rss - Annonce : $Id_Annonce"); // �criture fichier
								fclose($ouvre);
							}
							return true;
						} else {
							return "Cette annonce a �t� suspendu par les administrateurs du site, vous ne pouvez pas republier l annonce";
						}
					}
				}
			} elseif ($Action == "Suspendre") {
				$RequetePublication = "
						UPDATE annonce
						SET Suspension=1
						WHERE Id_Annonce = $Id_Annonce
						";
				$Bdd = new Bdd();
				$Bdd->setRequete($RequetePublication);
				if ($Bdd->RequeteUpDel()) {
					//Mise � jour du rss
					$Rss = $this->MajRss($HauteurChemin, $Id_Recruteur);

					if ($Rss != 1) { //Permet de mettre � jour le flux rss 
						//���Si il y a une erreur on l'enregistre dans un fichier texte
						$ouvre = fopen($HauteurChemin . "Erreur/Erreur.txt", "a+"); // ouverture en lecture ( a+)
						fwrite($ouvre, "\n\n\n\nErreur ".NomSite." RSS le " . date("d-m-Y G:i") . " La mise � jour du flux � �chou� - NumErreur : $Rss - Annonce : $Id_Annonce"); // �criture fichier
						fclose($ouvre);
					}
					return true;
				} else {
					return "Votre action n a pas pu �tre �x�cut�e correctement, merci de recommencer plus tard.";
				}
			} elseif ($Action == "AdminSuspension") {
				$RequetePublication = "
						UPDATE annonce
						SET Suspension=2, Id_RejetAnnonce=$RaisonRejet
						WHERE Id_Annonce = $Id_Annonce
						";
				$Bdd = new Bdd();
				$Bdd->setRequete($RequetePublication);
				if ($Bdd->RequeteUpDel($RequetePublication)) {
					//Mise � jour du rss
					$Rss = $this->MajRss($HauteurChemin, $Id_Recruteur);

					if ($Rss != 1) { //Permet de mettre � jour le flux rss 
						//���Si il y a une erreur on l'enregistre dans un fichier texte
						$ouvre = fopen($HauteurChemin . "Erreur/Erreur.txt", "a+"); // ouverture en lecture ( a+)
						fwrite($ouvre, "\n\n\n\nErreur ".NomSite." RSS le " . date("d-m-Y G:i") . " La mise � jour du flux � �chou� - NumErreur : $Rss - Annonce : $Id_Annonce"); // �criture fichier
						fclose($ouvre);
					}
					return true;
				} else {
					return "Votre action n a pas pu �tre �x�cut�e correctement, merci de recommencer plus tard.";
				}
			}elseif($Action=="Publication"){
				if($InfoAnnonce[0]["Suspension"]==-2 || $InfoAnnonce[0]["Suspension"]==3){ //Pr� publication par le recruteur
					//Soit il reste du cr�dit pour l'offre soit on est sur de l'ilimit� donc la valeur est -1 (vraie pour le mode gratuit)
					if($NbAnnnonceRestant>0 ){
						$NewNbAnnnonceHistorique = $NbAnnnonceHistorique+1;
						$NewNbAnnnonceRestant = $NbAnnnonceRestant-1;
						//, recruteurformule.$ChampsHistorique='$NewNbAnnnonceHistorique'
						//A ce moment la on ne change pas le nombre d'annonce autoris� pour le recruteur. On le changera au moment ou l'admin la publiera
						$RequetePublication = "
							UPDATE annonce,recruteurformule,recruteur
							SET 
								DatePublication = '" . date("Y-m-d") . "', DateFinPublication = '" . date("Y-m-d", time() + ($FormuleTF[0]["NbJoursEnLigne"] * 24 * 60 * 60)) . "', 
								Suspension=-1, `DatePublicationRss`='" . date("Y-m-d H:i:s") . "', annonce.Id_Formule=$Id_NewFormule
							WHERE Id_Annonce = $Id_Annonce
							AND annonce.Id_Recruteur = recruteur.Id_Recruteur
							AND recruteurformule.Id_RecruteurFormule = recruteur.Id_RecruteurFormule
						";
						$Bdd = new Bdd();
						$Bdd->setRequete($RequetePublication);
						if($Bdd->RequeteUpDel()){
							return true;
						}else{
							return "Votre action n a pas pu �tre �x�cut�e correctement, merci de recommencer dans quelques minutes.";
						}
					}elseif($NbAnnnonceRestant==-1){
						$NewNbAnnnonceHistorique = $NbAnnnonceHistorique+1;

						$RequetePublication = "
							UPDATE annonce,recruteurformule,recruteur
							SET 
								DatePublication = '" . date("Y-m-d") . "', DateFinPublication = '" . date("Y-m-d", time() + ($FormuleTF[0]["NbJoursEnLigne"] * 24 * 60 * 60)) . "', 
								Suspension=-1, `DatePublicationRss`='" . date("Y-m-d H:i:s") . "', annonce.Id_Formule=$Id_NewFormule
							WHERE Id_Annonce = $Id_Annonce
							AND annonce.Id_Recruteur = recruteur.Id_Recruteur
							AND recruteurformule.Id_RecruteurFormule = recruteur.Id_RecruteurFormule
						";
						$Bdd = new Bdd();
						$Bdd->setRequete($RequetePublication);
						if($Bdd->RequeteUpDel()){
							return true;
						}else{
							return "Votre action n a pas pu �tre �x�cut�e correctement, merci de recommencer dans quelques minutes.";
						}
					}else{
						return "Vous ne disposez d'aucun cr�dit permettant la mise en avant de vos offres";
					}
				}elseif($InfoAnnonce[0]["Suspension"]==-1 && $Admin==1){ //Premiere publication par les mod�rateurs
					
					//Soit il reste du cr�dit pour l'offre soit on est sur de l'ilimit� donc la valeur est -1 (vraie pour le mode gratuit)
					if($NbAnnnonceRestant>0 ){
						$NewNbAnnnonceHistorique = $NbAnnnonceHistorique+1;
						$NewNbAnnnonceRestant = $NbAnnnonceRestant-1;
						//, recruteurformule.$ChampsHistorique='$NewNbAnnnonceHistorique'
						//A ce moment la on ne change pas le nombre d'annonce autoris� pour le recruteur. On le changera au moment ou l'admin la publiera
						$RequetePublication = "
							UPDATE annonce,recruteurformule,recruteur
							SET 
								DatePublication = '" . date("Y-m-d") . "', DateFinPublication = '" . date("Y-m-d", time() + ($FormuleTF[0]["NbJoursEnLigne"] * 24 * 60 * 60)) . "', 
								Suspension=0, `DatePublicationRss`='" . date("Y-m-d H:i:s") . "', annonce.Id_Formule=$Id_NewFormule, recruteurformule.$ChampsHistorique='$NewNbAnnnonceHistorique'
							WHERE Id_Annonce = $Id_Annonce
							AND annonce.Id_Recruteur = recruteur.Id_Recruteur
							AND recruteurformule.Id_RecruteurFormule = recruteur.Id_RecruteurFormule
						";
						$Bdd = new Bdd();
						$Bdd->setRequete($RequetePublication);
						if($Bdd->RequeteUpDel()){
							NbNouvelleAnnonces(date("Y-m-d"));
							//Mise � jour du rss
							$Rss = $this->MajRss($HauteurChemin, $Id_Recruteur);
							return true;
						}else{
							return "Votre action n a pas pu �tre �x�cut�e correctement, merci de recommencer dans quelques minutes.";
						}
					}elseif($NbAnnnonceRestant==-1){ //Si on est en illimit� alors on peut avoir un compte
						$NewNbAnnnonceHistorique = $NbAnnnonceHistorique+1;

						$RequetePublication = "
							UPDATE annonce,recruteurformule,recruteur
							SET 
								DatePublication = '" . date("Y-m-d") . "', DateFinPublication = '" . date("Y-m-d", time() + ($FormuleTF[0]["NbJoursEnLigne"] * 24 * 60 * 60)) . "', 
								Suspension=0, `DatePublicationRss`='" . date("Y-m-d H:i:s") . "', annonce.Id_Formule=$Id_NewFormule, recruteurformule.$ChampsHistorique='$NewNbAnnnonceHistorique'
							WHERE Id_Annonce = $Id_Annonce
							AND annonce.Id_Recruteur = recruteur.Id_Recruteur
							AND recruteurformule.Id_RecruteurFormule = recruteur.Id_RecruteurFormule
						";
						$Bdd = new Bdd();
						$Bdd->setRequete($RequetePublication);
						if($Bdd->RequeteUpDel()){
							NbNouvelleAnnonces(date("Y-m-d"));
							$Rss = $this->MajRss($HauteurChemin, $Id_Recruteur);
							return true;
						}else{
							return "Votre action n a pas pu �tre �x�cut�e correctement, merci de recommencer dans quelques minutes.";
						}
					}else{
						return "Ce recruteur ne poss�de pas les cr�dits n�cessaires";
					}
				}elseif($InfoAnnonce[0]["Suspension"]==2 && $Admin==1){ //Republication par les mod�rateurs
					$RequetePublication = "
						UPDATE annonce,recruteurformule,recruteur
						SET 
							DatePublication = '" . date("Y-m-d") . "', DateFinPublication = '" . date("Y-m-d", time() + ($FormuleTF[0]["NbJoursEnLigne"] * 24 * 60 * 60)) . "', 
							Suspension=0, `DatePublicationRss`='" . date("Y-m-d H:i:s") . "', annonce.Id_Formule=$Id_NewFormule, recruteurformule.$ChampsHistorique='$NewNbAnnnonceHistorique'
						WHERE Id_Annonce = $Id_Annonce
						AND annonce.Id_Recruteur = recruteur.Id_Recruteur
						AND recruteurformule.Id_RecruteurFormule = recruteur.Id_RecruteurFormule
					";
					$Bdd = new Bdd();
					$Bdd->setRequete($RequetePublication);
					if($Bdd->RequeteUpDel()){
						return true;
					}else{
						return "L'annonce ne peut pas �tre publi� � cause d'une erreur SQL";
					}
				}else{
					return "Votre annonce ne peut pas �tre publi�e car elle n'est pas en attente. Vous avez du cliquez sur le mauvais lien";
				}

			}elseif($Action=="Annulation"){
				if($InfoAnnonce[0]["Suspension"]==-2){
					//Soit il reste du cr�dit pour l'offre soit on est sur de l'ilimit� donc la valeur est -1 (vraie pour le mode gratuit)
				
					$RequetePublication = "
						UPDATE annonce
						SET DatePublication = '" . date("Y-m-d") . "', DateFinPublication = '" . date("Y-m-d") . "', Suspension=3, annonce.Id_Formule=1
						WHERE Id_Annonce = $Id_Annonce
					";
					$Bdd = new Bdd();
					$Bdd->setRequete($RequetePublication);
					if($Bdd->RequeteUpDel()){
						return true;
					}else{
						return "Votre action n a pas pu �tre �x�cut�e correctement, merci de recommencer dans quelques minutes.";
					}

				} else {
					return "Une erreur s est produite, merci de recommencer plus tard";
				}
			}  else {
				return "Une erreur s est produite, merci de recommencer plus tard";
			}
		}else{
			return "Oups, nous ne trouvons pas l'annonce. Merci de recommencer l'op�ration ";
		}
	}

//Recherche des annonces 
//3 parametres : 
//$tri = critere de tri des annonces,  doit etre le nom exact du champs
//$Suspension = permet de trier si annonce est autoriser � etre en ligne ou non 
// si $Suspension = -3 on recherche toute les annonces sans le critere suspension
// si $Suspension = -2 on ne recherche que les annonces qui ne sont pas en ligne ou en attente !!!!!!!! cette valeur est a combin� avec $EnLigne = 0 pour ne pas tenir compte de la date !!!!!!!!
//$Enligne = Si oui alors on compare date du jour et date de fin publication
//On peut afficher toute les annonce pour un cabinet en appelant setIdCabinet()
//Le parametre Gratuit : -1 on n'en tient pas compte, 1 que les gratuites, 0 toutes les payantes sinon correspond � une offre en particulier
//Le parametre stage : Si c'est � -1 alors on cherche tout stage ou non, si c'est a 0 on exclu les stages, si c'est a 1 alors on ne cherche que �a !
//
	//Retourne la liste des annonces dans un tableau a 2 dimensions ou kenini si aucun r�sultat
	public function RechercheAnnonce($tri = "recruteur.FlagEnHaut DESC, annonce.DatePublication DESC, annonce.id", $Suspension = 0, $EnLigne = 1, $Limit = 0, $Last = 0, $HauteurChemin = "", $DepartementRss = "", $RegionTF = "",$FluxIndeed=-1, $APartir=0,$Gratuit=-1, $Reference = "", $Stage=-1, $Id_Candidat=0, $Compter=0) {
		
		$ReqRecruteur = (is_numeric($this->Id_Recruteur) && $this->Id_Recruteur != 0) ? "AND recruteur.id=" . $this->Id_Recruteur : "";
		$ReqDepartementRss = (is_numeric($DepartementRss) && $DepartementRss != "") ? "AND departement.num LIKE '" . $DepartementRss . "%'" : ""; //on ne recherche qu'un d�partement en particulier contrairement � reqDepartement
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
		}  elseif ($Suspension == -4) { //on veut afficher celle qui sont en attente de  validation par le recruteur (-4 car -2 et -3 �tait d�j� pris ...)
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
			$Limit = ($Limit==0)? 500:$Limit; //Si limit n'est pas renseign� on met un gros nombre pour 
			$ReqLimit = "LIMIT $APartir,$Limit";
		} else {
			$ReqLimit = "";
		}
		if ($Last != 0) {
			$ReqLast = "AND annonce.id > $Last";
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
				$ReqDepartement = "annonce.id_Departement_id=0"; //Si on ne trouve pas la region alors on affiche que les toutes france. 
			}
		} else {
			$ReqDepartement = "";
		}
		if($Id_Candidat>0){
			$tableCandidature = ", annoncecandidat";
			$whereCandidature = " AND annonce.id = annoncecandidat.Id_Annonce AND Id_Candidat=$Id_Candidat ";
		}else{
			$tableCandidature = "";
			$whereCandidature = "";
		}
//			echo "-$ReqDepartement-";
		$ReqMotCle = ($this->RechMotCle != "Mots cl�s" && $this->RechMotCle != "") ? "AND (annonce.TitreAnnonce LIKE '%" . str_replace("'","''",$this->RechMotCle) . "%' OR annonce.DescriptifAnnonce LIKE '%" . str_replace("'","''",$this->RechMotCle) . "%' OR annonce.ProfilRecherche LIKE '%" . str_replace("'","''",$this->RechMotCle) . "%' OR annonce.GrandeVilleProche LIKE '%" . str_replace("'","''",$this->RechMotCle) . "%' OR departement.num LIKE '" . str_replace("'","''",$this->RechMotCle) . "%' OR departement.dept LIKE '%" . str_replace("'","''",$this->RechMotCle) . "%')" : "";
		$Bdd = new Bdd();
//			FROM annonce,annoncefonction,fonction
//			WHERE annonce.Id_Annonce = annoncefonction.Id_Annonce
//			AND annoncefonction.Id_Fonction = fonction.Id_Fonction
//			AND fonction.Id_SiteEmploi = ".Id_SiteEmploi."
		if($Compter==0){
			$RequeteAnnonce = "
				SELECT	annonce.*, horaire.IntituleHoraire,departement.*, recruteur.`Id`, recruteur.`Societe`, recruteur.`Id_CiviliteContactComm`, recruteur.`NomContactComm`,
				recruteur.`PrenomContactComm`, recruteur.`MailComm_login`, recruteur.`Id_CiviliteContactSourcing`, recruteur.`NomContactSourcing`, recruteur.`PrenomContactSourcing`, recruteur.`MailSourcing`,
				recruteur.`Adresse`, recruteur.`Cp`, recruteur.`Ville`, recruteur.`Description`, recruteur.`Site`, recruteur.`Tel`, recruteur.`Fax`, recruteur.`Pwd`, recruteur.`Blacklist`,recruteur.`DateMaj`,
				recruteur.`Logo`, recruteur.`Id_TypeRecruteur`, recruteur.`Newsletter`, recruteur.`FlagEnHaut`, recruteur.DateCreation AS DateCreationRecruteur,typecontrat.IntituleTypeContrat, fonction.IntituleFonction,
				formule.IntituleFormule
				FROM annonce,horaire,annoncefonction,fonction,departement,recruteur,typecontrat,formule, $tableCandidature
				WHERE annonce.Id_Horaire = horaire.Id_Horaire
				AND annonce.Id_Formule = formule.Id_Formule
				AND annonce.Id_Departement_Id = departement.Id
				AND annonce.Id_Recruteur_Id = recruteur.Id
				AND annonce.Id_TypeContrat = typecontrat.Id_TypeContrat
				AND annonce.id = annoncefonction.Id_Annonce
				AND annoncefonction.Id_Fonction = fonction.Id
				AND fonction.Id_SiteEmploi = ".$Id_SiteEmploi."
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
				GROUP BY annonce.Id_Annonce
				ORDER BY $tri
				$ReqLimit
			";
		}else{
			$RequeteAnnonce = "
				SELECT	COUNT(annonce.Id)
				FROM annonce,horaire,annoncefonction,fonction,departement,recruteur,typecontrat,formule, $tableCandidature
				WHERE annonce.Id_Horaire = horaire.Id_Horaire
				AND annonce.Id_Formule = formule.Id_Formule
				AND annonce.Id_Departement_Id = departement.Id
				AND annonce.Id_Recruteur_Id = recruteur.Id
				AND annonce.Id_TypeContrat = typecontrat.Id_TypeContrat
				AND annonce.id = annoncefonction.Id_Annonce
				AND annoncefonction.Id_Fonction = fonction.Id
				AND fonction.Id_SiteEmploi = ".$Id_SiteEmploi."
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
		
//			print_tab($RequeteAnnonce);
		$Bdd->setRequete($RequeteAnnonce);
		$Bdd->setHauteurChemin($HauteurChemin);
//print_tab($RequeteAnnonce);
		return $Bdd->RequeteSelect();
		//return $Id_SiteEmploi;
	}
	

//on supprime l'annonce demand�
	public function SuppressionAnnonce() {
		$Id_Annonce = (is_numeric($this->Id_Annonce)) ? $this->Id_Annonce : 0;
		$RequeteSuppression = "
					DELETE FROM annonce
					WHERE id = $Id_Annonce
					";
		$Bdd = new Bdd();
		$Bdd->setRequete($RequeteSuppression);
		if ($Bdd->RequeteUpDel()) {
			return true;
		} else {
			return false;
		}
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
	public function setSeDeux($Value) {
		$this->SeDeux = $Value;
	}
	public function getSeDeux() {
		return $this->SeDeux;
	}
	public function setFonctionDeux($Value) {
		$this->FonctionDeux = $Value;
	}
	public function getFonctionDeux() {
		return $this->FonctionDeux;
	}
}

?>