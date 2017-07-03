<?php

// src/OC/PlatformBundle/Validator/InscriptionUserValidator.php


namespace OC\PlatformBundle\Validator;


use Symfony\Component\Validator\Constraint;

use Symfony\Component\Validator\ConstraintValidator;


class InscriptionUserValidator extends ConstraintValidator

{
	public function validate($value, Constraint $constraint)
	{
		if ($value == null) {
		  $this->context->addViolation($constraint->message);
		}
	}
}