<?php

namespace OC\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Eko\FeedBundle\Item\Writer\ItemInterface;
/**
 * Sy_Annonce
 *
 * 
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Repository\AnnonceRepository")
 */
class Sy_Annonce implements ItemInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="TitreAnnonce", type="string", length=255, nullable=false)
     */
    private $titreannonce;

    /**
     * @var string
     *
     * @ORM\Column(name="DescriptifAnnonce", type="text", length=65535, nullable=false)
     */
    private $descriptifannonce;

    /**
     * @var string
     *
     * @ORM\Column(name="ProfilRecherche", type="text", length=65535, nullable=false)
     */
    private $profilrecherche;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateDebut", type="date", nullable=true)
     */
    private $datedebut;

    /**
     * @var string
     *
     * @ORM\Column(name="Remuneration", type="string", length=255, nullable=false)
     */
    private $remuneration;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="OC\PlatformBundle\Entity\Typecontrat")
     */
    private $idTypecontrat;

    /**
     * @var string
     *
     * @ORM\Column(name="DureeContrat", type="text", length=65535, nullable=true)
     */
    private $dureecontrat;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="OC\PlatformBundle\Entity\Niveausouhaite")
	 * @ORM\JoinColumn(nullable=false)
     */
    private $idNiveauSouhaite;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="OC\PlatformBundle\Entity\Departement")
	 * @ORM\JoinColumn(nullable=false)
     */
    private $idDepartement;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="OC\UserBundle\Entity\Sy_Recruteur")
	 * @ORM\JoinColumn(nullable=true)
     */
    private $idRecruteur;
	
    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="OC\UserBundle\Entity\Sy_Employeur")
	 * @ORM\JoinColumn(nullable=true)
     */
    private $idEmployeur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateCreation", type="datetime", nullable=false)
     */
    private $datecreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DatePublication", type="date", nullable=true)
     */
    private $datepublication;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateFinPublication", type="date", nullable=true)
     */
    private $datefinpublication;

    /**
     * @var integer
     *
     * @ORM\Column(name="Suspension", type="integer", nullable=false)
     */
    private $suspension;
	
	/**
     * @var \DateTime
     *
     * @ORM\Column(name="DateSuspension", type="date", nullable=true)
     */
    private $dateSuspension;
	
	/**
     * @var \DateTime
     *
     * @ORM\Column(name="DateMAJ", type="date", nullable=true)
     */
    private $dateMAJ;
	
	

    /**
     * @var string
     *
     * @ORM\Column(name="GrandeVilleProche", type="string", length=255, nullable=false)
     */
    private $grandevilleproche;

    /**
     * @var string
     *
     * @ORM\Column(name="Avantage", type="text", length=65535, nullable=true)
     */
    private $avantage;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="OC\PlatformBundle\Entity\Horaire")
     */
    private $idHoraire;

    /**
     * @var string
     *
     * @ORM\Column(name="NbHeure", type="string", length=255, nullable=false)
     */
    private $nbheure;

    /**
     * @var integer
     *
     * @ORM\Column(name="NbVues", type="integer", nullable=false)
     */
    private $nbvues = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DatePublicationRss", type="datetime", nullable=true)
     */
    private $datepublicationrss;

    /**
     * @var string
     *
     * @ORM\Column(name="ReferenceRecruteur", type="string", length=255, nullable=true)
     */
    private $referencerecruteur;

    /**
     * @var string
     *
     * @ORM\Column(name="Reference", type="string", length=255, nullable=true)
     */
    private $reference;

    /**
     * @var string
     *
     * @ORM\Column(name="DescriptionEmployeur", type="text", length=65535, nullable=true)
     */
    private $descriptionemployeur;

    /**
     * @var integer
     *
     * @ORM\Column(name="Id_Formule", type="integer", nullable=true)
     */
    private $idFormule = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="FlagIndeed", type="integer", nullable=true)
     */
    private $flagindeed = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="DescriptionRecruteurProfil", type="text", length=65535, nullable=true)
     */
    private $descriptionrecruteurprofil;

    /**
     * @var string
     *
     * @ORM\Column(name="AdresseReponse", type="string", length=255, nullable=true)
     */
    private $adressereponse;

    /**
     * @var string
     *
     * @ORM\Column(name="DeptLimitrophe", type="string", length=255, nullable=true)
     */
    private $deptlimitrophe;

    /**
     * @var boolean
     *
     * @ORM\Column(name="FlagPmeJob", type="boolean", nullable=true)
     */
    private $flagpmejob = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="TexteIndeed", type="text", length=65535, nullable=true)
     */
    private $texteindeed;

    /**
     * @var string
     *
     * @ORM\Column(name="ReferencePoleEmploi", type="string", length=255, nullable=true)
     */
    private $referencepoleemploi;

    /**
     * @var integer
     *
     * @ORM\Column(name="Id_RejetAnnonce", type="integer", nullable=true)
     */
    private $idRejetannonce = '0';
	
	/**
     * @var integer
     *
     * @ORM\OneToMany(targetEntity="OC\UserBundle\Entity\Sy_Annonce_Sy_Siteemploi",mappedBy="idAnnonce",cascade={"persist"})
     */
	private $site;
	
	/**
     * @var integer
     *
     * @ORM\OneToMany(targetEntity="OC\UserBundle\Entity\Sy_Annonce_Sy_Siteemploi",mappedBy="idAnnonce",cascade={"persist"})
     */
	private $fonction;

	/**
     * @var integer
     *
     * @ORM\Column(name="Premium", type="integer", nullable=true)
     */
	private $premium;
	
	/**
     * @var integer
     *
     * @ORM\OneToMany(targetEntity="OC\UserBundle\Entity\Sy_Candidature",mappedBy="annonce",cascade={"persist"})
     */
	private $candidature;
	
	/**
     * @var integer
     *
     * @ORM\ManyToMany(targetEntity="OC\UserBundle\Entity\Sy_CvTheque")
     */
	private $candidatContact;
	
	/**
     * @var integer
     *
     * @ORM\Column(name="CodePostal", type="integer", nullable=true)
     */
	private $codePostal;
	
	/**
     * @var integer
     *
     * @ORM\Column(name="New", type="integer", nullable=true)
     */
	private $New = true;
	
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titreannonce
     *
     * @param string $titreannonce
     *
     * @return Annonce
     */
    public function setTitreannonce($titreannonce)
    {
        $this->titreannonce = $titreannonce;

        return $this;
    }

    /**
     * Get titreannonce
     *
     * @return string
     */
    public function getTitreannonce()
    {
        return $this->titreannonce;
    }

    /**
     * Set descriptifannonce
     *
     * @param string $descriptifannonce
     *
     * @return Annonce
     */
    public function setDescriptifannonce($descriptifannonce)
    {
        $this->descriptifannonce = $descriptifannonce;

        return $this;
    }

    /**
     * Get descriptifannonce
     *
     * @return string
     */
    public function getDescriptifannonce()
    {
        return $this->descriptifannonce;
    }

    /**
     * Set profilrecherche
     *
     * @param string $profilrecherche
     *
     * @return Annonce
     */
    public function setProfilrecherche($profilrecherche)
    {
        $this->profilrecherche = $profilrecherche;

        return $this;
    }

    /**
     * Get profilrecherche
     *
     * @return string
     */
    public function getProfilrecherche()
    {
        return $this->profilrecherche;
    }

    /**
     * Set datedebut
     *
     * @param \DateTime $datedebut
     *
     * @return Annonce
     */
    public function setDatedebut($datedebut)
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    /**
     * Get datedebut
     *
     * @return \DateTime
     */
    public function getDatedebut()
    {
        return $this->datedebut;
    }

    /**
     * Set remuneration
     *
     * @param string $remuneration
     *
     * @return Annonce
     */
    public function setRemuneration($remuneration)
    {
        $this->remuneration = $remuneration;

        return $this;
    }

    /**
     * Get remuneration
     *
     * @return string
     */
    public function getRemuneration()
    {
        return $this->remuneration;
    }

    /**
     * Set idTypecontrat
     *
     * @param integer $idTypecontrat
     *
     * @return Annonce
     */
    public function setIdTypecontrat($idTypecontrat)
    {
        $this->idTypecontrat = $idTypecontrat;

        return $this;
    }

    /**
     * Get idTypecontrat
     *
     * @return integer
     */
    public function getIdTypecontrat()
    {
        return $this->idTypecontrat;
    }

    /**
     * Set dureecontrat
     *
     * @param string $dureecontrat
     *
     * @return Annonce
     */
    public function setDureecontrat($dureecontrat)
    {
        $this->dureecontrat = $dureecontrat;

        return $this;
    }

    /**
     * Get dureecontrat
     *
     * @return string
     */
    public function getDureecontrat()
    {
        return $this->dureecontrat;
    }

    /**
     * Set idDepartement
     *
     * @param integer $idDepartement
     *
     * @return Annonce
     */
    public function setIdDepartement($idDepartement)
    {
        $this->idDepartement = $idDepartement;

        return $this;
    }

    /**
     * Get idDepartement
     *
     * @return integer
     */
    public function getIdDepartement()
    {
        return $this->idDepartement;
    }

    /**
     * Set idRecruteur
     *
     * @param integer $idRecruteur
     *
     * @return Annonce
     */
    public function setIdRecruteur($idRecruteur)
    {
        $this->idRecruteur = $idRecruteur;

        return $this;
    }

    /**
     * Get idRecruteur
     *
     * @return integer
     */
    public function getIdRecruteur()
    {
        return $this->idRecruteur;
    }

    /**
     * Set datecreation
     *
     * @param \DateTime $datecreation
     *
     * @return Annonce
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
     * Set datepublication
     *
     * @param \DateTime $datepublication
     *
     * @return Annonce
     */
    public function setDatepublication($datepublication)
    {
        $this->datepublication = $datepublication;

        return $this;
    }

    /**
     * Get datepublication
     *
     * @return \DateTime
     */
    public function getDatepublication()
    {
        return $this->datepublication;
    }

    /**
     * Set datefinpublication
     *
     * @param \DateTime $datefinpublication
     *
     * @return Annonce
     */
    public function setDatefinpublication($datefinpublication)
    {
        $this->datefinpublication = $datefinpublication;

        return $this;
    }

    /**
     * Get datefinpublication
     *
     * @return \DateTime
     */
    public function getDatefinpublication()
    {
        return $this->datefinpublication;
    }

    /**
     * Set suspension
     *
     * @param integer $suspension
     *
     * @return Annonce
     */
    public function setSuspension($suspension)
    {
        $this->suspension = $suspension;

        return $this;
    }

    /**
     * Get suspension
     *
     * @return integer
     */
    public function getSuspension()
    {
        return $this->suspension;
    }

    /**
     * Set grandevilleproche
     *
     * @param string $grandevilleproche
     *
     * @return Annonce
     */
    public function setGrandevilleproche($grandevilleproche)
    {
        $this->grandevilleproche = $grandevilleproche;

        return $this;
    }

    /**
     * Get grandevilleproche
     *
     * @return string
     */
    public function getGrandevilleproche()
    {
        return $this->grandevilleproche;
    }

    /**
     * Set avantage
     *
     * @param string $avantage
     *
     * @return Annonce
     */
    public function setAvantage($avantage)
    {
        $this->avantage = $avantage;

        return $this;
    }

    /**
     * Get avantage
     *
     * @return string
     */
    public function getAvantage()
    {
        return $this->avantage;
    }

    /**
     * Set idHoraire
     *
     * @param integer $idHoraire
     *
     * @return Annonce
     */
    public function setIdHoraire($idHoraire)
    {
        $this->idHoraire = $idHoraire;

        return $this;
    }

    /**
     * Get idHoraire
     *
     * @return integer
     */
    public function getIdHoraire()
    {
        return $this->idHoraire;
    }

    /**
     * Set nbheure
     *
     * @param string $nbheure
     *
     * @return Annonce
     */
    public function setNbheure($nbheure)
    {
        $this->nbheure = $nbheure;

        return $this;
    }

    /**
     * Get nbheure
     *
     * @return string
     */
    public function getNbheure()
    {
        return $this->nbheure;
    }

    /**
     * Set nbvues
     *
     * @param integer $nbvues
     *
     * @return Annonce
     */
    public function setNbvues($nbvues)
    {
        $this->nbvues = $nbvues;

        return $this;
    }

    /**
     * Get nbvues
     *
     * @return integer
     */
    public function getNbvues()
    {
        return $this->nbvues;
    }

    /**
     * Set datepublicationrss
     *
     * @param \DateTime $datepublicationrss
     *
     * @return Annonce
     */
    public function setDatepublicationrss($datepublicationrss)
    {
        $this->datepublicationrss = $datepublicationrss;

        return $this;
    }

    /**
     * Get datepublicationrss
     *
     * @return \DateTime
     */
    public function getDatepublicationrss()
    {
        return $this->datepublicationrss;
    }

    /**
     * Set referencerecruteur
     *
     * @param string $referencerecruteur
     *
     * @return Annonce
     */
    public function setReferencerecruteur($referencerecruteur)
    {
        $this->referencerecruteur = $referencerecruteur;

        return $this;
    }

    /**
     * Get referencerecruteur
     *
     * @return string
     */
    public function getReferencerecruteur()
    {
        return $this->referencerecruteur;
    }

    /**
     * Set reference
     *
     * @param string $reference
     *
     * @return Annonce
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set descriptionemployeur
     *
     * @param string $descriptionemployeur
     *
     * @return Annonce
     */
    public function setDescriptionemployeur($descriptionemployeur)
    {
        $this->descriptionemployeur = $descriptionemployeur;

        return $this;
    }

    /**
     * Get descriptionemployeur
     *
     * @return string
     */
    public function getDescriptionemployeur()
    {
        return $this->descriptionemployeur;
    }

    /**
     * Set idFormule
     *
     * @param integer $idFormule
     *
     * @return Annonce
     */
    public function setIdFormule($idFormule)
    {
        $this->idFormule = $idFormule;

        return $this;
    }

    /**
     * Get idFormule
     *
     * @return integer
     */
    public function getIdFormule()
    {
        return $this->idFormule;
    }

    /**
     * Set flagindeed
     *
     * @param integer $flagindeed
     *
     * @return Annonce
     */
    public function setFlagindeed($flagindeed)
    {
        $this->flagindeed = $flagindeed;

        return $this;
    }

    /**
     * Get flagindeed
     *
     * @return integer
     */
    public function getFlagindeed()
    {
        return $this->flagindeed;
    }

    /**
     * Set descriptionrecruteurprofil
     *
     * @param string $descriptionrecruteurprofil
     *
     * @return Annonce
     */
    public function setDescriptionrecruteurprofil($descriptionrecruteurprofil)
    {
        $this->descriptionrecruteurprofil = $descriptionrecruteurprofil;

        return $this;
    }

    /**
     * Get descriptionrecruteurprofil
     *
     * @return string
     */
    public function getDescriptionrecruteurprofil()
    {
        return $this->descriptionrecruteurprofil;
    }

    /**
     * Set adressereponse
     *
     * @param string $adressereponse
     *
     * @return Annonce
     */
    public function setAdressereponse($adressereponse)
    {
        $this->adressereponse = $adressereponse;

        return $this;
    }

    /**
     * Get adressereponse
     *
     * @return string
     */
    public function getAdressereponse()
    {
        return $this->adressereponse;
    }

    /**
     * Set deptlimitrophe
     *
     * @param string $deptlimitrophe
     *
     * @return Annonce
     */
    public function setDeptlimitrophe($deptlimitrophe)
    {
        $this->deptlimitrophe = $deptlimitrophe;

        return $this;
    }

    /**
     * Get deptlimitrophe
     *
     * @return string
     */
    public function getDeptlimitrophe()
    {
        return $this->deptlimitrophe;
    }

    /**
     * Set flagpmejob
     *
     * @param boolean $flagpmejob
     *
     * @return Annonce
     */
    public function setFlagpmejob($flagpmejob)
    {
        $this->flagpmejob = $flagpmejob;

        return $this;
    }

    /**
     * Get flagpmejob
     *
     * @return boolean
     */
    public function getFlagpmejob()
    {
        return $this->flagpmejob;
    }

    /**
     * Set texteindeed
     *
     * @param string $texteindeed
     *
     * @return Annonce
     */
    public function setTexteindeed($texteindeed)
    {
        $this->texteindeed = $texteindeed;

        return $this;
    }

    /**
     * Get texteindeed
     *
     * @return string
     */
    public function getTexteindeed()
    {
        return $this->texteindeed;
    }

    /**
     * Set referencepoleemploi
     *
     * @param string $referencepoleemploi
     *
     * @return Annonce
     */
    public function setReferencepoleemploi($referencepoleemploi)
    {
        $this->referencepoleemploi = $referencepoleemploi;

        return $this;
    }

    /**
     * Get referencepoleemploi
     *
     * @return string
     */
    public function getReferencepoleemploi()
    {
        return $this->referencepoleemploi;
    }

    /**
     * Set idRejetannonce
     *
     * @param integer $idRejetannonce
     *
     * @return Annonce
     */
    public function setIdRejetannonce($idRejetannonce)
    {
        $this->idRejetannonce = $idRejetannonce;

        return $this;
    }

    /**
     * Get idRejetannonce
     *
     * @return integer
     */
    public function getIdRejetannonce()
    {
        return $this->idRejetannonce;
    }

   


    /**
     * Set idNiveauSouhaite
     *
     * @param \OC\PlatformBundle\Entity\Niveausouhaite $idNiveauSouhaite
     *
     * @return Annonce
     */
    public function setIdNiveauSouhaite(\OC\PlatformBundle\Entity\Niveausouhaite $idNiveauSouhaite)
    {
        $this->idNiveauSouhaite = $idNiveauSouhaite;

        return $this;
    }

    /**
     * Get idNiveauSouhaite
     *
     * @return \OC\PlatformBundle\Entity\Niveausouhaite
     */
    public function getIdNiveauSouhaite()
    {
        return $this->idNiveauSouhaite;
    }



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->site = new \Doctrine\Common\Collections\ArrayCollection();
		$this->datecreation = new \DateTime('now');
		$this->suspension = -1;
    }

    


    /**
     * Add site
     *
     * @param \OC\UserBundle\Entity\Sy_Annonce_Sy_Siteemploi $site
     *
     * @return Annonce
     */
    public function addSite(\OC\UserBundle\Entity\Sy_Annonce_Sy_Siteemploi $site)
    {
        $this->site[] = $site;
		$site->setIdAnnonce($this);
        return $this;
    }

    /**
     * Remove site
     *
     * @param \OC\UserBundle\Entity\Sy_Annonce_Sy_Siteemploi $site
     */
    public function removeSite(\OC\UserBundle\Entity\Sy_Annonce_Sy_Siteemploi $site)
    {
        $this->site->removeElement($site);
    }

    /**
     * Get site
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * Add fonction
     *
     * @param \OC\UserBundle\Entity\Sy_Annonce_Sy_Siteemploi $fonction
     *
     * @return Annonce
     */
    public function addFonction(\OC\UserBundle\Entity\Sy_Annonce_Sy_Siteemploi $fonction)
    {
        $this->fonction[] = $fonction;

        return $this;
    }

    /**
     * Remove fonction
     *
     * @param \OC\UserBundle\Entity\Sy_Annonce_Sy_Siteemploi $fonction
     */
    public function removeFonction(\OC\UserBundle\Entity\Sy_Annonce_Sy_Siteemploi $fonction)
    {
        $this->fonction->removeElement($fonction);
    }

    /**
     * Get fonction
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFonction()
    {
        return $this->fonction;
    }

	
	/**
	 * String representation of this object
	 * @return string
	*/
	public function __toString() {
		try {
			return (string) $this->titreannonce;
		} catch (Exception $exception) {
			return '';
		}
	}
	
	/**
     * Set premium
     *
     * @param integer $premium
     *
     * @return Annonce
     */
    public function setPremium($premium)
    {
        $this->premium = $premium;

        return $this;
    }

    /**
     * Get premium
     *
     * @return integer
     */
    public function getPremium()
    {
        return $this->premium;
    }
	
	/**
     * Add candidature
     *
     * @param \OC\UserBundle\Entity\Sy_Candidature $candidature
     *
     * @return Annonce
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
     * Set idEmployeur
     *
     * @param \OC\UserBundle\Entity\Sy_Employeur $idEmployeur
     *
     * @return Sy_Annonce
     */
    public function setIdEmployeur(\OC\UserBundle\Entity\Sy_Employeur $idEmployeur = null)
    {
        $this->idEmployeur = $idEmployeur;

        return $this;
    }

    /**
     * Get idEmployeur
     *
     * @return \OC\UserBundle\Entity\Sy_Employeur
     */
    public function getIdEmployeur()
    {
        return $this->idEmployeur;
    }

    /**
     * Set codePostal
     *
     * @param integer $codePostal
     *
     * @return Sy_Annonce
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal
     *
     * @return integer
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set new
     *
     * @param integer $new
     *
     * @return Sy_Annonce
     */
    public function setNew($new)
    {
        $this->New = $new;

        return $this;
    }

    /**
     * Get new
     *
     * @return integer
     */
    public function getNew()
    {
        return $this->New;
    }

    /**
     * Set dateSuspension
     *
     * @param \DateTime $dateSuspension
     *
     * @return Sy_Annonce
     */
    public function setDateSuspension($dateSuspension)
    {
        $this->dateSuspension = $dateSuspension;

        return $this;
    }

    /**
     * Get dateSuspension
     *
     * @return \DateTime
     */
    public function getDateSuspension()
    {
        return $this->dateSuspension;
    }

    /**
     * Set dateMAJ
     *
     * @param \DateTime $dateMAJ
     *
     * @return Sy_Annonce
     */
    public function setDateMAJ($dateMAJ)
    {
        $this->dateMAJ = $dateMAJ;

        return $this;
    }

    /**
     * Get dateMAJ
     *
     * @return \DateTime
     */
    public function getDateMAJ()
    {
        return $this->dateMAJ;
    }
	
	public function getFeedItemTitle() { 
		return $this->titreannonce;
	}
	
	public function getFeedItemDescription() {
		return $this->descriptifannonce;
	}
	
	public function getFeedItemPubDate() { 
		return $this->datepublication;
	}
	
	public function getFeedItemLink() {
		$site = $this->site;
		foreach($site as $s){
			$siteURL = $s->getIdSiteemploi()->getUrlsiteemploi();
		}
		return $siteURL."/Consultation/".$this->id;
	}

    /**
     * Add candidatContact
     *
     * @param \OC\UserBundle\Entity\Sy_CvTheque $candidatContact
     *
     * @return Sy_Annonce
     */
    public function addCandidatContact(\OC\UserBundle\Entity\Sy_CvTheque $candidatContact)
    {
        $this->candidatContact[] = $candidatContact;

        return $this;
    }

    /**
     * Remove candidatContact
     *
     * @param \OC\UserBundle\Entity\Sy_CvTheque $candidatContact
     */
    public function removeCandidatContact(\OC\UserBundle\Entity\Sy_CvTheque $candidatContact)
    {
        $this->candidatContact->removeElement($candidatContact);
    }

    /**
     * Get candidatContact
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCandidatContact()
    {
        return $this->candidatContact;
    }
}
