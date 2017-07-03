<?php


// src/OC/PlatformBundle/Controller/FonctionController.php


namespace OC\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use OC\PlatformBundle\Form\TriSiteType;
use Doctrine\Common\Collections\ArrayCollection;
use OC\PlatformBundle\Form\ContactType;
use OC\PlatformBundle\Form\FonctionType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class FonctionController extends Controller
{
	//Page d'accueil
    public function indexAction(Request $request)
    {
		$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Fonction');
		$listeFonction = $repository->findAll();
		$fonction = new \OC\UserBundle\Entity\Sy_Fonction;
		$form = $this->createForm(FonctionType::class,$fonction);
		$formBuilder = $this->get('form.factory')->createBuilder(FormType::class);
		$formBuilder
			->setMethod('GET')	
			->add('Site',      EntityType::class,array(
				'class'		=> 'OCUserBundle:Sy_Siteemploi',
				'choice_label'	=> 'intitulesiteemploi'
			))
			->add('Rechercher', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class);
		$form2 = $formBuilder->getForm();
		$session = $request->getSession();
		$this->sessionStop($session,1);
		if ($session->get('fonction') == null) {
			$listeFonction = $repository->findAll();
			$session->set('fonction', $listeFonction);
		}
		
		if ($request->isMethod('POST')) {
			if ($form->handleRequest($request)->isValid()) {
				$em = $this->getDoctrine()->getManager();
				$em->persist($fonction);
				$em->flush();
				$referer = $request->headers->get('referer');
				return $this->redirect($referer);
			}
		}
		
		$form2->handleRequest($request);
		if ($form2->isSubmitted() && $form2->isValid()) {
			$site = $form2->get('Site')->getData();
			$listeFonction = $repository->findByIdSiteEmploi($site);
			$session->set('fonction', $listeFonction);
		}
		$liste = $session->get('fonction');
		$paginator = $this->get('knp_paginator');
		$pagination = $paginator->paginate($liste,$request->query->get('page', 1),20);
		
		return $this->render('OCPlatformBundle:Admin:Admin_Fonction.html.twig',array('form'=>$form->createView(),'pagination'=>$pagination,'form2'=>$form2->createView()));
    }
	
	public function deleteAction($id,Request $request){
		$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Fonction');
		$fonction = $repository->find($id);
		$em = $this->getDoctrine()->getManager();
		$em->remove($fonction);
		$em->flush();
		$referer = $request->headers->get('referer');
		return $this->redirect($referer);
	}
	
	public function changeAction($id,Request $request){
		$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Fonction');
		$fonction = $repository->find($id);
		$form = $this->createForm(FonctionType::class,$fonction);
		$msg = "";
		
		if ($request->isMethod('POST')) {
			if ($form->handleRequest($request)->isValid()) {
				$em = $this->getDoctrine()->getManager();
				$em->persist($fonction);
				$em->flush();
				$msg = "Cette fonction a bien été modifiée";
				return $this->render('OCPlatformBundle:Admin:Admin_Fonction_Modif.html.twig',array('form'=>$form->createView(),'msg'=>$msg));
			}
		}
		
		return $this->render('OCPlatformBundle:Admin:Admin_Fonction_Modif.html.twig',array('form'=>$form->createView(),'msg'=>$msg));
	}
	
	function sessionStop($session,$id){
		if($id == 1){
			$session->set('liste', null);
			$session->set('listePublication', null);
			$session->set('listeAnnonce', null);
		}
		
		if($id == 2){
			$session->set('candidat', null);
			$session->set('listePublication', null);
			$session->set('listeAnnonce', null);
		}
		
		if($id == 3){
			$session->set('liste', null);
			$session->set('candidat', null);
			$session->set('listePublication', null);
			$session->set('listeAnnonce', null);
		}
	}
}