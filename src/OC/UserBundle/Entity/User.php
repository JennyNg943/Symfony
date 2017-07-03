<?php
// src/OC/UserBundle/Entity/User.php
 
namespace OC\UserBundle\Entity;
 
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use OC\PlatformBundle\Validator\InscriptionUser;
use Symfony\Component\Routing\Tests\Fixtures\AnnotatedClasses\AbstractClass;
 
/**
 * User
 * @ORM\Table(name="user")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="OC\UserBundle\Repository\UserRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type2", type="string")
 * @ORM\DiscriminatorMap({"Candidat" = "Sy_Candidature", "Recruteur" = "Sy_Recruteur","Employeur" = "Sy_Employeur"})
 *
 */
abstract class User extends BaseUser 
{
	
	
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

	
	/**
	 * @ORM\ManyToOne(targetEntity="OC\UserBundle\Entity\UtilisateurRole")
	 * @ORM\JoinColumn(nullable=true)
     */
	protected $type;
	
	
	public function __construct()
	{
	parent::__construct();

	}
	
	

    /**
     * Set type
     *
     * @param \OC\UserBundle\Entity\UtilisateurRole $type
     *
     * @return User
     */
    public function setType(\OC\UserBundle\Entity\UtilisateurRole $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \OC\UserBundle\Entity\UtilisateurRole
     */
    public function getType()
    {
        return $this->type;
    }

  
	
	public function setEmail($email){
		parent::setEmail($email);
		$this->setUsername($email);
	}
}
