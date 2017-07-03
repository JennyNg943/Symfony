<?php
namespace OC\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use OC\PlatformBundle\Repository\AnnonceRepository;
use OC\PlatformBundle\Repository\SiteRepository;


class CandidatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {	
		$builder
		->add('idCivilite',				EntityType::class,array(
				'label'			=> 'Civilite ',
				'class'			=> 'OCUserBundle:Sy_Civilite',
				'choice_label'	=> 'intitulecivilite',
				
		))
		
		->add('prenomCandidat',			TextType::class,array(
				'label'			=> 'Prenom',
				
		))	
		->add('nomCandidat',			TextType::class,array(
				'label'			=> 'Nom',
				
		))			
		->add('villeCandidat',			TextType::class,array(
				'label'			=> 'Ville',
				
		))	
		->add('CP',				TextType::class,array(
			'label'			=> 'CP'
			))
		->add('telportcandidat',			IntegerType::class,array(
				'label'			=> 'Telephone',
				
		))			
		->add('site',					EntityType::class,array(
				'label'=>'Domaine préféré : ',
				'class'=>'OCUserBundle:Sy_Siteemploi',
				'choice_label'=>'domaine'))		
		//->add('cvcandidat',				FileType::class,array('label'=>'CV'))
		->add('save', SubmitType::class,array('label'=>'Confirmer mes informations'));
    
    }
	public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => \OC\UserBundle\Entity\Sy_Candidature::class,
        ));
    }
	
}










?>