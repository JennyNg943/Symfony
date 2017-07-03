<?php
// src/OC/PlatformBundle/Repository/TypeContratRepository.php

namespace OC\PlatformBundle\Repository;

/**
 * TypeContratRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TypeContratRepository extends \Doctrine\ORM\EntityRepository
{
	function getTypeContrat($contrat){
			$qb = $this->createQueryBuilder('a');
			$qb
				->where('a.intituletypecontrat = :id')
				->setParameter('id', $contrat);

			return $qb->getQuery()
					->getResult();
		}
}
?>