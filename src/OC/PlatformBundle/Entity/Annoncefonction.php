<?php

namespace OC\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Annoncefonction
 *
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Repository\AnnonceRepository")
 */
class Annoncefonction
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="Id_Annonce", type="integer", nullable=false)
     */
    private $idAnnonce;

    /**
     * @var integer
     *
     * @ORM\Column(name="Id_Fonction", type="integer", nullable=false)
     */
    private $idFonction;



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
     * Set idAnnonce
     *
     * @param integer $idAnnonce
     *
     * @return Annoncefonction
     */
    public function setIdAnnonce($idAnnonce)
    {
        $this->idAnnonce = $idAnnonce;

        return $this;
    }

    /**
     * Get idAnnonce
     *
     * @return integer
     */
    public function getIdAnnonce()
    {
        return $this->idAnnonce;
    }

    /**
     * Set idFonction
     *
     * @param integer $idFonction
     *
     * @return Annoncefonction
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
