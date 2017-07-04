<?php
namespace OC\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;



class FonctionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add('IntituleFonction',	TextType::class,array(
				'label'			=>	'Intitule de la fonction'
			))
			->add('idSiteEmploi',	EntityType::class,array(
				'label'			=>	'Site',
				'class'			=> 'OCUserBundle:Sy_Siteemploi',
				'choice_label'	=> 'intitulesiteemploi',
				'placeholder' => '',
				))
			->add('Confirmer', SubmitType::class);
				

	}				
	
	public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => \OC\UserBundle\Entity\Sy_Fonction::class,
        ));
    }

}


?>
