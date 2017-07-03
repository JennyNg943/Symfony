<?php

namespace OC\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use OC\UserBundle\Repository\UserRepository;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RegistrationType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		
		
		
			
			
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