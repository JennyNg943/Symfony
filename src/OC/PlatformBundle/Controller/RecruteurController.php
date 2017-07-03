<?php


// src/OC/PlatformBundle/Controller/RecruteurController.php


namespace OC\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use OC\UserBundle\Form\RecruteurType;



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
	
	
}