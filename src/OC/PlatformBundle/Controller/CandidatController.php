<?php


// src/OC/PlatformBundle/Controller/CandidatController.php


namespace OC\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use OC\UserBundle\Form\CandidatType;
use OC\PlatformBundle\Form\TriCandidatType;
use OC\PlatformBundle\Form\CVThequeModifType;
use OC\PlatformBundle\Form\ContactCandidatType;
use Doctrine\Common\Collections\ArrayCollection;

class CandidatController extends Controller
{
	//Affichage des candidats pour l'administrateur
	public function admin_CandidatAction(Request $request){
		$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Candidature');
		$listecandidat = $repository->getCandidat();
		$form = $this->createForm(TriCandidatType::class);
		
		if ($request->isMethod('POST')) {
			if ($form->handleRequest($request)->isValid()) {
				$site = $form->get('Site')->getData();		
				$departement = $form->get('Departement')->getData();
				$fonction = $form->get('Fonction')->getData();
				$listecandidat = $repository->getCandidatTri($site,$departement,$fonction);
			}
			
		}
		
		
		$paginator = $this->get('knp_paginator');
		$pagination = $paginator->paginate($listecandidat,$request->query->get('page', 1),20);
		
		
		return $this->render('OCPlatformBundle:Admin:Admin_Candidat.html.twig',array('listecandidat'=>$listecandidat,'pagination' => $pagination,'form'=>$form->createView()));
	}
	
	//Consultation des annonces des candidats
	public function CandidatureConsultationAction(Request $request){
		$user = $this->getUser()->getId();
		$repository = $this->getDoctrine()->getManager()->getRepository('OCPlatformBundle:Annonce');
		$listeannonce = $repository->getAnnonceCandidature($user);
		$paginator = $this->get('knp_paginator');
		$pagination = $paginator->paginate($listeannonce,$request->query->get('page', 1),20);
		
		
		
		return $this->render('OCPlatformBundle:Candidat:CandidatureConsultation.html.twig',array('pagination'=>$pagination));
	}
	
	//Modifier un candidat
	public function candidatModifAction(Request $request){
		$user = $this->getUser();
		$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Candidature');
		$candidat = $repository->find($user->getId());
		$form = $this->createForm(CandidatType::class,$candidat);
		
		if ($request->isMethod('POST')) {
			if ($form->handleRequest($request)->isValid()) {
				$em = $this->getDoctrine()->getManager();
				$em->persist($candidat);
				$em->flush();
				
				return $this->redirectToRoute('mapage');
			}
		}
		
		return $this->render('OCPlatformBundle:Default:ModifInfo.html.twig',array('form' => $form->createView()));
		
	}
	
	//Modifier ses compétences
	public function candidatCompetence(Request $request){
		$user = $this->getUser();
		$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Candidature');
		$candidat = $repository->find($user->getId());
		$form = $this->createForm(CandidatCompetenceType::class,$candidat);
		
		if ($request->isMethod('POST')) {
			if ($form->handleRequest($request)->isValid()) {
				$em = $this->getDoctrine()->getManager();
				$em->persist($candidat);
				$em->flush();
				
				return $this->redirectToRoute('mapage');
			}
		}
		
		return $this->render('OCPlatformBundle:Default:ModifInfo.html.twig',array('form' => $form->createView()));
		
	}
	
	public function candidatCVThequeAction(Request $request,$id){
		$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_CvTheque');
		$repository2 = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Siteemploi');
		$candidat = $repository->find($id);
		$session = $request->getSession();
		$domaine = $session->get('domaine');
		if($domaine != null){
			$site = $repository2->find($domaine);
		}else{
			$site = null;
		}
		
		
		return $this->render('OCPlatformBundle:Candidat:ConsultationCVTheque.html.twig',array(
			'candidat'=>$candidat,
			'domaine'=>$site));
		
	}
	
	public function candidatCVThequeUserAction(Request $request,$id){
		$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_CvTheque');
		$repository2 = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Fonction');
		$candidat = $repository->find($id);
		$session = $request->getSession();
		$domaine = $session->get('fonction');
		if($domaine != null){
			$site = $repository2->find($domaine);
		}else{
			$site = null;
		}
		
		
		return $this->render('OCPlatformBundle:Candidat:ConsultationCVThequeUser.html.twig',array(
			'candidat'=>$candidat,
			'domaine'=>$site));
		
	}
	
	public function deleteAction(Request $request,$id) {
		if($id != 0){
			$repository = $this->getDoctrine()->getManager();
			$candidat = $repository->getRepository('OCUserBundle:Sy_CvTheque')->find($id);
			$em = $this->getDoctrine()->getManager();
			$em->remove($candidat);
			$em->flush();
		}
		$referer = $request->headers->get('referer');
		return $this->redirect($referer);
	}
	
	public function modificationAction(Request $request,$id){
		$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_CvTheque');
		$erreur="";
		$candidat = $repository->find($id);
		
		$form = $this->createForm(CVThequeModifType::class, $candidat);
		
		if ($request->isMethod('POST')) {
			if ($form->handleRequest($request)->isValid()) {

				$em = $this->getDoctrine()->getManager();
				$em->persist($candidat);
				$em->flush();
				$erreur = "Le candidat a été modifié";
				return $this->render('OCPlatformBundle:Candidat:ModificationCVTheque.html.twig',array('form' => $form->createView(),'message' => $erreur));
			}
		}
		return $this->render('OCPlatformBundle:Candidat:ModificationCVTheque.html.twig',array('form' => $form->createView(),'message' => $erreur));
	
	}
	
	public function contacterCandidatAction(Request $request,$id){
		$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_CvTheque');
		$repository2 = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Recruteur');
		$candidat = $repository->find($id);
		$user = $this->getUser();
		if(($recruteur = $repository2->find($user->getId()))==null){
			$repository3 = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Employeur');
			$recruteur = $repository3->find($user->getId());
		}
		$form = $this->createForm(ContactCandidatType::class);
		
		if ($request->isMethod('POST')) {
			if ($form->handleRequest($request)->isValid()) {
				$recruteur->addCandidat($candidat);
				$em = $this->getDoctrine()->getManager();
				$em->persist($recruteur);
				$em->flush();
				$message = \Swift_Message::newInstance()
						->setSubject($form->get('Object')->getData())
						->setFrom($user->getEmail())
						->setTo($candidat->getMail())
						->setBody($form->get('Message')->getData());
					$this->get('mailer')->send($message);
				return $this->render('OCPlatformBundle:Candidat:EnvoiOk.html.twig');
			}
		}
		return $this->render('OCPlatformBundle:Candidat:ContactCvTheque.html.twig',array('form' => $form->createView()));
	}
	
	
	public function generateCsvAction(Request $request) {
		$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_CvTheque');
		$site = $request->get('Domaine');
		$dept = $request->get('Departement');
		
		fputcsv($handle, ['Nom', 'Prenom', 'Mail'], ';');

		$results = $repository->getCVThequeTrie($site,$dept);
		foreach ($results as $user) {
			fputcsv(
				$handle,
				[$user->getNom(), $user->getPrenom(), $user->getMail()],
				';'
			 );
		}

		fclose($handle);

		return $response;
	}
	
}