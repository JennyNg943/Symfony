<?php
// src/OC/PlatformBundle/Repository/DepartementRepository.php

namespace OC\PlatformBundle\Repository;

/**
 * DepartementRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DepartementRepository extends \Doctrine\ORM\EntityRepository
{
	function getDeptTri()
	{
		$qb = $this->createQueryBuilder('a');
		$qb ->where('a.id != :id')
			->setParameter('id', 0)
			->orderBy('a.num','ASC');
	
		return $qb;
				
	}
	
	function getDepartement($id){
		$qb = $this->createQueryBuilder('a');
		$qb ->where('a.num = :id')
				->setParameter('id', $id);
		
		return $qb->getQuery()->getResult();
	}
	
	function getDepartementAnnonce(){
		$qb = $this->createQueryBuilder('a');
		$qb ->where('a.id != :id')
			->setParameter('id', 0)
			->orderBy('a.dept','ASC');
	
		return $qb;
	}
	
	
	
	
	
}

?>