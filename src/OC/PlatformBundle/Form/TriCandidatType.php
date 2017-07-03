<?php
namespace OC\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use OC\UserBundle\Entity\Sy_Siteemploi;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use OC\PlatformBundle\Repository\AnnonceRepository;
use OC\PlatformBundle\Repository\DepartementRepository;


class TriCandidatType extends AbstractType
{
    function buildForm(FormBuilderInterface $builder, array $options){
		
		$builder
				->add('Site',			EntityType::class,array(
				'class'			=> 'OCUserBundle:Sy_Siteemploi',
				'choice_label'	=> 'Domaine',
				'placeholder'	=>	'',
				'required'		=> false
					))
				->add('Departement',	EntityType::class,array(
					'class'			=>'OCPlatformBundle:Departement',	
					'choice_label'	=>'dept',
					'placeholder'	=>	'',
					'required'		=>false,
					'query_builder' => function(DepartementRepository $er) {
                                    return $er->getDeptTri();}))	
				->add('Fonction',	EntityType::class,array(
					'class'			=>'OCUserBundle:Sy_Fonction',	
					'choice_label'	=>'intitulefonction',
					'placeholder'	=>	'',
					'required'		=>false,
					))	
				->add('save',	SubmitType::class,array('label' => 'Filtrer'));
		
		return $builder;
		
		
	}
	
	

}


?>