<?php


// src/OC/PlatformBundle/Controller/AdvertController.php


namespace OC\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use OC\PlatformBundle\Form\AnnonceType;
use Doctrine\Common\Collections\ArrayCollection;
use OC\PlatformBundle\Form\TriAnnonceType;
use OC\PlatformBundle\Form\RechercheType;

class AdvertController extends Controller
{
	public function admin_AnnonceAction(Request $request){
		$repository = $this->getDoctrine()->getManager()->getRepository('OCPlatformBundle:Annonce');
		$repository2 = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Annonce');
		$form = $this->createForm(TriAnnonceType::class); // formulaire de tri
		$form2 = $this->createForm(RechercheType::class); // Formulaire de recherche
		$session = $request->getSession();
		$this->sessionStop($session, 1);
		if ($session->get('listeAnnonce') == null) {
			$listeannonce = $repository->getAnnonce();
			$listeannonce2 = $repository2->getAnnonce();
			$listeannonce3 = new ArrayCollection(array_merge($listeannonce, $listeannonce2));
			$listeannonceF = $this->trieListe($listeannonce3);
			$session->set('listeAnnonce', $listeannonceF);
		}
		if ($request->isMethod('POST')) {
			if ($form->handleRequest($request)->isValid()) {
				$listeannonce3 = $this->ListeAnnonce($form);
				$listeannonceF = $this->trieListe($listeannonce3);
				$session->set('listeAnnonce', $listeannonceF);
			}
			if ($form2->handleRequest($request)->isValid()) {
				$recherche = $form2->get('Recherche')->getData();
				$listeannonce = $repository->getRecherche($recherche);
				$listeannonce2 = $repository2->getRecherche($recherche);
				$listeannonce3 = new ArrayCollection(array_merge($listeannonce, $listeannonce2));
				$listeannonceF = $this->trieListe($listeannonce3);
				$session->set('listeAnnonce', $listeannonceF);
			}
		}
		$liste = $session->get('listeAnnonce');
		$paginator = $this->get('knp_paginator');
		$pagination = $paginator->paginate($liste,$request->query->get('page', 1),20);
		return $this->render('OCPlatformBundle:Admin:Admin_Annonce.html.twig',array(
			'pagination' => $pagination,
			'form' => $form->createView(),
			'form2' => $form2->createView()));
	}
	
	// Page de modification des annonces old
	public function admin_Modif_AnnonceAction(Request $request,$idAnnonce){
		$repository = $this->getDoctrine()->getManager()->getRepository('OCPlatformBundle:Annonce');
		$annonce = $repository->getUneAnnonce($idAnnonce);
		$erreur="";
		$session = $request->getSession();
		$annonce2 = $repository->find($idAnnonce);
		$listeSite = new ArrayCollection();
		foreach ($annonce2->getSite() as $site) {	//Récupération des sites
			$listeSite->add($site);
		}
		$form = $this->createForm(AnnonceType::class, $annonce2);
		$em = $this->getDoctrine()->getManager();
		if ($request->isMethod('POST')) {
			if ($form->handleRequest($request)->isValid()) {
				foreach($listeSite as $site){
					if (false === $annonce2->getSite()->contains($site)){
						$annonce2->getSite()->removeElement($site);
						$em->remove($site);		//Suppresion des sites non désirés.
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
		return $this->render('OCPlatformBundle:Admin:Admin_Modif_Annonce.html.twig',array(
			'form' => $form->createView(),
			'id' => $idAnnonce,
			'annonce'=>$annonce,
			'message' => $erreur,
			'retour'	=> $retour));
	}
	
	//Suppresion d'une annonce
	public function deleteAction(Request $request,$idAnnonce) {
		if($idAnnonce != 0){
			$repository = $this->getDoctrine()->getManager();
			$annonce = $repository->getRepository('OCPlatformBundle:Annonce')->find($idAnnonce);
			$listeSite = $repository->getRepository('OCPlatformBundle:Annonce_Sy_Siteemploi')->getListeSite($idAnnonce);
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
	
	//Publier une annonce
	public function validerAnnonceAction($idAnnonce,Request $request){
		$repository = $this->getDoctrine()->getManager()->getRepository('OCPlatformBundle:Annonce');
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
	
	//Depublier une annonce
	public function DevaliderAnnonceAction($idAnnonce,Request $request){
		$repository = $this->getDoctrine()->getManager()->getRepository('OCPlatformBundle:Annonce');
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
	
	//Récupération seulement des annonces non publiées.
	public function PublicationAnnonceAction(Request $request){
		$repository = $this->getDoctrine()->getManager()->getRepository('OCPlatformBundle:Annonce');
		$repository2 = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Annonce');
		$form = $this->createForm(TriAnnonceType::class);
		$form2 = $this->createForm(RechercheType::class);

		$listeannonce = $repository->getSuspension(-1,null,null,null,null);
		$listeannonce2 = $repository2->getSuspension(-1,null,null,null,null);
		$listeannonce3 = new ArrayCollection(array_merge($listeannonce, $listeannonce2));
		$listeannonceF = $this->trieListe($listeannonce3);
			
		$form->handleRequest($request);
			if ($form->isSubmitted() && $form->isValid()) {
				$listeannonce3 = $this->ListeAnnonce($form);
				$listeannonceF = $this->trieListe($listeannonce3);	
			}
			
		$form2->handleRequest($request);
			if ($form2->isSubmitted() && $form2->isValid()) {
				$recherche = $form2->get('Recherche')->getData();
				$listeannonce = $repository->getRecherche($recherche);
				$listeannonce2 = $repository2->getRecherche($recherche);
				$listeannonce3 = new ArrayCollection(array_merge($listeannonce, $listeannonce2));
				$listeannonceF = $this->trieListe($listeannonce3);
			}
		
		$paginator = $this->get('knp_paginator');
		$pagination = $paginator->paginate($listeannonceF,$request->query->get('page', 1),20);
		return $this->render('OCPlatformBundle:Admin:Admin_Annonce.html.twig',array(
			'pagination' => $pagination,
			'form' => $form->createView(),
			'form2' => $form2->createView()));
	}
	
	public function SponsoriserAnnonceAction(Request $request,$idAnnonce){
		$repository = $this->getDoctrine()->getManager()->getRepository('OCPlatformBundle:Annonce');
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
		$repository = $this->getDoctrine()->getManager()->getRepository('OCPlatformBundle:Annonce');
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
	
	function trieListe($liste){
		$listeannonce = new ArrayCollection();
		$tmp = new ArrayCollection();
		$tmp2 = new ArrayCollection();
		foreach ($liste as $annonce){
			$tmp->add($annonce);
		}
		foreach ($tmp as $annonce){
			if($annonce->getNew() == 1){
				$listeannonce->add($annonce);
			}else{
				$tmp2->add($annonce);
			}
		}
			foreach ($tmp2 as $annonce){
				$listeannonce->add($annonce);
			}
		return $listeannonce;
	}
	
	function ListeAnnonce($form){
		$repository = $this->getDoctrine()->getManager()->getRepository('OCPlatformBundle:Annonce');
		$repository2 = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Annonce');
		$date = $form->get('Date')->getData();		
		$premium = $form->get('Premium')->getData();
		$site = $form->get('Site')->getData();
		$departement = $form->get('Departement')->getData();
		$suspension = $form->get('Suspension')->getData();
		$listeannonce = $repository->getSuspension($suspension,$date,$premium,$site,$departement);
		$listeannonce2 = $repository2->getSuspension($suspension,$date,$premium,$site,$departement);
		$listeannonce3 = new ArrayCollection(array_merge($listeannonce, $listeannonce2));
		
		return $listeannonce3;
	}
	
	function sessionStop($session,$id){
		if($id == 1){
			$session->set('listePublication', null);
			$session->set('liste', null);
			$session->set('candidat', null);
			$session->set('fonction', null);
		}
		
		if($id == 2){
			$session->set('listeAnnonce', null);
			$session->set('liste', null);
			$session->set('candidat', null);
			$session->set('fonction', null);
		}
		
		if($id == 3){
			$session->set('liste', null);
			$session->set('candidat', null);
			$session->set('listeAnnonce', null);
			$session->set('listePublication', null);
			$session->set('fonction', null);

		}
	}
}