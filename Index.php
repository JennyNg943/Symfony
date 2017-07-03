<?php
@session_start();
if(!isset($_SESSION['login'])){
	header("location:../index.php?msg=Veuillez vous loguer pour entrer");
}
//$ResultCand = RequeteSelect("SELECT NomCandidat,PrenomCandidat FROM Candidat,User WHERE Candidat.Id_User = User.Id_User AND login='$_SESSION['login']$Log'");
//@setcookie("CookieLogin",$PrenomConsultant." ".$NomConsultant,(time() + 3600));
//setcookie("CookieLogin",." ".,(time() + 3600));
$NomPage = "ACCUEIL:BIENVENUE SUR L'EXTRANET MANEOM";
$cheminImage = "../images/icone_societe.JPG";
require_once("EnTeteProspect.php");

	
?>

<div id='page'>
	<div id="Impression">
	</div>
	<h3>Logiciel de communication Maneom</h3>
	
		<?php require_once("../Inclusion/ManeomCommunication/Communication.php"); ?>
	
</div>
<?php
require_once("PiedPageProspect.php");
?>