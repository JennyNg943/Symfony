<?php
namespace OC\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use OC\PlatformBundle\Entity\Annonce;



class RechercheType extends AbstractType
{
    function buildForm(FormBuilderInterface $builder, array $options){
		
		$builder
				->setMethod('GET')
				->add('Recherche',		TextType::class,array('label'=>false))
				->add('Save',			SubmitType::class,array('label'=>'Rechercher'))
					;
						
		
		
	}
	

}


?>