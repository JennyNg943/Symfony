<?php

// src/OC/PlatformBundle/Validator/Annonce.php


namespace OC\PlatformBundle\Validator;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Annonce extends Constraint
{

  public $message = "Cet élément est vide";

}