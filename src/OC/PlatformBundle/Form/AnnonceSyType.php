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
use OC\PlatformBundle\Repository\AnnonceRepository;
use OC\PlatformBundle\Repository\SiteRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use OC\UserBundle\Entity\Sy_Annonce;


class AnnonceSyType extends AbstractType
{
    function buildForm(FormBuilderInterface $builder, array $options){
		
		$builder
				
				->add('TitreAnnonce',		TextType::class)
				->add('DescriptifAnnonce',	TextareaType::class,array('attr' => array('rows' => '4')))
				->add('ProfilRecherche',	TextareaType::class,array('attr' => array('rows' => '4')))
				->add('site',				CollectionType::class,array(
						'entry_type'   => Sy_SiteType::class,
						'allow_add'    => true,
						'allow_delete' => true,
						'by_reference' => false,
						'label'				=>false,
						))
				->add('Remuneration',		TextType::class,array('required'=>false))
				->add('GrandeVilleProche',	TextType::class)
				->add('idDepartement',		EntityType::class,array(
						'class'			=> 'OCPlatformBundle:Departement',
						'label'			=> 'Departement'))
				->add('idNiveauSouhaite',	EntityType::class,array(
						'class'			=> 'OCPlatformBundle:Niveausouhaite',
						'choice_label'	=> 'intituleNiveauSouhaite',
						'label'			=> 'Niveau'))
				->add('avantage',			TextType::class,array(
						'required'		=> false
				))
				->add('idTypeContrat',		EntityType::class,array(
						'class'			=>	'OCPlatformBundle:Typecontrat',
						'choice_label'	=>	'intituletypecontrat',
						'label'			=>	'Type de contrat'
				))
				->add('idHoraire',			EntityType::class,array(
						'class'			=>	'OCPlatformBundle:Horaire',
						'choice_label'	=>	'intitulehoraire',
						'label'			=>	'Horaire'
				))
				->add('nbHeure',		TextType::class,array('label' => 'Nombre d\' heure'))
				->add('reference', TextType::class,array(
						'label'			=>	'Référence du recruteur',
					'required'			=> false	
				))
				
				->add('Save',			SubmitType::class,array('label'=>'Valider les modifications'))
					;
						
		
		
	}
	
	public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Sy_Annonce::class,
        ));
    }

}


?>