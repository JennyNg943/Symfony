<?php

namespace OC\UserBundle\Entity;

use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;
use OC\UserBundle\Entity\User;

/**
 * Sy_Recruteur
 *
 * @ORM\Table(name="Sy_Employeur")
 * @ORM\Entity(repositoryClass="OC\UserBundle\Repository\EmployeurRepository")
 * @UniqueEntity(fields = "username", targetClass = "OC\UserBundle\Entity\User", message="fos_user.username.already_used")
 * @UniqueEntity(fields = "email", targetClass = "OC\UserBundle\Entity\User", message="fos_user.email.already_used")
 */
class Sy_Employeur extends User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
	 * 
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Societe", type="string", length=255, nullable=false)
     */
    private $societe;

    /**
     * @var integer
     *
     * @ORM\Column(name="Id_CiviliteContactComm", type="integer", nullable=false)
     */
    private $idCivilitecontactcomm;

    /**
     * @var string
     *
     * @ORM\Column(name="NomContactComm", type="string", length=255, nullable=false)
     */
    private $nomcontactcomm;

    /**
     * @var string
     *
     * @ORM\Column(name="PrenomContactComm", type="string", length=255, nullable=false)
     */
    private $prenomcontactcomm;


    /**
     * @var integer
     *
     * @ORM\Column(name="Id_CiviliteContactSourcing", type="integer", nullable=true)
     */
    private $idCivilitecontactsourcing;

    /**
     * @var string
     *
     * @ORM\Column(name="NomContactSourcing", type="string", length=255, nullable=true)
     */
    private $nomcontactsourcing;

    /**
     * @var string
     *
     * @ORM\Column(name="PrenomContactSourcing", type="string", length=255, nullable=true)
     */
    private $prenomcontactsourcing;


    /**
     * @var string
     *
     * @ORM\Column(name="Adresse", type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="Cp", type="string", length=255, nullable=false)
     */
    private $cp;

    /**
     * @var string
     *
     * @ORM\Column(name="Ville", type="string", length=255, nullable=true)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="Site", type="string", length=255, nullable=true)
     */
    private $site;

    /**
     * @var string
     *
     * @ORM\Column(name="Tel", type="string", length=255, nullable=false)
     */
    private $tel;

    /**
     * @var integer
     *
     * @ORM\Column(name="Blacklist", type="integer", nullable=true)
     */
    private $blacklist = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateCreation", type="date", nullable=false)
     */
    private $datecreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateMaj", type="date", nullable=false)
     */
    private $datemaj;

    /**
     * @var integer
     *
     * @ORM\Column(name="Id_TypeRecruteur", type="integer", nullable=true)
     */
    private $idTyperecruteur;

    /**
     * @var integer
     *
     * @ORM\Column(name="Newsletter", type="integer", nullable=true)
     */
    private $newsletter;

    /**
     * @var integer
     *
     * @ORM\Column(name="Id_RecruteurFormule", type="integer", nullable=true)
     */
    private $idRecruteurformule;

	/**
     * @var integer
     *
     * @ORM\OneToOne(targetEntity="OC\UserBundle\Entity\User", cascade={"persist", "remove"})
	 * 
     */
	private $user;
	
	/**
     * @var integer
     *
     * @ORM\OneToMany(targetEntity="OC\UserBundle\Entity\Sy_Annonce", mappedBy="idRecruteur")
	 * 
     */
	private $annonce;
	
	/**
     * @var integer
     *
     * @ORM\ManyToMany(targetEntity="OC\UserBundle\Entity\Sy_CvTheque")
	 * 
     */
	private $candidat;
	

	/**
     * Constructor
     */
    public function __construct()
    {
		$this->datecreation = new \DateTime('now');
		$this->datemaj = new \DateTime('now');
    }
	
    

    /**
     * Set societe
     *
     * @param string $societe
     *
     * @return Recruteur
     */
    public function setSociete($societe)
    {
        $this->societe = $societe;

        return $this;
    }

    /**
     * Get societe
     *
     * @return string
     */
    public function getSociete()
    {
        return $this->societe;
    }

    /**
     * Set idCivilitecontactcomm
     *
     * @param integer $idCivilitecontactcomm
     *
     * @return Recruteur
     */
    public function setIdCivilitecontactcomm($idCivilitecontactcomm)
    {
        $this->idCivilitecontactcomm = $idCivilitecontactcomm;

        return $this;
    }

    /**
     * Get idCivilitecontactcomm
     *
     * @return integer
     */
    public function getIdCivilitecontactcomm()
    {
        return $this->idCivilitecontactcomm;
    }

    /**
     * Set nomcontactcomm
     *
     * @param string $nomcontactcomm
     *
     * @return Recruteur
     */
    public function setNomcontactcomm($nomcontactcomm)
    {
        $this->nomcontactcomm = $nomcontactcomm;

        return $this;
    }

    /**
     * Get nomcontactcomm
     *
     * @return string
     */
    public function getNomcontactcomm()
    {
        return $this->nomcontactcomm;
    }

    /**
     * Set prenomcontactcomm
     *
     * @param string $prenomcontactcomm
     *
     * @return Recruteur
     */
    public function setPrenomcontactcomm($prenomcontactcomm)
    {
        $this->prenomcontactcomm = $prenomcontactcomm;

        return $this;
    }

    /**
     * Get prenomcontactcomm
     *
     * @return string
     */
    public function getPrenomcontactcomm()
    {
        return $this->prenomcontactcomm;
    }

    /**
     * Set mailcommLogin
     *
     * @param string $mailcommLogin
     *
     * @return Recruteur
     */
    public function setMailcommLogin($mailcommLogin)
    {
        $this->mailcommLogin = $mailcommLogin;

        return $this;
    }

    /**
     * Get mailcommLogin
     *
     * @return string
     */
    public function getMailcommLogin()
    {
        return $this->mailcommLogin;
    }

    /**
     * Set idCivilitecontactsourcing
     *
     * @param integer $idCivilitecontactsourcing
     *
     * @return Recruteur
     */
    public function setIdCivilitecontactsourcing($idCivilitecontactsourcing)
    {
        $this->idCivilitecontactsourcing = $idCivilitecontactsourcing;

        return $this;
    }

    /**
     * Get idCivilitecontactsourcing
     *
     * @return integer
     */
    public function getIdCivilitecontactsourcing()
    {
        return $this->idCivilitecontactsourcing;
    }

    /**
     * Set nomcontactsourcing
     *
     * @param string $nomcontactsourcing
     *
     * @return Recruteur
     */
    public function setNomcontactsourcing($nomcontactsourcing)
    {
        $this->nomcontactsourcing = $nomcontactsourcing;

        return $this;
    }

    /**
     * Get nomcontactsourcing
     *
     * @return string
     */
    public function getNomcontactsourcing()
    {
        return $this->nomcontactsourcing;
    }

    /**
     * Set prenomcontactsourcing
     *
     * @param string $prenomcontactsourcing
     *
     * @return Recruteur
     */
    public function setPrenomcontactsourcing($prenomcontactsourcing)
    {
        $this->prenomcontactsourcing = $prenomcontactsourcing;

        return $this;
    }

    /**
     * Get prenomcontactsourcing
     *
     * @return string
     */
    public function getPrenomcontactsourcing()
    {
        return $this->prenomcontactsourcing;
    }

    /**
     * Set mailsourcing
     *
     * @param string $mailsourcing
     *
     * @return Recruteur
     */
    public function setMailsourcing($mailsourcing)
    {
        $this->mailsourcing = $mailsourcing;

        return $this;
    }

    /**
     * Get mailsourcing
     *
     * @return string
     */
    public function getMailsourcing()
    {
        return $this->mailsourcing;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Recruteur
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set cp
     *
     * @param string $cp
     *
     * @return Recruteur
     */
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get cp
     *
     * @return string
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Recruteur
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Recruteur
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set site
     *
     * @param string $site
     *
     * @return Recruteur
     */
    public function setSite($site)
    {
        $this->site = $site;

        return $this;
    }

    /**
     * Get site
     *
     * @return string
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * Set tel
     *
     * @param string $tel
     *
     * @return Recruteur
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set fax
     *
     * @param string $fax
     *
     * @return Recruteur
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

   
    /**
     * Set blacklist
     *
     * @param integer $blacklist
     *
     * @return Recruteur
     */
    public function setBlacklist($blacklist)
    {
        $this->blacklist = $blacklist;

        return $this;
	}

    /**
     * Get blacklist
     *
     * @return integer
     */
    public function getBlacklist()
    {
        return $this->blacklist;
    }

    /**
     * Set datecreation
     *
     * @param \DateTime $datecreation
     *
     * @return Recruteur
     */
    public function setDatecreation($datecreation)
    {
        $this->datecreation = $datecreation;

        return $this;
    }

    /**
     * Get datecreation
     *
     * @return \DateTime
     */
    public function getDatecreation()
    {
        return $this->datecreation;
    }

    /**
     * Set datemaj
     *
     * @param \DateTime $datemaj
     *
     * @return Recruteur
     */
    public function setDatemaj($datemaj)
    {
        $this->datemaj = $datemaj;

        return $this;
    }

    /**
     * Get datemaj
     *
     * @return \DateTime
     */
    public function getDatemaj()
    {
        return $this->datemaj;
    }

    /**
     * Set logo
     *
     * @param string $logo
     *
     * @return Recruteur
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set idTyperecruteur
     *
     * @param integer $idTyperecruteur
     *
     * @return Recruteur
     */
    public function setIdTyperecruteur($idTyperecruteur)
    {
        $this->idTyperecruteur = $idTyperecruteur;

        return $this;
    }

    /**
     * Get idTyperecruteur
     *
     * @return integer
     */
    public function getIdTyperecruteur()
    {
        return $this->idTyperecruteur;
    }

    /**
     * Set newsletter
     *
     * @param integer $newsletter
     *
     * @return Recruteur
     */
    public function setNewsletter($newsletter)
    {
        $this->newsletter = $newsletter;

        return $this;
    }

    /**
     * Get newsletter
     *
     * @return integer
     */
    public function getNewsletter()
    {
        return $this->newsletter;
    }

    /**
     * Set flagenhaut
     *
     * @param integer $flagenhaut
     *
     * @return Recruteur
     */
    public function setFlagenhaut($flagenhaut)
    {
        $this->flagenhaut = $flagenhaut;

        return $this;
    }

    /**
     * Get flagenhaut
     *
     * @return integer
     */
    public function getFlagenhaut()
    {
        return $this->flagenhaut;
    }

    /**
     * Set etat
     *
     * @param integer $etat
     *
     * @return Recruteur
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return integer
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set idRecruteurformule
     *
     * @param integer $idRecruteurformule
     *
     * @return Recruteur
     */
    public function setIdRecruteurformule($idRecruteurformule)
    {
        $this->idRecruteurformule = $idRecruteurformule;

        return $this;
    }

    /**
     * Get idRecruteurformule
     *
     * @return integer
     */
    public function getIdRecruteurformule()
    {
        return $this->idRecruteurformule;
    }

    /**
     * Set receptionmailconfirmation
     *
     * @param integer $receptionmailconfirmation
     *
     * @return Recruteur
     */
    public function setReceptionmailconfirmation($receptionmailconfirmation)
    {
        $this->receptionmailconfirmation = $receptionmailconfirmation;

        return $this;
    }

    /**
     * Get receptionmailconfirmation
     *
     * @return integer
     */
    public function getReceptionmailconfirmation()
    {
        return $this->receptionmailconfirmation;
    }

    /**
     * Set user
     *
     * @param \OC\UserBundle\Entity\User $user
     *
     * @return Recruteur
     */
    public function setUser(\OC\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \OC\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add annonce
     *
     * @param \OC\UserBundle\Entity\Sy_Annonce $annonce
     *
     * @return Sy_Employeur
     */
    public function addAnnonce(\OC\UserBundle\Entity\Sy_Annonce $annonce)
    {
        $this->annonce[] = $annonce;

        return $this;
    }

    /**
     * Remove annonce
     *
     * @param \OC\UserBundle\Entity\Sy_Annonce $annonce
     */
    public function removeAnnonce(\OC\UserBundle\Entity\Sy_Annonce $annonce)
    {
        $this->annonce->removeElement($annonce);
    }

    /**
     * Get annonce
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnnonce()
    {
        return $this->annonce;
    }

    /**
     * Add candidat
     *
     * @param \OC\UserBundle\Entity\Sy_CvTheque $candidat
     *
     * @return Sy_Employeur
     */
    public function addCandidat(\OC\UserBundle\Entity\Sy_CvTheque $candidat)
    {
        $this->candidat[] = $candidat;

        return $this;
    }

    /**
     * Remove candidat
     *
     * @param \OC\UserBundle\Entity\Sy_CvTheque $candidat
     */
    public function removeCandidat(\OC\UserBundle\Entity\Sy_CvTheque $candidat)
    {
        $this->candidat->removeElement($candidat);
    }

    /**
     * Get candidat
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCandidat()
    {
        return $this->candidat;
    }
}
