<?php


// src/OC/PlatformBundle/Controller/DefaultController.php


namespace OC\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use OC\PlatformBundle\Form\TriSiteType;
use Doctrine\Common\Collections\ArrayCollection;
use OC\PlatformBundle\Form\ContactType;


class DefaultController extends Controller
{
	//Page d'accueil
    public function indexAction(Request $request)
    {
		$repository = $this->getDoctrine()->getManager()->getRepository('OCPlatformBundle:Sy_Premium');
		$premium = $repository->findAll();
		$date = new \DateTime('now');
		$em = $this->getDoctrine()->getManager();
		foreach ($p as $premium){
			if($p->getDateFin()==$date){
				$em->remove($p);
			}
		}
		$em->flush();
        $content = $this
			->get('templating')
			->render('OCPlatformBundle:Default:index.html.twig');
		return new Response($content);
    }
	
	//Route pour la page Déposer un CV
	public function CVthequeAction(Request $request)
    {
		$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_CvTheque');
		$form = $this->createForm(TriSiteType::class);
		$candidat = $repository->getCVThequeTrie(null,null);

		$form->handleRequest($request);
			if ($form->isSubmitted() && $form->isValid()) {
				$site = $form->get('Domaine')->getData();
				$dept = $form->get('Departement')->getData();
				
				$candidat = $repository->getCVThequeTrie($site,$dept);
				
			}	
		
		$paginator = $this->get('knp_paginator');
		$pagination = $paginator->paginate(
		$candidat,
		$request->query->get('page',1),50
		);
		
        return $this->render('OCPlatformBundle:Default:CVTheque.html.twig',array(
			'pagination' => $pagination,
			'form' => $form->createView()));
    }
	
	public function CVthequeUserAction(Request $request)
    {
		$user = $this->getUser();
		$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_CvTheque');
		$repository2 = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Recruteur');
		$recruteur = $repository2->find($user->getId());
		if($recruteur == null){
			$repository3 = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Employeur');
			$recruteur = $repository3->find($user->getId());
		}
		$form = $this->createForm(TriSiteType::class);
		$candidat = $repository->getCVThequeTrie(null,null);

		$form->handleRequest($request);
			if ($form->isSubmitted() && $form->isValid()) {
				$site = $form->get('Domaine')->getData();
				$dept = $form->get('Departement')->getData();	
				$candidat = $repository->getCVThequeTrie($site,$dept);	
			}	
		$paginator = $this->get('knp_paginator');
		$pagination = $paginator->paginate(
		$candidat,
		$request->query->get('page',1),50
		);
        return $this->render('OCPlatformBundle:Default:CVThequeUser.html.twig',array(
			'pagination' => $pagination,
			'form' => $form->createView(),
			'utilisateur'	=> $recruteur));
    }
	
	//Route pour la page Nos Offre d'emploi
	public function NosOffresDEmploiAction(Request $request)
    {
		$repository = $this->getDoctrine()->getManager()->getRepository('OCPlatformBundle:Annonce');//Recup annonce old
		$repository2 = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Annonce');//Recup annonce new
		$form = $this->createForm(TriSiteType::class);
		$listeannonce = $repository->getSite(null,null);
		$listeannonce2 = $repository2->getSite(null,null);
			
		$form->handleRequest($request);
			if ($form->isSubmitted() && $form->isValid()) {
				$site = $form->get('Domaine')->getData();
				$dept = $form->get('Departement')->getData();
				$listeannonce = $repository->getSite($site,$dept);
				$listeannonce2 = $repository2->getSite($site,$dept);
				
			}
		
		$listeannonce3 = new ArrayCollection(array_merge($listeannonce, $listeannonce2));
		$listeannonceF = $this->trieListe($listeannonce3);
		
		$paginator = $this->get('knp_paginator');
		$pagination = $paginator->paginate(
		$listeannonceF,
		$request->query->get('page',1),10
		);
		return $this->render('OCPlatformBundle:Default:NosOffresDEmploi.html.twig',array(
			'pagination' => $pagination,
			'form' => $form->createView()
			));
    }
	
	//Ma page + Verification de l'identité de l'utilisateur
	public function MaPageAction(Request $request)
    {
		$user = $this->getUser();
		$repositoryAnnonce = $this->getDoctrine()->getManager()->getRepository('OCPlatformBundle:Annonce');
		$repositorySyAnnonce = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Annonce');
		if(($type = $user->getType())=="Candidat"){	
			$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Candidature');
			$utilisateur = $repository->find($user->getId());
			$annonce = $repositoryAnnonce->getAnnonceByCandidat($utilisateur);
			$annonce2 = $repositorySyAnnonce->getAnnonceByCandidat($utilisateur);
		}
		if(($type = $user->getType())=="Recruteur"){
			$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Recruteur');
			$utilisateur = $repository->find($user->getId());
			$annonce = $repositorySyAnnonce->getAnnonceRecruteur($utilisateur);
		}
		if(($type = $user->getType())=="Admin"){
			$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Recruteur');
			$utilisateur = $repository->find($user->getId());
			$annonce = $repositorySyAnnonce->getAnnonceRecruteur($utilisateur);
		}
		if(($type = $user->getType())=="Employeur"){
			$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Employeur');
			$utilisateur = $repository->find($user->getId());
			$annonce = $repositorySyAnnonce->getAnnonceEmp($utilisateur);
		}
			return $this->render('OCPlatformBundle:Default:MaPage.html.twig',array('utilisateur'=>$utilisateur,'listeannonce'=>$annonce,'listeannonce2'=>$annonce2));
    }
	
	public function AProposAction(Request $request){
		$content = $this
			->get('templating')
			->render('OCPlatformBundle:Default:APropos.html.twig');
		return new Response($content);
	}
	
	public function ContactAction(Request $request){
		
		
		$form = $this->createForm(ContactType::class);
		if ($request->isMethod('POST')) {
			if ($form->handleRequest($request)->isValid()) {
				$message = \Swift_Message::newInstance()
						->setSubject($form->get('Sujet')->getData())
						->setFrom($form->get('Mail')->getData())
						->setTo('a.bouteille@maneom.com')
						->setBody($form->get('Message')->getData());
					$this->get('mailer')->send($message);
				return $this->render('OCPlatformBundle:Candidat:EnvoiOk.html.twig');	
			}
		}

		return $this->render('OCPlatformBundle:Default:Contact.html.twig',array('form'=>$form->createView()));
	}
	
	
	function trieListe($liste){
		$listeannonce = new ArrayCollection();
		$tmp = new ArrayCollection();
		$tmp2 = new ArrayCollection();
		foreach ($liste as $annonce){
			if(($annonce->getPremium())==1){
				$listeannonce->add($annonce);
			}else{
				$tmp->add($annonce);
			}
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