<?php

namespace OC\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Niveauformation
 *
 * @ORM\Table(name="niveauformation")
 * @ORM\Entity
 */
class Niveauformation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Id_NiveauFormation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idNiveauformation;

    /**
     * @var string
     *
     * @ORM\Column(name="IntituleNiveauFormation", type="string", length=255, nullable=false)
     */
    private $intituleniveauformation;

    /**
     * @var integer
     *
     * @ORM\Column(name="OrdreAffichage", type="integer", nullable=false)
     */
    private $ordreaffichage;



    /**
     * Get idNiveauformation
     *
     * @return integer
     */
    public function getIdNiveauformation()
    {
        return $this->idNiveauformation;
    }

    /**
     * Set intituleniveauformation
     *
     * @param string $intituleniveauformation
     *
     * @return Niveauformation
     */
    public function setIntituleniveauformation($intituleniveauformation)
    {
        $this->intituleniveauformation = $intituleniveauformation;

        return $this;
    }

    /**
     * Get intituleniveauformation
     *
     * @return string
     */
    public function getIntituleniveauformation()
    {
        return $this->intituleniveauformation;
    }

    /**
     * Set ordreaffichage
     *
     * @param integer $ordreaffichage
     *
     * @return Niveauformation
     */
    public function setOrdreaffichage($ordreaffichage)
    {
        $this->ordreaffichage = $ordreaffichage;

        return $this;
    }

    /**
     * Get ordreaffichage
     *
     * @return integer
     */
    public function getOrdreaffichage()
    {
        return $this->ordreaffichage;
    }
}
