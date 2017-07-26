<?php
namespace OC\PlatformBundle\Form;

use OC\PlatformBundle\Entity\Fonction;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use OC\PlatformBundle\Repository\SiteRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormInterface;
use OC\PlatformBundle\Repository\AnnonceRepository;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class RejetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add('Motif',		EntityType::class,array(
				'class'			=> 'OCPlatformBundle:Rejet',
				'choice_label'	=> 'nom',
				'placeholder' => '',
				'label'			=> false
			))->add('Confirmer',	SubmitType::class)	
			
			;
	}	
		
}


?>
