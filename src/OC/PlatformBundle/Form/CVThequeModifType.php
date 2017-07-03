<?php
namespace OC\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use OC\UserBundle\Entity\Sy_CvTheque;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;



class CVThequeModifType extends AbstractType
{
    function buildForm(FormBuilderInterface $builder, array $options){
		
		$builder
				
				->add('nom',			TextType::class)
				->add('prenom',			TextType::class)
				->add('mail',			TextType::class)
				->add('idSite',			EntityType::class,array(
						'class'			=> 'OCUserBundle:Sy_Siteemploi',
						'choice_label'	=> 'domaine',
						'label'			=> 'Domaine'))
				->add('save',			SubmitType::class,array('label'=>'Enregistrer les modifications'))
					;
	}
	
	public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Sy_CvTheque::class,
        ));
    }
	

}


?>