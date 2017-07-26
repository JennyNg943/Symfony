<?php

namespace OC\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sy_Premium
 *
 * @ORM\Table(name="Sy_Premium")
 * @ORM\Entity
 */
class Sy_Premium
{

	/**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
	 * 
     */
    protected $id;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="OC\PlatformBundle\Entity\Sy_Premium_Formule",cascade={"persist"})
     */
    private $idFormule;

	/**
     * @var date
     *
     * @ORM\Column(name="DateDebut", type="date", length=255, nullable=false)
     */
	private $dateDebut;
	
	/**
     * @var date
     *
     * @ORM\Column(name="DateFin", type="date", length=255, nullable=false)
     */
	private $dateFin;
   

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return Sy_Premium_Employeur
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return Sy_Premium_Employeur
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set idFormule
     *
     * @param \OC\PlatformBundle\Entity\Sy_Premium_Formule $idFormule
     *
     * @return Sy_Premium_Employeur
     */
    public function setIdFormule(\OC\PlatformBundle\Entity\Sy_Premium_Formule $idFormule)
    {
        $this->idFormule = $idFormule;

        return $this;
    }

    /**
     * Get idFormule
     *
     * @return \OC\PlatformBundle\Entity\Sy_Premium_Formule
     */
    public function getIdFormule()
    {
        return $this->idFormule;
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
