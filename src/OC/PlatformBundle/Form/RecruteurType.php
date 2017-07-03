<?php
namespace OC\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;




class RecruteurType extends AbstractType
{
    function buildForm(FormBuilderInterface $builder, array $options){
		
		$builder
				
				->add('Recherche',		TextType::class,array('label'=>false))
				->add('Save',			SubmitType::class,array('label'=>'Rechercher'))
					;
						
		
		
	}
	

}


?>