<?php
namespace OC\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use OC\UserBundle\Form\ManeomType;
use SoapClient;
use OC\PlatformBundle\Moulinette\Bdd;
use OC\PlatformBundle\Moulinette\Bdd2;

class HelloServiceController extends Controller
{
	//Lecture d'un flux RSS - Pas encore utilisé
	/*'/homepages/14/d422478032/htdocs/rss/recrutic.xml';*/
	public function fluxRssAction(){

		$feedIo = \FeedIo\Factory::create()->getFeedIo();
		$url='http://www.recrutic.com/rss/recrutic.xml';
        $result = $feedIo->read($url);
 
        $feeds = new Annonce();
 
        foreach ($result->getFeed() as $item) {
            // get content
            $feeds->setDatePublication($item->getLastModified());
            $feeds->setTitreAnnonce($item->getTitle());
            $feeds->setDescriptifAnnonce($item->getDescription());
        }
        $em = $this->getDoctrine()->getManager();
        $em->persist($feeds);
 
        $em->flush();
		
		
	}
	
	//Test du webService de recrutic avec affichage d'un message en cas d'erreur
    public function indexAction()
    {
       $clientSOAP = new SoapClient(null,
		array(
		'uri' => 'http://www.recrutic.com/webservice/gestionAnnonce.php',
		'location'=>'http://www.recrutic.com/webservice/gestionAnnonce.php',
		'trace' => 1,
		'exceptions' => 0,
		'wsdl_cache' => 0
		)
		);	

        $response = $clientSOAP->__call('CreationAnnonceWs', array('FichierXml' => "http://www.recrutic.com/web/hello.xml" ));
		var_dump($clientSOAP->__getLastRequest()); var_dump($clientSOAP->__getLastResponse());
		return $this->render('OCPlatformBundle:Advert:FluxRss.html.twig',array(
			'reponse'=>$response
		));
    }
	
	//Moulinette permettant de regler la base de données (accent,site,fonction,...)
	public function MoulinetteAction(){
		$response = $this->Moulinette(1);
				
		return $this->redirectToRoute('admin_annonce_valide');		
	}
	
	public function Moulinette($id){
		if($id == 1){
			$Bdd = new Bdd();
			$Bdd->setRequete("
							UPDATE `sy_annonce` SET `DescriptifAnnonce`	= REPLACE (`DescriptifAnnonce`,	'&#039;','''');
							UPDATE `sy_annonce` SET `ProfilRecherche`		= REPLACE (`ProfilRecherche`,	'&#039;','''');
							UPDATE `sy_annonce` SET `TitreAnnonce`			= REPLACE (`TitreAnnonce`,		'&#039;','''');
							UPDATE `sy_annonce` SET `GrandeVilleProche`	= REPLACE (`GrandeVilleProche`,	'&#039;','''');
							UPDATE `sy_annonce` SET `Avantage`				= REPLACE (`Avantage`,			'&#039;','''');
							UPDATE `sy_annonce` SET `referenceRecruteur`	= REPLACE (`referenceRecruteur`,'&#039;','''');
							UPDATE `sy_annonce` SET `TitreAnnonce`			= REPLACE (`TitreAnnonce`,		'&eacute;','é');
							UPDATE `sy_annonce` SET `DescriptifAnnonce`	= REPLACE (`DescriptifAnnonce`,	'&eacute;','é');
							UPDATE `sy_annonce` SET `ProfilRecherche`		= REPLACE (`ProfilRecherche`,	'&eacute;','é');
							UPDATE `sy_annonce` SET `Remuneration`			= REPLACE (`Remuneration`,		'&eacute;','é');
							UPDATE `sy_annonce` SET `GrandeVilleProche`	= REPLACE (`GrandeVilleProche`,	'&eacute;','é');
							UPDATE `sy_annonce` SET `Avantage`				= REPLACE (`Avantage`,			'&eacute;','é');
							UPDATE `sy_annonce` SET `referenceRecruteur`	= REPLACE (`referenceRecruteur`,'&eacute;','é');
							UPDATE `sy_annonce` SET `reference`			= REPLACE (`reference`,'&eacute;','é');
							UPDATE `sy_annonce` SET `TitreAnnonce`			= REPLACE (`TitreAnnonce`,		'Ã§','ç');
							UPDATE `sy_annonce` SET `DescriptifAnnonce`	= REPLACE (`DescriptifAnnonce`,	'Ã§','ç');
							UPDATE `sy_annonce` SET `ProfilRecherche`		= REPLACE (`ProfilRecherche`,	'Ã§','ç');
							UPDATE `sy_annonce` SET `TitreAnnonce`			= REPLACE (`TitreAnnonce`,		'Ã ','à');
							UPDATE `sy_annonce` SET `DescriptifAnnonce`	= REPLACE (`DescriptifAnnonce`,	'Ã ','à');
							UPDATE `sy_annonce` SET `ProfilRecherche`		= REPLACE (`ProfilRecherche`,	'Ã ','à');
							UPDATE `sy_annonce` SET `Remuneration`			= REPLACE (`Remuneration`,		'Ã ','à');
							UPDATE `sy_annonce` SET `TitreAnnonce`			= REPLACE (`TitreAnnonce`,		'Ã©','é');
							UPDATE `sy_annonce` SET `DescriptifAnnonce`	= REPLACE (`DescriptifAnnonce`,	'Ã©','é');
							UPDATE `sy_annonce` SET `ProfilRecherche`		= REPLACE (`ProfilRecherche`,	'Ã©','é');
							UPDATE `sy_annonce` SET `GrandeVilleProche`	= REPLACE (`GrandeVilleProche`,	'Ã©','é');
							UPDATE `sy_annonce` SET `TitreAnnonce`			= REPLACE (`TitreAnnonce`,		'Ã¨','è');
							UPDATE `sy_annonce` SET `DescriptifAnnonce`	= REPLACE (`DescriptifAnnonce`,	'Ã¨','è');
							UPDATE `sy_annonce` SET `GrandeVilleProche`	= REPLACE (`GrandeVilleProche`,	'Ã¨','è');
							UPDATE `sy_annonce` SET `ProfilRecherche`		= REPLACE (`ProfilRecherche`,	'Ã¨','è');
							UPDATE `sy_annonce` SET `TitreAnnonce`			= REPLACE (`TitreAnnonce`,		'Ã´','ô');
							UPDATE `sy_annonce` SET `DescriptifAnnonce`	= REPLACE (`DescriptifAnnonce`,	'Ã´','ô');
							UPDATE `sy_annonce` SET `GrandeVilleProche`	= REPLACE (`GrandeVilleProche`,	'Ã´','ô');
							UPDATE `sy_annonce` SET `ProfilRecherche`		= REPLACE (`ProfilRecherche`,	'Ã´','ô');
							UPDATE `sy_annonce` SET `referenceRecruteur`	= REPLACE (`referenceRecruteur`,	'Ã´','ô');
							UPDATE `sy_annonce` SET `TitreAnnonce`			= REPLACE (`TitreAnnonce`,		'&Atilde;‰','E');
							UPDATE `sy_annonce` SET `TitreAnnonce`			= REPLACE (`TitreAnnonce`,		'&RSQUO;','''');
							UPDATE `sy_annonce` SET `DescriptifAnnonce`	= REPLACE (`DescriptifAnnonce`,	'&Atilde;‰','E');
							UPDATE `sy_annonce` SET `ProfilRecherche`		= REPLACE (`ProfilRecherche`,	'&Atilde;‰','E');
							UPDATE `sy_annonce` SET `GrandeVilleProche`	= REPLACE (`GrandeVilleProche`,	'&Atilde;‰','E');
							UPDATE `sy_annonce` SET `referenceRecruteur`	= REPLACE (`referenceRecruteur`,	'&Atilde;‰','E');
							UPDATE `sy_annonce` SET `TitreAnnonce`			= REPLACE (`TitreAnnonce`,		'&Atilde;&deg;','');
							UPDATE `sy_annonce` SET `DescriptifAnnonce`	= REPLACE (`DescriptifAnnonce`,	'&Atilde;&deg;','');
							UPDATE `sy_annonce` SET `ProfilRecherche`		= REPLACE (`ProfilRecherche`,	'&Atilde;&deg;','');
							UPDATE `sy_annonce` SET `GrandeVilleProche`	= REPLACE (`GrandeVilleProche`,	'&Atilde;&deg;','');
							UPDATE `sy_annonce` SET `referenceRecruteur`	= REPLACE (`referenceRecruteur`,	'&Atilde;&deg;','');
							UPDATE `sy_annonce` SET `TitreAnnonce`			= REPLACE (`TitreAnnonce`,		'&Acirc;&nbsp;','');
							UPDATE `sy_annonce` SET `DescriptifAnnonce`	= REPLACE (`DescriptifAnnonce`,	'&Acirc;&nbsp;','');
							UPDATE `sy_annonce` SET `ProfilRecherche`		= REPLACE (`ProfilRecherche`,	'&Acirc;&nbsp;','');
							UPDATE `sy_annonce` SET `GrandeVilleProche`	= REPLACE (`GrandeVilleProche`,	'&Acirc;&nbsp;','');
							UPDATE `sy_annonce` SET `referenceRecruteur`	= REPLACE (`referenceRecruteur`,	'&Acirc;&nbsp;','');
							UPDATE `sy_annonce` SET `DescriptifAnnonce`	= REPLACE (`DescriptifAnnonce`,	'&ccedil;','ç');
							UPDATE `sy_annonce` SET `ProfilRecherche`		= REPLACE (`ProfilRecherche`,	'&ccedil;','ç');
							UPDATE `sy_annonce` SET `GrandeVilleProche`	= REPLACE (`GrandeVilleProche`,	'&ccedil;','ç');
							UPDATE `sy_annonce` SET `DescriptifAnnonce`	= REPLACE (`DescriptifAnnonce`,	'&egrave;','è');
							UPDATE `sy_annonce` SET `ProfilRecherche`		= REPLACE (`ProfilRecherche`,	'&egrave;','è');
							UPDATE `sy_annonce` SET `TitreAnnonce`			= REPLACE (`TitreAnnonce`,		'&egrave;','è');
							UPDATE `sy_annonce` SET `GrandeVilleProche`	= REPLACE (`GrandeVilleProche`,	'&egrave;','è');
							UPDATE `sy_annonce` SET `referenceRecruteur`	= REPLACE (`referenceRecruteur`,	'&egrave;','è');
							UPDATE `sy_annonce` SET `DescriptifAnnonce`	= REPLACE (`DescriptifAnnonce`,	'&Atilde;&nbsp;','à');
							UPDATE `sy_annonce` SET `TitreAnnonce`			= REPLACE (`TitreAnnonce`,		'&Atilde;&nbsp;','à');
							UPDATE `sy_annonce` SET `ProfilRecherche`		= REPLACE (`ProfilRecherche`,	'&Atilde;&nbsp;','à');
							UPDATE `sy_annonce` SET `Remuneration`			= REPLACE (`Remuneration`,		'&Atilde;&nbsp;','à');
							UPDATE `sy_annonce` SET `GrandeVilleProche`	= REPLACE (`GrandeVilleProche`,	'&Atilde;&nbsp;','à');
							UPDATE `sy_annonce` SET `referenceRecruteur`	= REPLACE (`referenceRecruteur`,			'&Atilde;&nbsp;','à');
							UPDATE `sy_annonce` SET `DescriptifAnnonce`	= REPLACE (`DescriptifAnnonce`,	'&ocirc;','ô');
							UPDATE `sy_annonce` SET `ProfilRecherche`		= REPLACE (`ProfilRecherche`,	'&ocirc;','ô');
							UPDATE `sy_annonce` SET `DescriptifAnnonce`	= REPLACE (`DescriptifAnnonce`,	'&icirc;','î');
							UPDATE `sy_annonce` SET `ProfilRecherche`		= REPLACE (`ProfilRecherche`,	'&icirc;','î');
							UPDATE `sy_annonce` SET `DescriptifAnnonce`	= REPLACE (`DescriptifAnnonce`,	'&ecirc;','ê');
							UPDATE `sy_annonce` SET `GrandeVilleProche`	= REPLACE (`GrandeVilleProche`,	'&ecirc;','ê');
							UPDATE `sy_annonce` SET `ProfilRecherche`		= REPLACE (`ProfilRecherche`,	'&ecirc;','ê');
							UPDATE `sy_annonce` SET `Avantage`				= REPLACE (`Avantage`,			'&ecirc;','ê');
							UPDATE `sy_annonce` SET `DescriptifAnnonce`	= REPLACE (`DescriptifAnnonce`,	'&acirc;','â');
							UPDATE `sy_annonce` SET `ProfilRecherche`		= REPLACE (`ProfilRecherche`,	'&acirc;','â');
							UPDATE `sy_annonce` SET `Avantage`				= REPLACE (`Avantage`,			'&acirc;','â');
							UPDATE `sy_annonce` SET `GrandeVilleProche`	= REPLACE (`GrandeVilleProche`,	'&acirc;','â');
							UPDATE `sy_annonce` SET `DescriptifAnnonce`	= REPLACE (`DescriptifAnnonce`,	'&rsquo;','''');
							UPDATE `sy_annonce` SET `Avantage`				= REPLACE (`Avantage`,			'&rsquo;','''');
							UPDATE `sy_annonce` SET `ProfilRecherche`		= REPLACE (`ProfilRecherche`,	'&rsquo;','''');
							UPDATE `sy_annonce` SET `DescriptifAnnonce`	= REPLACE (`DescriptifAnnonce`,	'CHAR(13)','');
							UPDATE `sy_annonce` SET `ProfilRecherche`		= REPLACE (`ProfilRecherche`,	'CHAR(13)','');
							UPDATE `sy_annonce` SET `DescriptifAnnonce`	= REPLACE (`DescriptifAnnonce`,	'\n',' ');
							UPDATE `sy_annonce` SET `ProfilRecherche`		= REPLACE (`ProfilRecherche`,	'\n',' ');
							UPDATE `sy_annonce` SET `DescriptifAnnonce`	= REPLACE (`DescriptifAnnonce`,	'&ordm;','');
							UPDATE `sy_annonce` SET `ProfilRecherche`		= REPLACE (`ProfilRecherche`,	'&ordm;','');
							UPDATE `sy_annonce` SET `DescriptifAnnonce`	= REPLACE (`DescriptifAnnonce`,	'&ucirc;','û');
							UPDATE `sy_annonce` SET `ProfilRecherche`		= REPLACE (`ProfilRecherche`,	'&ucirc;','û');
							UPDATE `recruteur` SET `Societe`			= REPLACE (`Societe`,			'&ucirc;','û');
							UPDATE `recruteur` SET `Societe`			= REPLACE (`Societe`,			'&eacute;','é');
							UPDATE `recruteur` SET `Societe`			= REPLACE (`Societe`,			'&#039;','''');
							UPDATE `recruteur` SET `Societe`			= REPLACE (`Societe`,			'&ordm;','');
							UPDATE `recruteur` SET `Societe`			= REPLACE (`Societe`,			'&acirc;','â');
							UPDATE `recruteur` SET `Societe`			= REPLACE (`Societe`,			'&rsquo;','''');
							UPDATE `recruteur` SET `Societe`			= REPLACE (`Societe`,			'&amp;','à');
							UPDATE `annonce` SET `DatePublication` = '".date("Y-m-d")."' where datePublication = '0000-00-00';
								
							INSERT INTO `annonce_sy_siteemploi`(`id_annonce_id`, `id_siteemploi_id`, `id_fonction_id`) SELECT `Id_Annonce`,fonction.id_siteemploi,`Id_Fonction` from annoncefonction,fonction where id_fonction=fonction.id and id_annonce not in (select id_annonce_id from annonce_sy_siteemploi) AND id_annonce in (Select id from annonce) GROUP BY id_annonce"
								);
			if ($Bdd->RequeteUpDel()) {
				return "Base mise à jour : OK";
			}else{
				return "Non ça ne marche pas...";
			}
		}else{
			return "Vous n'avez pas accès à cette fonctionnalitée";
		}
	}
	
	
	//Fonction permettant d'extraire les candidats de la table Maneom
	public function ManeomSQLAction(Request $request){
		$form = $this->createForm(ManeomType::class);
		if ($request->isMethod('POST')) {
			if ($form->handleRequest($request)->isValid()) {
				$Bdd = new Bdd2();
				$Bdd->setRequete("SELECT DISTINCT candidat.*
								FROM candidat,  bw_boitemail,mission
								WHERE  candidat.Id_Candidat = bw_boitemail.Id_Candidat
								AND bw_boitemail.id_Mission = mission.id_mission
								AND NumMission = ".$form->get('id')->getData());
				$RequeteSelect = $Bdd->RequeteSelect();
				return $this->render('OCUserBundle:Moulinette:Maneom.html.twig',array('listecandidat'=>$RequeteSelect,'form' => $form->createView()));
			}
			
		}
		return $this->render('OCUserBundle:Moulinette:Maneom.html.twig',array('listecandidat'=>$RequeteSelect,'form' => $form->createView()));
		
	}
}
?>