<?php


// src/OC/PlatformBundle/Controller/NewAdvertController.php


namespace OC\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use OC\UserBundle\Entity\Sy_Annonce;
use Doctrine\Common\Collections\ArrayCollection;
use OC\PlatformBundle\Form\AjouterAnnonceType;
use OC\PlatformBundle\Form\AnnonceSyType;



class NewAdvertController extends Controller
{
	
	//Ajouter une annonce
	public function ajoutAnnonceAction(Request $request){
		$annonce = new Sy_Annonce();
		$form = $this->createForm(AjouterAnnonceType::class, $annonce);
		$erreur="";
		$em = $this->getDoctrine()->getManager();
		$user = $this->getUser();
		if ($user->getType() == "Employeur"){
			$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Employeur');
			$recruteur = $repository->find($user->getId());
			$annonce->setIdEmployeur($recruteur);
		}else{
			$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Recruteur');
			$recruteur = $repository->find($user->getId());
			$annonce->setIdRecruteur($recruteur);
		}
		if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
			$listeSite = $annonce->getSite();
			foreach ($site as $listeSite){
				$em->persist($site);	
			}
			$annonce->setNew(true);
			$em->persist($annonce);
			$em->flush();
			$erreur = "L'annonce a été validée";
			return $this->render('OCPlatformBundle:AdvertNew:AjoutAnnonceValide.html.twig');
		}
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
		return $this->render('OCPlatformBundle:Admin:Admin_Modif_AnnonceNew.html.twig',array(
			'pagination' => $pagination,
			'message' => $erreur,
			'url'	=>$url
			));
		
	}
	
	public function modifAction($id,Request $request){
		$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Annonce');
		$erreur="";
		$annonce2 = $repository->find($id);
		if($annonce2 != null){
			
			$form = $this->createForm(AnnonceSyType::class, $annonce2);
			
			
			return $this->render('OCPlatformBundle:AdvertNew:Form.html.twig',array(
				'form' => $form->createView(),
				'annonce'=>$annonce2));
		}else{
			$session = $request->getSession();
			$url = $session->get('url');
			return $this->redirect($url);
		}
	}
	
	public function modifOkAction($id){
		$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Annonce');
		$erreur="";
		$annonce2 = $repository->find($id);
		$em = $this->getDoctrine()->getManager();
		$listeSite = new ArrayCollection();
		foreach ($annonce2->getSite() as $site) {	//Récupération des sites
			$listeSite->add($site);
		}
		foreach($listeSite as $site){
			if (false === $annonce2->getSite()->contains($site)){
				$annonce2->getSite()->removeElement($site);
				$em->remove($site);		//Suppresion des sites non désirés.
			}
		}
			$annonce2->setDateMAJ(new \DateTime('now'))->setTitreAnnonce($request->get('annonce[TitreAnnonce]'));
			$em->persist($annonce2);
			$em->flush();
			
			echo "Annonce Ok";
			
		}
	
	
	//Supprimer les annonces new
	public function deleteSyAnnonceAction(Request $request,$idAnnonce) {
		$repository = $this->getDoctrine()->getManager();
		$annonce = $repository->getRepository('OCUserBundle:Sy_Annonce')->find($idAnnonce);
		$listeSite = $repository->getRepository('OCUserBundle:Sy_Annonce_Sy_Siteemploi')->getListeSite($idAnnonce);
		$em = $this->getDoctrine()->getManager();
		foreach ($listeSite as $site){
			$em->remove($site);
		}
		$em->remove($annonce);
		$em->flush();
		$referer = $request->headers->get('referer');
		return $this->redirect($referer);
	}

	//Publier les annonces new
	public function validerSyAnnonceAction($idAnnonce,Request $request){
		$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Annonce');
		$annonce = $repository->find($idAnnonce);
		$annonce->setSuspension(10)->setDatepublication(new \DateTime('now'))->setDatefinpublication(new \DateTime('+2 month'));
		$em = $this->getDoctrine()->getManager();
		$em->persist($annonce);
		$em->flush();
		$recruteur = $annonce->getIdRecruteur();
		if($recruteur == null){
			$recruteur = $annonce->getIdEmployeur();
		}
		
		$message = \Swift_Message::newInstance()
				->setSubject("RECRUTIC - Validation de l\'annonce - ".$annonce->getReference())
				->setFrom("support@recrutic.com")
				->setTo($recruteur->getEmail())
				->setBody("Votre annonce de référence ".$annonce->getReference()." a été validée par nos services.\n"
						. "Titre de l\'annonce : ".$annonce->getTitreannonce()."\n"
						. "Lieu : ".$annonce->getGrandeVilleProche()." (".$annonce->getIdDepartement()."\n"
						. "Si vous souhaitez modifier des éléments, vous pouvez vous rendre dans votre espace. Pour toute information concernant cette annonce, préciser la référence de celle-ci.\n \n"
						. "Besoin de plus de visibilité ? Pensez au mode premium ! \n"
						. "Pour en savoir plus, rendez vous dans votre espace ou téléphonez nous au 04 69 85 66 50. \n"
						. "\n Cordialement, \n"
						. "Le support de Recrutic."
	
			
		);
			$this->get('mailer')->send($message);
		
		
		
		$referer = $request->headers->get('referer');
		return $this->redirect($referer);
	}
	
	//Dépublier les annonces new
	public function DevaliderSyAnnonceAction($idAnnonce,Request $request){
		$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Annonce');
		$annonce = $repository->find($idAnnonce);
		$annonce->setSuspension(-1)->setDatepublication(new \DateTime('0000-00-00'))->setDatefinpublication(new \DateTime('0000-00-00'));
		$em = $this->getDoctrine()->getManager();
		$em->persist($annonce);
		$em->flush();	
		$referer = $request->headers->get('referer');
		return $this->redirect($referer);
	}
	
	
	public function SponsoriserAnnonceAction(Request $request,$idAnnonce){
		$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Annonce');
		$annonce = $repository->find($idAnnonce);
		$annonce->setPremium(1);
		$em = $this->getDoctrine()->getManager();
		$em->persist($annonce);
		$em->flush();	
		$referer = $request->headers->get('referer');
		return $this->redirect($referer);
	}
	
	public function DeSponsoriserAnnonceAction(Request $request,$idAnnonce){
		$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Annonce');
		$annonce = $repository->find($idAnnonce);
		$annonce->setPremium(null);
		$em = $this->getDoctrine()->getManager();
		$em->persist($annonce);
		$em->flush();	
		$referer = $request->headers->get('referer');
		return $this->redirect($referer);
	}
	
	public function suspendreAction($id){
		$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Annonce');
		$annonce = $repository->find($id);
		$annonce->setSuspension(11);
		$em = $this->getDoctrine()->getManager();
		$em->persist($annonce);
		$em->flush();
		
		$referer = $request->headers->get('referer');
		return $this->redirect($referer);
	}
	
	public function desuspendreAction($id){
		$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Annonce');
		$annonce = $repository->find($id);
		$annonce->setSuspension(-1);
		$em = $this->getDoctrine()->getManager();
		$em->persist($annonce);
		$em->flush();
		
		$referer = $request->headers->get('referer');
		return $this->redirect($referer);
	}
}