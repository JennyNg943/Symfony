<?php

use SoapServer;
use OC\UserBundle\Entity\Sy_Annonce;

class XmlPE 
{
	public function CreationAnnonceWs($FichierXml){
		$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Recruteur');
		$repository2 = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Annonce');
		$repository3 = $this->getDoctrine()->getManager()->getRepository('OCPlatformBundle:Departement');
		$repository4 = $this->getDoctrine()->getManager()->getRepository('OCPlatformBundle:TypeContrat');
		$repository5 = $this->getDoctrine()->getManager()->getRepository('OCPlatformBundle:Niveausouhaite');
		$repository6 = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Fonction');
		$repository7 = $this->getDoctrine()->getManager()->getRepository('OCPlatformBundle:Horaire');
		$repository8 = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:User');
		
		$annonceFlux = simplexml_load_file($FichierXml); 
		
        for ($i = 0; $i < sizeof($annonceFlux->jobs->job); $i++) {
			// get content
			$Reference = $annonceFlux->jobs->job[$i]->reference;
			$Login = $annonceFlux->jobs->job[$i]->login;
			$user = $repository8->findOneByEmail($Login);
			$recruteurInfo = $repository->find($user->getId());
			$annonceDoublon = $repository2->getAnnonceDoublon($Login,$Reference);
			$recruteurLogin = $user->getEmail();
			$Retour = "Je suis pas entrée ici,je crois";
			if($recruteurLogin != null){
				if ($annonceDoublon == null) { 
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
								
						if($Titre!=""){
							if($etablissement!=""){
								if($Description!=""){
									if($Profil!=""){
										if($ville!=""){
											if($departement!=""){
												if($contrat!=""){
													if($fonction!=""){
														if($horaire!=""){
															$Val_Departement = substr($departement, 0, 2);
															$Id_Dep = $repository3->findOneByNum($Val_Departement);
															$Id_Contrat = $repository4->findOneByIntituletypecontrat($contrat);		
															$Id_Niveau = $repository5->findOneByIntituleniveausouhaite($niveau);			
															$Id_Fonction = $repository6->findOneByIntitulefonction($fonction);
															$Site = $Id_Fonction->getIdSiteEmploi();
															$Id_Horaire = $repository7->findOneByIntitulehoraire($horaire);
														
															if($premium=="oui"){ 
																/*if($recruteurPremium==false){
																	$MsgPremium = "
																				Vous avez demandé à passer votre annonce en premium, malheureusement vous n'avez pas de crédit premium. 
																				Elle sera donc diffusée selon notre formule gratuite. 
																				<br/>
																				<br/>
																				Si vous souhaitez connaitre le détail de nos formules et souscrire à l'une d'elle, nous vous invitons à visiter notre site, ou à nous contacter directement au 04 81 65 14 00 ou par mail à l'adresse contact@recrutic.com.
																			";
																}else{
																	$Id_Formule=1;
																}*/
																$Id_Formule=1;
															}
																$Fonction = new \OC\UserBundle\Entity\Sy_Annonce_Sy_Siteemploi;	
																$Fonction->setIdFonction($Id_Fonction);	
																$Fonction->setIdSiteemploi($Site);
																
																$Cannonce = new Sy_Annonce();
																$Cannonce->setTitreAnnonce($Titre);
																$Cannonce->setDescriptifannonce($Description);
																$Cannonce->setProfilRecherche($Profil);
																$Cannonce->setIdTypecontrat($Id_Contrat);
																$Cannonce->setDureeContrat($dureecontrat);
																$Cannonce->setIdNiveauSouhaite($Id_Niveau);
																$Cannonce->setRemuneration($salaire);
																$Cannonce->setAvantage($avantages);
																$Cannonce->setIdDepartement($Id_Dep);
																$Cannonce->setIdRecruteur($recruteurInfo);
																$Cannonce->setidHoraire($Id_Horaire);
																$Cannonce->setNbHeure($nombreheure);
																$Cannonce->setGrandevilleproche($ville);
																$Cannonce->setReferenceRecruteur($Reference);
																$Cannonce->setDescriptionEmployeur($etablissement);
																$Cannonce->setDescriptionRecruteurProfil($recruteur);
																$Cannonce->setIdFormule($Id_Formule);
																$Cannonce->setAdresseReponse($adressereponse);
																$Cannonce->addSite($Fonction);
																	
																$em = $this->getDoctrine()->getManager();
																$em->persist($Cannonce);
																$em->flush();
																
																/*$Retour["exec"]= true;
																$Retour["message"]=("L'annonce a bien été enregistrée. Elle a été transmise à nos relecteurs et sera en ligne dans quelques heures. ($fonction)");
																$Retour["url"]="http://www.recrutic.com/nos-offres-d-emploi/";

																$headers ='From: "Recrutic.com"<contact@recrutic.com>'."\n";
																$headers .='Reply-To: '.$ResultRecruteur[0]["MailComm_login"]."\n";
																$headers .='Content-Type: text/html; charset="iso-8859-1"'."\n";
																$headers .='Content-Transfer-Encoding: 8bit';
																		
																		$headersRecruteur ='From: "Recrutic.com"<contact@recrutic.com>'."\n";
																		$headersRecruteur .='Reply-To: contact@recrutic.com'."\n";
																		$headersRecruteur .='Content-Type: text/html; charset="iso-8859-1"'."\n";
																		$headersRecruteur .='Content-Transfer-Encoding: 8bit';
																		$MessageAdmin = "
																			<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
																			<html xmlns='http://www.w3.org/1999/xhtml'>
																				<head>
																					<title></title>
																					<meta http-equiv='Content-Type' content='text/html;' charset=ISO-8859-1'/>
																				</head>
																				<body style='font-family: verdana;font-size:12px;'>
																					<div style='padding-left:10px;'>
																						<br/>
																						<br/>
																						Bonjour, 
																						<br/>
																						<br/>
																						Une nouvelle annonce EN MODE GRATUIT vient d'etre publiée par ". $ResultRecruteur[0]["Societe"]." : <strong>".$Titre."</strong>. 
																						<br/>
																						<br/>
																						
																						Cordialement, 
																						<br/>
																						Alexandre.
																					</div>
																				</body>
																			</html>
																		";
																		$MessageRecruteur = "
																			<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
																			<html xmlns='http://www.w3.org/1999/xhtml'>
																				<head>
																					<title>Nouvelle annonce</title>
																					<meta http-equiv='Content-Type' content='text/html;' charset=ISO-8859-1'/>
																				</head>
																				<body style='font-family: verdana;font-size:12px;'>
																					<div style='padding-left:10px;'>
																						<br/>
																						<br/>
																						Bonjour, 
																						<br/>
																						<br/>
																						Vous venez de diffuser une annonce sur notre site : <strong>".$Titre."</strong>.
																						<br/>
																						Nous l'avons bien reçu, elle est en ce moment en train d'être relue par notre équipe de modérateurs et sera rapidement en ligne.
																						<br/>
																						$MsgPremium
																						<br/>
																						Une fois validée, votre annonce sera visible à cette adresse : http://www.recrutic.com/nos-offres-d-emploi/
																						<br/>
																						
																						Cordialement,
																						<br/>
																						<br/>
																						<img src='http://www.recrutic.com/images/Logo-Recrutic.png'/>
																						<br/>
																						Le service Recrutic.com.<br/>
																						Tel : 04 81 65 14 00
																						
																					</div>
																				</body>
																			</html>
																		";
																		if($ResultRecruteur[0]["ReceptionMailConfirmation"]==1){ //Si le recruteur veut recevoir les mails alors lui envoi
																			mail($ResultRecruteur[0]["MailComm_login"],"Recrutic.com, votre annonce est bien enregistrée.",$MessageRecruteur,$headersRecruteur);
																		}*/
																	} else {
																		$Retour="Aucune référence trouvée dans le flux";
																	}
																}else {
																	$Retour="Aucune référence trouvée dans le flux";
																}
															}else {
																$Retour="Aucune référence trouvée dans le flux";
															}
														}else {
															$Retour="Aucune référence trouvée dans le flux";
														}
													}else {
														$Retour="Aucune référence trouvée dans le flux";
													}
												}else {
													$Retour="Aucune référence trouvée dans le flux";
												}
											}else {
												$Retour="Aucune référence trouvée dans le flux";
											}
										}else {
											$Retour="Aucune référence trouvée dans le flux";
										}
						}else{
							$Retour="Aucune référence trouvée dans le flux";
						}
					}else{
						$Retour="Aucune référence trouvée dans le flux";
					}
				}
		}
		return $this->render('OCPlatformBundle:Advert:FluxRss.html.twig',array(
			'reponse'=>$Retour
		));
	}
		
	
	}
	try{
		$server = new SoapServer(null, array('uri' => 'http://www.recrutic.com/webservice/gestionAnnonce2.php'));
		$server->setClass("XmlPE");
		$server->handle();
	}catch(Exception $e){
		return "Exception: " . $e;
	}
?>