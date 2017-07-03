<?php

namespace OC\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Candidatfonction2
 *
 * @ORM\Table(name="candidatfonction2", indexes={@ORM\Index(name="Id_NiveauSouhaite", columns={"Id_NiveauSouhaite"})})
 * @ORM\Entity
 */
class Candidatfonction2
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Id_CandidatFonction", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCandidatfonction;

    /**
     * @var integer
     *
     * @ORM\Column(name="Id_NiveauSouhaite", type="integer", nullable=false)
     */
    private $idNiveausouhaite;



    /**
     * Get idCandidatfonction
     *
     * @return integer
     */
    public function getIdCandidatfonction()
    {
        return $this->idCandidatfonction;
    }

    /**
     * Set idNiveausouhaite
     *
     * @param integer $idNiveausouhaite
     *
     * @return Candidatfonction2
     */
    public function setIdNiveausouhaite($idNiveausouhaite)
    {
        $this->idNiveausouhaite = $idNiveausouhaite;

        return $this;
    }

    /**
     * Get idNiveausouhaite
     *
     * @return integer
     */
    public function getIdNiveausouhaite()
    {
        return $this->idNiveausouhaite;
    }
}
