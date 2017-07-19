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
		$listeannonce = $repository->getAnnonce();
		$listeannonce2 = $repository2->getAnnonce();
		$session = $request->getSession();
		$session->set('url',$request->getUri());
		
		$form->handleRequest($request);
			if ($form->isSubmitted() && $form->isValid()) {
				$date = $form->get('Date')->getData();		
				$premium = $form->get('Premium')->getData();
				$site = $form->get('Site')->getData();
				$departement = $form->get('Departement')->getData();
				$suspension = $form->get('Suspension')->getData();
				$listeannonce = $repository->getSuspension($suspension,$date,$premium,$site,$departement);
				$listeannonce2 = $repository2->getSuspension($suspension,$date,$premium,$site,$departement);
			}
			
		$form2->handleRequest($request);
			if ($form2->isSubmitted() && $form2->isValid()) {	
				$recherche = $form2->get('Recherche')->getData();
				$listeannonce = $repository->getRecherche($recherche);
				$listeannonce2 = $repository2->getRecherche($recherche);
				
			}
		
		$listeannonce3 = new ArrayCollection(array_merge($listeannonce, $listeannonce2));
		$listeannonceF = $this->trieListe($listeannonce3);
		
		$session->set('liste',$listeannonceF);
		$paginator = $this->get('knp_paginator');
		$pagination = $paginator->paginate($listeannonceF,$request->query->get('page', 1),20);
		return $this->render('OCPlatformBundle:Admin:Admin_Annonce.html.twig',array(
			'pagination' => $pagination,
			'form' => $form->createView(),
			'form2' => $form2->createView()));
	}
	
	// Page de modification des annonces old
	public function admin_Modif_AnnonceAction(Request $request,$idAnnonce){
			$repository = $this->getDoctrine()->getManager()->getRepository('OCPlatformBundle:Annonce');
			$erreur="";
			$annonce2 = $repository->find($idAnnonce);
			$session = $request->getSession();
			$url = $session->get('url');
			$liste = $session->get('liste');
			$i = 1;
			foreach($liste as $l){
				if($l->getId() == $annonce2->getId()){
					$j = $i;
				}
				$i = $i+1;
			}
			$paginator = $this->get('knp_paginator');
			$pagination = $paginator->paginate($liste,$request->query->get('page', $j),1);
			
			return $this->render('OCPlatformBundle:Admin:Admin_Modif_Annonce.html.twig',array(
				'message' => $erreur,
				'url'	=> $url,
				'pagination'=> $pagination
				));
	}
	
	public function modifAction($id,Request $request){
		$repository = $this->getDoctrine()->getManager()->getRepository('OCPlatformBundle:Annonce');
		$annonce2 = $repository->find($id);
		
			$listeSite = new ArrayCollection();
			foreach ($annonce2->getSite() as $site) {	//Récupération des sites
				$listeSite->add($site);
			}
			$form = $this->createForm(AnnonceType::class, $annonce2, array(
				'action' => $this->generateUrl('modif',array('id'=>$annonce2->getId()))));
			$em = $this->getDoctrine()->getManager();
			if ($request->isMethod('POST')) {
			$form->handleRequest($request);
			if ($form->isValid()) {
				
				foreach($listeSite as $site){
					if (false === $annonce2->getSite()->contains($site)){
						$annonce2->getSite()->removeElement($site);
						$em->remove($site);		//Suppresion des sites non désirés.
					}
				}
				$annonce2->setDateMAJ(new \DateTime('now'));
				$em->persist($annonce2);
				$em->flush();
				return $this->redirectToRoute('admin_modif_annonce',array('idAnnonce'=>$annonce2->getId()));	
				}else{
					$session = $request->getSession();
					$url = $session->get('url');
					$liste = $session->get('liste');
					$i = 1;
					foreach($liste as $l){
						if($l->getId() == $annonce2->getId()){
							$j = $i;
						}
						$i = $i+1;
					}

					$paginator = $this->get('knp_paginator');
					$pagination = $paginator->paginate($liste,$request->query->get('page', $j),1);
					return $this->render('OCPlatformBundle:Advert:FormSite.html.twig',array(
						'pagination' => $pagination,
						'url'	=>$url,
						'form'	=> $form->createView()
						));
					}
			}	
		
		return $this->render('OCPlatformBundle:Advert:Form.html.twig',array(
				'form' => $form->createView(),
				'annonce'=>$annonce2));
	}
	
	
	//Suppresion d'une annonce
	public function deleteAction(Request $request,$idAnnonce) {
		$repository = $this->getDoctrine()->getManager();
		$annonce = $repository->getRepository('OCPlatformBundle:Annonce')->find($idAnnonce);
		$listeSite = $repository->getRepository('OCPlatformBundle:Annonce_Sy_Siteemploi')->getListeSite($idAnnonce);
		$em = $this->getDoctrine()->getManager();
		foreach ($listeSite as $site){
			$em->remove($site);
		}
		$em->remove($annonce);
		$em->flush();
		$session = $request->getSession();
		$url = $session->get('url');
		return $this->redirect($url);
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
		$referer = $request->headers->get('referer');
		return $this->redirect($referer);
	}
	
	public function rejetAction($id,Request $request){
		$repository = $this->getDoctrine()->getManager()->getRepository('OCPlatformBundle:Annonce');
		$annonce = $repository->find($id);
		if ($annonce == null){
			$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Annonce');
			$annonce = $repository->find($id);
		}
		$annonce->setSuspension(30);
		$em = $this->getDoctrine()->getManager();
		$em->persist($annonce);
		$em->flush();	
		$referer = $request->headers->get('referer');
		return $this->redirect($referer);
	}
	
	//Depublier une annonce
	public function DevaliderAnnonceAction($idAnnonce,Request $request){
		$repository = $this->getDoctrine()->getManager()->getRepository('OCPlatformBundle:Annonce');
		$annonce = $repository->find($idAnnonce);
		$annonce->setSuspension(-1)->setDatepublication(new \DateTime('0000-00-00'))->setDatefinpublication(new \DateTime('0000-00-00'));
		$em = $this->getDoctrine()->getManager();
		$em->persist($annonce);
		$em->flush();	
		$referer = $request->headers->get('referer');
		return $this->redirect($referer);
	}
	
	//Récupération seulement des annonces non publiées.
	public function PublicationAnnonceAction(Request $request){
		$repository = $this->getDoctrine()->getManager()->getRepository('OCPlatformBundle:Annonce');
		$repository2 = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Annonce');
		$form = $this->createForm(TriAnnonceType::class);
		$form2 = $this->createForm(RechercheType::class);
		$session = $request->getSession();
		$session->set('url',$request->getUri());
		$listeannonce = $repository->getSuspension(-1,null,null,null,null);
		$listeannonce2 = $repository2->getSuspension(-1,null,null,null,null);
		
			
		$form->handleRequest($request);
			if ($form->isSubmitted() && $form->isValid()) {
				$date = $form->get('Date')->getData();		
				$premium = $form->get('Premium')->getData();
				$site = $form->get('Site')->getData();
				$departement = $form->get('Departement')->getData();
				$suspension = $form->get('Suspension')->getData();
				$listeannonce = $repository->getSuspension($suspension,$date,$premium,$site,$departement);
				$listeannonce2 = $repository2->getSuspension($suspension,$date,$premium,$site,$departement);
			}
			
		$form2->handleRequest($request);
			if ($form2->isSubmitted() && $form2->isValid()) {
				$recherche = $form2->get('Recherche')->getData();
				$listeannonce = $repository->getRecherche($recherche);
				$listeannonce2 = $repository2->getRecherche($recherche);
			}
		$listeannonce3 = new ArrayCollection(array_merge($listeannonce, $listeannonce2));
		$listeannonceF = $this->trieListe($listeannonce3);
		$session->set('liste',$listeannonceF);
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
	
	
}