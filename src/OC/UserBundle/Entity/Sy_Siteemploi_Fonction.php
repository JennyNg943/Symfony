<?php

namespace OC\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sy_Siteemploi_Fonction
 *
 * 
 * @ORM\Entity
 */
class Sy_Siteemploi_Fonction
{
    /**
     * @ORM\Id
     *
     * @ORM\ManyToOne(targetEntity="OC\UserBundle\Entity\Sy_Siteemploi")
     */
    private $idSiteemploi;

    /**
     * @ORM\Id
     *
     * @ORM\ManyToOne(targetEntity="OC\UserBundle\Entity\Sy_Fonction")
     */
    private $idFonction;



   

    /**
     * Set idSiteemploi
     *
     * @param \OC\UserBundle\Entity\Sy_Siteemploi $idSiteemploi
     *
     * @return Sy_Siteemploi_Fonction
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
     * @param \OC\PlatformBundle\Entity\Fonction $idFonction
     *
     * @return Sy_Siteemploi_Fonction
     */
    public function setIdFonction(\OC\PlatformBundle\Entity\Fonction $idFonction)
    {
        $this->idFonction = $idFonction;

        return $this;
    }

    /**
     * Get idFonction
     *
     * @return \OC\PlatformBundle\Entity\Fonction
     */
    public function getIdFonction()
    {
        return $this->idFonction;
    }
}
