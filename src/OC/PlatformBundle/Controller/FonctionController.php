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


class FonctionController extends Controller
{
	//Page d'accueil
    public function indexAction(Request $request)
    {
		$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Fonction');
		$listeFonction = $repository->findAll();
		$fonction = new \OC\UserBundle\Entity\Sy_Fonction;
		$form = $this->createForm(FonctionType::class,$fonction);
		
		if ($request->isMethod('POST')) {
			if ($form->handleRequest($request)->isValid()) {
				$em = $this->getDoctrine()->getManager();
				$em->persist($fonction);
				$em->flush();
			}
		}
		$paginator = $this->get('knp_paginator');
		$pagination = $paginator->paginate($listeFonction,$request->query->get('page', 1),20);
		
		return $this->render('OCPlatformBundle:Admin:Admin_Fonction.html.twig',array('form'=>$form->createView(),'pagination'=>$pagination));
    }
	
	public function deleteAction($id,Request $request){
		$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Fonction');
		$fonction = $repository->findOneBy($id);
		$em = $this->getDoctrine()->getManager();
		$em->remove($fonction);
		$em->flush();
		$referer = $request->headers->get('referer');
		return $this->redirect($referer);
	}
	
	public function changeAction($id,Request $request){
		$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Fonction');
		$fonction = $repository->findOneBy($id);
		$form = $this->createForm(FonctionType::class,$fonction);
		
		if ($request->isMethod('POST')) {
			if ($form->handleRequest($request)->isValid()) {
				$em = $this->getDoctrine()->getManager();
				$em->persist($fonction);
				$em->flush();
			}
		}
		
		return $this->render('OCPlatformBundle:Admin:Admin_Fonction_Modif.html.twig',array('form'=>$form->createView()));
	}
	
	
}