<?php

require_once("../class/FonctionsVariees.php");
require_once("../class/fonction_de_date.php");
require_once("../class/fonctionMail.php");
require_once("../class/Bdd.php");
require_once("../class/Recruteur.class.php");

class XmlPE {

	public function CreationAnnonceWs($FichierXml) {
		$Bdd = new Bdd();
		$annonceFlux = simplexml_load_file($FichierXml);

		for ($i = 0; $i < sizeof($annonceFlux->jobs->job); $i++) {
			// get content
			$Reference = $annonceFlux->jobs->job[$i]->reference;
			$Login = $annonceFlux->jobs->job[$i]->login;

			$Requete = '
				SELECT *
				FROM user
				WHERE Email="' . $Login . '"';
			$Bdd->setRequete($Requete);
			$User = $Bdd->RequeteSelect();

			$Requete = "
				SELECT *
				FROM Sy_Recruteur
				WHERE id=" . $User[0]["id"];
			$Bdd->setRequete($Requete);
			$recruteurInfo = $Bdd->RequeteSelect();

			if ($recruteurInfo == "kenini") {
				$Requete = "
				SELECT *
				FROM Sy_Employeur
				WHERE id=" . $User[0]["id"];
				$Bdd->setRequete($Requete);
				$recruteurInfo = $Bdd->RequeteSelect();
			}



			$requete = "
				SELECT *
				FROM sy_annonce
				WHERE id_recruteur_id ='" . $recruteurInfo[0]["Id"] . " AND referenceRecruteur = " . $Reference;
			$Bdd->setRequete($requete);
			$annonceDoublon = $Bdd->RequeteSelect();

			$recruteurLogin = $User[0]["email"];
			$Retour = "Je suis pas entrée ici,je crois";
			if ($recruteurLogin != "kenini") {
				if ($annonceDoublon == "kenini") {
					$Retour = "Youpi";
					$Titre = $annonceFlux->jobs->job[$i]->titre;
					$etablissement = $annonceFlux->jobs->job[$i]->etablissement;
					$Description = $annonceFlux->jobs->job[$i]->description;
					$Profil = $annonceFlux->jobs->job[$i]->profil;
					$ville = $annonceFlux->jobs->job[$i]->ville;
					$departement = $annonceFlux->jobs->job[$i]->departement;
					$contrat = $annonceFlux->jobs->job[$i]->contrat;
					$fonction = $annonceFlux->jobs->job[$i]->fonction;
					$horaire = $annonceFlux->jobs->job[$i]->horaire;
					$niveau = $annonceFlux->jobs->job[$i]->niveau;
					$recruteur = $annonceFlux->jobs->job[$i]->recruteur;
					$salaire = $annonceFlux->jobs->job[$i]->salaire;
					$avantages = $annonceFlux->jobs->job[$i]->avantage;
					$nombreheure = $annonceFlux->jobs->job[$i]->nombreheure;
					$dureecontrat = $annonceFlux->jobs->job[$i]->dureecontrat;
					$premium = $annonceFlux->jobs->job[$i]->premium;
					$adressereponse = $annonceFlux->jobs->job[$i]->adressereponse;

					if ($Titre != "") {
						if ($etablissement != "") {
							if ($Description != "") {
								if ($Profil != "") {
									if ($ville != "") {
										if ($departement != "") {
											if ($contrat != "") {
												if ($fonction != "") {
													if ($horaire != "") {
														$Val_Departement = substr($departement, 0, 2);

														$Requete = "
																SELECT id
																FROM departement
																WHERE num=" . $Val_Departement;
														$Bdd->setRequete($Requete);
														$Id_Dep = $Bdd->RequeteSelect();

														$Requete = '
																SELECT id
																FROM typecontrat
																WHERE intituleTypeContrat LIKE"' . $contrat . '%"';
														$Bdd->setRequete($Requete);
														$Id_Contrat = $Bdd->RequeteSelect();

														
														$Val_Niveau = substr($niveau, 0, 2);
														$Requete = '
																SELECT id
																FROM niveausouhaite
																WHERE intituleNiveauSouhaite LIKE"' . $Val_Niveau . '%"';
														$Bdd->setRequete($Requete);
														$Id_Niveau = $Bdd->RequeteSelect();
														
														

														$Val_Horaire = substr($horaire, 0, 2);
														$Requete = '
																SELECT id
																FROM horaire
																WHERE intitulehoraire LIKE"' .$Val_Horaire.'%"';
														$Bdd->setRequete($Requete);
														$Id_Horaire = $Bdd->RequeteSelect();

														if ($premium == "oui") {
															$Id_Formule = 1;
														} else {
															$Id_Formule = 0;
														}

														$Requete = "
															SELECT id
															FROM Sy_Recruteur
															WHERE id=" . $User[0]["id"];
														$Bdd->setRequete($Requete);
														$recruteurInfo1 = $Bdd->RequeteSelect();

														$Requete = "
															SELECT id
															FROM Sy_Employeur
															WHERE id=" . $User[0]["id"];
														$Bdd->setRequete($Requete);
														$recruteurInfo2 = $Bdd->RequeteSelect();

														if ($recruteurInfo1 != "kenini") {
															$Requete = '
																INSERT INTO `sy_annonce`(`id_niveau_souhaite_id`, `id_departement_id`, `id_recruteur_id`, `TitreAnnonce`, `DescriptifAnnonce`, `ProfilRecherche`, `Remuneration`, `DureeContrat`, `DateCreation`, `Suspension`, `GrandeVilleProche`, `Avantage`, `NbHeure`,`ReferenceRecruteur`, `DescriptionEmployeur`, `AdresseReponse`, `Premium`,`id_typecontrat_id`, `id_horaire_id`, `New`) VALUES 
																						(' . $Id_Niveau[0]['id'] . ',' . $Id_Dep[0]['id'] . ',' . $recruteurInfo[0]["id"] . ',"' . utf8_decode($Titre) . '","' . utf8_decode($Description) . '","' . utf8_decode($Profil) . '","' . utf8_decode($salaire) . '","' . utf8_decode($dureecontrat) . '","' . date("Y-m-d H:i:s") . '",-1,"' . utf8_decode($ville) . '","' . utf8_decode($avantages) . '","' . $nombreheure . '","' . utf8_decode($Reference) . '","' . utf8_decode($etablissement) . '","'  . utf8_decode($adressereponse) .'",'.  $Id_Formule . ',' . $Id_Contrat[0]['id'] . ',' . $Id_Horaire[0]['id'] . ',1)';
														} else {
															$Requete = '
																INSERT INTO `sy_annonce`(`id_niveau_souhaite_id`, `id_departement_id`, `TitreAnnonce`, `DescriptifAnnonce`, `ProfilRecherche`, `Remuneration`, `DureeContrat`, `DateCreation`, `Suspension`, `GrandeVilleProche`, `Avantage`, `NbHeure`,`ReferenceRecruteur`, `DescriptionEmployeur`, `AdresseReponse`, `Premium`,id_employeur_id,`id_typecontrat_id`, `id_horaire_id`, `New`) VALUES 
																						(' . $Id_Niveau[0]['id'] . ',' . $Id_Dep[0]['id'] .  ',"' . utf8_decode($Titre) . '","' . utf8_decode($Description) . '","' . utf8_decode($Profil) . '","' . utf8_decode($salaire) . '","' . utf8_decode($dureecontrat) . '","' . date("Y-m-d H:i:s") . '",-1,"' . utf8_decode($ville) . '","' . utf8_decode($avantages) . '","' . $nombreheure . '","' . utf8_decode($Reference) . '","' . utf8_decode($etablissement) . '","'  . utf8_decode($adressereponse) .'",'.  $Id_Formule . ',' . $recruteurInfo[0]["id"] .',' . $Id_Contrat[0]['id'] . ',' . $Id_Horaire[0]['id'] . ',1)';
														}
														$Bdd->setRequete($Requete);
														$Cannonce = $Bdd->RequeteUpDel();

														$Requete = '
																SELECT MAX(id)
																FROM sy_annonce';
														$Bdd->setRequete($Requete);
														$annonceFaite = $Bdd->RequeteSelect();
														
														$Requete = '
																SELECT id,id_site_emploi_id
																FROM Sy_fonction
																WHERE id =' . $fonction;
														$Bdd->setRequete($Requete);
														$Id_Fonction = $Bdd->RequeteSelect();

														$Requete = '
																INSERT INTO `sy_annonce_sy_siteemploi`(`id_annonce_id`, `id_siteemploi_id`, `id_fonction_id`) VALUES (' . $annonceFaite[0]['MAX(id)'] . ',' . $Id_Fonction[0]['id_site_emploi_id'] . ',' . $Id_Fonction[0]['id'] . ')';
													}
														$Bdd->setRequete($Requete);
														$CannonceSite = $Bdd->RequeteUpDel();

													$Retour = "Votre annonce a bien été enregistrée.";
												} else {
													$Retour = "Votre annonce n'a pas de fonction";
												}
											} else {
												$Retour = "Votre annonce n'a pas de type de contrat";
											}
										} else {
											$Retour = "Votre annonce n'a pas de département";
										}
									} else {
										$Retour = "Votre annonce n'a pas de ville";
									}
								} else {
									$Retour = "Votre annonce n'a pas de profil";
								}
							} else {
								$Retour = "Votre annonce n'a pas de description";
							}
						} else {
							$Retour = "Votre annonce n'a pas d'établissement";
						}
					} else {
						$Retour = "Votre annonce n'a pas de titre";
					}
				} else {
					$Retour = "Cette référence a déjà été utilisée";
				}
			} else {
				$Retour = "Vous n'êtes pas inscrit";
			}
		}
		return $Retour;
	}

}

try {
	$server = new SoapServer(null, array('uri' => 'http://www.recrutic.com/webservice/gestionAnnonce.php'));
	$server->setClass("XmlPE");
	$server->handle();
} catch (Exception $e) {
	return "Exception: " . $e;
}
?>