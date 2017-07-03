<?php
namespace OC\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class RecruteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		
        $builder
			
			->add('Societe',				TextType::class,array('label'=>'Société* :'))
			->add('idCivilitecontactcomm',	EntityType::class,array(
					'label'			=>	'Civilité* :',
					'class'			=>  'OCUserBundle:Sy_Civilite',
					'choice_label'	=>  'intitulecivilite',))
			->add('nomcontactcomm',			TextType::class,array('label'=>'Nom* :'))	
			->add('prenomcontactcomm',		TextType::class,array('label'=>'Prenom* :'))
			->add('ville',					TextType::class,array('label'=>'Ville* :'))
			->add('cp',						EntityType::class,array(
						'class'			=> 'OCPlatformBundle:Departement',
						'choice_label'	=> 'dept','label'=>'Departement* :'))
			->add('tel',					IntegerType::class,array('label'=>'Téléphone* :'))
			->add('description',			TextareaType::class,array(
				'attr' => array( 'rows' => '5'),
				'label'=>'Description de l\'entreprise* :'
			))
			->add('save', SubmitType::class,array('label'=>'Confirmer mes informations'));
				
	}
	
	
	public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => \OC\UserBundle\Entity\Sy_Recruteur::class,
        ));
    }
	
	
}










?>