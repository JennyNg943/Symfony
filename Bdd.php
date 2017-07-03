<?php
	class Bdd{
		private $Requete;
		private $hauteurChemin; //ne sert plus a rien avec la création du la constante mais est encore appelé à beaucoup d'endroit. Variable a nettoyer avant de supprimer cette ligne
		public function Connexion(){
			$host= "db477582750.db.1and1.com";
			$user= "dbo477582750";
			$bdd= "db477582750";
			$passwd= "pdrrmmgl";
			mysql_connect($host,$user,$passwd) or die("erreur de connexion au serveur");
			mysql_select_db($bdd) or die("erreur de connexion a la base de donnees");	
			mysql_query("set names utf8") or die (mysql_error());

		}

		//¤¤¤EXECUTE LA REQUETE (SELECT) ET RENVOI UN TABLEAU MonTab["NomDuChamp"]= "Valeur"¤¤¤//
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
					return "kenini";
				}
			}else{
				return "kenini";
			}
		}
		//¤¤¤Execute la requete (Update, delete ou insert) et renvoi true si elle est correctement executé sinon renvoi false
		public function RequeteUpDel(){
			if($this->Requete!=""){
				$Requete = $this->Requete;
				$this->Connexion();
				$hauteurChemin = hauteurChemin;
				$Result = mysql_query($Requete) ;//or die('Erreur SQL !<br><pre>'.$Requete.'</pre><br>'.mysql_error());
				//En cas d'erreur on écrit dans un fichier et on envoi un mail
				$this->Deconnexion();
				return $Result;
			}else{
				return "kenini";
			}
		}
		//deconnexion a la base
		//Deconnexion();
		public function Deconnexion(){
			mysql_close();
		}
		
		public function setRequete($value){ $this->Requete = $value;}
		public function setHauteurChemin($thevalue){ $this->hauteurChemin=$thevalue;}
	}
?>