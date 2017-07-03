<?php


// src/OC/PlatformBundle/Controller/NewAdvertController.php


namespace OC\PlatformBundle\Controller;

use OC\PlatformBundle\Entity\Candidat;
use OC\PlatformBundle\Entity\Recruteur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use OC\PlatformBundle\Form\ParticulierType;
use OC\PlatformBundle\Form\SocieteType;
use Doctrine\ORM\Tools\Pagination\Paginator;
use OC\UserBundle\Repository\AnnonceRepository;
use Symfony\Component\DomCrawler\Crawler;
use Eko\FeedBundle\Hydrator\DefaultHydrator;
use OC\UserBundle\Entity\Sy_Annonce;
use Debril\RssAtomBundle\Protocol\FeedReader;
use OC\PlatformBundle\Form\AnnonceType;
use Doctrine\Common\Collections\ArrayCollection;
use OC\PlatformBundle\Form\TriAnnonceType;
use OC\PlatformBundle\Form\AjouterAnnonceType;
use OC\PlatformBundle\Form\SiteTestType;
use OC\PlatformBundle\Form\RechercheType;
use OC\PlatformBundle\Form\AnnonceSyType;



class NewAdvertController extends Controller
{
	
	//Ajouter une annonce
	public function ajoutAnnonceAction(Request $request){
		$annonce = new Sy_Annonce();//Création d'une nouvelle annonce
		$form = $this->createForm(AjouterAnnonceType::class, $annonce);//Creation d'un formulaire pour remplir cette annonce
		$erreur="";//Creation d'un message d'erreur vide
		$em = $this->getDoctrine()->getManager();//Fonction permettant de sauvegarder les données dans la base de données
		$user = $this->getUser()->getId();//Récupération de l'id du recruteur
		$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Recruteur');
		$recruteur = $repository->find($user);
		$session = $request->getSession();
		$this->sessionStop($session, 3);
		if ($request->isMethod('POST')) {//Vérification de la nature de la requete
			if ($form->handleRequest($request)->isValid()) {//Vérification de la validité des données du formulaire
				$annonce->setIdRecruteur($recruteur);
				$listeSite = $annonce->getSite();
				foreach ($site as $listeSite){
					$em->persist($site);	//Enregistrer les sites
				}
				$annonce->setNew(true);
				$em->persist($annonce);
				$em->flush();
				$erreur = "L'annonce a été validée";
				return $this->render('OCPlatformBundle:AdvertNew:AjoutAnnonceValide.html.twig');
		}else{
			$erreur = "L'annonce n'a pas été validée";
			return $this->render('OCPlatformBundle:AdvertNew:AjoutAnnonce.html.twig',array('form' => $form->createView(),'message' => $erreur));
		}}
		return $this->render('OCPlatformBundle:AdvertNew:AjoutAnnonce.html.twig',array('form' => $form->createView(),'message' => $erreur));
	}
	
	//Ajouter une annonce par un employeur
	public function ajoutAnnonceEmpAction(Request $request){
		$annonce = new Sy_Annonce();//Création d'une nouvelle annonce
		$form = $this->createForm(AjouterAnnonceType::class, $annonce);//Creation d'un formulaire pour remplir cette annonce
		$erreur="";//Creation d'un message d'erreur vide
		$em = $this->getDoctrine()->getManager();//Fonction permettant de sauvegarder les données dans la base de données
		$user = $this->getUser()->getId();//Récupération de l'id du recruteur
		$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Employeur');
		$employeur = $repository->find($user);
		$session = $request->getSession();
		$this->sessionStop($session, 3);
		if ($request->isMethod('POST')) {//Vérification de la nature de la requete
			if ($form->handleRequest($request)->isValid()) {//Vérification de la validité des données du formulaire
				$annonce->setIdEmployeur($employeur);
				$listeSite = $annonce->getSite();
				foreach ($site as $listeSite){
					$em->persist($site);
				}
				$em->persist($annonce);
				$em->flush();
				$erreur = "L'annonce a été validée";
				return $this->render('OCPlatformBundle:AdvertNew:AjoutAnnonceValide.html.twig');
		}else{
			$erreur = "L'annonce n'a pas été validée";
			return $this->render('OCPlatformBundle:AdvertNew:AjoutAnnonce.html.twig',array('form' => $form->createView(),'message' => $erreur));
		}}
		return $this->render('OCPlatformBundle:AdvertNew:AjoutAnnonce.html.twig',array('form' => $form->createView(),'message' => $erreur));
	}
	
	//Consulter ses annonces
	public function consultAnnonceAction(Request $request){
		$user = $this->getUser();
		$idUser = $user->getId();
		$repository2 = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Annonce');
		if(($user->getType())=="Recruteur" || ($user->getType())=="Admin"  ){
			$repository1 = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Recruteur');
			$recruteur = $repository1->find($idUser);
			$listeannonce = $repository2->getAnnonceByRecruteur($recruteur);
		}else{
			$repository1 = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Employeur');
			$recruteur = $repository1->find($idUser);
			$listeannonce = $repository2->getAnnonceByEmp($recruteur);
		}
		$paginator = $this->get('knp_paginator');
		$pagination = $paginator->paginate($listeannonce,$request->query->get('page', 1),20);
		return $this->render('OCPlatformBundle:Advert:ConsultAnnonce.html.twig',array('listecandidat'=>$listeannonce,'pagination' => $pagination));
	}
	
	
	//Modification des annonces new
	public function admin_Modif_Sy_AnnonceAction(Request $request,$idAnnonce){
		$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Annonce');
		$annonce = $repository->getUneAnnonce($idAnnonce);
		$erreur="";
		$session = $request->getSession();
		$annonce2 = $repository->find($idAnnonce);
		$listeSite = new ArrayCollection();
		foreach ($annonce2->getSite() as $site) {
			$listeSite->add($site);
		}
		$form = $this->createForm(AnnonceSyType::class, $annonce2);
		$em = $this->getDoctrine()->getManager();
		//On verifie que la requete est bien une requete POST
		if ($request->isMethod('POST')) {
			if ($form->handleRequest($request)->isValid()) {
				foreach($listeSite as $site){
					if (false === $annonce2->getSite()->contains($site)){
						$annonce2->getSite()->removeElement($site);
						
						$em->remove($site);
					}
				}
				$annonce2->setDateMAJ(new \DateTime('now'));
				$em->persist($annonce2);
				$em->flush();
				$erreur = "L'annonce a été validée";
			}
		}
		if ($session->get('listeAnnonce') == null){
			$retour = 1;
		}else{
			$retour = 2;
		}
		
		return $this->render('OCPlatformBundle:Admin:Admin_Modif_AnnonceNew.html.twig',array(
			'form' => $form->createView(),
			'id' => $idAnnonce,
			'annonce'=>$annonce,
			'message' => $erreur,
			'retour' => $retour));
	}
	
	//Supprimer les annonces new
	public function deleteSyAnnonceAction(Request $request,$idAnnonce) {
		if($idAnnonce != 0){
			$repository = $this->getDoctrine()->getManager();
			$annonce = $repository->getRepository('OCUserBundle:Sy_Annonce')->find($idAnnonce);
			$listeSite = $repository->getRepository('OCUserBundle:Sy_Annonce_Sy_Siteemploi')->getListeSite($idAnnonce);
			$em = $this->getDoctrine()->getManager();
			foreach ($listeSite as $site){
				$em->remove($site);
			}
			$em->remove($annonce);
			$em->flush();
		}
		$session = $request->getSession();
		$this->sessionStop($session, 3);
		$referer = $request->headers->get('referer');
		return $this->redirect($referer);
	}

	//Publier les annonces new
	public function validerSyAnnonceAction($idAnnonce,Request $request){
		$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Annonce');
		if($idAnnonce != 0){
			$annonce = $repository->find($idAnnonce);
			$annonce->setSuspension(10)->setDatepublication(new \DateTime('now'))->setDatefinpublication(new \DateTime('+2 month'));
			$em = $this->getDoctrine()->getManager();
			$em->persist($annonce);
			$em->flush();
		}		
		$session = $request->getSession();
		$this->sessionStop($session, 3);
		$referer = $request->headers->get('referer');
		return $this->redirect($referer);
	}
	
	//Dépublier les annonces new
	public function DevaliderSyAnnonceAction($idAnnonce,Request $request){
		$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Annonce');
		if($idAnnonce != 0){
			$annonce = $repository->find($idAnnonce);
			$annonce->setSuspension(-1)->setDatepublication(new \DateTime('0000-00-00'))->setDatefinpublication(new \DateTime('0000-00-00'));
			$em = $this->getDoctrine()->getManager();
			$em->persist($annonce);
			$em->flush();	
		}
		$session = $request->getSession();
		$this->sessionStop($session, 3);
		$referer = $request->headers->get('referer');
		return $this->redirect($referer);
	}
	
	
	public function SponsoriserAnnonceAction(Request $request,$idAnnonce){
		$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Annonce');
		if($idAnnonce != 0){
			$annonce = $repository->find($idAnnonce);
			$annonce->setPremium(1);
			$em = $this->getDoctrine()->getManager();
			$em->persist($annonce);
			$em->flush();	
		}
		$session = $request->getSession();
		$this->sessionStop($session, 3);
		$referer = $request->headers->get('referer');
		return $this->redirect($referer);
	}
	
	public function DeSponsoriserAnnonceAction(Request $request,$idAnnonce){
		$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Annonce');
		if($idAnnonce != 0){
			$annonce = $repository->find($idAnnonce);
			$annonce->setPremium(null);
			$em = $this->getDoctrine()->getManager();
			$em->persist($annonce);
			$em->flush();	
		}
		$session = $request->getSession();
		$this->sessionStop($session, 3);
		$referer = $request->headers->get('referer');
		return $this->redirect($referer);
	}
	
	function sessionStop($session,$id){
		if($id == 1){
			$session->set('listePublication', null);
			$session->set('liste', null);
			$session->set('candidat', null);
		}
		
		if($id == 2){
			$session->set('listeAnnonce', null);
			$session->set('liste', null);
			$session->set('candidat', null);
		}
		
		if($id == 3){
			$session->set('liste', null);
			$session->set('candidat', null);
			$session->set('listeAnnonce', null);
			$session->set('listePublication', null);

		}
	}
}