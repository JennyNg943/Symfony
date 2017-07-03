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


class SiteTestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add('idSiteEmploi',		EntityType::class,array(
				'class'			=> 'OCUserBundle:Sy_Siteemploi',
				'placeholder' => '',
				'label'			=> Site
			))
			
			;
		
		$formModifier = function (FormInterface $form, \OC\UserBundle\Entity\Sy_Siteemploi $site = null) {
            $fonction = null === $site ? array() : $site->getFonction();

            $form->add('idFonction', EntityType::class, array(
						'label'		=>'Fonction',
						'class'       => 'OCUserBundle:Sy_Fonction',
						'placeholder' => '',
						'choices'     => $fonction,
						'invalid_message'=>false))
				
            ;
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
					$data = $event->getData();
					$formModifier($event->getForm(),$data->getIdSiteemploi());
			}
        );
	
		

        $builder->get('idSiteEmploi')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                // It's important here to fetch $event->getForm()->getData(), as
                // $event->getData() will get you the client data (that is, the ID)
                $site = $event->getForm()->getData();

                // since we've added the listener to the child, we'll have to pass on
                // the parent to the callback functions!
                $formModifier($event->getForm()->getParent(), $site);
            }
        );
			
    }
	
	public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => \OC\PlatformBundle\Entity\Annonce_Sy_Siteemploi::class,
        ));
    }

}


?>
