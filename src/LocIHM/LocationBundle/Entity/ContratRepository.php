<?php

namespace LocIHM\LocationBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ContratRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ContratRepository extends EntityRepository
{

	/*
	 * Retourne tous les contrats concernés par la période donnée
	 */
	public function getAllIdVehUseInContrat($dateDebut, $dateFin)
	{
		
		$qb = $this->createQueryBuilder('contrat');
		$qb
			->where('contrat.dateDebut >= :dateDebut AND contrat.dateDebut <= :dateFin')
			->orWhere('contrat.dateFin >= :dateDebut AND contrat.dateFin <= :dateFin')
			->setParameter('dateDebut', $dateDebut)
			->setParameter('dateFin', $dateFin);
		
		$qb = $qb->getQuery()->getResult();

		return $qb;
	}

	/*
	 * Retourne les contrats utilisant le vehicule dans la période donnée 
	 */
	public function getContratByDateAndIdVeh($idVeh, $dateDebut, $dateFin)
	{
		
		$qb = $this->createQueryBuilder('contrat');
		$qb
			->where('contrat.dateDebut >= :dateDebut AND contrat.dateDebut <= :dateFin')
			->orWhere('contrat.dateFin >= :dateDebut AND contrat.dateFin <= :dateFin')
			->andWhere('contrat.vehicule = :idveh')
			->setParameter('dateDebut', $dateDebut)
			->setParameter('dateFin', $dateFin)
			->setParameter('idveh', $idVeh);
		
		$qb = $qb->getQuery()->getResult();

		return $qb;
	}

	/*
	 * Retourne les contrats en cours ou futur d'un utilisateur
	 */
	public function getContratByDateAndUser($user) {
		$qb = $this->createQueryBuilder('contrat');

		$qb
			->where('contrat.dateDebut > :now')
			->orWhere('contrat.dateDebut <= :now AND contrat.dateFin >= :now')
			->setParameter('now', new \DateTime("now"), \Doctrine\DBAL\Types\Type::DATETIME)
			->andWhere('contrat.user = :idUser')
			->setParameter('idUser', $user)
			->orderBy('contrat.dateDebut', 'ASC');
		;

		$qb = $qb->getQuery()->getResult();

		return $qb;
	}

	/*
	 * Retourne les contrats en cours ou futur d'un utilisateur
	 */
	public function getContratPassedByDateAndUser($user) {
		$qb = $this->createQueryBuilder('contrat');

		$qb
			->where('contrat.user = :idUser')
			->andWhere('contrat.dateFin < :now')
			->setParameter('now', new \DateTime("now"), \Doctrine\DBAL\Types\Type::DATETIME)
			->setParameter('idUser', $user)
			->orderBy('contrat.dateFin', 'DESC');
		;

		$qb = $qb->getQuery()->getResult();

		return $qb;
	}

	/*
	 * Compte le nombre de contrat total
	 */
	public function countContrats()
	{
		$qb = $this->createQueryBuilder('contrat');

		$qb
			->select('COUNT(contrat.id)')
		;
		return $qb->getQuery()->getSingleScalarResult();
	}

	/*
	 * Compte le nombre de contrat en cours
	 */
	public function countContratsEnCours()
	{
		$qb = $this->createQueryBuilder('contrat');

		$qb
			->select('COUNT(contrat.id)')
			->orWhere('contrat.dateDebut <= :now AND contrat.dateFin >= :now')
			->setParameter('now', new \DateTime("now"), \Doctrine\DBAL\Types\Type::DATETIME)
		;
		return $qb->getQuery()->getSingleScalarResult();
	}
}
