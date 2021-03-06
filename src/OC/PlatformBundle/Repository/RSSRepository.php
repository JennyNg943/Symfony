<?php
// src/OC/PlatformBundle/Repository/RSSRepository.php

namespace OC\PlatformBundle\Repository;

/**
 * RSSRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RSSRepository extends \Doctrine\ORM\EntityRepository
{
	public function getLatestPost()
	{
		$query = $this->createQueryBuilder('j')
			->where('j.expires_at > :date')
			->setParameter('date', date('Y-m-d H:i:s', time()))
			->andWhere('j.is_activated = :activated')
			->setParameter('activated', 1)
			->orderBy('j.expires_at', 'DESC')
			->setMaxResults(1)
			->getQuery();

		try {
			$job = $query->getSingleResult();
		} catch (\Doctrine\Orm\NoResultException $e) {
			$job = null;
		}

		return $job;
	}
}
?>