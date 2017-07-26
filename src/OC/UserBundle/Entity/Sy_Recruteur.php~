<?php

namespace OC\UserBundle\Entity;

use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;
use OC\UserBundle\Entity\User;

/**
 * Sy_Recruteur
 *
 * @ORM\Table(name="Sy_Recruteur")
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Repository\RecruteurRepository")
 * @UniqueEntity(fields = "username", targetClass = "OC\UserBundle\Entity\User", message="fos_user.username.already_used")
 * @UniqueEntity(fields = "email", targetClass = "OC\UserBundle\Entity\User", message="fos_user.email.already_used")
 */
class Sy_Recruteur extends User
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
     * @ORM\Column(name="Tel", type="string", length=255, nullable=false)
     */
    private $tel;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateCreation", type="date", nullable=false)
     */
    private $datecreation = '2011-12-01';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateMaj", type="date", nullable=false)
     */
    private $datemaj;


    /**
     * @var integer
     *
     * @ORM\Column(name="Newsletter", type="integer", nullable=true)
     */
    private $newsletter;
	
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
     * @var integer
     * 
     * @ORM\OneToOne(targetEntity="OC\PlatformBundle\Entity\Sy_Premium")
     */
	private $premium;
	
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
     * @return Sy_Recruteur
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
     * @return Sy_Recruteur
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
     * @return Sy_Recruteur
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
     * @return Sy_Recruteur
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
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Sy_Recruteur
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
     * @return Sy_Recruteur
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
     * @return Sy_Recruteur
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
     * @return Sy_Recruteur
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
     * Set tel
     *
     * @param string $tel
     *
     * @return Sy_Recruteur
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
     * Set datecreation
     *
     * @param \DateTime $datecreation
     *
     * @return Sy_Recruteur
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
     * @return Sy_Recruteur
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
     * Set newsletter
     *
     * @param integer $newsletter
     *
     * @return Sy_Recruteur
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
     * Add annonce
     *
     * @param \OC\UserBundle\Entity\Sy_Annonce $annonce
     *
     * @return Sy_Recruteur
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
     * @return Sy_Recruteur
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

    /**
     * Set premium
     *
     * @param \OC\PlatformBundle\Entity\Sy_Premium $premium
     *
     * @return Sy_Recruteur
     */
    public function setPremium(\OC\PlatformBundle\Entity\Sy_Premium $premium = null)
    {
        $this->premium = $premium;

        return $this;
    }

    /**
     * Get premium
     *
     * @return \OC\PlatformBundle\Entity\Sy_Premium
     */
    public function getPremium()
    {
        return $this->premium;
    }
}
