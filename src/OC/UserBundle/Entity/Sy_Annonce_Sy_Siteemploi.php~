<?php

namespace OC\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sy_Annonce_Sy_Siteemploi
 *
 * 
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Repository\AnnonceSiteemploiRepository")
 */
class Sy_Annonce_Sy_Siteemploi
{
    /**
     * @ORM\Id
     *
     * @ORM\ManyToOne(targetEntity="OC\UserBundle\Entity\Sy_Annonce",cascade={"persist"})
     */
    private $idAnnonce;

    /**
     * @ORM\Id
     *
     * @ORM\ManyToOne(targetEntity="OC\UserBundle\Entity\Sy_Siteemploi",cascade={"persist"})
     */
    private $idSiteemploi;

	/**
     * @ORM\Id
     *
     * @ORM\ManyToOne(targetEntity="OC\UserBundle\Entity\Sy_Fonction",cascade={"persist"})
     */
	private $idFonction;


   

    /**
     * Set idAnnonce
     *
     * @param \OC\UserBundle\Entity\Sy_Annonce $idAnnonce
     *
     * @return Annonce_Sy_Siteemploi
     */
    public function setIdAnnonce(\OC\UserBundle\Entity\Sy_Annonce $idAnnonce)
    {
        $this->idAnnonce = $idAnnonce;

        return $this;
    }

    /**
     * Get idAnnonce
     *
     * @return \OC\UserBundle\Entity\Sy_Annonce
     */
    public function getIdAnnonce()
    {
        return $this->idAnnonce;
    }

    /**
     * Set idSiteemploi
     *
     * @param \OC\UserBundle\Entity\Sy_Siteemploi $idSiteemploi
     *
     * @return Annonce_Sy_Siteemploi
     */
    public function setIdSiteemploi(\OC\UserBundle\Entity\Sy_Siteemploi $idSiteemploi)
    {
        $this->idSiteemploi = $idSiteemploi;

        return $this;
    }

    /**
     * Get idSiteemploi
     *
     * @return \OC\UserBundle\Entity\Sy_Siteemploi
     */
    public function getIdSiteemploi()
    {
        return $this->idSiteemploi;
    }
	
	

    /**
     * Set idFonction
     *
     * @param integer $idFonction
     *
     * @return Annonce_Sy_Siteemploi
     */
    public function setIdFonction($idFonction)
    {
        $this->idFonction = $idFonction;

        return $this;
    }

    /**
     * Get idFonction
     *
     * @return integer
     */
    public function getIdFonction()
    {
        return $this->idFonction;
    }
}
