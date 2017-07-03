<?php
namespace OC\PlatformBundle\Moulinette;

use Doctrine\DBAL\Driver\PDOConnection;
use PDO;

class Bdd2{
		private $Requete;
		private $Id;
		private $oPdo;
		private $hauteurChemin;
		public function __construct(){
			$this->oPdo=null;
			
		}
		
		public function Connexion(){
			$host= "192.168.0.51";
			$user= "maneom";
			$bdd= "maneom";
			$passwd= "6s6PNswFfD4CSqZK";

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
		
		
		public function RequeteSelect (){
			if($this->Requete!=""){
				$Requete = $this->Requete;
				$this->Connexion();
				$hauteurChemin = hauteurChemin;
				//echo "<pre>123456789</pre><br/>";
				$Result = mysql_query($Requete) ;
				$i=0;
				//Traitement en cas de réussite
				if($Result!=false){
					if (mysql_num_rows($Result)==0){
						$this->Deconnexion();
						return "kenini";
					}else{
						while ($data = mysql_fetch_assoc($Result)){
							$MonTab[$i]=$data;
							$i++;
						}
						$this->Deconnexion();
						return ($MonTab);
					}
				//¤¤¤Traitement en cas d'erreur
				}else{
					$this->Deconnexion();
					return "?";
				}
			}else{
				return "kenini";
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