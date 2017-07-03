<?php

namespace OC\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Candidatsouhait
 *
 * @ORM\Table(name="candidatsouhait")
 * @ORM\Entity
 */
class Candidatsouhait
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Id_CandidatSouhait", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCandidatsouhait;

    /**
     * @var integer
     *
     * @ORM\Column(name="Id_Candidat", type="integer", nullable=true)
     */
    private $idCandidat;

    /**
     * @var integer
     *
     * @ORM\Column(name="Id_TravailEquipe", type="integer", nullable=true)
     */
    private $idTravailequipe;

    /**
     * @var integer
     *
     * @ORM\Column(name="Id_Encadrement", type="integer", nullable=true)
     */
    private $idEncadrement;

    /**
     * @var integer
     *
     * @ORM\Column(name="Id_Departement", type="integer", nullable=true)
     */
    private $idDepartement;

    /**
     * @var integer
     *
     * @ORM\Column(name="Id_Mobilite", type="integer", nullable=true)
     */
    private $idMobilite;

    /**
     * @var string
     *
     * @ORM\Column(name="Duree", type="string", length=45, nullable=true)
     */
    private $duree;

    /**
     * @var string
     *
     * @ORM\Column(name="Salaire", type="string", length=45, nullable=true)
     */
    private $salaire;

    /**
     * @var string
     *
     * @ORM\Column(name="GrandeVilleProche", type="string", length=255, nullable=false)
     */
    private $grandevilleproche;



    /**
     * Get idCandidatsouhait
     *
     * @return integer
     */
    public function getIdCandidatsouhait()
    {
        return $this->idCandidatsouhait;
    }

    /**
     * Set idCandidat
     *
     * @param integer $idCandidat
     *
     * @return Candidatsouhait
     */
    public function setIdCandidat($idCandidat)
    {
        $this->idCandidat = $idCandidat;

        return $this;
    }

    /**
     * Get idCandidat
     *
     * @return integer
     */
    public function getIdCandidat()
    {
        return $this->idCandidat;
    }

    /**
     * Set idTravailequipe
     *
     * @param integer $idTravailequipe
     *
     * @return Candidatsouhait
     */
    public function setIdTravailequipe($idTravailequipe)
    {
        $this->idTravailequipe = $idTravailequipe;

        return $this;
    }

    /**
     * Get idTravailequipe
     *
     * @return integer
     */
    public function getIdTravailequipe()
    {
        return $this->idTravailequipe;
    }

    /**
     * Set idEncadrement
     *
     * @param integer $idEncadrement
     *
     * @return Candidatsouhait
     */
    public function setIdEncadrement($idEncadrement)
    {
        $this->idEncadrement = $idEncadrement;

        return $this;
    }

    /**
     * Get idEncadrement
     *
     * @return integer
     */
    public function getIdEncadrement()
    {
        return $this->idEncadrement;
    }

    /**
     * Set idDepartement
     *
     * @param integer $idDepartement
     *
     * @return Candidatsouhait
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
     * Set idMobilite
     *
     * @param integer $idMobilite
     *
     * @return Candidatsouhait
     */
    public function setIdMobilite($idMobilite)
    {
        $this->idMobilite = $idMobilite;

        return $this;
    }

    /**
     * Get idMobilite
     *
     * @return integer
     */
    public function getIdMobilite()
    {
        return $this->idMobilite;
    }

    /**
     * Set duree
     *
     * @param string $duree
     *
     * @return Candidatsouhait
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree
     *
     * @return string
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Set salaire
     *
     * @param string $salaire
     *
     * @return Candidatsouhait
     */
    public function setSalaire($salaire)
    {
        $this->salaire = $salaire;

        return $this;
    }

    /**
     * Get salaire
     *
     * @return string
     */
    public function getSalaire()
    {
        return $this->salaire;
    }

    /**
     * Set grandevilleproche
     *
     * @param string $grandevilleproche
     *
     * @return Candidatsouhait
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
}
