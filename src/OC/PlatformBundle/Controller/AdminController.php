<?php


// src/OC/PlatformBundle/Controller/DefaultController.php


namespace OC\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class AdminController extends Controller
{
	//Page d'accueil
    public function indexAction(Request $request)
    {
		$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Siteemploi');
		$site = $repository->findAll();
		
		return $this->render('OCPlatformBundle:Admin:Bilan.html.twig',array('site'=>$site));
    }
	
	public function NbAnnoncesSiteAction($id){
		$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Annonce');
		$repository2 = $this->getDoctrine()->getManager()->getRepository('OCPlatformBundle:Annonce');
		$annonce = $repository->getSiteAnnonce($id);
		$annonce2 = $repository2->getSiteAnnonce($id);
		$nb = $annonce + $annonce2;
		
		return new Response($nb);
		
	}
	
	public function NbFonctionSiteAction($id){
		$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Fonction');
		$f = $repository->findByIdSiteEmploi($id);
		$nb = count($f);
		
		return new Response($nb);
		
	}
	
	public function NbCandidatSiteAction($id){
		$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Cvtheque');
		$nb = $repository->getCVThequeBySite($id);
		
		return new Response($nb);
		
	}
}