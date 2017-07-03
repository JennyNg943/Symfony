<?php
namespace OC\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use OC\PlatformBundle\Repository\AnnonceRepository;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ManeomType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {	
		
        $builder
		->add('id',			TextType::class,array('label'=>'id :'))
		->add('save',					SubmitType::class,array('label'	=> 'Recherche'))		
    ;
    }

}










?>