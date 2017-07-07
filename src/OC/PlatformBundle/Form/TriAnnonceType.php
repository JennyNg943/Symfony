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


class TriAnnonceType extends AbstractType
{
    function buildForm(FormBuilderInterface $builder, array $options){
		
		$builder->setMethod('GET')
				->add('Suspension',			ChoiceType::class,array(
					'choices'		=> array(
						'Publiées'	=> 10,
						'A vérifier avant de publier'	=> -1,
						'A valider par le recruteur'	=> -2,
						'Suspendu'	=> 2,
						'Suspendu par le recruteur'		=> 1,
						'Pré-saisies'	=> -3
					),'label'		=> 'Type d\'annonce',
					'placeholder'	=>'',
					'required'	=>false
					))
				->add('Date',			ChoiceType::class,array(
					'choices'		=> array(
						'Croissant'	=> 'ASC',
						'Decroissant'=>'DESC',
					),'placeholder'	=>'',
					'required'	=>false))
				->add('Premium',		ChoiceType::class,array(
					'choices'		=> array(
						'Oui'	=> 1,
						'Non'	=> null
					),'placeholder'	=>'',
					'required'	=>false))
				->add('Site',			EntityType::class,array(
				'class'			=> 'OCUserBundle:Sy_Siteemploi',
				'choice_label'	=> 'intitulesiteemploi',
				'placeholder'	=>	'',
				'required'		=> false
					))
				->add('Departement',	EntityType::class,array(
					'class'			=>'OCPlatformBundle:Departement',	
					'placeholder'	=>	'',
					'required'		=>false,
					'query_builder' => function(DepartementRepository $er) {
                                    return $er->getDeptTri();}))	
				->add('save',	SubmitType::class,array('label' => 'Filtrer'));
		
		return $builder;
		
		
	}
	
	

}


?>