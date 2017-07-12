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
		
		$listeFonction = $repository->findAll();
		
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
			
		}
		$paginator = $this->get('knp_paginator');
		$pagination = $paginator->paginate($listeFonction,$request->query->get('page', 1),20);
		
		$repository2 = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Annonce_Sy_Siteemploi');
		$repository3 = $this->getDoctrine()->getManager()->getRepository('OCPlatformBundle:Annonce_Sy_Siteemploi');
		$liste1 = $repository2->findAll();
		$liste2 = $repository3->findAll();
		$liste3 = new ArrayCollection(array_merge($liste1,$liste2));
		
		return $this->render('OCPlatformBundle:Admin:Admin_Fonction.html.twig',array('form'=>$form->createView(),'pagination'=>$pagination,'form2'=>$form2->createView(),'annonce'=>$liste3));
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
	
	public function annonceAction($id,Request $request){
		$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Annonce');
		$repository2 = $this->getDoctrine()->getManager()->getRepository('OCPlatformBundle:Annonce');
		$listeannonce = $repository->getFonctionAdmin($id);
		$listeannonce2 = $repository2->getFonctionAdmin($id);
		$listeannonce3 = new ArrayCollection(array_merge($listeannonce,$listeannonce2));
		$paginator = $this->get('knp_paginator');
		$pagination = $paginator->paginate($listeannonce3,$request->query->get('page', 1),20);
		return $this->render('OCPlatformBundle:Admin:Admin_Fonction_Annonce.html.twig',array('pagination'=>$pagination));
	}
	
	
}