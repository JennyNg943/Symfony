<?php


// src/OC/UserBundle/Controller/InscriptionController.php


namespace OC\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use OC\UserBundle\Form\SocieteType;
use OC\UserBundle\Entity\Sy_Societe;
use OC\UserBundle\Form\CandidatureType;
use OC\UserBundle\Entity\Sy_Candidature;
use Swift_Attachment;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use OC\PlatformBundle\Entity\Candidat;
use OC\UserBundle\Form\ParticulierType;
use OC\PlatformBundle\Entity\Recruteur;


class InscriptionController extends Controller
{
	//Candidature d'un candidat à une annonce old
	public function FormParAction(Request $request,$id)
	{
		$repository = $this->getDoctrine()->getManager()->getRepository('OCPlatformBundle:Annonce');
		$repository2 = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Recruteur');
		$repository3 = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Candidature');
		$repository4 = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_CvTheque');
		$user = $this->getUser();
		$candidat = $repository3->find($user->getId());
		$candidat->setMailCandidat($user->getEmail())->setCvcandidat(null);
		$form = $this->createForm(CandidatureType::class, $candidat);	
		$annonce = $repository->find($id);
		$recruteur = $repository2->find($annonce->getIdRecruteur());
		$mail = $recruteur->getMailSourcing();
		$erreur="";
		$fonction = $annonce->getFonction();
		foreach ($fonction as $f){
			if(($repository3->getCandidatFonction($candidat,$f->getIdFonction()))==null){
				$candidat->addFonction($f->getIdFonction());
			}
		}
		foreach($candidat->getAnnonce() as $a){
			if($a == $annonce){
				$erreur = "Vous avez déjà postulé à cette annonce";
				$ok = -1;
			}
		}
		if ($request->isMethod('POST')) {
			if ($form->handleRequest($request)->isValid()) {
				if($ok == -1){
					return $this->render('OCUserBundle:Inscription:FormPar.html.twig', array('form' => $form->createView(),'annonce'=>$annonce,'erreur'=>$erreur));
				}else{
					$cv = $repository4->findOneByMail($user->getEmail());
					$cv->addAnnonce($annonce);
					$candidat->addAnnonce($annonce);
					$file = $candidat->getCvcandidat();
					$fileName = $user->getEmail().'.'.$file->guessExtension();
					$file->move($this->getParameter('CV_directory'),$fileName);

					$em = $this->getDoctrine()->getManager();
					$em->persist($candidat);
					$em->persist($cv);
					$em->flush();

					$titre = $annonce->getTitreAnnonce();
					$reference = $annonce->getReference();
					$nom = $candidat->getNomcandidat();
					$body = "Candidature de ".$candidat->getIdcivilite()." ".$candidat->getNomCandidat()." ".$candidat->getPrenomCandidat()." pour le poste de ".$titre." ref : ".$reference.".\n"
							. $candidat->getIdcivilite()." ".$candidat->getNomCandidat()." habite à ".$candidat->getVilleCandidat()." (".$candidat->getCP().").\n"
							. "Le commentaire suivant a été ajouté : ".$candidat->getCommentaire().".\n"
							."\n"
							."Pour contacter ce candidat, il suffit de répondre à ce message.";
					$message = \Swift_Message::newInstance()
						->setSubject('Nouveau candidat RECRUTIC pour le poste '.$titre)
						->setFrom($user->getEmail())
						->setTo($mail)
						->setBody($body)
						->attach(Swift_Attachment::fromPath($fileName))	;
					$this->get('mailer')->send($message);


				  return $this->render('OCPlatformBundle:Advert:ReponseCandidature.html.twig');
				}
			}
		}
		return $this->render('OCUserBundle:Inscription:FormPar.html.twig', array('form' => $form->createView(),'annonce'=>$annonce,'erreur'=>$erreur));
	}
	
	//Réponse d'un candidat à une annonce new
	public function FormParNewAction(Request $request,$id)
	{
		$repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Annonce');
		$repository3 = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Candidature');
		$repository4 = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:User');
		$repository5 = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_CvTheque');
		$user = $this->getUser();
		$candidat = $repository3->find($user->getId());	//Récupération du candidat par rapport à son idUser
			//Utilisation du mail de connexion comme mail de contact.
			//Le getCV() renvoi un string. On lui demande donc d'en entrer un autre à chaque candidature.
		$candidat->setMailCandidat($user->getEmail())->setCvcandidat(null);
		$form = $this->createForm(CandidatureType::class, $candidat);
		$annonce = $repository->find($id);
		if(($annonce->getIdRecruteur())== null){ //Une annonce peut etre passé par un recruteur ou un employeur.
			$repository2 = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Employeur');
			$recruteur = $repository2->find($annonce->getIdEmployeur());
		} else {
			$repository2 = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Recruteur');
			$recruteur = $repository2->find($annonce->getIdRecruteur());
		}
		$mail = $repository4->find($recruteur->getId())->getEmail();
		$erreur="";
		$fonction = $annonce->getFonction();
		foreach ($fonction as $f){ //Integrité de la fonction. Il ne faut pas qu'un candidat ait plusieurs fois la même.
			if(($repository3->getCandidatFonction($candidat,$f->getIdFonction()))==null){
				$candidat->addFonction($f->getIdFonction());
			}
		}
		foreach($candidat->getAnnonce() as $a){
			if($a == $annonce){	// Un candidat ne peut postuler plusieurs fois à une annonce.
				$erreur = "Vous avez déjà postulé à cette annonce";
				$ok = -1;
			}
		}
		if ($request->isMethod('POST')) {
			if ($form->handleRequest($request)->isValid()) {
				if($ok == -1){ //Si le candidat a déjà postulé à cette annonce, on l'empeche de repostuler.
					return $this->render('OCUserBundle:Inscription:FormPar.html.twig', array('form' => $form->createView(),'annonce'=>$annonce,'erreur'=>$erreur));
				}else{
					$cv = $repository5->findOneByMail($user->getEmail());
					$cv->addSyAnnonce($annonce);
					$candidat->addSyAnnonce($annonce);
					$file = $candidat->getCvcandidat();
					$fileName = $user->getEmail().'.'.$file->guessExtension();
					$file->move($this->getParameter('CV_directory'),$fileName);

					$em = $this->getDoctrine()->getManager();
					$em->persist($candidat);
					$em->persist($cv);
					$em->flush();
					$titre = $annonce->getTitreAnnonce();
					$reference = $annonce->getReferenceRecruteur();
					$body = "Candidature de ".$candidat->getIdcivilite()." ".$candidat->getNomCandidat()." ".$candidat->getPrenomCandidat()." pour le poste de ".$titre." ref : ".$reference.".\n"
						. $candidat->getIdcivilite()." ".$candidat->getNomCandidat()." habite à ".$candidat->getVilleCandidat()." (".$candidat->getCP().").\n"
						. "Le commentaire suivant a été ajouté : ".$candidat->getCommentaire().".\n"
						."\n"
						."Pour contacter ce candidat, il suffit de répondre à ce message.";
					$message = \Swift_Message::newInstance()//Envoi de la candidature au recruteur.
						->setSubject('Nouveau candidat RECRUTIC pour le poste '.$titre)
						->setFrom($user->getEmail())
						->setTo($mail)
						->setBody($body)
						->attach(Swift_Attachment::fromPath($fileName))	;
					$this->get('mailer')->send($message);
					return $this->render('OCPlatformBundle:Advert:ReponseCandidature.html.twig');
				}
			}
		}
		return $this->render('OCUserBundle:Inscription:FormPar.html.twig', array('form' => $form->createView(),'annonce'=>$annonce,'erreur'=>$erreur));
	}
	
	//Redirection vers la page d'inscription.
    public function registerAction()
    {
        return $this->render('OCUserBundle:Inscription:TransitionInscrip.html.twig');
    }
	
	//Redirection vers la page d'inscription.
    public function register2Action()
    {
        return $this->render('OCUserBundle:Inscription:TransitionInscrip2.html.twig');
    }

	//Page d'apres inscription + attribution des roles des utilisateurs.
	public function InscriptionSuiteAction(Request $request){
		$repository1 = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Recruteur');
		$repository2 = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Candidature');
		$repository4 = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:Sy_Employeur');
		$repository3 = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:UtilisateurRole');
		$user = $this->getUser();
		$id	= $user->getId();
		$candidat = $repository2->find($id);
		$recruteur = $repository1->find($id);
		$employeur = $repository4->find($id);
		if($candidat != null){
			$type = $repository3->find(1);
			$user->setType($type);
			$repository4 = $this->getDoctrine()->getManager()->getRepository('OCPlatformBundle:Ville');
			$ville = $repository4->findOneByCodePostal($candidat->getCp());
			$cvtheque = new \OC\UserBundle\Entity\Sy_CvTheque();
			$cvtheque->setNom($candidat->getNomCandidat())->setPrenom($candidat->getPrenomCandidat())->setCodePostal($ville)->setMail($user->getEmail())->setIdSite($candidat->getSite());
			$em = $this->getDoctrine()->getManager();
					$em->persist($cvtheque);
					$em->flush();
		}
		if($recruteur != null){
			$type = $repository3->find(2);
			$user->setType($type);
		}
		if($employeur != null){
			$type = $repository3->find(4);
			$user->setType($type);
		}
		
		$user->addRole('ROLE_USER');
		$this->get('fos_user.user_manager')->updateUser($user, false);
		$this->getDoctrine()->getManager()->flush();
		return $this->render('OCUserBundle:Inscription:InscriptionOK.html.twig');
		
	}
	
	//Inscription des candidats avec utilisation de PUGXMultiUser.
	public function CandidatAction()
    {
		
        return $this->container
                    ->get('pugx_multi_user.registration_manager')
                    ->register('OC\UserBundle\Entity\Sy_Candidature');
    }
	
	//Inscription des recruteur avec utilisation de PUGXMultiUser.
	public function RecruteurAction()
    {
        return $this->container
                    ->get('pugx_multi_user.registration_manager')
                    ->register('OC\UserBundle\Entity\Sy_Recruteur');
    }
	
	//Inscription des employeurs avec utilisation de PUGXMultiUser.
	public function EmployeurAction()
    {
        return $this->container
                    ->get('pugx_multi_user.registration_manager')
                    ->register('OC\UserBundle\Entity\Sy_Employeur');
    }
	
	public function desinscriptionAction(){
		$userManager = $this->get('fos_user.user_manager');
		$userManager->deleteUser($this->getUser());
		return $this->render('OCUserBundle:Inscription:Desinscription.html.twig');
	}
}
?>