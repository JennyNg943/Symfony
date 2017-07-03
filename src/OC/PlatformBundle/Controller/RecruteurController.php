<?php


// src/OC/PlatformBundle/Controller/RecruteurController.php


namespace OC\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use OC\UserBundle\Form\RecruteurType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\Common\Collections\ArrayCollection;



class RecruteurController extends Controller
{
	//Modification recruteur
	public function recruteurModifAction(Request $request){
		$user = $this->getUser();
		$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Recruteur');
		$recruteur = $repository->find($user->getId());
		$form = $this->createForm(RecruteurType::class,$recruteur);
		
		if ($request->isMethod('POST')) {
			if ($form->handleRequest($request)->isValid()) {
				$em = $this->getDoctrine()->getManager();
				$em->persist($recruteur);
				$em->flush();
				
				return $this->redirectToRoute('mapage');
			}
		}
		return $this->render('OCPlatformBundle:Default:ModifInfo.html.twig',array('form' => $form->createView()));
	}
	
	public function indexAction(Request $request){
		$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Recruteur');
		$repository2 = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Employeur');
		
		$liste1 = $repository->findAll();
		$liste2 = $repository2->findAll();
		$liste3 = new ArrayCollection(array_merge($liste1,$liste2));
			
		$formBuilder = $this->get('form.factory')->createBuilder(FormType::class);
		$formBuilder
			->setMethod('GET')	
			->add('Recruteur',      TextType::class,array(
				'label'			=> false
			))
			->add('Rechercher', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class);
		$form = $formBuilder->getForm();
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$societe = $form->get('Recruteur')->getData();
			$liste1 = $repository->findBySociete($societe);
			$liste2 = $repository2->findBySociete($societe);
			$liste3 = new ArrayCollection(array_merge($liste1,$liste2));
			
		}
		
		$paginator = $this->get('knp_paginator');
		$pagination = $paginator->paginate($liste3,$request->query->get('page', 1),20);
		
		return $this->render('OCPlatformBundle:Admin:Admin_Recruteur.html.twig',array('form'=>$form->createView(),'pagination'=>$pagination));
		
	}
	
	private function deleteAction($id,Request $request){
		$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Recruteur');
		$recruteur = $repository->find($id);
		
		if($recruteur == null){
			$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Employeur');
			$recruteur = $repository->find($id);
		}
		
		$em = $this->getDoctrine()->getManager();
		$em->remove($recruteur);
		$em->flush();
		$referer = $request->headers->get('referer');
		return $this->redirect($referer);
	}
	
	
}