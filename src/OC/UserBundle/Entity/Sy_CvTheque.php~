<?php

namespace OC\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sy_CvTheque
 *
 * @ORM\Table(name="Sy_cvtheque")
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Repository\CandidatRepository")
 * 
**/
class Sy_CvTheque 
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
     * @ORM\Column(name="Nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="Prenom", type="string", length=255, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="Mail", type="string", length=255, nullable=false)
     */
    private $mail;
	
    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="OC\PlatformBundle\Entity\Ville")
	 * @ORM\JoinColumn(nullable=false)
	 * 
     */
    private $codePostal;

	/**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="OC\UserBundle\Entity\Sy_Siteemploi")
	 * @ORM\JoinColumn(nullable=false)
     */
    private $idSite;

	/**
     * @var integer
     *
     * @ORM\ManyToMany(targetEntity="OC\PlatformBundle\Entity\Annonce")
     */
    private $annonce;
	
	/**
     * @var integer
     *
     * @ORM\ManyToMany(targetEntity="OC\UserBundle\Entity\Sy_Annonce")
     */
    private $sy_annonce;
	
	/**
     * @var integer
     *
     * @ORM\ManyToMany(targetEntity="OC\UserBundle\Entity\Sy_Fonction")
     */
	private $fonction;
	

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
     * Set nom
     *
     * @param string $nom
     *
     * @return Sy_CvTheque
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Sy_CvTheque
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set mail
     *
     * @param string $mail
     *
     * @return Sy_CvTheque
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set cp
     *
     * @param integer $cp
     *
     * @return Sy_CvTheque
     */
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get cp
     *
     * @return integer
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set idSite
     *
     * @param integer $idSite
     *
     * @return Sy_CvTheque
     */
    public function setIdSite($idSite)
    {
        $this->idSite = $idSite;

        return $this;
    }

    /**
     * Get idSite
     *
     * @return integer
     */
    public function getIdSite()
    {
        return $this->idSite;
    }

    /**
     * Set annonce
     *
     * @param integer $annonce
     *
     * @return Sy_CvTheque
     */
    public function setAnnonce($annonce)
    {
        $this->annonce = $annonce;

        return $this;
    }

    /**
     * Get annonce
     *
     * @return integer
     */
    public function getAnnonce()
    {
        return $this->annonce;
    }

    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->annonce = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add annonce
     *
     * @param \OC\PlatformBundle\Entity\Annonce $annonce
     *
     * @return Sy_CvTheque
     */
    public function addAnnonce(\OC\PlatformBundle\Entity\Annonce $annonce)
    {
        $this->annonce[] = $annonce;

        return $this;
    }

    /**
     * Remove annonce
     *
     * @param \OC\PlatformBundle\Entity\Annonce $annonce
     */
    public function removeAnnonce(\OC\PlatformBundle\Entity\Annonce $annonce)
    {
        $this->annonce->removeElement($annonce);
    }



    /**
     * Set codePostal
     *
     * @param \OC\PlatformBundle\Entity\Ville $codePostal
     *
     * @return Sy_CvTheque
     */
    public function setCodePostal(\OC\PlatformBundle\Entity\Ville $codePostal)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal
     *
     * @return \OC\PlatformBundle\Entity\Ville
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Add fonction
     *
     * @param \OC\UserBundle\Entity\Sy_Fonction $fonction
     *
     * @return Sy_CvTheque
     */
    public function addFonction(\OC\UserBundle\Entity\Sy_Fonction $fonction)
    {
        $this->fonction[] = $fonction;

        return $this;
    }

    /**
     * Remove fonction
     *
     * @param \OC\UserBundle\Entity\Sy_Fonction $fonction
     */
    public function removeFonction(\OC\UserBundle\Entity\Sy_Fonction $fonction)
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
     * Add syAnnonce
     *
     * @param \OC\UserBundle\Entity\Sy_Annonce $syAnnonce
     *
     * @return Sy_CvTheque
     */
    public function addSyAnnonce(\OC\UserBundle\Entity\Sy_Annonce $syAnnonce)
    {
        $this->sy_annonce[] = $syAnnonce;

        return $this;
    }

    /**
     * Remove syAnnonce
     *
     * @param \OC\UserBundle\Entity\Sy_Annonce $syAnnonce
     */
    public function removeSyAnnonce(\OC\UserBundle\Entity\Sy_Annonce $syAnnonce)
    {
        $this->sy_annonce->removeElement($syAnnonce);
    }

    /**
     * Get syAnnonce
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSyAnnonce()
    {
        return $this->sy_annonce;
    }
}
