<?php

namespace OC\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use OC\UserBundle\Entity\User;

/**
 * Candidat
 *
 * @ORM\Table(name="candidat")
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Repository\CandidatRepository")
**/
class Candidat 
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="OC\UserBundle\Entity\Sy_Civilite")
	 * @ORM\JoinColumn(nullable=false)
     */
    private $idCivilite;

    /**
     * @var string
     *
     * @ORM\Column(name="NomCandidat", type="string", length=255, nullable=false)
     */
    private $nomcandidat;

    /**
     * @var string
     *
     * @ORM\Column(name="PrenomCandidat", type="string", length=255, nullable=false)
     */
    private $prenomcandidat;

    /**
     * @var string
     *
     * @ORM\Column(name="AdresseCandidat", type="string", length=255, nullable=false)
     */
    private $adressecandidat;

    /**
     * @var string
     *
     * @ORM\Column(name="CpCandidat", type="string", length=255, nullable=false)
     */
    private $cpcandidat;

    /**
     * @var string
     *
     * @ORM\Column(name="VilleCandidat", type="string", length=255, nullable=false)
     */
    private $villecandidat;

    /**
     * @var string
     *
     * @ORM\Column(name="TelFixeCandidat", type="string", length=255, nullable=true)
     */
    private $telfixecandidat;

    /**
     * @var string
     *
     * @ORM\Column(name="TelPortCandidat", type="string", length=255, nullable=false)
     */
    private $telportcandidat;

    /**
     * @var string
     *
     * @ORM\Column(name="MailCandidat", type="string", length=255, nullable=true)
     */
    private $mailcandidat;

    /**
     * @ORM\Column(type="string",nullable = true)
     *
     * @Assert\NotBlank(message="Veuillez entrer votre CV :")
     * @Assert\File(mimeTypes={ "application/pdf" })
     */
    private $cvcandidat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateCreation", type="date", nullable=false)
     */
    private $datecreation;

    /**
     * @var string
     *
     * @ORM\Column(name="Pwd", type="string", length=255, nullable=true)
     */
    private $pwd;

    /**
     * @var string
     *
     * @ORM\Column(name="Photo", type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @var integer
     *
     * @ORM\Column(name="Newsletter", type="integer", nullable=true)
     */
    private $newsletter = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="Anonymat", type="integer", nullable=true)
     */
    private $anonymat;

    /**
     * @var integer
     *
     * @ORM\Column(name="FlagStatut", type="integer", nullable=true)
     */
    private $flagstatut;

    /**
     * @var string
     *
     * @ORM\Column(name="NumCandidat", type="string", length=255, nullable=true)
     */
    private $numcandidat;

    /**
     * @var integer
     *
     * @ORM\Column(name="CvIndexe", type="integer", nullable=true)
     */
    private $cvindexe = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateMaj", type="date", nullable=true)
     */
    private $datemaj;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateNewsletter", type="date", nullable=true)
     */
    private $datenewsletter;

    /**
     * @var string
     *
     * @ORM\Column(name="Id_AncienSE", type="string", length=255, nullable=true)
     */
    private $idAnciense;

	/**
     * @var integer
     *
     * @ORM\OneToOne(targetEntity="OC\UserBundle\Entity\User")
	 * 
     */
	private $user;
	
	/**
     * @var integer
     *
     * @ORM\OneToMany(targetEntity="OC\UserBundle\Entity\Sy_Candidature",mappedBy="idCandidat")
	 * 
     */
	private $candidature;
	
	
	/**
     * Constructor
     */
    public function __construct()
    {
		$this->datecreation = new \DateTime('now');
		$this->datemaj = new \DateTime('now');
    }
	
	
    

    /**
     * Set nomcandidat
     *
     * @param string $nomcandidat
     *
     * @return Candidat
     */
    public function setNomcandidat($nomcandidat)
    {
        $this->nomcandidat = $nomcandidat;

        return $this;
    }

    /**
     * Get nomcandidat
     *
     * @return string
     */
    public function getNomcandidat()
    {
        return $this->nomcandidat;
    }

    /**
     * Set prenomcandidat
     *
     * @param string $prenomcandidat
     *
     * @return Candidat
     */
    public function setPrenomcandidat($prenomcandidat)
    {
        $this->prenomcandidat = $prenomcandidat;

        return $this;
    }

    /**
     * Get prenomcandidat
     *
     * @return string
     */
    public function getPrenomcandidat()
    {
        return $this->prenomcandidat;
    }

    /**
     * Set adressecandidat
     *
     * @param string $adressecandidat
     *
     * @return Candidat
     */
    public function setAdressecandidat($adressecandidat)
    {
        $this->adressecandidat = $adressecandidat;

        return $this;
    }

    /**
     * Get adressecandidat
     *
     * @return string
     */
    public function getAdressecandidat()
    {
        return $this->adressecandidat;
    }

    /**
     * Set cpcandidat
     *
     * @param string $cpcandidat
     *
     * @return Candidat
     */
    public function setCpcandidat($cpcandidat)
    {
        $this->cpcandidat = $cpcandidat;

        return $this;
    }

    /**
     * Get cpcandidat
     *
     * @return string
     */
    public function getCpcandidat()
    {
        return $this->cpcandidat;
    }

    /**
     * Set villecandidat
     *
     * @param string $villecandidat
     *
     * @return Candidat
     */
    public function setVillecandidat($villecandidat)
    {
        $this->villecandidat = $villecandidat;

        return $this;
    }

    /**
     * Get villecandidat
     *
     * @return string
     */
    public function getVillecandidat()
    {
        return $this->villecandidat;
    }

    /**
     * Set telfixecandidat
     *
     * @param string $telfixecandidat
     *
     * @return Candidat
     */
    public function setTelfixecandidat($telfixecandidat)
    {
        $this->telfixecandidat = $telfixecandidat;

        return $this;
    }

    /**
     * Get telfixecandidat
     *
     * @return string
     */
    public function getTelfixecandidat()
    {
        return $this->telfixecandidat;
    }

    /**
     * Set telportcandidat
     *
     * @param string $telportcandidat
     *
     * @return Candidat
     */
    public function setTelportcandidat($telportcandidat)
    {
        $this->telportcandidat = $telportcandidat;

        return $this;
    }

    /**
     * Get telportcandidat
     *
     * @return string
     */
    public function getTelportcandidat()
    {
        return $this->telportcandidat;
    }

    /**
     * Set mailcandidat
     *
     * @param string $mailcandidat
     *
     * @return Candidat
     */
    public function setMailcandidat($mailcandidat)
    {
        $this->mailcandidat = $mailcandidat;

        return $this;
    }

    /**
     * Get mailcandidat
     *
     * @return string
     */
    public function getMailcandidat()
    {
        return $this->mailcandidat;
    }

    /**
     * Set cvcandidat
     *
     * @param string $cvcandidat
     *
     * @return Candidat
     */
    public function setCvcandidat($cvcandidat)
    {
        $this->cvcandidat = $cvcandidat;

        return $this;
    }

    /**
     * Get cvcandidat
     *
     * @return string
     */
    public function getCvcandidat()
    {
        return $this->cvcandidat;
    }

    /**
     * Set datecreation
     *
     * @param \DateTime $datecreation
     *
     * @return Candidat
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
     * Set pwd
     *
     * @param string $pwd
     *
     * @return Candidat
     */
    public function setPwd($pwd)
    {
        $this->pwd = $pwd;

        return $this;
    }

    /**
     * Get pwd
     *
     * @return string
     */
    public function getPwd()
    {
        return $this->pwd;
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return Candidat
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set newsletter
     *
     * @param integer $newsletter
     *
     * @return Candidat
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
     * Set anonymat
     *
     * @param integer $anonymat
     *
     * @return Candidat
     */
    public function setAnonymat($anonymat)
    {
        $this->anonymat = $anonymat;

        return $this;
    }

    /**
     * Get anonymat
     *
     * @return integer
     */
    public function getAnonymat()
    {
        return $this->anonymat;
    }

    /**
     * Set flagstatut
     *
     * @param integer $flagstatut
     *
     * @return Candidat
     */
    public function setFlagstatut($flagstatut)
    {
        $this->flagstatut = $flagstatut;

        return $this;
    }

    /**
     * Get flagstatut
     *
     * @return integer
     */
    public function getFlagstatut()
    {
        return $this->flagstatut;
    }

    /**
     * Set numcandidat
     *
     * @param string $numcandidat
     *
     * @return Candidat
     */
    public function setNumcandidat($numcandidat)
    {
        $this->numcandidat = $numcandidat;

        return $this;
    }

    /**
     * Get numcandidat
     *
     * @return string
     */
    public function getNumcandidat()
    {
        return $this->numcandidat;
    }

    /**
     * Set cvindexe
     *
     * @param integer $cvindexe
     *
     * @return Candidat
     */
    public function setCvindexe($cvindexe)
    {
        $this->cvindexe = $cvindexe;

        return $this;
    }

    /**
     * Get cvindexe
     *
     * @return integer
     */
    public function getCvindexe()
    {
        return $this->cvindexe;
    }

    /**
     * Set datemaj
     *
     * @param \DateTime $datemaj
     *
     * @return Candidat
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
     * Set datenewsletter
     *
     * @param \DateTime $datenewsletter
     *
     * @return Candidat
     */
    public function setDatenewsletter($datenewsletter)
    {
        $this->datenewsletter = $datenewsletter;

        return $this;
    }

    /**
     * Get datenewsletter
     *
     * @return \DateTime
     */
    public function getDatenewsletter()
    {
        return $this->datenewsletter;
    }

    /**
     * Set idAnciense
     *
     * @param string $idAnciense
     *
     * @return Candidat
     */
    public function setIdAnciense($idAnciense)
    {
        $this->idAnciense = $idAnciense;

        return $this;
    }

    /**
     * Get idAnciense
     *
     * @return string
     */
    public function getIdAnciense()
    {
        return $this->idAnciense;
    }

    /**
     * Set idCivilite
     *
     * @param \OC\UserBundle\Entity\Sy_Civilite $idCivilite
     *
     * @return Candidat
     */
    public function setIdCivilite(\OC\UserBundle\Entity\Sy_Civilite $idCivilite)
    {
        $this->idCivilite = $idCivilite;

        return $this;
    }

    /**
     * Get idCivilite
     *
     * @return \OC\UserBundle\Entity\Sy_Civilite
     */
    public function getIdCivilite()
    {
        return $this->idCivilite;
    }

    /**
     * Set user
     *
     * @param \OC\UserBundle\Entity\User $user
     *
     * @return Candidat
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
     * Add candidature
     *
     * @param \OC\UserBundle\Entity\Sy_Candidature $candidature
     *
     * @return Candidat
     */
    public function addCandidature(\OC\UserBundle\Entity\Sy_Candidature $candidature)
    {
        $this->candidature[] = $candidature;

        return $this;
    }

    /**
     * Remove candidature
     *
     * @param \OC\UserBundle\Entity\Sy_Candidature $candidature
     */
    public function removeCandidature(\OC\UserBundle\Entity\Sy_Candidature $candidature)
    {
        $this->candidature->removeElement($candidature);
    }

    /**
     * Get candidature
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCandidature()
    {
        return $this->candidature;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
