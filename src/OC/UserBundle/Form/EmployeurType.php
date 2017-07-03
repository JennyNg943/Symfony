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
use OC\PlatformBundle\Repository\DepartementRepository;

class EmployeurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		parent::buildForm($builder, $options);
        $builder
			->remove('username')	
			->add('Societe',				TextType::class,array('label'=>'Société* :'))
			->add('idCivilitecontactcomm',	EntityType::class,array(
					'label'			=>	'Civilité* :',
					'class'			=>  'OCUserBundle:Sy_Civilite',
					'choice_label'	=>  'intitulecivilite',
					'placeholder'	=>	''))
			->add('nomcontactcomm',			TextType::class,array('label'=>'Nom* :'))
			->add('prenomcontactcomm',		TextType::class,array('label'=>'Prenom* :'))
				
			->add('ville',					TextType::class,array('label'=>'Ville :','required'=>false))
			->add('cp',						EntityType::class,array(
						'class'			=> 'OCPlatformBundle:Departement',
						'label'=>'Departement* :',
						'placeholder'	=>	'',
						'query_builder' => function(DepartementRepository $er) {
										return $er->getDeptTri();}
					))
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
            'data_class' => \OC\UserBundle\Entity\Sy_Employeur::class,
        ));
    }
	
	public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';

        // Or for Symfony < 2.8
        // return 'fos_user_registration';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}










?>