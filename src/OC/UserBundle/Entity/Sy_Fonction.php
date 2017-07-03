<?php

namespace OC\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sy_Fonction
 *
 * @ORM\Table(name="Sy_fonction")
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Repository\AnnonceRepository")
 */
class Sy_Fonction
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
     * @ORM\Column(name="IntituleFonction", type="string", length=255, nullable=false)
     */
    private $intitulefonction;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="OC\UserBundle\Entity\Sy_Siteemploi")
	 * @ORM\JoinColumn(nullable=false)
     */
    private $idSiteEmploi;

    /**
     * @var integer
     *
     * @ORM\Column(name="Id_SiteDistant", type="integer", nullable=true)
     */
    private $idSitedistant;



    /**
     * Set intitulefonction
     *
     * @param string $intitulefonction
     *
     * @return Fonction
     */
    public function setIntitulefonction($intitulefonction)
    {
        $this->intitulefonction = $intitulefonction;

        return $this;
    }

    /**
     * Get intitulefonction
     *
     * @return string
     */
    public function getIntitulefonction()
    {
        return $this->intitulefonction;
    }


    /**
     * Set idSitedistant
     *
     * @param integer $idSitedistant
     *
     * @return Fonction
     */
    public function setIdSitedistant($idSitedistant)
    {
        $this->idSitedistant = $idSitedistant;

        return $this;
    }

    /**
     * Get idSitedistant
     *
     * @return integer
     */
    public function getIdSitedistant()
    {
        return $this->idSitedistant;
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

    

    /**
     * Set idSiteEmploi
     *
     * @param integer $idSiteEmploi
     *
     * @return Fonction
     */
    public function setIdSiteEmploi($idSiteEmploi)
    {
        $this->idSiteEmploi = $idSiteEmploi;

        return $this;
    }

    /**
     * Get idSiteEmploi
     *
     * @return integer
     */
    public function getIdSiteEmploi()
    {
        return $this->idSiteEmploi;
    }
	
	public function __toString() {
		try {
			return (string) $this->intitulefonction;
		} catch (Exception $exception) {
			return '';
		}
	}
}
