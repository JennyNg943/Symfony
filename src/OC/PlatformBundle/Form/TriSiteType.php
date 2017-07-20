<?php
namespace OC\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use OC\PlatformBundle\Repository\DepartementRepository;
use OC\PlatformBundle\Repository\SiteRepository;
use Symfony\Component\OptionsResolver\OptionsResolver;


class TriSiteType extends AbstractType
{
    function buildForm(FormBuilderInterface $builder, array $options){
		
		$builder
				->setMethod('GET')
				->add('Domaine',			EntityType::class,array(
				'class'			=> 'OCUserBundle:Sy_Siteemploi',
				'choice_label'	=> 'domaine',
				'placeholder'	=>	'',
				'required'		=> false,
				'query_builder' => function(SiteRepository $er) {
								return $er->getSiteTri();}
					))
				->add('Departement',	EntityType::class,array(
					'class'			=>'OCPlatformBundle:Departement',	
					'placeholder'	=>	'',
					'required'		=>false,
					'label'			=>'Localisation',
					'query_builder' => function(DepartementRepository $er) {
                                    return $er->getDeptTri();}))
				->add('Type',	EntityType::class,array(
					'class'			=> 'OCPlatformBundle:Typecontrat',
					'choice_label'	=> 'intituletypecontrat',
					'placeholder'	=>	'',
					'required'		=>false,
					'label'			=>'Type de contrat',
				))
				->add('save',	SubmitType::class,array('label' => 'Filtrer'));
		
		return $builder;
		
		
	}
	
	public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'csrf_protection' => false,
        ]);
    }

}


?>