<?php
namespace OC\PlatformBundle\Moulinette;

use Doctrine\DBAL\Driver\PDOConnection;
use PDO;

class Bdd{
		private $Requete;
		private $Id;
		private $oPdo;
		private $hauteurChemin;
		public function __construct(){
			$this->oPdo=null;
			
		}
		
		public function Connexion(){
			$host= "db477582750.db.1and1.com";
			$user= "dbo477582750";
			$bdd= "db477582750";
			$passwd= "pdrrmmgl";

			try
			{
				$this->oPDO = new PDO('mysql:host='. $host .';dbname='. $bdd.';charset=utf8', $user, $passwd);
				$this->oPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			catch (PDOException $e)
			{
				$headers = 'From: "'.NomSite.'"<'.MailContact.'>' . "\n";
				$headers .='Reply-To: '.MailContact . "\n";
				$headers .='Content-Type: text/html; charset="iso-8859-1"' . "\n";
				$headers .='Content-Transfer-Encoding: 8bit';
				$MailErreur = "
					Erreur sur le site ".NomSite." page : ".url_actuelle()."<br/><br/>
					<strong>Erreur de connexion à la base de données</strong><br>
				";
				@mail (MailAlex , "[".NomSite." - erreur sql]" , $MailErreur, $headers);
				$Result = array();
				$this->oPDO = null;
			}
		}
		
		//¤¤¤Execute la requete (Update, delete ou insert) et renvoi true si elle est correctement executé sinon renvoi false
		public function RequeteUpDel(){
			$this->Connexion();
			if($this->oPDO!=null){
				try{
					$oPDOStatement = $this->oPDO->prepare($this->Requete);
					$oPDOStatement->execute();
					$this->Deconnexion();
					return true;
				}catch (PDOException $oPdoException){
					//¤¤¤Si il y a une erreur on l'enregistre dans un fichier texte et on envoi un mail
					//¤¤¤Si il y a une erreur on l'enregistre dans un fichier texte et on envoi un mail
					$headers = 'From: "'.NomSite.'"<'.MailContact.'>' . "\n";
					$headers .='Reply-To: '.MailContact . "\n";
					$headers .='Content-Type: text/html; charset="iso-8859-1"' . "\n";
					$headers .='Content-Transfer-Encoding: 8bit';
					$MailErreur = "
						Erreur sur le site ".NomSite." page : ".url_actuelle()."<br/><br/>
						<strong>Erreur SQL le ".date("d-m-Y G:i")."!</strong><br>
						<pre>".  $this->Requete."</pre><br>".
						$oPdoException
					;
					@mail (MailAlex , "[".NomSite." - erreur sql]" , $MailErreur, $headers);
					$this->Deconnexion();
					return false;
				}
			}else{
				return false;
			}
		}
		
		//deconnexion a la base
		//Deconnexion();
		public function Deconnexion(){
			$this->oPDO = null; //on termine la connexion à la base
		}
		
		public function setRequete($value){ $this->Requete = $value;}
		public function getId(){ return $this->Id; }
		public function setHauteurChemin($thevalue){ $this->hauteurChemin=$thevalue;}
	}
?>