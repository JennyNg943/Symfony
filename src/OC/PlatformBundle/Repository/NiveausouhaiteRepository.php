<?php
// src/OC/PlatformBundle/Repository/NiveausouhaiteRepository.php

namespace OC\PlatformBundle\Repository;

/**
 * NiveausouhaiteRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class NiveausouhaiteRepository extends \Doctrine\ORM\EntityRepository
{
	function getId($id){
			$qb = $this->createQueryBuilder('a');
			$qb
				->where('a.intituleniveausouhaite = :id')
				->setParameter('id', $id);

			return $qb->getQuery()
					->getResult();
		}
}
?>